<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        @vite(['resources/css/app.css'])
    </head>

    <header>
        <p class="text-xl">teste</p>
    </header>

    {{-- Conteúdo principal da página --}}
    <body>
        @yield('content')
    </body>

    <footer>
        <p class="">rodape</p>
    </footer>
