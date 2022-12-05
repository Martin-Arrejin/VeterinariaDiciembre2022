
<!doctype html>
<html lang="en">
  <head>
    <!-- jquery-->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin ="anonymous"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Required meta tags -->
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

{{--         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <!--  iconos -->
    <script src="https://kit.fontawesome.com/b610c83f26.js" crossorigin="anonymous"></script>
 

      <!-- estilos CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('estiloLogin.css')}}">
    <link rel="icon" href={{asset('iconos/huella.png')}} >
          <!-- data table CSS-->
    <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

<title>Usuario Cajero</title>

<style>
     .fondo_cajero{
  
  color:#000000!important;

  
   
  } .a{
    color:#ffffff!important;
  }



.navbar-expand-lg .navbar-nav .nav-link{
  padding-left: 0.5rem;
  color:  rgb(235, 34, 58)  !important;
}. a:hover{
    color:#ffffff;
  
}
table th{
      background-color: rgb(235, 34, 58) !important;
      color:#ffffff;
  }
  table td{
      background-color: rgb(255, 255, 255) !important;
      color:#000000;
  }
  .caja_tabla-2{
  
      margin: 15px;
  }
  .btn-link:hover{
    
    color: red;
  }

  .btn-link {
    text-decoration: none; 
    color: red;
  }
  #notificacion:focus {
    outline: none;
    box-shadow: none;
}
.i{
  color: red;
}
.dropdown-item{
  color: red !important; 
}
body{
	min-height: 150vh;
/* 	background-image: linear-gradient(120deg, #ff5e5ec6, #cd6109c6);  */
background-color: silver;
}
.form-group{
    background-color: rgb(235, 34, 58) !important;
  
    width:auto;
    height: auto;
    margin: 10px;
    padding: 10px;
    
}
.form-label{
   color:#ffffff;
}
#notificacion{
  cursor: pointer;
}


    </style>
  </style>
  <!-- Estadisticas año y mes actual-->
@php
$añoActual= Carbon\Carbon::now()->format('y');
$mesActual= Carbon\Carbon::now()->format('m');
@endphp
<!-- Inicio de Menu -->
<body>
<nav class="navbar navbar-expand-lg navbar-light  bg-light m-0 p-3 text-info" >
  <div class="container-fluid" >
    <div class="logo">
      <img src="{{asset('iconos/logo-sin-fondo.png')}}" alt="logo_principal" >
       </div>
   
 
      <button class="navbar-toggler"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item p-2">
              <a class="nav-link " href="/vistaRoles/cajero"  title="Inicio"><i class="fa-solid fa-house"></i> Inicio</a>
            
            </li>
            <li class="nav-item p-2">
              <a class="nav-link" href="/articulos" title="Articulos"><i class="fa-solid fa-store"></i> Articulos</a>
            </li>
            
            <li class="nav-item p-2">
              <a class="nav-link" href="/ventas" title="Realizar Ventas"><i class="fa-solid fa-cart-shopping"></i> Ventas</a>
            </li>
            <li class="nav-item p-2">
              <a class="nav-link" href="/categorias" title="Categorias"><i class="fa-solid fa-book-open"></i> Categorias</a>
            </li>
            <li class="nav-item p-2">
              <a class="nav-link" href="/vencimientos" title="Vencimientos de Productos"><i class="fa-solid fa-calendar-days"></i> Vencimientos 
              @if(session()->exists('notificacionVencido'))
                <span class="position-absolute  translate-middle badge rounded-pill bg-danger">
                {{session('notificacionVencido')}} 
                 <span class="visually-hidden">unread messages</span>
                </span>
            @endif
            </a>
            </li>
            <li class="nav-item p-2">
              <a class="nav-link"  id ="notificacion" ><i class="fa-solid fa-bell"></i> Notificaciones 
            @if(session()->exists('notificacion'))
                <span class="position-absolute  translate-middle badge rounded-pill bg-danger">
                {{session('notificacion')}} 
                 <span class="visually-hidden">unread messages</span>
                </span>
            @endif
              </a>     
            </li>
            <li class="nav-item dropdown p-2">
                
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" title="Estadisticas"> <i class="fa-sharp fa-solid fa-chart-simple"></i> Estadisticas </a>
            <ul class="dropdown-menu">
            <li class="nav-item"><a class="dropdown-item"  href="/estadistica/ganancia/por_mes/{{$añoActual}}"><i class="fa-sharp fa-solid fa-cart-shopping"></i> Ventas anuales</a></li>
       
            <li><a class="dropdown-item" href='/estadistica/articulos/MasVendidos/{{$mesActual}}' ><i class="fa-solid fa-bag-shopping"></i> Articulos más vendidos en el mes</a></li>
            </ul>
            </li>

            @if(auth()->user())
            <li class="nav-item dropdown p-2">
                
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" title="Usuario"> <i class="fa-solid fa-user"></i> Usuario: {{auth()->user()->tipo}}</a>
              <ul class="dropdown-menu">
              @if(auth()->user()->tipo == 'admin')
              <li class="nav-item"><a class="dropdown-item"  href="/usuario/Admin/ingresoAOtro/4"><i class="fa-solid fa-house"></i> Volver a admin </a></li>
              @endif
              <li><a href='#' class="dropdown-item " onclick ="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-to-bracket"></i> Cerrar</a></li>
              </ul>
              </li>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
              </form>
              @endif


            

  </div>
   
    

</nav>

</div>

<div class="container">
  @yield('contenido')
</div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


 {{--      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}
 
<script>
 var notificacion = document.getElementById('notificacion');
 notificacion.blur();
notificacion.addEventListener('click',function(){
  
  location.href='/notificaciones';
});


</script>

</body>
<!-- <SCRIPT LANGUAGE="JavaScript">
history.forward()
</SCRIPT> -->