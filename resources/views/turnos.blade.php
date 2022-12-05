@extends('menu')

@section('turnos')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<head>
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!--full calendar -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.css">


<meta charset="UTF-8">

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/main.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.0/locales-all.min.js"></script>
</head>
<style>

.formulario__label{
  display: block;  /*abarca todo el ancho*/
  font-weight: bold;
  font-size: 20px;
  cursor: pointer;
}
.formulario__grupo-input{
  position: relative;
}
.formulario__input{
 width: 100%;
 background-color:#ffffff;
 border:4px solid transparent;
 border-radius: 3px;
 height: 45px;
 line-height: 45px;/*cuando se escriba adentro*/ 
 /*padding: arriba derecha abajo izquierda*/

 padding: 0 40px 0 10px; 
 transition: .3s ease all; /*transicion de tiempo para todas las propiedades*/ 

}
.formulario__input:focus{

  border:3px solid #0075ff;
  outline:none; 
  box-shadow: 3px 0px 30px rgba(163,163,163,0.4);

}
.formulario__input-error{
  font-size: 14px;
  margin-top: 0;
  color:#ffffff;
  text-align: center;
  display: none; 
  background-color: #a90e0e;
}
.formulario__input-error-activo{
  display: block;
  display: inline;
  padding: 4px;
  margin: 10px;
 
}
.formulario__validacion-estado{
position: absolute;
right: 10px;
bottom: 15px;
z-index: 100px; 
font-size:14px;
opacity: 0; 

}

.formulario__mensaje{
  height: 45px;
  line-height: 45px;
  margin: 0px 0px 10px 0px;
  background-color: #a90e0e;
  padding: 0 15px;
  border-radius:3px;
  display: none;  

 
}
.formulario__mensaje-activo{
  
  display:block; 

 
}
.formulario__mensaje .p {
  margin: 0px;
  text-align: center;
 

}
.formulario__btn-enviar{
 grid-column: span 2; 
} 

.formulario__mensaje-exito{
font-size:14px;
background-color: #139401;
margin: 10px 0px 0px 0px;
display: none;
}
.formulario__mensaje-exito-activo{
display: block;
}

/*especial turno */
.contenedorNuevo .fas{
position: relative;
left:300px;
bottom: 25px;
z-index: 100px; 
font-size:14px;
color:#0075ff;
opacity: 1; 
}





/*---estilo validaciones circle y check--*/ 
.formulario__grupo-correcto .formulario__validacion-estado
{
color:#0075ff;
opacity: 1; 

}
.formulario__grupo-incorrecto .formulario__label
{
color:#a90e0e;
opacity: 1; 


}

.formulario__grupo-incorrecto .formulario__validacion-estado
{
color:#a90e0e;
opacity: 1; 



}
.formulario__grupo-incorrecto .formulario__input
{
border:3px solid #a90e0e;
box-shadow: 3px 0px 30px rgb(255, 254, 254, 0.4);

}

</style>

<!-- Formulario -->

 <div class="contenido_turnos">
 @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
  @endforeach
  
<div class="container-fluid d-flex justify-content-center ">
  <div class="container  calendario p-3 formulario_turno"> 
 <!-- formulario-->
  <form action="/turnos/agregar" method="POST" id="formulario" name="formulario" > 
    @csrf
    @method('post')
    <main>
     <div class="form-group">
      <div class="row">
      <div class="row container-fluid d-flex justify-content-center">
        <h4 class="text-white text-center p-2 fs-3">Complete el formulario y seleccione el turno</h4>
          <div class="col-md-8">
          <!--Grupo Nombre -->
            <div class="formulario__grupo " id="grupo__nombre">
          <label for="nombre" class="formulario__label">Nombre *</label>
          <div class="formulario__grupo-input">
           
            <input type="text" class="form-control formulario__input" id="nombre" name="nombre" placeholder="Ivan Martin" maxlength="16" required>
   
        	<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
        <p class="text-info">*Esta pregunta es obligatoria</p>
				<p class="formulario__input-error">El Nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p>
			</div>
    
        <!--Grupo Apellido -->
        <div class="formulario__grupo" id="grupo__apellido">
          <label for="apellido" class="formulario__label">Apellido *</label>
          <div class="formulario__grupo-input">
          <input type="text" class="form-control formulario__input" id="apellido" name="apellido" placeholder="Carrasco" maxlength="16" required>
          <i class="formulario__validacion-estado fas fa-times-circle"></i>
        </div>
        <p class="text-info ">*Esta pregunta es obligatoria</p>
        <p class="formulario__input-error">El Apellido tiene que ser de 4 a 20 dígitos y solo puede contener letras</p>
      </div>
        <!-- Grupo: DNI-->
			<div class="formulario__grupo" id="grupo__dni">
				<label for="dni" class="formulario__label">Dni *</label>
				<div class="formulario__grupo-input">
              <input type="text" class="form-control formulario__input" name="dni" id="dni"  maxlength="8" placeholder="12673999" aria-describedby="addon-wrapping" required>
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
         </div>
         <p class="text-info ">*Esta pregunta es obligatoria</p>
				<p class="formulario__input-error">El DNI solo puede contener numeros y el maximo son 8 dígitos</p>
			</div>
      
