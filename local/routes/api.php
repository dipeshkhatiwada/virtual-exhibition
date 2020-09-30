<?php

use Illuminate\Http\Request;



Route::post('employer/login', 'API\EmployerLoginController@login');
Route::post('employer/logout', 'API\EmployerLoginController@logout');


Route::middleware(['auth:employer-api'])->group(function (){
    Route::get('enroll/exhibitions', 'API\EmployerEnrollController@index');
    Route::post('enroll/exhibitions','API\EmployerEnrollController@store');
    Route::put('enroll/exhibitions/{id}', 'API\EmployerEnrollController@update');
    Route::delete('enroll/exhibitions/{id}', 'API\EmployerEnrollController@delete');

    Route::get('enroll/exhibitions/dashboard', 'API\EmployerEnrollController@dashboard');
    Route::get('enroll/exhibitions-type/{id}','API\EmployerEnrollController@getBoothType');
    Route::get('enroll/exhibitions-price/{id}','API\EmployerEnrollController@getBoothPrice');
    Route::delete('enroll/exhibitions-booth/{id}', 'API\EmployerEnrollController@deleteBooth');

    //Livestream
    Route::get('/enroll/livestream/{slug}', 'API\EmployerEnrollController@checkLivestreamPlatform');
    Route::post('/enroll/livestream/{slug}/store-stime', 'API\EmployerEnrollController@storeStartTime');
    Route::post('/enroll/livestream/{slug}/store-etime', 'API\EmployerEnrollController@storeEndTime');

    //videocall
    Route::get('/enroll/video-call/{slug}','API\EmployerEnrollController@checkVideoCallPlatform');
    Route::post('/enroll/video-call/{slug}', 'API\EmployerEnrollController@saveVideoCallChannel');
    Route::delete('/enroll/video-call/finish/{slug}', 'API\EmployerEnrollController@deleteVideoCallChannel');


});


Route::post('employee/login', 'API\EmployeeEnrollController@login');

Route::middleware(['auth:front-api'])->group(function () {
    Route::get('/front/enroll', 'API\FrontEnrollController@index');
    Route::get('/front/enroll/{slug}', 'API\FrontEnrollController@show');
    Route::get('/front/enroll/company/{slug}', 'API\FrontEnrollController@homePage');

     //LiveStreaming
     Route::get('/front/enroll/audience/{slug}', 'API\FrontEnrollController@joinLiveStream');
     Route::post('/front/enroll/audience/{slug}','API\FrontEnrollController@updateJoinedLivestream');
     Route::post('/front/enroll/audience/{slug}/leave', 'API\FrontEnrollController@streamLeave');

     // Group Video call
     Route::get('/front/enroll/group-video/{slug}', 'API\FrontEnrollController@joinVideoCallChannel');
     Route::post('/front/enroll/group-video/{slug}', 'API\FrontEnrollController@updateJoinVideoCall');
     Route::post('/front/enroll/group-video/leave', 'API\FrontEnrollController@leaveVideoCall');

});



