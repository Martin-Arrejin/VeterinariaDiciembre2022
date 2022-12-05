@extends('layouts.plantillaBase2')
<style>

.idArticulos p{
    color:red !important;
}
</style>
<!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 
@section('contenido')
<body>
    <div class="marco m-3 p-2 ">
    <div class="container-fluid d-flex justify-content-center  text-light">
        <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Seleccione Artículos</h2>
    
    </div>
  
    <div class="container-fluid d-flex justify-content-center  text-light m-2">
        <select  id='idArticulos' class="js-example-basic-single p-3" name="idArticulos" style="width:60%" >
                <option value="0"></option>
                @foreach($lotes as $unLote)
                    <option value="{{$unLote->id}}" class="seleccion"><table class="text-center"><tr><td colspan=" ">{{$unLote->articulo->descripcion}}</td><td colspan="2">&nbsp;&nbsp;</td><td colspan="1">({{$unLote->articulo->marca}})</td><td colspan="2">&nbsp;  </td><td class="fs-bold text-danger"><p class="text-danger">{{$unLote->vencimiento}}</p></td></tr></table></option>
                    
                @endforeach
        </select>
    </div>
    <br>
    <br>




    
    
@if(session("articulos") != null)
<div class="container-fluid d-flex justify-content-center  text-light">
        <div>
            <div class="row">
                <div class="col-6">
                    <a class="btn btn-primary" href="/terminarVenta" title="realizar venta">Vender</a>
                </div>

                <div class="col-6">
                    <a class="btn btn-danger" href="/cancelarVenta" title="cancelar venta">Cancelar</a>
                </div>

            </div>
        </div>
    </div>
    </div>

    <div class="container-fluid d-flex justify-content-center  text-light">
   



@php
    $indice = 0;
    $total = 0;
    $estado = session("estado"); 
@endphp

<div class= "container">
<table id="example"  class="table table-striped" style="width:100%" >
    <thead>
           
            <tr>
                
                <th scope="col">Artículo</th>
            {{--     <th scope="col">Marca</th> --}}
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Descuento</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>      
    <tbody>
    @foreach(session("articulos") as $producto)
        @php
            $date = date('d-m-Y',strtotime($producto->vencimiento));
        @endphp
    <tr>
        
        <td><i class="fa-solid fa-cart-shopping"></i> {{$producto->articulo->descripcion}}/{{$producto->articulo->marca}}</td>
         <td>x {{$producto->unidad}}</td>
        @if($estado[$indice] == 0)
            <td>{{$producto->articulo->precioVenta}}</td>
            <td>  </td>
            <td>{{($producto->unidad)*($producto->articulo->precioVenta)}}</td>
            @php
                $indice++;
                $total += ($producto->unidad)*($producto->articulo->precioVenta);
            @endphp
        @else
            <td>{{$producto->articulo->precioEspecial}}</td>
            <td> {{($producto->unidad)*($producto->articulo->precioEspecial) - ($producto->unidad)*($producto->articulo->precioVenta)}} </td>
            <td>{{($producto->unidad)*($producto->articulo->precioEspecial)}}</td>
            @php
                $indice++;
                $total += ($producto->unidad)*($producto->articulo->precioEspecial);
            @endphp
        @endif
        
        
        <td><form action="{{route('quitarArticulo')}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" value="{{$indice}}" name="articulo">
            <a class="btn btn-success rounded-pill p-1"  href="/agregarArticuloVenta/{{$producto->id}}" name="masUno" title="más Uno"><i class="fa-solid fa-circle-plus"></i></a>
            <a class="btn btn-danger rounded-pill p-1"  href="/eleminarUnArticuloVenta/{{$producto->id}}" name="menosUno" title="menos Uno"><i class="fa-solid fa-circle-minus"></i></a>
            <a class="btn btn-secondary rounded-pill p-1"  href="/precioEspecial/{{$producto->id}}" name="PrecioEspecial" title="PrecioEspecial"><i class="fa-solid fa-circle-exclamation"></i></i></a>    
            <button class="btn btn-danger rounded-pill p-1" title="Eliminar"><i class="fa-solid fa-trash-can "></i></button>

        </form></td>

    </tr>
        
    @endforeach
</table>
<tr><h5 class="text-end bg-danger btn-success p-2">Total:<strong> ${{$total}}<strong></tr>
</div>
    
    </div>
@else
    <div class="container-fluid d-flex justify-content-center  text-light">
        <div>
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary" href="/terminarVenta" title="realizar venta" disabled>Vender</button>
                </div>

                <div class="col-6">
                    <a class="btn btn-danger" href="/cancelarVenta" title="cancelar venta">Cancelar</a>
                </div>

            </div>
        </div>
    </div>
@endif

    <!-- ************************************************************ -->
    @if(Session::has('message'))

        <div class="alert
        {{ Session::get('alert-class', 'alert-info') }}">{{Session::get('message') }}</div>

    @endif
</html>
    

   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="  https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>


        $(document).ready(function () {



           $('.js-example-basic-single').select2();
      

        });

        $("#idArticulos").on("change",function(event){
            var id = document.getElementById("idArticulos").value;
            if(id != 0){
                var link = "/agregarArticuloVenta/"+id;

                location.href = link;
            }
            
            

        });
        
        

        



        

    
        </script>
</body>
@endsection