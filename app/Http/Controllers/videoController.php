<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class videoController extends Controller
{
    public function getVideos(){
        try {
            
            $intakes = DB::table('intakes')
            ->join('users','users.id','=','intakes.created_by')
            ->select('intakes.name','intakes.description','intakes.status','users.name AS created_by')
            ->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get intakes',
                'dataz' => $intakes
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
