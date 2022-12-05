
@extends('layouts.plantillaBase2')


@section('contenido')
@php 
    $añoActual=Carbon\Carbon::now()->format('Y');
@endphp

 <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<style>
 .fa-regular{
    padding: 10px;
    background:rgb(0, 0, 0,0.8); 
    border-radius: 60px;
    color:#ffffff;
 }
 .barra{

    background-color: rgb(235, 34, 58) !important;
 }
 </style>
<title>Estadisticas</title>
<div class="container bg-white m-1 p-1">
    <div class="row text-center">
       
        <div class="col-12 p-2"></div>
        <div class="col-12 p-2 "><h2>Articulos más vendidos en el mes </h2></div>
        <div class="col-12 p-2"></div>

        <div class="col-2"> </div>
        <div class="col-8 p-2">
            <a class="btn" id="menosAnio" href="/estadistica/articulos/MasVendidos/{{$mes-1}}"><i class="fa-regular fa-circle-left"></i></a></a>
            <div class="btn" id="mes">{{$fecha}}</div>
            <a class="btn" id="masAnio" href="/estadistica/articulos/MasVendidos/{{$mes+1}}"><i class="fa-regular fa-circle-right"></i></a></a>
     
        <div class="col-2"> </div>
        
       
        <div>
    </div>
</div>

<p class="barra"><br></p>
<div class="row">
<div class="col-1"></div>
<div class="col-10"><div class="container">
<canvas id="myChart" width="60%" height="20%"></canvas>
</div></div>
<div class="col-1"></div>




<script>





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
            label: 'Nº de Unidades Vendidas ',
            data: arreglo,
            backgroundColor: [
                'rgba(255, 99, 132, 0.8)',
                'rgba(154, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(175, 12, 192, 0.8)',
                'rgba(153, 102, 25, 0.8)',
                'rgba(255, 159, 64, 0.8)',
                'rgba(275, 42, 192, 0.8)',
                'rgba(153, 52, 255, 0.8)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
        
        }]
    },
    options: {
        
    indexAxis: 'y',
    }
  
});
</script>



@endsection


