<?php

Route::addGet('/users', [
    'controller' => 'Users',
    'action' => 'showLoginForm',
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
Route::mount(new App\Users\Routes\UsersRoutes);