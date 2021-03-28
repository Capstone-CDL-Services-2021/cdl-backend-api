<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUsers(){
        return User::all();
    }

    public function resetPassword(Request $request){

    }

    public function deleteUser(Request $request){
        DB::table('users')->where('id', '=', $request->input('id'))->delete();
    }

}
