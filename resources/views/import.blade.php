@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card bg-light mt-3">
        <div class="card-header">
            <H2>Import Export données membres Parapangue</H2><br>
          <b>  Import</b> entêtes de colonnes 'name','firstname', 'tel' , 'email' , 'role' (membre ou admin) , 'ajour' (1 ou 0)
            <br>format csv, xls, xslx, ods
            <br>
          <b>  Export</b> format xlsx
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="file">Sélectionner le fichier à importer (xls, ods, csv)</label>
                <input type="file" name="file" class="form-control" >
                <br>
                <button class="btn btn-success">Import </button>
                <a class="btn btn-warning" href="{{ route('export') }}">Export </a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
@endsection
