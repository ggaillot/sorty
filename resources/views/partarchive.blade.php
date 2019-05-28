
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
 session(['origine' => 'partarchive']);
echo '<a href="/"> sorties à venir</a> <br>';
            foreach($sors as $sor)
                {$x=0;
                  echo'<BR>  <b>';
                  echo Date::parse($sor->dat)->format('l j F  ').' / sortie '.$sor->typ;
                  if (session('role')=='admin' or session('role')=='superadmin') {echo ' </b>- <a href="/sors/'.$sor->id.'/edit"> modif sortie</a>';}
                  echo'<BR></b>';
                  echo $sor->comment_sor." <br>";
                  $n=$sor->id;?>

<table style="text-align: left; width: 840px; height: 25px;" border="0"
cellpadding="2" cellspacing="2">
<tbody>

        <?php foreach($particips as $particip)
        {
        if($particip->sor_id==$n)
            {$x=$x+1;
              //if (session('role')=='admin' or session('role')=='superadmin') { echo'<a href="/particips/'.$particip->participsid.'/destroy">supp</a>-<a href="/particips/'.$particip->participsid.'/edit">modif</a>';}else{echo' ';}
              if ((session('role')=='admin' or session('role')=='superadmin')and $x<9) { echo'<a href="/particips/'.$particip->participsid.'/destroy"><img src="images/Delete.png" alt="edit"/></a>-<a href="/particips/'.$particip->participsid.'/edit"><img src="images/Edit.png" alt="edit"/></a>';}else{echo' ';}
              if ((session('role')=='membre' and session('id')==$particip->user_id)and $x<9)  {
               // echo'<a href="/particips/'.$particip->participsid.'/destroy"><img src="images/Delete.png" alt="edit"/></a>';
                echo '-<a href="/particips/'.$particip->participsid.'/edit"><img src="images/Edit.png" alt="edit"/></a>';}


            if($x<9){ echo '<font color="white"> ------</font>'.$particip->firstname.' '.$particip->name.'<br>';}
            }
        }
                }
          ?>


<br>


@endsection
