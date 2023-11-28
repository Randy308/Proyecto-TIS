<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FaseEvento;
use App\Models\Evento;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Scheduling\Event;

class ActualizarFases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fases:actualizar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cambia entre fases de un evento';

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
        $eventos = Evento::where('estado', 'Activo')->get();
        $idsEventos = $eventos->pluck('id');
        $fases = FaseEvento::where('actual',true)->whereIn('evento_id',$idsEventos)->get(); 
        foreach ($fases as $fase) {
            $datetimeInput =$fase->fechaFin;
            $carbonDatetime = Carbon::parse($datetimeInput);
            if ($carbonDatetime->lessThanOrEqualTo(Carbon::now())) {
                $fase->actual = false; 
                $fase->save();
                if($fase->tipo != 'Finalizacion'){
                    $proxFase = FaseEvento::where('evento_id', $fase->evento_id)
                    ->where('fechaInicio', '>=',  $fase->fechaFin)
                    ->orderBy('fechaInicio')
                    ->first();


                        $proxFase->actual = true;
                        $proxFase->save();
                    
                }else{
                    $evento = Evento::where('id',$fase->evento_id)->first();
                    $evento->estado = 'Finalizado';
                    $evento->save();
                }

            }
        }

        $this->info('Se Actualizaron las fases con exito');
        return 0;
    }
}
