<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FCommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\studentController;
use App\Http\Controllers\groupController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FurumController;
use App\Http\Controllers\notesController;
use App\Http\Controllers\intakeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
| 
*/

//clear catch
Route::get('/clear', function() {
//Artisan::call('storage:link');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
 
    return "Cleared!";
 
});
/////ADMIN URL
Route::get('/admin-get-groups',[groupController::class,'adminGetGroups']);
Route::get('/admin-get-intakes',[intakeController::class,'adminGetIntakes']);
Route::post('/admin-student-details',[studentController::class,'getStudentDetailed']);

//register
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
///roles
Route::get('/roles',[RoleController::class,'index']);

Route::post('/reload',[AuthController::class,'reloadUser']);
/////students 
Route::get('/applied-students',[studentController::class,'appliedStudent']);
Route::get('/get-years',[studentController::class,'getYears']);
Route::post('/student-approve',[studentController::class,'studentApprove']);

////groups getAllGroups
Route::get('/get-groups',[groupController::class,'getGroups']);
Route::get('/get-all-groups',[groupController::class,'getAllGroups']);
Route::get('/get-admin-groups',[groupController::class,'getAdminGroups']);
////news 
Route::get('/get-news',[NewsController::class,'getNews']);
Route::get('/get-exp-news',[NewsController::class,'getExpNews']);


////forum
Route::get('/get-top-post',[FurumController::class,'getTopPost']);
Route::get('/get-forum-post',[FurumController::class,'getForumPost']);
Route::get('/get-active-post',[FurumController::class,'getActivePost']);
Route::get('/get-inactive-post',[FurumController::class,'getInactivePost']);
////groups
Route::get('/get-intakes',[intakeController::class,'getIntakes']);

/////notes aka books
Route::get('/get-admin-books',[notesController::class,'getAdminGroups']);

////router secured
Route::group(['middleware' => ['auth:sanctum']], function () {
    ////Auth issues
    
    Route::post('/verify',[AuthController::class,'verifyPhone']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/change-password',[AuthController::class,'changePassword']);
    
    Route::post('/my-groups',[groupController::class,'myGroups']);
    Route::post('/group-contents',[groupController::class,'groupContents']);
    Route::post('/module-status',[groupController::class,'changeStatus']);
    Route::post('/create-module',[groupController::class,'createModule']);
    Route::post('/update-module',[groupController::class,'updateModule']);

    //////bookssss updateBook
    Route::post('/book-status',[notesController::class,'changeStatus']);
    Route::post('/create-book',[notesController::class,'createBook']);
    Route::post('/update-book',[notesController::class,'updateBook']);

    //comment forums 
    Route::get('/get-top-post',[FurumController::class,'getTopPost']);
    Route::get('/get-forum-post',[FurumController::class,'getForumPost']);
    Route::post('/create-forum',[FurumController::class,'createForum']);
    Route::post('/forum-status',[FurumController::class,'changeStatus']);
    Route::post('/update-forum',[FurumController::class,'updateForum']);
    
    Route::post('/like-comment',[FCommentController::class,'likeComment']);
    Route::post('/create-comment',[FCommentController::class,'createComment']);
    Route::post('/get-comments',[FCommentController::class,'forumComments']);
    ////news
    Route::post('/create-news',[NewsController::class,'createNews']);
    Route::post('/delete-news',[NewsController::class,'deleteNews']);
    Route::post('/update-news',[NewsController::class,'updateNews']);

    ///student form
    Route::post('/student-needs-form',[FormController::class,'studentNeeds']);
    Route::post('/student-profile-form',[FormController::class,'studentProfile']);
    Route::post('/student-employment-form',[FormController::class,'studentEmployment']);



});

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
