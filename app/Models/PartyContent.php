<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PartyContent extends Model
{
    protected $table = 'party_content'; //table name where data inserted
    use HasFactory;
    protected $fillable = [ //mass assignable
        'PARTY_ID',
        'CONTENT_ID',
        'PARTY_CONTENT_TYPE_ID',
        'FROM_DATE',
    ];
    // Define custom column names for timestamps
    public const CREATED_AT = 'CREATED_STAMP';
    public const UPDATED_AT = 'LAST_UPDATED_STAMP';

    // Mutator for setting FROM_DATE attribute to current date
    public function setFromDateAttribute($value)
    {
        // If the value is not provided or is null, set it to the current date
        $this->attributes['FROM_DATE'] = $value ?: Carbon::now();
    }
}
