<?php

Route::post('clients/register', 'ClientsController@register');
Route::get('clients/{uuid}', 'ClientsController@get');

Route::post('freelancers/register', 'FreelancersController@register');
Route::get('freelancers/{uuid}', 'FreelancersController@get');
Route::post('freelancers/apply-to-job', 'FreelancersController@apply');

Route::post('jobs/post', 'JobsController@post');
Route::get('jobs/{uuid}', 'JobsController@get');
