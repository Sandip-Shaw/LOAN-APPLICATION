<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerAccount extends Model
{
    use HasFactory;

    public function ledgergroup(){

        return $this->belongsTo(LedgerGroup::class,'ledger_group_id');
    } 

    public function ledgertype(){

        return $this->belongsTo(LedgerType::class,'ledger_type');
    } 

    public function accntdebcredit(){

        return $this->hasMany(AccountDebitcredit::class);
    }
}
