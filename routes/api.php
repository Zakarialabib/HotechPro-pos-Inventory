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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$router->group([
    'prefix' => 'app',
    'namespace' => 'API',
    'as' => 'api_app_',
    'middleware' => []], function () use ($router) {

$router->get('expense/all', 'ExpenseController@expenseErp');
$router->get('expense/add', 'ExpenseController@addExpense');


});
