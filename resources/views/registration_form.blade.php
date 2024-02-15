@extends('layouts.app')

@section('title', 'Registration form')<!-- Adding title name  -->

@section('styles')
    <!-- Additional styles specific to this view -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
@endsection

{{-- Place content  here --}}
@section('content')
    @include('navbar')


    <div class="row justify-content-center mt-5">
        <div class="col-sm-6 col-md-9 border border-dark  my-5">

            <form method="post" enctype="multipart/form-data" action="{{ url('/register') }}">
                @csrf

                <div class="row">
                    <!-- Left Side (col-5) -->
                    <div class="col-md-5 mt-3">
                        <x-input-controller type="text" name="first_name" label="First name*" />
                        <x-input-controller type="text" name="last_name" label="Last Name" />
                        <x-input-controller type="text" name="sec_phonenumber" label="Secondary phone number" />
                        <x-input-controller type="text" name="address1" label="Address1" />
                        <x-input-controller type="text" name="address2" label="Address2" />
                    </div>
                    <div class="col-md-5 mt-3">
                        <x-input-controller type="email" name="emailaddress" label="Email address" />
                        <x-input-controller type="text" name="phonenumber" label="Phone number" />
                        <x-input-controller type="password" name="password" label="Password" />
                        <x-input-controller type="password" name="confirm_password" label="Confirm password" />
                    </div>
                </div>
                <!-- Instagram -->

                <div class="row mb-3">
                    <button class="btn btn-primary  ml-3 mt-2 px-3 py-1">Submit</button>

                    <button type="button" class="btn btn-primary ml-3 mt-2 px-3 py-1" data-toggle="modal"
                        data-target="#myModal">Upload Document <sup>Optional</sup></button>
                </div>

                <x-modal-component id="myModal" title="My Modal" footerBtnName1="Close" footerBtnName2="Save">
                    <!-- Include the component -->
                    <x-upload-component id="adharcard" label="Adhar card : " />
                    <x-upload-component id="pancard" label="Pan card : " />
                </x-modal-component>
            </form>

        </div>
    </div>

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

    <script src="{{ asset('js/show_chosen_file_name.js') }}"></script>
    <script src="{{ asset('js/show_password.js') }}"></script>
@endsection
