<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Class ForgotController
 * Handles the forgot and change user password requests
 * @package App\Http\Controllers
 */
class ForgotController extends Controller
{
    /**
     * Method creates a 10digit randomized token that gets inserted into our reset passwords database
     * then sends an email to the user in order to change their password
     * @param ForgotRequest $request takes in the request with the values for the user email
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response with the email being sent and a confirmation message
     */
    public function forgot(ForgotRequest $request)
    {
        $email = $request->input('email');

        if (User::where('email', $email)->doesntExist()) {
            return response([
                'message' => 'User doesn\'t exist'
            ], 404);
        }

        $token = Str::random(10);

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);

            Mail::send('Mails.forgot', ['token' => $token], function (\Illuminate\Mail\Message $message) use ($email) {
                $message->to($email);
                $message->subject('Reset your password');
            });

            return response([
                'message' => 'Check your email'
            ]);
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * This method is used to reset the password of the users and inserting new password into the users database
     * @param ResetRequest $request takes the 10 digit randomized token given to the user in their email
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function reset(ResetRequest $request)
    {
        $token = $request->input('token');

        if (!$passwordResets = DB::table('password_resets')->where('token', $token)->first()) {
            return response([
                'message' => 'Invalid token'
            ], 400);
        }
        /** @var User $user */
        if (!$user = User::where('email', $passwordResets->email)->first()) {
            return response([
                'message' => 'User doesn\'t exist'
            ], 404);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response([
            'message' => 'success'
        ]);
    }
}
