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

    public function deleteUser(Request $request){
//        Other method
//        User::destroy($request->input('id'));

        DB::table('users')
            ->where('id', '=', $request->input('id'))
            ->delete();
    }

    public function updateBlocked(Request $request){
        DB::table('users')
            ->where('id', '=', $request->input('id'))
            ->update(['blocked' => '1']);
    }

    public function toggleBlocked(Request $request){
        if($request->input('blocked') === 0)
        {
            DB::table('users')
                ->where('id', '=', $request->input('id'))
                ->update(['blocked' => 1]);
        }
        if($request->input('blocked') === 1)
        {
            DB::table('users')
                ->where('id', '=', $request->input('id'))
                ->update(['blocked' => 0]);
        }
    }
}
