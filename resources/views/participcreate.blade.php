@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><b>Nouvelle participation mode administrateur</b> <br> <br></div>
                <div class="panel-body"><a href="/users/create"> creer une fiche 'invité' </a>
                    <form class="form-horizontal" method="POST" action="{{ route('particips.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <font color= "white">--</font>
les passagers biplaces sont inscrits sur le nom du pilote.<br><font color= "white">--</font><br>
                            <label for="" class="col-md-4 control-label"> <b>utilisateur</b> </label>


                              <div class="col-md-6">


                                <select name="user_id" id="user_id" class="form-control">
                                    <?php
                                    foreach($users as $user)
                                        {
                                        echo '<option value="'. $user->id ;
                                            if ($user->id==Auth::user()->id){
                                                echo '" selected="selected" >'.$user->name." ". $user->firstname.'</option>';
                                            }
                                            else{
                                                echo'">'.$user->name." ". $user->firstname;if ($user->role=='invité'){echo'---------(invité)';}
                                                echo '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <!--<input id="dat" type="text" class="form-control" name="sor_id" required autofocus>
                                -->
                            </div>
                        </div>








                        <div class="form-group">
                            <label for="" class="col-md-4 control-label"><b>sorties</b></label>
                              <div class="col-md-6">
                                <select name="sor_id" id="sor_id" class="form-control"  onmouseover="this.size='7';">
                                    <?php
                                    foreach($sors as $sor)
                                        {
                                        $date1=$sor->dat;
                                        $date2 =date('d-m-Y', strtotime($date1));
                                        echo '<option value="'. $sor->id .'">'.$date2." ". $sor->typ.'</option>';
                                        }
                                    ?>
                                </select>
                            </div> <br><font color= "white">--</font>la date d'inscription sera  <br>
  <font color= "white">--</font>- la date d'aujourd'hui pour les membres et  <br>
  <font color= "white">--</font>- à J-4 pour les invités, si la sortie est dans + de 4 j. <br>
                        </div>



                        <div class="form-group">
                            <label for="comment_particip" class="col-md-4 control-label"><b>Commentaires</b></label>
                            <div class="col-md-6">
                                <textarea rows = '2' cols = '80' id="comment_particip" type="comment_particip" class="form-control" name="comment_particip"></textarea>
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
