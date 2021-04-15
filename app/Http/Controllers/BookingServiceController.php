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

use App\Http\Requests\BookingServiceRequest;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Class BookingServiceController
 * Handles Booking service requests
 * @package App\Http\Controllers
 */
class BookingServiceController extends Controller
{

    /**
     * Method to create email for booking request of customer
     * @param BookingServiceRequest $request takes in customer name, email, date, service,streetAddress
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response returns Email has been sent if request was successful
     */
    public function bookService(BookingServiceRequest $request)
    {
        try {
            $name = $request->input('name');
            $email = $request->input('email');
            $date = $request->input('date');
            $service = $request->input('service');
            $streetAddress = $request->input('streetAddress');

            Mail::send('Mails.bookService', [
                'name' => $name,
                'email' => $email,
                'date' => $date,
                'service' => $service,
                'streetAddress' => $streetAddress
            ], function (\Illuminate\Mail\Message $message) use ($email) {
                $message->to('CDL-Services@email.com');
                $message->from($email);
                $message->subject('New Booking Request');
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
