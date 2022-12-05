@extends('layouts.plantillaBase2')



@section('contenido')


<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center  text-light">
        <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Seleccione artículos a vender</h2>
    {{-- <a href="ventas/create" class="btn btn-light boton_crear">Realizar venta</a> --}}
    </div>
</div>
  
    <table id="example" class="table table-striped" style="width:100%">
           
        <thead>
           
            <tr>
                <th scope="col">Id lote</th>
                <th scope="col">Artículo</th>
                <th scope="col">Marca</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Fecha vencimiento</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($lotes as $unLote)
                <tr>
                    <td>{{$unLote->id}}</td>
                    <td>{{$unLote->articulo->descripcion}}</td>
                    <td>{{$unLote->articulo->marca}}</td>
                    <td>{{$unLote->unidad}}</td>
                    <td>{{$unLote->articulo->precioVenta}}</td>
                    <td>{{$unLote->vencimiento}}</td>
                    <td>
                        
                            <a  name="agregarCarrito" href= "/agregarArticuloVenta/{{$unLote->id}}"   class="btn btn agregar {{$unLote->id}}" title="Agregar al carrito" value="{{$unLote->id}}"><i class="fa-solid fa-cart-plus"></i></a>             
                  
                      
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    </div>

    
    
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
<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center  text-light">
   

</div>
</div>
@php
    $indice = 0;
    $total = 0;
@endphp

<div class= "container">
<table id="example"  class="table table-striped" style="width:100%" >
    <thead>
           
            <tr>
                <th scope="col">Id lote</th>
                <th scope="col">Artículo</th>
                <th scope="col">Marca</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Fecha vencimiento</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    <tbody>
    @foreach(session("articulos") as $producto)
    <tr>
        <td>{{$producto->id}}</td>
        <td>{{$producto->articulo->descripcion}}</td>
        <td>{{$producto->articulo->marca}}</td>
        <td>{{$producto->unidad}}</td>
        <td>{{$producto->articulo->precioVenta}}</td>
        <td>{{($producto->unidad)*($producto->articulo->precioVenta)}}</td>
        <td>{{$producto->vencimiento}}</td>
        <td><form action="{{route('quitarArticulo')}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" value="{{$indice}}" name="articulo">
            <button class="btn btn-danger" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
        </form></td>

    </tr>
        @php
            $indice++;
            $total += ($producto->unidad)*($producto->articulo->precioVenta);
        @endphp
    @endforeach
    <tr><h2>Total: ${{$total}}</h2></tr>
    </tbody>
    </table>
    
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
    

   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="  https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>


        $(document).ready(function () {

           $('#example').DataTable();
      

        });
        $('#example').DataTable({
            language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        }); 

        //var id = 0;
        //var botones = document.getElementsByClassName("agregar");
        //var boton = [];

        // let cantidad = botones.length;
        //      for(let i = 0; i < cantidad; i++){
        //          //botones[i].addEventListener('click', () => {
        //          id =botones[i].id;
        //          //console.log(id);
        //          boton[i]= document.getElementById(`${id}`);
                
        //          boton[i].addEventListener('click', function(){

        //                 var cod = boton[i].value;
        //                 //console.log(cod);
        //             });
                
                 //esta funcion ejecuta el agregar el carrito con la id del producto
                 //agregarAlCarrito(producto.id)
                 //
             //})
             //}


             
             
        // $('#example').on( 'preDraw.dt', function () {
            
        //     var botones = document.getElementsByClassName("agregar");
        //     //Por cada elemento de mi array, creo un div, lo cuelgo, le pongo un id particular, una vez colgado
        //     //le hago un get element by id (el de agregar) Obtengo el elemento y a dicho elemento le agregamos
        //     //el add event listener
        //     let cantidad = botones.length;
        //     for(let i = 0; i < cantidad; i++){
        //         botones[i].addEventListener('click', () => {
        //         id = botones[i].value;
        //         console.log(id);
        //         //esta funcion ejecuta el agregar el carrito con la id del producto
        //         //agregarAlCarrito(producto.id)
        //         //
        //     })
        //     }
            
            
            
        // } );

        // $('#example').on( 'preDraw.dt', function () {
        //  id = 0;
        //  console.log(id);   
            
            
        // } );


        

    
        </script>
@endsection