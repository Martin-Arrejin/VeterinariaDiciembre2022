@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))

@section('contenido')
<h2 class="text-center text-dark p-2 m-2 fs-1 fw-bold" >Cliente</h2>
<div class="container-fluid d-flex justify-content-end m-2 ">
<a href="/personas" class="btn btn-secondary m-2 rounded-pill" title="volver"><i class="fa-solid fa-arrow-rotate-left"></i></a>
    <a href="{{route('creartelefono', $persona->id)}}" class="btn btn-primary m-2 p-2 rounded-pill" title="Agregar teléfono">+ Teléfono <i class="fa-solid fa-phone"></i></a>
    <a href="{{route('crearMascota', $persona->id)}}" class="btn btn-primary m-2 p-2 rounded-pill" title="Agregar Mascota">+ Mascota <i class="fa-solid fa-dog"></i> </a>  
    <br>
    <br>
</div>

<div class="table-responsive m-2 p-2">
    <table class="table table-bordered table-striped table-hover">
        <thead class="bg-secondary text-white text-center texte-center">
        
    
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Telefonos</th>
            </tr>
        </thead>
        <tbody class="text-center">
           
            <tr>
                <td>{{$persona->id}}</td>
                <td>{{$persona->nombre}}</td>
                <td>{{$persona->apellido}}</td>
                <td>{{$persona->dni}}</td>
                     
                @foreach($persona->telefonos as $unTelefono)
                <td>{{$unTelefono->numero}}</td>
           
                @endforeach
            </tr>
                                    
        </tbody>
    </table>
</div>


    

        <!-- <tr>
            <td colspan="2">Mascotas: </td>
        </tr>
        @foreach($persona->mascotas as $unaMascota)
        <tr>
            <td></td> <td><a href="/mascotas/{{$unaMascota->id}}">{{$unaMascota->nombre}} <a href="/mascotas/{{$unaMascota->id}}/edit" class="btn btn-info ml-2">Editar mascota</a></td>
        </tr>
        @endforeach -->
    </table>



@endsection