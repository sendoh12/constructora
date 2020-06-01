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
// use Illuminate\Http\Request;
use Request;

class AdministradorVuejs extends Controller
{
    // funcion para mostrar los proyectos
    public function MostrarPro() {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{
            $proyectos = cd_proyectos::TraerPro();

            if($proyectos != null) {
                
                return response()->json($proyectos);
            }
        }
    }


    //function para actualizar las cards de los proyectos
    public function ActualizarCards(Request $request) {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{
            $proyectos = cd_proyectos::ActualizarCard(Request::get('id_cards'));
            if($proyectos != null) {
                return response()->json($proyectos);
            }
        }
    }

    public function ActualizarProjects(Request $request) {
        if(session()->has('admin')==false){
            return redirect('Login');
        }else{

            $validador=\Validator::make(Request::all(),[
                'idCard'=>'required',
                'tituloModal'=>'required',
                'drscrModal'=>'required'
            ]);

                $idCard = Request::get('idCard');
                $ImagenModal = Request::get('ImagenModal');
                $tituloModal = Request::get('tituloModal');
                $drscrModal = Request::get('drscrModal');

                $file = $request->file('ImagenModal');
                $name = time().$file->getClientOriginalName();           
                \Storage::disk('public')->put($name,  \File::get($file));

                $proyectos = cd_proyectos::UpdateCards($idCard, $name, $tituloModal, $drscrModal);
                var_dump($proyectos);

                if($proyectos != null) {
                    
                    return response()->json([
                        'arreglo'=> 1
                    ]);
                    
                }
            
        }
    }
}
