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
     * addServiceCard - This method commits to the database and adds a new service card to the service card table
     * @param ServiceCardRequest $request - The parameters that are received from the front end (Title, Description, and ImageURL)
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response - Returns a response with the service card
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

    /**
     * removeServiceCard - This method performs a commit to the database that deletes from the service card table
     * @param Request $request - The parameters that are received from the front end (cardID)
     */
    public function removeServiceCard(Request $request){
            DB::table('service_cards')
                ->where('id', '=', $request->input('cardID'))
                ->delete();
    }

    /**
     * editServiceCard - This method performs a commit to the database that updates the service card in service card table
     * @param Request $request - The parameters that are received from the front end (cardID, title, description, and imageURL)
     */
    public function editServiceCard(Request $request){
        DB::table('service_cards')
            ->where('id', '=', $request->input('cardID'))
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'imageUrl' => $request->input('imageUrl')]);
    }

    /**
     * getAllServiceCards - This method selects from the service card table to retrieve the service cards
     * @return ServiceCards[]|\Illuminate\Database\Eloquent\Collection - Returns an array with the service cards from the database
     */
    public function getAllServiceCards(){
        return ServiceCards::all();
    }
}
