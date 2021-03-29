<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getAllUsers(): Collection {
//        Other method
//        return User::all();

        return  DB::table('users')
            ->where('admin', '=', '0')
            ->get();
    }

    public function updateUserInfo(Request $request){
        DB::table('users')
            ->where('id', '=', $request->input('id'))
            ->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email')
                ]);
    }

    public function resetPassword(Request $request){

    }

    public function deleteUser(Request $request){
//        Other method
//        User::destroy($request->input('id'));

        DB::table('users')
            ->where('id', '=', $request->input('id'))
            ->delete();
        DB::table('users')
            ->truncate();
    }

    public function updateBlocked(Request $request){
        DB::table('users')
            ->where('id', '=', $request->input('id'))
            ->update(['blocked' => '1']);
    }
}
