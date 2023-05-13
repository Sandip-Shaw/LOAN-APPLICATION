<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerEntries extends Model
{
    use HasFactory;

    public function accountdetail(){

        return $this->hasMany(AccountDebitCredit::class,'ledger_entries_id');
    } 
    // public function accountcredit(){

    //     return $this->hasMany(AccountCredit::class,'ledger_entries');
    // } 

    
}
