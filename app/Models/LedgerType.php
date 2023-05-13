<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LedgerType extends Model
{
    use HasFactory;
    protected $primaryKey = 'ledger_types_id';

    public function ledgertyp(){

        return $this->hasMany(LedgerGroup::class);
    } 

    public function ledgeracctyp(){

        return $this->hasMany(LedgerAccount::class);
    } 

}
