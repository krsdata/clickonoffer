<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    // Login
    Route::post('login', function (Illuminate\Http\Request $request, App\Admin $user) {
        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

        $admin_auth = auth()->guard('admin');
        $user_auth =  auth()->guard('web'); //Auth::attempt($credentials);
        if ($admin_auth->attempt($credentials)) {
            return Redirect::to('admin');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => 'Invalid email or password. Try again!']);
        }
    });


    //basic routes
    //Route::get('/', 'AdminController@index');
    Route::get('/', 'AuthController@index');
    Route::get('/login', 'AuthController@index');
    Route::get('/forgot-password', 'AuthController@forgetPassword');
    Route::post('password/email', 'AuthController@sendResetPasswordLink');
    Route::get('password/reset', 'AuthController@resetPassword');
    Route::get('logout', 'AuthController@logout')->name('logout');

    
    Route::post('/post_login', 'AdminLoginController@post_login');
    Route::get('/logout', 'AdminLoginController@logout');
    Route::get('/CheckLogin', 'AdminLoginController@CheckLogin');
    Route::get('/404', 'AdminLoginController@not_found');
    
     /* logged admin user opertaions */
    Route::group(['middleware' =>  'admin'], function(){
              
      Route::get('/', 'AdminLoginController@dashboard'); 
       //       module
        Route::get('/module', 'ModuleController@index'); 
        Route::get('/module/create', 'ModuleController@create');
        Route::post('/module/store', 'ModuleController@store'); 
       
      Route::bind('language', function ($value, $route) {
           return Modules\Admin\Models\Language::find($value);
       });

       Route::resource(
           'language',
           'LanguageController',
           [
               'names' => [
                   'edit'    => 'language.edit',
                   'show'    => 'language.show',
                   'destroy' => 'language.destroy',
                   'update'  => 'language.update',
                   'store'   => 'language.store',
                   'index'   => 'language',
                   'create'  => 'language.create',
               ],
           ]
       );


       Route::bind('role', function ($value, $route) {
            return Modules\Admin\Entities\Role::find($value);
        });

        Route::resource(
            'roles',
            'RoleController',
            [
                'names' => [
                    'edit'    => 'role.edit',
                    'show'    => 'role.show',
                    'destroy' => 'role.destroy',
                    'update'  => 'role.update',
                    'store'   => 'role.store',
                    'index'   => 'role',
                    'create'  => 'role.create',
                ],
            ]
        );
       
       /*------------User Model and controller---------*/

        Route::bind('user', function ($value, $route) {
            return Modules\Admin\Models\User::find($value);
        });

        Route::resource(
            'user',
            'UsersController',
            [
                'names' => [
                    'edit'    => 'user.edit',
                    'show'    => 'user.show',
                    'destroy' => 'user.destroy',
                    'update'  => 'user.update',
                    'store'   => 'user.store',
                    'index'   => 'user',
                    'create'  => 'user.create',
                ],
            ]
        );
       
       
       
    });
});
