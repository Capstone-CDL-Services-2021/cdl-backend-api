<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getAllUsers(): \Illuminate\Support\Collection
    {
//        return User::all();
        return  DB::table('users')
            ->where('admin', '=', '0')
            ->get();
    }

    public function updateUserInfo(Request $request){

    }

    public function resetPassword(Request $request){

    }

    public function deleteUser(Request $request){
        DB::table('users')
            ->where('id', '=', $request->input('id'))
            ->delete();
    }

}
