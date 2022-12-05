@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))


<link rel="stylesheet" type="text/css" href="{{asset('estiloControl.css')}}">
<!--Jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!--Floating WhatsApp css-->
<link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
<!--Floating WhatsApp javascript-->
<script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>

<!--BOOTSTRAP -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>

.modal-body{
    background-color: rgba(100, 83, 153, 1) !important;
}

/* #selectEstado .inactivo{
  background-color: rgba(100, 83, 153, 1) !important;
  color:red;
}
#selectEstado .activo{
  background-color: rgb(15, 235, 19) !important;
  color:green;
}
 */
</style>

@section('contenido')

@if($styleTurno == 1)
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de turnos restantes en el dia</h2>
@endif
@if($styleTurno == 2)
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de turnos restantes en la semana</h2>
@endif
@if($styleTurno == 3)
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de turnos libres</h2>
@endif
@if($styleTurno == 5)
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de turnos pasados</h2>
@endif
@if($styleTurno == 4)
    <h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Listado de turnos</h2>
@endif

    <a href="/turnos/create"  class="btn btn-primary rounded-pill" title="Agregar Turno">+ Turno <i class="fa-solid fa-calendar-days"></i></a>
    <br>
    <br>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Persona</th>
                <th scope="col">DNI</th>
                <th scope="col">Asunto</th>
                <th scope="col">Acciones</th>
                <th scope="col">Env. Mensaje</th>
               
            </tr>
        </thead>

        <tbody>
            @foreach($turnos as $unTurno)
                <tr>
                    @foreach(explode(' ', $unTurno->start) as $info) 
                    <td>{{$info}} </td>
                     @endforeach
                  
                @if($unTurno->persona_id)
                        <td>{{$unTurno->persona->nombre}} {{$unTurno->persona->apellido}}</td>
                        <td>{{$unTurno->persona->dni}}</td>
                   {{--      <td>{{$unTurno->persona->telefonos->codigoArea}}  {{$unTurno->persona->telefonos->numero}}</td>  --}}
                   <td>  <div class="container-fluid d-flex justify-content-start">{{$unTurno->asunto}} </div></td>
                        <td>
        
                            <a href="/turnos/{{$unTurno->id}}/edit" class="btn " title="editar" ><i class="fa-solid fa-pen-to-square"></i></a>

                            <button class="btn btn cancelar" title="cancelar" id="{{$unTurno->id}}" value='{{$unTurno->id}}'><i class="fa-solid fa-ban"></i></button>
                            
                        
                            <button class="btn btn eliminar" title="eliminar" id="{{$unTurno->id}}*-1" value='{{$unTurno->id}}*-1'><i class="fa-solid fa-trash-can"></i></button>
                        
                        <td>
                       <a class="bnt btn-success border border-success rounded-pill m-1 p-2 " title="Enviar WhatsApp" href="/turnos/mensaje/{{$unTurno->id}}" name="Boton_Enviar"  ><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                    </td>
                        
                @else 
                    <td class="text-center"> 
                       <!--boton modal  -->
