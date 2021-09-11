<?php

namespace App\Http\Controllers;

use App\Models\Pasajero;
use Illuminate\Http\Request;
use App\Models\Corrida;
use Illuminate\Support\Facades\Auth;

use PDF;

class PasajeroController extends Controller
{
    public function download_pasajeros($idCorrida)
    {
        $corrida = Corrida::findOrFail($idCorrida);
        $asientos = $corrida->asientos;

        $pdf = PDF::loadView('pdf.pasajeros',compact('asientos','corrida'));
        return $pdf->download('pasajeros.pdf');
    }

    public function validate_pasajeros(Request $request,$idCorrida)
    {
        //VALIDACION
        $rules=[
            '*'=>'required',
            'email' => 'email'
        ];
        $message=[
            'required' => 'El campo es obligatorio',
            'email' => 'Ingrese un correo electrónico válido'
        ];
        $request->validate($rules,$message);
        
        $comprador = [
            'nombre' => $request->comprador_nombre,
            'apellido' => $request->comprador_apellido,
            'email' => $request->email,
            'telefono' => $request->telefono
        ];

        $pasajeros = $request->except(['_token','comprador_nombre','comprador_apellido','email','telefono']);

        $request->session()->put('comprador',$comprador);
        $request->session()->put('pasajeros',$pasajeros);

        return redirect()->route('mostrar_asientos',[$idCorrida]);
    }

    public function mostrar_ingreso_pasajeros($idCorrida)
    {
        $pasajes = session('pasajes');
        $cantidad = session('cantidad');
        $total = session('total');
       
        $corrida = Corrida::findOrFail($idCorrida);
        return view('reservar.pasajero',['corrida'=>$corrida,'pasajes'=>$pasajes,'cantidad'=>$cantidad,'total'=>$total]);
    }

    public function mostrar_pasajeros(Request $request)
    {
        $request->session()->forget(['cantidad','total','pasajes']);

        if (!$request->niños && !$request->adultos) {
            return redirect()->back()->with('error','Debe ingresar la cantidad de pasajeros.');
        }
        if ($request->niños && !$request->adultos) {
            return redirect()->back()->with('error','El niño debe ir acompañado por un adulto.');
        }
        $corrida = Corrida::findOrFail($request->corrida);
        $cantidad = $request->niños + $request->adultos;
        $total = $corrida->precio->adulto * $request->adultos + $corrida->precio->niño * $request->niños;
        $pasajes = [
            'niños'=>$request->niños,
            'adultos'=>$request->adultos
        ];
        
        $request->session()->put('cantidad',$cantidad);
        $request->session()->put('total',$total);
        $request->session()->put('pasajes',$pasajes);
        if ($request->niños != null) {
            $request->session()->put('niños',true);
        }

        return redirect()->route('mostrar_ingreso_pasajeros',[$request->corrida]);
    }

    public function verCorridas()
    {
        if (Auth::user()->role == 2){
            $corrida = Corrida::where('chofer_id',Auth::user()->chofer->id)->orderByDesc('created_at')->get();
        }else{
            $corrida = Corrida::orderByDesc('created_at')->get();
        }
        return view('pasajeros.verCorridas',['corridas'=>$corrida]);
    }
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
     * @param  \App\Models\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function show($idCorrida)
    {
        $corrida = Corrida::findOrFail($idCorrida);
        $asientos = $corrida->asientos;
        return view('pasajeros.verPasajeros',['corrida'=>$corrida,'asientos'=>$asientos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasajero $pasajero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pasajero $pasajero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasajero $pasajero)
    {
        //
    }
}
