<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class UserController
 * Handles requests for creation,deletion,and editing of users
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * This method grabs all the users in the "users" table from the database
     * except for admin
     *
     * @return Collection
     * array of all the column values for the users
     */
    public function getAllUsers(): Collection {
        return  DB::table('users')
            ->where('admin', '=', '0')
            ->get();
    }

    /**
     * This method updates a specific user based on the id
     * and changes the first name, last name and email
     * into the users table from the database
     *
     * @param Request $request takes in the id, first name, last name, email
     */
    public function updateUserInfo(Request $request){
        DB::table('users')
            ->where('id', '=', $request->input('id'))
            ->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email')
            ]);
    }

    /**
     * This method deletes a specific user based on the id
     * and removes the row in the users table from the database
     *
     * @param Request $request takes in id
     */
    public function deleteUser(Request $request){
        DB::table('users')
            ->where('id', '=', $request->input('id'))
            ->delete();
    }

    /**
     * This method blocks/unblocks a specific user based on the id
     * and updates the blocked column in the users table from the database.
     * If blocked column value of the user is 1 -> set to 0 (unblock)
     * otherwise set to 1 (block)
     *
     * @param Request $request takes in id
     */

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
