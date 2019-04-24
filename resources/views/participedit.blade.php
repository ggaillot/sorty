@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Modifier une participation<br><br></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('particips.update', $particip->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

Participant : {{ $user->firstname."  ".$user->name}} <br>
Date de la sortie : {{ Date::parse($sor2->dat)->format('l j F Y ')."  / sortie :".$sor2->typ }} <br>
Date d'incription : {{ Date::parse($particip->inscription)->format('l j F Y H:i:s')}}<br><br><br>
<?php if (session('role')=='admin')
{
?>
Une nouvelle date d'inscription implique un nouvel ordre de priorité dépendant de cette date<br>
à utiliser pour changer l'ordre des priorités, <br>par exemple : encadrant, débutants dans une sortie encadrée, ...
<br><br><h4>Changer la date d'inscription</h4>

                        <div class="form-group">
                            <div class="col-md-6">
                                <input id="participation_id" type="date" class="form-control" name="inscription"
                                value="{{ Carbon\Carbon::parse($particip->inscription)->format('Y-m-d')}}">

                            </div>
                        </div>
<?php
}
?>
<h4>Modifier le commentaire du participant</h4>
                        <div class="form-group">

                            <div class="col-md-6">
                                <textarea rows = '2' cols = '80' id="comment_particip" type="comment_particip" class="form-control" name="comment_particip"></textarea>
                            </div>
                        </div>

                                <button type="submit" class="btn btn-primary">
                                    enregistrer
                                </button>
                                 <a class="btn btn-secondary" href="/particips" role="button">annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
                                    {{ Carbon\Carbon::now()->locale('fr_FR')->timezone('+04:00')->isoFormat('LLLL')}}
</div>

@endsection
