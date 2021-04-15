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

use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class TestimonialController
 * Handles the requests for adding, receiving and toggling testimonials
 * @package App\Http\Controllers
 */
class TestimonialController extends Controller
{
    /**
     * addTestimonial - This method commits to the database and adds a new testimonial to the testimonial table
     * @param TestimonialRequest $request The parameters that are received from the front end (Title, testimonial description, rating and name)
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addTestimonial(TestimonialRequest $request) {
        try {
            $testimonial = Testimonial::create([
                'title' => $request->input('title'),
                'testimonial' => $request->input('testimonial'),
                'rating'=> $request->input('rating'),
                'name' => $request->input('name')
            ]);
            return response([
                'message'=>'Testimonial added successfully',
                'testimonial'=>$testimonial
            ]);
        }catch(\Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],400);
        }
    }

    /**
     * getAllTetimonials - This method selects from the testimonials table to retrieve the testimonials written
     * @return Testimonial[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllTestimonials(){
        return Testimonial::all();
    }

    /**
     * toggleVisibility - This method is used to toggle visibility of the testimonial to users on the testimonials front end page
     * @param Request $request - The paramater received from the front end (testimonial ID)
     */
    public function toggleVisibility(Request $request){
        $toggle = 0;
        if($request->input('toggleID') === 0)
        {
            $toggle = 1;
        }
        DB::table('testimonials')
            ->where('id', '=', $request->input('cardID'))
            ->update(['toggle' => $toggle]);
    }
}
