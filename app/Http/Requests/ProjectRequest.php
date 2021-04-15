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
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Type_Of_Service' => 'required',
            'Customer_Name' => 'required',
            'Customer_Email' => 'required',
            'Customer_Address' => 'required',
            'Date_Requested' => 'required',
            'Completed' => 'required',
            'total_cost' => 'required',
            'date_completed' => 'required',
            'invoice_paid' => 'required'
        ];
    }
}
