<?php

namespace App\Http\Controllers;


use App\Models\MentorProfile;
use App\Models\User;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;

class mentorController extends Controller
{
    public function getAllMentors(){

        try {

         $amentors = DB::table('users')
        ->join('mentor_profiles','mentor_profiles.mentor_id','=','users.id')
        ->select('users.id','users.name','users.avatar','mentor_profiles.expertise','mentor_profiles.groups','mentor_profiles.contact','mentor_profiles.age','mentor_profiles.time','mentor_profiles.experience','mentor_profiles.mentees','mentor_profiles.sex','mentor_profiles.skills','mentor_profiles.interest','mentor_profiles.education_level')
        ->where(['users.auth_statuses_id' => 5])
        ->get();

        $inmentors = DB::table('users')
        ->join('mentor_profiles','mentor_profiles.mentor_id','=','users.id')
        ->select('users.id','users.name','users.avatar','mentor_profiles.expertise','mentor_profiles.groups','mentor_profiles.contact','mentor_profiles.age','mentor_profiles.time','mentor_profiles.experience','mentor_profiles.mentees','mentor_profiles.sex','mentor_profiles.skills','mentor_profiles.interest','mentor_profiles.education_level')
        ->where(['users.auth_statuses_id' => 4])
        ->get();

        $response = [
        'success' => true,
        'message' => "fetched successfuly",
        'amentors'  => $amentors,
        'inmentors'  => $inmentors,
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

    public function mentorApprove(Request $request){

        $user_id = auth::user()->id;
        $id = $request->id;
        $status = $request->status;
        $groups = $request->groups;

        try {   
           
            if($status == 'inactive'){
                User::where(['id'=>$id])->update(['auth_statuses_id' => 5, 'roles_id' => 2]);
                MentorProfile::where(['mentor_id'=>$id])->update(['user_id' => $user_id, 'groups' => $groups]);
            }else{
                User::where(['id'=>$id])->update(['auth_statuses_id' => 4, 'roles_id' => 2]);
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


}
