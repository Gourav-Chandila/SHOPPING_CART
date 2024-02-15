<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'person'; //table name where data inserted
    protected $primaryKey = 'PARTY_ID';
    use HasFactory;
    protected $fillable = [
        'PARTY_ID',
        'FIRST_NAME',
        'LAST_NAME',
    ];
    // Define custom column names for timestamps
    public const CREATED_AT = 'CREATED_STAMP';
    public const UPDATED_AT = 'LAST_UPDATED_STAMP';
}
