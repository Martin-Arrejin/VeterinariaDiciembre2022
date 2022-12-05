<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\LoteDescripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articulos = Articulo::where('estado',1)->get();
        
        // foreach($articulos[0]->lotes as $unLote)
        // {
        //         dump($unLote);
        // }
        // dd('finalizo');
        

      return view ('articulo.index')->with('articulos',$articulos); 
    }

    /**
     
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Vencimiento(Request $request)
    { 
        // filtro vencimiento
        $fechaActual = Carbon::now();

        $resultados = DB::select('select lote_descripcions. *, articulos.codigo, articulos.descripcion, articulos.marca,articulos.alerta, TIMESTAMPDIFF(DAY,CURDATE(), lote_descripcions.vencimiento) AS dias from lote_Descripcions inner join articulos on (articulos.id = lote_Descripcions.articulo_id) where ((lote_descripcions.vencimiento <= CURDATE())and(lote_Descripcions.estado = 1)) or ((articulos.alerta >= TIMESTAMPDIFF(DAY,CURDATE(), lote_descripcions.vencimiento) )and(lote_Descripcions.estado = 1)and(articulos.alerta <> 0))');
        session()->forget('notificacionVencido');
        return view('articulo.vencidos')->with('resultados',$resultados);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = categoria::all();
        return view('articulo.create')->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request  $request)
    {   
       
        $request->validate([
            'codigo'         => 'required| numeric',
            'descripcion'    => 'required| string | max:256 |min:2',
            'marca'          => 'required| string |max:60 | min:2',
            'precioEspecial' => 'nullable| numeric |max:99999',
            'precioVenta'    => 'required| numeric |max:99999',
            'iva'            => 'required| numeric |max:100',
            'minimoStock'    => 'nullable| numeric',
            'alerta'         => 'nullable| integer |max:100',
        ]);



        $articulosAux = DB::TABLE('articulos')
        ->where('codigo','=',$request->get('codigo'))
        ->get();

        if(count($articulosAux) == 0){
            $Articulos = new Articulo();
            $Articulos->codigo         = $request->get('codigo');
            $Articulos->descripcion    = $request->get('descripcion');
            $Articulos->precioVenta    = $request->get('precioVenta');
            $Articulos->precioEspecial = $request->get('precioEspecial');
            $Articulos->marca          = $request->get('marca');
            $Articulos->minimoStock    = $request->get('minimoStock');
            $Articulos->alerta         = $request->get('alerta');
            $Articulos->iva            = $request->get('iva');
            $Articulos->estado         = 1;
            $Articulos->categoria_id   = $request->get('categoria');
            $Articulos->save();
            
         }
            return redirect('/articulos');

        }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id )
    {   
        $Articulos = Articulo::find($id);     
        return view('articulo.show')->with ('articulos',$Articulos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulos = Articulo::find($id);
        $categorias =categoria::all();
    return view('articulo.edit')->with ('articulos',$articulos)
                                ->with ('estado',1)
                                ->with('categorias',$categorias);
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
            'codigo'         => 'required| numeric',
            'descripcion'    => 'required| string | max:256 |min:2',
            'marca'          => 'required| string |max:60 | min:2',
            'precioEspecial' => 'nullable| numeric |max:99999',
            'precioVenta'    => 'required| numeric |max:99999',
            'iva'            => 'required| numeric |max:100',
            'minimoStock'    => 'nullable| numeric',
            'alerta'         => 'nullable| integer |max:100',
        ]);
        
    $Articulos = Articulo::find($id);  
    $Articulos->codigo         = $request->get('codigo');
    $Articulos->descripcion    = $request->get('descripcion');
    $Articulos->precioVenta    = $request->get('precioVenta');
    $Articulos->precioEspecial = $request->get('precioEspecial');
    $Articulos->marca          = $request->get('marca');
    $Articulos->minimoStock    = $request->get('minimoStock');
    $Articulos->alerta         = $request->get('alerta');
    $Articulos->iva            = $request->get('iva');
    $Articulos->categoria_id   = $request->get('categoria');
    $Articulos->save();
    

    return redirect('/articulos');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulos = Articulo::find($id);
        $lote = loteDescripcion::where('articulo_id',$id)->get();
        if( $lote == null){
            $articulos->delete();  
        }else{
            $articulos->estado = 0;
            $articulos->save();
        }
       
        return redirect('/articulos');  
    }
}
