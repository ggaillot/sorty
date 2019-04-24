

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">

<h1>Sorties prochaines & Participants</h1>
<?php

echo '<a href="/partarchive"> archive sorties</a> <br>';
 if (session('role')=='admin') {echo '<a href="/partcreate">      inscription sortie mode admin</a> <br><br>';} else if (session('role')=='membre') {echo '<a href="/particips/create">      inscription sortie</a> <br>';}

            foreach($sors as $sor)
                {
                  $x=1;
                  echo '<BR> <b>';
                  echo Date::parse($sor->dat)->format('l j F  ').' / sortie '.$sor->typ;
                   if (session('role')=='admin') {echo '<a href="send/'.$sor->id.'"> envoi mail</a>';}
                  echo'<BR></b>';
                  echo $sor->comment_sor. ' <BR>';
                  $n=$sor->id;?>
<table style="text-align: left; width: 1100PX; height: 25px;" border="0"
cellpadding="2" cellspacing="2">
<tbody>

        <?php foreach($particips as $particip)
        {
        if($particip->sor_id==$n)
            {

             echo'<tr>
                  <td style="width: 60px;">';

             if (session('role')=='admin') { echo'<a href="/particips/'.$particip->participsid.'/destroy"><img src="images/Delete.png" alt="edit"/></a>-<a href="/particips/'.$particip->participsid.'/edit"><img src="images/Edit.png" alt="edit"/></a>';}else{echo' ';}
              if (session('role')=='membre' and session('id')==$particip->user_id)  { echo'<a href="/particips/'.$particip->participsid.'/destroy"><img src="images/Delete.png" alt="edit"/></a>-<a href="/particips/'.$particip->participsid.'/edit"><img src="images/Edit.png" alt="edit"/></a>';}else{echo' ';}

             echo'</td>
                  <td style="width: 210px;"><font color="white"> </font>';
                  if ($x > 8){echo '<font color="blue">'; }

                  echo $x." ".$particip->firstname.' '.$particip->name.'</td>
                  <td style="width: 220px;">';
                  if ($x > 8){echo '<font color="blue">'; }
                  echo '<FONT size="2pt"> tel :'. $particip->tel.' </td>
                  <td style="width: 200px;">';
                   if ($x > 8){echo '<font color="blue">'; }
                 echo '<FONT size="2pt"> inscr. :'.Date::parse($particip->inscription)->format(' j F  h:m').'</font></td>
                  <td style="width: 400px;">';
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


<br>-----------------------------------------------------------------------------<br>


@endsection

