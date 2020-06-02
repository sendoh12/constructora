<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class cd_imgene extends Model
{
    protected $table="cd_imgenes";

    public function Agregarimagenes($nombre,$key,$idproyecto)
    {
        $imgen = DB::table('cd_imgenes')
                        ->insert([
                            'NOMBRE_IMG'=> $nombre,
                            'IMG' => \Storage::url($nombre),
                            'ORDEN'=>$key+1,
                            'ID_PRO_IMG'=>$idproyecto
                        ]);
            return $imgen;
    }

    public function mostrar($id)
    {
        $data = DB::table('cd_imgenes')
                    ->select('NOMBRE_IMG','IMG')
                    ->where('ID_PRO_IMG',$id)
                    ->orderBy('ORDEN','asc')
                    ->get();
        return $data;
    }
    
}
