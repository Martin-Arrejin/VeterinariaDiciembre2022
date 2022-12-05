<?php

namespace App\Http\Controllers;

use App\Models\loteDescripcion;
use App\Models\Articulo;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;

class LoteDescripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
     
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @param  \App\Models\loteDescripcion  $loteDescripcion
     * @return \Illuminate\Http\Response
     */
    public function lote_For_Article($id)
    {
     $Articulos = Articulo::find($id);
     $lotes     = loteDescripcion::Where('articulo_id',$id)
                                 ->Where('estado',1)
                                 ->get();
     return view ('lote.index')->with('lotes',$lotes)->with('articulos',$Articulos);
    }

    /**
     * Show the form for creating a new resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function crear_por_id($id)
    {
        return view('lote.create')->with('ArticuloId',$id);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('lote.create');
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
     * Store a newly created resource in storage.
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_por_id(Request $request, $id)
    { 
        $request->validate([
            'unidades'       => 'required| integer| max:9999 | min:1',
            'precioCompra'   => 'required| numeric | max:99999 |min:1',
            'vencimiento'    => 'nullable| date ',
        ]);

        $lote = new loteDescripcion();
        $lote->unidad       = $request->get('unidades');
        $lote->precioCompra = $request->get('precioCompra');
        $lote->vencimiento  = $request->get('vencimiento');
        $lote->articulo_id  = $id;
        $lote->estado = 1;
        $lote->save();
        $Articulos = Articulo::find($id);
        $Articulos->cantidadTotal = $Articulos->cantidadTotal + $lote->unidad;
        $Articulos->save();
       
        return redirect("/Lotes/".$Articulos->id."/lote");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\loteDescripcion  $loteDescripcion
     * @return \Illuminate\Http\Response
     */
    public function show(loteDescripcion $loteDescripcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int $id
     * @param  \App\Models\loteDescripcion  $loteDescripcion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lotes=loteDescripcion::find($id);
        return view ('lote.editar')->with('lote',$lotes);
    }

    /**
     * Update the specified resource in storage.
     * @param $id
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\loteDescripcion  $loteDescripcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $request->validate([
            'unidades'       => 'required| integer| max:9999 | min:1',
            'precioCompra'   => 'required| numeric | max:99999 |min:1',
            'vencimiento'    => 'nullable| date ',
        ]);
        
        $lote = loteDescripcion::find($id);
        
        $articulos = Articulo::find($lote->articulo_id);
        $articulos->cantidadTotal = $articulos->cantidadTotal - $lote->unidad;
        $articulos->cantidadTotal = $articulos->cantidadTotal + $request->get('unidades');
        $articulos->save();
        $lote->unidad       = $request->get('unidades');
        $lote->precioCompra = $request->get('precioCompra');
        $lote->vencimiento  = $request->get('vencimiento');
        $lote->save();
        
      
      return redirect("/Lotes/".$articulos->id."/lote");
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lote = loteDescripcion::find($id);
        $articulos = Articulo::find($lote->articulo_id);
        $articulos->cantidadTotal = $articulos->cantidadTotal - $lote->unidad;
        $articulos->save();
        $venta = DetalleVenta::where('idLote',$id);
        if($venta==null){
            $lote->delete();
        }
        else{
            $lote->estado = 0;
            $lote->save();
        }
        $lotes     = loteDescripcion::Where('articulo_id',$articulos->id)
                                    ->Where('estado',1)
                                    ->get();
        return view ('lote.index')->with('lotes',$lotes)->with('articulos',$articulos);  
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function Vencimientodelete ($id)
    {
        $lote      = loteDescripcion::find($id);
        $articulos = Articulo::find($lote->articulo_id);
        $articulos->cantidadTotal = $articulos->cantidadTotal - $lote->unidad;
        $articulos->save();
        $lote->estado = 0;
        $lote->save();
       return redirect('/vencimientos'); 
    }
}
