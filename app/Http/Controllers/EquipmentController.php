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
                'owned' => $request->input('owned'),
                'cost' => $request->input('cost'),
                'date_rented' => $request->input('date_rented'),
                'date_returned' => $request->input('date_returned'),
                'rented_from' => $request->input('rented_from'),
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
