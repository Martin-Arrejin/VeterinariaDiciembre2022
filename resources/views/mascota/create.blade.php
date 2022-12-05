@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))
<style>
    * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
    .form-group{
        background-color: rgba(100, 83, 153, 1) !important;
        margin: 0px;
        width: auto !important;
        height:auto!important;
        align-content: center;
        color:#ffffff;
        
    }
input[type="text"] {
  width: 100%;
/*   padding: 15px 10px; */
  border: none;
/*   border-bottom: 1px solid #645979; */
  outline: none;
/*   border-radius: 5px 5px 0 0; */
  background-color: #ffffff;
  font-size: 16px;
}
ul {
  list-style: none;
}
.list {

  background-color: #060606;
/*   border-radius: 0 0 5px 5px; */
}
.list-items {
    width: 100%;
  padding: 10px 10px;
} 
.list-items:hover {
    width: 100%;
  background-color: rgb(241, 10, 245) !important;
}

</style> 

   
@section('contenido')

<div class="form-group  text-center">
    <div class="container-fluid d-flex justify-content-end" >
        <a href="{{url()->previous()}}" class="btn btn-secondary rounded-pill m-3" title="volver"><i class="fa-solid fa-arrow-rotate-left"></i></a>
    </div>
    <h2 class="text-center text-light p-2 m-2 fs-1 fw-bold" >Agregar Mascota</h2>
<div class="row container-fluid d-flex justify-content-center">
<div class="col-md-6">


    <form action="/mascotas" method="POST">
        @csrf
       
        <div class="mb-3">
            <label for="" class="form-label">Nombre del Animal</label>
            <input id="nombre" name="nombre" type="text" class="form-control" maxlength="30" tabindex="1" required>
        </div>
        <p class="text-info ">*Campo obligatorio</p>
        <div class="mb-3">
            <label for="" class="form-label">Color</label>
            <input id="color" name="color" type="text" class="form-control" maxlength="40" tabindex="1" required>
        </div>
        <p class="text-info ">*Campo obligatorio</p>

        <div class="mb-3">
            <label for="" class="form-label">Esterilizado</label>
            <select class="form-select" aria-label="Default select example" name="esterilizado" id="esterilizado" required>
                <option value="no">No </option>
                <option value="Si">Si </option>
             </select> 
        </div>   
        <p class="text-info ">*Campo obligatorio</p>
        <div class=" ">
            <label for="" class="form-label">Especie</label>
            <select class="form-select" aria-label="Default select example" name="especie" id="especie" required>
                <option value="s/n">Selecionar Especie</option>
                <option value="Perro">🐶 Perro</option>
                <option value="Gato">🐱 Gato </option>
                <option value="Pajaro">🐤Pajaro </option>
                <option value="Conejo"> 🐰 Conejo </option>
                <option value="Tortuga">🐢 Tortuga </option>
                <option value="Otros">Otro </option>
              </select> 
        </div> 
        <p class="text-info ">*Campo obligatorio</p>
        <div class="mb-3">
         {{--    <label for="" class="form-label">Raza</label>
            <input id="raza" name="raza" type="text" class="form-control" tabindex="2">
        </div>
        <div> --}}
            <label for="" class="form-label">Raza</label>
            <input type="text" id="input" name="raza" class="form-control" maxlength="30" placeholder="Busque la raza del animal..." required />
          </div>
     
          <ul class="list"></ul>
          <p class="text-info ">*Campo obligatorio</p>
        <div class="container-fluid d-flex justify-content-center ">

                 
            <div class="form-check m-4">
            <input class="form-check-input" type="radio" name="sexo" id="sexo1" value="macho" required>
            <label class="form-check-label" for="sexo1">
                Macho
            </label>
        </div>
        <div class="form-check m-4">
            <input class="form-check-input" type="radio" name="sexo" id="sexo2" value="hembra" required>
            <label class="form-check-label" for="sexo2">
                Hembra
            </label>
        </div>
    </div>
    <p class="text-info ">*Campo obligatorio</p>
    <div class="mb-3">
            <label for="" class="form-label">Nacimiento</label>
            <input id="anioNacimiento" name="anioNacimiento" type="date" class="form-control" value="" tabindex="4" required>
        </div>
        <p class="text-info ">*Campo obligatorio</p>
        <div class="mb-3">
            <label for="" class="form-label"></label>
            <input id="id" name="id" type="hidden" class="form-control" tabindex="5" value="{{$persona_id}} ">
        </div>
        
        <input name="urlAnterior" type="hidden" value="{{url()->previous()}}">

        <a href="{{url()->previous()}}" class="btn btn-secondary" tabindex="3">Cancelar</a>
        
        <button type="submit" class="btn btn-primary" tabindex="7">Guardar</button>
        <br>
        <br>
    </form>
    <script src="{{asset('autocompletar.js')}}" defer></script>
@endsection