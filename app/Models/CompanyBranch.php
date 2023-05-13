<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class CompanyBranch extends Model
{
    use HasFactory,HasRoles;

    public function members(){

        return $this->hasMany(MemberManagement::class);
    } 
    public function loanApplication(){

        return $this->hasMany(LoanApplication::class);
    } 

    public function hrmanagement(){

        return $this->hasMany(HrManagement::class);
    }

    public function collectioncenter(){

        return $this->hasMany(CollectionCenter::class);
    }
    public function accntdebcredit(){

        return $this->hasMany(AccountDebitcredit::class);
    }

    public function branchlist(){

        return $this->hasMany(EmployeeLeave::class);
    }

    public function investBranch(){

        return $this->hasMany(InvestmentCreate::class);
    }



    public function branchselect(){
        return $this->belongsToMany(Admin::class,'company_admin_branches');
    }
}
