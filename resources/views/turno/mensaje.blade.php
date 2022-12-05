@extends((auth()->user()->tipo == 'admin')? ((auth()->user()->estadoIngreso =='veterinario')? 'layouts.plantillaBase':'layouts.plantillaBase3') : ( (auth()->user()->tipo == 'veterinario')? 'layouts.plantillaBase' :'layouts.plantillaBase3'))

<!--Jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!--Floating WhatsApp css-->
<link rel="stylesheet" href="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.css">
<!--Floating WhatsApp javascript-->
<script type="text/javascript" src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/floating-wpp.min.js"></script>
<style>


*{
	margin: 0;
	padding: 0;
	text-decoration: none;
	font-family: "Montserrat", sans-serif;
}

body{
	min-height: 150vh;
	background-image: linear-gradient(120deg, #ef0f56, #8e44ad);
    
}

.formulario{
	width: 600px;
	background: #f1f1f1;
	height: auto px;
	padding: 80px 40px; 
	border-radius: 10px;
	position: absolute;
	left: 50%;
	top: 85%;
	transform: translate(-50%, -50%);
	box-shadow: 2px 2px 10px 5px rgba(0, 0, 0, 0.2);
}

.formulario h1{
	text-align: center;
	margin-bottom: 60px;
	color: #333;
	font-weight: 600;
    font-size: 30px;
}

.box-input{
	border-bottom: 2px solid #adadad;
	position: relative;
	margin: 30px 0;
}

.box-input input{
	font-size: 16px;
	color: #333;
	border: none;
	width: 100%;
	outline: none;
	background: none;
	padding: 0 5px;
	height: 40px;
}

.box-input span::before{
	content: attr(data-placeholder);
	position: absolute;
	top: 50%;
	left: 5px;
	color: #adadad;
	transform: translateY(-50%);
	z-index: -1;
	transition: .5s;
}

.box-input span::after{
	content: '';
	position: absolute;
	width: 0%;
	height: 2px;
	background: linear-gradient(120deg, #3498db, #8e44ad);
	transition: .5s;
}

.focus + span::before{
	top: -5px;
}

.focus + span::after{
	width: 100%;
}

.boton{
	display: block;
	width: 100%;
	height: 50px;
	background-color: #48bb78;
	border: solid 2px #48bb78;
	color: #fff;
	border-radius: 5px;
	font-weight: 600;
	font-size: 18px;
	box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.1);
}

.boton:hover{
	background-color: #2F855A;
	border: solid 2px #2F855A;
	transition: .5s;
}

</style>
@section('contenido')


    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
<input type="hidden" id="nombre" value="{{$persona->nombre}} {{$persona->apellido}}">
<input type="hidden" id="telefono" value="{{$celular}}">
<input type="hidden" id="fecha" value="{{$fecha}}">
<input type="hidden" id="hora" value="{{$hora}}">


    <form id="formulario" class="formulario">
        <h1>Enviar Turno al WhatsApp <br>del Cliente </h1>
      
        <div class="box-input">
            <label>Nombre del Cliente</label>
            <input name="nombre" id="nombre" type="text" class="text-center fs-3" value="{{$persona->nombre}} {{$persona->apellido}}" disabled>
             </div>
             <div class="box-input">
                <label>Teléfono</label>
                <input name="telefono" id="telefono" type="text" class="text-center fs-3" value="{{$celular}}" disabled>
                 </div>
        <div class="box-input">
            <label>Turno</label>
            <input name="fecha_hora" id="fecha_hora" class="text-center fs-4" type="text" value="Fecha: {{$fecha}} &nbsp; Hora: {{$hora}}" disabled>
          
        </div>
        <div class="box-input" >
            <label>Mensaje</label>
            <input name="mensaje" id="mensaje" class="text-center" type="areatext" value=" Gracias por elegirnos.🐶🐱"disabled >
            
        </div>
       
        <button id="submit" type="submit" class="boton"><i class="fab fa-whatsapp"></i> Enviar WhatsApp</button>
    </form>

<script>
     function isMobile() {
    if (sessionStorage.desktop)
        return false;
    else if (localStorage.mobile)
        return true;
    var mobile = ['iphone', 'ipad', 'android', 'blackberry', 'nokia', 'opera mini', 'windows mobile', 'windows phone', 'iemobile'];
    for (var i in mobile)
        if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0) return true;
    return false;
}

const formulario = document.querySelector('#formulario');
const buttonSubmit = document.querySelector('#submit');
const urlDesktop = 'https://web.whatsapp.com/';
const urlMobile = 'whatsapp://';
const telefono = document.querySelector('#telefono').value;
console.log(telefono);

formulario.addEventListener('submit', (event) => {
    event.preventDefault()
    console.log('entro');
    console.log(telefono);
    buttonSubmit.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>'
    buttonSubmit.disabled = true
    setTimeout(() => {
        let nombre = document.querySelector('#nombre').value;
         let fecha = document.querySelector('#fecha_hora').value; 
       
        let mensajeFormulario = document.querySelector('#mensaje').value;
        let mensaje = 'send?phone=' + telefono + '&text=*‼️Recordario de Turno‼️*%0A' 
        +'Estimado/a: '+ nombre + '%0A'+ fecha +'%0A'+ mensajeFormulario +'%0A*VETERINARIA SAN AGUSTIN*%0A' ;
        if(isMobile()) {
            window.open(urlMobile + mensaje, '_blank')
        }else{
            window.open(urlDesktop + mensaje, '_blank')
        }
        buttonSubmit.innerHTML = '<i class="fab fa-whatsapp"></i> Enviar WhatsApp'
        buttonSubmit.disabled = false
    }, 10);
});

    </script> 

  {{--   <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- <script src="whatsapp.js"></script> --> --}}
</body>
</html>

























{{-- <input type="hidden" id="nombre" value="{{$persona->nombre}} {{$persona->apellido}}">
<input type="hidden" id="telefono" value="{{$persona->telefonos[0]->numero}}">
<input type="hidden" id="fecha" value="{{$fecha}}">
<input type="hidden" id="hora" value="{{$hora}}">


<h2 class="text-center p-2 m-2 fs-1 fw-bold text-dark" >Desear Enviar el Mensaje WhatsApp<div id="WAButton" class="icono"></div>
</h2>



<script>  

window.onload = function(){ 
 
var nombre = document.getElementById('nombre').value; 
var telefono = '+549343'+ document.getElementById('telefono').value; 
var fecha = document.getElementById('fecha').value;
var hora = document.getElementById('hora').value; 



    $(function(){
    
       $('#WAButton').floatingWhatsApp({
         phone: telefono, //WhatsApp Business phone number International format-
         //Get it with Toky at https://toky.co/en/features/whatsapp.
         headerTitle: '--Veterinaria San Agustin--', //Popup Title
         popupMessage: 'Notificación Turno:'+telefono, //Popup Message
         showPopup: true, //Enables popup display
         size:'120px',
         message: 'Hola ,'+nombre+','+' le informamos, que en la fecha y horario '+fecha+' '+hora+' '+'tiene el turno correspondiente.Gracias'

/*             buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" />', //Button Image */
         //headerColor: 'crimson', //Custom header color
         //backgroundColor: 'crimson', //Custom background button color
        /*  position: "center"  */

       });
     });

 } 



  
     </script>  
 --}}

@endsection