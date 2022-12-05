     
     @extends('menu')
  
     @section('formulario')
     <!-- Formulario -->
     <style>
    p{
      color:#000000;
      size: 14px;
      text-align: justify;
    }
    table th{
      background-color: rgb(127, 6, 113,0.7) !important;
      color:#ffffff;
  }
  table td{
      background-color: rgba(215, 61, 238, 0.2) !important;
      color:#000000;
  }
     </style>
<body>
 <div class="container-fluid d-flex justify-content-center bg-light">
      <div class="row">
         <div class="col-md-1"></div>
          <div class="col-md-10 col-sm-12 text-center">
              
 <h2>Calendario de vacunas para perros y gatos</h2>
  <br>
  <br>

  <p>Las vacunas obligatorias y opcionales para perros en la la Argentina són, la vacuna contra la rabia es obligatoria dentro del calendario. Se trata de una zoonosis, una enfermedad infecciosa que puede ser trasmitida naturalmente desde los animales a las personas, aunque cada vez es menos común.
  También es obligatorio aplicarle al perro las vacunas que lo protegen contra el virus del moquillo canino y parvovirus.
  Respecto de las opcionales, se encuentran aquellas dosis que protegen al animal frente a leptospirosis, leishmaniosis, parainfluenza, bordetella, Hepatitis infecciosa, enfermedad de Lyme y coronavirus.
 </p>   
 <br>
 <br>
 <!-- Slider de imagenes  -->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./img_veterinaria/perro_vacunacion.jpg" class="d-block w-100" alt="perro">
      <div class="carousel-caption d-none d-md-block">
 
      </div>
    </div>
    <div class="carousel-item">
      <img src="./img_veterinaria/gato_vacunacion.jpg" class="d-block w-100" alt="gato" >
      <div class="carousel-caption d-none d-md-block">
        
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

 <!-- <img src="../iconos/perro_vacuna.jpg" height="auto" width="auto" alt="perro"> -->
 
 <br>
 
 <br>
 <br>  <h3>Calendario de vacunas para perros</h3>
 <table class="table table-striped m-3 p-3">

   <br> 
 
  <thead>
    <tr class="text-center">
      <th scope="col"><i class="fa-solid fa-dog"></i></th>
      <th scope="col">Primera Vacuna</th>
      <th scope="col">Polivalente</th>
      <th scope="col">Refuerzo de la polivalente</th>
      <th scope="col">Contra la rabia</th>
      <th scope="col">Refuerzo de la polivalente-Contra la rabia</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <tr>
      <th scope="row semanas">8 Semanas</th>
      <td><i class="fa-solid fa-paw"></i></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      
    </tr>
    <tr>
      <th scope="row semanas">8-12 Semanas</th>
      <td> </td>
      <td><i class="fa-solid fa-paw"></i></td>
      <td> </td>
      <td> </td>
      <td> </td>
      
    </tr>
    <tr>
    <th scope="row semanas">16 Semanas</th>
    <td colspan="2"></td>
    <td><i class="fa-solid fa-paw"></i></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row semanas">19 Semanas</th>
      <td colspan="2"></td>
      <td></td>
      <td><i class="fa-solid fa-paw"></i></td>
      <td></td>
     
    </tr>
    <tr>
      <th scope="row semanas">12 Meses</th>
      <td colspan="2"></td>
      <td></td>
      <td></td>
      <td><i class="fa-solid fa-paw"></i></td>
     
    </tr>
  </tbody>
</table>
<br>
        
              
    <h3>Calendario de vacunas para gatos </h3>
     <br>
   <p> 
     No son pocas las personas que prefieren tener como mascota a un gato. Aunque se trata de animales más independientes, no por eso los cuidados resultan menores. También es necesario cumplir con un calendario de vacunación, tanto para proteger la salud del animal, como también la de todos aquellos que tengan contacto con él
   </p>   
   <table class="table table-striped">
   

<thead>
    <tr class="text-center">
      <th scope="col"><i class="fa-solid fa-cat"></i></th>
      <th scope="col">Trivalente Felina</th>
      <th scope="col">2do Dosis de Trivalente Felina</th>
      <th scope="col">Leucemia Felina</th>
      <th scope="col">Revacunación Leucemia Felina</th>
      <th scope="col">Rabia</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <tr>
      <th scope="row">8 Semanas</th>
      <td><i class="fa-solid fa-paw"></i></td>
      <td></td>
      <td></td>
      <td> </td>
      <td> </td>
    </tr>
    <tr>
      <th scope="row">11-12 Semanas</th>
      <td> </td>
      <td><i class="fa-solid fa-paw"></i> *</td>
      <td> </td>
      <td> </td>
      <td> </td>
    </tr>
    </tr>
    <tr>
    <th scope="row">16 Semanas</th>
    <td colspan="2"></td>
    <td><i class="fa-solid fa-paw"></i></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">19 Semanas</th>
      <td colspan="2"></td>
      <td></td>
      <td><i class="fa-solid fa-paw"></i></td>
      <td></td>
      
    </tr>
    <tr>
      <th scope="row">12 Meses</th>
      <td colspan="2"></td>
      <td></td>
      <td></td>
      <td><i class="fa-solid fa-paw"></i> **</td>
    </tr>
    <tr>
      <th >importante</th>
      <td>*Aplicación de Vacuna Solo en el caso que el test de Leucemia haya dado negativo</td>
      <td>** Aplicación de la vacuna antirrábica en las comunidades no es obligatoria. </td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
    <div class="col-md-1"></div>
     </div>
    <br>
    <br>
</div>
<br>
<br>
</body>
@endsection

