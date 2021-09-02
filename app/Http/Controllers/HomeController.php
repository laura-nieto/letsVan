<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destino;
use App\Models\PaymentsImage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $destinos = Destino::all();
        $payments = PaymentsImage::where('visto',0)->exists();
        return view('welcome',['destinos'=>$destinos,'exists'=>$payments]);
    }
}
