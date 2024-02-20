<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';

    public function prodCatalogCategories()
    {
        return $this->hasMany(ProdCatalogCategory::class, 'PRODUCT_CATEGORY_ID', 'PRODUCT_CATEGORY_ID');
    }
}
