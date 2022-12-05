
<!doctype html>
<html lang="en">
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
    <link rel="stylesheet" type="text/css" href="{{asset('estilo.css')}}">
    <link rel="icon" href={{asset('iconos/huella.png')}} >
<title>Clínica Veterinaria San Agustín</title>
  </head>
   <!-- Cabezera barra -->
    <header class="container-fluid d-flex justify-content-center m-0 p-1" id="barra">
    <p class="text-light fs-6" >Contacto(0343) 407-7466</p>
    </header>

    <!-- Menú -->
     <nav class="navbar navbar-expand-lg navbar-light bg-light m-0 p-3" id="menu">
        <div class="container-fluid" >
            <div class="logo">
            <img src="{{asset('iconos/logo-sin-fondo.png')}}" alt="logo_principal"  >
             </div>
            <button class="navbar-toggler"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="#servicio">Servicios</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{'/seleccionTurno'}}">Turnos</a>
                </li>
             <a class="nav-link" href="{{'/fechaVacunacion'}}">Crónograma de Vacunación</a>
              </li>
              
            
              
             {{--  <li class="nav-item">
                <a class="nav-link" href="{{'/fechaVacunacion'}}">Quienes Somos</a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link" href="/login">Iniciar sesión</a>
              </li>
              
            </ul>
            
          </div>
        </div>
      </nav>
      
      @yield('contenido') 
      @yield('footer') 
     
      

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
</body>
</html>