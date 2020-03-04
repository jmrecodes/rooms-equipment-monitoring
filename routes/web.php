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

Route::get('/', [
    'as'	=> 'guest',
    'uses'	=> 'Guest@index'
]);

Route::post('/login', [
    'as'	=> 'login',
    'uses'	=> 'Guest@login'
]);

Route::get('/admin/', [
    'as'	=> 'admin',
    'uses'	=> 'Admin@index'
]);

Route::get('/admin/logout', [
    'as'	=> 'logout',
    'uses'	=> 'Admin@logout'
]);

Route::get('/admin/equipment', [
    'as'	=> 'equipment',
    'uses'	=> 'Admin@equipment'
]);

Route::post('/admin/equipment/insert', [
    'as'	=> 'equipment_insert',
    'uses'	=> 'Admin@equipment_insert'
]);

Route::get('/admin/room', [
    'as'	=> 'room',
    'uses'	=> 'Admin@room'
]);

Route::post('/admin/room/insert', [
    'as'	=> 'room_insert',
    'uses'	=> 'Admin@room_insert'
]);

Route::get('/admin/monitor_manage/{room_ID?}', [
    'as'	=> 'monitor',
    'uses'	=> 'Admin@monitor'
]);

Route::post('/admin/monitor_manage/{room_ID?}/insert', [
    'as'	=> 'equipment_room_insert',
    'uses'	=> 'Admin@monitor_eqrm_insert'
]);

Route::get('/admin/monitor_manage/{eqrm_ID?}/return', [
    'as'	=> 'equipment_room_return',
    'uses'	=> 'Admin@monitor_eqrm_return'
]);

Route::get('/admin/settings', [
    'as'	=> 'settings',
    'uses'	=> 'Admin@settings'
]);
