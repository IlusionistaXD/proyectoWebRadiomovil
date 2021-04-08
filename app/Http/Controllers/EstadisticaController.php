<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Viaje;
use App\Models\Tarifa;
use App\Models\Servicio;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use DatePeriod;
use App\Models\Contador;
use Date;
use DB;

class EstadisticaController extends Controller
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
                    'estadistica' => 1,
                    'reporte' => 0,
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
                $contador->estadistica =   $contador->estadistica + 1;
                $contador->save();
            };
            $tot = $this->totVisitas();
        return view('estadisticas.confirmestadistica', compact('tot'));
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
        $fec_ini = $request['fec_ini'];
        $fec_fin = $request['fec_fin'];

        $begin = new DateTime( $fec_ini );
        $end = new DateTime( $fec_fin  );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        $rangoDias = [];
        $valores = [];

        

        $option = $request['id_servicio'];
        switch ($option) {
            case 0:
                foreach($daterange as $date){
                    $temp = $date->format("m-d");
                    $valor = User::where(\DB::raw("to_char(created_at, 'mm-dd')"),$temp)->count();
                    $rangoDias [] = $temp;
                    $valores [] = $valor;   
                }
                return view('estadisticas.user_date')->with('rangoDias',json_encode($rangoDias))->with('valores',json_encode($valores,JSON_NUMERIC_CHECK));
                break;
            case 1:
                foreach($daterange as $date){
                    $temp = $date->format("m-d");
                    $valor = Viaje::where(\DB::raw("to_char(created_at, 'mm-dd')"),$temp)->count();
                    $rangoDias [] = $temp;
                    $valores [] = $valor;   
                }
                return view('estadisticas.viaje_date')->with('rangoDias',json_encode($rangoDias))->with('valores',json_encode($valores,JSON_NUMERIC_CHECK));
                break;
            case 2:
                $sumaxdia = 0;
                foreach($daterange as $date){
                    
                    $temp = $date->format("m-d");
                    $rangoDias[]=$temp;
                    $viajes = Viaje::where(\DB::raw("to_char(created_at, 'mm-dd')"),$temp)->get();
                    $sumaxdia = 0;
                    foreach($viajes as $viaje){
                        $id_tarifa = $viaje ->id_tarifa;

                        $tarifa = Tarifa::find($id_tarifa);
                        $precio = $tarifa->precio;
                        $sumaxdia = $sumaxdia + $precio;
                    }
                    $valores[]=$sumaxdia;
                }           
                return view('estadisticas.precio_date')->with('rangoDias',json_encode($rangoDias))->with('valores',json_encode($valores,JSON_NUMERIC_CHECK));
                break;

            case 3:
                $servicios = Servicio::all();
                $sumaxservicio = 0;
                foreach($servicios as $servicio){
                    $servicioName = $servicio->name;
                    $servicioID = $servicio->id;
                    $rangoDias[] = $servicioName;
    
                    $sumaxservicio = 0;
                    $tarifas = Tarifa::all();
                    foreach($tarifas as $tarifa){
                        $tarifaPrecio = $tarifa->precio;
                        $tarifaID_servicio = $tarifa->id_servicio;

                        if ($servicioID==$tarifaID_servicio){
                            $sumaxservicio = $sumaxservicio + $tarifaPrecio;
                        };
                    };
                    $valores[]=$sumaxservicio;
                }

                return view('estadisticas.precio_servicio')->with('rangoDias',json_encode($rangoDias))->with('valores',json_encode($valores,JSON_NUMERIC_CHECK));
                break;
        };
                ///Codigo de pruebas anteriores
                /////////////////////////////////////////
                /*
                    //$valor = Viaje::where(\DB::raw("to_char(created_at, 'dd')"),'25')->count();
                //echo ($valor);
                foreach($daterange as $date){
                    //echo $date->format("Y-m-d");
                    echo ('Day:');
                    $temp = $date->format("m-d");
                    echo ($temp);
                    echo (' ->');
                    $valor = Viaje::where(\DB::raw("to_char(created_at, 'mm-dd')"),$temp)->count();
                    echo ($valor);
                    echo (' - ');
                    $rangoDias [] = $temp;
                    $valores [] = $valor;   
                    /*
                    $temp = $date->format("d");
                    $int = (int)$temp;
                    echo (gettype($int));
                    echo ($int);     
                }
                //echo ('Entro a la opcion 2');
                return view('estadisticas.precio_date')->with('rangoDias',json_encode($rangoDias))->with('valores',json_encode($valores,JSON_NUMERIC_CHECK));
                */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $year = ['22','23','24','25','26','27'];
        $users = User::all();
        $user = [];
        foreach ($year as $key => $value) {
            $user[] = User::where(\DB::raw("to_char(created_at, 'dd')"),$value)->count();
        }
        //$user[] = User::where(\DB::raw("DATE_FORMAT(created_at, '%Y')"),'2021')->count();
        //print_r(count($user));

        /*foreach ($user as $key => $v) {
            echo gettype($v);
        }*/

    	//return view('/estadistica')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('users',json_encode($users,JSON_NUMERIC_CHECK));
        return view('/estadistica')->with('year',json_encode($year,JSON_NUMERIC_CHECK))->with('user',json_encode($user,JSON_NUMERIC_CHECK));
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
        //
    }

    public function totVisitas()
    {
        $visitas = Contador::all();
        $res = 0;

        foreach ($visitas as $visita) {
            $valor = $visita->estadistica;
            $res = $res + $valor;
        }
        return $res;
    }
}
