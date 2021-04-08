<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Reporte;
use App\Models\Movil;
use App\Models\User;
use App\Models\Parada;
use App\Models\Promocion;
use App\Models\Tarifa;
use App\Models\Viaje;
use App\Models\Permiso;
use App\Models\Servicio;
use Illuminate\Http\Request;
use App\Models\Contador;
use Date;
use DB;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
                    'reporte' => 1,
                    'movil'  => 0,
                    'servicio' => 0,
                    'tarifa' => 0,
                    'viaje' => 0,
                    'permiso' => 0,
                    'fecha' => $hoystring,
                    ]);
            }else{
                $vectores = Contador::where(\DB::raw("to_char(created_at, 'mm-dd')"),$hoystring)->get();
                foreach ($vectores as $vector){
                    $contador = $vector;
                }
                $contador->reporte =   $contador->reporte + 1;
                $contador->save();
            };
            $tot = $this->totVisitas();
        return view('reportes.confirmreporte', compact('tot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reportes.confirmreporte');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $nomTabla = $request['id_servicio'];
        $users = User::all();
        $movils = Movil::all();
        $paradas = Parada::all();
        $permisos = Permiso::all();
        $promocions = Promocion::all();
        $servicios = Servicio::all();
        $tarifas = Tarifa::all();
        $viajes = Viaje::all();

        if($nomTabla == 0){   //Permisos
            foreach ($permisos as $permiso){
                $id_user= $permiso->id_user;
                $user = User::find($id_user);
    
                $userName = $user->name;
                $permiso->id_user=$userName;
    
            }
        } 
        if($nomTabla == 1){  //usuarios
            //
        }
        if($nomTabla == 2){  //Paradas
            //
        }
        if($nomTabla == 3){  //Movils
            foreach ($movils as $movil){

                $id_parada= $movil->id_parada;
                $id_user= $movil->id_user;
                $user = User::find($id_user);
                $parada = Parada::find($id_parada);
                $report = 'false';
                if ($parada){
                    $paradaName = $parada->name;
                }else{
                    $paradaName = 'No Registrada';
                }

                $userName = $user->name;

                $movil->id_parada=$paradaName;
                $movil->id_user=$userName;
            }
        }
        if($nomTabla == 4){  //Servicios
            //
        }
        if($nomTabla == 5){  //Tarifas
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
        }
        if($nomTabla == 6){  //Promociones
            //
        }

        $id_user = Auth::user()->id;
        if($nomTabla == 7){  //Viajes
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
        }
        $tot = $this->totVisitas();
        return view('reportes.reporte', compact('movils','permisos','users','paradas','servicios','tarifas','promocions','viajes','tot'), compact('nomTabla'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*$movils = Movil::all();

        foreach ($movils as $movil){

            $id_parada= $movil->id_parada;
            $id_user= $movil->id_user;
            $user = User::find($id_user);
            $parada = Parada::find($id_parada);
            $report = 'false';
            if ($parada){
                $paradaName = $parada->name;
            }else{
                $paradaName = 'No Registrada';
            }

            $userName = $user->name;

            $movil->id_parada=$paradaName;
            $movil->id_user=$userName;
        }
        return view('reportes.reporte', compact('movils'));*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function totVisitas()
    {
        $visitas = Contador::all();
        $res = 0;

        foreach ($visitas as $visita) {
            $valor = $visita->reporte;
            $res = $res + $valor;
        }
        return $res;
    }
}
