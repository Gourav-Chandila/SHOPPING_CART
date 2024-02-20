    
    <!-- Dropdown for categories -->
    <div class="row justify-content-center mt-3">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Select category
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('categories', ['for' => 'MN_SH']) }}">Men</a>
                <a class="dropdown-item" href="{{ route('categories', ['for' => 'W_SH']) }}">Women</a>
            </div>
        </div>
    </div>


    <div class="container-fluid mb-2 border-bottom border-dark">
        <div class="row justify-content-center p-4">
            <h2 class="h2 text-nowrap">CATEGORIES COLLECTION</h2> <!-- Heading for the categories collection -->
        </div>
        <div id="productCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                @foreach ($productCategories->chunk(3) as $index => $chunk)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <!-- Carousel item, activated based on index -->
                        <div class="row">
                            @foreach ($chunk as $category)
                                <div class="col-md-4 col-12">
                                    <div class="card card-body h-100">
                                        <img class="img-fluid card-bg-color product-image"
                                            src="{{ asset($category->productCategory['CATEGORY_IMAGE_URL']) }}"
                                            alt="{{ $category->productCategory['CATEGORY_NAME'] }}">
                                        <!-- Image for the category -->
                                        <a class="btn btn-dark"
                                            href="{{ route('show_products', ['for' => $category->productCategory['PRODUCT_CATEGORY_ID']]) }}">{{ $category->productCategory['CATEGORY_NAME'] }}</a>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Carousel navigation controls -->
            <a class="carousel-control-prev w-auto" href="#productCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle"
                    aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next w-auto" href="#productCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle"
                    aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    {{--  the chunk() method is used to break a collection into smaller chunks,
     which can be useful for processing large datasets more efficiently. 
     The chunk() method iterates over the collection,executing a callback 
     function for each chunk of the specified size. 
     --}}
