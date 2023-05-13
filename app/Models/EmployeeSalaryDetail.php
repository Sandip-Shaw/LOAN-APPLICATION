<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalaryDetail extends Model
{
    use HasFactory;

    public function salaryDet(){

        return $this->belongsTo(HrManagement::class,'employee');
    }
}
