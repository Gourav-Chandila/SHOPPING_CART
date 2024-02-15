<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PartyContactMech extends Model
{
    protected $table = 'party_contact_mech'; //table name where data inserted
    protected $primaryKey = 'CONTACT_MECH_ID';

    use HasFactory;
    protected $fillable = [ //mass assignable
        'PARTY_ID',
        'CONTACT_MECH_ID',
        'FROM_DATE',
        'THRU_DATE',  
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
