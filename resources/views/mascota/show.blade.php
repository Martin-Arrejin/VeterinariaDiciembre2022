@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))
<style>
table th{
    background-color: rgba(100, 83, 153, 1) !important;
    color:#ffffff;
}
table td{
    background-color: rgba(66, 6, 244, 0.1) !important;
    color:#000000;
}

</style>
@section('contenido')

<h2 class="text-center m-2 fs-1 fw-bold text-dark" > Ver Mascota</h2>
   

<br>
<div class="container-fuid d-flex justify-content-end ">
    <a href="{{url()->previous()}}" class="btn btn-secondary rounded-pill m-3 p-2" title="Volver"><i class="fa-solid fa-arrow-rotate-left"></i></a>
    <a href="/historialesClinicos/{{$mascota->historialClinico->id}}" class="btn btn-primary rounded-pill m-3" title="Crear Historial Clinico">+ Historial Clínico</a>
</div>
<br>
<table id="example" class="table table-striped" style="width:100%">

    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Raza</th>
            <th scope="col">Especie</th>
            <th scope="col">Sexo</th>
            <th scope="col">Años</th>
            <th scope="col">Dueño</th>
         
        </tr>
    </thead>
        <tr>
            <td>{{$mascota->id}}</td>
            <td>{{$mascota->nombre}}</td>
           <td>{{$mascota->raza}}</td>
           <td>{{$mascota->especie}}</td>
            <td>{{$mascota->sexo}}</td>
            <td>{{$mascota->anioNacimiento}}</td>
            <td>{{$mascota->persona->nombre." ".$mascota->persona->apellido}}</td>
        </tr>
    
    </table>

   

@endsection