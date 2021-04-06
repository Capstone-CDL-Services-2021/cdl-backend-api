<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
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

    public function getAllTestimonials(){
        return Testimonial::all();
    }
}
