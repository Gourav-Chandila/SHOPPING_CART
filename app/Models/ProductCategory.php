<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{

    protected $table = 'product_category'; //table name where data inserted
    protected $primaryKey = 'PRODUCT_CATEGORY_ID';
    use HasFactory;
    
    // Define custom column names for timestamps
    public const CREATED_AT = 'CREATED_STAMP';
    public const UPDATED_AT = 'LAST_UPDATED_STAMP';
}
