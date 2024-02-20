<?php
namespace App\Http\Controllers;

use App\Models\ProdCatalogCategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function showCategories(Request $request)
    {
        // Retrieve the value of the 'for' url query parameter
        $for = $request->input('for');
        //Join query between product_category and prod_catalog_category
        $catalogId = 'ShoesCatalog';
        $categoriesType = ProdCatalogCategory::join('product_category', 'prod_catalog_category.PRODUCT_CATEGORY_ID', '=', 'product_category.PRODUCT_CATEGORY_ID')
            ->where('prod_catalog_category.PROD_CATALOG_ID', $catalogId)
            ->where('prod_catalog_category.PRODUCT_CATEGORY_ID', 'LIKE', $for . '%')
            ->get();

        // Return the categories view with both sets of data
        return view('categories', [
            'categoriesType' => $categoriesType,
        ]);
    }
}