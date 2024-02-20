<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdCatalogCategory extends Model
{
    protected $table = 'prod_catalog_category';

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'PRODUCT_CATEGORY_ID', 'PRODUCT_CATEGORY_ID');
    }
}
