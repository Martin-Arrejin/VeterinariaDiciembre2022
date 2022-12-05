@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))

@section('contenido')
    <h1>Listado de Teléfonos</h1>

    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                
                <th scope="col">Número</th>
                <th scope="col">Persona</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach($telefonos as $unTelefono)
                <tr>
                    
                    <td>{{$unTelefono->numero}}</td>
                    <td><a href="personas/{{$unTelefono->persona->id}}">{{$unTelefono->persona->nombre}} {{$unTelefono->persona->apellido}}</a></td>
                    <td>
                            <input type="hidden" name="urlAnterior" value="{{Request::path()}}">
                            <a href="telefonos/{{$unTelefono->id}}/edit" class="btn btn-info">Editar</a>
                            <button class="btn btn eliminar" title="Eliminar" id="{{$unTelefono->id}}" value= '{{$unTelefono->id}}'><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>


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
                        
                         location.href = '/telefonos/'+cod+'/delete'; 

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