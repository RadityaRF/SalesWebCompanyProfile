<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Toyota - Let's Go Beyond</title> <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('images/toyota_home_logo.svg') }}" type="image/svg+xml">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dyZ88n1Unm4cOZb1aYh0H6Q9z5QmZ8s4v5jvHgBvZ7P5cK8hO1KZz8hT4Jd+L1zX6nYhZG9K+2y1ZJf3C2V4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
