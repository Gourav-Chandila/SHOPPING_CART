<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content'; //table name where data inserted

    use HasFactory;
    protected $fillable = [
        'CONTENT_ID',
        'CONTENT_TYPE_ID',
        'DATA_RESOURCE_ID',
        'STATUS_ID',
        'CONTENT_NAME',
    ];
    // Define custom column names for timestamps
    public const CREATED_AT = 'CREATED_STAMP';
    public const UPDATED_AT = 'LAST_UPDATED_STAMP';
}
