<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <title>Laravel</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/app.css" />
    </head>
    <body>
        <div id="app">
            <headers> </headers>
            <div class="container">
                <contacts> </contacts>
                <footers> </footers>
            </div>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
