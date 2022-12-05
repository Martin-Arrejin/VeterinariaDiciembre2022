@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@section('contenido')
@extends('administrador.plantillaAdmin')
<style>
    *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style: none;
  text-decoration: none;
/*   font-family: 'Josefin Sans', sans-serif; */
}
    body{
        min-height: 150vh;
        background-image: linear-gradient(120deg, #ffffff, #8e44ad);
    }
    .card-header{
        background-color: rgba(100, 83, 153, 1) !important;
        border-left-color: #CCC;
        color:#ffffff;
      
    }

    
    </style> 

</div>
    <div class="row justify-content-center">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Registrar Usuario') }}</div>
                <div class="container-fluid d-flex justify-content-center ">
                    <img src="../iconos/logo_footer.png"  height="150" width="150"> 
                    </div>
                <div class="card-body">
                    <form method="POST" action="/registrado">
                        @csrf
                        @method('Post')

                        <div class="form-group row m-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row  m-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row m-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row m-2">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row m-2">
                            <label for="tipo" class="col-md-4 col-form-label text-md-right">Rol de Usuario</label>
                            <div class="col-md-6">
                                <select class='form-select selecTipo' name= 'tipo'>
                                    <option class='form-option' value ='admin'>Administrador</option>
                                    <option class='form-option' value ='veterinario'>Veterinario</option>
                                    <option class='form-option' value ='peluquero'>Peluquero</option>
                                    <option class='form-option' value ='cajero'>Cajero</option>
                                </select>
                            <div>
                        </div>

                        

                        <div class="form-group m-4 container-fluid d-flex">
                            <button  class="btn btn-dark m-3">
                                {{ __('Cancelar') }}
                                    </button>
                         {{--    <div class="col-md-6 offset-md-4"> --}}
                                <button type="submit" class="btn btn-primary m-3">
                                    {{ __('Guardar') }}
                                 {{--    {{ __('Register') }} --}}
                                </button>
                               
                           {{--  </div> --}}
                        </div>
                    </form>
                </div>
            </div>
           
        </div>
        <div class="col-md-2"></div>
    </div>
 

@endsection
