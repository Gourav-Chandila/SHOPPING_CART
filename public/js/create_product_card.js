function createProductCard(mainProduct, index) {
    // This will create related colors of main product and shows ${relatedBackgroundRoundedDivs} this right side of main color
    var relatedBackgroundRoundedDivs = createRelatedBackgroundElements(mainProduct.RELATED_PRODUCTS, mainProduct
        .MAIN_PRODUCT_ID, index);

    var cardHtml = `
    <div class="col-md-4 mt-5">
       <div class="card   border border-dark custom-card">
           <div class="image-container" style="height: 400px; overflow: hidden;">
               <img id="productImage${index}" class="img-fluid" style="height: 100%; width: 100%;" src="${mainProduct.PRODUCT_IMAGE}">
           </div>
   
           <div class="card-body">
               <h5 id="productName${index}" class="card-title productTitle">${mainProduct.PRODUCT_NAME}</h5>
   
               <div id="mainProductColorDiv_${index}" class="rounded-circle d-inline-block mr-1 p-2 border border-secondary main-color"
                    style="background-color: ${mainProduct.DESCRIPTION}; width: 20px; height: 20px;"></div>
   
               ${relatedBackgroundRoundedDivs}
               <div id="size-div-${mainProduct.MAIN_PRODUCT_ID}"></div>
               <p id="productPrice${index}" class="card-text">Price: ${mainProduct.PRODUCT_PRICE}</p>
               <a href="#" class="btn btn-dark">Buy now</a>
               <a href="#" class="btn btn-dark" onclick="addToCart(${index})">Add to cart</a>
           </div>
       </div>
    </div>
   `;



    return cardHtml; //it return the created card
}