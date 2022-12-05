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
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
    <h2>Editar usuario: {{$usuario->name}}</h2>
    <form action="/usuario/guardarPassword/{{$usuario->id}}" method="POST">
        @csrf
        @method('Post')
        <div class=" mb-3 ml-2 mr-2">
            <label for="" class="form-label">Mail</label>
            <input id="mail" name="mail" type="text" class="form-control" value="{{$usuario->email}}"  tabindex="3" disabled>
        </div>
        <div class=" mb-3 ml-2 mr-2">
            <label for="" class="form-label">Contraseña nueva</label>
            <input id="password" name="password" type="password" class="form-control"  tabindex="3">
        </div>

        <a href="/usuario" class="btn btn-secondary" tabindex="6">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
    </form>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

@endsection