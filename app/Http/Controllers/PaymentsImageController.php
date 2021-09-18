<?php

namespace App\Http\Controllers;

use App\Models\PaymentsImage;
use App\Models\Asiento;
use App\Models\Corrida;
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
                $image = base64_encode(file_get_contents(public_path('/img/logo/LOGO-FONDO-NEGRO-LV-2.jpg')));
                $data = [
                    'corrida' => $corrida,
                    'total' => $payment->total,
                    'tipo_pago' => $payment->tipo_pago,
                    'pasajeros' =>json_decode($payment->descripcion,true),
                    'asientos'=> json_decode($payment->asientos),
                    'image'=>$image
                ];
                $pdf = PDF::loadView('pdf.ticket', $data);
                
                //MAIL
                $correo=new SendMailable;
                $correo->attachData($pdf->output(),'Ticket-ida.pdf',['mime' => 'application/pdf']);

                // PDF REGRESO
                if ($payment->descripcion_regreso != null) {
                    $descripcion = json_decode($payment->descripcion_regreso,true);
                    $corrida = Corrida::findOrFail($descripcion['corrida']);
                    $pasajeros = $descripcion['pasajeros'];
                    $asientos = $descripcion['asientos'];
                    $data = [
                        'corrida'=> $corrida,
                        'total' => $payment->total,
                        'tipo_pago' => $payment->tipo_pago,
                        'pasajeros' => $pasajeros,
                        'asientos'=> $asientos,
                        'image'=>$image
                    ];
                    $pdfRegreso = PDF::loadView('pdf.ticket', $data);
                    $correo->attachData($pdfRegreso->output(),'Ticket-regreso.pdf',['mime' => 'application/pdf']);
                }

                Mail::to($comprador->email)->send($correo);

                return redirect()->route('ver_transferencias')->with('success','El email fue enviado con éxito');

            default:
                $paymentsImage = PaymentsImage::findOrFail($paymentsImageID);
                $paymentsImage->visto = 1;
                $paymentsImage->save();

                // BORRAR ASIENTO
                $pago = $paymentsImage->payment;
                $asientosReserv = json_decode($pago->asientos);
                foreach ($asientosReserv as $asientoReserv) {
                    $asiento = Asiento::where('corrida_id',$pago->corrida->id)->where('asiento',$asientoReserv)->first()->delete();
                }

                // BORRAR ASIENTO VUELTA
                if ($pago->descripcion_regreso != null) {
                    $vuelta = json_decode($pago->descripcion_regreso,true);
                    $asientosVuelta = $vuelta['asientos'];
                    $corridaVuelta = $vuelta['corrida'];
                    foreach ($asientosVuelta as $asientoVuelta) {
                        $asiento = Asiento::where('corrida_id',$corridaVuelta)->where('asiento',$asientoVuelta)->first()->delete();  
                    }
                }

                //MAIL
                $comprador = $paymentsImage->payment->comprador;
                // $link = $request->gethost() . '/pagar/transferencia/subir/' . $paymentsImage->payment->number_order;
                $correo = new RejectMailable();
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