<button type="button" class="btn btn-outline-primary rounded-pill p-2 modalTurno " id ="{{$unTurno->id}}modal" value='{{$unTurno->id}}' data-toggle="modal" data-target="#exampleModal" title="Agendar persona al turno">
    <i class="fa-solid fa-user-plus"></i>
  </button>

                       
                    <td></td>
                    <td> </td>
                    <td colspan="1">
                        
                            <button class="btn btn edit" title="editar" id="{{$unTurno->id}}" value='{{$unTurno->id}}'disabled><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn cancelar" title="cancelar" id="{{$unTurno->id}}" value='{{$unTurno->id}}'disabled><i class="fa-solid fa-ban"></i></button>
                            <button class="btn btn eliminar" title="eliminar" id="{{$unTurno->id}}E" value='{{$unTurno->id}}'>  <i class="fa-solid fa-trash-can"></i>  </button>
                        
                     </td>
                        <td>
                       <button class="bnt btn-success border border-success rounded-pill m-1 p-2 whatsappDisabled " title="Enviar WhatsApp" href="turnos/mensaje/{{$unTurno->id}}" name="Boton_Enviar" disabled ><i class="fa fa-whatsapp" aria-hidden="true"></i></button>
                    </td>  
                @endif
                </tr>
            @endforeach
           
        </tbody>
    </table>
     
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="  https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

   
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title text-center" id="exampleModalLabel">Agendar un turno a la persona</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group  text-center p-3 text-white">
      
            <form action=" " method="POST" id="formulario">
                @csrf
                <div class="mb-3">
                    <i class="fa-regular fa-calendar-clock"></i>
                    <label for="fechaModal" class="form-label">Fecha y Hora <i class="fa-solid fa-calendar-days"></i></label>
                    <input id="fechaModal" name="fechaModal" type="text" class="form-control" maxlength="20"  tabindex="1" autocomplete="name" disabled>
                </div> 
        
                
                <!-- Grupo: DNI-->
                <div class="mb-3">
                    <div class="formulario__grupo" id="grupo__dni">
                      <label for="dni" class="formulario__label">DNI *</label>
                             <div class="formulario__grupo-input">
                            <input type="text" class="form-control formulario__input" name="dni" id="dni"  maxlength="8" placeholder="XX.XXX.XXX" aria-describedby="addon-wrapping" required>
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                          </div>
                          <p class="text-info">*Esta pregunta es obligatoria</p>
                         <p class="formulario__input-error">El DNI solo puede contener numeros y el maximo son 8 dígitos</p>
                       </div>

          <!-- modal select -->
            <div class="mb-3">
                <div id='divSelect'>
                    <label for="dni" class="formulario__label">Estado del cliente</label>
                      <select name='selectEstado' class='form-control'id='selectEstado'>
                           <option value="0" id='Inactivo' class="inactivo" >Inactivo</option>
                            <option value="1" id='Activo' class="activo" >Activo</option>
                          
                      </select>
                </div>
            </div>

           <!--Modal Grupo Nombre -->
  <div class="formulario__grupo " id="grupo__nombre">
    <label for="nombre" class="formulario__label">Nombre *</label>
    <div class="formulario__grupo-input">
                   
                    <input type="text" class="form-control formulario__input" id="nombre" name="nombre" value ='' placeholder="Nombre del cliente" maxlength="20" required>
                    <i class="formulario__validacion-estado fas fa-times-circle"></i>
                  </div>
                  <p class="text-info">*Esta pregunta es obligatoria</p>
                  <p class="formulario__input-error">El Nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
                </div>
        
          <!--Modal Apellido -->
                 <div class="mb-3">
                 <div class="formulario__grupo" id="grupo__apellido">
                  <label for="apellido" class="formulario__label">Apellido *</label>
                  <div class="formulario__grupo-input">
                  <input type="text" class="form-control formulario__input" id="apellido" name="apellido" placeholder="Apellido del cliente" maxlength="20" required>
                  <i class="formulario__validacion-estado fas fa-times-circle"></i>
                  </div>
                  <p class="text-info ">*Esta pregunta es obligatoria</p>
                  <p class="formulario__input-error">El Apellido tiene que ser de 4 a 20 dígitos y solo puede contener letras</p>
                </div>
            
      
        <!-- Modal: Dirección -->
        
                  <label for="direccion" class="formulario__label">Dirección *</label>
                  <div class="row ">
                  <div class = "col-md-8 col-6">
                <div class="formulario__grupo" id="grupo__direccion">
                  <div class="formulario__grupo-input">
                      <div class="input-group flex-nowrap">
                        <input type="text" id="direccion" name="direccion"  class="form-control formulario__input" maxlength="25" placeholder="Calle " tabindex="4"required/> </ul> 
                      
                    <i class="formulario__validacion-estado fas fa-times-circle"></i> 
                    </div> 
                    <p class="formulario__input-error">La dirección solo puede contener letras y números con un maximo 25 caracteres.</p> 
                  </div>
                </div>
                  </div> 
                  
                  <div class = "col-md-4 col-6">
                  <div class="formulario__grupo" id="grupo__numeroCalle">
                    <div class="formulario__grupo-input">
                      <div class="input-group flex-nowrap">
                      &nbsp;<span class="input-group-text bg-dark text-white" id="addon-wrapping">N°</span>
                      <input type="text" class="form-control formulario__input" name="numeroCalle" id="numeroCalle"  maxlength="5" placeholder="1234" aria-describedby="addon-wrapping" required>
                      <i class="formulario__validacion-estado fas fa-times-circle"></i> 
                     </div>
                     <p class="formulario__input-error">El Nº de Calle solo puede contener numeros y el maximo son 5 dígitos.</p> 
                    </div>  
                  </div> 
         </div>
      <p class="text-info ">*Campo obligatorio</p> 
         
        </div>
              {{--   <div class="mb-3">
                  
                    <label for="" class="formulario__label">Dirección *</label>
                    <input type="text" id="input" name="direccion" class="form-control" maxlength="30" placeholder="Calle °" tabindex="4"required/>
                        
                      <ul class="list"></ul>
                      <p class="text-info ">*Campo obligatorio</p>
                </div> --}}
               
                <label for="telefono" class="formulario__label">N° de area *</label>
                <div class="row ">
                  <div class="mb-3">
                        <div class="formulario__grupo" id="grupo__codigoArea">
                          <div class="formulario__grupo-input">
                              <div class="input-group flex-nowrap">
                              <span class="input-group-text bg-dark text-white" id="addon-wrapping" title="Código de Area">Cód.</span>
                              <input type="text" class="form-control w-100 formulario__input" name="codigoArea" id="codigoArea"  maxlength="4" placeholder="0343" aria-describedby="addon-wrapping" required>
                           <i class="formulario__validacion-estado fas fa-times-circle"></i> 
                            </div> 
                            <p class="formulario__input-error">El Código de Area solo puede contener numeros y el maximo son 4 dígitos.</p>
                          </div>
                        </div> 
                        <p class="text-info ">*Campo obligatorio</p>
                </div>
                <div class="mb-3">
                  <label for="telefono" class="formulario__label">N° de celular *</label>
                          <div class="formulario__grupo" id="grupo__telefono">
                            <div class="formulario__grupo-input">
                              <div class="input-group flex-nowrap">
                              &nbsp;<span class="input-group-text bg-dark text-white" id="addon-wrapping"> 15</span>
                              <input type="text" class="form-control formulario__input" name="telefono" id="telefono"  maxlength="7" placeholder="4652xxx" aria-describedby="addon-wrapping" required>
                              <i class="formulario__validacion-estado fas fa-times-circle"></i> 
                            </div>
                         <p class="formulario__input-error">El Nº de Celular solo puede contener numeros y el maximo son 7 dígitos.</p>
                            </div>  
                          </div>
                          <p class="text-info ">*Campo obligatorio</p>
                 </div> 

                   <!--Grupo Asunto-->
                    <div class="mb-3">
                      <div class="formulario__grupo" id="grupo__asunto">
                        <label for="apellido" class="formulario__label" title="Motivo por el cual pide el turno">Asunto * </label>
                        <div class="formulario__grupo-input">
                        
                        <input type="text" class="form-control formulario__input" id="asunto" name="asunto" placeholder="Asunto del turno" maxlength="50" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                </div>
                <p class="text-info ">*Esta pregunta es obligatoria</p>
                <p class="formulario__input-error">El asunto solo puede contener letra y número con un máximo de 80 caracteres</p>
              </div>
      

                    </div>

                <div class="container-fluid d-flex justify-content-center m-2">
        {{--        <a href="/personas" class="btn btn-secondary m-2" tabindex="6" id="cancelar">Cancelar</a>  --}}
        {{--         <button  class="btn btn-secondary m-2" tabindex="6" id="cancelar" name="cancelar">Cancelar</button>  --}}
                <a href=" " class="btn btn-secondary m-2" name="cancelar" id="cancelar" tabindex="6">Cancelar</a>
                <button type="submit" id='botonGuardar' class="btn btn-primary m-2" tabindex="7">Guardar</button>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
  </button> 
{{--   <script src="{{asset('Calles.js')}}" defer></script> --}}
  <script src="{{asset('validarModal.js')}}" defer></script>



