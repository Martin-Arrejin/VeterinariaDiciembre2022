@extends('layouts.plantillaBase2') 

@section('contenido')


    <h2 id = tituloVista >Vista Articulo</h2>
       <div class="mb-3">
            <label for="" class="form-label">Codigo Articulo</label>
            <input id="codigo" name="codigo" type="text" class="form-control" tabindex="2" value ="{{$articulos->codigo}}" Disabled >
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Descripcion</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" value ="{{$articulos->descripcion}}" tabindex="3" Disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Marca</label>
            <input id="marca" name="marca" type="text" class="form-control" value ="{{$articulos->marca}}" tabindex="2" Disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Precio Especial</label>
            <input id="precioEspecial" name="precioEspecial" type="text" class="form-control" value ="{{$articulos->precioEspecial}}" tabindex="5"  Disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Precio Venta</label>
            <input id="precioVenta" name="precioVenta" type="text" class="form-control" value ="{{$articulos->precioVenta}}" tabindex="5" Disabled>
        </div>
        
		    <div class="mb-3">
            <label for="" class="form-label">Alerta</label>
            <input id="Alerta" name="Alerta" type="text" class="form-control" value ="{{$articulos->alerta}}" tabindex="5" Disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Minimo Stock</label>
            <input id="MinimoStock" name="MinimoStock" type="text" class="form-control" value ="{{$articulos->minimoStock}}" tabindex="5" Disabled>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Iva</label>
            <input id="Iva" name="Iva" type="text" class="form-control" value ="  {{$articulos->iva}}" tabindex="5" Disabled>
        </div>
        
        <div class="form-label">categoria </div>
        <input id="categoria" name="categoria" type="text" class="form-control" value ="  {{$articulos->categoria->descripcion}}" tabindex="5" Disabled>
      
          <br></br>
      <div id= blockEditar>
        <a href="/articulos" id = "atras"class="btn btn-secondary" tabindex="6">Atras</a>
      </div>
    </form>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



@endsection        
