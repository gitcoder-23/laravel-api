<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// routes all controllers
// use App\Http\Controllers\dummyAPI;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// http://localhost:8000/api
// get route
// Route::get('data', [dummyAPI::class, 'getData']);
// all data & id wise data
// Protecting Routes
Route::middleware('auth:sanctum')->get('list/{id?}', [DeviceController::class, 'list']);

// all devices
Route::middleware('auth:sanctum')->get('listdata', [DeviceController::class, 'listdata']);

// single device
Route::middleware('auth:sanctum')->get('singledata/{id?}', [DeviceController::class, 'singledata']);

// Add data
Route::middleware('auth:sanctum')->post('add', [DeviceController::class, 'add']);

// Update data-1
Route::middleware('auth:sanctum')->put('update', [DeviceController::class, 'update']);

// Update data-2
Route::middleware('auth:sanctum')->put('updatedata/{id?}', [DeviceController::class, 'updatedata']);

// Search
Route::middleware('auth:sanctum')->get('search/{name}', [DeviceController::class, 'search']);

// Search character
Route::middleware('auth:sanctum')->get('searchcharacter/{name}', [DeviceController::class, 'searchcharacter']);

// Delete
Route::middleware('auth:sanctum')->delete('delete/{id}', [DeviceController::class, 'delete']);

// Api validation
Route::middleware('auth:sanctum')->post('save', [DeviceController::class, 'saveValidation']);
Route::middleware('auth:sanctum')->put('edit/{id}', [DeviceController::class, 'updateValidation']);




// http://localhost:8000/api/member (controller name is member)
// 'Resource' only one function api added

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get('users', [UserController::class, 'users']);
    Route::get('user/{id}', [UserController::class, 'singleUser']);
    Route::apiResource('member', MemberController::class);
    Route::post('upload', [FileController::class, 'upload']);

});


// API Authenticatin using Sanctum
Route::post("login",[UserController::class,'login']);
Route::post("register",[UserController::class,'register']);