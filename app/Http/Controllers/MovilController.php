<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movil;
use App\Models\User;
use App\Models\Parada;
use App\Models\Contador;
use App\Providers\RouteServiceProvider;
use Barryvdh\DomPDF\Facade as PDF;
use Cache;
use Date;
use DB;

class MovilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movils = Movil::all();

        foreach ($movils as $movil){

            $id_parada= $movil->id_parada;
            $id_user= $movil->id_user;
            $user = User::find($id_user);
            $parada = Parada::find($id_parada);
            if ($parada){
                $paradaName = $parada->name;
            }else{
                $paradaName = 'No Registrada';
            }

            $userName = $user->name;

            $movil->id_parada=$paradaName;
            $movil->id_user=$userName;
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
                    'movil'  => 1,
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
                $contador->movil =   $contador->movil + 1;
                $contador->save();
            };

            $tot = $this->totVisitas();
        return view('crudmovil.index', compact('movils','tot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $users = User::all();
        $paradas = Parada::all();

        foreach($users as $key => $user)
        {
                $rol = $user-> is_admin;
                if($rol != 1){
                    //elimino a los que no son choferes
                    unset($users[$key]);
                }       
        }
        return view('crudmovil.create', compact('paradas', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Movil::create([
            'id_user' => $request['id_user'], 
            'id_parada' => $request['id_parada'], 
            'placa' => $request['placa'],
            'modelo' => $request['modelo'],
            'anio' => $request['anio'],
            'description' => $request['description']
            ]);
            return redirect('movils');
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
        $movil = Movil::find($id);

        $paradas = Parada::all();
        $users = User::all();

        foreach($users as $key => $user)
        {
                $rol = $user-> is_admin;
                if($rol != 1){
                    //elimino a los que no son choferes
                    unset($users[$key]);
                }       
        }

        return view('crudmovil.edit', compact('movil'), compact('paradas', 'users'));
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
            'id_user' => ['required', 'integer'],
            'id_parada' => ['integer'],
            'placa' => ['required', 'string', 'max:255'],
            'modelo' => ['required', 'string'],
            'anio' => ['required', 'string'],
            'description' => ['string'],
        ]);
        $movil = Movil::find($id);
        $movil->id_user =  $request->get('id_user');
        $movil->id_parada =  $request->get('id_parada');
        $movil->placa =  $request->get('placa');
        $movil->modelo =  $request->get('modelo');
        $movil->anio =  $request->get('anio');
        $movil->description =  $request->get('description');
        $movil->save();
        return redirect('movils')->with('success', 'Movil Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movil = Movil::find($id);
        $movil->delete();
        return redirect('movils')->with('success', 'Movil Eliminado!');
    }


    public function __construct()
    {
       $this->middleware('auth');

    }
    /*################################# */
    public function exporpdf(){
        $movils = Movil::all();

        foreach ($movils as $movil){

            $id_parada= $movil->id_parada;
            $id_user= $movil->id_user;
            $user = User::find($id_user);
            $parada = Parada::find($id_parada);
            if ($parada){
                $paradaName = $parada->name;
            }else{
                $paradaName = 'No Registrada';
            }

            $userName = $user->name;

            $movil->id_parada=$paradaName;
            $movil->id_user=$userName;
        }
        $pdf = PDF::loadView('pdf.pdfmovil', compact('movils'), compact('report'));
        return $pdf->download('movil-list.pdf');
    }
    public function totVisitas()
    {
        $visitas = Contador::all();
        $res = 0;

        foreach ($visitas as $visita) {
            $valor = $visita->movil;
            $res = $res + $valor;
        }
        return $res;
    }

    public function indexusu()
    {
        $movils = Movil::all();

        foreach ($movils as $movil){

            $id_parada= $movil->id_parada;
            $id_user= $movil->id_user;
            $user = User::find($id_user);
            $parada = Parada::find($id_parada);
            if ($parada){
                $paradaName = $parada->name;
            }else{
                $paradaName = 'No Registrada';
            }

            $userName = $user->name;

            $movil->id_parada=$paradaName;
            $movil->id_user=$userName;
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
                    'movil'  => 1,
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
                $contador->movil =   $contador->movil + 1;
                $contador->save();
            };

            $tot = $this->totVisitas();
        return view('crudmovil.indexusu', compact('movils','tot'));
    }
}
