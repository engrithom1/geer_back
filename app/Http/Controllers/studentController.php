<?php

namespace App\Http\Controllers;

use App\Models\StudentEmployment;
use App\Models\StudentNeeds;
use App\Models\StudentProfile;
use App\Models\User;
use App\Models\Students;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;

class studentController extends Controller
{
    public function getStudentDetailed(Request $request){
            $student_id = $request->student_id;
        try {

        $needs = StudentNeeds::where(['student_id' => $student_id])->get()->first();
        $employs = StudentEmployment::where(['student_id' => $student_id])->get()->first();

        $response = [
        'success' => true,
        'message' => "fetched successfuly",
        'needs'  => $needs,
        'employs'  => $employs,
        ];

        return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => "fetched Fail",
                'errors'  => $th,
                ];
        
                return response()->json($response, 200);
        }
    }

    public function studentApprove(Request $request){

        $user_id = $request->user_id;
        $student_id = $request->student_id;
        $intake = $request->intake;
        $group = $request->group;
        
        try {
            $exist = Students::where(['student_id' => $student_id])->get();

            if(count($exist) === 0){
                Students::create([
                    'student_id' => $student_id,
                    'intakes_id' => $intake,
                    'groups_id' => $group,
                    'created_by' => $user_id,
                ]);

                User::where(['id'=>$student_id])->update(['auth_statuses_id'=>5]);
            }
            $response = [
                'success' => true,
                'message' => 'Successful Approve',
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {

            $response = [
                'success' => false,
                'message' => 'failured to Send Data',
                'errors' => $th
            ];
            return response()->json($response, 200);
        }
    }

    public function appliedStudent(){

        try {

         $students = DB::table('users')
        ->join('student_profiles','student_profiles.student_id','=','users.id')
        ->select('users.id','users.name','student_profiles.device','student_profiles.contact','student_profiles.age','student_profiles.college','student_profiles.course','student_profiles.sector','student_profiles.sex','student_profiles.merital','student_profiles.graduate_year','student_profiles.education_level')
        ->where(['users.auth_statuses_id' => 3])
        ->get();

        $response = [
        'success' => true,
        'message' => "fetched successfuly",
        'students'  => $students,
        ];

        return response()->json($response, 200);
        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => "fetched Fail",
                'errors'  => $th,
                ];
        
                return response()->json($response, 200);
        }
    }

    public function getYears(){
         try {
            $years = DB::table('student_profiles')
                     ->orderBy('graduate_year','DESC')
                     ->select('graduate_year')
                     ->distinct()->get();
            $response = [
            'success' => true,
            'message' => "fetched successfuly",
            'years'  => $years,
            ];
    
            return response()->json($response, 200);         

         } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => "fetched Fail",
                'errors'  => $th,
                ];
        
                return response()->json($response, 200);
         }
    }
}
