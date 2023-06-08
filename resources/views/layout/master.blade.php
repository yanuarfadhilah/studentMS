<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}} - @yield('page_title')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    @stack('page-js')

    @stack('page-css')
</head>

<body>
    @include('components.navbar')
    <section>
        <div class="p-4 sm:ml-64">
            @yield('content')
        </div>
    </section>
</body>

</html>
