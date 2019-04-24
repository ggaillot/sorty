@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Supprimer une sortie</h1></div>

                    <form class="form-horizontal" method="POST" action="{{ route('sors.destroy', $sor->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Supprimer la sortie {{ $sor->typ }} du {{  Date::parse($sor->dat)->format('l j F ') }}-
                                </button>
                                 <a class="btn btn-primary" href="/sors" role="button">annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
