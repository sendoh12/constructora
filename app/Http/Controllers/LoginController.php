<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\cd_usuarios;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Encryption\DecryptException;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function __construct()
    //  {
    //      $this->middleware('auth');
    //  }

    public function index()
    {
        if(session()->has('admin')==false){
            return view("Login/Login");
        }else{
            return \redirect('principal');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Registro()
    {
        

        if(session()->has('admin')==false){
            return redirect('login');
        }else{
            
            return view("Login/Registro");
            
        }
    }

    public function Registrodelusuario(Request $request)
    {

        
        if(session()->has('admin')==false){
            return redirect('login');
        }else{
            
            if ($request->ajax()) {
                if ($request->input() != null) {
                    if($request->id_usuario != null){
                        return response()->json([
                            'arreglo'=> 1
                        ]);
                        // $propiedades = DB::table('cd_usuarios')
                        //     ->where('USUARIOS_ID',$request->id_usuario)
                        //     ->update(["USUARIOS_NOMBRE" => $request->nombre,
                        //                 "USUARIOS_USUARIO"=> $request->usuario,
                        //                 "USUARIOS_CONTRASEÑA"=>Hash::make($request->password),
                        //                 "USUARIOS_ROL"=>$request->rol,]);
                        // return redirect("principal");
                    }else{
                       $usuarios = cd_usuarios::Registrar($request->nombre,$request->usuario,$request->password,$request->rol);
                       return response()->json([
                        'arreglo'=> 2
                    ]);
                    }
                }
            }
            
        }
    }
    public function show(Request $request)
    {


        
        // return response()->json([
        //     'correo'=> $request->correo,
        //     'contraseña'=> $request->password,
        //     'arreglo'=>$request->input()
        // ]);
        if ($request->ajax()) {
            
            if ($request->input() != null) {
                // $validatedData = $request->validate([
                //     'email' => ['required', 'max:255'],
                //     'password' => ['required'],
                // ]);
                
                $dato = array('usuario' => $request->usuario,
                                'password' => $request->password );
                $data=[];
                $query=DB::table('cd_usuarios')->where('USUARIOS_USUARIO',$dato['usuario'])->first();
                
               if($query != null){

                    $pasword=Hash::check($dato['password'],$query->USUARIOS_CONTRASEÑA);
                    if ($pasword){
                    $data = array('id' =>$query->USUARIOS_ID ,
                            'Nombre' => $query->USUARIOS_NOMBRE,
                            'Rol' => $query->USUARIOS_ROL);
                    // Via a request instance...
                    $request->session()->put('admin',$data );
                    // Via the global helper...
                    session(['admin' => $data]);

                    return response()->json([
                        'arreglo'=> 1
                    ]);
                    
                    // return redirect('principal');
                    }
                }else{
                    return response()->json([
                        'arreglo'=> 2
                    ]);
                } 
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{
            
            $request->session()->forget("admin");
            //Session::flush();
            return redirect('Login');
            
        }
    }
}
