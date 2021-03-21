<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceCardRequest;
use App\Models\ServiceCards;
use Illuminate\Http\Request;

class ServiceCardController extends Controller
{
    public function addServiceCard(ServiceCardRequest $request){
        try {
            $serviceCard = ServiceCards::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'imageUrl' => $request->input('imageUrl')
            ]);
            return response([
                'message' => 'Service card added successfully',
                'serviceCard' => $serviceCard
            ]);
        }catch(\Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],400);
        }
    }

    public function removeServiceCard($id){
        try {
            $serviceCard = ServiceCards::find($id);
            $serviceCard->delete();
            return response([
                'message' => 'Service card Successfully Deleted'
            ]);
        }catch(\Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],400);
        }
    }

    public function getAllServiceCards(){
        return ServiceCards::all();
    }


}
