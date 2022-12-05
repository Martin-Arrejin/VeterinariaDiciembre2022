@extends('administrador.plantillaAdmin')
    
     

@section('contenido')



<div class="main_content">
  <div class="content">
 
    <div class="header"><h2 class="text-dark fw-bold text-center">Usuarios del Sistema</h2></div>    
    <div class="content text-center p-2">
      <div class="row">
          <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
               
      </div>
      <div class="content text-center m-2">
      <a href="/registro/usuario" type="button" class="btn btn-primary rounded-pill " title="Crear Usuario">+ Usuario <i class="fa-solid fa-user"></i></a>
      </div>
     <div class="row">
      <div class="col-1"></div>
      <div class="col-10">
      <table id="example" class="table table-striped " style="width:100%">
             
          <thead>
             
              <tr>
                  <th scope="col">Mail</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Rol</th>
                  <th scope="col">Acciones</th>
              </tr>
          </thead>
            
          <tbody>
               @foreach($usuarios as $unUsuario)
                  <tr>
                      <td>{{$unUsuario->email}}</td>
                      <td>{{$unUsuario->name}}</td>
                      <td>{{$unUsuario->tipo}}</td>
                      <td>
                      <a href="/usuario/{{$unUsuario->id}}/edit" class="btn " title="editar" ><i class="fa-solid fa-pen-to-square"></i></a>
                      <a href="/usuario/{{$unUsuario->id}}/editPassword" class="btn " title="editar contraseña" ><i class="fa-solid fa-key"></i></a>
                      <button class="btn btn eliminar" title="Eliminar" id="{{$unUsuario->id}}" value= '{{$unUsuario->id}}'><i class="fa-solid fa-trash-can"></i></button>
                      </td> 
                  </tr>
                  
                @endforeach
               
          </tbody>
      </table>
      </div>
      <div class="col-1"></div>
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
  //------------------------------------------------------------
  $(document).ready(function (){
 var id = 0;
        var botones = document.getElementsByClassName("eliminar");
        var boton = [];
        
        
         let cantidad = botones.length;
              for(let i = 0; i < cantidad; i++){
                  //botones[i].addEventListener('click', () => {
                  id =botones[i].id;
                  //console.log(id);
                  boton[i]= document.getElementById(`${id}`);
                  
                  boton[i].addEventListener('click', function(){
                         var cod = boton[i].value;
                         
                        Swal.fire({
                            title: '¿Esta seguro de dar de baja el usuario?',
                            text: "confirme la decisión",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'aceptar',
                            cancelButtonText: 'cancelar'
  
                         }).then((result) => {
                     if (result.isConfirmed) {
                        
                         location.href = '/usuario/'+cod+'/delete'; 

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