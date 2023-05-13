<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentCreate extends Model
{
    use HasFactory;

    public function inv_list(){

        return $this->belongsTo(InvestmentScheme::class,'scheme');
    }

    public function mem_list(){

        return $this->belongsTo(MemberManagement::class,'member');
    }

    public function branch_list(){

        return $this->belongsTo(CompanyBranch::class,'branch');
    }
}
