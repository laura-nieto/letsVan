<?php

namespace App\Http\Controllers;

use App\Models\Corrida;
use Illuminate\Http\Request;
use App\Models\Unidad;
use App\Models\Chofer;
use App\Models\Destino;

use Carbon\Carbon;

class CorridaController extends Controller
{
    public function informacion_transferencia($idCorrida)
    {
        $corrida = Corrida::findOrFail($idCorrida);
        return view('reservar.informacionTransferencia',['corrida'=>$corrida]);
    }
    public function informacion_viaje($idCorrida)
    {
        $corrida = Corrida::findOrFail($idCorrida);
        return view('reservar.informacion',['corrida'=>$corrida]);
    }

    public function vista_pagar($idCorrida)
    {
        $pasajes = session('pasajes');
        $total = session('total');
        $corrida = Corrida::findOrFail($idCorrida);
        
        //DAYS
        $today = Carbon::today();
        $diferencia = $today->diffInDays($corrida->dia_salida);
        if ($diferencia > 1) {
            $transferencia = true;
        } else {
            $transferencia = false;
        }

        return view('reservar.pagar',['total'=>$total,'pasajes'=>$pasajes,'corrida'=>$corrida,'transeferencia'=>$transferencia]);
    }

    public function validate_asiento(Request $request,$idCorrida)
    {
        //dd($request->session()->get('cantidad')[0]);
        if (empty($request->except(['_token']))) {
            return redirect()->back()->with('error','Debe seleccionar los asientos');
        }elseif ($request->session()->get('cantidad') != count($request->asiento) ) {
            return redirect()->back()->with('error','Debe seleccionar la cantidad de asientos adecuada');
        }else{
            $request->session()->put('asientos',$request->asiento);
            return redirect()->route('vista_pagar',$idCorrida);
        }
    }
    public function mostrar_asientos($idCorrida)
    {
        $corrida = Corrida::findOrFail($idCorrida);
        $cantidad = session('cantidad');

        return view('reservar.asientos',['corrida'=>$corrida,'cantidad'=>$cantidad]);
    }

    public function buscar(Request $request)
    {
        $rules=[
            'origen'=>'required',
            'destino'=>'required',
        ];
        $message=[
            'required' => 'Seleccione un :attribute',
        ];
        $request->validate($rules,$message);
      
        
        // BUSQUEDA
        $coincidencias = Corrida::where('origen','like',"%{$request->origen}%")->where('destino','like',"%{$request->destino}%");
        $copy = Corrida::where('origen','like',"%{$request->origen}%")->where('destino','like',"%{$request->destino}%")->get();
        
        if ($copy->isNotEmpty()) {
            if (!is_null($request->dia_salida)) {
                $coincidencias = $coincidencias->where('dia_salida',$request->dia_salida);
            }
            if (!is_null($request->dia_llegada)) {
                $coincidencias = $coincidencias->where('dia_llegada',$request->dia_llegada);
            }
            if (isset($request->viaje_redondo)) {
                $coincidencias = $coincidencias->where('redondo',true);
            }
        }
        $coincidencias = $coincidencias->get();
        
        return view('reservar.coincidencias',['coincidencias'=>$coincidencias]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $corrida = Corrida::orderByDesc('created_at')->get();
        return view('CRUD.ver-modificar',['corridas'=>$corrida]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidad::all();
        $choferes = Chofer::all();
        $destinos = Destino::all();
        return view('CRUD.crear',['unidades'=>$unidades,'choferes'=>$choferes,'destinos'=>$destinos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATION
        $rules=[
            '*'=>'required',
            'dia_salida'=>'date',
            'dia_llegada'=>'date',
            'pasajeros'=> 'integer',
        ];
        $message=[
            'required' => 'El campo es obligatorio',
            'integer' => 'La cantidad de pasajeros debe ser numérico',
            'date' => 'Ingrese una fecha valida'
        ];
        
        $request->validate($rules,$message);

        $corrida = new Corrida;
        $corrida->destino = $request->destino;
        $corrida->origen = $request->origen;
        $corrida->dia_salida = $request->dia_salida;
        $corrida->hora_salida = $request->hora_salida;
        $corrida->dia_llegada = $request->dia_llegada;
        $corrida->hora_llegada = $request->hora_llegada;
        $corrida->unidad_id = $request->unidad_id;
        $corrida->chofer_id = $request->chofer_id;
        $corrida->save();

        if ($request->cupon) {
            $cupon = true;
        }else{
            $cupon = false;
        }
        $corrida->precio()->create([
            'adulto' => $request->precio_adulto,
            'niño' =>$request->precio_niño,
            'cupon' =>$cupon,
            'corrida_id'=>$corrida->id
        ]);
        
        return redirect()->route('corrida.index')->with('mensaje.success','La corrida ha sido creada.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Corrida  $corrida
     * @return \Illuminate\Http\Response
     */
    public function show(Corrida $corrida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Corrida  $corrida
     * @return \Illuminate\Http\Response
     */
    public function edit(Corrida $corrida)
    {
        $unidades = Unidad::all();
        $choferes = Chofer::all();
        $destinos = Destino::all();
        return view('CRUD.edit',['unidad'=>$corrida,'unidades'=>$unidades,'choferes'=>$choferes,'destinos'=>$destinos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Corrida  $corrida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Corrida $corrida)
    {
        // VALIDATION
        $rules=[
            '*'=>'required',
            'dia_salida'=>'date',
            'dia_llegada'=>'date',
            'pasajeros'=> 'integer',
        ];
        $message=[
            'required' => 'El campo es obligatorio',
            'integer' => 'La cantidad de pasajeros debe ser numérico',
            'date' => 'Ingrese una fecha valida'
        ];
        $request->validate($rules,$message);

        $corrida->destino = $request->destino;
        $corrida->origen = $request->origen;
        $corrida->dia_salida = $request->dia_salida;
        $corrida->hora_salida = $request->hora_salida;
        $corrida->dia_llegada = $request->dia_llegada;
        $corrida->hora_llegada = $request->hora_llegada;
        $corrida->chofer_id = $request->chofer_id;
        $corrida->unidad_id = $request->unidad_id;
        $corrida->save();
        
        if ($request->cupon) {
            $cupon = true;
        }else{
            $cupon = false;
        }
        $corrida->precio->adulto = $request->precio_adulto;
        $corrida->precio->niño = $request->precio_niño;
        $corrida->precio->cupon = $cupon;
        $corrida->push();

        return redirect()->route('corrida.index')->with('mensaje.success','La corrida ha sido modificada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Corrida  $corrida
     * @return \Illuminate\Http\Response
     */
    public function destroy(Corrida $corrida)
    {
        $corrida->delete();
        return redirect('corrida')->with('mensaje.success','La corrida ha sido eliminada.');
    }
}
