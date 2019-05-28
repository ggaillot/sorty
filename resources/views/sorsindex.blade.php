@extends('layouts.app')
@section('content')

<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=u09gw419us2lohpwyiyh0i094lcjkyc7ffudd5zyz9er9m0x"></script>

<script>
  tinymce.init({
   selector: 'textarea',
     height: 300,
width:900,
  menubar: false,
   plugins: ' link ',
   toolbar: 'bold italic underline forecolor  fontsizeselect| alignleft aligncenter alignright | link removeformat |',
});
</script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><br></div>
                <div class="panel-body">
<h1>Sorties</h1>
<?php
 session(['origine' => 'sors']);
echo '<a href="/sors/create"> nouvelle sortie</a> ';

      foreach ($sors as $sor)
      {

                    echo '<br><b> Sortie '.$sor->typ.' du '.Date::parse($sor->dat)->format(' j F ').'</b><tr> <form  method="POST" action="'.route('sors.update', $sor->id) .'">'. csrf_field() . method_field('PUT') ;
?>
<textarea style="vertical-align: top;" rows = "2" cols = "90" name="comment_sor"   value="{{$sor->comment_sor}}">{{$sor->comment_sor }}</textarea><BR>
                                       <?php echo' <td ><input  type="date" style="width: 150px;"  name="dat" value="'. $sor->dat .'" ></td>

                        <td ><input type="radio" name="typ" value="montagne"';
                        if ($sor->typ=='montagne'){echo 'checked';}
                       echo '>montagne

                        <input type="radio" name="typ" value="encadrée"';
                        if ($sor->typ=='encadrée'){echo 'checked';}
                       echo '>encadrée

                        <input type="radio" name="typ" value="1500"';
                        if ($sor->typ=='1500'){echo 'checked';}
                       echo '>1500

                        <input type="radio" name="typ" value="accompagnée"';
                        if ($sor->typ=='accompagnée'){echo 'checked';}
                       echo '>accompagnée

                        <input type="radio" name="typ" value="sunset"';
                        if ($sor->typ=='sunset'){echo 'checked';}
                       echo '>sunset

                        <input type="radio" name="typ" value="normale"';
                        if ($sor->typ=='normale'){echo 'checked';}
                       echo '>normale

                        </td>



                       <td style="width: 50px vertical-align: top;"><button type="submit" class="btn btn-primary btn-sm">Enregistrer</button></td>
                      <td style="width: 50px vertical-align: top;"><a href="/sors/'.$sor->id.'/destroy"><img src="images/Delete.png" alt="edit"/></a></td>
                    </form>--------------------------------------------------------------------------------------------------------------</tr>';
        ?>



      <?php

      }
      ?>



@endsection
