@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))
<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">
@section('contenido')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="form-group ">
    <div class="container-fluid d-flex justify-content-end">
    <a href="{{url()->previous()}}" class="btn btn-secondary rounded-pill m-3 "><i class="fa-solid fa-arrow-rotate-left"></i></a>
    </div>
    <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Editar Cliente</h2>
    <div class="row container-fluid d-flex justify-content-end">
  {{--       <div class="col-md-4 ">
            <a href="{{route('creartelefono', $persona->id)}}" class="btn btn-primary ml-2 rounded-pill" title="Agregar Teléfono">+ Teléfono <i class="fa-solid fa-phone"></i></a>
          
        
           
    <a href="/telefonos/{{$persona->telefonos->id}}/edit" class="btn btn-secondary ml-2 rounded-pill">Editar <i class="fa-solid fa-phone"></i></a></div>


      
    </div> --}}
   
<div class="container-fluid d-flex justify-content-center">
<div class="col-md-6">
    <div class="form-group  text-center">
    <form action="/personas/{{$persona->id}}" method="POST" id="formulario">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <!--Grupo Nombre -->
              <div class="formulario__grupo " id="grupo__nombre">
            <label for="nombre" class="formulario__label">Nombre *</label>
            <div class="formulario__grupo-input">
             
              <input type="text" class="form-control formulario__input" id="nombre" name="nombre" placeholder="Nombre del cliente" maxlength="30" value="{{$persona->nombre}}" required>
     
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
                  </div>
          <p class="text-info ">*Campo obligatorio</p>
                  <p class="formulario__input-error">El Nombre tiene que ser de 2 a 25 caracteres y solo puede contener letras.</p>
              </div>

        {{-- <div class="mb-3">
            <label for="" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1" value="{{$persona->nombre}}">
        </div> --}}
{{-- 
        <div class="mb-3">
            <label for="" class="form-label">Apellido</label>
            <input id="apellido" name="apellido" type="text" class="form-control" tabindex="2" value="{{$persona->apellido}}">
        </div> --}}
 <!--Grupo Apellido -->
 <div class="mb-3">
    <div class="formulario__grupo" id="grupo__apellido">
     <label for="apellido" class="formulario__label">Apellido *</label>
     <div class="formulario__grupo-input">
     <input type="text" class="form-control formulario__input" id="apellido" name="apellido" value="{{$persona->apellido}}" maxlength="25" required>
     <i class="formulario__validacion-estado fas fa-times-circle"></i>
   </div>
   <p class="text-info ">*Campo obligatorio</p>
   <p class="formulario__input-error">El Apellido tiene que ser de 2 a 25 caracteres y solo puede contener letras.</p>
 </div>


    
{{-- 
        <div class="mb-3">
            <label for="" class="form-label">Dni</label>
            <input id="dni" name="dni" type="text" maxlength="8"  class="form-control" tabindex="3" value="{{$persona->dni}}">
        </div> --}}

        <!-- Grupo: DNI-->
    <div class="mb-3">
        <div class="formulario__grupo" id="grupo__dni">
            <label for="dni" class="formulario__label">DNI *</label>
            <div class="formulario__grupo-input">
          <input type="text" class="form-control formulario__input" name="dni" id="dni"  maxlength="8"  value="{{$persona->dni}}"  aria-describedby="addon-wrapping" required>
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
     </div>
     <p class="text-info ">*Campo obligatorio</p>
            <p class="formulario__input-error">El DNI solo puede contener numeros y el maximo son 8 dígitos.</p>
        </div>

     {{--    <div class="mb-3">
            <label for="" class="form-label">Dirección</label>
            <input id="direccion" name="direccion" type="text" class="form-control" tabindex="4" value="{{$persona->direccion}}">
        </div> --}}
<!-- Grupo: Dirección -->

<label for="direccion" class="formulario__label">Dirección *</label>
<div class="row ">
<div class = "col-md-8 col-6">
<div class="formulario__grupo" id="grupo__direccion">
<div class="formulario__grupo-input">
    <div class="input-group flex-nowrap">
      <input type="text" id="input" name="direccion"  class="form-control formulario__input" maxlength="25" value="{{$persona->direccion}}" tabindex="4"required/> </ul> 
    
     <i class="formulario__validacion-estado fas fa-times-circle"></i>
  </div> 
  <p class="formulario__input-error">La dirección solo puede contener letras y números con un maximo 25 caracteres.</p>
</div>
</div>
</div>
<div class = "col-md-4 col-6">
<div class="formulario__grupo" id="grupo__numeroCalle">
  <div class="formulario__grupo-input">
    <div class="input-group flex-nowrap">
    &nbsp;<span class="input-group-text bg-dark text-white" id="addon-wrapping">N°</span>
    <input type="text" class="form-control formulario__input" name="numeroCalle" id="numeroCalle"  maxlength="5" placeholder="1234" value="{{$persona->numeroCalle}}" aria-describedby="addon-wrapping" required>
    <i class="formulario__validacion-estado fas fa-times-circle"></i>
  </div>
  <p class="formulario__input-error">El Nº de Calle solo puede contener numeros y el maximo son 5 dígitos.</p>
  </div>  
</div>
</div>
<p class="text-info ">*Campo obligatorio</p>

         <div class="mb-3">
            <div class="row ">
                <label for="direccion" class="formulario__label">Celular *</label>
                         <div class="col-8 container-fluid d-flex justify-content-center">  
          
           <input id="telefono" name="celular" type="text" class="form-control bg-secondary text-white" tabindex="5" value="{{$persona->telefonos->codigoArea .$persona->telefonos->numero}}" disabled>
            </div>
            <div class="col-4 container-fluid d-flex justify-content-center ">
                @if(empty($persona->telefonos->id))    
                <a href="{{route('creartelefono', $persona->id)}}" class="btn btn-primary rounded-pill m-2 pl-2" title="Agregar Teléfono">+<i class="fa-solid fa-phone"></i></a>
                @else
                <a href="/telefonos/{{$persona->telefonos->id}}/edit" class="btn btn-secondary rounded-pill m-2 p-2" title="Modificar Número"><i class="fa-solid fa-pen-to-square"></i></a>
               
                @endif
            </div>
            </div>
         <br>
             
             <!-- Menesaje de Error -->
   <div class="row formulario__mensaje" id="formulario__mensaje">
             
    <p class="error_cartel"><i class="fa-solid fa-triangle-exclamation"></i><b> Error:</b> Formulario Incorrecto</p>
    
  </div>              
   
        <button  class="btn btn-secondary m-2" tabindex="6" id="cancelar" name="cancelar">Cancelar</button> 
        
        <button type="submit" class="btn btn-primary" id="botonGuardar" tabindex="7">Guardar</button>
    </form>
    <script src="{{asset('validarEditCliente.js')}}" defer></script>


    
@endsection