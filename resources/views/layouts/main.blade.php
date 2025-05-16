<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Honda - The Power of Dreams</title> <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('images/honda-symbol.png') }}" type="image/svg+xml">
</head>

<body class="bg-gray-100">
    @include('layouts.header')
    <main>
        @yield('content')
    </main>
    @include('layouts.footer')
    @stack('scripts')
</body>

</html>
