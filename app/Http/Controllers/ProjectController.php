<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
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

    public function getAllProjects()
    {
        return DB::table('projects')
            ->select('*')
            ->orderBy('Date_Requested')
            ->get();
    }

    public function deleteProject(Request $request)
    {
        DB::table('projects')
            ->where('id', '=', $request->input('id'))
            ->delete();
    }

    public function alterComplete(Request $request)
    {
        return DB::table('projects')
            ->where('id', '=', $request->input('id'))
            ->update(['Completed' => 1]);
    }

    public function alterInvoiceStatus(Request $request)
    {
        return DB::table('projects')
            ->where('id', '=', $request->input('id'))
            ->update(['invoice_paid' => 1]);
    }

    public function getUpcomingProjects()
    {
        $CurrDate = Carbon::today();
        return DB::table('projects')
            ->select('Type_Of_Service', 'Date_Requested', 'Customer_Address')
            ->where('Date_Requested', '>=', $CurrDate)
            ->orderBy('Date_Requested')
            ->get();
    }

    public function printProjects(Request $request)
    {
        return DB::table('projects')
            ->select('*')
            ->orderBy('id')
            ->where('Customer_Email', '=', $request->input('email'))
            ->get();
    }

    public function sendInvoice(Request $request){
        try{
            $email = $request->input('email');
            $invoice_num = $request->input('invoice_number');
            $billTo = $request->input('bill_to');
            $service_cost = $request->input('service_cost');
            $issue_date = $request->input('issue_date');
            $service_offered = $request->input('service_offered');
            $due_date = $request->input('due_date');


            Mail::send('Mails.sendInvoice',[
                'invoice_num' => $invoice_num,
                'bill_to' => $billTo,
                'service_cost' => $service_cost,
                'issue_date' => $issue_date,
                'service_offered' => $service_offered,
                'email' => $email,
                'due_date' => $due_date,


            ],function (Message $message) use ($email){
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
