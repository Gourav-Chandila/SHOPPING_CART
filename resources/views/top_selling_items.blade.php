<div class="topSellingItemContainer mt-5">
    <div class="container text-center my-3">
        <div class="row justify-content-center">
            <h2>Top <strong>Selling</strong> Items</h2>
        </div>
        <div class="row mx-auto my-auto">
            @foreach ($topSellingItems as $item)
                <div class="col-md-4 col-12">
                    <div class="card card-body card-bg-color mt-5">
                        <img class="img-fluid card-bg-color img-hover" src="{{ asset($item['MEDIUM_IMAGE_URL']) }}"
                            style="width: 260px; height: 260px;">
                    </div>
                    <div class="productDetails">
                        <div class="productName text-dark">{{ $item->PRODUCT_NAME }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
