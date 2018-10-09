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

      
       
       /*------------Ads Type Model and controller---------*/

        Route::bind('adstype', function ($value, $route) {
            return Modules\Admin\Models\AdsType::find($value);
        });

        Route::resource(
            'adstype',
            'AdsTypeController',
            [
                'names' => [
                    'edit'    => 'adstype.edit',
                    'show'    => 'adstype.show',
                    'destroy' => 'adstype.destroy',
                    'update'  => 'adstype.update',
                    'store'   => 'adstype.store',
                    'index'   => 'adstype',
                    'create'  => 'adstype.create',
                ],
            ]
        );

        /*------------Delivery option Model and controller---------*/

        Route::bind('deliveryoption', function ($value, $route) {
            return Modules\Admin\Models\DeliveryOption::find($value);
        });

        Route::resource(
            'deliveryoption',
            'DeliveryOptionController',
            [
                'names' => [
                    'edit'    => 'deliveryoption.edit',
                    'show'    => 'deliveryoption.show',
                    'destroy' => 'deliveryoption.destroy',
                    'update'  => 'deliveryoption.update',
                    'store'   => 'deliveryoption.store',
                    'index'   => 'deliveryoption',
                    'create'  => 'deliveryoption.create',
                ],
            ]
        );

        /*------------Ads Type Model and controller---------*/

        Route::bind('deliverytype', function ($value, $route) {
            return Modules\Admin\Models\DeliveryType::find($value);
        });

        Route::resource(
            'deliverytype',
            'DeliveryTypeController',
            [
                'names' => [
                    'edit'    => 'deliverytype.edit',
                    'show'    => 'deliverytype.show',
                    'destroy' => 'deliverytype.destroy',
                    'update'  => 'deliverytype.update',
                    'store'   => 'deliverytype.store',
                    'index'   => 'deliverytype',
                    'create'  => 'deliverytype.create',
                ],
            ]
        );

         /*------------Contact User Model and controller---------*/

        Route::bind('contactuser', function ($value, $route) {
            return Modules\Admin\Models\AdsType::find($value);
        });

        Route::resource(
            'contactuser',
            'ContactUserController',
            [
                'names' => [
                    'edit'    => 'contactuser.edit',
                    'show'    => 'contactuser.show',
                    'destroy' => 'contactuser.destroy',
                    'update'  => 'contactuser.update',
                    'store'   => 'contactuser.store',
                    'index'   => 'contactuser',
                    'create'  => 'contactuser.create',
                ],
            ]
        );

        /*------------Category Model and controller---------*/

        Route::bind('categories', function($value, $route){
            return Modules\Admin\Models\Category::find($value);
        });

        Route::resource(
            'categories',
            'CategoryController',
            [
                'names' => [
                    'edit'    => 'categories.edit',
                    'show'    => 'categories.show',
                    'destroy' => 'categories.destroy',
                    'update'  => 'categories.update',
                    'store'   => 'categories.store',
                    'index'   => 'categories',
                    'create'  => 'categories.create',
                ],
            ]
        );
		
		// sub categories controller
        Route::bind('subcategories', function($value, $route){
            return Modules\Admin\Models\Category::find($value);
        });

        Route::resource(
            'subcategories',
            'SubCategoryController',
            [
                'names' => [
                    'edit'    => 'subcategories.edit',
                    'show'    => 'subcategories.show',
                    'destroy' => 'subcategories.destroy',
                    'update'  => 'subcategories.update',
                    'store'   => 'subcategories.store',
                    'index'   => 'subcategories',
                    'create'  => 'subcategories.create',
                ],
            ]
        );
		
		 // offer_type controller
        Route::bind('offer_type', function ($value, $route) {
            return Modules\Admin\Models\OfferType::find($value);
        });

        Route::resource(
            'offer_type',
            'OfferTypeController',
            [
                'names' => [
                    'edit'    => 'offer_type.edit',
                    'show'    => 'offer_type.show',
                    'destroy' => 'offer_type.destroy',
                    'update'  => 'offer_type.update',
                    'store'   => 'offer_type.store',
                    'index'   => 'offer_type',
                    'create'  => 'offer_type.create',
                ],
            ]
        );
		

     


        Route::bind('adminUser', function ($value, $route) {
            return Modules\Admin\Models\User::find($value);
        });

        Route::resource(
            'adminUser',
            'UsersController',
            [
                'names' => [
                    'edit'    => 'adminUser.edit',
                    'show'    => 'adminUser.show',
                    'destroy' => 'adminUser.destroy',
                    'update'  => 'adminUser.update',
                    'store'   => 'adminUser.store',
                    'index'   => 'adminUser',
                    'create'  => 'adminUser.create',
                ],
            ]
        );


        Route::bind('singleUser', function ($value, $route) {
            return Modules\Admin\Models\User::find($value);
        });

        Route::resource(
            'singleUser',
            'SingleUsersController',
            [
                'names' => [
                    'edit'    => 'singleUser.edit',
                    'show'    => 'singleUser.show',
                    'destroy' => 'singleUser.destroy',
                    'update'  => 'singleUser.update',
                    'store'   => 'singleUser.store',
                    'index'   => 'singleUser',
                    'create'  => 'singleUser.create',
                ],
            ]
        );

        Route::bind('advertiser', function ($value, $route) {
            return Modules\Admin\Models\User::find($value);
        });

        Route::resource(
            'advertiser',
            'AdvertiserController',
            [
                'names' => [
                    'edit'    => 'advertiser.edit',
                    'show'    => 'advertiser.show',
                    'destroy' => 'advertiser.destroy',
                    'update'  => 'advertiser.update',
                    'store'   => 'advertiser.store',
                    'index'   => 'advertiser',
                    'create'  => 'advertiser.create',
                ],
            ]
        );

       
       // wensite settings

        Route::bind('setting', function ($value, $route) {
            return Modules\Admin\Models\Settings::find($value);
        });

        Route::resource(
            'setting',
            'SettingsController',
            [
                'names' => [
                    'edit'      => 'setting.edit',
                    'show'      => 'setting.show',
                    'destroy'   => 'setting.destroy',
                    'update'    => 'setting.update',
                    'store'     => 'setting.store',
                    'index'     => 'setting',
                    'create'    => 'setting.create',
                ],
            ]
        );
       // category

        
        /*------------User Category and controller---------*/

        Route::bind('category', function ($value, $route) {
            return Modules\Admin\Models\Category::find($value);
        });

        Route::resource(
                'category',
                'CategoryController',
                [
                    'names' => [
                        'edit'      => 'category.edit',
                        'show'      => 'category.show',
                        'destroy'   => 'category.destroy',
                        'update'    => 'category.update',
                        'store'     => 'category.store',
                        'index'     => 'category',
                        'create'    => 'category.create',
                    ],
                ]
            );
        /*---------End---------*/


        /*------------User Category and controller---------*/

         Route::bind('sub-category', function($value, $route) {
             return Modules\Admin\Models\Category::find($value);
         });

         Route::resource('sub-category', 'SubCategoryController', [
             'names' => [
                 'edit' => 'sub-category.edit',
                 'show' => 'sub-category.show',
                 'destroy' => 'sub-category.destroy',
                 'update' => 'sub-category.update',
                 'store' => 'sub-category.store',
                 'index' => 'sub-category',
                 'create' => 'sub-category.create',
             ]
                 ]
         );
       
    });
});
