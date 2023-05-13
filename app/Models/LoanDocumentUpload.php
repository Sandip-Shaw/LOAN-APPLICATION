<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDocumentUpload extends Model
{
    use HasFactory;

    protected $fillable = ['doc_name','doc_file'];

    public function setFilenamesAttribute($value)
    {
        $this->attributes['doc_file'] = json_encode($value);
    }
}
