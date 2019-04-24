
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">

<h1>Archives sorties & Participants</h1>
<?php

echo '<a href="/"> sorties à venir</a> <br>';
            foreach($sors as $sor)
                {
                  echo'<BR>  <b>';
                  echo Date::parse($sor->dat)->format('l j F  ').' / sortie '.$sor->typ;
                  echo'<BR></b>';
                  echo $sor->comment_sor." <br>";
                  $n=$sor->id;?>

<table style="text-align: left; width: 840px; height: 25px;" border="0"
cellpadding="2" cellspacing="2">
<tbody>

        <?php foreach($particips as $particip)
        {
        if($particip->sor_id==$n)
            {
              if (session('role')=='admin') { echo'<a href="/particips/'.$particip->participsid.'/destroy">supp</a>-<a href="/particips/'.$particip->participsid.'/edit">modif</a>';}else{echo' ';}
             echo '<font color="white"> ------</font>'.$particip->firstname.' '.$particip->name.'<br>';
            }
        }
                }
          ?>


<br>-----------------------------------------------------------------------------<br>


@endsection
