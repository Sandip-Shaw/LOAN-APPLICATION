<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddDesignation extends Model
{
    use HasFactory;

    public function design(){

        return $this->hasMany(HrManagement::class);
    } 
}
