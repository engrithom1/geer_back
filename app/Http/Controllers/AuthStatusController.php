<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\User;

class AuthStatusController extends Controller
{
    ///code , bearer Token
    public function verifyPhone(Request $request){

        $user_id = auth::user()->id;
        $auth_statuses_id = auth::user()->auth_statuses_id;
        $my_code = auth::user()->my_code;

        $code = $request->code;

        if($auth_statuses_id == 0){

            if ($code == $my_code) {
                
                $data = ['my_code' => 0];
                User::where(['id'=>$user_id])->update($data);
            }

        }else{
            $response = [
                'success' => true,
                'message' => 'Phone number aready Verified',
                'dataz' => [],
                'auth_statuses_id' => $auth_statuses_id
            ];
            return response()->json($response, 200);
        }

    }
}
