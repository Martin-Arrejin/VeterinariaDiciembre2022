<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turno;
use App\Models\Telefono;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Null_;


class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTurno()
    { 

  // control de turnos viejos
       $fechaActual  = Carbon::now();
       $turnosPasado  = Turno::where('estado','!=',3)
                                ->where('start','<',$fechaActual)
                                ->get();

       foreach ($turnosPasado AS $unturnosPasado)
       {
            $unturnosPasado->estado = 3;
            $unturnosPasado->save();
       }

       $personas = Persona::all();
        return view('turnos')->with('personas', $personas);
    }

     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index()
     {
         $turnos = Turno::all();
         
         return view('turno.index')->with('turnos', $turnos);

     }


      /**
      * Display a listing of the resource.
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function tipoTurno($id)
      {
        if(auth()->user()->tipo == 'veterinario'){
            $tipoTurno ='v';
        }

        if(auth()->user()->tipo == 'peluquero'){
            $tipoTurno ='p';
        }
        if(auth()->user()->estadoIngreso == 'veterinario'){
            $tipoTurno ='v';
        }

        if(auth()->user()->estadoIngreso == 'peluquero'){
            $tipoTurno ='p';
        }

        $fechaActual  = Carbon::now();
        $turnosPasado = Turno::where('estado','!=',3)
                                ->where('start','<',$fechaActual)
                                ->get();
        
       foreach ($turnosPasado AS $unturnosPasado)
        {  
            if($unturnosPasado->persona_id == null)
                {
                 $unturnosPasado->delete();
                }
            else{
                 $unturnosPasado->estado = 3;
                 $unturnosPasado->save();
                }
         }

        if($id == 1)
            {
             $unDiaAnte    = $fechaActual;
             $unDiaDespues = $fechaActual->format('Y-m-d 23:59:00');
             if(auth()->user()->tipo == 'admin'){
            $turnos       = Turno::Where('start','>',$unDiaAnte)
                                    ->Where('start','<',$unDiaDespues)
                                    ->where('estado','1')
                                    ->where('tipo',$tipoTurno)
                                    ->get();

             }
             else{

             $turnos       = Turno::Where('start','>',$unDiaAnte)
                                    ->Where('start','<',$unDiaDespues)
                                    ->where('estado','1')
                                    ->where('tipo',$tipoTurno)
                                    ->get();
            }}
        
        if($id == 2)
            {
             $nombre_dia   = date('w', strtotime($fechaActual));
             $suma         = 6 - $nombre_dia;
             $sabado       = $fechaActual->addDay($suma)->format('Y-m-d 23:59:00');
             $fechaActual  = Carbon::now();
             if(auth()->user()->tipo == 'admin'){
             $turnos       = Turno::Where('start','>',$fechaActual)
                                        ->Where('start','<',$sabado)
                                        ->where('tipo',$tipoTurno)
                                        ->where('estado','1')->get(); 
             }
             else{
             $turnos       = Turno::Where('start','>',$fechaActual)
                                    ->Where('start','<',$sabado)
                                    ->where('tipo',$tipoTurno)
                                    ->where('estado','1')->get();
             }
            }

        if($id == 3)
            {
            if(auth()->user()->tipo == 'admin'){
            $turnos = Turno::Where('estado',0)
                                ->where('tipo',$tipoTurno)
                                ->get();
            }
            else{
             $turnos = Turno::Where('estado',0)
                                ->where('tipo',$tipoTurno)
                                ->get();
            }}

        if($id == 4)
            {
            if(auth()->user()->tipo == 'admin'){
                $turnos = Turno::where('tipo',$tipoTurno)->get();
            }
            else{
                $turnos = Turno::where('tipo',$tipoTurno)->get();
            }}
        if($id == 5)
            {
            if(auth()->user()->tipo == 'admin'){
                $turnos = Turno::Where('estado',3)
                                ->orderBy('start','desc')
                                ->where('tipo',$tipoTurno)
                                ->get();
            }
            else{
                $turnos = Turno::Where('estado',3)
                                ->orderBy('start','desc')
                                ->where('tipo',$tipoTurno)
                                ->get();
            }}

            $personas = DB::table('personas')
                            ->join('telefonos', 'telefonos.persona_id', '=', 'personas.id')
                            ->select('personas.*','personas.estado as estadoPer','telefonos.*')
                            ->get();
            
          return view('turno.index')->with('turnos', $turnos)
                                    ->with('styleTurno',$id)
                                    ->with('personas',$personas);
 
      }

     

    /**
      * Show the form for creating a new resource.
      * @return \Illuminate\Http\Response  
      */
    public function create()
    {
        $fechaActual  = Carbon::now();
        $fechaActual  = $fechaActual->format('Y-m-d');
       

        return view('turno.create')->with('fechaActual',$fechaActual);
    }

     /**
      * Store a newly created resource in storage.
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     { 
        $request->validate([
            'desde'     => 'required| date_format:H:i',
            'hasta'     => 'required| date_format:H:i|after:desde',
            'fecha'     => 'required| date',
            'duracion'  => 'required| integer| max:120|min:15 ',
            'descanso'  => 'required| integer| max:30|min:10',
        ]);

        if($request->hasta < $request->desde){
            return redirect(url()->previous());
        }
        if(auth()->user()->tipo == 'veterinario'){
            $tipoTurno   ='v';
            $tituloTurno ='Veterinario';
        }

        if(auth()->user()->tipo == 'peluquero'){
            $tipoTurno   ='p';
            $tituloTurno ='Peluquero';
        }
        if(auth()->user()->estadoIngreso == 'veterinario'){
            $tipoTurno   ='v';
            $tituloTurno ='Veterinario';
        }

        if(auth()->user()->estadoIngreso == 'peluquero'){
            $tipoTurno   ='p';
            $tituloTurno ='Peluquero';
        }

        $to_time   = strtotime($request->hasta);
        $from_time = strtotime($request->desde);
        $minutes   = round(abs($to_time - $from_time) / 60);
        $minutes   = intval($minutes);
        $cantidad  = ($minutes + $request->descanso)/($request->descanso + $request->duracion);
        $cantidad  = intval($cantidad);
        $time      = new Carbon($request->get('fecha').' '.$request->get('desde'));
        $duracion  = intval($request->duracion);
        $descanso  = intval($request->descanso);

        for($i=0; $i<$cantidad ; $i++){
            $turno         = new Turno();
            $turno->start  = $time->format('Y-m-d H:i:s');//8:00
            $time ->addMinutes($duracion);
            $turno->end    = $time->format('Y-m-d H:i:s');//8:30
            $turno->title  = $tituloTurno;
            $turno->tipo   = $tipoTurno;
            $turno->estado = 0;
            $time ->addMinutes($descanso); //8:40
            $turno->save();
        }     
         $turno->save();
       
         return redirect('/tipoTurno/3');
     }

     
 /**
     * Store a newly 
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function turnoSuperpuesto(Request  $request)
    {  
        
        if(auth()->user()->tipo == 'veterinario'){
            $tipoTurno   ='v';
            $tituloTurno ='Veterinario';
        }

        if(auth()->user()->tipo == 'peluquero'){
            $tipoTurno   ='p';
            $tituloTurno ='Peluquero';
        }
        if(auth()->user()->estadoIngreso == 'veterinario'){
            $tipoTurno   ='v';
            $tituloTurno ='Veterinario';
        }

        if(auth()->user()->estadoIngreso == 'peluquero'){
            $tipoTurno   ='p';
            $tituloTurno ='Peluquero';
        }

       
        
        $to_time   = strtotime($request->hasta);
        $from_time = strtotime($request->desde);
        $minutes   = round(abs($to_time - $from_time) / 60);
        $minutes   = intval($minutes);
        $cantidad  = ($minutes + $request->descanso)/($request->descanso + $request->duracion);
        $cantidad  = intval($cantidad);
        $time      = new Carbon($request->get('fecha').' '.$request->get('desde'));
        $duracion  = intval($request->duracion);
        $descanso  = intval($request->descanso);
        $turnosCreados=[];

        for($i=0; $i<$cantidad ; $i++){
            $turno         = new Turno();
            $turno->start  = $time->format('Y-m-d H:i:s');//8:00
            $time ->addMinutes($duracion);
            $turno->end    = $time->format('Y-m-d H:i:s');//8:30
            $turno->title  = $tituloTurno;
            $turno->tipo   = $tipoTurno;
            $turno->estado = 0;
            $time ->addMinutes($descanso); //8:40
            $turnosCreados[$i]= $turno;
        } 

        $inicioTraido      = new Carbon($request->fecha);
        $inicioTraido      = $inicioTraido->format('Y-m-d 00:00:00');

        $finTraido         = new Carbon($request->get('fecha'));
        $finTraido         = $finTraido->format('Y-m-d 11:59:59');

        
        $turnosTraidos = turno::where('tipo',$tipoTurno)
                               ->where('estado','!=',3)
                               ->where('start','>=',$inicioTraido)
                               ->where('start','<=',$finTraido)  
                               ->get();

        $salida=FAlSE;

        if(!$turnosTraidos){
            $salida =FALSE;
            return response(json_encode($salida ),200)->header('Content-type','text/plain');
        }

         foreach($turnosCreados as $unTurnosCreados){

                 foreach($turnosTraidos as $unTurnosTraidos){

                     if(($unTurnosCreados->start>=$unTurnosTraidos->start)&&($unTurnosCreados->start<=$unTurnosTraidos->end)){
                             $salida=TRUE;
                             return response(json_encode($salida ),200)->header('Content-type','text/plain');
                     }
                        
                 }   
        
             }


         return response(json_encode($salida),200)->header('Content-type','text/plain');
                
    }

     




     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         $turno = Turno::find($id);
 
         return view('turno.show')->with('turno', $turno);
     }



        /**
     * Store a newly 
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function mostrarTurno(Request  $request)
    {  $fechaActual  = Carbon::now();
       $turnosPasado = Turno::where('estado','!=',3)->where('start','<',$fechaActual)->get();

       foreach ($turnosPasado AS $unturnosPasado)
       {
        $unturnosPasado->estado = 3;
        $unturnosPasado->save();
       }

       $turno = DB::table('turnos')
                ->where('tipo',$request->id)
                ->where('estado',0)
                ->get();
     
        return response(json_encode($turno),200)->header('Content-type','text/plain');
                
    }
// ---------------------------------------------------------------------------------------------------------
 /**
     * Store a newly created resource in storage.
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function DarTurno(Request $request, $id)
    { 
        
    //validaciones
        if(strstr($request->asunto,'http') or (is_file($request->asunto))){
            return redirect('/seleccionTurno');
        }

         $request->validate([
             'nombre'     => 'required| string',
             'apellido'   => 'required| string',
             'dni'        => 'required|integer|max:100000000|min:1000000',
             'direccion'  => 'required|string',
             'numeroCalle'=> 'required|string',
             'codigoArea' => 'required|numeric|max:9999|min:99',
             'telefono'   => 'required|numeric|max:9999999|min:999999',
             'asunto'     => 'nullable|string|max:100',
        ]);
        
//ubico persona y turno
         $persona  = Persona::where('dni',$request->dni)
                            ->get();
                      
         $turno    = Turno::find($id);
         
//caso de que no este la persona
         if($persona->isEmpty()){
            
                $persona  = new Persona();
                $persona->nombre      = $request->nombre;
                $persona->apellido    = $request->apellido;
                $persona->dni         = $request->dni;
                $persona->direccion   = $request->direccion;
                $persona->numeroCalle = $request->numeroCalle;
                $persona->estado      = 1;
                $persona->save();

                $telefono = new Telefono();
                $telefono->codigoArea = $request->get('codigoArea');
                $telefono->numero     = $request->get('telefono');
                $telefono->persona_id = $persona->id;
                $telefono->save();
                $telefono->persona_id = $persona->id;
                $telefono->save();

                $persona = Persona::Where('id',$persona->id)
                                  ->get();
                
                        
         }
         else{

            $telefono = Telefono::where('persona_id',$persona[0]->id)
                                ->get();
            
            $persona[0]->nombre    = $request->nombre;
            $persona[0]->apellido  = $request->apellido;
            $persona[0]->dni       = $request->dni;
            $persona[0]->direccion   = $request->direccion;
            $persona[0]->numeroCalle = $request->numeroCalle;
            $persona[0]->estado    = 1;
            $persona[0]->save();
                         
            //inserto y guardo telefono
            $telefono[0]->codigoArea = $request->get('codigoArea');
            $telefono[0]->numero     = $request->get('telefono');
            $telefono[0]->persona_id = $persona[0]->id;
            $telefono[0]->save();
         }
        
 // inserto y guardo turno
        $turno->estado     = 1;
        $turno->persona_id = $persona[0]->id;
        $turno->asunto     = $request->asunto;
        $turno->save();
         return redirect('/tipoTurno/4');
    }

//----------------------------------------------------------------------------------------------------------








    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function agregar(Request $request)
    { 
        if(strstr($request->asunto,'http') or (is_file($request->asunto))){
            return redirect('/seleccionTurno');
        }
        
        $request->validate([
            'nombre'     => 'required| string',
            'apellido'   => 'required| string',
            'dni'        => 'required|integer|max:100000000|min:1000000',
            'codigoArea' => 'required|numeric|max:9999|min:99',
            'telefono'   => 'required|numeric|max:9999999|min:999999',
            'idTurno'    => 'required|integer|',
            'asunto'     => 'nullable|string|max:100',
        ]);
        
         $persona = DB::table('personas')
         ->where('dni',$request->get('dni'))
         ->get();

         if($persona->isEmpty()){
            
            $persona = new Persona();
            $persona->nombre    = $request->get('nombre');
            $persona->apellido  = $request->get('apellido');
            $persona->dni       = $request->get('dni');
            $persona->estado    = 1;
              
            $persona->save();
            
            $telefono = new Telefono();
          
            $telefono->codigoArea = $request->get('codigoArea');
            $telefono->numero     = $request->get('telefono');
            $telefono->persona_id = $persona->id;
            $telefono->save();
            
            $turnoAux = Turno::find($request->get('idTurno'));
            $turnoAux->estado = 1;
            $turnoAux->persona_id = $persona->id;
            $turnoAux->asunto = $request->asunto;
        
            $turnoAux->save();
        
            return redirect('/seleccionTurno');
           /*  return redirect('/turnos'); */
         }
         if($persona[0]->estado == 0) {
            return redirect('/seleccionTurno');
          } 
            $telefono = new Telefono();
            $telefono->codigoArea = $request->get('codigoArea');
            $telefono->numero     = $request->get('telefono'); 
            $telefono->persona_id = $persona[0]->id;
            $telefono->save();
           
         

         $turnoAux = Turno::find($request->get('idTurno'));
         $turnoAux->estado = 1;
         $turnoAux->persona_id = $persona[0]->id;
         $turnoAux->asunto = $request->get('asunto');
        

         $turnoAux->save();
                      
         return redirect('/seleccionTurno');

      
    }


     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {  
         $turno = Turno::find($id);
         $arrayStart = explode(' ', $turno->start); 
         $arrayEnd = explode(' ', $turno->end); 
         $fecha = $arrayStart[0];
         $desde = $arrayStart[1];
         $hasta = $arrayEnd[1];
         $hora = $desde.' hasta '.$hasta;
         
         return view('turno.edit')->with('turno', $turno)
                                  ->with('fecha', $fecha)
                                  ->with('hora', $hora);
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function cancelar($id)
      {
          $turno = Turno::find($id);
          $turno->estado = 0;
          $turno->asunto =" ";
          $turno->persona_id = NULL;
          

          $turno->save();

          return redirect('/tipoTurno/3');

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
         $turno = Turno::find($id);
         
      
         //acá iría el input de la persona traído del formulario del calendario
         $turno->asunto = $request->asunto;

       
        
         $turno->save();
        
         return redirect($request->url);
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $turno = Turno::find($id);
         $turno->delete();

         return redirect(url()->previous());
     }

  /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function mensaje($id)
      {
          $turno = Turno::find($id);
          $persona = $turno->persona; 
        /*   dd($persona->telefonos[0]->numero); */
        $array   = explode(' ', $turno->start); 
        $fecha   = $array[0];
        $hora    = $array[1]; 
        $celular = $turno->persona->telefonos->codigoArea.$turno->persona->telefonos->numero;
        
          return view('turno.mensaje')->with('turno', $turno)->with('persona',$persona)->with('fecha',$fecha)->with('hora',$hora)->with('celular',$celular);
      }




}
