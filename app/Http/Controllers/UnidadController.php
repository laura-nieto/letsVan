<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;
use App\Models\Servicio;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = Unidad::orderByDesc('id')->get();
        return view('CRUD.ver-modificar',['unidades'=>$unidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicios = Servicio::all();
        return view('CRUD.crear',['servicios'=>$servicios]);
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
            'costo_renta'=>'integer',
            'asientos'=>'integer',
            'imagen'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $message=[
            'required' => 'El campo es obligatorio',
            'integer'=> 'Los datos deben ser numéricos',
            'image' => 'El archivo debe ser una imágen',
            'mimes' => 'La imágen debe ser jpeg,png o jpg',
            'max' => 'El archivo debe como máximo :max kb'
        ];
        $request->validate($rules,$message);

        //IMAGEN 
        if($request->hasfile('imagen')){
            $nameImg= uniqid() . '.'. $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(public_path('img/unidades'), $nameImg);
        }

        // GUARDAR
        $unity = new Unidad;
        $unity->marca = $request->marca;
        $unity->modelo = $request->modelo;
        $unity->placa = $request->placa;
        $unity->propietario = $request->propietario;
        $unity->asientos = $request->asientos;
        $unity->costo_renta = $request->costo_renta;
        $unity->image = $nameImg;
        $unity->save();

        //SERVICIOS
        if ($request->servicios) {
            foreach ($request->servicios as $servicio) {
                $unity->servicios()->attach($servicio);
            }
        }

        return redirect()->route('unidad.index')->with('mensaje.success','La unidad ha sido creada.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function show(Unidad $unidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidad $unidad)
    {
        $servicios = Servicio::all();
        return view('CRUD.edit',['unidad'=>$unidad,'servicios'=>$servicios]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unidad $unidad)
    {
        // VALIDATION
        $rules=[
            '*'=>'required',
            'costo_renta'=>'integer',
            'asientos'=>'integer'
        ];
        $message=[
            'required' => 'El campo es obligatorio',
            'integer'=> 'Los datos deben ser numéricos'
        ];
        $request->validate($rules,$message);

        $unidad->marca = $request->marca;
        $unidad->modelo = $request->modelo;
        $unidad->placa = $request->placa;
        $unidad->propietario = $request->propietario;
        $unidad->asientos = $request->asientos;
        $unidad->costo_renta = $request->costo_renta;
        $unidad->save();

        //SERVICIOS
        foreach ($request->servicios as $servicio){
            $unidad->servicios()->attach($servicio);
        }

        return redirect()->route('unidad.index')->with('mensaje.success','La unidad ha sido actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unidad  $unidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidad $unidad)
    {
        $unidad->delete();
        return redirect('unidad')->with('mensaje.success','La unidad ha sido eliminada');
    }
}
