@extends('layouts.app')

@section('title', 'Home Page')<!-- Adding title name  -->

@section('styles')
    <!-- Additional styles specific to this view -->
@endsection

@section('content')
    {{-- Place content  here --}}
    {{-- including navbar --}}
    @include('navbar')


    {{-- including carousel view --}}
    @include('carousel')


    {{-- including categories_collection view --}}
    @include('categories_collection')

    {{-- including top_selling_items view --}}
    @include('top_selling_items')



    @include('footer')
@endsection

@section('scripts')
    <!-- Additional scripts specific to this view -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

@endsection
