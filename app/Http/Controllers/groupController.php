<?php
namespace App\Http\Controllers;

use App\Models\Audios;
use App\Models\Notes;
use App\Models\Videos;
use App\Models\Students;
use App\Models\Groups;
use App\Models\User;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;

class groupController extends Controller
{
        public function adminGetGroups(){
            try {
                
                $groups = Groups::select('name','id')->get();
            
                $response = [
                    'success' => true,
                    'message' => 'Successful get Groups',
                    'groups' => $groups
                ];
                return response()->json($response, 200);

            } catch (\Throwable $th) {

                $response = [
                    'success' => false,
                    'message' => 'failured to get goups',
                    'errors' => $th
                ];
                return response()->json($response, 200);
            }
        }
        /////my groups media pdf, video, audio
        public function groupContents(Request $request){
        
            try {

                $group_id = $request->group_id;
                ///get videos
                $videos = Videos::with('video_lists')
                ->join('users','users.id','=','videos.created_by')
                ->select('videos.title','videos.id AS id','videos.description','videos.thumb','users.name AS created_by')
                ->where(['videos.group_id' => $group_id,'videos.status' => 1])
                ->get();
                //return Videos::with('video_lists')->get();

                $data['videos'] = $videos;

                ///get videos
                $audios = Audios::with('audio_lists')
                ->join('users','users.id','=','audios.created_by')
                ->select('audios.title','audios.id AS id','audios.description','users.name AS created_by')
                ->where(['audios.group_id' => $group_id,'audios.status' => 1])
                ->get();
                //return audios::with('audio_lists')->get();
                $data['audios'] = $audios;

                $notes = DB::table('notes')
                ->join('users','users.id','=','notes.created_by')
                ->select('notes.title','notes.note_url','notes.id AS id','users.name AS created_by')
                ->where(['notes.group_id' => $group_id,'notes.status' => 1])
                ->get();

                $data['notes'] = $notes;
               
                $response = [
                    'success' => true,
                    'message' => 'Successful get Groups',
                    'dataz' => $data
                ];
                return response()->json($response, 200);
    
            } catch (\Throwable $th) {
    
                return $th;
                $response = [
                    'success' => false,
                    'message' => 'failured to get goups',
                    'errors' => $th
                ];
                return response()->json($response, 200);
            }
        }

    /////my groups 
    public function myGroups(){
        
        try {
            $user_id = auth::user()->id;
            $roles_id = auth::user()->roles_id;
    
            
           if($roles_id == 3){

                $groups = DB::table('groups')
                ->join('users','users.id','=','groups.created_by')
                ->select('groups.name','groups.id AS id','groups.description','groups.thumb','groups.status','users.name AS created_by')
                ->get();
           }

           if($roles_id == 1){

            $my_modules = Students::where(['student_id' => $user_id])
                        ->select('groups_id')->first();
            
            $my_modules = explode(',',$my_modules->groups_id);

            $groups = DB::table('groups')
            ->join('users','users.id','=','groups.created_by')
            ->select('groups.name','groups.id AS id','groups.description','groups.thumb','groups.status','users.name AS created_by')
            ->whereIn('groups.id',$my_modules)
            ->where('groups.status',1)
            ->get();
            
            }
           
            $response = [
                'success' => true,
                'message' => 'Successful get Groups',
                'dataz' => $groups
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {

            $response = [
                'success' => false,
                'message' => 'failured to get goups',
                'errors' => $th
            ];
            return response()->json($response, 200);
        }
    }

    ///get groups
    public function getGroups(){
        try {
            
            $groups = DB::table('groups')
            ->join('users','users.id','=','groups.created_by')
            ->select('groups.name','groups.description','groups.thumb','groups.status','users.name AS created_by')
            ->where('groups.status',1)
            ->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get Groups',
                'dataz' => $groups
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {

            $response = [
                'success' => false,
                'message' => 'failured to get goups',
                'errors' => $th
            ];
            return response()->json($response, 200);
        }
    }
}
