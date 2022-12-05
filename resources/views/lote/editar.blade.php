@extends('layouts.plantillaBase2')
 

@section('contenido')
<body>
 <div class="caja_tabla-2">
 
  
  <div class="form-group text-center">
   
    <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Editar Lote</h2>

    <form action="{{route('lotes.update',$lote->id )}}" method="POST">
        @csrf
        @method('Put')
        <div class="mb-3">
            <label for="" class="form-label">unidades</label>
            <input id="unidades" name="unidades" type="text" class="form-control" value ='{{$lote->unidad}}' tabindex="3">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Precio Compra</label>
            <input id="precioCompra" name="precioCompra" type="text" class="form-control" value ='{{$lote->precioCompra}}'tabindex="2">
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">Vencimiento</label>
            <input id="vencimiento" name="vencimiento" type="date" class="form-control" value ='{{$lote->vencimiento}}' tabindex="5">
        </div>

        <a href="/Lotes/{{$lote->articulo_id}}/lote" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>



</body>

@endsection