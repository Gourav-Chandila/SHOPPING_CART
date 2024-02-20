<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $concatProductIdTO = $request->query('product_id_to');
        $size = $request->query('size');

        // Remove the size from the concatProductIdTO and store it in another variable
        $productIdTo = str_replace('_' . $size, '', $concatProductIdTO);

        // Retrieve the session data
        $selectedProducts = session('selectedProducts');


        // Call the function
        $this->decrementCartCount();

        if ($selectedProducts) {
            // Iterate through the products array using key-value pairs
            foreach ($selectedProducts as $key => $product) {
                // Check if the current product matches the specified product_id_to
                if ($product['product_id_to'] === $productIdTo && $product['size'] === $size) {
                    // Remove the product from the array using the key
                    unset($selectedProducts[$key]);
                }
            }

            // Update the session data with the modified array
            session(['selectedProducts' => $selectedProducts]);

            // Return a success response
            return response()->json(['success' => true]);
        }

        // Return a failure response if the item was not found or could not be removed
        return response()->json(['success' => false]);
    }




    function decrementCartCount()
    {
        // Retrieve the cartCount from the session
        $cartCount = session('cartCount');

        // If the cartCount exists and is greater than 0, decrement it by 1
        if ($cartCount && $cartCount > 0) {
            $cartCount--;

            // Update the session with the new cartCount
            session(['cartCount' => $cartCount]);

            // Log the updated cartCount
            Log::info("Updated cart count is " . $cartCount);
        } else {
            // Log a message indicating that the cart is already empty
            Log::info("Cart is already empty");
        }
    }
}

