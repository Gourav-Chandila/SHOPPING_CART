<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $table = 'party'; //table name where data inserted
    // public $timestamps = false; //time stamp false than not automatic insertion in db
    use HasFactory;
    protected $fillable = [
        'PARTY_ID',
        'PARTY_TYPE_ID',
    ];
    // Define custom column names for timestamps
    public const CREATED_AT = 'CREATED_STAMP';
    public const UPDATED_AT = 'LAST_UPDATED_STAMP';
}
