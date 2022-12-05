<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Telefono;
use App\Models\Turno;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::where('estado','1')->get();
        return view('persona.index')->with('personas', $personas);
    }

    /**
     * Estaditicas de los clientes nuevos por mes.
      * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clientesNuevosPorMes($id)
    {   
        $año = $id;
        $fechaActual = Carbon::createFromDate($id.'-12-31');
        $mesfor      = $fechaActual->format('m')-1+1;
        $año         = $fechaActual->format('Y');
        $arreglo=[]; 
        
         for($i=$mesfor; $i>0; $i--){
            $mesFecha    = $fechaActual->format('m');
            $mesInicio   = $año."-".$mesFecha."-01";
            $diasFin     = $fechaActual->lastOfMonth()->endOfday()->format('d');
            $mesFin      = $año."-".$mesFecha."-".$diasFin;
            
            $clientes = DB::table('Personas')
                                      ->select(DB::raw('count(personas.id) as cantidad'))
                                      ->whereBetween('personas.created_at',[$mesInicio, $mesFin ])
                                      ->get();

           if($clientes[0]->cantidad == null){
                $arreglo[$i]=0;
           }
           else{
                $arreglo[$i]= $clientes[0]->cantidad;
           } 
           $mesFecha    = $mesFecha-1;
           $fechaActual = Carbon::createFromDate($año,$mesFecha,12);
        }
        
        
        $labels      = array('Enero','febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'); 
        $titulo      = 'año:'.$año;
        
        return view('estadistica.estadisticaNuevoClientes')
                                    ->with('arreglo', $arreglo)
                                    ->with('labels',$labels)
                                    ->with('año',$año);
    }

     /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function personasEstado($id)
    {
        if($id == 1)
            {
             $personas = Persona::where('estado','1')->get();
             return view('persona.index')->with('personas', $personas);
            }
        if($id == 0)
        {
            $personas = Persona::where('estado','0')->get();
            return view('persona.indexdisabled')->with('personas', $personas); 
        }
    }


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('persona.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
     $request->validate([
        'nombre'     => 'required| string',
        'apellido'   => 'required| string',
        'dni'        => 'required|integer|max:100000000|min:1000000',
        'direccion'  => 'required|string|max:256| min:4',
        'numeroCalle'=> 'required|integer|min:1|max:9999',
        'codigoArea' => 'required|numeric|max:9999|min:99',
        'telefono'   => 'required|numeric|max:9999999|min:999999',  
    ]);
        $persona = Persona::where('dni',$request->dni)->get();
        if(count($persona) > 0){
            $persona[0]->delete();
        }
        $persona = new Persona();

        $persona->nombre      = $request->get('nombre');
        $persona->apellido    = $request->get('apellido');
        $persona->dni         = $request->get('dni');
        $persona->direccion   = $request->get('direccion');
        $persona->numeroCalle = $request->numeroCalle;
        $persona->estado      = 1;
        
        $persona->save();
       
        $telefono = new Telefono();
        $telefono->numero     = $request->telefono;
        $telefono->codigoArea = $request->codigoArea;
        $telefono->persona_id = $persona->id;
        $telefono->estado     = 1;

        $telefono->save();

        return redirect('/personas/estado/1');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $persona = Persona::find($id);
        //$telefonos = DB::table('telefonos')->where('persona_id',$id)->get();
        
        return view('persona.show')->with('persona', $persona);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Persona::find($id);

        return view('persona.edit')->with('persona', $persona);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $request->validate([
            'nombre'     => 'required| string',
            'apellido'   => 'required| string',
            'dni'        => 'required|integer|max:100000000|min:1000000',
            'direccion'  => 'required|string|max:256| min:4',
            'numeroCalle'=> 'required|integer|min:1|max:9999',  
        ]);

        $persona = Persona::find($id);

        $persona->nombre      = $request->get('nombre');
        $persona->apellido    = $request->get('apellido');
        $persona->dni         = $request->get('dni');
        $persona->direccion   = $request->get('direccion');
        $persona->numeroCalle = $request->numeroCalle;
        $persona->telefonos($request->get('telefono'));
        
        $persona->save();

        return redirect('/personas/estado/1');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::find($id);
        $persona->estado = 0;
        $persona->telefonos->estado = 0;
        $persona->telefonos->save();
        $persona->save();
        return redirect('/personas');
    }
    
    /**
     * Enable the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function habilitarCliente($id)
    {
        $persona = Persona::find($id);
        $persona->estado = 1;
        $persona->telefonos->estado = 1;
        $persona->telefonos->save();
        $persona->save();
        return redirect('/personas/estado/0');
    }
}
