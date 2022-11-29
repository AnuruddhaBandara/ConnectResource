<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AttendanceService;
use App\Services\AttendanceFaultService;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    private $attendanceService;
    private $attendanceFaultService;

    public function __construct(AttendanceService $attendanceService,AttendanceFaultService $attendanceFaultService)
    {
        $this->attendanceService = $attendanceService;
        $this->attendanceFaultService = $attendanceFaultService;
    }

    public function getAttendance()
    {

        //get attendance details
        $attendances = $this->attendanceService->getAttendance();
        $data = [];
        foreach ($attendances as $key => $attendance) {
            $check_in_date_time = new DateTime($attendance->check_in);
            $check_out_date_time = $attendance->check_out;
            $diff = $check_in_date_time->diff(new DateTime($check_out_date_time));

            $days_into_hours = 0;
            $hours = $diff->h;
            $minutes_into_hours = 0;

            if ($diff->days > 0) {
                $days_into_hours = ($diff->days * 24);
            }
            if ($diff->i > 0) {
                $total_minutes = ($diff->days / 24);
                $minutes_into_hours = round($total_minutes, 2);
            }

            //calculate total working hours
            if ($attendance->check_in == null || $attendance->check_out == null || ($attendance->check_in == null && $attendance->check_out == null)) {
                $total_hours = 0;
            } else {

                $total_hours = ($days_into_hours + $hours + $minutes_into_hours);
            }

            array_push($data, [
                'name' => $attendance->employees->first_name . ' ' . $attendance->employees->last_name,
                'check_in' => $attendance->check_in,
                'check_out' => $attendance->check_out,
                'total_hours' => $total_hours,
            ]);
        }

        return response()->json($data);
    }

    public function importAttendaceSheet(Request $req) {
        try
        {
            DB::beginTransaction();
            $file = $req->file('file');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('A', $column_limit);
            $data = [];
            foreach ($row_range as $row) {
                $day = date("Y-m-d",strtotime($sheet->getCell('A' . $row)->getValue()));
                $check_in = ($sheet->getCell('B' . $row)->getValue()) ? date("Y-m-d H:i:s",strtotime($sheet->getCell('B' . $row)->getValue())) : null;
                $check_out =($sheet->getCell('C' . $row)->getValue()) ? date("Y-m-d H:i:s",strtotime($sheet->getCell('C' . $row)->getValue())): null;
                $status = 'Available';
                if($check_in == null || $check_out == null || ($check_in == null && $check_out == null)){
                    $status = 'N/A';
                }
                array_push($data, [
                    'day' => ($day) ? $day : null ,
                    'check_in'  => ($check_in) ? $check_in : null,
                    'check_out'  => ($check_out) ? $check_out : null,
                    'status' => $status,
                    'schedule_id' => ($sheet->getCell('D' . $row)->getValue()) ? $sheet->getCell('D' . $row)->getValue() : null ,
                    'employee_id' => ($sheet->getCell('E' . $row)->getValue()) ? $sheet->getCell('E' . $row)->getValue() : null ,
                ]);
            }
            //insert Attendance
            $attend = $this->attendanceService->addAttendance($data);

            //get all Attendance
            $attendances = $this->attendanceService->getAttendance();
            $attendance_fault = [];
            foreach($attendances as $attendance){
                if($attendance->status == 'N/A'){
                    array_push($attendance_fault,[
                        'description' => 'aaaaaaaa',
                        'attendance_id' => $attendance->id,
                        'employee_id' => $attendance->employee_id
                    ]);
                }
            }
            //add attendance faults
            $attend_fault = $this->attendanceFaultService->addAttendanceFault($attendance_fault);
            if($attend && $attend_fault){
                DB::commit();

            }
            else {
               DB::rollBack();
            }
        }
        catch(\Throwable $th){
            dd($th->getMessage(),$th->getLine());
        }
    }
}
