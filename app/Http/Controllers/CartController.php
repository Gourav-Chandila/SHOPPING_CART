<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function updateCart(Request $request)
    {


        // Update the selected products in the session
        if ($request->has('selectedProducts') && $request->has('cartCount')) {
            // Decode the JSON string to an array
            $selectedProducts = json_decode($request->input('selectedProducts'), true);
            // Update the cartCount in the session
            $request->session()->put('selectedProducts', $selectedProducts);
            // Update the selectedProducts in the session
            $request->session()->put('cartCount', $request->input('cartCount'));
        }

        // Check if 'cartCount' is set in the session before accessing it
        $cartCount = $request->session()->has('cartCount') ? $request->session()->get('cartCount') : 0;
        $selectedProducts = $request->session()->has('selectedProducts') ? $request->session()->get('selectedProducts') : null;

        // Return the cart view with both sets of data
        return view('cart', [
            'selectedProducts' => $selectedProducts,
            'cartCount' => $cartCount,
        ]);
    }


    public function removeItem(Request $request)
    {
        // Logic to remove item from the cart
        $product_id_to = $request->query('product_id_to');
        Log::warning('product id to is: ' . $product_id_to);


        // Retrieve the session data
        $selectedProducts = session('selectedProducts');
        Log::warning('Before unset session: ' . json_encode($selectedProducts));

        if ($selectedProducts) {
            // Iterate through the products array using key-value pairs
            foreach ($selectedProducts as $key => $product) {
                // Check if the current product matches the specified product_id_to
                if ($product['product_id_to'] === 'W_SH_FR_200_1') {
                    // Remove the product from the array using the key
                    unset($selectedProducts[$key]);
                }
            }

            // Update the session data with the modified array
            session(['selectedProducts' => $selectedProducts]);
            Log::warning('After unset session: ' . json_encode($selectedProducts));
        }



    }

}

