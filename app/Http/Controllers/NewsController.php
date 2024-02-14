<?php
namespace App\Http\Controllers;


use App\Models\News;
use App\Models\User;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
class NewsController extends Controller
{
        ////update
    public function updateNews(Request $request){

        try {
            $date = $request->expdate;
            $date = explode('-',$date);
            $datenum = $date[0]."".$date[1]."".$date[2];
            $datenum = (int)$datenum;

            $id = $request->id;
    
            
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'expired_date' => $request->expdate,
                'datenum' => $datenum
            ];

            News::where('id',$id)->update($data);
           
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

     ////delete
     public function deleteNews(Request $request){

        try {
            $id = $request->id;
            
            News::where(['id' => $id])->delete();
           
            $response = [
                'success' => true,
                'message' => 'Successful deleted',
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => 'failured to delete news',
                'errors' => $th
            ];
            return $th;//response()->json($response, 200);
        }
    }
    ////create
    public function createNews(Request $request){

        try {
            $date = $request->expdate;
            $date = explode('-',$date);
            $datenum = $date[0]."".$date[1]."".$date[2];
            $datenum = (int)$datenum;

            $created_by = auth::user()->id;
            
            News::create([
                'title' => $request->title,
                'created_by' => $created_by,
                'description' => $request->description,
                'expired_date' => $request->expdate,
                'datenum' => $datenum
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
     ///get active news
    public function getNews(){
        try {

            $today = date("Y").''.date("m").''.date("d");
            $today = (int)$today;
            
            $news = DB::table('news')
            ->join('users','users.id','=','news.created_by')
            ->select('news.title','news.id','news.description','news.expired_date','users.avatar','users.name AS created_by')
            ->where('news.datenum','>=',$today)
            ->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get news',
                'dataz' => $news
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

    public function getExpNews(){
        try {

            $today = date("Y").''.date("m").''.date("d");
            $today = (int)$today;
            
            $news = DB::table('news')
            ->join('users','users.id','=','news.created_by')
            ->select('news.title','news.description','news.id','news.expired_date','users.avatar','users.name AS created_by')
            ->where('news.datenum','<',$today)
            ->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get news',
                'dataz' => $news
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
