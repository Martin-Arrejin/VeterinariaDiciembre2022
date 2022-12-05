
@extends('plantillaPrincipal')


@section('contenido')


<!-- Slider de imagenes  -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./img_veterinaria/perrito.jpg" class="d-block w-100" alt="perro">
      <div class="carousel-caption d-none d-md-block">
        <h5>Nos encanta cuidar a tus mascotas</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./img_veterinaria/gatito.jpg" class="d-block w-100" alt="gato" >
      <div class="carousel-caption d-none d-md-block">
        <h5>Ellos y nosotros felices</h5>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./img_veterinaria/perritofeliz.jpg" class="d-block w-100" alt="perro en casa">
      <div class="carousel-caption d-none d-md-block">
        <h5>Gracias por elegirnos</h5>
        
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Antes</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>
{{-- <div class="texto">
      
  <img class="btn-whatsapp" src="./iconos/whatsapp.png" width="64" height="64" alt="WhatsApp" onclick="window.location.href='https://wa.me/5493434652868?text=Hola!%20Estoy%20interesado%20en%20tu%20servicio'">
   </div> --}}

<!--Social SiderBar-->
<ul id="social-sidebar">

   <a class="entypo-chat" onclick="window.location.href='https://wa.me/5493434652868?text=Hola!%20Estoy%20interesado%20en%20tu%20servicio'"><span>WhatsApp</span></a>


   <a class="entypo-instagrem" href="https://www.instagram.com/veterinaria.sanagustin/?hl=es"><span>Instagram</span></a>

</ul>

<!--Introduccion  -->
<section class="w-auto mx-auto text-center p-1 border-top 1 border-bottom 1 " id="intro">
<h1 class="p-3 titulo" id="titulo_intro">Veterinaria San Agustín, <span class="text-dark">con más de 20 años de experiencia </span></h1>
 <p>La atención, la dedicación, los productos de calidad són los valores que llevamos día a día. </p>
 <p>Gracias a nuestros clientes y sus mascotas. </p>
 </section>
   <!--Servicios  -->
<div class="w-auto text-center" id="servicios">
  <h1 class="text-light text-center p-2 m-2 fs-1 fw-bold" id="servicio">Servicios</h1>
 {{--  <div class="row w-75 mx-auto p-2 m-1"> --}}
    <div class="row p-2 m-1">
    <div class="col-lg-6 col-md-12 p-2">
      <div>
        <h3>Clínica Veterinaria</h3>
        <p>Consultas y servicio de internación</p>
      </div>
      <img src="./iconos/emergencia.png" alt="emergencias" height="160" width="160" class="iconos" id="boton"> 
     </div>
     <div class="col-lg-6 col-md-12 p-2">
      <div>
        <h3>Peluqueria Canina</h3>
        <p>Peinado, baño, masajes para tus mascotas</p>
      </div>  
        <img src="./iconos/peluqueria.png" alt="consulta"  height="160" width="160" class="iconos" >
        </div>
        
  </div>
{{--  <div class="row w-75 mx-auto p-2 m-1"> --}}
<div class="row mx-auto p-2 m-1">
        <div class="col-lg-6 col-md-12 p-2">
          <div class="texto_servicio">
            <h3>Pet Shop</h3>
            <p>Alimentos balanceados, accesorios para tus mascotas </p>
          </div>  
            <img src="./iconos/petshop.png" alt="consulta"  height="160" width="160" class="iconos">
            </div>
         
            <div class="col-lg-6 col-md-12 p-2">
              <div>
                <h3>Consultas</h3>
                <p>Fechas de vacunación y desparasitación</p>
              </div>  
                <img src="./iconos/consultas.png" alt="consulta"  height="160" width="160" class="iconos">
                </div>
           
    </div>    
</div>
  

<!--Efecto Parrallax Productos -->

<section class="parrallax" id="seccion_parrallax">
<div> 
<h1 class="justify-content-center text-black ">
<p>Trabajamos con todos los productos de primeras <br>
marcas y tenemos todos los accesorios para tus mascotas</p>
</h1>
</div>

</section>

<script type="text/javascript">
  
  const boton =document.getElementsByClassName("iconos");
  for(let i=0;i<boton.length;i++){
    boton[i].addEventListener('click', hacerVibrar);
  }
    function hacerVibrar(){
    window.navigator.vibrate([1000]);
   
  }
</script>


@endsection

@extends('footer')
