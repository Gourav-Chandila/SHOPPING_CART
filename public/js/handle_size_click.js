        // Function for handling size
        function handleSizeClick(element, size, productImage, price, product_id_to, index) {
            var productPriceElement = document.getElementById(`productPrice${index}`);
            console.log(productPriceElement);

            // Log the clicked size, color with price, and size product image
            // console.log(`Clicked size is: ${size}`);
            // console.log(`Product id to: ${product_id_to}`);
            // console.log(`Color with price: ${price}`);
            // console.log(`Size product image is: ${productImage}`);

            // Remove border style from the previously selected size element
            if (selectedSizes[index] && selectedSizes[index].element) {
                selectedSizes[index].element.style.border = '1px solid #e4e6eb';
            }

            // Set the border style to the clicked size element
            element.style.border = '1.5px solid red';

            // Update the currently selected size information for this product card
            selectedSizes[index] = {
                product_id_to: product_id_to,
                element: element,
                productImage: productImage,
                size: size,
                price: price
            };

            // Set the related size default_price
            productPriceElement.innerHTML = `Price: ${price}`;
        }

