<?php

namespace App;
use Illuminate\Support\Facades\Hash;
use Crypt;
use Illuminate\Database\Eloquent\Model;
use DB;

class cd_usuarios extends Model
{
    public static function Registrar($nombre, $usuario, $password, $rol) {
        $usuarios = DB::table('cd_usuarios')
                        ->insert([
                            'USUARIOS_NOMBRE'=> $nombre,
                            'USUARIOS_USUARIO' => $usuario,
                            'USUARIOS_CONTRASEÑA' => Hash::make($password),
                            'USUARIOS_ROL' => $rol
                        ]);
        return $usuarios;
    }

    public static function Usuarios() {
        $usuario = DB::table('cd_usuarios')
                    ->select('*')
                    ->get();
        return $usuario;
    }

    public static function EliminarUsuario($id_usuario) {
        $usuarios = DB::table('cd_usuarios')
                        ->where('USUARIOS_ID', '=', $id_usuario)
                        ->delete();

        return $usuarios;
    }

    public static function TraerUsuario($id_usuario) {
        $usuarios = DB::table('cd_usuarios')
                    ->where('USUARIOS_ID',$id_usuario)
                    ->get();
        return $usuarios;
    }

    public static function UpdateUser($id, $nombre, $usuario, $password, $rol) {

        if($password == null) {
            $usuarios = DB::table('cd_usuarios')
                        ->where('USUARIOS_ID',$id)
                        ->update([
                            'USUARIOS_NOMBRE'=> $nombre,
                            'USUARIOS_USUARIO' => $usuario,
                            // 'USUARIOS_CONTRASEÑA' => Hash::make($password),
                            'USUARIOS_ROL' => $rol
                        ]);
            return $usuarios;
        }else{

            $usuarios = DB::table('cd_usuarios')
                            ->where('USUARIOS_ID',$id)
                            ->update([
                                'USUARIOS_NOMBRE'=> $nombre,
                                'USUARIOS_USUARIO' => $usuario,
                                'USUARIOS_CONTRASEÑA' => Hash::make($password),
                                'USUARIOS_ROL' => $rol
                            ]);
            return $usuarios;
        }
    }
}
