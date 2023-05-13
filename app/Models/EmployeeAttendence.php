<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendence extends Model
{
    use HasFactory;

    public function attendence(){

        return $this->belongsTo(HrManagement::class,'employee');
    }
}
