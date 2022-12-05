@extends('layouts.plantillaBase2')

<link rel="stylesheet" type="text/css" href="{{asset('estiloArticulo.css')}}">
{{-- <style>
.form-group{
    background-color: rgba(255, 52, 11) !important;
    margin: 0px;
    width:auto;
    height: auto;
    
}
.form-label{
   color:#ffffff;
}
</style> --}}
@section('contenido')
<div class="form-group   text-center">
    <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Nuevo Articulo</h2>
  
   <div class="row container-fluid d-flex justify-content-center">
    <div class="col-md-6">
   <div class="row">
      <form action="/articulos" method="POST" id="formulario" name="formulario" >
        @csrf

           <!--Grupo codigo -->
        <div class="mb-3">
      <div class="formulario__grupo" id="grupo__codigo" title="Valor númerico único que se va identificar el producto">
    <label for="codigo" class="formulario__label">Codigo*</label>
    <div class="formulario__grupo-input">
     
      <input type="text" class="form-control formulario__input" id="codigo" name="codigo" placeholder="0000"  maxlength="8" required>

      <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
  <p class="text-white">*Esta pregunta es obligatoria</p>
          <p class="formulario__input-error">El código solo puede contener valores númericos</p>
      </div>
        </div>


        <!--Grupo Descripcion -->
        <div class="mb-3">
            <div class="formulario__grupo" id="grupo__descripcion">
            <label for="descripcion" class="formulario__label" title="Caracteristicas del producto.Breve descripción del mismo" >Descripcion *</label>
            <div class="formulario__grupo-input">
            <input type="text" class="form-control formulario__input" id="descripcion" name="descripcion" placeholder=" " maxlength="50" required>
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
                 <input type="text" class="form-control formulario__input" id="marca" name="marca" placeholder=" " maxlength="20" required>
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
              <input type="text" class="form-control formulario__input" name="precioEspecial" id="precioEspecial"  maxlength="8" placeholder="$" aria-describedby="addon-wrapping" required>
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
          <input type="text" class="form-control formulario__input" name="precioVenta" id="precioVenta"  maxlength="8" placeholder="$" aria-describedby="addon-wrapping" required>
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
                  <input type="text" class="form-control formulario__input" name="iva" id="iva"  maxlength="2"  value="21" aria-describedby="addon-wrapping" required>
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
                  <input type="text" class="form-control formulario__input" name="minimoStock" id="minimoStock"  maxlength="3" placeholder="10(unidades)" aria-describedby="addon-wrapping" required>
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
                  <input type="text" class="form-control formulario__input" name="alerta" id="alerta"  maxlength="3" placeholder="30 dias,60 dias..." value='0' aria-describedby="addon-wrapping" required>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
             </div>
             <p class="text-white">*Campo obligatorio</p>
                    <p class="formulario__input-error">El alerta solo puede contener numeros y el maximo son 3 dígitos.</p>
                </div>
       
           <!--Grupo categoria -->
             
        <div class="mb-3">
            <div class="formulario__grupo" id="grupo__categoria">
            <label for="categoria" class="formulario__label" title="Clasificación del Producto" >Categoria *</label>
            <div class="formulario__grupo-input">
          <select  id='categoria' class="js-example-basic-single form-control formulario__input" name="categoria">
              
          @foreach($categorias as $unaCategoria)
             <option value="{{$unaCategoria->id}}" class="seleccion">{{$unaCategoria->descripcion}}</option>
             <i class="formulario__validacion-estado fas fa-times-circle"></i>
             @endforeach
       
        </select>
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
    </div>
    <p class="text-white ">*Campo obligatorio</p>
    <p class="formulario__input-error">El categoria tiene que ser de 2 a 25 caracteres y solo puede contener letras.</p>
  </div>
        </div>
          <br>
   <!-- Menesaje de Error -->
   <div class="row formulario__mensaje" id="formulario__mensaje">
             
    <p ><i class="fa-solid fa-triangle-exclamation"></i><b> Error:</b> Por favor complete el formulario correctamente</p>
    
  </div>   

  <div class="formulario__grupo formulario__btn-enviar">

          <div class="container-fluid d-flex justify-content-center m-2">
        <a href="/articulos" class="btn btn-secondary m-2 " tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary  m-2 " tabindex="7">Guardar</button>
          </div>
      </form>
  </div>
<div class="col-2"></div>
  </div>
</div>

<script src="{{asset('validarArticulo.js')}}" defer></script>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script >
/*  $(document).ready(function() {
    $('.js-example-basic-single').select2();
});  */

</script>





@endsection