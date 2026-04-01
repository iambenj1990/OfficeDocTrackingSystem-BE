<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibDocuments extends Model
{
    use SoftDeletes;

    //
    protected $fillable = [
        'document_Type'
    ];

}
