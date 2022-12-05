@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))
<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">
@section('contenido')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="form-group  text-center p-1">
    <div class="container-fluid d-flex volver">
        <a href="{{url()->previous()}}" class="btn btn-secondary rounded-pill m-3"><i class="fa-solid fa-arrow-rotate-left"></i></a>
    </div>
    <h2>Editar telefono</h2>
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
<div class="row container-fluid d-flex justify-content-center">
    <form action="/telefonos/{{$telefono->id}}" method="POST" id="formulario">
        @csrf
        @method('PUT')
        <div class="mb-3">
        <div class ='row'>
            <label for="telefono" class="formulario__label">N° de area *</label>
            <div class="row ">
              <div class="mb-6">
                    <div class="formulario__grupo" id="grupo__codigoArea">
                      <div class="formulario__grupo-input">
                          <div class="input-group flex-nowrap">
                          <span class="input-group-text bg-dark text-white" id="addon-wrapping" title="Código de Area" >Cód.</span>
                          <input type="text" class="form-control w-100 formulario__input" name="codigoArea" id="codigoArea"  value="{{$telefono->codigoArea}}"  maxlength="4" aria-describedby="addon-wrapping" required>
                          <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div> 
                        <p class="formulario__input-error">El Código de Area solo puede contener numeros y el maximo son 4 dígitos.</p>
                      </div>
                    </div>
                    <p class="text-info ">*Campo obligatorio</p>
            </div>
            <div class="mb-6">
              <label for="telefono" class="formulario__label">N° de celular *</label>
                      <div class="formulario__grupo" id="grupo__telefono">
                        <div class="formulario__grupo-input">
                          <div class="input-group flex-nowrap">
                          &nbsp;<span class="input-group-text bg-dark text-white" id="addon-wrapping"> 15</span>
                          <input type="text" class="form-control formulario__input" name="telefono" id="telefono"  maxlength="7" value="{{$telefono->numero}}" aria-describedby="addon-wrapping" required>
                          <i class="formulario__validacion-estado fas fa-times-circle"></i>
                        </div>
                        <p class="formulario__input-error">El Nº de Celular solo puede contener numeros y el maximo son 7 dígitos.</p>
                        </div>  
                      </div>
                      <p class="text-info ">*Campo obligatorio</p>
                  <!-- Menesaje de Error -->
   <div class="row formulario__mensaje" id="formulario__mensaje">
             
    <p class="error_cartel"><i class="fa-solid fa-triangle-exclamation"></i><b> Error:</b> Formulario Incorrecto</p>
    
  </div>            
           


        <a href="{{url()->previous()}}" class="btn btn-secondary" tabindex="6">Cancelar</a>

        <button type="submit" class="btn btn-primary" tabindex="2">Guardar</button>
    </form>
</div>
</div>
</div>
<script src="{{asset('validarEditTelefono.js')}}" defer></script>











</script>



@endsection