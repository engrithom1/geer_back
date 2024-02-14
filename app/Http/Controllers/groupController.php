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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class groupController extends Controller
{

      ////status
      public function changeStatus(Request $request){

        try {
            $id = $request->id;
            $status = $request->status;
            
            Groups::where(['id' => $id])->update(['status' => $status]);
            
            $response = [
                'success' => true,
                'message' => 'Successful Changed Status',
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => 'Failured to Change Status',
                'errors' => $th
            ];
            return response()->json($response, 200);
        }
    }

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

      ///get groups
      public function getAllGroups(){
        try {
            
            $groups = Groups::select('id','name')->get();
           
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

    ///get active groups
    public function getAdminGroups(){
        try {
            
            $agroups = DB::table('groups')
            ->join('users','users.id','=','groups.created_by')
            ->select('groups.id','groups.name','groups.description','groups.thumb','groups.status','users.name AS created_by')
            ->where('groups.status',1)
            ->get();

            $ingroups = DB::table('groups')
            ->join('users','users.id','=','groups.created_by')
            ->select('groups.id','groups.name','groups.description','groups.thumb','groups.status','users.name AS created_by')
            ->where('groups.status',0)
            ->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get Groups',
                'agroups' => $agroups,
                'ingroups' => $ingroups
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

    public function createModule(Request $request){

       try {
        $created_by = auth::user()->id;

        $fields = Validator::make($request->all(),[
            'name' => 'required|string',
            'thumb' => 'required|image|mimes:png,jpg,jpeg',
            'description' => 'required|string'
        ]);

        if($fields->fails()){
            $response = [
                'success' => false,
                'message' => 'Enter a correct data',
                'errors' => $fields->errors()
            ];
            return response()->json($response, 200);
        }

        $thumb = null;
        if($image = $request->file('thumb')){

            $destin = 'storage/images/';
            $thumb = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move(public_path($destin),$thumb);
        }

        Groups::create([
            'name' => $request->name,
            'thumb' => $thumb,
            'created_by' => $created_by,
            'description' => $request->description,
        ]);
        
        $response = [
            'success' => true,
            'message' => 'Successful created',
        ];
        return response()->json($response, 200);
       } catch (\Throwable $th) {
        $response = [
            'success' => false,
            'message' => 'failured to create Module',
            'errors' => $th
        ];
        return response()->json($response, 200);
       }

        
    }   
    
    public function updateModule(Request $request){

        try {

            $thumb = $request->og_thumb;
            $og_thumb = $request->og_thumb;
            $id = $request->id;

            if($image = $request->file('thumb')){

                $destin = 'storage/images/';
                $thumb = date('YmdHis').".".$image->getClientOriginalExtension();
                $image->move(public_path($destin),$thumb);

                File::delete($destin.$og_thumb);
            }

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'thumb' => $thumb
            ];

            Groups::where('id',$id)->update($data);
           
            $response = [
                'success' => true,
                'message' => 'Successful Edited',
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => 'Failured to Edit',
                'errors' => $th
            ];
            return $th;//response()->json($response, 200);
        }
    }
}
