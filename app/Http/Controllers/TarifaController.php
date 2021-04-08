<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\Tarifa;
use App\Models\Promocion;
use App\Models\Servicio;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Contador;
use Date;
use DB;

class TarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $tarifas = Tarifa::all();

        foreach ($tarifas as $tarifa){
            $id_promocion= $tarifa->id_promocion;
            $id_servicio= $tarifa->id_servicio;
            //$promocion = Promocion::where('id', $id_promocion)->first();
            $servicio = Servicio::find($id_servicio);
            $promocion = Promocion::find($id_promocion);

            if ($promocion){
                $promocionName = $promocion->name;
            }else{
                $promocionName = 'Sin promocion';
            }

            $servicioName = $servicio->name;

            $tarifa->id_promocion=$promocionName;
            $tarifa->id_servicio=$servicioName;
        }

        $hoy = getdate();
        $dia = $hoy['mday'];
        $mes = $hoy['mon'];
        
        if($mes<10){
            $hoystring = '0'.$mes.'-'.$dia;
        }else{
            $hoystring = $mes.'-'.$dia;
        };

        $valor = Contador::where(\DB::raw("to_char(created_at, 'mm-dd')"),$hoystring)->count();
            if($valor==0){
                Contador::create([
                    'user' => 0,
                    'parada' => 0,
                    'promocion' => 0,
                    'estadistica' => 0,
                    'reporte' => 0,
                    'movil'  => 0,
                    'servicio' => 0,
                    'tarifa' => 1,
                    'viaje' => 0,
                    'permiso' => 0,
                    'fecha' => $hoystring,
                    ]);
            }else{
                $vectores = Contador::where(\DB::raw("to_char(created_at, 'mm-dd')"),$hoystring)->get();
                foreach ($vectores as $vector){
                    $contador = $vector;
                }
                $contador->tarifa =   $contador->tarifa + 1;
                $contador->save();
            };
            $tot = $this->totVisitas();
        return view('crudtarifa.index', compact('tarifas','tot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promocions = Promocion::all();
        $servicios = Servicio::all();

        return view('crudtarifa.create', compact('servicios','promocions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tarifa::create([
            'id_promocion' => $request['id_promocion'],
            'id_servicio' => $request['id_servicio'],
            'name' => $request['name'], 
            'tramo' => $request['tramo'],
            'precio' => $request['precio']
        ]);
        return redirect('tarifas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarifa = Tarifa::find($id);

        $promocions = Promocion::all();
        $servicios = Servicio::all();

        return view('crudtarifa.edit', compact('tarifa'), compact('servicios','promocions'));    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tramo' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'integer', 'max:255'],
            'id_promocion' => ['string', 'max:255'],
            'id_servicio' => ['required','string', 'max:255'],
        ]);

        $tarifa= Tarifa::find($id);
        $tarifa->name =  $request->get('name');
        $tarifa->tramo =  $request->get('tramo');
        $tarifa->precio =  $request->get('precio');
        $tarifa->id_promocion =  $request->get('id_promocion');
        $tarifa->id_servicio =  $request->get('id_servicio');
        $tarifa->save();
        return redirect('/tarifas')->with('success', 'Tarifa Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarifa = Tarifa::find($id);
        $tarifa->delete();
        return redirect('/tarifas')->with('success', 'Tarifa Eliminada!');
    }

    public function exporpdf(){

        $tarifas = Tarifa::all();

        foreach ($tarifas as $tarifa){
            $id_promocion= $tarifa->id_promocion;
            $id_servicio= $tarifa->id_servicio;
            $servicio = Servicio::find($id_servicio);
            $promocion = Promocion::find($id_promocion);

            if ($promocion){
                $promocionName = $promocion->name;
            }else{
                $promocionName = 'Sin promocion';
            }

            $servicioName = $servicio->name;

            $tarifa->id_promocion=$promocionName;
            $tarifa->id_servicio=$servicioName;
        }

        $pdf = PDF::loadView('pdf.pdftarifa', compact('tarifas'));
        return $pdf->download('tarifa-list.pdf');
    }
    public function totVisitas()
    {
        $visitas = Contador::all();
        $res = 0;

        foreach ($visitas as $visita) {
            $valor = $visita->tarifa;
            $res = $res + $valor;
        }
        return $res;
    }

    public function indexusu()
    {   
        $tarifas = Tarifa::all();

        foreach ($tarifas as $tarifa){
            $id_promocion= $tarifa->id_promocion;
            $id_servicio= $tarifa->id_servicio;
            //$promocion = Promocion::where('id', $id_promocion)->first();
            $servicio = Servicio::find($id_servicio);
            $promocion = Promocion::find($id_promocion);

            if ($promocion){
                $promocionName = $promocion->name;
            }else{
                $promocionName = 'Sin promocion';
            }

            $servicioName = $servicio->name;

            $tarifa->id_promocion=$promocionName;
            $tarifa->id_servicio=$servicioName;
        }

        $hoy = getdate();
        $dia = $hoy['mday'];
        $mes = $hoy['mon'];
        
        if($mes<10){
            $hoystring = '0'.$mes.'-'.$dia;
        }else{
            $hoystring = $mes.'-'.$dia;
        };

        $valor = Contador::where(\DB::raw("to_char(created_at, 'mm-dd')"),$hoystring)->count();
            if($valor==0){
                Contador::create([
                    'user' => 0,
                    'parada' => 0,
                    'promocion' => 0,
                    'estadistica' => 0,
                    'reporte' => 0,
                    'movil'  => 0,
                    'servicio' => 0,
                    'tarifa' => 1,
                    'viaje' => 0,
                    'permiso' => 0,
                    'fecha' => $hoystring,
                    ]);
            }else{
                $vectores = Contador::where(\DB::raw("to_char(created_at, 'mm-dd')"),$hoystring)->get();
                foreach ($vectores as $vector){
                    $contador = $vector;
                }
                $contador->tarifa =   $contador->tarifa + 1;
                $contador->save();
            };
            $tot = $this->totVisitas();
        return view('crudtarifa.indexusu', compact('tarifas','tot'));
    }
}
