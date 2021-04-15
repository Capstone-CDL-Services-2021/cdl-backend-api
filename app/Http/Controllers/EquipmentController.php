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

use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class EquipmentController
 * Handles requests for editing equipment and adding equipment
 * @package App\Http\Controllers
 */
class EquipmentController extends Controller
{

    /**
     * Function that creates a new equipment and adds it to the equipment table in the database
     * @param EquipmentRequest $request takes in the name of the equipment, if it is owned, the cost, date_rented, date_returned, rented_from
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response with message equipment has been successfully added if the request is valid
     */
    public function addEquipment(EquipmentRequest $request)
    {
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
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * This method deletes an equipment from the equipments table in the database
     * @param Request $request takes in the ID of the equipment that has to be deleted in the table
     */
    public function deleteEquipment(Request $request)
    {
        DB::table('equipment')
            ->where('id', '=', $request->input('id'))
            ->delete();
    }

    /**
     * Method to retrieve all the equipment in the equipments table from the database
     * @return Equipment[]|\Illuminate\Database\Eloquent\Collection an array with every equipment
     */
    public function getAllEquipment()
    {
        return Equipment::all();
    }
}
