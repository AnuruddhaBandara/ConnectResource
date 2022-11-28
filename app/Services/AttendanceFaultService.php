<?php

namespace App\Services;

use App\AttendanceFault;

class AttendanceFaultService {
    
    public function addAttendanceFault(array $data){
        return AttendanceFault::insert($data);
    }
}
