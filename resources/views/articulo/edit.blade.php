@extends('layouts.plantillaBase2') 

@section('contenido')
<link rel="stylesheet" type="text/css" href="{{asset('estiloArticulo.css')}}"> 


<style>
    .form-group{
        background-color: rgba(255, 52, 11) !important;
        margin: 0px;
        width:300px;
        height: auto;
        
    }
    .form-label{
       color:#ffffff;
    }
    </style>
    @section('contenido')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="form-group   text-center">
        <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Editar</h2>
      
        <div class="row container-fluid d-flex justify-content-center">
            <div class="col-md-6">
           <div class="row">

    <form action="/articulos/{{$articulos->id}}" method="POST" id="formulario" name="formulario">
        @csrf
		@method('Put')
      <!--Grupo codigo -->
  <div class="mb-3">
    <div class="formulario__grupo" id="grupo__codigo" title="Valor númerico único que se va identificar el producto">
      <label for="codigo" class="formulario__label">Codigo*</label>
      <div class="formulario__grupo-input">
      <input type="text" class="form-control formulario__input" id="codigo" name="codigo" value ="{{$articulos->codigo}}" maxlength="8" required>
      <i class="formulario__validacion-estado fas fa-times-circle"></i>
    </div>
        <p class="text-white">*Esta pregunta es obligatoria</p>
        <p class="formulario__input-error">El código solo puede contener valores númericos</p>
    </div>
      
  <!--Grupo Descripcion -->
  <div class="mb-3">
    <div class="formulario__grupo" id="grupo__descripcion">
    <label for="descripcion" class="formulario__label" title="Caracteristicas del producto.Breve descripción del mismo" >Descripcion *</label>
    <div class="formulario__grupo-input">
    <input type="text" class="form-control formulario__input" id="descripcion" name="descripcion" value ="{{$articulos->descripcion}}" maxlength="50" required>
    <i class="formulario__validacion-estado fas fa-times-circle"></i>
</div>
<p class="text-white">*Campo obligatorio</p>
<p class="formulario__input-error">La descripcion puede contener letras y número hasta 50 caracteres</p>
</div>

    <!--Grupo Marca-->
    <div class="mb-3">
        <div class="formulario__grupo" id="grupo__marca">
         <label for="marca" class="formulario__label" title="Empresa a cual pertenece el producto">Marca *</label>
         <div class="formulario__grupo-input">
         <input type="text" class="form-control formulario__input" id="marca" name="marca" value ="{{$articulos->marca}}" maxlength="20" required>
         <i class="formulario__validacion-estado fas fa-times-circle"></i>
       </div>
       <p class="text-white">*Campo obligatorio</p>
       <p class="formulario__input-error">El marca tiene hasta 30 caracteres.Sólo letras y número</p>
     </div>
          <!-- Grupo: Precio Especial !-->
 <div class="mb-3">
    <div class="formulario__grupo" id="grupo__precioEspecial">
        <label for="precioEspecial" class="formulario__label" title="Precio especial con descuento" >Precio especial *</label>
        <div class="formulario__grupo-input">
      <input type="text" class="form-control formulario__input" name="precioEspecial" id="precioEspecial"  maxlength="8" value ="{{$articulos->precioEspecial}}" aria-describedby="addon-wrapping" required>
    <i class="formulario__validacion-estado fas fa-times-circle"></i>
 </div>
 <p class="text-white">*Campo obligatorio</p>
        <p class="formulario__input-error">El precioEspecial solo puede contener números y el maximo son 8 dígitos.</p>
    </div>
<!-- Grupo: Precio Venta-->
<div class="mb-3">
<div class="formulario__grupo" id="grupo__precioVenta">
    <label for="precioVenta" class="formulario__label" title="Precio al público general" >Precio de Venta *</label>
    <div class="formulario__grupo-input">
  <input type="text" class="form-control formulario__input" name="precioVenta" id="precioVenta"  maxlength="8" value ="{{$articulos->precioVenta}}"  aria-describedby="addon-wrapping" required>
<i class="formulario__validacion-estado fas fa-times-circle"></i>
</div>
<p class="text-white">*Campo obligatorio</p>
    <p class="formulario__input-error">El Precio Venta solo puede contener números y el maximo son 8 dígitos.</p>
</div>

    <!-- Grupo: iva-->
    <div class="mb-3">
        <div class="formulario__grupo" id="grupo__iva">
            <label for="iva" class="formulario__label"title="Impuesto de Valor Agregado. Insertar valor númerico " >I.V.A% *</label>
            <div class="formulario__grupo-input">
          <input type="text" class="form-control formulario__input" name="iva" id="iva"  maxlength="2"  value ="{{$articulos->iva}}" aria-describedby="addon-wrapping" required>
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
     </div>
     <p class="text-white ">*Campo obligatorio</p>
            <p class="formulario__input-error">El I.V.A solo puede contener números </p>
        </div>

     <!-- Grupo: minimoStock-->
     <div class="mb-3">
        <div class="formulario__grupo" id="grupo__minimoStock">
            <label for="minimoStock" class="formulario__label" title="valor númerico de referencia para que se active la alerta por falta de stock" ></>Minimo de Stock *</label>
            <div class="formulario__grupo-input">
          <input type="text" class="form-control formulario__input" name="minimoStock" id="minimoStock"  maxlength="3"  value ="{{$articulos->minimoStock}}" aria-describedby="addon-wrapping" required>
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
     </div>
     <p class="text-white">*Campo obligatorio</p>
            <p class="formulario__input-error">El Minimo de Stock solo puede contener números y hasta 3 digitos</p>
        </div>
     <!-- Grupo: alerta-->
     <div class="mb-3">
        <div class="formulario__grupo" id="grupo__alerta">
            <label for="alerta" class="formulario__label" title="Días previos antes del vencimiento del producto para que el sistema lo notifique" >Alerta de Vencimiento*</label>
            <div class="formulario__grupo-input">
          <input type="text" class="form-control formulario__input" name="alerta" id="alerta"  maxlength="3" value ="{{$articulos->alerta}}" aria-describedby="addon-wrapping" required>
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
     </div>
     <p class="text-white">*Campo obligatorio</p>
            <p class="formulario__input-error">El alerta solo puede contener numeros y el maximo son 3 dígitos.</p>
        </div>


        <div class="mb-3">
        <label class="form-label">Categoria </label><br>
          <select  id='categoria' class="form-control text-dark" name="categoria" style="width:100%">
          @foreach($categorias as $unaCategoria)
		  	@if($unaCategoria->id == $articulos->categoria->id)
			<option value="{{$unaCategoria->id}}" class="seleccion" selected >{{$unaCategoria->descripcion}}</option>
			@else
             <option value="{{$unaCategoria->id}}" class="seleccion">{{$unaCategoria->descripcion}}</option>
			@endif
          @endforeach
        </select>
        </select>
        </div>
          <br>
          <br>
          
            <!-- Menesaje de Error -->
            <div class="row formulario__mensaje" id="formulario__mensaje">
             
              <p ><i class="fa-solid fa-triangle-exclamation"></i><b> Error:</b> Por favor complete el formulario correctamente</p>
              
            </div>   

            <div class="formulario__grupo formulario__btn-enviar">
        <a href="/articulos" class="btn btn-secondary" tabindex="6">Cancelar</a>
     
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>
</div>

<script src="{{asset('validarArticuloEdit.js')}}" defer></script>
{{-- <script >
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});



</script> --}}





@endsection        
