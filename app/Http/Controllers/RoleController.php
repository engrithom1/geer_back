<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;

class RoleController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try {

            $roles = Role::get();

            $response = [
                'success' => true,
                'message' => 'successful',
                'dataz'   => $roles
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {
            $response = [
                'success' => false,
                'message' => 'failed',
                'errors'   => $th
            ];
            return response()->json($response, 200);
        }
    }
}
