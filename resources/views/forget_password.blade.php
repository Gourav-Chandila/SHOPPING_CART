@extends('layouts.app')

@section('title', 'Forget password')<!-- Adding title name  -->

@section('styles')
    <!-- Additional styles specific to this view -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    {{-- for bootstrap eye icon --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
@endsection

{{-- Place content  here --}}
@section('content')
    @include('navbar')
    {{-- if success reset password than show success alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show my-5" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            // After 2 seconds, redirect to the login page
            setTimeout(function() {
                window.location.href = "{{ route('login') }}"; 
            }, 2000);
        </script>
    @endif

    {{-- if any error occur than show alert --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show my-5" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form method="post" enctype="multipart/form-data" action="{{ url('/forget_password') }}">
        @csrf
        <div class="container mt-5">
            <div class="row">
                <!-- Left Side (col-5) -->
                <div class="col-md-5 mt-3">
                    <x-input-controller type="text" name="phonenumber" label="Phone number" />
                    <x-input-controller type="password" name="password" label="New password" />
                </div>
            </div>

            <div class="row">
                <button class="btn btn-primary  ml-3 mt-2 px-3 py-1">Reset</button>
            </div>
    </form>

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


    <script src="{{ asset('js/show_password.js') }}"></script>
@endsection
