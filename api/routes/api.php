<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// $app->get($uri, $callback);
// $app->post($uri, $callback);
// $app->put($uri, $callback);
// $app->patch($uri, $callback);
// $app->delete($uri, $callback);
// $app->options($uri, $callback);

// $app->get('profile', [
//     'as' => 'profile', 'uses' => 'UserController@showProfile'
// ]);

// $router->get('lakes/{id}', ['uses' => 'LakeController@show']);
// $router->post('lakes', ['uses' => 'LakeController@create']);
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('broadcasting/auth', ['uses' => 'BroadcastController@authenticate']);
    $router->post('broadcasting/auth', ['uses' => 'BroadcastController@authenticate']);
});

$router->group(['middleware' => 'api', 'namespace' => 'App\Http\Controllers'], function () use ($router){
    $router->get('menu', ['uses' => 'MenuController@index']);

    $router->post('login', ['uses' => 'AuthController@login']);
    $router->post('logout', ['uses' => 'AuthController@logout']);
    $router->post('refresh', ['uses' => 'AuthController@refresh']);
    $router->post('register', ['uses' => 'AuthController@register']);

    // Route::resource('notes', 'NotesController');

    // resource('resource/{table}/resource', 'ResourceController', 0);
    $uri = 'resource/{table}/resource';
    $controller = 'ResourceController';
    $router->get($uri, 'App\Http\Controllers\\'.$controller.'@index');
    $router->post($uri, 'App\Http\Controllers\\'.$controller.'@store');
    $router->get($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@show');
    $router->get($uri.'/{id}/edit', 'App\Http\Controllers\\'.$controller.'@edit');
    $router->put($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
    $router->patch($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
    $router->delete($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@destroy');

    $router->group(['middleware' => 'admin', 'namespace' => 'App\Http\Controllers'], function () use ($router){
        
        //Create Mail Resource
        // resource('mail', 'MailController', 0);
        $uri = 'mail';
        $controller = 'MailController';
        $router->get($uri, 'App\Http\Controllers\\'.$controller.'@index');
        $router->post($uri, 'App\Http\Controllers\\'.$controller.'@store');
        $router->get($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@show');
        $router->get($uri.'/{id}/edit', 'App\Http\Controllers\\'.$controller.'@edit');
        $router->put($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
        $router->patch($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
        $router->delete($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@destroy');

        $router->get('prepareSend/{id}', [
            'as' => 'prepareSend', 'uses' => 'MailController@prepareSend'
        ]);
        $router->post('mailSend/{id}', [
            'as' => 'mailSend', 'uses' => 'MailController@send'
        ]);
       
        //Create BREAD resource
        // resource('bread',  'BreadController', 0);
        $uri = 'bread';
        $controller = 'BreadController';
        $router->get($uri, 'App\Http\Controllers\\'.$controller.'@index');
        $router->post($uri, 'App\Http\Controllers\\'.$controller.'@store');
        $router->get($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@show');
        $router->get($uri.'/{id}/edit', 'App\Http\Controllers\\'.$controller.'@edit');
        $router->put($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
        $router->patch($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
        $router->delete($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@destroy');

        // resource('users', 'UsersController', 2);
        $uri = 'users';
        $controller = 'UsersController';
        $router->get($uri, 'App\Http\Controllers\\'.$controller.'@index');
        $router->get($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@show');
        $router->get($uri.'/{id}/edit', 'App\Http\Controllers\\'.$controller.'@edit');
        $router->put($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
        $router->patch($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
        $router->delete($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@destroy');

        $router->group(['prefix' => 'menu/menu', 'namespace' => 'App\Http\Controllers'], function () use ($router){
            $router->get('/', [
                'as' => 'menu.menu.index', 'uses' => 'MenuEditController@index'
            ]);
            $router->get('/create', [
                'as' => 'menu.menu.create', 'uses' => 'MenuEditController@create'
            ]);
            $router->post('/store', [
                'as' => 'menu.menu.store', 'uses' => 'MenuEditController@store'
            ]);
            $router->get('/edit', [
                'as' => 'menu.menu.edit', 'uses' => 'MenuEditController@edit'
            ]);
            $router->get('/update', [
                'as' => 'menu.menu.update', 'uses' => 'MenuEditController@update'
            ]);
            $router->get('/delete', [
                'as' => 'menu.menu.delete', 'uses' => 'MenuEditController@delete'
            ]);
        });

        $router->group(['prefix' => 'menu/element', 'namespace' => 'App\Http\Controllers'], function () use ($router){
            $router->get('/', [
                'as' => 'menu.index', 'uses' => 'MenuElementController@index'
            ]);
            $router->get('/move-up', [
                'as' => 'menu.create', 'uses' => 'MenuElementController@moveUp'
            ]);
            $router->post('/move-down', [
                'as' => 'menu.store', 'uses' => 'MenuElementController@moveDown'
            ]);
            $router->get('/create', [
                'as' => 'menu.edit', 'uses' => 'MenuElementController@create'
            ]);
            $router->get('/store', [
                'as' => 'menu.update', 'uses' => 'MenuElementController@store'
            ]);
            $router->get('/get-parents', [
                'as' => 'menu.delete', 'uses' => 'MenuElementController@getParents'
            ]);
            $router->get('/edit', [
                'as' => 'menu.delete', 'uses' => 'MenuElementController@edit'
            ]);
            $router->get('/update', [
                'as' => 'menu.delete', 'uses' => 'MenuElementController@update'
            ]);
            $router->get('/show', [
                'as' => 'menu.delete', 'uses' => 'MenuElementController@show'
            ]);
            $router->get('/delete', [
                'as' => 'menu.delete', 'uses' => 'MenuElementController@delete'
            ]);
        });

        // Route::prefix('media')->group(function ($router) {
        //     Route::get('/',                 'MediaController@index')->name('media.folder.index');
        //     Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
        //     Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
        //     Route::get('/folder',           'MediaController@folder')->name('media.folder');
        //     Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
        //     Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

        //     Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
        //     Route::get('/file',             'MediaController@file');
        //     Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
        //     Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
        //     Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
        //     Route::post('/file/cropp',      'MediaController@cropp');
        //     Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');

        //     Route::get('/file/download',    'MediaController@fileDownload');
        // });

        // resource('roles', 'RolesController', 1);
        $uri = 'roles';
        $controller = 'RolesController';
        $router->get($uri, 'App\Http\Controllers\\'.$controller.'@index');
        $router->get($uri.'/create', 'App\Http\Controllers\\'.$controller.'@create');
        $router->post($uri, 'App\Http\Controllers\\'.$controller.'@store');
        $router->get($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@show');
        $router->get($uri.'/{id}/edit', 'App\Http\Controllers\\'.$controller.'@edit');
        $router->put($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
        $router->patch($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
        $router->delete($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@destroy');

        $router->get('/roles/move/move-up', [
            'as' => 'roles.up', 'uses' => 'RolesController@moveUp'
        ]);
        $router->get('/roles/move/move-down', [
            'as' => 'roles.down', 'uses' => 'RolesController@moveDown'
        ]);
    });

    
});

// function resource($uri, $controller, $case)
// {
// 	//$verbs = array('GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE');
//     switch($case){
//         case 0:
//             $router->get($uri, 'App\Http\Controllers\\'.$controller.'@index');
//             $router->post($uri, 'App\Http\Controllers\\'.$controller.'@store');
//             $router->get($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@show');
//             $router->get($uri.'/{id}/edit', 'App\Http\Controllers\\'.$controller.'@edit');
//             $router->put($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
//             $router->patch($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
//             $router->delete($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@destroy');
//             break;

//         case 1:
//             $router->get($uri, 'App\Http\Controllers\\'.$controller.'@index');
//             $router->get($uri.'/create', 'App\Http\Controllers\\'.$controller.'@create');
//             $router->post($uri, 'App\Http\Controllers\\'.$controller.'@store');
//             $router->get($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@show');
//             $router->get($uri.'/{id}/edit', 'App\Http\Controllers\\'.$controller.'@edit');
//             $router->put($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
//             $router->patch($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
//             $router->delete($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@destroy');
//             break;
        
//         case 2:
//             $router->get($uri, 'App\Http\Controllers\\'.$controller.'@index');
//             $router->get($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@show');
//             $router->get($uri.'/{id}/edit', 'App\Http\Controllers\\'.$controller.'@edit');
//             $router->put($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
//             $router->patch($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@update');
//             $router->delete($uri.'/{id}', 'App\Http\Controllers\\'.$controller.'@destroy');
//     }
// }