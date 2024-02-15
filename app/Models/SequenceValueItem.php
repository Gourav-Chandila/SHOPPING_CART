<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SequenceValueItem extends Model
{
    use HasFactory;
    protected $table = 'sequence_value_item';//table name where data to be inserted

    protected $fillable = [
        // 'CREATED_STAMP',
        // 'LAST_UPDATED_STAMP',
        // Other fillable fields
    ];
        // Define custom column names for timestamps not working
        // public const CREATED_AT = 'CREATED_STAMP';
        // public const UPDATED_AT = 'LAST_UPDATED_STAMP';
}
