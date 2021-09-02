<?php

namespace App\Http\Controllers;

use App\Models\PaymentsImage;
use App\Models\Asiento;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Mail\RejectMailable;

use PDF;

class PaymentsImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transferencias = PaymentsImage::orderByDesc('id')->get();
        return view('transferencias.viewAll',['transferencias'=>$transferencias]);
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
     * @param  \App\Models\PaymentsImage  $paymentsImage
     * @return \Illuminate\Http\Response
     */
    public function show($paymentsImageID)
    {
        $paymentsImage = PaymentsImage::findOrFail($paymentsImageID);
        return view('transferencias.view',['payment'=>$paymentsImage]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentsImage  $paymentsImage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$paymentsImageID)
    {
        switch ($request->submitButton){
            case 'Aprobar':
                $paymentsImage = PaymentsImage::findOrFail($paymentsImageID);
                $paymentsImage->visto = 1;
                $paymentsImage->save();

                //CAMBIAR ESTADO PAYMENT
                $paymentsImage->payment->update([
                    'pay'=>1
                ]);

                $comprador = $paymentsImage->payment->comprador;
                $payment = $paymentsImage->payment;
                $corrida = $payment->corrida;
                
                //PDF
                $data = [
                    'nombre' => $comprador->nombre . " " . $comprador->apellido,
                    'telefono' => $comprador->telefono,
                    'corrida' => $corrida,
                    'total' => $payment->total,
                    'descripcion' =>json_decode($payment->descripcion,true),
                    'asientos'=> json_decode($payment->asientos)
                ];
                $pdf = PDF::loadView('pdf.ticket', $data);
                
                //MAIL
                $correo=new SendMailable;
                $correo->attachData($pdf->output(),'Ticket.pdf',['mime' => 'application/pdf']);
                Mail::to($comprador->email)->send($correo);

                return redirect()->route('ver_transferencias')->with('success','El email fue enviado con éxito');

            default:
                $paymentsImage = PaymentsImage::findOrFail($paymentsImageID);
                $paymentsImage->visto = 1;
                //$paymentsImage->save();

                //DELETE ASIENTOS
                $pago = $paymentsImage->payment;
                $asientosReserv = json_decode($pago->asientos);
                foreach ($asientosReserv as $asientoReserv) {
                    $asiento = Asiento::where('corrida_id',$pago->corrida->id)->where('asiento',$asientoReserv)->first()->delete();
                }

                $pago->delete();
                $comprador = $paymentsImage->payment->comprador;
                $paymentsImage->delete();

                //MAIL
                $correo = new RejectMailable;
                Mail::to($comprador->email)->send($correo);

                return redirect()->route('ver_transferencias')->with('success','El pago ha sido rechazado');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentsImage  $paymentsImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentsImage $paymentsImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentsImage  $paymentsImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentsImage $paymentsImage)
    {
        //
    }
}
