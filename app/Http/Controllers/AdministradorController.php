<?php

namespace App\Http\Controllers;
use DB;
// use Illuminate\Http\Request;
use App\cd_roles;
use App\cd_usuarios;
use App\cd_proyectos;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Response;
use Illuminate\Http\Request;
// use Request;

class AdministradorController extends Controller
{
    public function registro() {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{
            $roles = cd_roles::getRoles();
            return view('Login.Registro', array(
                'roles'=>$roles
            ));
        }

    }


    public function MostrarAdministradores() {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{
            return view('administrador.principal');
            
        }

    }


    public function TraerAdmins() {
            $roles = cd_roles::getRoles();
            $usuarios = cd_usuarios::Usuarios();
            
            return response()->json([
                    'usuarios'=>$usuarios,
                    'roles'=>$roles
            ]);
    }

    public function TraerUsu(Request $request) {
        $traer_usuarios = cd_usuarios::TraerUsuario($request->id_usuario);
        // var_dump($traer_usuarios[0]->USUARIOS_NOMBRE);
        // die();
        $id = $traer_usuarios[0]->USUARIOS_ID;
        $nombre = $traer_usuarios[0]->USUARIOS_NOMBRE;
        $usuario = $traer_usuarios[0]->USUARIOS_USUARIO;
        $contraseña = $traer_usuarios[0]->USUARIOS_CONTRASEÑA;

        return response()->json([
            'id'=> $id,
            'nombre'=> $nombre,
            'usuario'=> $usuario,
        ]);
    }

    public function EliminarAdmin(Request $request) {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{

            $usuarios = cd_usuarios::EliminarUsuario($request->id_usuario);
            if($usuarios!=null) {
                return response()->json([
                    'arreglo'=> 1
                ]);
            }else{
                return response()->json([
                    'arreglo'=> 0
                ]);
            }
            
        }
    }


    //actualizar los administradores
    public function UpdateUser(Request $request) {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{


            $usuarios = cd_usuarios::UpdateUser($request->id_usuario,$request->nombre,$request->usuario,$request->password,$request->rol);
            if($usuarios!=null) {
                return response()->json([
                    'arreglo'=> 1
                ]);
            }else{
                return response()->json([
                    'arreglo'=> 0
                ]);
            }
            
        }
    }


    //vista para agregar las informacion de proyectos
    public function AgregarInformacion() {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{
            return view('administrador.agregarInformacion');
            
        }
    }

    //ajax para guardar las cards
    public function GuardarDatos(Request $request) {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{

            if($request->hasFile('image')) {
                $file = $request->file('image');
                $name = time().$file->getClientOriginalName();           
                \Storage::disk('public')->put($name,  \File::get($file));
                $proyectos = cd_proyectos::GuardarProjects($request->titulo, $request->descripcion, $name);

                if($proyectos != null) {
                    return response()->json([
                        'arreglo'=> 1
                    ]);
                }else{
                    return response()->json([
                        'arreglo'=> 2
                    ]);
                }
                
            }else{
                return response()->json([
                    'arreglo'=> 2
                ]);
            }
                
            
        }
    }


    //actualizar los proyectos
    public function ProjecActualizar(Request $request) {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{
            $validador=\Validator::make($request->all(),[
                'idCard'=>'required',
                'tituloModal'=>'required',
                'drscrModal'=>'required'
            ]);

            if($request->hasFile('ImagenModal')) {
                $file = $request->file('ImagenModal');
                $name = time().$file->getClientOriginalName();           
                \Storage::disk('public')->put($name,  \File::get($file));
                $proyectos = cd_proyectos::UpdateCardsImage($request->idCard, $name, $request->tituloModal, $request->drscrModal);

                if($proyectos != null) {
                    return response()->json([
                        'arreglo'=> 1
                    ]);
                }else{
                    return response()->json([
                        'arreglo'=> 2
                    ]);
                }
                
            }else{
                $proyectos = cd_proyectos::UpdateCards($request->idCard, $request->tituloModal, $request->drscrModal);

                if($proyectos != null) {
                    return response()->json([
                        'arreglo'=> 1
                    ]);
                }else{
                    return response()->json([
                        'arreglo'=> 2
                    ]);
                }

            }
        }
    }


    public function AgregarImagenes($id_es) {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{
            $id=base64_decode($id_es);
            return view('administrador.agregarImagenes', compact('id'));
            
        }
    }

    
}
