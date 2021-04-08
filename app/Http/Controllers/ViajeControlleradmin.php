<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Movil;
use App\Models\Servicio;
use App\Models\Tarifa;
use App\Models\User;
use App\Models\Contador;
use Date;
use DB;

class ViajeControlleradmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $viajes = Viaje::all();
        $id_user = Auth::user()->id;

        foreach($viajes as $key => $viaje)
        {
                    $id_movil= $viaje->id_movil;
                    $id_tarifa= $viaje->id_tarifa;
                    $id_user= $viaje->id_user;
            
                    $tarifa = Tarifa::find($id_tarifa);
                    $movil = Movil::find($id_movil);
                    $user = User::find($id_user);

                    $id_servicio= $tarifa->id_servicio;
                    $servicio = Servicio::find($id_servicio);

                    $movilNameModelo = $movil->modelo;
                    $movilNamePlaca = $movil->placa;

                    $movilName = $movilNameModelo." ".$movilNamePlaca;
                    $tarifaName = $tarifa->name;
                    $tarifaPrecio = $tarifa->precio;
                    $userName = $user->name;
                    $servicioName = $servicio->name;
                    
                    $viaje->id_user=$userName;
                    $viaje->id_movil=$movilName;
                    $viaje->id_tarifa=$tarifaName;
                    $viaje->precio=$tarifaPrecio;
                    $viaje->id_servicio=$servicioName;
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
                    'tarifa' => 0,
                    'viaje' => 1,
                    'permiso' => 0,
                    'fecha' => $hoystring,
                    ]);
            }else{
                $vectores = Contador::where(\DB::raw("to_char(created_at, 'mm-dd')"),$hoystring)->get();
                foreach ($vectores as $vector){
                    $contador = $vector;
                }
                $contador->viaje =   $contador->viaje + 1;
                $contador->save();
            };
            $tot = $this->totVisitas();
        return view('crudviajeAdmin.index', compact('viajes','tot'));
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
        $viaje = Viaje::find($id);
        print($id);
        $viaje->terminado =  1;
        $viaje->save();
        return redirect('viajesadmin')->with('success', 'Viaje Finalizado');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $viaje = Viaje::find($id);
        $viaje->delete();
        return redirect('viajesadmin')->with('success', 'Viaje Eliminado!');
    }
    /******************************** */
    public function exporpdf(){

        $viajes = Viaje::all();
        $id_user = Auth::user()->id;

        foreach($viajes as $key => $viaje)
        {
                    $id_movil= $viaje->id_movil;
                    $id_tarifa= $viaje->id_tarifa;
                    $id_user= $viaje->id_user;
            
                    $tarifa = Tarifa::find($id_tarifa);
                    $movil = Movil::find($id_movil);
                    $user = User::find($id_user);

                    $id_servicio= $tarifa->id_servicio;
                    $servicio = Servicio::find($id_servicio);

                    $movilNameModelo = $movil->modelo;
                    $movilNamePlaca = $movil->placa;

                    $movilName = $movilNameModelo." ".$movilNamePlaca;
                    $tarifaName = $tarifa->name;
                    $tarifaPrecio = $tarifa->precio;
                    $userName = $user->name;
                    $servicioName = $servicio->name;
                    
                    $viaje->id_user=$userName;
                    $viaje->id_movil=$movilName;
                    $viaje->id_tarifa=$tarifaName;
                    $viaje->precio=$tarifaPrecio;
                    $viaje->id_servicio=$servicioName;
        }

        $pdf = PDF::loadView('pdf.pdfviaje', compact('viajes'));
        return $pdf->download('viaje-list.pdf');
    }
    public function totVisitas()
    {
        $visitas = Contador::all();
        $res = 0;

        foreach ($visitas as $visita) {
            $valor = $visita->viaje;
            $res = $res + $valor;
        }
        return $res;
    }
}
