<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use illuminate\Support\Facades\Auth;
use illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vistaRoles()
    {
           
        if((auth()->user()->tipo == 'veterinario')||((auth()->user()->tipo == 'admin') && auth()->user()->estadoIngreso =='veterinario')){
            return view('empresa.veterinario.veterinario');
        }
        if((auth()->user()->tipo == 'cajero')||((auth()->user()->tipo == 'admin') && auth()->user()->estadoIngreso =='cajero')){
            $url = url()->previous();
            
            
            if((Str::contains($url, '/vistaRoles'))or(Str::contains($url, '/login'))){
                
                $fechaActual = Carbon::now();
                $resultados  = DB::select('select lote_descripcions. *, articulos.codigo, articulos.descripcion, articulos.marca,articulos.alerta, TIMESTAMPDIFF(DAY,CURDATE(), lote_descripcions.vencimiento) AS dias from lote_Descripcions inner join articulos on (articulos.id = lote_Descripcions.articulo_id) where ((lote_descripcions.vencimiento <= CURDATE())and(lote_Descripcions.estado = 1)) or ((articulos.alerta >= TIMESTAMPDIFF(DAY,CURDATE(), lote_descripcions.vencimiento) )and(lote_Descripcions.estado = 1)and(articulos.alerta <> 0))');
                $cantidad    = count($resultados);
                
                session(['notificacionVencido' =>$cantidad]);


                




                return view('empresa.cajero.cajero');
            }
            



            return view('empresa.cajero.cajero');
        }
        if((auth()->user()->tipo == 'peluquero')||((auth()->user()->tipo == 'admin') && auth()->user()->estadoIngreso =='peluquero')){
            return view('empresa.peluquero.peluquero');
        }
        if(auth()->user()->tipo =='admin'){
            return view('administrador.vistas');   
        }




        
        if (is_null(auth()->user()->tipo)){
            
            Auth::logout();
            
            return redirect('/login');
            
        }

    }



}
