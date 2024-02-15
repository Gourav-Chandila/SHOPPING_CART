<style>



</style>
@php
    // if USER_LOGIN_ID sets in session than loggedin=true else loggedin=false
    $loggedin = Session::has('PARTY_ID');
@endphp

@if ($loggedin)
    {{-- if user is  logged in then show this navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: rgba(0, 0, 0, 0.3);">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="nav-link" href="{{ url('/') }}">
                <strong class="text-glow"style="color: white; font-size: 20px;">Shopping Cart</strong>
                </strong>
            </a>


            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-glow" href="{{ url('/') }}">
                            Welcome: {{ Session::get('FIRST_NAME') }} {{ Session::get('LAST_NAME') }}
                        </a>
                    </li>
                    {{-- Conditionally display the separator only on larger screens --}}
                    <li class="nav-item d-none d-lg-block">
                        <span class="nav-link">||</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-glow" href="{{ route('logout') }}">Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
@else
    {{-- if user is not logged in then show this navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top ">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="{{ url('/') }}">
                <strong class="" style="color: white; font-size: 25px;">Shopping Cart</strong>
            </a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('register') }}">Register</a>
                    </li>

            </div>
        </div>
    </nav>
@endif
