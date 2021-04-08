<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\Parada;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Contador;
use Date;
use DB;

class ParadaController extends Controller
{
    protected $redirectTo = RouteServiceProvider::ADMINHOME;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paradas = Parada::all();

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
                    'parada' => 1,
                    'promocion' => 0,
                    'estadistica' => 0,
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
                $contador->parada =   $contador->parada + 1;
                $contador->save();
            };
            $tot = $this->totVisitas();
        return view('crudparada.index', compact('paradas','tot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        /*return $data['address'];*/
        /*return Parada::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'description' => $data['description'],
        ]);*/
        return view('crudparada.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Parada::create([
        'name' => $request['name'], 
        'address' => $request['address'],
        'description' => $request['description']
        ]);
        return redirect('paradas');
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
        $parada = Parada::find($id);
        return view('crudparada.edit', compact('parada'));
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
            'address' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);
        $parada = Parada::find($id);
        $parada->name =  $request->get('name');
        $parada->address =  $request->get('address');
        $parada->description =  $request->get('description');
        $parada->save();
        return redirect('/paradas')->with('success', 'Parada Actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parada = Parada::find($id);
        $parada->delete();
        return redirect('/paradas')->with('success', 'Parada Eliminada!');
    }

    public function exporpdf(){

        $paradas = Parada::all();
        $pdf = PDF::loadView('pdf.pdfparada', compact('paradas'));
        return $pdf->download('parada-list.pdf');
    }
    public function totVisitas()
    {
        $visitas = Contador::all();
        $res = 0;

        foreach ($visitas as $visita) {
            $valor = $visita->parada;
            $res = $res + $valor;
        }
        return $res;
    }

    public function indexusu()
    {
        $paradas = Parada::all();

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
                    'parada' => 1,
                    'promocion' => 0,
                    'estadistica' => 0,
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
                $contador->parada =   $contador->parada + 1;
                $contador->save();
            };
            $tot = $this->totVisitas();
        return view('crudparada.indexusu', compact('paradas','tot'));
    }
}
