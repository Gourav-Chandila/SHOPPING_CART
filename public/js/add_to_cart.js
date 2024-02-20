var cartCountElement = document.getElementById('cartCount');
var cartCount = 0; // Initial cart count
var selectedProducts = []; // Array to hold selected products

// addToCart function to use the selected size product image and details
function addToCart(index) {
    // Get the selected size information for this product card
    var selectedSize = selectedSizes[index];

    // Create an object representing the selected product
    var selectedProduct = {
        product_id_to: selectedSize.product_id_to,
        productImage: selectedSize.productImage,
        productName: document.getElementById(`productName${index}`).innerText,
        size: selectedSize.element.innerText,
        price: selectedSize.price,
        quantity: 1 // set quantity by default to 1 
    };

    // Push the selected product to the array
    selectedProducts.push(selectedProduct);
    // Update the cart count
    cartCount++;
    // Update the cart count in the UI
    cartCountElement.innerHTML = cartCount;

    // Send an AJAX request to update cartCount and selectedProducts on the server
    $.ajax({
        type: 'POST',
        url: '/update-cart',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            cartCount: cartCount,
            selectedProducts: JSON.stringify(selectedProducts)
        },
        success: function (response) {
            console.log('Cart count and selected products updated on the server.');
        },
        error: function (error) {
            console.error('Error updating cart count and selected products:', error);
        }
    });

    console.log(`Product at card index ${index} added to the cart.`);
    return selectedSize.product_id_to;
}
