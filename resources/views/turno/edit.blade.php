@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))
<style>
    .form-group{
        background-color: rgba(100, 83, 153, 1) !important;
        margin: 0px;
        width:auto;
        height: auto;
        text-align: center;
        color:#ffffff;
        
    }
    .form-label{
       color:#ffffff;
    }
</style>
@section('contenido')
  
    <div class="form-group text-center">
        <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Editar turno</h2>
        <div class="row container-fluid d-flex justify-content-center">
            <div class="col-md-4 ">
    <form id='formEdit' action="/turnos/{{$turno->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="" class="form-label">Cliente</label><br>
             <input class="form-control text-center" type="text" name="cliente"  title="cliente" value='{{$turno->persona->nombre}}{{ $turno->persona->apellido}}' disabled>
         </div>
        <div class="mb-3">
            <label for="" class="form-label">Fecha</label><br>
             <input class="form-control text-center" type="date" name="fecha" placeholder="20:30" title="fecha" value='{{$fecha}}' disabled>
         </div>

        <div class="mb-3">
            <label for="" class="form-label">Hora</label>
            <input id="hora" name="hora" type="text" class="form-control text-center" tabindex="2" value='{{$hora}}'disabled>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Asunto</label>
            <textarea id="asunto" name="asunto"  class="form-control" tabindex="3">{{$turno->asunto}}</textarea>
        </div>

        <a href="{{url()->previous()}}" class="btn btn-secondary" tabindex="4">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="5">Guardar</button>
        <input type='hidden' id='url' name='url'value='{{url()->previous()}}' >
    </form>

    <script>
        var formEdit = document.getElementById('formEdit');
        formEdit.addEventListener('submit',function(event){
            event.preventDefault();
            url=document.getElementById('url');
            url.style.display="block";
            event.currentTarget.submit();       
        })
    </script>
@endsection

