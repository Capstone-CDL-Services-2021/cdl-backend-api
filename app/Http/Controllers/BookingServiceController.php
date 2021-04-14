<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingServiceRequest;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingServiceController extends Controller
{
    public function bookService(BookingServiceRequest $request){
        try{
            $name = $request->input('name');
            $email = $request->input('email');
            $date = $request->input('date');
            $service = $request->input('service');
            $streetAddress = $request->input('streetAddress');

            Mail::send('Mails.bookService',[
                'name' => $name,
                'email' => $email,
                'date' => $date,
                'service' => $service,
                'streetAddress' => $streetAddress
            ], function(\Illuminate\Mail\Message $message) use ($email) {
                $message->to('CDL-Services@email.com');
                $message->from($email);
                $message->subject('New Booking Request');
            });


            return response([
                'message' => 'Email sent'
            ]);
        } catch(\Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],400);
        }
    }
}
