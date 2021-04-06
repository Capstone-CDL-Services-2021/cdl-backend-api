<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function addProject(ProjectRequest $request){
        try {
            $project = Project::create([
                'Type_Of_Service'=> $request->input('Type_Of_Service'),
                'Customer_Name'=> $request->input('Customer_Name'),
                'Customer_Email'=> $request->input('Customer_Email'),
                'Customer_Address'=> $request->input('Customer_Address'),
                'Date_Requested'=> $request->input('Date_Requested'),
                'Completed'=> $request->input('Completed'),
            ]);
            return response([
                'message' => 'Project added successfully',
                'project' => $project
            ]);
        }catch(\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function getAllProjects(){
        return DB::table('projects')
            ->select('*')
            ->orderBy('Date_Requested')
            ->get();
    }

    public function deleteProject(Request $request){
        DB::table('projects')
            ->where('id', '=', $request->input('id'))
            ->delete();
    }

    public function alterComplete(Request $request) {
        return DB::table('projects')
            ->where('id', '=', $request->input('id'))
            ->update(['Completed' => 1]);
    }
    public function getUpcomingProjects(){
        $CurrDate = Carbon::today();
        return DB::table('projects')
            ->select('Type_Of_Service','Date_Requested', 'Customer_Address')
            ->where('Date_Requested','>=',$CurrDate)
            ->orderBy('Date_Requested')
            ->get();
    }
}
