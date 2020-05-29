<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'USUARIOS_NOMBRE', 'USUARIOS_USUARIO', 'USUARIOS_CONTRASEÑA','USUARIOS_ROL',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Registrar($data)
    {
        $usr=User::create([
            'USUARIOS_NOMBRE'=> $data['Nombre'],
            'USUARIOS_USUARIO' => $data['Usuario'],
            'USUARIOS_CONTRASEÑA' =>Hash::make($data['password']),
            'USUARIOS_ROL' => $data['Rol']
        ]);
        $usr->save();
        return $usr;
    }

    public function Iniciodesesion($data)
    {
        $query=User::where('USUARIOS_USUARIO',$data['Usuario'])->first();
        if (Hash::check($data['password'],$query->USUARIOS_CONTRASEÑA)) {
            $data = array('id' =>$query->USUARIOS_ID ,
                        'Nombre' => $query->USUARIOS_NOMBRE,
                        'Rol' => $query->USUARIOS_ROL);
            return $data;
        }
    }
}
