<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageDataResource extends Model
{
    protected $table = 'image_data_resource'; //table name where data inserted

    use HasFactory;
    protected $fillable = [
        'DATA_RESOURCE_ID',
        'IMAGE_DATA',
    ];
    // Define custom column names for timestamps
    public const CREATED_AT = 'CREATED_STAMP';
    public const UPDATED_AT = 'LAST_UPDATED_STAMP';
}
