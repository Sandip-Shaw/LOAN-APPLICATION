<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrSalaryDisbursement extends Model
{
    use HasFactory;

    public function emp_list(){

        return $this->belongsTo(HrManagement::class,'employee_id');
    }
}
