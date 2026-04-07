<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documents extends Model
{
    use SoftDeletes;
     protected $table = 'tbl_documents'; // 👈 add this
    protected $fillable = [
        'title',
        'subject',
        'keywords',
        'issuer',
        'range_dates',
        'contact_person',
        'need_approval',
        'contact_number',
        'document_type',
        'issue_date',
        'effect_date',
        'encoded_by',
    ];


    public function files(): HasMany
    {
        return $this->hasMany(DocumentAttachments::class,'document_id');
    }
}
