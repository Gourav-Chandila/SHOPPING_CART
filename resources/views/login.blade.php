@extends('layouts.app')

@section('title', 'Login')<!-- Adding title name  -->

@section('styles')
    <!-- Additional styles specific to this view -->
    {{-- for bootstrap eye icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    {{-- Place content  here --}}
    @include('navbar')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7 border border-dark mt-5">
                <form action="{{ url('/') }}/login" method="post">
                    @csrf
                    <div class="container mt-5">
                        <!-- Display dismissable alert for errors -->
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12">
                                <x-input-controller type="text" name="phonenumber" label="Phone number" />
                                <x-input-controller type="password" name="password" label="Password" />
                            </div>
                        </div>

                        <div class=" row">
                            <div class="col-12">
                                <div class="form-group">
                                    <a href="{{ route('forget_password') }}">Forget password ?</a>
                                    <a href="{{ route('register') }}">Register </a>
                                </div>
                            </div>
                        </div>
                        <div class="row col mb-3">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>





    {{-- @include('footer') --}}
@endsection

@section('scripts')
    <!-- Additional scripts specific to this view -->
    <script src="{{ asset('js/show_password.js') }}"></script>

@endsection
