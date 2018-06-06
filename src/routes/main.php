<?php

Route::group([
    'middleware' => ['web'],
    'namespace' => 'Crystoline\LaraShell\Controller', 'as' =>'crystoline.larashell.'], function () {
    Route::get('/larashell', ['as' => 'index', 'uses' => 'CmdToolController@index']);
    Route::post('/larashell', ['as' => 'exec','uses' => 'CmdToolController@exec']);
});