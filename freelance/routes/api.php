<?php

Route::group(['namespace' => 'Write'], function(){
    Route::post('clients/register', 'ClientsController@register');

    Route::post('freelancers/register', 'FreelancersController@register');
    Route::post('freelancers/apply-to-job', 'FreelancersController@apply');

    Route::post('jobs/post', 'JobsController@post');
});

Route::group(['namespace' => 'Read'], function(){
    Route::get('clients/{uuid}', 'ClientsController@get');
    Route::get('jobs/{uuid}', 'JobsController@get');
    Route::get('freelancers/{uuid}', 'FreelancersController@get');

    Route::get('jobs-with-proposals/{uuid}', 'JobsController@getWithProposals');
});