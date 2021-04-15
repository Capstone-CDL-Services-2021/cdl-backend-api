<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceCardRequest;
use App\Models\ServiceCards;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class ServiceCardController
 * Handles the requests for creating,editing, and deleting the service cards
 * @package App\Http\Controllers
 */
class ServiceCardController extends Controller
{

    /**
     * Methodvvvvvvvvvvvvvvvvvvvplpvlvlpvvv
     * @param ServiceCardRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
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
        }catch(Exception $exception){
            return response([
                'message' => $exception->getMessage()
            ],400);
        }
    }

    public function removeServiceCard(Request $request){
            DB::table('service_cards')
                ->where('id', '=', $request->input('cardID'))
                ->delete();
    }

    public function editServiceCard(Request $request){
        DB::table('service_cards')
            ->where('id', '=', $request->input('cardID'))
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'imageUrl' => $request->input('imageUrl')]);
    }
    public function getAllServiceCards(){
        return ServiceCards::all();
    }
}
