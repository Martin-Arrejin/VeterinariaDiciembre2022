@extends('layouts.plantillaBase2')
 <!-- data table CSS-->
{{--  <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"> --}}
 <link rel= "stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
 <link rel= "stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@section('contenido')
<div class="container-fluid d-flex justify-content-end">
    <a href="/ventas" class="btn btn-secondary rounded-pill m-3"><i class="fa-solid fa-arrow-rotate-left"></i></a>
</div>
    

        <div class="container-fluid d-flex justify-content-center  text-light p-2">
           
            <h3 class="text-center p-2 m-2 fw-bold text-dark" >Fecha de la venta: {{$venta->fecha}}
            </h3>

    </div>
    <div class="bg-white m-2 p-2">
   
          <table id="example" class="table table-striped" style="width:100%">
  
        <thead>
           
           <tr>
               <th scope="col">Fecha</th>
               <th scope="col">Cod. Artículo</th>
               <th scope="col">Nombre</th>
               <th scope="col">Marca</th>
               <th scope="col">Precio</th>
         {{--       <th scope="col">Fecha de vencimiento Lote</th> --}}
               <th scope="col">Cantidad</th>
               <th scope="col">Subtotal</th>
               <th scope="col">Descuento</th>
              
               <th scope="col">Monto Pagado</th>
              
               <th scope="col">Total</th>
           </tr>
        </thead>
        <tbody>
        
            @foreach($detalles as $unDetalle)
            <tr class="text-center">
                <td>{{$venta->fecha}}</td>
                <td>{{$unDetalle->codigo}}</td>

                <td>{{$unDetalle->descripcion}}</td>

                <td>{{$unDetalle->marca}}</td>

                <td>{{$unDetalle->subtotal/$unDetalle->cantidad}}</td>

         {{--        <td>{{$unDetalle->vencimiento}}</td>
 --}}
                <td>{{$unDetalle->cantidad}}</td>
            
                <td>{{$unDetalle->subtotal}}</td>
                <td>{{$unDetalle->descuento}}</td>
               
              
            <td>{{$venta->montoPagado}}</td>
           
            <td>{{$venta->total}}</td>
   
            </tr>
            @endforeach
       </tbody>

    </table>
    {{-- @php
     $montoAdeudado = $venta->total-$venta->montoPagado;
    @endphp
    <div class="container">
        <div class="text-end">
            <h3>Total: ${{$venta->total}}</h3>
            <h3>Monto cobrado: ${{$venta->montoPagado}}</h3>
            <h3>Monto adeudado: ${{$montoAdeudado}}</h3>
        </div>
    </div> --}}

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


 <script>

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
             'pdf',  'excel', 'print',
        ],
        language: {
url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
}
        
    } );
} );



    </script>


@endsection