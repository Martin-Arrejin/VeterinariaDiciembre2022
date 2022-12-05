@extends('layouts.plantillaBase')


<style>
.boton_crear {

color:#000000;

margin: 10 0 10 -10 !important;
width: 160 !important;
border-radius: 20px !important;

 
}
table th{
    background-color: rgba(100, 83, 153, 1) !important;
    color:#ffffff;
}
table td{
    background-color: rgba(100, 83, 153, 0.1) !important;
    color:#000000;
}
.caja_tabla-2{

    margin: 15px;
}

</style>

@section('contenido')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<head>
    <meta charset="UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin ="anonymous"></script>
    <link href="{{ asset('indexArticulo.css')}}" rel= "stylesheet">
    <!-- bootstrap css -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> -->
    <title>Articulos</title>
   
</head>





<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center">
        
    <h4>Articulo: {{$articulos->descripcion}}</h4>
   
    
    </div>
    <div class="container-fluid d-flex justify-content-center">
   
    <h4>Marca: {{$articulos->marca}}</h4>
    
    </div>

    
    <a href="/Lotes/{{$articulos->id}}/create" type="button" class="btn btn-outline-primary  boton_crear">+ Crear lote</a>
    </div>
    
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
           
            <tr>
                <th scope="col">Id</th>
                <th sacope="col">fecha</th>
                <th scope="col">hora</th>
                <th scope="col">cantidad de articulos<th>
                <th scope="col">total</th>
                <th scope="col">Detalle</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $unaVenta)
                <tr>
                    <td>{{$unaVenta->id}}</td>
                    <td>{{$unaVenta->fecha}}</td>
                    <td>{{$unaVenta->hora}}</td>
                    <td>{{$unaVenta->cantidad}}</td>
                    <td>{{$unaVenta->total}}</td>
                            <a href="/lotes/{{$unLote->id}}/edit " name="Editar" class="btn btn-success" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="/Lotes/{{$unLote->id}}/delete" name="delete" class="btn btn-danger" title="delete"><i class="fa-solid fa-trash-can"></i></a> 
                            
                    </td>
                </tr>
            @endforeach

        </tbody>
    
    
    </table>
    </div>

  <script src="  https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->

    <script>


        $(document).ready(function () {

           $('#example').DataTable();
      

         });
        $('#example').DataTable({
        language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
        }); 




        </script>
@endsection        

