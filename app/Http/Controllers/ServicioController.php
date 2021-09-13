<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::orderByDesc('created_at')->get();
        return view('CRUD.ver-modificar',['servicios'=>$servicios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('CRUD.crear');
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
            'imagen'=>'required'
        ];
        $message=[
            'required' => 'El campo es obligatorio',
        ];
        $request->validate($rules,$message);
        
        $servicio = new Servicio;
        $servicio->nombre = $request->nombre;
        
        //IMAGEN 
        if($request->hasfile('imagen')){
            $nameImg= uniqid() . '.'. $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(public_path('img/servicios'), $nameImg);
        }

        $servicio->imagen = $nameImg;
        $servicio->save();

        return redirect()->route('servicio.index')->with('mensaje.success','El servicio ha sido creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicio)
    {
        return view('CRUD.edit',['unidad'=>$servicio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        // VALIDATION
        $rules=[
            'nombre'=>'required',
        ];
        $message=[
            'required' => 'El campo es obligatorio',
        ];
        $request->validate($rules,$message);

        //IMAGEN 
        if($request->hasfile('imagen')){
            $nameImg= uniqid() . '.'. $request->file('imagen')->getClientOriginalExtension();
            $request->file('imagen')->move(public_path('img/servicios'), $nameImg);
            $servicio->imagen = $nameImg;
        }
        
        $servicio->nombre = $request->nombre;
        $servicio->save();

        return redirect()->route('servicio.index')->with('mensaje.success','El servicio ha sido creado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect('servicio')->with('mensaje.success','El servicio ha sido eliminado.');
    }
}
