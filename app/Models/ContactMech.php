<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMech extends Model
{
    protected $table = 'contact_mech'; //table name where data inserted
    use HasFactory;
    protected $fillable = [
        'CONTACT_MECH_ID',
        'CONTACT_MECH_TYPE_ID',
        'INFO_STRING',
    ];
    // Define custom column names for timestamps
    public const CREATED_AT = 'CREATED_STAMP';
    public const UPDATED_AT = 'LAST_UPDATED_STAMP';
}
