<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <!-- @yield blade fn --> --}}
    <title>@yield('title')</title>

    <!-- Include Bootstrap CSS from CDN -->
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Bootstrap JavaScript (after jQuery) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        {{-- for bootstrap  icon cdn for eye icon for password  and more --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    @yield('styles')
</head>

<body>
    @yield('content')
    <!-- Scripts -->
    <!-- Other common scripts -->
    @yield('scripts')
</body>

</html>
