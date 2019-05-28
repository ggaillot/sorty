@extends('layouts.app')

@section('content')
<div class="container">
 <?php if (session('role')<>'superadmin' and session('role')<>'admin'){return Redirect::to('/')->with('error', 'accès non autorisé');} ?>
    <div class="card bg-light mt-3">
        <div class="card-header">
            <H2><b>Import Export données membres Parapangue</H2></b><br>
        <?php  if (session('role')=='superadmin'){ ?>  <b>  Import</b> entêtes de colonnes (sans accent) : 'nom','prenom', 'tel' , 'email'
            <br>format  xls, xslx, ods -->> 1 seule feuille / pas de case vide dans la colonne 'email'            <br>
          <b>  Export</b> format xlsx
        </div>
        <div class="card-body">


            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="file">Sélectionner le fichier à importer (xls, ods, csv)</label>
                <input type="file" name="file" class="form-control" >
                <br>
                <button class="btn btn-success">Import </button>  <?php   }  ?>
                <a class="btn btn-warning" href="{{ route('export') }}">Export </a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
@endsection
