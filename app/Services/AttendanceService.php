<?php

namespace App\Services;

use App\Attendance;

class AttendanceService {
    
    public function getAttendance()
    {
        $attedance = Attendance::with('employees')->get();
        return $attedance;
    }

    public function addAttendance(array $data){
        return Attendance::insert($data);
    }
}
