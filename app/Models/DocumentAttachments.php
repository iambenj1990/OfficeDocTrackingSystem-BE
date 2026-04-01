<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentAttachments extends Model
{
    protected $fillable = [
        'document_id',
        'file_path',
        'file_name',
        'disk',
        'uploaded_by',

    ];


    public function document()
    {
        return $this->belongsTo(Documents::class, 'document_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }


}
