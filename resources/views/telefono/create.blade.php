@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))
<style>
.form-group{
    background-color: rgba(100, 83, 153, 1) !important;
    margin: 0px;
    width: auto !important;
    height:300px !important;
    align-content: center;
  
    
}
</style>
@section('contenido')

<div class="container form-group  mb-4 text-center">
    <h1 class="text-center text-light p-2 m-2 fw-bold" >Agregar Nuevo Teléfono</h1>
<div class="row container-fluid d-flex justify-content-center">
<div class="col-md-6">
<br>
    <form action="/telefonos" method="POST">
        @csrf
        <div class ='row'>
            <div class="mb-3 col 3">
                <label for="" class="form-label text-light">Código Área</label>
                <input id="codigo" name="codigo" placeholder="343... " type="text" class="form-control" tabindex="1" maxlength="14" required>
            </div>

            <div class="mb-3 col-9 ">
                <label for="" class="form-label text-light ">Numero</label>
                <input id="numero" name="numero" placeholder="Ingrese celular 154...  " type="text" class="form-control" tabindex="1" maxlength="14" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="" class="form-label"></label>
            <input id="id" name="id" type="hidden" class="form-control" tabindex="2" value="{{$persona_id}}">
            
        </div>

        <input name="urlAnterior" type="hidden" value="{{url()->previous()}}">

        <a href="{{url()->previous()}}" class="btn btn-secondary" tabindex="3">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="4">Guardar</button>
    </form>



</div>
</div>


   
@endsection