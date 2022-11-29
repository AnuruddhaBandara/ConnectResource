<?php

namespace App\Services;

use App\AttendanceFault;

class AttendanceFaultService {
    
    public function addAttendanceFault(array $data){
        if(AttendanceFault::insert($data)){
            return true;
        }
        else {
            return false;
        }
    }
}
