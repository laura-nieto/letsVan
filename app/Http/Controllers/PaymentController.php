<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Asiento;
use App\Models\Pasajero;
use App\Models\Comprador;
use App\Models\Corrida;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

use PDF;


class PaymentController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'nombre' => $comprador['nombre'] . " " . $comprador['apellido'],
            'telefono' => $comprador['telefono'],
            'corrida' => $corrida,
            'total' => session()->get('total'),
            'descripcion' => $descripcion,
            'asientos'=> $guardarAsientos
        ];
        $pdf = PDF::loadView('pdf.ticket', $data);
        return $pdf->download('ticket-letsVan.pdf');
    }

    public function descontar(Request $request,$idCorrida)
    {
        if($request->cupon == 'PROMO2021'){
            $total = $request->session()->get('total');
            $total -= 60;
            $request->session()->forget('total');
            $request->session()->put('total',$total);
            $request->session()->put('cupon',true);
            
            return redirect()->route('vista_pagar',$idCorrida)->with('success','Cupón ingresado con éxito');
        }else{
            return redirect()->route('vista_pagar',$idCorrida)->with('error','El cupón que ingresó no es correcto');
        }
    }

    public function vista_success(Request $request,$idCorrida)
    {    
        // PASAJEROS
        $indexAsiento=0;
        $asientos=session()->get('asientos');
        foreach (session()->get('pasajeros') as $pasajero) {
            $newPasajero = new Pasajero;
            $newPasajero->nombre = $pasajero['nombre'];
            $newPasajero->apellido = $pasajero['apellido'];
            $newPasajero->save();
            
            $newAsiento = new Asiento;
            $newAsiento->pasajero_id = $newPasajero->id;
            $newAsiento->corrida_id = $idCorrida;
            $newAsiento->asiento = $asientos[$indexAsiento];
            $newAsiento->user_id = auth()->user()->id;
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
        if (session()->get('pasajes')['adultos'] != null) {
            $descripcion['adulto']=[
                'precio'=> $corrida->precio->adulto,
                'cantidad' => session()->get('pasajes')['adultos']
            ];
        }
        if (session()->get('pasajes')['niños'] != null) {
            $descripcion['ninios']=[
                'precio'=> $corrida->precio->niño,
                'cantidad' => session()->get('pasajes')['niños']
            ];
        }

        // PAYMENT
        $payment=new Payment;
        $payment->corrida_id = $idCorrida;
        $payment->comprador_id = $newComprador->id;
        $payment->usuario_id = auth()->user()->id;
        $payment->number_order = $request->payment_id;
        $payment->descripcion = json_encode($descripcion);
        $payment->asientos = json_encode($guardarAsientos);
        $payment->total = session()->get('total');
        $payment->pay = 1;
        $payment->save();

        //PDF
        $data = [
            'nombre' => $comprador['nombre'] . " " . $comprador['apellido'],
            'telefono' => $comprador['telefono'],
            'corrida' => $corrida,
            'total' => session()->get('total'),
            'descripcion' => $descripcion,
            'asientos'=> $guardarAsientos
        ];
        $pdf = PDF::loadView('pdf.ticket', $data);
       
        //MAIL
        $correo=new SendMailable;
        $correo->attachData($pdf->output(),'Ticket.pdf',['mime' => 'application/pdf']);
        Mail::to($comprador['email'])->send($correo);


        //BORRAR DATOS DE SESSION
        $request->session()->forget(['cantidad', 'total','pasajes','comprador','pasajeros','asientos','cupon']);
        
        return redirect()->route('reserva_informacion',$idCorrida);
    }



    
    public function vista_fail()
    {
        return redirect()->route('index')->with('error','Su pago no se pudo realizar.');
    }
    public function vista_pending()
    {
        return redirect()->route('index')->with('success','Su pago está siendo procesado');
    }
}
