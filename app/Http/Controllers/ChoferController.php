<?php

namespace App\Http\Controllers;

use App\Models\Chofer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chofer = Chofer::orderByDesc('id')->get();
        return view('CRUD.ver-modificar',['choferes'=>$chofer]);
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
            'edad'=>'integer',
        ];
        $message=[
            'required' => 'El campo es obligatorio',
            'integer' => 'La edad debe ser numérica'
        ];
        $request->validate($rules,$message);

        $chofer = new Chofer;
        $chofer->nombre = $request->nombre;
        $chofer->apellido = $request->apellido;
        $chofer->edad = $request->edad;
        $chofer->domicilio = $request->domicilio;
        $chofer->celular = $request->celular;
        $chofer->save();

        $newUser = new User;
        $newUser->name = $request->nombre;
        $newUser->lastname = $request->apellido;
        $newUser->email = $request->email;
        $newUser->phone = $request->celular;
        $newUser->role = 2;
        $newUser->password = Hash::make($request->nombre);
        $newUser->save();

        return redirect()->route('chofer.index')->with('mensaje.success','El chofer ha sido creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function show(Chofer $chofer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function edit(Chofer $chofer)
    {
        return view('CRUD.edit',['unidad'=>$chofer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chofer $chofer)
    {
        // VALIDATION
        $rules=[
            '*'=>'required',
            'edad'=>'integer',
        ];
        $message=[
            'required' => 'El campo es obligatorio',
            'integer' => 'La edad debe ser numérica'
        ];
        $request->validate($rules,$message);

        $chofer->nombre = $request->nombre;
        $chofer->apellido = $request->apellido;
        $chofer->edad = $request->edad;
        $chofer->domicilio = $request->domicilio;
        $chofer->celular = $request->celular;
        $chofer->save();

        return redirect()->route('chofer.index')->with('mensaje.success','El chofer ha sido actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chofer $chofer)
    {
        $chofer->delete();
        return redirect('chofer')->with('mensaje.success','El chofer ha sido eliminado.');
    }
}
