<?php

get('/tasks','TasksController@index');
post('/tasks/create','TasksController@createTask');

get('/tasks/{id}/edit','TasksController@edit');
post('/tasks/{id}/edit','TasksController@update');

get('/tasks/{id}/done','TasksController@markAsDone');
get('/tasks/{id}/undone','TasksController@unmarkAsDone');

post('/tasks/{id}/delete','TasksController@destroy');
