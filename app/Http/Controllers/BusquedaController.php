<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movil;
use App\Models\Servicio;
use App\Models\Tarifa;
use App\Models\User;
use App\Models\Parada;
use App\Models\Promocion;
use App\Models\Permiso;
use App\Models\Viaje;
use Illuminate\Support\Facades\Auth;

use DB;

class BusquedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($dato, $rol)
    {   
        $resultados = [];
        if ($rol==2) {
            $busqueda = "No hay coincidencias";
            $tabla = 'Usuarios';
            $ruta = 'usuarios';
            $cant = User::where('address', 'ILIKE', '%'.$dato.'%')->orWhere('fullname', 'ILIKE', '%'.$dato.'%')->count();
            if ($cant!=0){
                $busqueda = User::where('address', 'ILIKE', '%'.$dato.'%')->orWhere('fullname', 'ILIKE', '%'.$dato.'%')->get();
                $resultados [] = [$ruta, $tabla, $busqueda, $cant];
            };

            $tabla1 = 'Paradas';
            $ruta1 = 'paradass';
            $busqueda1 = "No hay coincidencias";
            $cant1 = Parada::where('address', 'ILIKE', '%'.$dato.'%')->orWhere('name', 'ILIKE', '%'.$dato.'%')->count();
            if ($cant1!=0){
                $busqueda1 = Parada::where('address', 'ILIKE', '%'.$dato.'%')->orWhere('name', 'ILIKE', '%'.$dato.'%')->get();
                $resultados [] = [$ruta1, $tabla1, $busqueda1, $cant1];
            }

            $tabla2 = 'Moviles';
            $ruta2 = 'moviles';
            $busqueda2 = "No hay coincidencias";
            $cant2 = Movil::where('placa', 'ILIKE', '%'.$dato.'%')->orWhere('modelo', 'ILIKE', '%'.$dato.'%')->count();
            if ($cant2!=0){
                $busqueda2 = Movil::where('placa', 'ILIKE', '%'.$dato.'%')->orWhere('modelo', 'ILIKE', '%'.$dato.'%')->get();
                $resultados [] = [$ruta2, $tabla2, $busqueda2, $cant2];
            }

            $tabla3 = 'Servicios';
            $ruta3 = 'servicioss';
            $busqueda3 = "No hay coincidencias";
            $cant3 = Servicio::where('name', 'ILIKE', '%'.$dato.'%')->orWhere('description', 'ILIKE', '%'.$dato.'%')->count();
            if ($cant3!=0){
                $busqueda3 = Servicio::where('name', 'ILIKE', '%'.$dato.'%')->orWhere('description', 'ILIKE', '%'.$dato.'%')->get();
                $resultados [] = [$ruta3, $tabla3, $busqueda3, $cant3];
            }

            $tabla4 = 'Permisos';
            $ruta4 = 'permisoss';
            $busqueda4 = "No hay coincidencias";
            $cant4 = Permiso::where('motivo', 'LIKE', '%'.$dato.'%')->count();
            if ($cant4!=0){
                $busqueda4 = Permiso::where('motivo', 'LIKE', '%'.$dato.'%')->get();
                $resultados [] = [$ruta4, $tabla4, $busqueda4, $cant4];
            }

            $tabla5 = 'Tarifas';
            $ruta5 = 'tarifass';
            $busqueda5 = "No hay coincidencias";
            $cant5 = Tarifa::where('name', 'ILIKE', '%'.$dato.'%')->orWhere('tramo', 'ILIKE', '%'.$dato.'%')->count();
            if ($cant5!=0){
                $busqueda5 = Tarifa::where('name', 'ILIKE', '%'.$dato.'%')->orWhere('tramo', 'ILIKE', '%'.$dato.'%')->get();
                $resultados [] = [$ruta5, $tabla5, $busqueda5, $cant5];
            }

            $tabla6 = 'Promociones';
            $ruta6 = 'promociones';
            $busqueda6 = "No hay coincidencias";
            $cant6 = Promocion::where('name', 'ILIKE', '%'.$dato.'%')->orWhere('description', 'ILIKE', '%'.$dato.'%')->count();
            if ($cant6!=0){
                $busqueda6 = Promocion::where('name', 'ILIKE', '%'.$dato.'%')->orWhere('description', 'ILIKE', '%'.$dato.'%')->get();
                $resultados [] = [$ruta6, $tabla6, $busqueda6, $cant6];
            }

            $object = (object) $resultados;
            return response()
            ->json($object);

        } else {

            $tabla1 = 'Paradas';
            $ruta1 = 'paradasss';
            $busqueda1 = "No hay coincidencias";
            $cant1 = Parada::where('address', 'ILIKE', '%'.$dato.'%')->orWhere('name', 'ILIKE', '%'.$dato.'%')->count();
            if ($cant1!=0){
                $busqueda1 = Parada::where('address', 'ILIKE', '%'.$dato.'%')->orWhere('name', 'ILIKE', '%'.$dato.'%')->get();
                $resultados [] = [$ruta1, $tabla1, $busqueda1, $cant1];
            }

            $tabla2 = 'Moviles';
            $ruta2 = 'moviless';
            $busqueda2 = "No hay coincidencias";
            $cant2 = Movil::where('placa', 'ILIKE', '%'.$dato.'%')->orWhere('modelo', 'ILIKE', '%'.$dato.'%')->count();
            if ($cant2!=0){
                $busqueda2 = Movil::where('placa', 'ILIKE', '%'.$dato.'%')->orWhere('modelo', 'ILIKE', '%'.$dato.'%')->get();
                $resultados [] = [$ruta2, $tabla2, $busqueda2, $cant2];
            }

            $tabla3 = 'Servicios';
            $ruta3 = 'serviciosss';
            $busqueda3 = "No hay coincidencias";
            $cant3 = Servicio::where('name', 'ILIKE', '%'.$dato.'%')->orWhere('description', 'ILIKE', '%'.$dato.'%')->count();
            if ($cant3!=0){
                $busqueda3 = Servicio::where('name', 'ILIKE', '%'.$dato.'%')->orWhere('description', 'ILIKE', '%'.$dato.'%')->get();
                $resultados [] = [$ruta3, $tabla3, $busqueda3, $cant3];
            }

            $tabla5 = 'Tarifas';
            $ruta5 = 'tarifasss';
            $busqueda5 = "No hay coincidencias";
            $cant5 = Tarifa::where('name', 'ILIKE', '%'.$dato.'%')->orWhere('tramo', 'ILIKE', '%'.$dato.'%')->count();
            if ($cant5!=0){
                $busqueda5 = Tarifa::where('name', 'ILIKE', '%'.$dato.'%')->orWhere('tramo', 'ILIKE', '%'.$dato.'%')->get();
                $resultados [] = [$ruta5, $tabla5, $busqueda5, $cant5];
            }


            $object = (object) $resultados;
            return response()
            ->json($object);
        }
 
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);

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
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }
}
