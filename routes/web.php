<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [
    'uses' => 'PageController@Index',
    'as' => 'index'
]);

Route::get('/menu', [
    'uses' => 'PageController@MenuIndex',
    'as' => 'menu'
]);

Route::get('/find_us', [
    'uses' => 'PageController@find_us',
    'as' => 'find_us'
]);

Route::get('/addCartItem/{id}', [
    'uses' => 'OrderController@addCartItem',
    'as' => 'addCartItem'
]);

Route::get('/deleteCartItem/{id}', [
    'uses' => 'OrderController@deleteCartItem',
    'as' => 'deleteCartItem'
]);

Route::get('/placeOrder', [
    'uses' => 'OrderController@placeOrder',
    'as' => 'placeOrder'
]);

Route::post('/acceptOrder', [
    'uses' => 'OrderController@acceptOrder',
    'as' => 'acceptOrder'
]);

Auth::routes();
// Auth::routes(['register' => false]); // use this instead when go live so that can't register a new user

//############## ADMIN ROUTES ##############################################################################

Route::post('/home', 'adminOrderController@showCurrentOrdersByName')->name('home')->middleware('auth');
Route::get('/home', 'adminOrderController@showCurrentOrdersByName')->name('home')->middleware('auth');

Route::get('/changePaymentStatusToPaid/{id}', 'adminOrderController@changePaymentStatusToPaid')
->name('changePaymentStatusToPaid')->middleware('auth');

Route::get('/changePaymentStatusToUnpaid/{id}', 'adminOrderController@changePaymentStatusToUnpaid')
->name('changePaymentStatusToUnpaid')->middleware('auth');

Route::get('/changeOrderStatusToRecd/{id}', 'adminOrderController@changeOrderStatusToRecd')
->name('changeOrderStatusToRecd')->middleware('auth');

Route::get('/changeOrderStatusToCooking/{id}', 'adminOrderController@changeOrderStatusToCooking')
->name('changeOrderStatusToCooking')->middleware('auth');

Route::get('/changeOrderStatusToDelivered/{id}', 'adminOrderController@changeOrderStatusToDelivered')
->name('changeOrderStatusToDelivered')->middleware('auth');

// alternate syntax - no name so called using 'url' with a "/" instead of 'route' and the name
Route::get('/changeOrderStatusToCollected/{id}', 'adminOrderController@changeOrderStatusToCollected')
->middleware('auth');

Route::get('/changeOrderStatusToCancelled/{id}', 'adminOrderController@changeOrderStatusToCancelled')
->name('changeOrderStatusToCancelled')->middleware('auth');

Route::post('/showUnpaidOrders', 'adminOrderController@showUnpaidOrders')->name('showUnpaidOrders')->middleware('auth');
Route::get('/showUnpaidOrders', 'adminOrderController@showUnpaidOrders')->name('showUnpaidOrders')->middleware('auth');

Route::get('/downloadOrders', 'adminOrderController@downloadOrders')->name('downloadOrders')->middleware('auth');


Route::get('/showMenuItems', 'adminMenuController@showMenuItems')->name('showMenuItems')->middleware('auth');
Route::get('/enterMenuItem', 'adminMenuController@enterMenuItem')->name('enterMenuItem')->middleware('auth');
Route::post('/addMenuItem', 'adminMenuController@addMenuItem')->name('addMenuItem')->middleware('auth');
Route::get('/editMenuItem/{id}', 'adminMenuController@editMenuItem')->name('editMenuItem')->middleware('auth');
Route::patch('/updateMenuItem/{id}', 'adminMenuController@updateMenuItem')->name('updateMenuItem')->middleware('auth');
Route::delete('/deleteMenuItem/{id}', 'adminMenuController@deleteMenuItem')->name('deleteMenuItem')->middleware('auth');
Route::get('/downloadMenu', 'adminMenuController@downloadMenu')->name('downloadMenu')->middleware('auth');
Route::get('/uploadMenu', 'adminMenuController@uploadMenu')->name('uploadMenu')->middleware('auth');
Route::post('/uploadMenu', 'adminMenuController@importMenuCsv')->name('importMenuCsv')->middleware('auth');

Route::resource('/menuCategories', 'AdminMenuCategoryController')->middleware('auth');
Route::get('/downloadCategories', 'AdminMenuCategoryController@downloadCategories')->name('downloadCategories')->middleware('auth');





