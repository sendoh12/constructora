<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class cd_roles extends Model
{
    public static function getRoles() {
        $data = DB::table('cd_roles')
                    ->select('*')
                    ->get();


        return $data;

    }
}
