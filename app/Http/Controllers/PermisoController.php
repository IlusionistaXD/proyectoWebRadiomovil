<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\Permiso;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Contador;
use Date;
use DB;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permiso::all();
 

        foreach ($permisos as $permiso){
            $id_user= $permiso->id_user;
            $user = User::find($id_user);

            $userName = $user->name;
            $permiso->id_user=$userName;

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
                    'viaje' => 0,
                    'permiso' => 1,
                    'fecha' => $hoystring,
                    ]);
            }else{
                $vectores = Contador::where(\DB::raw("to_char(created_at, 'mm-dd')"),$hoystring)->get();
                foreach ($vectores as $vector){
                    $contador = $vector;
                }
                $contador->permiso =   $contador->permiso + 1;
                $contador->save();
            };

        }
        $tot = $this->totVisitas();
        return view('crudpermiso.index', compact('permisos','tot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();

        foreach($users as $key => $user)
        {
                $rol = $user-> is_admin;
                if($rol != 1){
                    //elimino a los que no son choferes
                    unset($users[$key]);
                }       
        }
        return view('crudpermiso.create', compact('users'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Permiso::create([
            'id_user' => $request['id_user'], 
            'motivo' => $request['motivo'],
            'fec_ini' => $request['fec_ini'],
            'fec_fin' => $request['fec_fin']
        ]);
        return redirect('permisos');
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
        $permiso = Permiso::find($id);
        $users = User::all();

        foreach($users as $key => $user)
        {
                $rol = $user-> is_admin;
                if($rol != 1){
                    //elimino a los que no son choferes
                    unset($users[$key]);
                }       
        }

        return view('crudpermiso.edit', compact('permiso', 'users'));
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
            'motivo' => ['required', 'string', 'max:255'],
            'fec_ini' => ['required', 'date'],
            'fec_fin' => ['required', 'date'],
        ]);
        $permiso = Permiso::find($id);
        $permiso->id_user =  $request->get('id_user');
        $permiso->motivo =  $request->get('motivo');
        $permiso->fec_ini =  $request->get('fec_ini');
        $permiso->fec_fin =  $request->get('fec_fin');
        $permiso->save();
        return redirect('/permisos')->with('success', 'Permiso Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permiso = Permiso::find($id);
        $permiso->delete();
        return redirect('/permisos')->with('success', 'Permiso Eliminado!');
    }

    public function exporpdf(){
        $permisos = Permiso::all();

        foreach ($permisos as $permiso){
            $id_user= $permiso->id_user;
            $user = User::find($id_user);

            $userName = $user->name;
            $permiso->id_user=$userName;

        }
        $pdf = PDF::loadView('pdf.pdfpermiso', compact('permisos'));
        return $pdf->download('permiso-list.pdf');
    }
    public function totVisitas()
    {
        $visitas = Contador::all();
        $res = 0;

        foreach ($visitas as $visita) {
            $valor = $visita->permiso;
            $res = $res + $valor;
        }
        return $res;
    }
}
