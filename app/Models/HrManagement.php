<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class HrManagement extends Model
{
    use HasFactory,HasRoles;

    protected $primaryKey = 'hrmanagement_id';

    public function branchdetails(){

        return $this->belongsTo(CompanyBranch::class,'branch');
    }

    public function loanapplications(){

        return $this->hasMany(LoanApplication::class);
    }

    public function members(){

        return $this->hasMany(MemberManagement::class);
    }

    public function salarydisburse(){

        return $this->hasMany(HrSalaryDisbursement::class);
    }

    public function designationdet(){

        return $this->belongsTo(AddDesignation::class,'designation');
    }

    public function memberallDet(){

        return $this->belongsTo(MemberManagement::class,'member');
    }

    public function salary(){

        return $this->hasOne(EmployeeSalaryDetail::class);
    }

    public function leave(){

        return $this->hasMany(EmployeeLeaveAdjustment::class);
    }

    public function empAttendence(){

        return $this->hasMany(EmployeeAttendence::class);
    }
    public function salaryPay(){

        return $this->hasMany(EmployeeSalaryRelease::class);
    }

}
