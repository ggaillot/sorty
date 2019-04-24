@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <?php

        ?>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Supprimer une participation</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('particips.destroy', $particip->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

 {{session('firstname')}}   {{session('name')}}     /     sortie {{$sors->typ}} du {{  Date::parse($sors->dat)->format('l j F ') }}
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Supprimer la participation
                                </button>
                                <a class="btn btn-primary" href="/particips" role="button">annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
