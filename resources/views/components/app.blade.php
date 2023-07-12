<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <style>
            #header {
               background: url('https://images.unsplash.com/photo-1549451371-64aa98a6f660?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8ZXZlbnRzfGVufDB8fDB8fHww&auto=format&fit=crop&w=500&q=60');
               /* background: url('storage/img/banner-img.jpg'); */
               /* background-repeat: no-repeat;
               background-size: cover;
               background-position: center; */
            }
        </style>
</head>
<body class="antialiased">

    <nav class="navbar bg-white shadow">
        <div class="container-fluid">
          <a class="navbar-brand fw-bold text-danger text-uppercase" href="/">
            {{config('app.name')}}
          </a>
        </div>
      </nav>

   <section>
     {{$content}}
   </section>

</body>
</html>
