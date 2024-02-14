<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Forums;
use App\Models\User;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
class FurumController extends Controller
{
    public function getActivePost(){
        try {
            
            $forums = Forums::orderBy('forums.views','desc')
            ->join('users','users.id','=','forums.created_by')
            ->select('forums.title','forums.id','forums.thumb','forums.views','forums.description','users.avatar','users.name AS created_by')
            ->where('forums.status',1)
            ->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get forums',
                'dataz' => $forums
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

    public function getInactivePost(){
        try {
            
            $forums = Forums::orderBy('forums.views','desc')
            ->join('users','users.id','=','forums.created_by')
            ->select('forums.title','forums.id','forums.thumb','forums.views','forums.description','users.avatar','users.name AS created_by')
            ->where('forums.status',0)
            ->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get forums',
                'dataz' => $forums
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

    public function getTopPost(){
        try {
            
            $forums = Forums::orderBy('forums.views','desc')
            ->join('users','users.id','=','forums.created_by')
            ->select('forums.title','forums.thumb','forums.views','forums.description','users.avatar','users.name AS created_by')
            ->where('forums.status',1)
            ->limit(5)->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get forums',
                'dataz' => $forums
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
    public function getForumPost(){
        try {
            
            $other_post = Forums::orderBy('forums.id','desc')
            ->join('users','users.id','=','forums.created_by')
            ->select('forums.title','forums.id','forums.created_at','forums.thumb','forums.views','forums.description','users.avatar','users.name AS created_by')
            ->where('forums.status',1)
            ->limit(50)->withCount('comments')->get();

            $top_post = Forums::orderBy('forums.views','desc')
            ->join('users','users.id','=','forums.created_by')
            ->select('forums.title','forums.id','forums.created_at','forums.thumb','forums.views','forums.description','users.avatar','users.name AS created_by')
            ->where('forums.status',1)
            ->limit(5)->withCount('comments')->get();

            $data['top_post'] = $top_post;
            $data['other_post'] = $other_post;
           
            $response = [
                'success' => true,
                'message' => 'Successful get forums',
                'dataz' => $data
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

    ////status
    public function changeStatus(Request $request){

        try {
            $id = $request->id;
            $status = $request->status;
            
            Forums::where(['id' => $id])->update(['status' => $status]);
            
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
            return $th;//response()->json($response, 200);
        }
    }
     ////status
     public function updateForum(Request $request){

        try {

            $id = $request->id;
            $title = $request->title;
            $description = $request->description;
            
            Forums::where(['id' => $id])->update(['title' => $title, 'description' => $description]);
            
            $response = [
                'success' => true,
                'message' => 'Successful Updated',
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => 'Failured to Update',
                'errors' => $th
            ];
            return $th;//response()->json($response, 200);
        }
    }
    ////create
    public function createForum(Request $request){

        try {

            $created_by = auth::user()->id;
            
            Forums::create([
                'title' => $request->title,
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
                'message' => 'failured to create Forums',
                'errors' => $th
            ];
            return response()->json($response, 200);
        }
    }
}
