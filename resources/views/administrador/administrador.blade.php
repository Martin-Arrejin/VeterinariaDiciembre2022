@extends('administrador.plantillaAdmin')
<style>
body{
  padding: 0px;
  margin: 0px;
}
.container{
  width: 100%;
  height: 500px;

} 

</style>
<body>
@section('contenido')
<div class="main_content">
  <div class="text-center ">
    <div class="header"><h2 class="text-dark fw-bold">Bienvenido al Sistema Administrador</h2></div>  
  </div>   
  <div class="container-fluid">
  <div class="row">
  <div class="col-1"></div>
  <div class="col-10 text-center">

     <img src="../iconos/fondo_administrador.png" alt="administrador" height="600" width="600" > 
   </div>
   <div class="col-1 "></div>
  </div>
  </div>
@endsection

</body>

















