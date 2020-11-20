<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/Authenticated', function () {
    return true;
});

Route::post('registeraccount','RegisterControl@register');
Route::post('login','RegisterControl@login');
Route::post('SavePo','PoDetailsControl@store');
Route::post('SaveVendor','VendorController@store');
Route::post('DeleteVendor','VendorController@Delete');
Route::get('LoadPo','PoDetailsControl@LoadPo');
Route::get('LoadVen','VendorController@index');
Route::get('GetPo','PoDetailsControl@GetPo');
Route::get('GetPoHead','PoDetailsControl@GetPoHead');

Route::get('LoadCus','CustommerController@LoadCus');
Route::post('SaveCus','CustommerController@store');

Route::post('SaveItem','itemController@SaveItem');
Route::get('LoadItems','itemController@LoadItems');
Route::post('SaveItems','itemController@update');
Route::post('DeleteItem','itemController@Delete');

Route::get('treedata','LocationController@treedata');
