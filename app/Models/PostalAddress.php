<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalAddress extends Model
{
    protected $table = 'postal_address'; //table name where data inserted
    protected $primaryKey = 'CONTACT_MECH_ID';
    use HasFactory;
    protected $fillable = [
        'CONTACT_MECH_ID',
        'ADDRESS1',
        'ADDRESS2',
    ];
    // Define custom column names for timestamps
    public const CREATED_AT = 'CREATED_STAMP';
    public const UPDATED_AT = 'LAST_UPDATED_STAMP';
}
