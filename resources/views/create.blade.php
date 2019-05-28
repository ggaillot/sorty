@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Créer un utilisateur (invité)

<?php
if (session('role')=='superadmin') { echo ' ou membre';}
?>

                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('users.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Nom</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>
                                                <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Prénom</label>
                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="tel" class="col-md-4 control-label">tel</label>
                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control" name="tel" value="--" required>
                            </div>
                        </div>
<input id="statut" type="hidden" class="form-control" name="statut" value="3">
<input id="password" type="hidden" class="form-control" name="password" value="Ftep24ffQAZ">

<?php
if (session('role')=='superadmin') {

   echo' cotisation à jour :  <input type="radio" name="ajour" value=0 checked > non <input type="radio" name="ajour" value=1>oui<br>';
   echo' role :  <input type="radio" name="role" value="invité" checked > invité   /   <input type="radio" name="role" value="membre">membre';
    }
    else
    {
    echo ' <input id="email" type="hidden" class="form-control" name="role" value="invité">
           <input id="ajour" type="hidden" class="form-control" name="ajour" value=0>';
    }



?><br><br><br>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