<!-- Ordenamiento boton class modalTurno -->
  <script>
      $(document).ready(function (){

        var id = 0;
        var botonesModal  = document.getElementsByClassName("modalTurno");
        var botonModal    =[];
        let cantidad      = botonesModal.length;

                    for(let i = 0; i < cantidad; i++){

                          id            = botonesModal[i].id;
                          botonModal[i] = document.getElementById(`${id}`);

                          botonModal[i].addEventListener('click', function(){

                                let nombre              = document.getElementById('nombre');
                                let apellido            = document.getElementById('apellido');
                                let direccion           = document.getElementById('direccion');
                                let numeroCalle         = document.getElementById('numeroCalle');
                                let codigoArea          = document.getElementById('codigoArea');
                                let telefono            = document.getElementById('telefono');
                                let divSelect           = document.getElementById('divSelect');
                                var inputDni            = document.getElementById('dni');
                                let botonGuardar        = document.getElementById('botonGuardar')
                                inputDni.value          = '';
                                validarCampo(expresiones.dni, inputDni, "dni");
                                nombre.value            = '';
                                validarCampo(expresiones.nombre, nombre , "nombre");
                                apellido.value          = '';
                                validarCampo(expresiones.apellido, apellido , "apellido");
                                direccion.value         = '';
                                validarCampo(expresiones.direccion, direccion , "direccion");
                                numeroCalle.value       = '';
                                validarCampo(expresiones.numeroCalle, numeroCalle, "numeroCalle");
                                codigoArea.value        = '';
                                validarCampo(expresiones.codigoArea, codigoArea, "codigoArea");                    
                                telefono.value          = '';
                                validarCampo(expresiones.telefono, telefono, "telefono");
                                // limpieza 
                                        document.getElementById(`grupo__dni`).classList.remove("formulario__grupo-incorrecto");
                                        document.querySelector(`#grupo__dni i`).classList.remove("fa-times-circle");
                                        document.querySelector(`#grupo__dni .formulario__input-error`).classList.remove("formulario__input-error-activo");
                                        document.getElementById(`grupo__nombre`).classList.remove("formulario__grupo-incorrecto");
                                        document.querySelector(`#grupo__nombre i`).classList.remove("fa-times-circle");
                                        document.querySelector(`#grupo__nombre .formulario__input-error`).classList.remove("formulario__input-error-activo");
                                        document.getElementById(`grupo__apellido`).classList.remove("formulario__grupo-incorrecto");
                                        document.querySelector(`#grupo__apellido i`).classList.remove("fa-times-circle");
                                        document.querySelector(`#grupo__apellido .formulario__input-error`).classList.remove("formulario__input-error-activo");
                                        document.getElementById(`grupo__direccion`).classList.remove("formulario__grupo-incorrecto");
                                        document.querySelector(`#grupo__direccion i`).classList.remove("fa-times-circle");
                                        document.querySelector(`#grupo__direccion .formulario__input-error`).classList.remove("formulario__input-error-activo");
                                        document.getElementById(`grupo__numeroCalle`).classList.remove("formulario__grupo-incorrecto");
                                        document.querySelector(`#grupo__numeroCalle i`).classList.remove("fa-times-circle");
                                        document.querySelector(`#grupo__numeroCalle .formulario__input-error`).classList.remove("formulario__input-error-activo");
                                        document.getElementById(`grupo__codigoArea`).classList.remove("formulario__grupo-incorrecto");
                                        document.querySelector(`#grupo__codigoArea i`).classList.remove("fa-times-circle");
                                        document.querySelector(`#grupo__codigoArea .formulario__input-error`).classList.remove("formulario__input-error-activo");
                                        document.getElementById(`grupo__telefono`).classList.remove("formulario__grupo-incorrecto");
                                        document.querySelector(`#grupo__telefono i`).classList.remove("fa-times-circle");
                                        document.querySelector(`#grupo__telefono .formulario__input-error`).classList.remove("formulario__input-error-activo");

                                botonGuardar.disabled   = false;
                                divSelect.style.display = 'none';
                                var turnos              = @json($turnos);
                                var longitud            = turnos.length;

                            // busqueda e ingredo de fecha del modal y action del formulario
                                for(let x = 0; x < longitud; x++){

                                  if(botonModal[i].value == turnos[x].id ){

                                    let fechaModal    = document.getElementById('fechaModal');
                                    let formulario    = document.getElementById('formulario');
                                    formulario.action = '/turnos/darTurno/'+ botonModal[i].value;
                                    fechaModal.value  = turnos[x].start;

                                  }
                                }
                     });
                    }
});

  </script>


