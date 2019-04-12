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

//Auth::routes();
Auth::routes(['register' => false]); // use this instead when go live so that can't register a new user

//############## ADMIN ROUTES ##############################################################################

Route::post('/home', 'AdminOrderController@showCurrentOrdersByName')->name('home')->middleware('auth');
Route::get('/home', 'AdminOrderController@showCurrentOrdersByName')->name('home')->middleware('auth');

Route::get('/changePaymentStatusToPaid/{id}', 'AdminOrderController@changePaymentStatusToPaid')
->name('changePaymentStatusToPaid')->middleware('auth');

Route::get('/changePaymentStatusToUnpaid/{id}', 'AdminOrderController@changePaymentStatusToUnpaid')
->name('changePaymentStatusToUnpaid')->middleware('auth');

Route::get('/changeOrderStatusToRecd/{id}', 'AdminOrderController@changeOrderStatusToRecd')
->name('changeOrderStatusToRecd')->middleware('auth');

Route::get('/changeOrderStatusToCooking/{id}', 'AdminOrderController@changeOrderStatusToCooking')
->name('changeOrderStatusToCooking')->middleware('auth');

Route::get('/changeOrderStatusToDelivered/{id}', 'AdminOrderController@changeOrderStatusToDelivered')
->name('changeOrderStatusToDelivered')->middleware('auth');

// alternate syntax - no name so called using 'url' with a "/" instead of 'route' and the name
Route::get('/changeOrderStatusToCollected/{id}', 'AdminOrderController@changeOrderStatusToCollected')
->middleware('auth');

Route::get('/changeOrderStatusToCancelled/{id}', 'AdminOrderController@changeOrderStatusToCancelled')
->name('changeOrderStatusToCancelled')->middleware('auth');

Route::post('/showUnpaidOrders', 'AdminOrderController@showUnpaidOrders')->name('showUnpaidOrders')->middleware('auth');
Route::get('/showUnpaidOrders', 'AdminOrderController@showUnpaidOrders')->name('showUnpaidOrders')->middleware('auth');

Route::get('/downloadOrders', 'AdminOrderController@downloadOrders')->name('downloadOrders')->middleware('auth');


Route::get('/showMenuItems', 'AdminMenuController@showMenuItems')->name('showMenuItems')->middleware('auth');
Route::get('/enterMenuItem', 'AdminMenuController@enterMenuItem')->name('enterMenuItem')->middleware('auth');
Route::post('/addMenuItem', 'AdminMenuController@addMenuItem')->name('addMenuItem')->middleware('auth');
Route::get('/editMenuItem/{id}', 'AdminMenuController@editMenuItem')->name('editMenuItem')->middleware('auth');
Route::patch('/updateMenuItem/{id}', 'AdminMenuController@updateMenuItem')->name('updateMenuItem')->middleware('auth');
Route::delete('/deleteMenuItem/{id}', 'AdminMenuController@deleteMenuItem')->name('deleteMenuItem')->middleware('auth');
Route::get('/downloadMenu', 'AdminMenuController@downloadMenu')->name('downloadMenu')->middleware('auth');
Route::get('/uploadMenu', 'AdminMenuController@uploadMenu')->name('uploadMenu')->middleware('auth');
Route::post('/uploadMenu', 'AdminMenuController@importMenuCsv')->name('importMenuCsv')->middleware('auth');

Route::resource('/menuCategories', 'AdminMenuCategoryController')->middleware('auth');
Route::get('/downloadCategories', 'AdminMenuCategoryController@downloadCategories')->name('downloadCategories')->middleware('auth');





