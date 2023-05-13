<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerGroup extends Model
{
    use HasFactory;

    public function ledgeraccount(){

        return $this->hasMany(LedgerAccount::class);
    } 

    public function ledgergrp() {
        return $this->belongsTo(LedgerType::class,'group_type');
    }
}
