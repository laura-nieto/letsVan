<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Corrida;
use App\Models\Asiento;

use Illuminate\Support\Facades\Mail;
use App\Mail\RememberMailable;

use Illuminate\Support\Facades\Storage;

class LimpiarReservas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservas:limpiar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpiar reservas de transferencias que no han sido pagadas en 8hs.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $payments = Payment::where('pay',2)->get();

        foreach ($payments as $payment) {
            $diff =  $now->diffInRealMinutes($payment->created_at);
            $msj = $diff;

            if ($diff == 420 || $diff == 419) {
                $link = $request->gethost() . '/pagar/transferencia/subir/' . $payment->number_order;
                $correo = new RememberMailable;
                Mail::to($payment->comprador->email,$link)->send($correo);
            }
            if ($diff >= 480) {
                $corrida = Corrida::findOrFail($payment->corrida_id);
                $asientosReserv = json_decode($payment->asientos);
                
                foreach ($asientosReserv as $asientoReserv) {
                    $asiento = Asiento::where('corrida_id',$corrida->id)->where('asiento',$asientoReserv)->first()->delete();
                }
                $payment->delete();
            }
        }

    }
}
