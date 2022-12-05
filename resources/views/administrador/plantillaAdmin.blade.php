
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

<title>Administrador</title>

<style>
.boton_crear {

color:#000000;

margin: 10 0 10 -10 !important;
width: 160 !important;
border-radius: 20px !important;

 
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
padding-left: 3rem;

}
body{
  min-height: 150vh;
  background-color: rgba(100, 83, 153, 0.3) !important;
}
.boton_cliente{
      width: 200px;
      height:200px;
      color:#ffffff;
     background-color: rgb(121, 110, 110) !important;
     border:1px solid rgb(255, 255, 255);
     -moz-box-shadow:0 5px 5px rgba(182, 182, 182, 0.75);
   -webkit-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   border-radius: 5px 5px 0 0;  
  }
  .boton_cliente:hover{

background: #5718EC;
background: -webkit-radial-gradient(top left, #655980, #43989E);
background: -moz-radial-gradient(top left, #655980, #43989E);
background: radial-gradient(to bottom right, #655980, #43989E);
  }

  .boton_veterinario{
      width: 200px;
      height:200px;
      color:#ffffff;
     background-color: rgba(100, 83, 153, 1) !important;
     border:1px solid rgb(255, 255, 255);
     -moz-box-shadow:0 5px 5px rgba(182, 182, 182, 0.75);
   -webkit-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   border-radius: 5px 5px 0 0;  
  }
  .boton_veterinario:hover{

background: #5718EC;
background: -webkit-radial-gradient(top left, #5718EC, #43989E);
background: -moz-radial-gradient(top left, #5718EC, #43989E);
background: radial-gradient(to bottom right, #5718EC, #43989E);
  }
  .boton_cajero{
      width: 200px;
      height:200px;
      color:#ffffff;
      background-color: rgb(233, 46, 49) !important;
      border:1px solid rgb(255, 255, 255);
      -moz-box-shadow:0 5px 5px rgba(182, 182, 182, 0.75);
   -webkit-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75); 
   border-radius: 5px 5px 0 0;  
  }
  .boton_cajero:hover{
      background: #FF0119;
      background: -webkit-radial-gradient(top left, #FF0119, #3AA6AD);
      background: -moz-radial-gradient(top left, #FF0119, #3AA6AD);
      background: radial-gradient(to bottom right, #FF0119, #3AA6AD);
  }
  .boton_peluquero{
      width: 200px;
      height:200px;
      color:#ffffff;
      background-color: rgb(62, 46, 233,1) !important;
      border:1px solid rgb(255, 255, 255);
      -moz-box-shadow:0 5px 5px rgba(182, 182, 182, 0.75);
   -webkit-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
   box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75); 
   border-radius: 5px 5px 0 0;  
  }
  .boton_peluquero:hover{
      
      background: #1A01FF;
      background: -webkit-radial-gradient(top left, #1A01FF, #3AA6AD);
      background: -moz-radial-gradient(top left, #1A01FF, #3AA6AD);
      background: radial-gradient(to bottom right, #1A01FF, #3AA6AD);
  }

.dropdown {

  position: relative;
  text-decoration: none;
}
.dropdown-content {
  display: none;
  position: relative;
 
  width: 100%;
  overflow: auto;
  box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.4);
}
.dropdown:hover .dropdown-content {
  display: block;
}
.dropdown-content a {
  display: block;
  color: #ffffff;


}
a{
  text-decoration: none;
}
.dropdown-content a:hover {
  color: #FFFFFF;
  background-color: rgba(100, 83, 153, 0.4) !important;
  text-decoration: none;
}

</style> 
@php
    $añoActual= Carbon\Carbon::now()->format('y');
    $mesActual= Carbon\Carbon::now()->format('m');
 @endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu Administrador </title>

  <link rel="stylesheet" type="text/css" href="{{asset('estiloAdmin.css')}}">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>

<div class="wrapper">
  <div class="sidebar">
              <div class="text-center m-1 p-1">
              <img src="/iconos/logo_footer.png"  alt="logo_principal" height=130 width=130 >
              </div>
     
  
        <ul>
            <li><a href="/login/administrador"><i class="fas fa-home"></i> Inicio</a></li>
            <li><a href="{{'/usuario'}}" title="crear usuarios"><i class="fa-solid fa-users" ></i> Usuarios</a></li>
            <li><a href="{{'/login/administrador/vistas'}}" title="interfaces"><i class="fas fa-project-diagram"></i>Vistas</a></li>
            <li><a href="{{'/login/administrador/posteo'}}" title="Posteo"><i class="fa-solid fa-pen-to-square"></i> Posteo Web</a></li>
        
            <div class="dropdown">
              <li><a class="text-white" title="Estadisticas de Ventas, Clientes y Artículos"><i class="fa-sharp fa-solid fa-chart-simple text-white"></i> Estadisticas</a></li>
              <div class="dropdown-content ">
                <li><a href="/estadistica/ganancia/por_mes/{{$añoActual}}">Ventas</a></li>
                  <li><a href="/estadistica/articulos/MasVendidos/{{$mesActual}}">Artículos</a></li>
                    <li><a href="/estadistica/clientesNuevosPorMes/{{$añoActual}}">Clientes</a></li>
              </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
{{--             <li><a href="#" ><i class="fa-solid fa-right-from-bracket"></i> Cerrar</a></li> --}}
            <li><a href='#'   onclick ="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket"></i> Cerrar</a></li>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            
          </ul> 

   
    </div>



    @yield('contenido')




<body>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



</body>