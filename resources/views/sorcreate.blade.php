@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Créer une sortie</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('sors.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">date</label>
                            <div class="col-md-6">
                                <input id="dat" type="date" class="form-control" name="dat" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="typ" class="col-md-4 control-label">typ</label>
                            <div class="col-md-6">
                                <select name="typ" size="7" >
                                     <option value=""selected="selected">choisir un type de sortie</option>
                                     <option value="normale">normale</option>
                                     <option value="encadrée" >encadrée</option>
                                     <option value="accompagnée">accompagnée</option>
                                     <option value="montagne">montagne</option>
                                     <option value="1500" >1500</option>
                                     <option value="sunset">sunset</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment" class="col-md-4 control-label">Commentaire</label>
                            <div class="col-md-6">
                                <textarea rows = '10' cols = '80' id="comment_sor" type="comment_sor" class="form-control" name="comment_sor"></textarea>
                            </div>
                        </div>
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
