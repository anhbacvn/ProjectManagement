<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;


class getavatar{
    public function GetAvatar($id){
        $get_info_user = DB::table('users')->where('id', $id)->first();
        return $get_info_user->avatar;
    }
}
    

