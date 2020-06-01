<?php

namespace App;
use Illuminate\Support\Facades\Hash;
use Crypt;
use Illuminate\Database\Eloquent\Model;
use DB;

class cd_proyectos extends Model
{
    //guardar los proyectos
    public static function GuardarProjects($titulo, $descripcion, $imagen) {
            $proyectos = DB::table('cd_proyectos')
                        ->insert([
                            'PROYECTOS_TITULO'=> $titulo,
                            'PROYECTOS_DESCRIPCION' => $descripcion,
                            'PROYECTOS_IMAGEN' => \Storage::url($imagen),
                        ]);
            return $proyectos;
        
    }

    public static function TraerPro() {
        $proyectos = DB::table('cd_proyectos')
                    ->select('*')
                    ->get();
        return $proyectos;
    }

    public static function ActualizarCard($id_card) {
        $proyectos = DB::table('cd_proyectos')
                    ->where('PROYECTOS_ID',$id_card)
                    ->get();
        return $proyectos;
    }

    public static function UpdateCardsImage($id, $imagen, $titulo, $descripcion) {
        
            $proyectos = DB::table('cd_proyectos')
                    ->where('PROYECTOS_ID',$id)
                    ->update([
                            'PROYECTOS_TITULO'=>$titulo,
                            'PROYECTOS_IMAGEN'=>\Storage::url($imagen),
                            'PROYECTOS_DESCRIPCION'=>$descripcion,
                    ]);
        return $proyectos;
        

    }

    public static function UpdateCards($id, $titulo, $descripcion) {
            $proyectos = DB::table('cd_proyectos')
                    ->where('PROYECTOS_ID',$id)
                    ->update([
                            'PROYECTOS_TITULO'=>$titulo,
                            'PROYECTOS_DESCRIPCION'=>$descripcion,
                    ]);
        return $proyectos;


    }
}
