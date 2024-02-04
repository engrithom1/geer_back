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
     ///get groups
     public function getNews(){
        try {
            
            $news = DB::table('news')
            ->join('users','users.id','=','news.created_by')
            ->select('news.title','news.description','news.expired_date','users.avatar','users.name AS created_by')
            ->where('news.datenum','<=',20240128)
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
