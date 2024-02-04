<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


use App\Models\Role;
use App\Models\User;
//use DB;

class AuthController extends Controller
{
    //pay road phone, name, password, user_id
    public function register(Request $request){

        $fields = Validator::make($request->all(),[
            'name' => 'required|string',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string'
        ]);

        if($fields->fails()){
            $response = [
                'success' => false,
                'message' => 'Varidation failed',
                'errors' => $fields->errors()
            ];
            return response()->json($response, 200);
    
        }else{

            $my_code = rand(10000,99999);
            $phone = $request['phone'];
            $name = $request['name'];

            $ph = '255'.substr($phone,1);
           
            try {
                $user = User::create([
                    'name' => $name,
                    'phone' => $phone,
                    'password' => bcrypt($request['password']),
                    'auth_statuses_id' => 0,
                    'roles_id' => 1,
                    'avatar' => 'avatar.jpg',
                    'about_me' => 'registered member IMED GEER',
                    'my_code' => $my_code
                ]);

                $data['user'] = $user;
                $data['token'] = $user->createToken('MyApp')->plainTextToken;

                /*$msg = 'Hello '.$name.' use the code :'.$my_code.' to verify your account. IMEDFoundation GEER';
                $resp = [['recipient_id' => $user->id, 'dest_addr' => $ph]];

                $res = $this->sendCode($msg,$resp);

                if($res->code == 100){
                    $response = [
                        'success' => true,
                        'message' => 'successful registered,Receive code SMS Soon',
                        'dataz' => $data
                    ];
                    return response()->json($response, 200);
                }*/

                $response = [
                    'success' => true,
                    'message' => 'successful registered',
                    'dataz' => $data
                ];
                return response()->json($response, 200);

            } catch (\Throwable $th) {
                $response = [
                    'success' => false,
                    'message' => 'failured to register',
                    'errors' => $th
                ];
                return response()->json($response, 200);
                //return $th;
            }
        }

    }
    //pay road only bearer Token
    public function logout(Request $request){

        //$id = $request->id;

        try {

            /*DB::table('personal_access_tokens')
                   ->where('tokenable_id',$id)
                   ->delete();1|qrme6mMsNwPWzJDc8uroXRd5VWEznXqhTzqxsUY2fb42d025*/
            auth()->user()->tokens()->delete();       
            return [
                'success' => true,
                'message' => 'User Logged Out'
            ];
            
        } catch (\Throwable $th) {
            //throw $th;
            return [
                'success' => false,
                'message' => 'Database or server error',
                'errors' => $th
            ];
        }
    }

    //pay road phone, password
    public function login(Request $request){

        try {
            if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password])){
                
                $user = auth::user();
    
                $auth_statuses_id = auth::user()->auth_statuses_id;
                $roles_id= auth::user()->roles_id;
    
                $data['user'] = $user;
                $data['token'] = $user->createToken('MyApp')->plainTextToken;

                    $response = [
                        'success' => true,
                        'message' => 'Student phonenomber not verified',
                        'dataz' => $data,
                        'auth_statuses_id' =>  $auth_statuses_id
                    ];
                    return response()->json($response, 200);  
        
            }else{
                $response = [
                    'success' => false,
                    'message' => "Incorrect Phonenumber or Password",
                ];
    
                return response()->json($response, 200);
            }
        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => 'Database or server error',
                'errors' => $th
            ];

            return response()->json($response, 200);
        }
    }

    //pay road phone, password
    public function reloadUser(Request $request){

        try {
            
            $user_id = $request->user_id;

            $data['user'] = User::where(['id' => $user_id])->first();

            $response = [
                'success' => true,
                'dataz' => $data,
                
            ];
            return response()->json($response, 200);
           
        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => 'Database or server error',
                'errors' => $th
            ];

            return response()->json($response, 200);
        }
    }

    //pay road new_password, current_password, user_id, bearer Token
    public function changePassword(Request $request){

        $new_password = $request->new_password;
        $current_password = $request->current_password;
        $user_id = auth::user()->id;

        $now_password = Auth::user()->password;

        try {
            if(Hash::check($current_password,$now_password)){
            
                $data = [
                    'password'=>bcrypt($request->new_password)
                ];
                User::where(['id'=>$user_id])->update($data);
                $response = [
                    'success' => true,
                    'message' => "Password Changed Successfully.."
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => "Incorrect Current Password"
                ];
                return response()->json($response, 200);
            }
    
        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => "Database or server Error"
            ];
            return response()->json($response, 200);
        }
    }

    ///SEND SMS on register
    public function sendCode($message, $recipient){
        $api_key='958144a52338709f';
        $secret_key = 'ZDc1Nzk5NDg5NjQ3NDkwZmRmYzQzMzZiZTg1YjBlMDE1NjI1YTFhMTEzMTA1ZWQ1YTIzNDU0ODRlOTI2NDY2Nw==';

        $postData = array(
            'source_addr' => 'INFO',
            'encoding'=>0,
            'schedule_time' => '',
            'message' => $message,
            'recipients' => $recipient
        );

        $Url ='https://apisms.beem.africa/v1/send';

        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = json_decode(curl_exec($ch));

        return $response;

    }

    public function verifyPhone(Request $request){

        $my_code = $request->my_code;

        $user_id = auth::user()->id;
        $og_code = Auth::user()->my_code;

        try {
            if($og_code == $my_code){
            
                $data = [
                    'auth_statuses_id'=> 1,
                    'my_code' => 0
                ];
                User::where(['id'=>$user_id])->update($data);

                $response = [
                    'success' => true,
                    'message' => "Succesfull Verified",
                    'dataz' => ['auth_statuses_id' => 1]
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'success' => false,
                    'message' => "Incorrect Code"
                ];
                return response()->json($response, 200);
            }
    
        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => "Database or server Error"
            ];
            return response()->json($response, 200);
        }
    }
  
}
