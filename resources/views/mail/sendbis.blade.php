<html>
<head>
<meta content="text/html; charset=ISO-8859-1"
http-equiv="content-type">
<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=u09gw419us2lohpwyiyh0i094lcjkyc7ffudd5zyz9er9m0x"></script>

<script>
  tinymce.init({
   selector: 'textarea',
     height: 500,
width:1100,
  menubar: false,
   plugins: ' advcode casechange formatpainter  lists   mediaembed pageembed permanentpen powerpaste ',
   toolbar: 'undo redo | formatselect | bold italic forecolor backcolor fontselect fontsizeselect| alignleft aligncenter alignright alignjustify |table | removeformat |',
});
</script>
</head>
<body>
  <?php
                  $text='';$virgule=''; $x=1;
                  $title= Date::parse($sors->dat)->format('l j F  ').' / sortie '.$sors->typ;
                  $comment=$sors->comment_sor;
                  $n=$sors->id;
                  session(['origine' => 'send/'.$n]);

$text='<h3>Parapangue<br>'.$title.'</h3>';
$text=$text.'<font color=blue>'.$comment.'<br><br></font><b>Liste des participants</b>';
  $text=$text.'<table style="text-align: left; width: 1100PX; height: 25px;" border="0"
    cellpadding="2" cellspacing="2">
    <tbody>';
 foreach($particips as $particip)
        {
        if($particip->sor_id==$n)
            {

if ($x == 9){$text=$text. "<tr><td><td><u><font color='blue'>Liste d'attente<br></u></tr>"; }
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
                 $text=$text.  '<FONT size="2pt"> inscr. :'.Date::parse($particip->inscription)->format(' j F ').'</font></td>
                  <td style="width: 400px;">';
                 if ($x > 8){$text=$text.  '<font color="blue">'; }
                  $text=$text.  '<FONT size="2pt">'.$particip->comment_particip.' </td>
                  </tr>' ;
                  if ($x > 8){$text=$text.  ''; }
                  $x=$x+1;
            }
        }
            $text=$text.  " </tbody>    </table>

<div style='margin-left: 40px;'><br>
Ce courriel est automatique et est envoyé aux différents participants, depuis le site parapangue.re<br>
-> vous pouvez échanger entre vous pour préparer cette sortie, les emails des participants sont dans l'entête du courriel<br>
-> accès au planning par le menu 'planning sorties' du site http://parapangue.re ou <br>
-> directement par http://sorties.16mb.com<br>
<br>
INFOS : <br>
-> le planning est définitif à H-24,<br>
-> la participation financière à la sortie sera due en cas d'abscence (cf décision du cd)<br>
-> le tel de Pierre Killian : 0692 77 73 58<br>
-> le tel de Franck, notre chauffeur : 0692 92 24 32<br><br></font></div>
";

//composants du mail
session(['text' => $text]); ?>
             <form class="form-horizontal" method="POST" action="{{ route('send.update', 1) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
<textarea style="vertical-align: top;" rows = "5" cols = "90" name="commentmail"  >{{$text}}</textarea>
                                <input  type="hidden"  name="title" value="{{$title}}">
                                <input  type="hidden"  name="id" value="{{$sors->id}}">
                                <input  type="hidden"  name="text" value="{{$text}}">

                                <button type="submit" class="btn btn-primary">
                                    envoyer le courriel
                                </button>
                                 <a class="btn btn-secondary" href="/particips" role="button">annuler</a>
                                </form>


