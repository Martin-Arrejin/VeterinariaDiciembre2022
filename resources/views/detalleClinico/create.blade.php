@extends('layouts.plantillaBase')
<style>
.form-group input{
height: 100px;

background-color:#f3dcf3;
 border:2px solid transparent;
 font-size: 18px;

}

label{
    font-size: 20px;
    font-weight:bold;
}
</style>
@section('contenido')
<div class="row m-2 p-2">
<div class="col-3 text-center pt-2"><img src="/iconos/logo_salud.png" alt="logo_salud" height="160" width="200" class="iconos" id="boton"> </div>
<div class="col-6 text-center pt-5"><h2 class="text-center fw-bold" >Detalle Clínico</h2></div>
<div class="col-3 text-center pt-5"> <a href="{{url()->previous()}}" class="btn btn-secondary rounded-pill m-1 p-2"><i class="fa-solid fa-arrow-rotate-left"></i></a>
</div>
<div class="form-group  text-center">
    <div class="row container-fluid d-flex justify-content-center m-2 p-2">
        <div class="col-md-6">
    <form action="/detallesClinicos" method="POST">
        @csrf

          
        <div class="mb-3">
            <label for="" class="form-label">Patología</label>
            <input id="patologia" name="patologia" type="text" class="form-control" tabindex="3"required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Tratamiento</label>
            <input id="tratamiento" name="tratamiento" type="text" class="form-control" tabindex="2" required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Peso(kg)</label>
            <input id="peso" name="peso" type="number" step="0.01" class="form-control" tabindex="3" title="valor número del peso de la mascota" required>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Observaciones</label>
            <input id="observaciones" name="observaciones" type="text" class="form-control" tabindex="1"required>
        </div>


        <div class="mb-3">
            <label for="" class="form-label"></label>
            <input id="id" name="idHistorialClinico" type="hidden" class="form-control" tabindex="5" value="{{$historialClinico_id}}"required>
        </div>
        
        <input name="urlAnterior" type="hidden" value="{{url()->previous()}}">

        <a href="{{url()->previous()}}" class="btn btn-secondary" tabindex="3">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>
</div>
@endsection