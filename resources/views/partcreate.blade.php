@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading">Nouvelle participation pour  {{Auth::user()->firstname."  ".Auth::user()->name}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('particips.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="" class="col-md-8 control-label"> </label>

                            <div class="col-md-8">




                            <div class="col-md-8">
                                <input id="user_id" type="hidden" class="form-control"  value= " {{Auth::user()->id}}" name="user_id">
                            </div>



                        <div class="form-group">
                            <label for="" class="col-md-8 control-label"></label>
                            < <div class="col-md-8">
                                <select name="sor_id" id="sor_id" widht="100" class="form-control">
                                    <?php
                                    foreach($sors as $sor)
                                        {
                                            if($particips->where('sor_id',$sor->id)->where('user_id',Auth::user()->id)->count()==0)
                                            {
                                        $date1=$sor->dat;
                                        $date2 =date('d-m-Y', strtotime($date1));
                                        echo '<option value="'. $sor->id .'">'.$date2." ". $sor->typ.'</option>';
                                        }
                                            }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment_particip" class="col-md-8 control-label">Commentaires</label>
                            <div class="col-md-8">
                                <textarea rows = '4' cols = '100' id="comment_particip" type="comment_particip" class="form-control" name="comment_particip"></textarea>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="enregistrer" class="btn btn-primary">
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

