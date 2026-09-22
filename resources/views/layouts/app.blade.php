<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', config('app.name'))</title>
    </head>

    <body>
        @include('partials.navbar')

        @yield('content')

        @stack('scripts')

        @include('partials.footer')

    </body>
</html>




