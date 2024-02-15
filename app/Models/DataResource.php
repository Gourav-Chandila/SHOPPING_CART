<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataResource extends Model
{
    use HasFactory;
    protected $table = 'data_resource'; //table name where data inserted
    use HasFactory;
    protected $fillable = [
        'DATA_RESOURCE_ID',
        'DATA_RESOURCE_NAME',
        'OBJECT_INFO',
        'DATA_RESOURCE_TYPE_ID',
        'MIME_TYPE_ID',
    ];
    // Define custom column names for timestamps
    public const CREATED_AT = 'CREATED_STAMP';
    public const UPDATED_AT = 'LAST_UPDATED_STAMP';
}
