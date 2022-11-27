<?php

namespace App\Services;

use App\Attendance;

class AttendanceService {
    
    public function getAttendance()
    {
        $attedance = Attendance::with('employees')->get();
        return $attedance;
    }
}

?>