<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use App\Models\Promocion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Contador;
use Date;
use DB;

class PromocionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promocions = Promocion::all();

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
                    'promocion' => 1,
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
                $contador->promocion =   $contador->promocion + 1;
                $contador->save();
            };
            $tot = $this->totVisitas();
        return view('crudpromocion.index', compact('promocions','tot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crudpromocion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Promocion::create([
            'name' => $request['name'], 
            'description' => $request['description'],
            'fec_ini' => $request['fec_ini'],
            'fec_fin' => $request['fec_fin']
            ]);
            return redirect('promocions');
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
        $promocion = Promocion::find($id);
        return view('crudpromocion.edit', compact('promocion'));
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
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'fec_ini' => ['required', 'date'],
            'fec_fin' => ['required', 'date'],
        ]);
        $promocion = Promocion::find($id);
        $promocion->name =  $request->get('name');
        $promocion->description =  $request->get('description');
        $promocion->fec_ini =  $request->get('fec_ini');
        $promocion->fec_fin =  $request->get('fec_fin');
        $promocion->save();
        return redirect('/promocions')->with('success', 'Promocion Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promocion = Promocion::find($id);
        $promocion->delete();
        return redirect('/promocions')->with('success', 'Promocion Eliminada!');
    }
    /******************************/
    public function exporpdf(){

        $promocions = Promocion::all();

        $pdf = PDF::loadView('pdf.pdfpromocion', compact('promocions'));
        return $pdf->download('promocion-list.pdf');
    }
    public function totVisitas()
    {
        $visitas = Contador::all();
        $res = 0;

        foreach ($visitas as $visita) {
            $valor = $visita->promocion;
            $res = $res + $valor;
        }
        return $res;
    }
}
