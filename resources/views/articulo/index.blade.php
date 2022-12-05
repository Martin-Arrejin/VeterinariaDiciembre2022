@extends('layouts.plantillaBase2') 

@section('contenido')


<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center  text-light">
        <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" > Listado de los Articulos
        </h2>
   
    </div>
    
      
    
    <a href="articulos/create" type="button" class="btn btn-primary rounded-pill ">+ Crear Articulo</a>
    </div>
    
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
           
            <tr>
                
                <th sacope="col">codigo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Marca</th>
                <!-- <th scope="col">Lote</th> -->
                <th scope="col">Precio</th>
                <th scope="col">precio especial</th>
                <th scope="col">Categoria</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articulos as $unArticulo)
                <tr>
                    
                    <td>{{$unArticulo->codigo}}</td>
                    <td>{{$unArticulo->descripcion}}</td>
                    <td>{{$unArticulo->marca}}</td>
                    <td>{{$unArticulo->precioVenta}}</td>
                    <td>{{$unArticulo->precioEspecial}}</td>
                    @if (empty($unArticulo->categoria->descripcion))
                        <td></td>
                    @else
                    <td>{{$unArticulo->categoria->descripcion}}</td>
                    @endif
                    <td>    
                            <a href="Lotes/{{$unArticulo->id}}/lote" name="lotes" class="btn " title="lotes"><i class="fa fa-archive"></i></a>
                           {{--  <a href="{{ route('articulos.show', $unArticulo->id)}}" name="ver" class="btn " title="Ver"><i class="fa-solid fa-eye"></i></a> --}}
                            <a href="articulos/{{$unArticulo->id}}/edit " name="Editar" class="btn " title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button class="btn btn eliminar" title="Eliminar" id="{{$unArticulo->id}}" value= '{{$unArticulo->id}}'><i class="fa-solid fa-trash-can"></i></button>
                            
                   </td>
                </tr>
            @endforeach

        </tbody>
    
    
    </table>
    </div>


    
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
     /*------------------------------------------------ */
     $(document).ready(function (){
 var id = 0;
        var botones = document.getElementsByClassName("eliminar");

        var boton = [];
        
         let cantidad = botones.length;
              for(let i = 0; i < cantidad; i++){
                  //botones[i].addEventListener('click', () => {
                  id = botones[i].id;
                  //console.log(id);
                  boton[i]= document.getElementById(`${id}`);
                
                  boton[i].addEventListener('click', function(){
                    
                         var cod = boton[i].value;

                        Swal.fire({
                            title: 'Esta Seguro que desea Borrar?',
                            text: "confirme la decisión!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar'
  
                         }).then((result) => {
                     if (result.isConfirmed) {
                        
                         location.href = 'Articulos/'+cod+'/delete'; 

                         /*  Swal.fire(
                        'Eliminado',
                        'Your file has been deleted.',
                        'success'
                        ) */
                          }
                        })

                     });

                    }
});



        </script>
@endsection        

