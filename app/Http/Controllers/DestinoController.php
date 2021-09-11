<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use Illuminate\Http\Request;

class DestinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinos = Destino::orderByDesc('created_at')->get();
        return view('CRUD.ver-modificar',['destinos'=>$destinos]);
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
        ];
        $message=[
            'required' => 'El campo es obligatorio',
        ];
        $request->validate($rules,$message);

        $destino = new Destino;
        $destino->destino = $request->nombre;
        $destino->destino_origen = $request->type;
        $destino->ubicacion = $request->ubicacion;
        $destino->url = $request->url;
        
        $destino->save();

        return redirect()->route('destino.index')->with('mensaje.success','El destino ha sido creado.');
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
    public function edit(Destino $destino)
    {
        return view('CRUD.edit',['unidad'=>$destino]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destino $destino)
    {
        // VALIDATION
        $rules=[
            '*'=>'required',
        ];
        $message=[
            'required' => 'El campo es obligatorio',
        ];
        $request->validate($rules,$message);

        $destino->destino = $request->nombre;
        $destino->destino_origen = $request->type;
        $destino->ubicacion = $request->ubicacion;
        $destino->url = $request->url;
        $destino->save();

        return redirect()->route('destino.index')->with('mensaje.success','El destino ha sido creado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destino $destino)
    {
        $destino->delete();
        return redirect('destino')->with('mensaje.success','El destino ha sido eliminado.');
    }
}
