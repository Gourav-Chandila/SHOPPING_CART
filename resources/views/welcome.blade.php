@extends('layouts.app')

@section('title', 'Home Page')<!-- Adding title name  -->

@section('styles')
    <!-- Additional styles specific to this view -->
    {{-- including css files --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
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

@endsection
