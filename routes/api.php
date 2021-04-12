<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviseController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProductController;
use Facade\FlareClient\Stacktrace\File;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['middleware' => 'auth:sanctum'], function () {
//     //All secure URL's
//     Route::get('/list', [DeviseController::class, 'list']);
//     Route::get('/list/{id}', [DeviseController::class, 'listparams']);

//     Route::post('/add', [DeviseController::class, 'add']);
//     Route::put('/update', [DeviseController::class, 'update']);
//     Route::delete('/delete/{id}', [DeviseController::class, 'delete']);

//     Route::get('/search/{name}', [DeviseController::class, 'search']);
//     Route::post('/save', [DeviseController::class, 'testdata']);
//     //reourse route
//     Route::apiResource('/member', MemberController::class);
// });

//Route::post("login", [UserController::class, 'index']);
//manually routes here...
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('/list', [DeviseController::class, 'list']);
    Route::get('/list/{id}', [DeviseController::class, 'listparams']);

    Route::post('/add', [DeviseController::class, 'add']);
    Route::put('/update', [DeviseController::class, 'update']);
    Route::delete('/delete/{id}', [DeviseController::class, 'delete']);

    Route::get('/search/{name}', [DeviseController::class, 'search']);
    Route::post('/save', [DeviseController::class, 'testdata']);
    Route::post('/logout',[UserController::class,'logout']);

});

//Route::post('/upload',[FileController::class,'upload']);
Route::post('/addimg',[ProductController::class,'addimg']);
Route::get('/list',[ProductController::class,'list']);
Route::delete('/delete/{id}',[ProductController::class,'delete']);
Route::get('/getproduct/{id}',[ProductController::class,'getproduct']);
Route::get('/search/{name}',[ProductController::class,'search']);