@extends('administrador.plantillaAdmin')
 

@section('contenido')
<style>
    .cuerpo{
        margin-top: 10% ;
        margin-left: 10% ;
        margin-Right: 10% ;
    };
</style>
<body>
    
        
    <div class="cuerpo main_content ">
    
    <div class= "container m-5">  
    <h2>Editar usuario: {{$usuario->name}}</h2>
    <form action="/usuario/guardar/{{$usuario->id}}" method="POST">
        @csrf
        @method('Post')
        <div class=" mb-3 ml-2 mr-2">
            <label for="" class="form-label">Mail</label>
            <input id="mail" name="mail" type="text" class="form-control" value="{{$usuario->email}}"  tabindex="3" required>
        </div>
        
        <label for="tipo" class=" col-form-label text-md-right">Rol</label>
            
                            <div class= "ml-2 mr-2">
                                <select class='form-select selecTipo' name= 'tipo'>
                                @if($usuario->tipo == 'admin' )
                                    <option class='form-option' value ='admin' selected>Administrador</option>
                                @else
                                    <option class='form-option' value ='admin'>Administrador</option>
                                @endif
                                @if($usuario->tipo == 'veterinario' )
                                    <option class='form-option' value ='veterinario'selected>Veterinario</option>
                                @else
                                    <option class='form-option' value ='veterinario'>Veterinario</option>
                                @endif
                                @if($usuario->tipo == 'peluquero' )
                                    <option class='form-option' value ='peluquero' selected>Peluquero</option>
                                @else
                                    <option class='form-option' value ='peluquero'>Peluquero</option>
                                @endif
                                @if($usuario->tipo == 'cajero' )
                                    <option class='form-option' value ='cajero' selected>Cajero</option>
                                @else
                                    <option class='form-option' value ='cajero'>Cajero</option>
                                @endif
                                </select>
                            <div>

        <a href="/usuario" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

@endsection