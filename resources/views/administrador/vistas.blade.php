      @extends('administrador.plantillaAdmin')
    
     

        @section('contenido')
        <div class="main_content">
          <div class="content">
         
            <div class="header"><h2 class="text-dark fw-bold text-center">Vistas del Sistema</h2></div>    
            <div class="content text-center p-2">
              <div class="row">
                  <div class="col-12 content-fluid d-flex justify-content-center p-2 "></div>
                       
              </div>
          <div class="content m-4 p-4">
            <div class="row text-center">
           
            <div class="col-3 content-fluid d-flex justify-content-center "><a href="/usuario/Admin/ingresoAOtro/1"><button type="button" class="boton_veterinario"  ><i class="fa-solid fa-dog"></i> Veterinario</button></a></div>
            <div class="col-3 content-fluid d-flex justify-content-center "><a href="/usuario/Admin/ingresoAOtro/3" ><button type="button" class="boton_cajero" ><i class="fa-solid fa-cart-shopping"></i> Cajero</button></a> </div>
            <div class="col-3 content-fluid d-flex justify-content-center"><a href="/usuario/Admin/ingresoAOtro/2" ><button type="button" class="boton_peluquero" ><i class="fa-solid fa-scissors"></i> Peluquero</button></a></div>
            <div class="col-3 content-fluid d-flex justify-content-center"><a href="/" ><button type="button" class="boton_cliente" ><i class="fa-solid fa-person"></i> Cliente</button></a></div>
             
            </div>
          
  
        </div>
      </div>


  @endsection