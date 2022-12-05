<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialClinico;
use App\Models\DetalleClinico;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HistorialClinicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historiales = HistorialClinico::all();
        return view('historialClinico.index')->with('historiales', $historiales);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        // $detallesClinicos = DB::table('detalle_clinicos')
        // ->where('historialClinico_id',$id)
        // ->get();
        $historialClinico = HistorialClinico::find($id);
        $mascota          = $historialClinico->mascota;
        $detallesClinicos = DetalleClinico::where('historialClinico_id',$id)->orderBY('created_at','desc')->get();
        $fachaActual      = Carbon::now();
        $nacimiento       = Carbon::parse($mascota->anioNacimiento);
        $anio             = $nacimiento->diffInYears( $fachaActual );
        $mes              = $nacimiento->diffInMonths( $fachaActual )-$anio*12;
        if($anio>0){
            $edad = $anio.' años y '.$mes.' meses';
        }
        else{
            $edad = $mes.' meses';
        }
        return view('historialClinico.show')
                        ->with('detallesClinicos', $detallesClinicos)
                        ->with('historialClinicoId',$id)
                        ->with('mascota',$mascota)
                        ->with('edad',$edad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
