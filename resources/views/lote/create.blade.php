@extends('layouts.plantillaBase2')
 

@section('contenido')

<div class="form-group   text-center">
    <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Nuevo Lote</h2>
  
   <div class="row container-fluid d-flex justify-content-center">


    <form action="/Lotes/{{$ArticuloId}}/store" method="POST">
        @csrf
        @method('Post')
        <div class="mb-3">
            <label for="" class="form-label">Cantidad de Unidades</label>
            <input id="unidades" name="unidades" type="number" class="form-control" tabindex="3">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Precio Compra (unidad)</label>
            <input id="precioCompra" name="precioCompra" type="number" class="form-control" tabindex="2">
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">Vencimiento</label>
            <input id="vencimiento" name="vencimiento" type="date" class="form-control" tabindex="5">
        </div>

        <a href="/Lotes/{{$ArticuloId}}/lote" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>



</body>

@endsection