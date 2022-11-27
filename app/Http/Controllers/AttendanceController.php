<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AttendanceService;
use DateTime;

class AttendanceController extends Controller
{
    private $attendanceService;


    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
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
}
