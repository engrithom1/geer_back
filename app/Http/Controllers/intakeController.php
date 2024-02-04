<?php
namespace App\Http\Controllers;

//use App\Models\StudentEmployment;
//use App\Models\StudentNeeds;
use App\Models\Intakes;
use App\Models\User;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;

class intakeController extends Controller
{
    public function adminGetIntakes(){
        try {
            
            $intakes = Intakes::where(['status'=>1])
            ->select('name','id')
            ->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get intakes',
                'intakes' => $intakes
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

    public function getIntakes(){
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
