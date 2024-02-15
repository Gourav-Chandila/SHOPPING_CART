<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    protected $table = 'user_login'; //table name where data inserted
    protected $primaryKey = 'USER_LOGIN_ID';
    use HasFactory;
    protected $fillable = [
        'USER_LOGIN_ID',
        'CURRENT_PASSWORD',
        'PARTY_ID',
    ];
    // Define custom column names for timestamps
    public const CREATED_AT = 'CREATED_STAMP';
    public const UPDATED_AT = 'LAST_UPDATED_STAMP';
}
