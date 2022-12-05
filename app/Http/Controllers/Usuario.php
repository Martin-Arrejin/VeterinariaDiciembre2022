<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class Usuario extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = user::all();
        return view('administrador.usuarios')->with('usuarios', $usuarios);
    }



    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @param  \App\Models\loteDescripcion  $loteDescripcion
     * @return \Illuminate\Http\Response
     */
    public function CambioEstadoInicio($id)
    {
        $idUsuario              = auth()->user()->id;
        $usuario                = user::find($idUsuario);
        if($id == 1){
            $usuario->estadoIngreso ='veterinario';
            $usuario->save();
        }

        if($id == 2){
            $usuario->estadoIngreso ='peluquero';
            $usuario->save();
        }
        if($id == 3){
            $usuario->estadoIngreso ='cajero';
            $usuario->save();
        }
        if($id == 4){
            $usuario->estadoIngreso ='';
            $usuario->save();  
        }
        return redirect('/vistaRoles');
    }


    

     /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @param  \App\Models\loteDescripcion  $loteDescripcion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = user::find($id);
        return view ('administrador.editar')->with('usuario',$usuario);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @param  \App\Models\loteDescripcion  $loteDescripcion
     * @return \Illuminate\Http\Response
     */
    public function editPassword($id)
    {
        $usuario = user::find($id);
        return view ('administrador.editPassword')->with('usuario',$usuario);
    }

    /**
     * Update the specified resource in storage.
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $request->validate([
        'mail'     => 'required| string |email |max:255 ',
        'tipo'     => 'required| string',
     ]);

        $usuario = user::find($id);
        $usuario->email    = $request->mail;
        $usuario->tipo     = $request->tipo;
        $usuario->save();
        return redirect('/usuario');
    }



     /**
     * Update the specified resource in storage.
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {  
     $request->validate([
        'password' => 'required| string|min:8',
     ]);
        $usuario = user::find($id);
       
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        return redirect('/usuario');
    }
    



     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.registro');
        //if(auth()->user()->tipo == 'admin'){
        //    return view('auth.registro');
       // }
        // else{
        //     return redirect('/login');
        // }
    }

 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(auth()->user()->tipo != 'admin'){
        //     return redirect('/login');
        // }

        $request->validate([
             'name'     => 'required| string | max:255',
             'email'    => 'required| string |email |max:255 |unique:users',
             'password' => 'required| string|min:8|confirmed',
             'tipo'     => 'required| string',
        ]);

        $usuario = User::Where('email',$request->email)->get();

        if($usuario->isEmpty()){
        
            $usuario = new User();
            $usuario->name     = $request->name;
            $usuario->email    = $request->email;
            $usuario->password = Hash::make($request->password);
            $usuario->tipo     = $request->tipo;
            $usuario->save();
        return redirect('/usuario');

        }
        else{
            
        Session::flash('message','El usuario ingresado ya se encuentra registrado');
        return redirect('/registro/usuario');
        }
    }


        /**
         * Remove the specified resource from storage.
        * 
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function destroy($id, Request $request)
        {   if(auth()->user()->id != $id){
                $usuario = user::find($id);
                $usuario->delete();
            }
            return redirect('/usuario');
        }


}
