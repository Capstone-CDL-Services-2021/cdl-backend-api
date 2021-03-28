<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function addEquipment(EquipmentRequest $request){
        try {
            $equipment = Equipment::create([
                'name' => $request->input('name'),
                'cost' => $request->input('cost'),
                'date rented' => $request->input('dateRented'),
                'date returned' => $request->input('dateReturned'),
                'rented from' => $request->input('rentedFrom'),
            ]);
            return response([
                'message' => 'Equipment added successfully',
                'equipment' => $equipment
            ]);
        }catch(\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function getAllEquipment(){
        return Equipment::all();
    }
}
