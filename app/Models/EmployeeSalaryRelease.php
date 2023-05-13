<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryRelease extends Model
{
    use HasFactory;

    public function EmpSalary(){

        return $this->belongsTo(HrManagement::class,'employee');
    }
}
