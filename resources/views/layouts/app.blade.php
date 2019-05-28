<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Parapangue') }}</title>

    <!-- Scripts -->
<script>
function mymessage()
{
alert("- Pour s'incrire à une sortie, il faut être adhérent au club\n- Les sorties coûtent trois tickets, l'inscription est définitive la veille 14H, il sera réclamé les trois tickets aux absents\n- Validation des sorties à partir de cinq inscrits\n- Pierre Killian est responsable navette et sorties :  0692 77 73 58\n- Jacques Aulet gère le listing des membres : 0692 88 09 21\n- Si vous n'avez pas de mot de passe, vous pouvez en obtenir un avec le lien 'pour vous connecter ou obtenir un mot de passe'\n- Appeler Jacques ou Pierre en cas de problème avec le mot de passe");
}
</script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="alert.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ 'Sorties Parapangue' }}
                </a>




                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                   <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link" href="http://www.parapangue.re" role="button">parapangue</a></li>
     <li class="nav-item"> <a class="nav-link" href="/particips" role="button">planning</a></li>
     <li class="nav-item"> <a class="nav-link" href="/partarchive" role="button">archives</a></li>

@if (session('role')=='superadmin')
    <li class="nav-item">  <a class="nav-link" href="/sors" role="button">edit sorties</a></li>
    <li class="nav-item"> <a class="nav-link" href="/userslist" role="button">list utilis.</a></li>
    <li class="nav-item"> <a class="nav-link" href="/users" role="button">modif</a></li>
    <li class="nav-item"> <a class="nav-link" href="/users2" role="button">pass</a></li>
    <li class="nav-item"> <a class="nav-link" href="/importExportView" role="button">import</a></li>
@endif


@if (session('role')=='admin')
    <li class="nav-item">  <a class="nav-link" href="/sors" role="button">edit sorties</a></li>
    <li class="nav-item"> <a class="nav-link" href="/userslist" role="button">liste des utilisateurs</a></li>

@endif


                    </ul>


                  <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->


                        @guest

                            <li class="nav-item">
                               <a class="nav-link" href="{{ route('login') }}">{{ __( 'Pour vous connecter, ou obtenir un mot de passe') }}</a>
                            </li>
                            @if (Route::has('register'))

                                <li class="nav-item">

                                    <a class="nav-link" href="{{ route('register') }}">{{ __('') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{session('firstname').' '.Auth::user()->name.' / '.session('role').'   '}} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

<body>




        <main class="py-4">
            @include('flash-message')
            @yield('content')
        </main>

</html>
