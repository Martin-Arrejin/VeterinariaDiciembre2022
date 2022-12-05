@extends('layouts.plantillaBase2')


@section('contenido')


<div class="caja_tabla-2">
    <div class="container-fluid d-flex justify-content-center">
        <div class="container-fluid d-flex justify-content-center  text-light">
            <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Articulos vencidos</h2>
  
    
    </div>

    </div>
    
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
           
            <tr>
                <th scope="col">Fecha de vencimiento</th>
                <th scope="col">Articulo</th>
                <th sacope="col">Marca</th>
                <th scope="col">Alerta</th>
                <th scope="col">Dias Vencidos</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        
            @foreach($resultados as $unLote)
               @if($unLote->dias <= 0) 
                    <tr class='vencido'>
               @endif
                    <td>{{$unLote->vencimiento}}</td>
                    <td>{{$unLote->descripcion}}</td>
                    <td>{{$unLote->marca}}</td>
                    <td>{{$unLote->alerta}}</td>
                    <td>{{($unLote->dias)*-1}}</td>
                    <td>
                    
                    <button class="btn btn eliminar" title="Eliminar" id="{{$unLote->id}}" value= '{{$unLote->id}}'><i class="fa-solid fa-trash-can"></i></button>
                    </td>
                </tr>
            @endforeach

        </tbody>
    
    
    </table>
    </div>

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
                            title: 'Esta Seguro que desea Borrar este lote?',
                            text: "confirme la decisión!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar'
  
                         }).then((result) => {
                     if (result.isConfirmed) {
                        
                         location.href = '/Lotes/'+cod+'/Vencimientodelete'; 

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

