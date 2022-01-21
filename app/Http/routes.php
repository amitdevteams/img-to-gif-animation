<?php


Route::get('/',[
'uses'=>'ImageController@index'
]);

Route::post('/upload',[
'uses'=>'ImageController@upload'
]);

Route::post('/generate',[
'uses'=>'ImageController@generate'
]);
