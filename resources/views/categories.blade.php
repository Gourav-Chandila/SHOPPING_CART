@extends('layouts.app')

@section('title', 'Categories') <!-- Adding title name -->

@section('styles')
    <!-- Additional styles specific to this view -->
@endsection

@section('content')
    {{-- Place content  here --}}
    @include('navbar')

    <div class="container-fluid mt-5">
        <div class="row justify-content-center p-4">
            <h2 class="h2 text-center">CATEGORIES COLLECTION</h2>
        </div>

        <div class="row">
            @foreach ($categoriesType as $category)
                <div class="col-md-4 col-sm-6 col-12 mb-3">
                    <div class="card h-100">
                        <img class="card-img-top img-fluid"
                            src="{{ asset($category->productCategory['CATEGORY_IMAGE_URL']) }}"
                            alt="{{ $category->productCategory['CATEGORY_NAME'] }}">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $category->productCategory['CATEGORY_NAME'] }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('footer')
@endsection

@section('scripts')
    <!-- Additional scripts specific to this view -->
@endsection
