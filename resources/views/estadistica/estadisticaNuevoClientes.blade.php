
@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))



@section('contenido')
@php 
    $añoActual=Carbon\Carbon::now()->format('Y');
@endphp

 <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>


<title>Estadisticas</title>
<style>
    .fa-regular{
       padding: 10px;
       background:rgb(0, 0, 0,0.8); 
       border-radius: 60px;
       color:#ffffff;
    }
   /*  .barra{
   
        background:rgb(0, 0, 0,0.8); 
    } */
   
   </style>
   <div class="container bg-white m-1 p-1">
    <div class="row">
        <div class="col-12 p-2 "><h2 class="text-center">  Clientes Nuevos</h2></div>
        <div class="col-12 p-2"></div>
        <div class="col-2"></div>
        <div class="col-8 text-center">
            <a class="btn" id="menosAnio" href="/estadistica/clientesNuevosPorMes/{{$año-1}}"><i class="fa-regular fa-circle-left"></i></a>
            <div class="btn" id="anio">{{$año}}</div>
              <a class="btn" id="masAnio" href="/estadistica/clientesNuevosPorMes/{{$año+1}}"><i class="fa-regular fa-circle-right"></i></a>
        </div>
        <div class="container-fluid d-flex justify-content-end ">
            <div class="col-2 "> 
                         <div class="input-group">
                <input type="number" id="inputAño" placeholder=" " min="1990" max ="{{$añoActual}}"class="form-control"> 
                <button class="btn btn-dark" id="buscar" tite="buscar"  ><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button> 
                </div>
                </div>
            </div> 
   {{--      
        <div class="col-1">
            <input type="number" id="inputAño" min="1990" max ="{{$añoActual}}"class="form-control">
           
        </div>
        <div class="col-1">
            <button class="btn" id="buscar">Buscar</button> 
        </div>
        <div>
    </div> --}}
</div>

<br>  
<p class="barra"><br></p>
<div class="row">
<div class="col-2"></div>
<div class="col-8"><div class="container">
<canvas id="myChart" width="100%" height="100%"></canvas>
</div></div>
<div class="col-2"></div>




<script>

var botonBuscar = document.getElementById('buscar');
botonBuscar.addEventListener('click',function(){
    var inputAño = document.getElementById('inputAño');
    location.href ='/estadistica/clientesNuevosPorMes/'+inputAño.value;
    
})



let arregloAux = @json($arreglo);
let arreglo    = Object.values(arregloAux);
let salida     = @json($labels);
const ctx      = document.getElementById('myChart').getContext('2d');
Chart.defaults.font.size = 21;
const myChart  = new Chart(ctx, {
   type: 'bar',
    data: {
        labels:@json($labels),
       
        datasets: [{
            label: /* 'Estadisticas del año '+@json($año), */'Nº de Personas Nueva',
            data: arreglo,
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(75, 12, 192, 1)',
                'rgba(153, 152, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 19, 64, 1)',
                'rgba(65, 142, 192, 1)',
                'rgba(153, 2, 255, 1)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth:2,
        
        }]
    },
    options: {
        
    indexAxis: 'x',
    }
  
});
</script>



@endsection


