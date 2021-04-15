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

use App\Http\Requests\ContactUsRequest;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

/**
 * Class ContactUsController
 * Handles the "contact us" requests
 * @package App\Http\Controllers
 */
class ContactUsController extends Controller
{

    /**
     * Function to handle the contact us request from the customer and create the email
     * @param ContactUsRequest $request takes in the customers name,email, and question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response email has been sent response if the request is successful
     */
    public function contactUs(ContactUsRequest $request){
        try{
            $name = $request->input('name');
            $email = $request->input('email');
            $question = $request->input('question');

            Mail::send('Mails.contactUs',[
                'name' => $name,
                'question' => $question
            ], function(Message $message) use ($email){
                $message->to('CDL-Services@email.com');
                $message->from($email);
                $message->subject('New Customer Question');
            });
            return response([
                'message' => 'Email sent'
            ]);
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