<!-- Grupo: Teléfono y Código Area -->

  <label for="telefono" class="formulario__label">Celular *</label>
  <div class="row ">
  <div class = "col-md-4 col-6">
          <div class="formulario__grupo" id="grupo__codigoArea">
            <div class="formulario__grupo-input">
                <div class="input-group flex-nowrap">
                <span class="input-group-text bg-dark text-white" id="addon-wrapping" title="Código de Area">Cód.</span>
                <input type="text" class="form-control w-100 formulario__input" name="codigoArea" id="codigoArea"  maxlength="4" placeholder="0343" aria-describedby="addon-wrapping" required>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
              </div> 
              <br>
              <p class="formulario__input-error">El Código de Area solo puede contener numeros y el maximo son 4 dígitos</p>
            </div>
          </div>
  </div>
   <div class = "col-md-8 col-6">
            <div class="formulario__grupo" id="grupo__telefono">
              <div class="formulario__grupo-input">
                <div class="input-group flex-nowrap">
                &nbsp;<span class="input-group-text bg-dark text-white" id="addon-wrapping"> 15</span>
                <input type="text" class="form-control formulario__input" name="telefono" id="telefono"  maxlength="7" placeholder="4652xxx" aria-describedby="addon-wrapping" required>
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
              </div>
              <br>
              <p class="formulario__input-error">El Nº de Celular solo puede contener numeros y el maximo son 7 dígitos</p>
              </div>  
            </div>
   </div>
    <p class="text-info ">*Esta pregunta es obligatoria</p> 
   

 

  </div>

          <!--Grupo Asunto del turno-->
          <div class="formulario__grupo" id="grupo__asunto">
            <label for="apellido" class="formulario__label" title="Motivo por el cual pide el turno">Asunto * </label>
            <div class="formulario__grupo-input">
            <input type="text" class="form-control formulario__input" id="asunto" name="asunto"  placeholder="Ejemplo: A mi perro le duele la pata izquierda" maxlength="80" required>
            <i class="formulario__validacion-estado fas fa-times-circle"></i>
          </div>
          <p class="text-info ">*Esta pregunta es obligatoria</p>
          <p class="formulario__input-error">El asunto solo puede contener letra y número con un máximo de 80 caracteres</p>
        </div>



          <!--Grupo Turno -->  
          <label for="turno"  class="formulario__label">Turno *</label>
          <select class="form-control text-center" id="tipoTurno">
          <option class="text-center">Seleccionar Turno</option>  
          <option class="text-center" value="v">Veterinaria</option>
          <option class="text-center" value="p">Peluqueria Canina</option>
          </select>
          <p class="text-info ">*Esta pregunta es obligatoria</p>
          <p class="formulario__input-error">&nbsp; Recordar que tiene que seleccionar un turno</p>
        <div id="textoTurno" value="false"></div>
          <div id="textAsunto" style="display:none;" >
{{--             <label for="turno" class="formulario__label">Asunto </label>
            <textarea class = "col-md-12 col-4 form-control" name="asunto" placeholder="Motivo de reservación de turno"></textarea> --}}
          </div>  
          </div> 
          </div>
    </div>
  
          <br>
          <div class="container-fluid d-flex justify-content-center"></div>
  
          <div class="container" id="area" name="area">
          <div class="row">
          <div class="col-md-2"></div> 
          <div class="col-sm-12 col-md-8 bg-white"><div id="agenda">
          </div></div>
          <div class="col-md-2"></div>
          </div>
        
          
</div> 
           

      </div>
     <div class="modal fade" id="myModal" name="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop" aria-hidden="true">
           <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header-center">
            <div id="tituloTipo"></div>
            <h5 class="modal-title text-center" id="staticBackdropLabel">Día y Horario</h5>
         
            </div>
            
          

             <div class="modal-body" id="ventana">
             <div id="turnoHora"></div>
               </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" id="guardarModal" class="btn btn-dark" data-bs-dismiss="modal">Confirmar</button>
                </div>
               </div>
             </div>
           </div>
    
           
            <!-- Menesaje de Error -->
            <div class="row formulario__mensaje" id="formulario__mensaje">
             
              <p ><i class="fa-solid fa-triangle-exclamation"></i><b> Error:</b> Por favor complete el formulario correctamente</p>
              
            </div>
          
            <br>
            <div class="formulario__grupo formulario__btn-enviar">
            <button class="btn btn-dark btn-success"  type="reset" id="cancelar">Borrar</button>
            <button class="btn  btn-dark btn-success" id="botonAceptar" type="submit">Aceptar</button>
               <!-- Menesaje de Exitoso -->
               <div class="formulario__mensaje-exito fs-5 m-2 p-2" id="formulario__mensaje-exito">
               
                <p><i class="fa-solid fa-circle-check"></i> Formulario se envio exitosamente  <br>
                  Cualquier consulta, no dudes en escribirnos. &#128512; Muchas Gracias !!! </p>
                
              </div>        
            </div>
             
</form>  

 </div>
</div>
</div> 


 </div> 
</main>
 <script src="{{asset('formularioValidar.js')}}" defer></script>

<script src="{{asset('agenda.js')}}" defer></script>

<script>
  var button = document.getElementById("guardarModal");
/*   var asunto = document.getElementById("textAsunto"); */
  button.addEventListener("click", function(){
    asunto.style.display = 'block';
  })
</script> 





<!-- logistica de busqueda de dni y control de estado del cliente -->
<script>
    
    let inputDni =  document.getElementById('dni') 
    inputDni.addEventListener('keyup',function(){

        longDNi = inputDni.value.length;

      if(longDNi>6){
        let personas     = @json($personas);
        let longitud     = personas.length;
        let botonAceptar =  document.getElementById('botonAceptar');
        for(let i =0 ; i< longitud; i++){
          botonAceptar.disabled = false;  
          if((personas[i].dni == inputDni.value)&&(personas[i].estado == 0)){
            Swal.fire({
                icon: 'error',
                title: 'Usuario Inhabilitado',
                text: 'Por favor, comunicarse con la veterinaria.Gracias',
               
              })
                
                botonAceptar.disabled = true;  
                i=longitud+1;
                console.log(i);
                }
        
        
            
        }
        }

      

    })

  </script>
 


@endsection

