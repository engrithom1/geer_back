<?php

namespace App\Http\Controllers;

use App\Models\StudentEmployment;
use App\Models\StudentNeeds;
use App\Models\StudentProfile;
use App\Models\User;
//use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function studentNeeds(Request $request){

        $fields = Validator::make($request->all(),[
            'capacity' => 'required|string',
           
        ]);

        if($fields->fails()){
            $response = [
                'success' => false,
                'message' => 'varidation failed',
                'errors' => $fields->errors()
            ];
            return response()->json($response, 200);
    
        }else{
            $user_id = auth::user()->id;
            try {
                StudentNeeds::create([
                    'capacity' => $request->capacity,
                    'capacity_institution' => $request->capacity_institute,
                    'capacity_type' => $request->capacity_type,
                    'training' => $request->training,
                    'why_training' => $request->why_training,
                    'skill_need' => $request->skill_need,
                    'critical_skills' => $request->critical_skills,
                    'training_time' => $request->training_time,
                    'disability' => $request->disability,
                    'student_id' => $user_id,
                ]);

                User::where(['id'=>$user_id])->update(['auth_statuses_id'=>3]);
                $us =  User::where(['id' => $user_id])->first();

                $response = [
                    'success' => true,
                    'message' => 'Successful Submited',
                    'user' => $us
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
    } 

    public function studentEmployment(Request $request){

        $fields = Validator::make($request->all(),[
            'obstacles' => 'required|string',
            'carrier_path' => 'required|string',
            'engaged' => 'required|string'
        ]);

        if($fields->fails()){
            $response = [
                'success' => false,
                'message' => 'varidation failed',
                'errors' => $fields->errors()
            ];
            return response()->json($response, 200);
    
        }else{
            $user_id = auth::user()->id;
            try {
                StudentEmployment::create([
                    'obstacles' => $request->obstacles,
                    'carrier_path' => $request->carrier_path,
                    'engaged' => $request->engaged,
                    'income' => $request->income,
                    'job_seeker' => $request->job_seeker,
                    'activity' => $request->activity,
                    'enterprise' => $request->enterprise,
                    'enterprise_challenge' => $request->enterprise_challenge,
                    'job_applied' => $request->job_applied,
                    'student_id' => $user_id,
                    'interviews' => $request->interviews
                ]);

                User::where(['id'=>$user_id])->update(['auth_statuses_id'=>2]);

                $us =  User::where(['id' => $user_id])->first();

                $response = [
                    'success' => true,
                    'message' => 'Successful Submited',
                    'user' => $us
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
    }  

    public function studentProfile(Request $request){

        $fields = Validator::make($request->all(),[
            'age' => 'required|string',
            'sex' => 'required|string',
            'device' => 'required|string'
        ]);

        if($fields->fails()){
            $response = [
                'success' => false,
                'message' => 'varidation failed',
                'errors' => $fields->errors()
            ];
            return response()->json($response, 200);
    
        }else{
            $user_id = auth::user()->id;
            try {
                StudentProfile::create([
                    'age' => $request->age,
                    'sex' => $request->sex,
                    'merital' => $request->marital,
                    'education_level' => $request->education_level,
                    'graduate_year' => $request->graduate_year,
                    'college' => $request->college,
                    'sector' => $request->sector,
                    'course' => $request->course,
                    'device' => $request->device,
                    'student_id' => $user_id,
                    'contact' => $request->contact
                ]);

                User::where(['id'=>$user_id])->update(['auth_statuses_id'=>1]);
                $us =  User::where(['id' => $user_id])->first();

                $response = [
                    'success' => true,
                    'message' => 'Successful Submited',
                    'user' => $us
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
    }    
}
