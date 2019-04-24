@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nouvelle participation mode administrateur</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('particips.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">utilisateur</label>
                            {{Auth::user()->id." auth ".Auth::user()->name." / "}}
                            < <div class="col-md-6">

                                <select name="user_id" id="user_id" class="form-control">
                                    <?php
                                    foreach($users as $user)
                                        {
                                        echo '<option value="'. $user->id ;
                                            if ($user->id==Auth::user()->id){
                                                echo '" selected="selected" >'.$user->name." ". $user->firstname.'</option>';
                                            }
                                            else{
                                                echo'">'.$user->name." ". $user->firstname.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <!--<input id="dat" type="text" class="form-control" name="sor_id" required autofocus>
                                -->
                            </div>
                        </div>

<br>








                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">sorties</label>
                            < <div class="col-md-6">
                                <select name="sor_id" id="sor_id" class="form-control">
                                    <?php
                                    foreach($sors as $sor)
                                        {
                                        $date1=$sor->dat;
                                        $date2 =date('d-m-Y', strtotime($date1));
                                        echo '<option value="'. $sor->id .'">'.$date2." ". $sor->typ.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="comment_particip" class="col-md-4 control-label">Commentaires</label>
                            <div class="col-md-6">
                                <textarea rows = '10' cols = '80' id="comment_particip" type="comment_particip" class="form-control" name="comment_particip"></textarea>
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
