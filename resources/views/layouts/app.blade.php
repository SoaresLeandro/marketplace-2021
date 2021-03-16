<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Marketplace</title>
    
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Marketplace 2021</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                @auth
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item @if(request()->is('admin/home')) active @endif">
                            <a class="nav-link" href="{{ route('admin.home') }}">Home <span class="sr-only">(página atual)</span></a>
                        </li>
                        <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                            <a class="nav-link" href="{{ route('admin.stores.index') }}">Lojas</a>
                        </li>                    
                        <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">Produtos</a>
                        </li>
                        <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                            <a class="nav-link" href="{{ route('admin.categories.index') }}">Categorias</a>
                        </li>
                    </ul>

                    <div class="my-2 my-lg-0">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('.sair').submit();">Sair</a>
                                    <form action="{{ route('logout') }}" class="sair" method="POST" hidden>
                                        @csrf
                                    </form>
                            </li>                        
                        </ul>                   
                    <div>
                @endauth
            </div>
        </div>
    </nav>
    
    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>