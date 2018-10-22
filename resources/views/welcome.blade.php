<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">

        <title>GameJam</title>

    </head>
    <body>

        <div id="app">
          <router-link to="/" exact>Home</router-link>
          <router-link to="/autre" exact>Autre</router-link>

          <router-view> </router-view>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
