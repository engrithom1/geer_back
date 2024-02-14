<?php

namespace App\Http\Controllers;

//use App\Models\Audios;
use App\Models\Notes;
//use App\Models\Videos;
//use App\Models\Students;
////use App\Models\Groups;
use App\Models\User;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class notesController extends Controller
{
    ////get
    public function getAdminGroups(){
        try {
            
            $abooks = DB::table('notes')
            ->join('users','users.id','=','notes.created_by')
            ->join('groups','groups.id','=','notes.group_id')
            ->select('notes.id','notes.title','notes.note_url','groups.id AS group_id','groups.name','notes.status','users.name AS created_by')
            ->where('notes.status',1)
            ->get();

            $inbooks = DB::table('notes')
            ->join('users','users.id','=','notes.created_by')
            ->join('groups','groups.id','=','notes.group_id')
            ->select('notes.id','notes.title','notes.note_url','groups.id AS group_id','groups.name','notes.status','users.name AS created_by')
            ->where('notes.status',0)
            ->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get Books',
                'abooks' => $abooks,
                'inbooks' => $inbooks
            ];
            return response()->json($response, 200);

        } catch (\Throwable $th) {

            $response = [
                'success' => false,
                'message' => 'failured to get goups',
                'errors' => $th
            ];
            return $th;//response()->json($response, 200);
        }
    }

    ////status
    public function changeStatus(Request $request){

        try {
            $id = $request->id;
            $status = $request->status;
            
            Notes::where(['id' => $id])->update(['status' => $status]);
            
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
    
    ////create
    public function createBook(Request $request){

        try {
         $created_by = auth::user()->id;
 
         $fields = Validator::make($request->all(),[
             'title' => 'required|string',
             'book' => 'required|mimes:pdf',
             'group_id' => 'required'
         ]);
 
         if($fields->fails()){
             $response = [
                 'success' => false,
                 'message' => 'Enter a correct data',
                 'errors' => $fields->errors()
             ];
             return response()->json($response, 200);
         }
 
         $book = null;
         if($pdf = $request->file('book')){
 
             $destin = 'storage/pdf/';
             $book = date('YmdHis').".".$pdf->getClientOriginalExtension();
             $pdf->move(public_path($destin),$book);
         }
 
         Notes::create([
             'title' => $request->title,
             'note_url' => $book,
             'created_by' => $created_by,
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
             'message' => 'Failured to create Module',
             'errors' => $th
         ];
         return response()->json($response, 200);
        }
 
         
     }
     
     public function updateBook(Request $request){

        try {

            $title = $request->title;
            $og_book = $request->og_book;
            $book = $request->og_book;
            $group_id = $request->group_id;
            $id = $request->id;

            if($pdf = $request->file('book')){

                $destin = 'storage/pdf/';
                $book = date('YmdHis').".".$pdf->getClientOriginalExtension();
                $pdf->move(public_path($destin),$book);

                File::delete($destin.$og_book);
            }

            $data = [
                'title' => $title,
                'group_id' => $group_id,
                'note_url' => $book
            ];

            Notes::where('id',$id)->update($data);
           
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

