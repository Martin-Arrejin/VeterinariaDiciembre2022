
<!doctype html>

  <head>
    <!--  iconos -->
    <script src="https://kit.fontawesome.com/b610c83f26.js" crossorigin="anonymous"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
      <!-- estilos CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('estiloLogin.css')}}">
    <link rel="icon" href={{asset('iconos/huella.png')}} >
          <!-- data table CSS-->
    <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<title>Usuario Veterinario</title>

<style>
  .boton_crear {
  
  color:#000000;
  
  margin: 10 0 10 -10 !important;
  width: 160 !important;
  border-radius: 20px !important;
  
   
  }
  .form-group{
    background-color: rgba(100, 83, 153, 1) !important;
    margin: 5px;
    padding: 5px;
    width:auto;
    height: auto;
    color:#ffffff;
    
}
.form-label{
   color:#ffffff;
}

  table th{
    background-color: rgba(100, 83, 153, 1) !important;
    color:#ffffff;
}
table tr{
    background-color: rgb(255, 255, 255,1) !important;
    color:#000000;
}

  .caja_tabla-2{
  
      margin: 15px;
  }

.navbar-expand-lg .navbar-nav .nav-link{
  padding-left: 2rem;
 
}
body{
	min-height: 150vh;
	background-image: linear-gradient(120deg, #ffffffae, #8e44ad);
}
.barra { 
 background-color:#000000;
 }
 
  </style>
@php
  $añoActual= Carbon\Carbon::now()->format('y');
  $mesActual= Carbon\Carbon::now()->format('m');
@endphp

<!-- Inicio de Menu -->
<body class="fondo_veterinario">
<nav class="navbar navbar-expand-lg navbar-light  bg-light m-0 p-3" >
  <div class="container-fluid" >
    <div class="logo">
      <img src="{{asset('iconos/logo-sin-fondo.png')}}" alt="logo_principal" >
       </div>
   
 
      <button class="navbar-toggler"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            

            @if(auth()->user()->tipo !='veterinario')
            <li class="nav-item p-2">
              <a class="nav-link " href="/vistaRoles"  title="Inicio"><i class="fa-solid fa-house"></i> Inicio</a>
            
            </li>
            @endif
            
            <li class="nav-item p-2">
              <div class="dropdown">
              <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-calendar-days"></i>
                     Turnos
              </a>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/tipoTurno/1"><i class="fa-solid fa-calendar-days"></i> Turnos en el dia</a></li>
                  <li><a class="dropdown-item" href="/tipoTurno/2"><i class="fa-solid fa-calendar-days"></i> Turnos en el semana</a></li>
                  <li><a class="dropdown-item" href="/tipoTurno/3"><i class="fa-solid fa-calendar-days"></i> Turnos libres</a></li>
                  <li><a class="dropdown-item" href="/tipoTurno/5"><i class="fa-solid fa-calendar-days"></i> Turnos pasados</a></li>
                  <li><a class="dropdown-item" href="/tipoTurno/4"><i class="fa-solid fa-calendar-days"></i> Todos los turnos</a></li>
                  </ul>
              </div>
            </li>

            <li class="nav-item p-2">
              <div class="dropdown">
                <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-person"></i>
                       Clientes
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="/personas/estado/1"><i class="fa-solid fa-user-plus"></i> Clientes Activos</a></li>
                  <li><a class="dropdown-item" href="/personas/estado/0"><i class="fa-solid fa-user-xmark"></i> Clientes Inactivos</a></li>
              </ul>
              </div>
            </li>
            <li class="nav-item p-2">
              <div class="dropdown">
                <a class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-dog"></i>
                  Mascotas
           </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/mascotas"><i class="fa-solid fa-dog"></i>+  Mascotas Activas</a></li>
              <li><a class="dropdown-item" href="/mascotas/verMascotasDeshabitadas"><i class="fa-solid fa-dog"></i>x Mascotas Inactivas</a></li>
          </ul>
        </li>
          
            @if(auth()->user()->tipo !='peluquero')
            <li class="nav-item p-2">
              <a class="nav-link" href="/historialesClinicos" title="Ver Historial"><i class="fa-solid fa-notes-medical"></i> Ver Historial</a>
            </li>
            @endif
            <li class="nav-item dropdown p-2">
                
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" title="Estadisticas"> <i class="fa-sharp fa-solid fa-chart-simple"></i> Estadisticas </a>
            <ul class="dropdown-menu">
            <li class="nav-item"><a class="dropdown-item"  href="/estadistica/clientesNuevosPorMes/{{$añoActual}}"><i class="fa-solid fa-user-plus"></i> Nuevos Clientes</a></li>
       
            </ul>
            </li>


              <li class="nav-item dropdown p-2">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" title="Usuario"> <i class="fa-solid fa-user"></i> {{auth()->user()->tipo}}</a>
              <ul class="dropdown-menu cerrar">


              @if(auth()->user()->tipo == 'admin')
              <li class="nav-item "><a class="dropdown-item"  href="/usuario/Admin/ingresoAOtro/4"><i class="fa-solid fa-house"></i> Volver a admin </a></li>
              @endif




              <li><a href='#' class="dropdown-item"  onclick ="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-to-bracket"></i> Cerrar</a></li>
              </ul>
              </li>
              

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>

 
   

  </div>
   
  

   

</nav>

</div>

<div class="container">
  @yield('contenido')
</div>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 


</body>
<SCRIPT LANGUAGE="JavaScript">
history.forward()
</SCRIPT>