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
                            'PROYECTOS_IMAGEN' => \Storage::url($imagen)
                        ]);
            return $proyectos;
        
    }

    public static function TraerPro() {
        $proyectos = DB::table('cd_proyectos')
                    ->select('*')
                    ->get();
        return $proyectos;
    }
}
