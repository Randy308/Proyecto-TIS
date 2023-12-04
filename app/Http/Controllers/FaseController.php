<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Fase;
use App\Models\FaseEvento;
use Illuminate\Http\Request;
use App\Rules\ValidarSuperposicionFechasFases;
use App\Rules\FechaMaximaFase;
use App\Rules\FechaMenorQue;
use App\Rules\FechaMayorQue;
use App\Rules\FechaMayorQueTodasLasDemas;
use App\Rules\FechaMenorQueTodasLasDemas;
use App\Rules\FechaMinimaFase;
use Carbon\Carbon;

class FaseController extends Controller
{

    public function show($id)
    {
        $evento = Evento::find($id);
        $fasesUltimas = FaseEvento::where('evento_id', $id)
            ->orderBy('secuencia', 'desc')
            ->take(2)
            ->get();
        $fasesUltimas = $fasesUltimas->reverse();

        return view('crear-cronograma', compact('evento', 'fasesUltimas'));
    }
    public function delete($faseId)
    {
        $fase = FaseEvento::find($faseId);
        $fase->delete();
        return back()->with('success', 'Fase Eliminado Exitosamente');
    }


    public function store(Request $request, $eventoId)
    {

        $this->validate($request, [
            'nombre_fase' => ['required', 'min:4', 'regex:/^[\p{L}0-9_ ]+$/u', 'max:50'],
            'descripcion_fase' => 'required',
            new ValidarSuperposicionFechasFases($eventoId, -1),
            'fechaInicio' => [
                'required',
                new FechaMenorQue($request['fechaFin']),
                new FechaMinimaFase($eventoId)
            ],
            'fechaFin' => ['required', new FechaMaximaFase($eventoId)],
            'tipo' => 'required',

        ]);

        $datetimeInput1 = $request->input('fechaInicio');
        $carbonDatetime1 = Carbon::parse($datetimeInput1);

        $datetimeInput2 = $request->input('fechaFin');
        $carbonDatetime2 = Carbon::parse($datetimeInput2);
        //$numeroFases = FaseEvento::where('evento_id', $eventoId)->count() + 1;
        $secuenciaMaxima = FaseEvento::where('evento_id', $eventoId)
            ->where('secuencia', '<>', 1000) // Excluir el valor 100
            ->max('secuencia');

        $fase = new FaseEvento();
        $fase->evento_id = $eventoId;
        $fase->nombre_fase = $request['nombre_fase'];
        $fase->descripcion_fase = $request['descripcion_fase'];
        $fase->fechaInicio = $carbonDatetime1->toDateTimeString();
        $fase->secuencia = $secuenciaMaxima + 1;
        $fase->fechaFin = $carbonDatetime2->toDateTimeString();
        $fase->tipo = $request['tipo'];
        $fase->actual = false;

        $fase->save();
        return redirect()->back()->with('status', 'La fase se creó exitosamente');

    }

    public function edit(Request $request, $faseId)
    {
        $fase = FaseEvento::find($faseId);
        $evento = Evento::find($fase->evento_id);
        $todayDate = now('GMT-4')->format('Y-m-d\TH:i');

        if ($fase->tipo == 'Inscripcion') {
            $this->validate($request, [
                'nombre_fase' => ['required', 'min:4', 'regex:/^[\p{L}0-9_ ]+$/u', 'max:50'],
                'descripcion_fase' => 'required',
                new ValidarSuperposicionFechasFases($fase->evento_id, $fase->id),
                'fechaInicio' => [
                    'required',
                    new FechaMayorQue($todayDate),

                ],
                'fechaFin' => [
                    'required',
                    new FechaMayorQue($request['fechaInicio']),
                    new FechaMenorQueTodasLasDemas($fase->evento_id, $request['fechaFin'])
                ],


            ]);

            $datetimeInput1 = $request->input('fechaInicio');

            // Convert the datetime input to a Carbon instance
            $carbonDatetime1 = Carbon::parse($datetimeInput1);

            // Extract date and time
            $fecha = $carbonDatetime1->toDateString(); // Format: Y-m-d
            $hora = $carbonDatetime1->toTimeString(); // Format: H:i:s


            $evento->fecha_inicio = $fecha;
            $evento->tiempo_inicio = $hora;
            $evento->save();
        } else if ($fase->tipo == 'Finalizacion') {
            $this->validate($request, [
                'nombre_fase' => ['required', 'min:4', 'regex:/^[\p{L}0-9_ ]+$/u', 'max:50'],
                'descripcion_fase' => 'required',
                new ValidarSuperposicionFechasFases($fase->evento_id, $fase->id),
                'fechaInicio' => [
                    'required',
                    new FechaMayorQueTodasLasDemas($fase->evento_id, $request['fechaInicio'])
                ],
                'fechaFin' => ['required', new FechaMayorQue($request['fechaInicio'])],


            ]);


            $datetimeInput2 = $request->input('fechaFin');

            // Convert the datetime input to a Carbon instance
            $carbonDatetime2 = Carbon::parse($datetimeInput2);

            // Extract date and time
            $fecha = $carbonDatetime2->toDateString(); // Format: Y-m-d
            $hora = $carbonDatetime2->toTimeString(); // Format: H:i:s


            $evento->fecha_fin = $fecha;
            $evento->tiempo_fin = $hora;
            $evento->save();
        } else {
            $this->validate($request, [
                'nombre_fase' => ['required', 'min:4', 'regex:/^[\p{L}0-9_ ]+$/u', 'max:50'],
                'descripcion_fase' => 'required',
                new ValidarSuperposicionFechasFases($fase->evento_id, $fase->id),
                'fechaInicio' => [
                    'required',
                    new FechaMenorQue($request['fechaFin']),
                    new FechaMinimaFase($fase->evento_id)
                ],
                'fechaFin' => ['required', new FechaMaximaFase($fase->evento_id)],
                'tipo' => 'required',

            ]);
            $fase->tipo = $request['tipo'];
        }

        $datetimeInput3 = $request->input('fechaInicio');


        $carbonDatetime3 = Carbon::parse($datetimeInput3);

        $datetimeInput4 = $request->input('fechaFin');


        $carbonDatetime4 = Carbon::parse($datetimeInput4);


        $fase->nombre_fase = $request['nombre_fase'];
        $fase->descripcion_fase = $request['descripcion_fase'];
        $fase->fechaInicio = $carbonDatetime3->toDateTimeString();
        $fase->fechaFin = $carbonDatetime4->toDateTimeString();


        $fase->save();
        return redirect()->back()->with('status', 'La fase se edito exitosamente');
    }

    public function fasesdeEvento($evento_id)
    {
        $fases = Fase::where('evento_id', 1)->get();
        return view('fase', ['fases' => $fases]);
    }
}
