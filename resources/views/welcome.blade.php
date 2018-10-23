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

          <header id="nav">
              <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
                  <a class="navbar-brand mr-5" href="/" style="font-weight:700">GameJam</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <router-link to="/" class="nav-link" active-class="active" exact>Home</router-link>
                      </li>
                        <router-link to="/autre" class="nav-link" active-class="active" exact>Autre</router-link>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                      </li>
                    </ul>
                  </div>
                </nav>
              </div>
          </header>

          <router-view> </router-view>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
