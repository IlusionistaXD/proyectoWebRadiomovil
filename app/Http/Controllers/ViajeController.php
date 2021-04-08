<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movil;
use App\Models\Servicio;
use App\Models\Tarifa;
use App\Models\User;
use App\Models\Contador;
use Date;
use DB;

use App\Providers\RouteServiceProvider;
use Cache;

class ViajeController extends Controller
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
                $rol = $viaje-> id_user;
                if($rol != $id_user){
                    //elimino a los que no son choferes
                    unset($viajes[$key]);
                }else{
                    $id_movil= $viaje->id_movil;
                    $id_tarifa= $viaje->id_tarifa;
                    
                    $tarifa = Tarifa::find($id_tarifa);
                    $movil = Movil::find($id_movil);

                    $id_servicio= $tarifa->id_servicio;
                    $servicio = Servicio::find($id_servicio);

                    $movilNameModelo = $movil->modelo;
                    $movilNamePlaca = $movil->placa;

                    $movilName = $movilNameModelo." ".$movilNamePlaca;
                    $tarifaName = $tarifa->name;
                    $tarifaPrecio = $tarifa->precio;
                    $servicioName = $servicio->name;

                    $viaje->id_movil=$movilName;
                    $viaje->id_tarifa=$tarifaName;
                    $viaje->precio=$tarifaPrecio;
                    $viaje->id_servicio=$servicioName;

                }     
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
        return view('crudviaje.index', compact('viajes','tot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_user = Auth::user()->id;

        $user = USER::find($id_user);
        $servicios = Servicio::all();

        return view('crudviaje.confirmservice', compact('user', 'servicios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_user = Auth::user()->id;

        Viaje::create([
            'id_user' => $id_user, 
            'id_tarifa' => $request['id_tarifa'], 
            'id_movil' => $request['id_movil'],
            'terminado' => '0',
            ]);
            return redirect('viajes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       
    }

    /**

     */
    public function edit(Request $request)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id_servicio = $request['id_servicio'];

        $tarifas = Tarifa::all();
        $movils = Movil::all();

        foreach($tarifas as $key => $tarifa)
        {
                $rol = $tarifa-> id_servicio;
                if($rol != $id_servicio){
                    //elimino los servicios que no especifican
                    unset($tarifas[$key]);
                }
        }

        return view('crudviaje.create', compact('tarifas', 'movils'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $viaje = Viaje::find($id);
        $viaje->delete();
        return redirect('viajess')->with('success', 'Viaje Eliminado!');
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

