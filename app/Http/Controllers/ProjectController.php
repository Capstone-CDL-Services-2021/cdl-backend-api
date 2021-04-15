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

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Class ProjectController
 * Handles requests for creation,deletion,and editing of projects
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
    /**
     * This method is used to add a new project into our projects table
     * @param ProjectRequest $request takes in the type of service, customer name, customer email
     *      customer address, date requested, if project is completed, the total cost, date completed and if the invoice is paid
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response message that project added successfully if request is valid
     */
    public function addProject(ProjectRequest $request)
    {
        try {
            $project = Project::create([
                'Type_Of_Service' => $request->input('Type_Of_Service'),
                'Customer_Name' => $request->input('Customer_Name'),
                'Customer_Email' => $request->input('Customer_Email'),
                'Customer_Address' => $request->input('Customer_Address'),
                'Date_Requested' => $request->input('Date_Requested'),
                'Completed' => $request->input('Completed'),
                'total_cost' => $request->input('total_cost'),
                'date_completed' => $request->input('date_completed'),
                'invoice_paid' => $request->input('invoice_paid'),

            ]);
            return response([
                'message' => 'Project added successfully',
                'project' => $project
            ]);
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Method is used to retrieve all the projects
     * @return \Illuminate\Support\Collection an array with all the projects sorted by the date requested
     */
    public function getAllProjects()
    {
        return DB::table('projects')
            ->select('*')
            ->orderBy('Date_Requested')
            ->get();
    }

    /**
     * Method is used to delete the selected project
     * @param Request $request takes in the request with the values for the project ID
     */
    public function deleteProject(Request $request)
    {
        DB::table('projects')
            ->where('id', '=', $request->input('id'))
            ->delete();
    }

    /**
     * Method is used to alter the completion status for a project in the database
     * @param Request $request takes in the ID for the project
     * @return int switches completed to 1 in the database
     */
    public function alterComplete(Request $request)
    {
        return DB::table('projects')
            ->where('id', '=', $request->input('id'))
            ->update(['Completed' => 1]);
    }

    /**
     * This method is used to alter the invoice status from payment pending to payment received in our database
     * @param Request $request takes in the request with the ID of the project to be altered
     * @return int changed to 1 for status of invoice paid
     */
    public function alterInvoiceStatus(Request $request)
    {
        return DB::table('projects')
            ->where('id', '=', $request->input('id'))
            ->update(['invoice_paid' => 1]);
    }

    /**
     * Method used to retrieve all the projects in the database where the date they were requested is greater than the current date
     * @return \Illuminate\Support\Collection an array with the upcoming projects from the database
     */
    public function getUpcomingProjects()
    {
        $CurrDate = Carbon::today();
        return DB::table('projects')
            ->select('Type_Of_Service', 'Date_Requested', 'Customer_Address')
            ->where('Date_Requested', '>=', $CurrDate)
            ->orWhere('Completed', '=', 0)
            ->orderBy('Date_Requested')
            ->get();
    }

    /**
     * Method used to print all the projects that match the customer's email
     * @param Request $request takes in the request with the customer email as the value
     * @return \Illuminate\Support\Collection an array with the resulting projects that match the request
     */
    public function printProjects(Request $request)
    {
        return DB::table('projects')
            ->select('*')
            ->orderBy('id')
            ->where('Customer_Email', '=', $request->input('email'))
            ->get();
    }

    /**
     * Method used to send an email with the invoice contents
     * @param Request $request takes in the request with email, invoice_number, customer name to bill to, the service cost
     *      date issued, due date of invoice and the service that was offered
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response a response that the email has been sent if the request was valid
     */
    public function sendInvoice(Request $request)
    {
        try {
            $email = $request->input('email');
            $invoice_num = $request->input('invoice_number');
            $billTo = $request->input('bill_to');
            $service_cost = $request->input('service_cost');
            $issue_date = $request->input('issue_date');
            $service_offered = $request->input('service_offered');
            $due_date = $request->input('due_date');


            Mail::send('Mails.sendInvoice', [
                'invoice_num' => $invoice_num,
                'bill_to' => $billTo,
                'service_cost' => $service_cost,
                'issue_date' => $issue_date,
                'service_offered' => $service_offered,
                'email' => $email,
                'due_date' => $due_date,


            ], function (Message $message) use ($email) {
                $message->to($email);
                $message->subject('CDL Services Invoice');
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
