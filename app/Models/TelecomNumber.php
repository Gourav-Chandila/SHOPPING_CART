<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelecomNumber extends Model
{
    protected $table = 'telecom_number'; //table name where data inserted
    protected $primaryKey = 'CONTACT_MECH_ID';
    use HasFactory;
    protected $fillable = [
        'CONTACT_MECH_ID',
        'CONTACT_NUMBER',
        'SECOND_CONTACT_NUMBER',
        
    ];
    // Define custom column names for timestamps
    public const CREATED_AT = 'CREATED_STAMP';
    public const UPDATED_AT = 'LAST_UPDATED_STAMP';
}