<!-- habilitacion del boton aceptar segun select -->
<script>
    
    let selectEstado = document.getElementById('selectEstado');
  
    selectEstado.addEventListener('change', function(){
      
        let botonGuardar = document.getElementById('botonGuardar')

        if(selectEstado.value == 0){
            botonGuardar.disabled = true;
            selectEstado.style.backgroundColor='#FF0000';
            selectEstado.style.Color='#000000';

        }else if (selectEstado.value == 1){
            botonGuardar.disabled = false;
            selectEstado.style.backgroundColor='#61FF33';
            selectEstado.style.Color='#000000';
        }
    })
</script>

<!-- logistica de busqueda de dni e insercion de datos, control de estado del cliente -->
  <script>
    // var botonBuscar       = document.getElementById('buscarDNI');
    var inputDni =  document.getElementById('dni')
    selectEstado.disabled = false;

    // botonBuscar.addEventListener('click', function(){
    inputDni.addEventListener('keyup',function(){
        // var inputDni    = document.getElementById('dni');
        longDNi = inputDni.value.length;
      if(longDNi>6){
        var personas    = @json($personas);
        let longitud    = personas.length;

        for(let i =0 ; i< longitud; i++){

          if(personas[i].dni == inputDni.value ){

            let nombre              = document.getElementById('nombre');
            let apellido            = document.getElementById('apellido');
            let direccion           = document.getElementById('direccion');
            let numeroCalle         = document.getElementById('numeroCalle');
            let codigoArea          = document.getElementById('codigoArea');
            let telefono            = document.getElementById('telefono');
            let divSelect           = document.getElementById('divSelect');
            let Activo              = document.getElementById('Activo');
            let Inactivo            = document.getElementById('Inactivo');

            nombre.value            = personas[i].nombre;
            validarCampo(expresiones.nombre, nombre , "nombre");
            apellido.value          = personas[i].apellido;
            validarCampo(expresiones.apellido, apellido , "apellido");
            direccion.value         = personas[i].direccion;
            validarCampo(expresiones.direccion, direccion , "direccion");
            numeroCalle.value       = personas[i].numeroCalle;
            validarCampo(expresiones.numeroCalle, numeroCalle, "numeroCalle");
            codigoArea.value        = personas[i].codigoArea;
            validarCampo(expresiones.codigoArea, codigoArea, "codigoArea");
            telefono.value          = personas[i].numero;
            validarCampo(expresiones.telefono, telefono, "telefono");
            divSelect.style.display = 'block';
            let selectEstado        = document.getElementById('selectEstado');
            
            if(personas[i].estadoPer == 1){
              
                Activo.selected       = true;
                selectEstado.disabled = true;
                selectEstado.style.backgroundColor='#61FF33';
               selectEstado.style.Color='#000000';
               
            }
            else {

                let botonGuardar      = document.getElementById('botonGuardar')
                selectEstado.disabled = false;
                Inactivo.selected     = true;
                botonGuardar.disabled = true;
                selectEstado.style.backgroundColor='#FF0000';
                selectEstado.style.Color='#000000';
                Swal.fire('El usuario seleccionado se encuentra inactivo, para continuar debe habilitarlo');
            }

          //corte forzado
            i=longitud;
          
          }
        }

      }

    })

  </script>



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
        var botonesCancelar = document.getElementsByClassName("cancelar");
        var botonCancelar =[];
        
         let cantidad = botonesCancelar.length;
                    for(let i = 0; i < cantidad; i++){
                  //botones[i].addEventListener('click', () => {
                    
                  id = botonesCancelar[i].id;
                  //console.log(id);
                  botonCancelar[i]= document.getElementById(`${id}`);
                
                  botonCancelar[i].addEventListener('click', function(){
                    
                         var codCancelar = botonCancelar[i].value;

                        Swal.fire({
                            title: '¿Esta Seguro que desea cancelar el turno?',
                            text: "confirme la decisión",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'aceptar',
                            CancelButtonText: 'cancelar'
  
                         }).then((result) => {
                     if (result.isConfirmed) {    
                         location.href = '/turnos/cancelar/'+codCancelar; 

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


$(document).ready(function (){
        var id = 0;
        var botonesEliminar = document.getElementsByClassName("eliminar");
        var botonEliminar =[];
        
         let cantidad = botonesEliminar.length;
         for(let i = 0; i < cantidad; i++){
                  //botones[i].addEventListener('click', () => {
                    
                  id = botonesEliminar[i].id;
                  console.log(id);
                  botonEliminar[i] = document.getElementById(`${id}`);
                
                  botonEliminar[i].addEventListener('click', function(){
                    
                         var codEliminar = botonEliminar[i].value;

                        Swal.fire({
                            title: '¿ Esta Seguro que desea eliminar el turno?',
                            text: "confirme la decisión!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, eliminar'
  
                         }).then((result) => {
                     if (result.isConfirmed) {    
                        location.href = '/turnos/'+codEliminar+'/delete'; 

                   
                          }
                        })

                     });

                    }
});

 </script> 
@endsection


