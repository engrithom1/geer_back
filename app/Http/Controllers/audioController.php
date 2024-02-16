<?php

namespace App\Http\Controllers;
use App\Models\Audios;
//use App\Models\Notes;
//use App\Models\Videos;
//use App\Models\Students;
//use App\Models\Groups;
use App\Models\User;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class audioController extends Controller
{
    ////get
    public function getAdminAudios(){
        try {
            
            $aaudios = Audios::with('audio_lists')
            ->join('users','users.id','=','audios.created_by')
            ->join('groups','groups.id','=','audios.group_id')
            ->select('groups.name','audios.group_id','audios.title','audios.id AS id','audios.description','users.name AS created_by')
            ->where(['audios.status' => 1])
            ->get();

            $inaudios = Audios::with('audio_lists')
            ->join('users','users.id','=','audios.created_by')
            ->join('groups','groups.id','=','audios.group_id')
            ->select('groups.name','audios.group_id','audios.title','audios.id AS id','audios.description','users.name AS created_by')
            ->where(['audios.status' => 0])
            ->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get Audios',
                'aaudios' => $aaudios,
                'inaudios' => $inaudios
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {

            $response = [
                'success' => false,
                'message' => 'failured to get Audios',
                'errors' => $th
            ];
            return $th;//response()->json($response, 200);
        }
    }

    public function updateAudioPost(Request $request){

        try {
           
            $id = $request->id;
    
            
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'group_id' => $request->group_id,
            ];

            Audios::where('id',$id)->update($data);
           
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
      ////create 
      public function createAudioPost(Request $request){

        try {
            $created_by = auth::user()->id;
            
            Audios::create([
                'title' => $request->title,
                'created_by' => $created_by,
                'description' => $request->description,
                'group_id' => $request->group_id,
            ]);
           
            $response = [
                'success' => true,
                'message' => 'Successful created',
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => 'failured to create news',
                'errors' => $th
            ];
            return response()->json($response, 200);
        }
    }
}
