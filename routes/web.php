<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ZoomController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\GoogleMeetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

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


Route::group(['middleware' => 'auth'], function () {

  Route::get('/', [HomeController::class, 'home']);
  Route::get('dashboard', function () {
    return view('dashboard');
  })->name('dashboard');

  Route::get('/logout', [SessionsController::class, 'destroy']);
  Route::get('/user-profile', [InfoUserController::class, 'create']);
  Route::post('/user-profile', [InfoUserController::class, 'store']);

  Route::group(['middleware' => 'admin'], function () {

    // Staff
    Route::resource('/staff', StaffController::class);
    Route::get('/terminate/{id}', [StaffController::class, 'terminate'])->name('staff.terminate');
    Route::get('/get-data', [StaffController::class, 'getData'])->name('get.data');

    // Client
    Route::resource('/client', ClientController::class);
  });

  // Chat
  Route::get('/chat', [ChatController::class, 'index'])->name('chat');
  Route::post('/chat/getchat', [ChatController::class, 'getchat'])->name('getchat');
  Route::post('/chat/getuserlist', [ChatController::class, 'getuserlist'])->name('getuserlist');
  Route::post('/chat/send-message', [ChatController::class, 'sendMessage'])->name('sendMessage');
  Route::get('/chat/get-messages', [ChatController::class, 'getMessages'])->name('getMessages');

  //leave
  Route::resource('/leave', LeaveController::class);
  Route::get('/get-leave', [LeaveController::class, 'getLeave'])->name('get.leave');
  Route::get('/approve/{leave_id}/{id}', [LeaveController::class, 'approve']);
  Route::get('/unread/{id}', [LeaveController::class, 'unread']);

  // Zoom Meeting
  Route::resource('/zoom', ZoomController::class);
  //  Invitation 
  Route::post('zoom.invitaion', [ZoomController::class, 'invitaion']);
  Route::post('zoom.addinvit', [ZoomController::class, 'addinvit']);
  Route::any('zoom.delmembers', [ZoomController::class, 'delmembers'])->name('zoom.delmembers');
  // Upcoming  Meeting Model
  Route::post('zoom.editmeeting', [ZoomController::class, 'editmeeting'])->name('zoom.editmeeting');
  Route::post('zoom.updatemeeting', [ZoomController::class, 'updatemeeting'])->name('zoom.updatemeeting');
  // Previous  Meetings
  Route::post('zoom.prevdata', [ZoomController::class, 'prevdata']);
  // Live  Meetings
  Route::post('zoom.livedata', [ZoomController::class, 'livedata']);
  Route::post('zoom.envdata', [ZoomController::class, 'envdata'])->name('zoom.envdata');
  //  Zoom Setting 
  Route::get('zoom.zoomsetting', [ZoomController::class, 'zoomsetting'])->name('zoom.zoomsetting');
  Route::any('zoom.delsecret', [ZoomController::class, 'delsecret'])->name('zoom.delsecret');
  Route::post('zoom.getapidata', [ZoomController::class, 'getapidata'])->name('zoom.getapidata');
  Route::post('zoom.editapi', [ZoomController::class, 'editapi'])->name('zoom.editapi');
  Route::post('zoom.activeapi', [ZoomController::class, 'activeapi'])->name('zoom.activeapi');

  // Google Meet
  Route::any('/googlemeet', [GoogleMeetController::class, 'googlemeet'])->name('googlemeet');
  Route::post('/googlechat', [GoogleMeetController::class, 'googlechat'])->name('googlechat');
  Route::get('/googlechat', [GoogleMeetController::class, 'googlechat'])->name('googlechat');
  Route::get('/chatpage', [GoogleMeetController::class, 'chatpage'])->name('chatpage');
  Route::post('/chatpage', [GoogleMeetController::class, 'chatpage'])->name('chatpage');
  Route::get('/meet', [GoogleMeetController::class, 'meet'])->name('meet');
  Route::any('/googleDeleteRecord/{id}', [GoogleMeetController::class, 'googleDeleteRecord'])->name('googleDeleteRecord');
  Route::post('/googleEditBlade', [GoogleMeetController::class, 'googleEditBlade'])->name('googleEditBlade');
  Route::post('/updateGooglemeeting', [GoogleMeetController::class, 'updateGooglemeeting'])->name('updateGooglemeeting');
  Route::post('googleMeet/invitaion', [GoogleMeetController::class, 'googleMeetinvitaion'])->name('googleMeetinvitaion');
  Route::post('googleMeet/addinvit', [GoogleMeetController::class, 'googleMeetaddinvit'])->name('googleMeetaddinvit');
  Route::any('googleMeet/delmembers', [GoogleMeetController::class, 'googleMeetDelmembers'])->name('googleMeetDelmembers');
});

Route::group(['middleware' => 'ResetPassword'], function () {

  Route::get('/change-password-staff/{token}', [StaffController::class, 'resetPass'])->name('staff.password_reset');
  Route::post('/change-password-staff', [StaffController::class, 'changePassword'])->name('staf.password_update');
  Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
  Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/get-states/{id}', [StaffController::class, 'getState'])->name('get.states');
Route::get('/get-cities/{id}', [StaffController::class, 'getCity'])->name('get.cities');


Route::group(['middleware' => 'guest'], function () {
  // Route::get('/register', [RegisterController::class, 'create']);
  // Route::post('/register', [RegisterController::class, 'store']);
  Route::get('/login', [SessionsController::class, 'create'])->name('login');
  Route::post('/session', [SessionsController::class, 'store']);
  Route::get('/login/forgot-password', [ResetController::class, 'create']);
  Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
  // Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
  // Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});
