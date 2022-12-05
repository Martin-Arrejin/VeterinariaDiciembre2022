<?php

namespace App\Http\Controllers;

use App\Models\notificaciones;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificaciones = Notificaciones::all();
        session()->forget('notificacion');
        return view('notificacion.index')->with('notificaciones',$notificaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\notificaciones  $notificaciones
     * @return \Illuminate\Http\Response
     */
    public function show(notificaciones $notificaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notificaciones  $notificaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(notificaciones $notificaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\notificaciones  $notificaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, notificaciones $notificaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param  \App\Models\notificaciones  $notificaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $notificacion = Notificaciones::find($id);
    $notificacion->delete();
    return redirect()->route("notificaciones.index"); 

    }
}
