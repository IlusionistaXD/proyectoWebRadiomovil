<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Contador;
use Date;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function index()
    {
        $users = User::all();

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
                    'user' => 1,
                    'parada' => 0,
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
                $contador->user =   $contador->user + 1;
                $contador->save();
            };
            $tot = $this->totVisitas();
        return view('cruduser.index', compact('users','tot'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('success', 'Usuario Eliminado!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('cruduser.edit', compact('user'));        
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'fullname' => ['required', 'string', 'max:255'],
            'ci' => ['required', 'string', 'max:255'],
            'address' => ['string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ]);
        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->fullname =  $request->get('fullname');
        $user->ci =  $request->get('ci');
        $user->address =  $request->get('address');
        $user->phone =  $request->get('phone');
        
        $user->save();

        return redirect('/users')->with('success', 'Contacto Actualizado!');
    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('guest');
    }
    */

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'ci' => ['required', 'string', 'max:255'],
            'address' => ['string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'is_admin' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'ci' => $data['ci'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'is_admin' => $data['is_admin'],
        ]);
    }
    public function exporpdf(){
        $users = User::all();

        $pdf = PDF::loadView('pdf.pdfuser', compact('users'));
        return $pdf->download('user-list.pdf');
    }
    
    public function totVisitas()
    {
        $visitas = Contador::all();
        $res = 0;

        foreach ($visitas as $visita) {
            $valor = $visita->user;
            $res = $res + $valor;
        }
        return $res;
    }
}
