@extends('layouts.plantillaBase')


@section('contenido')
<style>
table th{
    background-color: rgb(255, 255, 255,1) !important;
    color:#000000;
}
table tr{
    background-color: rgb(37, 95, 255,0.3) !important;
    color:#000000;
}

table td{
    background-color: rgb(255, 255, 255,1) !important;
    color:#000000;
   
}

</style>



   
    @php
        $urlAnterior= url()->previous();
    @endphp
  
    <div class="row m-2 p-2">
    <div class="col-4 text-center pt-2"><img src="../iconos/historia_clinica.png" alt="emergencias" height="160" width="160" class="iconos" id="boton"> </div>
    <div class="col-4 text-center pt-5"><h1>Historia Clínica</h1></div>
    <div class="col-4 text-center pt-5"> <button type=""class="btn btn-secondary rounded-pill m-1 p-2"  id="botonVolver"><i class="fa-solid fa-arrow-rotate-left"></i></button>   
        <a href="{{route('crearDetalleClinico', $historialClinicoId)}}" class="btn btn-primary rounded-pill " title="crear Detalle Clínico">+ detalle clínico</a> </div>
    </div>

   
   <div class="table-responsive table-striped tabla_historia" style="width:100%">
  
    <table class="table table-bordered  table-hover">
        <thead class="bg-secondary text-white">
        <thead>
            <tr class="text-center ">
                <td colspan="3" class="bg-info"><b>Datos de la Mascota </b></td>
            </tr>  
        </thead>
        <tbody>
            <tr>
                <th>Nombre: {{$mascota->nombre}}</th>
                <th>Especie: {{$mascota->especie}} </th>
                <th>Raza: {{$mascota->raza}}</th>
            </tr>    
            <tr>
                
                <th>Edad: {{$edad}}</th>
                <th>Esterilizado: {{$mascota->esterilizado}}</th>
                <th></th>
            </tr>      
            <tr>
                <th>Sexo: {{$mascota->sexo}}</th>
                <th>Color: {{$mascota->color}}</th>
                <th></th>
            </tr>     
            <thead>
                <tr class="text-center titulo">
                    <td colspan="3" class="bg-info"><b>Datos del Dueño</b></td>
                </tr>  
            </thead>     
            <tr>
                <th>Nombre: {{$mascota->persona->nombre}} {{$mascota->persona->apellido}}</th>
                <th>Teléfono: {{$mascota->persona->telefonos->codigoArea}}{{$mascota->persona->telefonos->numero}}</th>
                <th>Dirección: {{$mascota->persona->direccion}} {{$mascota->persona->numeroCalle}}</th>
            </tr>
            <thead>
                <tr class="text-center titulo">
                    <td colspan="3" class="bg-info"></td>
                </tr>  
            </thead>  

            <br>
            </table>
            @if(count($detallesClinicos) == 0)
                <h4 class="text-center">No tiene detalles agregados</h4>
            @else 
        @foreach($detallesClinicos as $unDetalle ) 
            <table class="table table-bordered  table-hover" >
                <thead class="bg-secondary text-white">
            <tr>
               
                <th><i class="fa-regular fa-circle"></i> N° Recetario:  <span class="text-danger fw-bold fs-5">{{$unDetalle->id}}</span> </th> <th>Fecha: {{$unDetalle->created_at->format('d-m-Y')}} </th></td><th>Hora: {{$unDetalle->created_at->format('H:i')}} </th></td>
              
            </tr>   
         
            <tr>
               
                <th>Palología: </th><td colspan="2" >{{$unDetalle->patologia}}</td>
            </tr>   
            <tr>
               
                <th>Tratamiento:</th><td colspan="2" >{{$unDetalle->tratamiento}}</td>
            </tr>  
            <tr>
               
                <th>Observaciones:</th><td colspan="2" >{{$unDetalle->observaciones}}</td>
            </tr>  
            </table>                 
        </tbody>
    

    
    </table>
    @endforeach

@endif






<script>
    var botonVolver = document.getElementById("botonVolver");
    botonVolver.addEventListener('click', function(){
        var url = @json($urlAnterior);
        if (url.indexOf('DetallesClinicos/create')>=0){
            history.go(-3);
        }
        else{
            history.back();
        }
    })
</script> 

    

@endsection