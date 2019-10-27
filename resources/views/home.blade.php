<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" type="text/css" href="/css/app.css"/>
    </head>
    <body>
        <script src="{{ mix('js/app.js') }}" defer></script>
        {{-- É necessario sempre colocar nossos componentes dentro dessa div com id app--}}
        <div id='app'>
            <products></products>
        </div>
    </body>
</html>


