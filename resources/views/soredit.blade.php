@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Modifier une sortie</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('sors.update', $sor->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                             <label for="dat" class="col-md-4 control-label">date</label>
                            <div class="col-md-6">
                                <input id="dat" type="date" class="form-control" name="dat" value="{{ $sor->dat }}" required autofocus>
                            </div>
                        </div>




                        <div class="form-group">
                            <label for="typ" class="col-md-4 control-label">typ</label>
                            <div class="col-md-6">
                                     <select name="typ" size="7" value="{{ $sor->typ }}" required> >
                                     <option value="{{ $sor->typ }}" selected="selected">{{ $sor->typ }} </option>
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
                                <textarea rows = '10' cols = '80'  value="{{ $sor->comment_sor }}" id="comment_sor" type="comment_sor" class="form-control" name="comment_sor">{{ $sor->comment_sor }}</textarea>
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
