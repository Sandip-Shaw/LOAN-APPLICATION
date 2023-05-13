<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class LoanSchema extends Model
{
    use HasFactory,HasRoles;

    protected $primaryKey = 'loanSchema_id';

    public function loanApplication(){

        return $this->hasMany(LoanApplication::class);
    }
}
