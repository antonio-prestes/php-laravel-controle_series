<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <title>Controle de Series</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-light bg-light mb-3 d-flex">
        <div class="container-fluid d-flex ">
            <a class="navbar-brand" href="{{url('/series')}}">
                <img src="https://cdn-icons-png.flaticon.com/512/2111/2111748.png" alt="" width="30" height="30"
                     class="d-inline-block align-text-top">
                Series
            </a>
            <ul class="nav justify-content-end">
                Usuário: {{$user->name}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link">Logout</button>
                </form>
            </ul>
        </div>

    </nav>
    <h3>@yield('title')</h3>
    @yield('content')
</div>
<footer class="container bg-light text-center text-lg-start fixed-bottom">
    <!-- Copyright -->
    <div class="text-center p-2">
        © 2020 Copyright:
        <a class="text-dark" href="https://github.com/antonio-prestes">Diego Prestes</a>
    </div>
    <!-- Copyright -->
</footer>
</body>
</html>
