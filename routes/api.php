<?php

use Illuminate\Http\Request;

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

Route::post('/categories/upsert', 'CategoryController@upsert'); // calls api/categories/upsert

Route::delete('/categories/{category}', 'CategoryController@destroy'); // Route model binding

Route::post('/menu-items/add', 'MenuItemController@store');

Route::post('/add-image', function (Request $request) {
    $file = $request->file('file');
    $dir = 'public/images';
    $path = $file->store($dir);
    return str_replace("$dir/", '', $path);
}); // Closure for convenience

Route::get('/categories/{category}/items', 'CategoryController@items');