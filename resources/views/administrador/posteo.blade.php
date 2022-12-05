@extends('administrador.plantillaAdmin')

<style>
.main_content{
    background-color: rgba(100, 83, 153, 1) !important;
   
}
.form-group{
 
    margin: 5px;
    padding: 5px; 
    width:auto;
    height: 1100px;
    color:#ffffff;
    
}
.form-label{
   color:#ffffff;
   
}.formulario__label{
    font-size: 20px;
}
     
</style>
@section('contenido')



<div class="main_content">
  <div class="content">
 
    <div class="header"><h2 class="text-dark fw-bold text-center">Index Principal</h2></div>    
    <div class="content text-center p-2">
        <div class="form-group">
            <div class="row">
          <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
          
          <div class="container-fluid d-flex justify-content-center ">
            <div class="container  calendario p-3 formulario_turno"> 
           <!-- formulario-->
            <form action="#" method="POST" id="formulario" name="formulario" class=" content-fluid d-flex justify-content-center" > 
                @csrf
                @method('post')
                <div class="form-group">
                    <div class="row">
                    <div class="row container-fluid d-flex justify-content-center formulario">
                      <h4 class="text-center p-2 fs-4">En esta sección podra modificar los datos más importante de la página principal</h4>
                        <div class="col-md-8">
                 <br>
                             <!-- Grupo: Tel-->
                          <div class="formulario__grupo" id="grupo__telefonoFijo">
                            <label for="telefonoFijo" class="formulario__label">Telefonó fijo *</label>
                            <div class="formulario__grupo-input">
                          <input type="text" class="form-control formulario__input" name="telefonoFijo" id="telefonoFijo"  maxlength="8" placeholder="Encabezado" aria-describedby="addon-wrapping" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                     </div>
                     <p class="text-info ">*Esta pregunta es obligatoria</p>
{{--                             <p class="formulario__input-error">El DNI solo puede contener numeros y el maximo son 8 dígitos</p> --}}
                        </div>
                   
                        <!--Grupo Descripción de la empresa-->
                          <div class="formulario__grupo" id="grupo__descripcion">
                        <label for="descripcion" class="formulario__label">Descripción de la Empresa *</label>
                        <div class="formulario__grupo-input">
                         
                          <input type="text" class="form-control formulario__input" id="descripcion" name="descripcion" placeholder="Contenido central" maxlength="16" required>
                 
                          <i class="formulario__validacion-estado fas fa-times-circle"></i>
                              </div>
                      <p class="text-info">*Esta pregunta es obligatoria</p>
{{--                               <p class="formulario__input-error">El Nombre tiene que ser de 4 a 16 dígitos y solo puede contener letras</p> --}}
                          </div>
                
                      <!--Grupo dirección -->
                      <div class="formulario__grupo" id="grupo__direccion">
                        <label for="direccion" class="formulario__label">Dirreción *</label>
                        <div class="formulario__grupo-input">
                        <input type="text" class="form-control formulario__input" id="direccion" name="direccion" placeholder="Pie de página" maxlength="16" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                      </div>
                      <p class="text-info ">*Esta pregunta es obligatoria</p>
{{--                       <p class="formulario__input-error">El direccion tiene que ser de 4 a 20 dígitos y solo puede contener letras</p> --}}
                    </div>
                 

                    <label for="celular" class="formulario__label">Celular *</label>
                   
                            <div class="formulario__grupo" id="grupo__celular">
                              <div class="formulario__grupo-input">
                                  <div class="input-group flex-nowrap">
                                  <span class="input-group-text bg-dark text-white" id="addon-wrapping" title="Código de Area"> <i class="fa-brands fa-whatsapp"></i> </span>
                                  <input type="text" class="form-control  formulario__input" name="celular" id="celular"  maxlength="11" placeholder="WhatsApp (3434...)" required>
                                  <i class="formulario__validacion-estado fas fa-times-circle"></i>
                                </div> 
                           
                                <p class="text-info ">*Esta pregunta es obligatoria</p>
{{--                                 <p class="formulario__input-error">El Celular solo puede contener numeros y el maximo son 11 dígitos</p> --}}
                              </div>
                           
                   
                
                        <label for="instagram" class="formulario__label">Instagram *</label>
                                        
                        <div class="formulario__grupo" id="grupo__instagram">
                        <div class="formulario__grupo-input">
                            <div class="input-group flex-nowrap">
                            <span class="input-group-text bg-dark text-white" id="addon-wrapping" title="link instagram"> <i class="fa-brands fa-instagram"></i></span>
                            <input type="text" class="form-control  formulario__input" name="instagram" id="instagram"  maxlength="50" placeholder="https://" required>
                            <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div> 
                            <p class="text-info ">*Esta pregunta es obligatoria</p>
                        {{--                                 <p class="formulario__input-error">El Celular solo puede contener numeros y el maximo son 11 dígitos</p> --}}
                        </div>
                        </div>
                  
</div>
<label for="instagram" class="formulario__label">Google Maps *</label>
                                        
<div class="formulario__grupo" id="grupo__instagram">
<div class="formulario__grupo-input">
    <div class="input-group flex-nowrap">
    <span class="input-group-text bg-dark text-white" id="addon-wrapping" title="link maps"> <i class="fa-solid fa-location-dot"></i></span>
    <input type="text" class="form-control  formulario__input" name="maps" id="maps"  maxlength="50" placeholder="https://" required>
    <i class="formulario__validacion-estado fas fa-times-circle"></i>
    </div> 
    <p class="text-info ">*Esta pregunta es obligatoria</p>
{{--                                 <p class="formulario__input-error">El Celular solo puede contener numeros y el maximo son 11 dígitos</p> --}}
</div>
</div>
</div>
<br>
<div class="formulario__grupo formulario__btn-enviar">
    <button class="btn btn-dark btn-success"  type="reset" id="cancelar">Borrar</button>
    <button class="btn  btn-dark btn-success" id="botonAceptar" type="submit">Aceptar</button>
</div>
  
</div>        
</div>
 
</form>  
</div> 


</div> 
</main>



     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



  
  @endsection