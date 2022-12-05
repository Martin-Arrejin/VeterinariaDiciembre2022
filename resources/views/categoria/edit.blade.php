@extends('layouts.plantillaBase2')

<style>
    .form-group{
        background-color: rgba(255, 52, 11) !important;
        margin: 0px;
        width:auto;
        height: auto;
        
    }
    .form-label{
       color:#ffffff;
    }
    </style>


@section('contenido')


<div class="form-group text-center">
    <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Editar categoría</h2>
   
    <div class="row container-fluid d-flex justify-content-center">


    <form action="/categorias/{{$categoria->id}}" method="POST">
        @csrf
		@method('Put')
        
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" value ="{{$categoria->descripcion}}"class="form-control" tabindex="3">
        </div>
        <a href="/categorias" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>


    



</body>

@endsection  