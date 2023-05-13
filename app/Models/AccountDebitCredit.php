<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountDebitCredit extends Model
{
    use HasFactory;

    public function accntdebitcredit(){

        return $this->belongsTo(LedgerEntries::class);
    } 
    public function ledgeraccnt(){

        return $this->belongsTo(LedgerAccount::class,'ledger_account_id');
    } 
    public function ledgerbrnch(){

        return $this->belongsTo(CompanyBranch::class,'branch_id');
    } 

    protected $fillable = [
        'description', 
        'opening_acc_balance', 
        'amount',
        'type',
        'closing_acc_balance',


    ];  
}
