<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\loteDescripcion;
use App\Models\articulo;
use App\Models\detalleVenta;
use App\Models\notificaciones;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->vaciarArticulos();
        $ventas = Venta::all();

        return view('venta.index')->with('ventas', $ventas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
         $fechaActual = Carbon::now();

         $lotes = loteDescripcion::where('unidad','>',0)
                                 ->where('estado','1')
                                 ->where('vencimiento','>',$fechaActual)
                                 ->orWhere('vencimiento',null)
                                 ->where('unidad','>',0)
                                 ->where('estado','1')
                                ->get();
        
                                //no traer articulos vencidos

        return view('venta.create')->with('lotes', $lotes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * estadistica ganancia por mes.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gananciaPorMes($id)
    {  
        $año = $id;

        $fechaActual = Carbon::createFromDate($id.'-12-31');
        $mesfor      = $fechaActual->format('m')-1+1;
        $año         = $fechaActual->format('Y');
        $arreglo     = []; 
        
         for($i=12; $i>0; $i--){
            $mesFecha    = $fechaActual->format('m');
            $mesInicio   = $año."-".$mesFecha."-01";
            $diasFin     = $fechaActual->lastOfMonth()->endOfday()->format('d');
            $mesFin      = $año."-".$mesFecha."-".$diasFin;
            
            $ganancia = DB::table('ventas')
                                      ->join('detalle_ventas','ventas.id','=','detalle_ventas.idVenta')
                                      ->join('lote_descripcions','detalle_ventas.idLote','=','lote_descripcions.id')
                                      ->join('articulos','articulos.id','=','lote_descripcions.articulo_id')
                                      ->select(DB::raw('SUM(detalle_ventas.subtotal-((detalle_ventas.cantidad*lote_descripcions.precioCompra)+(detalle_ventas.subtotal*articulos.iva / 100))) AS ganancia'))
                                      ->whereBetween('fecha',[$mesInicio, $mesFin ])
                                      ->get();

           if($ganancia[0]->ganancia == null){
                $arreglo[$i]=0;
           }
           else{
                $arreglo[$i]= $ganancia[0]->ganancia;
           } 
            $mesFecha    = $mesFecha-1;
            $fechaActual = Carbon::createFromDate($año,$mesFecha,12);
         }
        $labels      = array('Enero','febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'); 
        $orientecion ='x';
        return view('estadistica.estadisticasGananciaPorMes')
                                ->with('arreglo', $arreglo)
                                ->with('labels',$labels)
                                ->with('año',$año);
                                

    }



    /**
     * estadistica articulos mas vendidos historicamente.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function  articulosMasVendidos($id)
    {   $fechaActual = Carbon::now();
        $año    = $fechaActual->format('Y');
        $ultDia = $fechaActual->lastOfMonth()->endOfday()->format('d');
        
        $mes    = $id;
        $inicio = $año."-".$mes."-01";
        $fin    = $año."-".$mes."-".$ultDia;

        
        $articuloCant = DB::table('ventas')
                            ->join('detalle_ventas','ventas.id','=','detalle_ventas.idVenta')
                            ->join('lote_descripcions','detalle_ventas.idLote','=','lote_descripcions.id')
                            ->join('articulos','articulos.id','=','lote_descripcions.articulo_id')
                        ->select('articulos.descripcion','articulos.marca',DB::raw('SUM(detalle_ventas.cantidad)AS cantVend'))
                        ->whereBetween('fecha',[$inicio, $fin ])
                        ->groupBy('articulos.descripcion','articulos.marca')
                        ->orderByDesc('cantVend')
                        ->take(20)
                        ->get();
        $labels  =[];
        $arreglo =[]; 

        for($i=0;$i<count($articuloCant);$i++){

            $arreglo[$i] = $articuloCant[$i]->cantVend;
            $labels[$i]  = $articuloCant[$i]->marca.'/'.$articuloCant[$i]->descripcion;
        }
       $fecha = Carbon::createFromDate($año.'-'.$mes.'-01');
       

        return view('estadistica.estadisticaArticulosMasVendidos')
                                ->with('arreglo', $arreglo)
                                ->with('labels',$labels)
                                ->with('mes',$mes)
                                ->with('fecha',$fecha->monthName);
    }
    
   
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $venta = venta::find($id);
        $detalles = DB::Table('detalle_ventas')
                            ->join('lote_descripcions', 'lote_descripcions.id','=','detalle_ventas.idLote')
                            ->join('articulos','articulos.id','=','lote_descripcions.articulo_id')
                        ->select('detalle_ventas.*','lote_descripcions.vencimiento','articulos.codigo','articulos.descripcion','articulos.marca','articulos.precioVenta',)
                        ->where('detalle_ventas.idVenta','=',$id)
                    ->get();
        
        return view("venta.show")->with('detalles',$detalles)->with('venta',$venta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @param  \App\Models\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $venta = venta::find($id);
        // $venta->delete();
        // return redirect()->route("ventas.index");
    }



    //A partir de acá son los métodos a implementar

    private function obtenerArticulos()
    {
        $articulos = session("articulos");
        if (!$articulos) {
            $articulos = [];
        }
        return $articulos;
    }


    private function obtenerEstados()
    {
        $estado = session("estado");
        if (!$estado) {
            $estado = [];
        }
        return $estado;
    }

    private function vaciarArticulos()
    {
        $this->guardarArticulos(null);
        $this->guardarEstado(null);
    }

    private function guardarArticulos($articulos)
    {
        session(["articulos" => $articulos,
                
        ]);

        // session(["estado" => $estado,
                
        // ]);
        
    
    }


    private function guardarEstado($estado)
    {
         session(["estado" => $estado,
                
         ]);
        
    
    }

    public function cancelarVenta()
    {
        $this->vaciarArticulos();
        
        return redirect()
            ->route("ventas.index");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function quitarArticuloDeVenta(Request $request)
    {   
        $indice    = $request->get('articulo')- 1;
        $articulos = $this->obtenerArticulos();
        $estado    = $this->obtenerEstados();

        array_splice($articulos, $indice, 1);
        array_splice($estado, $indice, 1);

        $this->guardarArticulos($articulos);
        $this->guardarEstado($estado);

        return redirect()->route("ventas.create");
    }
    

/********************************************************* */
 /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function quitarUnArticuloVenta($id)
    {   
        $articulo      =  loteDescripcion::find($id);
        $articulos     =  $this->obtenerArticulos();
        $posibleIndice =  $this->buscarIndiceDeArticulo($articulo->id, $articulos);
        $articulos[$posibleIndice]->unidad--;
        
        return redirect()
            ->route("ventas.create");
    }


/*********************************** */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */

    
    public function cambiarEstadoPrecio($id){
        $estado        =  $this->obtenerEstados();
        $articulos     =  $this->obtenerArticulos();
        $posibleIndice =  $this->buscarIndiceDeArticulo($id, $articulos);

        if($estado[$posibleIndice] == 0){
            $estado[$posibleIndice] = 1;
        }
        else{ $estado[$posibleIndice] = 0;}
        $this->guardarEstado($estado);

        return redirect()
            ->route("ventas.create");

    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */

    public function agregarArticuloVenta($id)
    {  
        //$articulo = loteDescripcion::find($id);
        $articuloSelecionado = loteDescripcion::where('id', $id)->where('estado','1')->get();
        $articulo           = $articuloSelecionado[0];
        if (!$articulo) {
            Session::flash('message','Articulo no existente');
            return redirect()
                ->route("ventas.create");
        }

        $this->agregarArticuloACarrito($articulo);
        return redirect()
            ->route("ventas.create");
    }

private function agregarArticuloACarrito($articulo)
{  
    if ($articulo->unidad <=0) {
        $mensaje='No hay existencias del artículo '. $articulo->articulo->descripcion.' con vencimiento en '. $articulo->vencimiento;
        Session::flash('message',$mensaje);
        return redirect()->route("ventas.create");
    }
    $articulos = $this->obtenerArticulos();
    $posibleIndice = $this->buscarIndiceDeArticulo($articulo->id, $articulos);
    
    // Es decir, producto no fue encontrado
    if ($posibleIndice === -1) {
        $articulo->unidad = 1;
         $estado = $this->obtenerEstados();
         $estadoAux = 0;
         array_push($estado,$estadoAux);
         array_push($articulos, $articulo);
         $this->guardarEstado($estado);
    } else {

        if ($articulos[$posibleIndice]->unidad + 1 > $articulo->unidad) {
            $mensaje="No se pueden agregar más productos de este tipo, se quedarían sin existencia";
            Session::flash('message',$mensaje);
            return redirect()->route("ventas.create");
        }
        $articulos[$posibleIndice]->unidad++;

    }
    $this->guardarArticulos($articulos);
   
    
    return redirect()->route("ventas.create")->with('$articulos',$articulos);
    
}

private function buscarIndiceDeArticulo(string $id, array &$articulos)
{  
    $indice = 0;

    foreach ($articulos as $unArticulo ) {
        
        if ($unArticulo->id == $id) {
            return $indice;
        }
        $indice++;
    }
    return -1;
}


//terminar venta

public function terminarVenta()
{
    // Crear una venta
    $venta = new Venta();
    $venta->saveOrFail();
    $idVenta      = $venta->id;
    $venta->fecha = Carbon::now();

    $articulos = $this->obtenerArticulos();
    $estado    = $this->obtenerEstados();
    $indice    = 0;
    $total     = 0;
    // Recorrer carrito de compras
    foreach ($articulos as $unArticulo) {
        // El producto que se vende...
        $detalleVenta = new detalleVenta();
        $detalleVenta->idVenta  = $idVenta;
        $detalleVenta->cantidad = $unArticulo->unidad;

        if($estado[$indice] == 0){
            $detalleVenta->subtotal  = ($unArticulo->unidad)*($unArticulo->articulo->precioVenta);
            $detalleVenta->descuento = 0;
        }
        else{
            $detalleVenta->subtotal  = ($unArticulo->unidad)*($unArticulo->articulo->precioEspecial);
            $detalleVenta->descuento = ($unArticulo->unidad)*(($unArticulo->articulo->precioEspecial)-($unArticulo->articulo->precioVenta));
        }

        $indice ++;
        $total  += $detalleVenta->subtotal;
        $detalleVenta->idLote = $unArticulo->id;
        // Lo guardamos
        if($detalleVenta->subtotal>0){
        $detalleVenta->saveOrFail();
        }
        else {
            $this->vaciarArticulos();
            return redirect(url()->previous());
        }
        // Y restamos la existencia del original
        $loteActualizado = loteDescripcion::find($unArticulo->id);
        $loteActualizado->unidad -= $detalleVenta->cantidad;
        if ($loteActualizado->unidad <= 0){
            $loteActualizado->estado = 0;
        }

        $articuloActualizado = Articulo::find($loteActualizado->articulo_id);
        $articuloActualizado->cantidadTotal -= $detalleVenta->cantidad;
        $articuloActualizado->saveOrFail();

        if($articuloActualizado->cantidadTotal <= $articuloActualizado->minimoStock){
            $notificacion = new notificaciones();
            $notificacion  ->categoria   = 'articulo';
            $notificacion  ->unidades    =  $articuloActualizado->cantidadTotal;
            $notificacion  ->descripcion = 'falta de stock del articulo '. $articuloActualizado->descripcion . ', Marca ' . $articuloActualizado->marca ;
            $notificacion  ->saveOrFail();
           
            if (session()->exists('notificacion')) {
                session()->increment('notificacion', 1);
                
            }
            else{
                session(['notificacion' => 1]);
            }

        }
    
        $loteActualizado->saveOrFail();
        if($loteActualizado->unidad <= 0){
            $loteActualizado->delete();
        }
    }
    $venta->total = $total;
    if($venta->total>=0){
        $venta->saveOrFail();
        $this->vaciarArticulos();
    }
    else{
        $this->vaciarArticulos();
        return redirect(url()->previous());
    }
    
    
    
    return redirect()->route('ventasTotal', ['id' => $venta->id]);
}

/**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function ventasTotal($id)
      {   
          $venta = Venta::find($id);
 
          
          return view('venta.ventasTotal')->with('venta', $venta);
      }

    /**
    * Display the specified resource.
    *@param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    * @param  int  $id
    */
    public function confirmarVenta(Request $request, $id)
    {
        $venta = Venta::find($id);
        if($request->get('pago')<$venta->total){
        return redirect(url()->previous());  
        }
        $venta->tipoPago = $request->get('tipoPago');
        $venta->montoPagado = $request->get('pago');
        $venta->save();
        $ventas = venta::all();
        return redirect('/ventas')->with('ventas', $ventas);
        // return view('venta.index')->with('ventas', $ventas);
    }
}
