@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))


@section('contenido')

<title>Mascotas Deshabilitadas</title>
<div class="container-fluid d-flex justify-content-center  text-light">
        
        <h3 class="text-center p-2 m-2 fw-bold text-dark" >Listado de Mascotas Inactivas</h3><br>
     
      
    </div>

    @isset($persona)
        <a href="/mascotas/create/{{$persona->id}} " type="button" class="btn btn-primary rounded-pill  p-2" title="Nuevo mascota">+ Mascota <i class="fa-solid fa-dog"></i></a>
        <p class="text-center p-2 m-2 fs-3 fw-bold text-dark" >Cliente: {{$persona->nombre}} {{$persona->apellido}} </p>  
    @endisset
    <table id="example" class="table table-striped text-center" style="width:100%">
        
   
        <thead>
            
            
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Raza</th>
                <th scope="col">Especie</th>
                <th scope="col">Color</th>
                <th scope="col">Sexo</th>
                <th scope="col">Esterilizado</th>
                <th scope="col">Fecha nacimiento</th>
               {{--  <th scope="col">Dueño</th> --}}
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
        @foreach($mascotas as $unaMascota) 
                <tr style="text-align:left">
                    <td >{{$unaMascota->nombre}}</td>
                    <td >{{$unaMascota->raza}}</td>
                    <td >{{$unaMascota->especie}}</td>
                    <td >{{$unaMascota->color}}</td>
                    <td >{{$unaMascota->sexo}}</td>
                    <td>{{$unaMascota->esterilizado}}</td>
                    <td >{{\Carbon\Carbon::parse($unaMascota->anioNacimiento)->format('d-m-Y')}}</td>
        
{{--                     <td>{{$unaMascota->persona->nombre." ".$unaMascota->persona->apellido}}</td> --}}
                    <td style="text-align:left">
                            <input type="hidden" name="urlAnterior" value="{{Request::path()}}">
                           
                            <a href="/mascotas/{{$unaMascota->id}}/edit" class="btn btn" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                            
                            <button class="btn btn eliminar" title="habilitar" id="{{$unaMascota->id}} " value= '{{$unaMascota->id}}'><i class="fa-solid fa-dog"></i>+</button>
                        </form>
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
                            title: '¿ Esta Seguro que desea habilitar la mascota?',
                            text: "confirme la decisión!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'aceptar',
                            cancelButtonText: 'cancelar'
  
                         }).then((result) => {
                     if (result.isConfirmed) {
                         location.href = '/mascotas/habilitar/'+cod;

                    
                          }
                        })

                     });

                    }
});









     </script>


@endsection