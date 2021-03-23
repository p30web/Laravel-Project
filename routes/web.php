<?php

Route::get('/', 'PagesController@index')->name('home');
Route::group(['perfix'=>'panel','middleware'=>['web','auth','role:administrator'],'namespace'=>'PanelAdmin'],function() {
    Route::get('panel/dashboard', 'DashboardController@index')->middleware('role:administrator')->name('admin.dashboard');
//    Route::get('panel/graph-charts','GraphController@getAdversByGroupBrands')->name('admin.brand.chart');
    Route::get('panel/logout', 'DashboardController@logout')->name('admin.logout');
    Route::get('panel/expert/index', 'ExpertController@index')->name('expert.index');
    Route::post('panel/expert/filter', 'ExpertSearchController@search')->name('expert.filter');
    Route::get('panel/expert/{id}/edit', 'ExpertController@edit')->name('expert.edit');
    Route::post('panel/expert/{id}/', 'ExpertController@update')->name('expert.update');
    Route::get('panel/expert/{id}/delete', 'ExpertController@destroy')->name('expert.delete');
    Route::post('panel/expertProperties/{id}/', 'ExpertPropertiesController@update')->name('expert.edit.properties');
});

Route::group(['perfix'=>'panel','middleware'=>['web','auth','role:administrator'],'namespace'=>'PanelAdmin'],function() {
    Route::get('panel/sale/index', 'SaleController@index')->name('sale.index');
    Route::get('panel/sale/{id}/edit', 'SaleController@edit')->name('sale.edit');
    Route::get('panel/sale/create/{expertId?}','SaleController@create')->name('sale.create');
    Route::post('panel/sale/create/','SaleController@store')->name('sale.store');
    Route::post('panel/sale/{id}/', 'SaleController@update')->name('sale.update');
    Route::get('panel/sale/{id}/delete', 'SaleController@destroy')->name('sale.delete');
//    Route::post('panel/sale/create','SaleController@store')->name('sale.storeCustom');
});

Route::group(['perfix'=>'panel','middleware'=>['web','auth','role:administrator'],'namespace'=>'PanelAdmin'],function() {
    Route::get('panel/user/index', 'UserController@index')->name('user.index');
    Route::get('panel/user/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::put('panel/user/{id}/', 'UserController@update')->name('user.update');
    Route::get('panel/user/{id}/delete', 'UserController@destroy')->name('user.delete');
});

Route::group(['perfix'=>'panel','middleware'=>['web','auth','role:administrator'],'namespace'=>'PanelAdmin'],function() {
    Route::get('panel/invoice/index', 'InvoiceController@index')->name('invoice.index');
    Route::get('panel/invoice/{id}/edit', 'InvoiceController@edit')->name('invoice.edit');
});

Route::group(['perfix'=>'panel','middleware'=>['web','auth','role:administrator'],'namespace'=>'PanelAdmin'],function() {
    Route::get('panel/payment/{id}/approve', 'PaymentController@approve')->name('payment.approve');
    Route::get('panel/payment/{id}/delete', 'PaymentController@destroy')->name('payment.delete');
    Route::post('panel/payment/create/{invoiceId}','PaymentController@store')->name('payment.store');
});

Auth::routes();
