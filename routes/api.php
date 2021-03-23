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

//public
Route::group(['prefix' => 'v1', 'middleware' => ['api', 'json.response']], function () {
    Route::get('cashes/', 'Api\ApiController@getCashes')->name('cashes');
    Route::get('gearboxstatuses/', 'Api\ApiController@getGearboxStatuses')->name('gearboxstatuses');
    Route::get('carstatuses/', 'Api\ApiController@getCarStatuses')->name('carstatuses');
    Route::get('differentials/', 'Api\ApiController@getDifferentials')->name('differentials');
    Route::get('chassitypes/', 'Api\ApiController@getChassiTypes')->name('chassitype');
    Route::get('cities/', 'Api\ApiController@getCities')->name('cities');
    Route::get('city/{id}', 'Api\ApiController@getTownsById')->where('id', '[0-9]+')->name('cityid');
    Route::get('brands/', 'Api\BrandController@getBrands')->name('brands');
    Route::get('brand/{id}', 'Api\BrandController@getModelById')->where('id', '[0-9]+')->name('brandid');
    Route::get('colors/', 'Api\ApiController@getColors')->name('colors');
    Route::get('productions/', 'Api\ApiController@getProductions')->name('productions');
    Route::get('bodiesstatus/', 'Api\ApiController@getBodiesStatus')->name('bodiesstatus');
    Route::get('towns/', 'Api\ApiController@getTowns')->name('Towns');
    Route::get('locations/', 'Api\LocationController@getLocations')->name('locations');
    Route::get('placestaines/', 'Api\ApiController@getPlaceStaines')->name('placestaines');
    Route::get('search/', 'Filter\AdverFilterController@index')->name('search');
    Route::get('/reserve/location/{locationId}/{date?}', 'Api\Reserve\ReserveController@getDatesById')->where(['id' => '[0-9]+', 'time' => '^\d{4}[\-\/\s]?((((0[13578])|(1[02]))[\-\/\s]?(([0-2][0-9])|(3[01])))|(((0[469])|(11))[\-\/\s]?(([0-2][0-9])|(30)))|(02[\-\/\s]?[0-2][0-9]))$'])->name('getDates');
    Route::get('/time/location/{id}/', 'Api\Reserve\ReserveController@getTimesByLocationId')->where('id', '[0-9]+')->name('getTimes');
});

Route::group(['prefix' => 'v1', 'middleware' => ['auth:api', 'json.response']], function () {
    Route::post('/tracking', 'Api\TrackingController@trackingExpert')->name('profile.trackingexpert.check');
    Route::get('/gateway/startPay', 'Api\GatewayController@store')->name('startpay');
    Route::post('/gateway/verifyPay', 'Api\GatewayController@verifyRequest')->name('verifyRequest');
    Route::get('/logout', 'Api\LogoutController@logout')->name('logout');
    Route::post('/createADE', 'Api\Adver\ExpertController@store')->name('createADE');
    Route::post('/createADS', 'Api\Adver\SaleController@store')->name('createADS');
    Route::get('/package/{id}', 'Api\PackageController@getPackageById')->where('id', '[0-9]+')->name('getpackages');
});

Route::group(['prefix' => 'v1/profile', 'middleware' => ['auth:api', 'json.response']], function () {
    Route::post('/update', 'Api\Profile\ProfileController@update')->name('profile.update');
    Route::get('/userinfo', 'Api\Profile\ProfileController@show')->name('profile.show');
    Route::get('/sales', 'Api\Adver\SaleController@index')->name('profile.sales');
    Route::get('/sale/{id}/edit', 'Api\Adver\SaleController@edit')->name('profile.sale.edit');
    Route::post('/sale/{id}/update', 'Api\Adver\SaleController@update')->name('profile.sale.update');
    Route::delete('/sale/{id}/delete', 'Api\Adver\SaleController@destroy')->name('profile.sale.destroy');
    Route::get('/experts', 'Api\Adver\ExpertController@index')->name('profile.experts');
    Route::get('/expert/{id}/edit', 'Api\Adver\ExpertController@edit')->name('profile.expert.edit');
    Route::get('/invoices', 'Api\Profile\InvoiceController@index')->name('profile.invoices');
    Route::get('/invoice/{id}', 'Api\Profile\InvoiceController@show')->name('profile.invoice.show');
});


Route::group(['prefix' => 'v1', 'middleware' => ['api', 'json.response']], function () {
    Route::post('/checkAuthUser', 'Api\ApiController@checkAuthUser')->name('checkAuthUser');
    Route::get('contact/{id}', 'Api\ContactController@get')->middleware('throttle:9,10')->name('returnPhoneNumber');
    Route::post('/login', 'Api\LoginController@login')->name('loginapi');
    Route::post('/verifyphone', 'VerifyPhoneController@verify')->middleware('throttle:9,10')->name('verify');
    Route::post('/register', 'Api\RegisterController@registerUser')->name('registerapi');
});


