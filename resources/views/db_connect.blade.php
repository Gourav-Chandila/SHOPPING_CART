<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>db connect</title>
</head>

<body>
    @php
        use Illuminate\Support\Facades\DB;
        try {
            DB::connection()->getPdo();
            echo 'Successfully connected to Database and database  name is ' . DB::connection()->getDatabaseName();
        } catch (\Exception $e) {
            die('Could not connect to the database. Error: ' . $e->getMessage());
        }

    @endphp
</body>

</html>
