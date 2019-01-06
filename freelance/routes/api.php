<?php

Route::post('clients/register', 'ClientsController@register');
Route::get('clients/{id}', 'ClientsController@get');

Route::post('freelancers/register', 'FreelancersController@register');
Route::get('freelancers/{id}', 'FreelancersController@get');

Route::post('jobs/post', 'JobsController@post');
Route::post('jobs/apply', 'JobsController@apply');
Route::get('jobs/{id}', 'JobsController@get');
