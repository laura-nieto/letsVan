<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Payment;
use App\Models\Asiento;
use App\Models\Pasajero;
use App\Models\Comprador;
use App\Models\Corrida;
use App\Models\PaymentsImage;
use App\Models\Cupon;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Mail\TransferenciaMailable;
use App\Mail\NuevaTransferencia;

use PDF;


class PaymentController extends Controller
{
    public function see_pagos(Request $request)
    {
        $rules=[
            '*'=>'required',
        ];
        $message=[
            'required' => 'Debe ingresar una fecha',
        ];
        $request->validate($rules,$message);

        $coincidencias = Payment::whereBetween('created_at',[$request->desde,$request->hasta])->get();
        return view('pagos.ver',['payments'=>$coincidencias,'fechas'=>[$request->desde,$request->hasta]]);
    }
    public function view_look()
    {
        return view('pagos.buscador');
    }

    public function upload_transferencia(Request $request,$idOrder)
    {
        //VALIDACION
        $rules=[
            'transferencia'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
        $message=[
            'required' => 'Debe subir un archivo',
            'image' => 'El archivo debe ser una imágen',
            'mimes' => 'La imágen debe ser jpeg,png o jpg',
            'max' => 'El archivo debe como máximo :max kb'
        ];
        $request->validate($rules,$message);

        $payment = Payment::where('number_order',$idOrder)->first();

        if($request->hasfile('transferencia')){
            $nameImg= $payment->number_order . '.'. $request->file('transferencia')->getClientOriginalExtension();
            $request->file('transferencia')->move(public_path('img/transferencias'), $nameImg);
            $newImg = new PaymentsImage;
            $newImg->imagen = $nameImg;
            $newImg->payment_id = $payment->id;
            $newImg->save();
        }
        // MAIL
        $correo=new NuevaTransferencia;
        Mail::to('ventas@letsvan.com.mx')->send($correo);

        return view('transferencias.message',['error'=>true]);
    }
    public function vista_subir($idOrder)
    {
        if (Payment::where('number_order',$idOrder)->doesntExist()) {
            return view('transferencias.message',['error'=>false]);
        }
        return view('transferencias.subirTransferencia');
    }

    public function descontar(Request $request,$idCorrida)
    {
        $cupon = Corrida::find($idCorrida)->precio->cupon;
        if($cupon->nombre == $request->cupon){
            $total = $request->session()->get('total');
            $total -= $cupon->descuento;
            $request->session()->forget('total');
            $request->session()->put('total',$total);
            $request->session()->put('cupon',$cupon->descuento);
            
            if ($request->segment(1) == 'redondo') {
                return redirect()->route('vista_pagar_redondo',$idCorrida)->with('success','Cupón ingresado con éxito');
            }else{
                return redirect()->route('vista_pagar',$idCorrida)->with('success','Cupón ingresado con éxito');
            }
        }else{
            return redirect()->route('vista_pagar',$idCorrida)->with('error','El cupón que ingresó no es correcto');
        }
    }

    public function pagar_transferencia(Request $request,$idCorrida)
    {
        if (Auth::check()) {
            $idUser = auth()->user()->id;
        }else{
            $idUser = 2;
        }

        // PASAJEROS
        if (session()->get('redondo')) {
                //IDA
            $indexAsiento=0;
            $asientos = session()->get('asientos_ida');
            foreach (session()->get('pasajeros_ida') as $pasajero) {
                $newPasajero = new Pasajero;
                $newPasajero->nombre = $pasajero['nombre'];
                $newPasajero->apellido = $pasajero['apellido'];
                $newPasajero->type = $pasajero['type'];
                $newPasajero->save();
                $pasajeros['ida'][] = [
                    'nombre'=>$newPasajero->nombre . ' ' . $newPasajero->apellido,
                    'type'=> $newPasajero->type
                ];
        
                $newAsiento = new Asiento;
                $newAsiento->pasajero_id = $newPasajero->id;
                $newAsiento->corrida_id = $idCorrida;
                $newAsiento->asiento = $asientos[$indexAsiento];
                $newAsiento->user_id = $idUser;
                $newAsiento->save();
        
                $guardarAsientos['ida'][]=$asientos[$indexAsiento];
                $indexAsiento+=1;
            }
                //VUELTA
            $indexAsiento=0;
            $asientos = session()->get('asientos_vuelta');
            foreach (session()->get('pasajeros_vuelta') as $pasajero) {
                $newPasajero = new Pasajero;
                $newPasajero->nombre = $pasajero['nombre'];
                $newPasajero->apellido = $pasajero['apellido'];
                $newPasajero->type = $pasajero['type'];
                $newPasajero->save();
                $pasajeros['vuelta'][] = [
                    'nombre'=>$newPasajero->nombre . ' ' . $newPasajero->apellido,
                    'type'=> $newPasajero->type
                ];
        
                $newAsiento = new Asiento;
                $newAsiento->pasajero_id = $newPasajero->id;
                $newAsiento->corrida_id = session()->get('corrida_vuelta');
                $newAsiento->asiento = $asientos[$indexAsiento];
                $newAsiento->user_id = $idUser;
                $newAsiento->save();
        
                $guardarAsientos['vuelta'][]=$asientos[$indexAsiento];
                $indexAsiento+=1;
            }
        }else{
            $indexAsiento=0;
            $asientos = session()->get('asientos');
            foreach (session()->get('pasajeros') as $pasajero) {
                $newPasajero = new Pasajero;
                $newPasajero->nombre = $pasajero['nombre'];
                $newPasajero->apellido = $pasajero['apellido'];
                $newPasajero->type = $pasajero['type'];
                $newPasajero->save();
                $pasajeros['ida'][] = [
                    'nombre'=>$newPasajero->nombre . ' ' . $newPasajero->apellido,
                    'type'=> $newPasajero->type
                ];
        
                $newAsiento = new Asiento;
                $newAsiento->pasajero_id = $newPasajero->id;
                $newAsiento->corrida_id = $idCorrida;
                $newAsiento->asiento = $asientos[$indexAsiento];
                $newAsiento->user_id = $idUser;
                $newAsiento->save();
        
                $guardarAsientos['ida'][]=$asientos[$indexAsiento];
                $indexAsiento+=1;
            }
        }
        
        // COMPRADOR
        $comprador=session()->get('comprador');
        $newComprador = new Comprador;
        $newComprador->nombre = $comprador['nombre'];
        $newComprador->apellido = $comprador['apellido'];
        $newComprador->email = $comprador['email'];
        $newComprador->telefono = $comprador['telefono'];
        $newComprador->save();

        $corrida = Corrida::findOrFail($idCorrida);

        // PAYMENT
        $payment = new Payment;
        $payment->corrida_id = $idCorrida;
        $payment->comprador_id = $newComprador->id;
        $payment->usuario_id = $idUser;
        $payment->number_order = uniqid();
        $payment->descripcion = json_encode($pasajeros['ida']);
        $payment->tipo_pago = 'Transferencia';
        $payment->asientos = json_encode($guardarAsientos['ida']);
        $payment->total = session()->get('total');
        $payment->pay = 2;
        
        if (session()->get('redondo')) {
            $pasajerosVuelta = $pasajeros['vuelta'];
            $payment->descripcion_regreso = json_encode( ['corrida'=>Corrida::findOrFail(session('corrida_vuelta'))->id,'pasajeros'=>$pasajerosVuelta,'asientos'=>$guardarAsientos['vuelta']] ) ; 
        }
        $payment->save();
    
        //MAIL
        $link = $request->gethost() . '/pagar/transferencia/subir/' . $payment->number_order;
        $correo= new TransferenciaMailable($payment->number_order,$link);
        Mail::to($comprador['email'])->send($correo);

        //BORRAR DATOS DE SESSION
        $request->session()->forget(['cantidad','total','pasajes','comprador','cupon','niños','corrida_ida','redondo','pasajeros_ida','pasajeros_vuelta','asientos_ida','asientos_vuelta','corrida_vuelta','cantidad_vuelta']);
        
        return redirect()->route('reserva_transferencia',$idCorrida);
    }

    public function vista_success_redondo(Request $request,$idCorrida)
    {
        if (Auth::check()) {
            $idUser = auth()->user()->id;
        }else{
            $idUser = 2;
        }

        // PASAJEROS
            //IDA
        $indexAsiento=0;
        $asientos = session()->get('asientos_ida');
        foreach (session()->get('pasajeros_ida') as $pasajero) {
            $newPasajero = new Pasajero;
            $newPasajero->nombre = $pasajero['nombre'];
            $newPasajero->apellido = $pasajero['apellido'];
            $newPasajero->type = $pasajero['type'];
            $newPasajero->save();
            $pasajeros['ida'][] = [
                'nombre'=>$newPasajero->nombre . ' ' . $newPasajero->apellido,
                'type'=> $newPasajero->type
            ];

            $newAsiento = new Asiento;
            $newAsiento->pasajero_id = $newPasajero->id;
            $newAsiento->corrida_id = session()->get('corrida_vuelta');
            $newAsiento->asiento = $asientos[$indexAsiento];
            $newAsiento->user_id = $idUser;
            $newAsiento->save();

            $guardarAsientos['ida'][]=$asientos[$indexAsiento];
            $indexAsiento+=1;
        }
            //VUELTA
        $indexAsiento=0;
        $asientos = session()->get('asientos_vuelta');
        foreach (session()->get('pasajeros_vuelta') as $pasajero) {
            $newPasajero = new Pasajero;
            $newPasajero->nombre = $pasajero['nombre'];
            $newPasajero->apellido = $pasajero['apellido'];
            $newPasajero->type = $pasajero['type'];
            $newPasajero->save();
            $pasajeros['vuelta'][] = [
                'nombre'=>$newPasajero->nombre . ' ' . $newPasajero->apellido,
                'type'=> $newPasajero->type
            ];

            $newAsiento = new Asiento;
            $newAsiento->pasajero_id = $newPasajero->id;
            $newAsiento->corrida_id = $idCorrida;
            $newAsiento->asiento = $asientos[$indexAsiento];
            $newAsiento->user_id = $idUser;
            $newAsiento->save();

            $guardarAsientos['vuelta'][]=$asientos[$indexAsiento];
            $indexAsiento+=1;
        }

        // COMPRADOR
        $comprador=session()->get('comprador');
        $newComprador = new Comprador;
        $newComprador->nombre = $comprador['nombre'];
        $newComprador->apellido = $comprador['apellido'];
        $newComprador->email = $comprador['email'];
        $newComprador->telefono = $comprador['telefono'];
        $newComprador->save();

        $ida = Corrida::findOrFail(session('corrida_ida'));
        $vuelta = Corrida::findOrFail(session('corrida_vuelta'));

        // PAYMENT
        $payment=new Payment;
        $payment->corrida_id = $idCorrida;
        $payment->comprador_id = $newComprador->id;
        $payment->usuario_id = $idUser;
        $payment->number_order = $request->payment_id;
        $payment->descripcion = json_encode($pasajeros);
        $payment->asientos = json_encode($guardarAsientos);
        $payment->tipo_pago = 'Mercado Pago';
        $payment->total = session()->get('total');
        $payment->pay = 1;
        $payment->save();

        //PDF
        $image = base64_encode(file_get_contents(public_path('/img/logo/LOGO-FONDO-NEGRO-LV-2.jpg')));
        $data_ida = [
            'corrida' => $ida,
            'total' => session()->get('total'),
            'tipo_pago' => $payment->tipo_pago,
            'asientos'=> session()->get('asientos_ida'),
            'pasajeros' => session()->get('pasajeros_ida'),
            'image'=>$image
        ];
        $pdf_ida = PDF::loadView('pdf.ticket', $data_ida);

        $data_vuelta = [
            'corrida' => $vuelta,
            'total' => session()->get('total'),
            'tipo_pago' => $payment->tipo_pago,
            'asientos'=> session()->get('asientos_vuelta'),
            'pasajeros' => session()->get('pasajeros_vuelta'),
            'image'=>$image
        ];
        $pdf_vuelta = PDF::loadView('pdf.ticket', $data_vuelta);

        //MAIL
        $correo=new SendMailable;
        $correo->attachData($pdf_ida->output(),'Ticket_ida.pdf',['mime' => 'application/pdf']);
        $correo->attachData($pdf_vuelta->output(),'Ticket_vuelta.pdf',['mime' => 'application/pdf']);
        Mail::to($comprador['email'])->send($correo);

        //BORRAR DATOS DE SESSION
        $request->session()->forget(['cantidad','total','pasajes','comprador','cupon','niños','corrida_ida','redondo','pasajeros_ida','pasajeros_vuelta','asientos_ida','asientos_vuelta','corrida_vuelta','cantidad_vuelta']);
                
        return redirect()->route('reserva_informacion_redondo',[$vuelta->id,$idCorrida])->with('success','asd');
    }

    public function vista_success(Request $request,$idCorrida)
    {    
        if (Auth::check()) {
            $idUser = auth()->user()->id;
        }else{
            $idUser = 2;
        }
        // PASAJEROS
        $indexAsiento=0;
        $asientos=session()->get('asientos');
        foreach (session()->get('pasajeros') as $pasajero) {
            $newPasajero = new Pasajero;
            $newPasajero->nombre = $pasajero['nombre'];
            $newPasajero->apellido = $pasajero['apellido'];
            $newPasajero->type = $pasajero['type'];
            $newPasajero->save();
            $pasajeros[] = [
                'nombre'=>$newPasajero->nombre . ' ' . $newPasajero->apellido,
                'type'=> $newPasajero->type
            ];

            $newAsiento = new Asiento;
            $newAsiento->pasajero_id = $newPasajero->id;
            $newAsiento->corrida_id = $idCorrida;
            $newAsiento->asiento = $asientos[$indexAsiento];
            $newAsiento->user_id = $idUser;
            $newAsiento->save();

            $guardarAsientos[]=$asientos[$indexAsiento];
            $indexAsiento+=1;
        }
        
        // COMPRADOR
        $comprador=session()->get('comprador');
        $newComprador = new Comprador;
        $newComprador->nombre = $comprador['nombre'];
        $newComprador->apellido = $comprador['apellido'];
        $newComprador->email = $comprador['email'];
        $newComprador->telefono = $comprador['telefono'];
        $newComprador->save();
    
        $corrida = Corrida::findOrFail($idCorrida);

        // PAYMENT
        $payment=new Payment;
        $payment->corrida_id = $idCorrida;
        $payment->comprador_id = $newComprador->id;
        $payment->usuario_id = $idUser;
        $payment->number_order = $request->payment_id;
        $payment->descripcion = json_encode($pasajeros);
        $payment->asientos = json_encode($guardarAsientos);
        $payment->tipo_pago = 'Mercado Pago';
        $payment->total = session()->get('total');
        $payment->pay = 1;
        $payment->save();
        
        //PDF
        $image = base64_encode(file_get_contents(public_path('/img/logo/LOGO-FONDO-NEGRO-LV-2.jpg')));
        $data = [
            'corrida' => $corrida,
            'total' => session()->get('total'),
            'tipo_pago' => $payment->tipo_pago,
            'asientos'=> $guardarAsientos,
            'pasajeros' => $pasajeros,
            'image'=>$image
        ];
        $pdf = PDF::loadView('pdf.ticket', $data);
       
        //MAIL
        $correo=new SendMailable;
        $correo->attachData($pdf->output(),'Ticket.pdf',['mime' => 'application/pdf']);
        Mail::to($comprador['email'])->send($correo);


        //BORRAR DATOS DE SESSION
        $request->session()->forget(['cantidad', 'total','pasajes','comprador','pasajeros','asientos','cupon','niños']);
        
        return redirect()->route('reserva_informacion',$idCorrida)->with('success','asd');
    }

    
    public function vista_fail(Request $request)
    {
        $request->session()->forget(['cantidad', 'total','pasajes','comprador','pasajeros','asientos','cupon','niños']);
        return redirect()->route('index')->with('error','Su pago no se pudo realizar. Intentelo nuevamente.');
    }
    public function vista_pending()
    {
        $request->session()->forget(['cantidad', 'total','pasajes','comprador','pasajeros','asientos','cupon','niños']);
        return redirect()->route('index')->with('success','Su pago está siendo procesado');
    }

    public function show($idPayment)
    {
        $payment = Payment::findOrFail($idPayment);
        return view('pagos.verUsuario',['payment'=>$payment]);
    }
}
