<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\CLikes;
use App\Models\User;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;

class FCommentController extends Controller
{
    public function likeComment(Request $request){
        
        try {

            $comment_id = $request->comment_id;
            $like_by = auth::user()->id;

            $exist = CLikes::where(['comment_id' => $comment_id, 'like_id' => $like_by])->get();
            $likes = Comments::where(['id' => $comment_id])->get()->first();
            $likes = $likes->likes;

            if(count($exist) === 0){
                CLikes::create([
                    'comment_id' => $comment_id,
                    'like_id' =>  $like_by
                ]);

                Comments::where(['id'=>$comment_id])->update(['likes' => $likes + 1]);
                $response = [
                    'success' => true,
                    'message' => 'Successful like',
                    'like' => 1
                ];
                return response()->json($response, 200);

            }else{
                Comments::where(['id'=>$comment_id])->update(['likes' => $likes - 1]);
                CLikes::where([
                    'comment_id' => $comment_id,
                    'like_id' =>  $like_by
                ])->delete();

                $response = [
                    'success' => true,
                    'message' => 'Successful Dislike',
                    'like' => -1
                ];
                return response()->json($response, 200);
            }

        } catch (\Throwable $th) {
            
            $response = [
                'success' => false,
                'message' => 'failured to get goups',
                'errors' => $th
            ];
            return $th;//response()->json($response, 200);
        }
    }

    public function createComment(Request $request){
        
        try {

            $f_id = $request->forum_id;
            $comment = $request->comment;
            $comment_by = auth::user()->id;

            $com = Comments::create([
                'comment' => $comment,
                'comment_by' => $comment_by,
                'forums_id' => $f_id,
                'likes' => 0
            ]);

            $comment = Comments::join('users','users.id','=','comments.comment_by')
            ->select('comments.comment','comments.created_at','comments.id','comments.likes','users.avatar','users.name AS created_by')
            ->where('comments.id',$com->id)
            ->get()->first();
           
            $response = [
                'success' => true,
                'message' => 'Successful get comments',
                'comment' => $comment
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
    public function forumComments(Request $request){

        try {

            $f_id = $request->forum_id;

            $comments = Comments::orderBy('comments.id','desc')
            ->join('users','users.id','=','comments.comment_by')
            ->select('comments.comment','comments.created_at','comments.id','comments.likes','users.avatar','users.name AS created_by')
            ->where('comments.forums_id',$f_id)
            ->get();
           
            $response = [
                'success' => true,
                'message' => 'Successful get comments',
                'comments' => $comments
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
