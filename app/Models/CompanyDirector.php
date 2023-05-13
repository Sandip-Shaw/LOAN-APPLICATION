<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class CompanyDirector extends Model
{
    use HasFactory,HasRoles;

    public function memberdet(){

        return $this->belongsTo(MemberManagement::class,'member');
    }
}
