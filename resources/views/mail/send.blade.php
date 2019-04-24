<html>
<head>
<meta content="text/html; charset=ISO-8859-1"
http-equiv="content-type">
<title></title>
</head>
<body>
<div style="margin-left: 40px;"><h1>Sorties Parapangue</h1><br>

envoi email aux différents participants<BR><BR>

<?php
$text='';$virgule='';

                  $x=1;
                  echo '<BR> <b>';
                  $title= Date::parse($sors->dat)->format('l j F  ').' / sortie '.$sors->typ;
                  echo $title;
                  echo'<BR></b>';

                  $comment=$sors->comment_sor;
                  $n=$sors->id;
  $text=$text. '<table style="text-align: left; width: 1100PX; height: 25px;" border="0"
    cellpadding="2" cellspacing="2">
    <tbody>';
 foreach($particips as $particip)
        {
        if($particip->sor_id==$n)
            {


             $text=$text. '<tr>
                  <td style="width: 60px;">';
             $text=$text. '</td>
                  <td style="width: 210px;"><font color="white"> </font>';
                  if ($x > 8){$text=$text.  '<font color="blue">'; }
                  $text=$text.  $x." ".$particip->firstname.' '.$particip->name.'</td>
                  <td style="width: 220px;">';
                  if ($x > 8){$text=$text.  '<font color="blue">'; }
                  $text=$text.  '<FONT size="2pt"> tel :'. $particip->tel.' </td>
                  <td style="width: 200px;">';
                   if ($x > 8){$text=$text.  '<font color="blue">'; }
                 $text=$text.  '<FONT size="2pt"> inscr. :'.Date::parse($particip->inscription)->format(' j F  h:m').'</font></td>
                  <td style="width: 400px;">';
                 if ($x > 8){$text=$text.  '<font color="blue">'; }
                  $text=$text.  '<FONT size="2pt">'.$particip->comment_particip.' </td>
                  </tr>' ;
                  if ($x > 8){$text=$text.  '</font color>'; }
                  $x=$x+1;
            }
        }
            $text=$text.  ' </tbody>    </table>';
 ?>
             <form class="form-horizontal" method="POST" action="{{ route('send.update', 1) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                                <input  type="hidden"  name="title" value="{{$title}}">
                                <input  type="hidden"  name="id" value="{{$sors->id}}">
                                <input  type="hidden"  name="text" value="{{$text}}">
                               <BR> commentaire modifiable :<BR>
                                <textarea rows = '2' cols = '120'  name="comment" value="{{$comment}}">{{$comment}}</textarea><BR><BR>
Liste des participants
<?php
echo $text;
$text2=$text;




?>
                                <BR><BR><button type="submit" class="btn btn-primary">
                                    envoyer
                                </button>
                                 <a class="btn btn-secondary" href="/particips" role="button">annuler</a>
                                </form>


