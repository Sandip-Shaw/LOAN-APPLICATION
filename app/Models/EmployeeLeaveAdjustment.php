<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveAdjustment extends Model
{
    use HasFactory;

    public function leaveadj(){

        return $this->belongsTo(HrManagement::class,'employee');
    }
}
