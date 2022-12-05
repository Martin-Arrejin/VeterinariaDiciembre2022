<?php

namespace App\Http\Controllers;

use App\Models\DetalleClinico;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DetalleClinicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('detalleClinico.create')->with('historialClinico_id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detalleClinico = new DetalleClinico();

        $fecha = Carbon::now();

        $detalleClinico->observaciones       = $request->get('observaciones');
        $detalleClinico->tratamiento         = $request->get('tratamiento');
        $detalleClinico->patologia           = $request->get('patologia');
        $detalleClinico->peso                = $request->peso;
        $detalleClinico->historialClinico_id = $request->get('idHistorialClinico');
        $detalleClinico->fechaAtencion       = $fecha;
        
        $detalleClinico->save();
        

        return redirect('historialesClinicos/'.$detalleClinico->historialClinico_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
