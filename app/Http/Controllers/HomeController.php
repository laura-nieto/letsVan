<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destino;
use App\Models\PaymentsImage;

class HomeController extends Controller
{
    public function buscador()
    {
        $destinos = Destino::all();
        return view('buscador',['destinos'=>$destinos]);
    }
    public function privacidad()
    {
        return view('privacidad');
    }
    public function terminos()
    {
        return view('terminos');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $destinos = Destino::all();
        if(PaymentsImage::where('visto',0)->exists()) {
            $payments = PaymentsImage::where('visto',0)->count();
        }else{
            $payments = false;
        }
        return view('welcome',['destinos'=>$destinos,'exists'=>$payments]);
    }
}
