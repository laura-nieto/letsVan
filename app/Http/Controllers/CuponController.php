<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cupones = Cupon::orderByDesc('created_at')->get();
        return view('CRUD.ver-modificar',['cupones'=>$cupones]);
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

        $cupon = new Cupon;
        $cupon->nombre = $request->nombre;
        $cupon->save();

        return redirect()->route('cupon.index')->with('mensaje.success','El cupón ha sido creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function show(Cupon $cupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Cupon $cupon)
    {
        return view('CRUD.edit',['unidad'=>$cupon]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cupon $cupon)
    {
        // VALIDATION
        $rules=[
            'nombre'=>'required',
        ];
        $message=[
            'required' => 'El campo es obligatorio',
        ];
        $request->validate($rules,$message);

        
        $cupon->nombre = $request->nombre;
        $cupon->save();

        return redirect()->route('cupon.index')->with('mensaje.success','El cupón ha sido modificado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cupon  $cupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cupon $cupon)
    {
        $cupon->delete();
        return redirect('cupon')->with('mensaje.success','El cupón ha sido eliminado.');
    }
}
