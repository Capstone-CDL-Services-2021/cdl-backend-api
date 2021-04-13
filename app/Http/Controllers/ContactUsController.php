<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
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
