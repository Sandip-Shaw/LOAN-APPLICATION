<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;

    public function branchdetlist(){

        return $this->belongsTo(CompanyBranch::class,'branch_id');
    }
}
