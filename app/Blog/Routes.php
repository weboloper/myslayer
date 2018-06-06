<?php

/*
+----------------------------------------------------------------+
|\ Creating Routes                                              /|
+----------------------------------------------------------------+
|
| There are two ways to create route, there is the facade 'Route'
| or the function route()
|
*/

Route::addGet('/', [
    'controller' => 'Welcome',
    'action' => 'showSignature',
]);

Route::addGet('/try-sample-forms', [
    'controller' => 'Welcome',
    'action' => 'trySampleForms',
])->setName('trySampleForms');

Route::addGet('/posts', [
    'controller' => 'Posts',
    'action' => 'index',
]);

Route::addGet('/posts/create', [
    'controller' => 'Posts',
    'action' => 'create',
]);

/*
+----------------------------------------------------------------+
|\ Organized Routes using RouteGroup                            /|
+----------------------------------------------------------------+
|
| You can group your routes by using route classes,
| mounting them to organize your routes
|
*/
Route::mount(new App\Blog\Routes\NewsfeedRoutes);
