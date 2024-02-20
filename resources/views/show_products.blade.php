@php
    echo '<pre>';
    // echo json_encode($products, JSON_PRETTY_PRINT);
    echo '</pre>'; 
@endphp

@extends('layouts.app')

@section('title', 'Products')<!-- Adding title name  -->

@section('styles')


    <!-- including create_product _card  file handling card creation -->
    <script src="{{ asset('js/create_product_card.js') }}"></script>

    <!-- including mainSelect color function file -->
    <script src="{{ asset('js/select_main_color.js') }}"></script>

    <!-- including functionCreateRelatedColors function file   -->
    <script src="{{ asset('js/create_related_colors.js') }}"></script>

    <!-- including functionSelectRelatedColors function file   -->
    <script src="{{ asset('js/select_related_color.js') }}"></script>

    <!-- including functionCreateRelatesSizes function file   -->
    <script src="{{ asset('js/created_related_sizes.js') }}"></script>

    <!-- including handle_size_click function file handling size click    -->
    <script src="{{ asset('js/handle_size_click.js') }}"></script>

    {{-- css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">


@endsection

@section('content')
    {{-- Place content  here --}}
    {{-- including navbar --}}
    @include('navbar')

 {{-- <!-- Include the CSRF token -->
 <meta name="csrf-token" content="{{ csrf_token() }}"> --}}


    <!-- Add to cart icon -->
    <div class="cart-icon-container my-5">
        <a href="{{ route('cart') }}" class="cart-link text-decoration-none">
            <i class="bi bi-cart display-4 text-info mt-5 "></i>
            <span id="cartCount" class="badge badge-info ">0</span>
        </a>
    </div>

    <!-- Product card -->
    <div class="container mt-5 ">
        <div class="row container " id="productCards"></div>
    </div>














    <script>
        var jsonData = @json($products);

        // Declare a variable to store the currently selected size element
        var selectedSizeElement = null;
        // Declare a variable to store the currently selected size information
        var selectedSize = {
            product_id_to: null,
            element: null,
            productImage: '',
            productImage: null,
            price: 0
        };

        // Declare an array to store the currently selected size information for each product card
        var selectedSizes = [];

        // Iterate through jsonData objects and create product cards
        var productCardsContainer = $('#productCards');
        Object.values(jsonData).forEach(function(mainProduct, index) {
            var cardHtml = createProductCard(mainProduct, index);
            productCardsContainer.append(cardHtml);
            // function call selectColor handling main color rounded div 
            selectColor(mainProduct, index);
        });
    </script>

@endsection

@section('scripts')
    {{-- bootstrap icon cdn --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- including add_to_cart function file -->
    <script src="{{ asset('js/add_to_cart.js') }}"></script>

@endsection
