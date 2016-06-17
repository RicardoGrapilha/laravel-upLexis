<?php
Route::get('/', function(){
    return redirect('user/login');
});

Route::group(['as' => 'user.', 'prefix' => 'user', 'namespace' => 'Uplexis'], function () {
    // CREATE USERS
    Route::get('create', ['as' => 'create', 'uses' => 'UserController@createUser']);
    Route::post('create', ['as' => 'create', 'uses' => 'UserController@saveUser']);

    // LOGIN
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', ['as' => 'login', 'uses' => 'UserController@getLogin']);
        Route::post('login', ['as' => 'login', 'uses' => 'UserController@postLogin']);
    });

    // LOGOUT
    Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@getLogout']);
});

Route::group(['middleware' => 'auth', 'namespace' => 'Uplexis'], function () {
    Route::match(['GET','POST'], 'sintegra', ['as' => 'sintegra', 'uses' => 'SintegraController@index']);
    Route::get('sintegra/lista', ['as' => 'sintegra.list', 'uses' => 'SintegraController@show']);
    Route::post('sintegra/delete', ['as' => 'sintegra.delete', 'uses' => 'SintegraController@delete']);
});

Route::group(['prefix' => 'api', 'namespace' => 'Uplexis', 'middleware' => 'auth_api'], function () {
    Route::post('consulta', ['uses' => 'SintegraAPIController@Consulta']);
});
