 
function selectRelatedColor(productName, mainProductId, productImage, index, relatedProductIdTo) {
    var productImageElement = document.getElementById(`productImage${index}`);
    var productNameElement = document.getElementById(`productName${index}`);

    // sets Name user clicks on Related color
    productNameElement.innerHTML = productName;
    // sets Image user clicks on Related color
    productImageElement.src = `${productImage}`;
    
    console.log("Related colors "+productImage);
    // console data for debugging
    console.log("Product name is :" + productName);
    console.log("Product id to is :" + relatedProductIdTo);
    console.log("Related image is  :" + productImage);
    console.log("Main product id is  :" + mainProductId);

    // function call to show related color sizes
    let sizeDiv = createRelatedSizesElement(jsonData[mainProductId].RELATED_PRODUCTS, relatedProductIdTo, index)
    // console.log("Size div is  :" + sizeDiv);
    $("#size-div-" + mainProductId).html(sizeDiv)

}