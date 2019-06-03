

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">

<h1>Sorties prochaines & Participants</h1>
<?php
 session(['origine' => 'index']);
//
 if (session('role')=='admin' or session('role')=='superadmin') {echo '<a href="/partcreate">      inscription sortie mode admin</a> <br><br>';} else if (session('role')=='membre') {echo '<a href="/particips/create">      inscription sortie</a> ';}
echo '<input type="button" onclick="mymessage()" value="Infos Sorties" title="Infos Sorties">';echo '<a href="/partarchive"> archive sorties</a> <br>';

            foreach($sors as $sor)
                {
                  $x=1;
                  echo '<BR> <b>';
                  echo Date::parse($sor->dat)->format('l j F  ').' / sortie '.$sor->typ;
                   if (session('role')=='admin' or session('role')=='superadmin') {echo ' </b>- <a href="/sors/'.$sor->id.'/edit"> modif sortie</a>';
                   echo ' - <a href="send/'.$sor->id.'"> envoi mail</a> -';
if ($sor->email<>0){echo ' <FONT size="1pt">email envoyé par '.$sor->autemail.' le '. Date::parse($sor->datemail)->format('j M  ').'</font>';}

                 }
                  echo'</b>';
                  echo $sor->comment_sor. ' ';
                  $n=$sor->id;?>
<table style="text-align: left;  height: 25px;" border="0"
cellpadding="0" cellspacing="0">
<tbody>

        <?php


        foreach($particips as $particip)
        {

        if($particip->sor_id==$n)
            {
if ($x == 9){echo "<tr><td style='width: 50px;'></td><td><u><font color='blue'>Liste d'attente<br></u></tr>"; }
             echo'<tr>';

             if (session('role')=='admin' or session('role')=='superadmin' or (session('role')=='membre' and session('id')==$particip->user_id)) {
              echo'<td style="width: 80px;"><a href="/particips/'.$particip->participsid.'/destroy"><img src="images/Delete.png" alt="edit"/></a>-';

              echo'<a href="/particips/'.$particip->participsid.'/edit"><img src="images/Edit.png" alt="edit"/></a>';}else{echo'<td style="width: 80px;">';}
         //     if (session('role')=='membre' and session('id')==$particip->user_id)  { echo'<td style="width: 50px;"><a href="/particips/'.$particip->participsid.'/destroy"><img src="images/Delete.png" alt="edit"/></a>-<a href="/particips/'.$particip->participsid.'/edit"><img src="images/Edit.png" alt="edit"/></a>';}else{echo'<td style="width: 50px;"> ';}

                  echo'</td>
                  <td style="width: 300px;"><font color="white"> </font>';
                  if ($x > 8){echo '<font color="blue">'; }

                  echo $x." ".$particip->firstname.' '.$particip->name;if ($particip->role=='invité'){echo' (invité)';}
                  echo '</td>';
              if (session('role')<>null){
                  echo '<td style="width: 200px;">';
                  if ($x > 8){echo '<font color="blue">'; }
                  echo '<FONT size="2pt">-'. $particip->tel.'- </td>
                  <td style="width: 180px;">';
                   if ($x > 8){echo '<font color="blue">'; }
                 if (session('role')=='admin' or session('role')=='superadmin') { echo '<FONT size="2pt"> '.Date::parse($particip->inscription)->format(' j M ').'</font></td>';}
                                         }
                 echo'<td style="width: 400px;">';
                 if ($x > 8){echo '<font color="blue">'; }
                  echo '<FONT size="2pt">'.$particip->comment_particip.' </td>

                  </tr>' ;
                  if ($x > 8){echo '</font color>'; }
                  $x=$x+1;
            }
        }
            echo ' </tbody>    </table>';
                }
          ?>


<br>


@endsection

