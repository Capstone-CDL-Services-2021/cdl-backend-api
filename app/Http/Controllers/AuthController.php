<?php
/**
 *******************************************
 *                                         *
 * Application: Back-end of CDL_Services  *
 *                                         *
 * Author: Alejandro Pena Canelon          *
 *         Daniel Tran                     *
 *         David Do                        *
 *         Jimmy Lam                       *
 *         Jordan Banh                     *
 *         Justin Serrano                  *
 *                                         *
 * Date: April 16, 2021                    *
 *                                         *
 ******************************************* **/
namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


/**
 * Class AuthController
 * Handles authentication requests
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{

    /**
     * This method is used to authenticate user logging in with their email and password
     * @param Request $request takes in the request from the backend with the values for email and password
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response with message, token and user object
     */
    public function login(Request $request)
    {
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                /** @var User $user */
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;
                return response([
                    'message' => 'success',
                    'token' => $token,
                    'user' => $user
                ]);
            }
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
        return response([
            'message' => 'Invalid username/password'
        ], 401);
    }

    /**
     * Method used to authenticate user
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        return Auth::user();
    }

    /**
     * Method used to register a new user into our database of users
     * @param RegisterRequest $request takes in request from front end with user first name, last name, email and password
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
            return response([
                'message' => 'Registration successful',
                'user' => $user
            ]);

        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
