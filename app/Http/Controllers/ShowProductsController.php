<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Services\ProductService;



class ShowProductsController extends Controller
{
    
    public function productsData(Request $request, ProductService $productService)
    {
        // Retrieve the value of the 'for' url query parameter
        $for = $request->input('for');

        //calling getProductJson() from ProductService and $for . '%' eg 'MN_SH_SP%'
        $productsData = $productService->getProductJson($for . '%');
        $cartCount = session('cartCount');
        // Return the products view with the product data
        return view('show_products', [
            'products' => $productsData,
            'cartCount' => $cartCount

        ]);
    }
}

