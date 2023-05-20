<?php

use Illuminate\Support\Facades\Route;

Route::group([
  'prefix'     => 'admin',
  'namespace'  => 'Admin',
  'as'         => 'admin.',
  'middleware' => ['web-cors'],
], function () {

  Route::get('/lang/{lang}', 'AuthController@SetLanguage');

  Route::get('login', 'AuthController@showLoginForm')->name('show.login')->middleware('guest:admin');
  Route::post('login', 'AuthController@login')->name('login');
  Route::get('logout', 'AuthController@logout')->name('logout');

  Route::post('getCities', 'CityController@getCities')->name('getCities');

  Route::group(['middleware' => ['admin', 'check-role', 'admin-lang']], function () {

    /*------------ start Of Dashboard----------*/
      Route::get('dashboard', [
        'uses'      => 'HomeController@dashboard',
        'as'        => 'dashboard',
        'icon'      => '<i class="feather icon-home"></i>',
        'title'     => 'الرئيسيه',
        'sub_route' => false,
        'type'      => 'parent',
      ]);
    /*------------ end Of dashboard ----------*/


    /*------------ start Of users Controller ----------*/

      Route::get('clients', [
        'uses'  => 'ClientController@index',
        'as'        => 'clients.index',
        'icon'      => '<i class="feather icon-users"></i>',
        'title'     => 'المستخدمين',
        'type'      => 'parent',
        'child'     => ['clients.show', 'clients.store', 'clients.update', 'clients.delete', 'clients.deleteAll', 'clients.create', 'clients.edit'],
      ]);

      # clients store
      Route::get('clients/create', [
        'uses'  => 'ClientController@create',
        'as'    => 'clients.create', 'clients.edit',
        'title' => ' صفحة اضافة عميل',
      ]);

      # clients update
      Route::get('clients/{id}/edit', [
        'uses'  => 'ClientController@edit',
        'as'    => 'clients.edit',
        'title' => 'صفحه تحديث عميل',
      ]);
      #store
      Route::post('clients/store', [
        'uses'  => 'ClientController@store',
        'as'    => 'clients.store',
        'title' => 'اضافة عميل',
      ]);

      #update
      Route::put('clients/{id}', [
        'uses'  => 'ClientController@update',
        'as'    => 'clients.update',
        'title' => 'تعديل عميل',
      ]);

      Route::get('clients/{id}/show', [
        'uses'  => 'ClientController@show',
        'as'    => 'clients.show',
        'title' => 'عرض عميل',
      ]);

      #delete
      Route::delete('clients/{id}', [
        'uses'  => 'ClientController@destroy',
        'as'    => 'clients.delete',
        'title' => 'حذف عميل',
      ]);

      #delete
      Route::post('delete-all-clients', [
        'uses'  => 'ClientController@destroyAll',
        'as'    => 'clients.deleteAll',
        'title' => 'حذف مجموعه من العملاء',
      ]);

      /************ #Clients ************/
    /*------------ end Of users Controller ----------*/

    /************ Admins ************/
      #index
      Route::get('admins', [
        'uses'  => 'AdminController@index',
        'as'    => 'admins.index',
        'title' => 'المشرفين',
        'icon'  => '<i class="feather icon-users"></i>',
        'type'  => 'parent',
        'child' => [
          'admins.index', 'admins.store', 'admins.update', 'admins.edit', 'admins.delete', 'admins.deleteAll', 'admins.create', 'admins.edit', 'admins.notifications', 'admins.notifications.delete', 'admins.show',
        ],
      ]);

      # admins store
      Route::get('show-notifications', [
        'uses'  => 'AdminController@notifications',
        'as'    => 'admins.notifications',
        'title' => 'صفحة الاشعارات',
      ]);

      # admins store
      Route::post('delete-notifications', [
        'uses'  => 'AdminController@deleteNotifications',
        'as'    => 'admins.notifications.delete',
        'title' => 'حذف الاشعارات',
      ]);

      # admins store
      Route::get('admins/create', [
        'uses'  => 'AdminController@create',
        'as'    => 'admins.create',
        'title' => ' صفحة اضافة مشرف',
      ]);

      #store
      Route::post('admins/store', [
        'uses'  => 'AdminController@store',
        'as'    => 'admins.store',
        'title' => 'اضافة مشرف',
      ]);

      # admins update
      Route::get('admins/{id}/edit', [
        'uses'  => 'AdminController@edit',
        'as'    => 'admins.edit',
        'title' => 'صفحه تحديث مشرف',
      ]);
      #update
      Route::put('admins/{id}', [
        'uses'  => 'AdminController@update',
        'as'    => 'admins.update',
        'title' => 'تعديل مشرف',
      ]);

      Route::get('admins/{id}/show', [
        'uses'  => 'AdminController@show',
        'as'    => 'admins.show',
        'title' => 'عرض مشرف',
      ]);

      #delete
      Route::delete('admins/{id}', [
        'uses'  => 'AdminController@destroy',
        'as'    => 'admins.delete',
        'title' => 'حذف مشرف',
      ]);

      #delete
      Route::post('delete-all-admins', [
        'uses'  => 'AdminController@destroyAll',
        'as'    => 'admins.deleteAll',
        'title' => 'حذف مجموعه من المشرفين',
      ]);

    /************ #Admins ************/

//    /*------------ start Of notifications ----------*/
//      Route::get('notifications', [
//        'uses'      => 'NotificationController@index',
//        'as'        => 'notifications.index',
//        'title'     => 'الاشعارات',
//        'icon'      => '<i class="ficon feather icon-bell"></i>',
//        'type'      => 'parent',
//        'sub_route' => false,
//        'child'     => ['notifications.send'],
//      ]);
//
//      # coupons store
//      Route::post('send-notifications', [
//        'uses'  => 'NotificationController@sendNotifications',
//        'as'    => 'notifications.send',
//        'title' => ' ارسال اشعار او بريد للعميل',
//      ]);
//      /*------------ end Of notifications ----------*/

      /*------------ start Of countries ----------*/
      Route::get('countries', [
        'uses'      => 'CountryController@index',
        'as'        => 'countries.index',
        'title'     => 'الدول',
        'icon'      => '<i class="feather icon-flag"></i>',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => ['countries.show', 'countries.create', 'countries.store', 'countries.edit', 'countries.update', 'countries.delete', 'countries.deleteAll'],
      ]);

      Route::get('countries/{id}/show', [
        'uses'  => 'CountryController@show',
        'as'    => 'countries.show',
        'title' => 'عرض دوله ',
      ]);

      # countries store
      Route::get('countries/create', [
        'uses'  => 'CountryController@create',
        'as'    => 'countries.create',
        'title' => ' صفحة اضافة دوله ',
      ]);

      # countries store
      Route::post('countries/store', [
        'uses'  => 'CountryController@store',
        'as'    => 'countries.store',
        'title' => ' اضافة دوله ',
      ]);

      # countries update
      Route::get('countries/{id}/edit', [
        'uses'  => 'CountryController@edit',
        'as'    => 'countries.edit',
        'title' => 'صفحه تحديث دوله ',
      ]);

      # countries update
      Route::put('countries/{id}', [
        'uses'  => 'CountryController@update',
        'as'    => 'countries.update',
        'title' => 'تحديث دوله ',
      ]);

      # countries delete
      Route::delete('countries/{id}', [
        'uses'  => 'CountryController@destroy',
        'as'    => 'countries.delete',
        'title' => 'حذف دوله ',
      ]);
      #delete all countries
      Route::post('delete-all-countries', [
        'uses'  => 'CountryController@destroyAll',
        'as'    => 'countries.deleteAll',
        'title' => 'حذف مجموعه من الدول',
      ]);
    /*------------ end Of countries ----------*/

    /*------------ start Of cities ----------*/
      Route::get('cities', [
        'uses'      => 'CityController@index',
        'as'        => 'cities.index',
        'title'     => 'المحافظات ',
        'icon'      => '<i class="feather icon-globe"></i>',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => ['cities.create', 'cities.store', 'cities.edit','cities.show', 'cities.update', 'cities.delete', 'cities.deleteAll'],
      ]);

      # cities store
      Route::get('cities/create', [
        'uses'  => 'CityController@create',
        'as'    => 'cities.create',
        'title' => ' صفحة اضافة محافظه',
      ]);

      # cities store
      Route::post('cities/store', [
        'uses'  => 'CityController@store',
        'as'    => 'cities.store',
        'title' => ' اضافة محافظه',
      ]);

      # cities update
      Route::get('cities/{id}/edit', [
        'uses'  => 'CityController@edit',
        'as'    => 'cities.edit',
        'title' => 'صفحه تحديث محافظه',
      ]);

      # cities update
      Route::put('cities/{id}', [
        'uses'  => 'CityController@update',
        'as'    => 'cities.update',
        'title' => 'تحديث محافظه',
      ]);

      Route::get('cities/{id}/show', [
        'uses'  => 'CityController@show',
        'as'    => 'cities.show',
        'title' => 'عرض محافظه',
      ]);

      # cities delete
      Route::delete('cities/{id}', [
        'uses'  => 'CityController@destroy',
        'as'    => 'cities.delete',
        'title' => 'حذف محافظه',
      ]);
      #delete all cities
      Route::post('delete-all-cities', [
        'uses'  => 'CityController@destroyAll',
        'as'    => 'cities.deleteAll',
        'title' => 'حذف مجموعه من المحافظات',
      ]);
    /*------------ end Of cities ----------*/

    /*------------ start Of categories ----------*/
      Route::get('categories-show/{id?}', [
        'uses'      => 'CategoryController@index',
        'as'        => 'categories.index',
        'title'     => 'التصنيفات',
        'icon'      => '<i class="feather icon-list"></i>',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => ['categories.export','categories.create', 'categories.store', 'categories.edit', 'categories.update', 'categories.delete', 'categories.deleteAll', 'categories.show'],
      ]);

      # categories store
      Route::get('categories/export', [
        'uses'  => 'CategoryController@export',
        'as'    => 'categories.export',
        'title' => ' تصدير ',
      ]);
      # categories store
      Route::get('categories/create/{id?}', [
        'uses'  => 'CategoryController@create',
        'as'    => 'categories.create',
        'title' => ' صفحة اضافة تصنيف',
      ]);

      # categories store
      Route::post('categories/store', [
        'uses'  => 'CategoryController@store',
        'as'    => 'categories.store',
        'title' => ' اضافة تصنيف',
      ]);

      # categories update
      Route::get('categories/{id}/edit', [
        'uses'  => 'CategoryController@edit',
        'as'    => 'categories.edit',
        'title' => 'صفحه تحديث تصنيف',
      ]);

      # categories update
      Route::put('categories/{id}', [
        'uses'  => 'CategoryController@update',
        'as'    => 'categories.update',
        'title' => 'تحديث تصنيف',
      ]);

      Route::get('categories/{id}/show', [
        'uses'  => 'CategoryController@show',
        'as'    => 'categories.show',
        'title' => 'عرض تصنيف',
      ]);

      # categories delete
      Route::delete('categories/{id}', [
        'uses'  => 'CategoryController@destroy',
        'as'    => 'categories.delete',
        'title' => 'حذف تصنيف',
      ]);
      #delete all categories
      Route::post('delete-all-categories', [
        'uses'  => 'CategoryController@destroyAll',
        'as'    => 'categories.deleteAll',
        'title' => 'حذف مجموعه من التصنيفات',
      ]);
    /*------------ end Of categories ----------*/

    /*------------ start Of coupons ----------*/
      Route::get('coupons', [
        'uses'      => 'CouponController@index',
        'as'        => 'coupons.index',
        'title'     => 'كوبونات الخصم',
        'icon'      => '<i class="fa fa-gift"></i>',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => ['coupons.show', 'coupons.create', 'coupons.store', 'coupons.edit', 'coupons.update', 'coupons.delete', 'coupons.deleteAll', 'coupons.renew'],
      ]);

      Route::get('coupons/{id}/show', [
        'uses'  => 'CouponController@show',
        'as'    => 'coupons.show',
        'title' => 'عرض  كوبون خصم',
      ]);

      # coupons store
      Route::get('coupons/create', [
        'uses'  => 'CouponController@create',
        'as'    => 'coupons.create',
        'title' => ' صفحة اضافة كوبون خصم',
      ]);

      # coupons store
      Route::post('coupons/store', [
        'uses'  => 'CouponController@store',
        'as'    => 'coupons.store',
        'title' => ' اضافة كوبون خصم',
      ]);

      # coupons update
      Route::get('coupons/{id}/edit', [
        'uses'  => 'CouponController@edit',
        'as'    => 'coupons.edit',
        'title' => 'صفحه تحديث كوبون خصم',
      ]);

      # coupons update
      Route::put('coupons/{id}', [
        'uses'  => 'CouponController@update',
        'as'    => 'coupons.update',
        'title' => 'تحديث كوبون خصم',
      ]);

      # renew coupon
      Route::post('coupons/renew', [
        'uses'  => 'CouponController@renew',
        'as'    => 'coupons.renew',
        'title' => 'تحديث حالة كوبون خصم',
      ]);

      # coupons delete
      Route::delete('coupons/{id}', [
        'uses'  => 'CouponController@destroy',
        'as'    => 'coupons.delete',
        'title' => 'حذف كوبون خصم',
      ]);
      #delete all coupons
      Route::post('delete-all-coupons', [
        'uses'  => 'CouponController@destroyAll',
        'as'    => 'coupons.deleteAll',
        'title' => 'حذف مجموعه من كوبونات الخصم',
      ]);
    /*------------ end Of coupons ----------*/



    /*------------ start Of images ----------*/
      Route::get('images', [
        'uses'      => 'ImageController@index',
        'as'        => 'images.index',
        'title'     => 'البنرات الاعلانية',
        'icon'      => '<i class="feather icon-image"></i>',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => ['images.show', 'images.create', 'images.store', 'images.edit', 'images.update', 'images.delete', 'images.deleteAll'],
      ]);
      Route::get('images/{id}/show', [
        'uses'  => 'ImageController@show',
        'as'    => 'images.show',
        'title' => 'عرض   بانر اعلاني',
      ]);
      # images store
      Route::get('images/create', [
        'uses'  => 'ImageController@create',
        'as'    => 'images.create',
        'title' => ' صفحة اضافة بانر اعلاني',
      ]);

      # images store
      Route::post('images/store', [
        'uses'  => 'ImageController@store',
        'as'    => 'images.store',
        'title' => ' اضافة بانر اعلاني',
      ]);

      # images update
      Route::get('images/{id}/edit', [
        'uses'  => 'ImageController@edit',
        'as'    => 'images.edit',
        'title' => 'صفحه تحديث بانر اعلاني',
      ]);

      # images update
      Route::put('images/{id}', [
        'uses'  => 'ImageController@update',
        'as'    => 'images.update',
        'title' => 'تحديث بانر اعلاني',
      ]);

      # images delete
      Route::delete('images/{id}', [
        'uses'  => 'ImageController@destroy',
        'as'    => 'images.delete',
        'title' => 'حذف بانر اعلاني',
      ]);
      #delete all images
      Route::post('delete-all-images', [
        'uses'  => 'ImageController@destroyAll',
        'as'    => 'images.deleteAll',
        'title' => 'حذف مجموعه من البنرات الاعلانية',
      ]);
    /*------------ end Of images ----------*/

    /*------------ start Of socials ----------*/
      Route::get('socials', [
        'uses'      => 'SocialController@index',
        'as'        => 'socials.index',
        'title'     => 'وسائل التواصل',
        'icon'      => '<i class="feather icon-message-circle"></i>',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => ['socials.show', 'socials.create', 'socials.store', 'socials.show', 'socials.update', 'socials.edit', 'socials.delete', 'socials.deleteAll'],
      ]);
      # socials update
      Route::get('socials/{id}/Show', [
        'uses'  => 'SocialController@show',
        'as'    => 'socials.show',
        'title' => 'صفحه عرض وسيلة تواصل  ',
      ]);
      # socials store
      Route::get('socials/create', [
        'uses'  => 'SocialController@create',
        'as'    => 'socials.create',
        'title' => ' صفحة اضافة تواصل',
      ]);

      # socials store
      Route::post('socials', [
        'uses'  => 'SocialController@store',
        'as'    => 'socials.store',
        'title' => ' اضافة تواصل',
      ]);
      # socials update
      Route::get('socials/{id}/edit', [
        'uses'  => 'SocialController@edit',
        'as'    => 'socials.edit',
        'title' => 'صفحه تحديث تواصل',
      ]);
      # socials update
      Route::put('socials/{id}', [
        'uses'  => 'SocialController@update',
        'as'    => 'socials.update',
        'title' => 'تحديث تواصل',
      ]);

      # socials delete
      Route::delete('socials/{id}', [
        'uses'  => 'SocialController@destroy',
        'as'    => 'socials.delete',
        'title' => 'حذف تواصل',
      ]);

      #delete all socials
      Route::post('delete-all-socials', [
        'uses'  => 'SocialController@destroyAll',
        'as'    => 'socials.deleteAll',
        'title' => 'حذف مجموعه من وسائل التواصل',
      ]);
    /*------------ end Of socials ----------*/

    /*------------ start Of complaints ----------*/
      Route::get('all-complaints', [
        'as'        => 'all_complaints',
        'uses'      => 'ComplaintController@index',
        'icon'      => '<i class="feather icon-mail"></i>',
        'title'     => 'الشكاوي والمقترحات',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => [
          'complaints.delete', 'complaints.deleteAll', 'complaints.show', 'complaint.replay',
        ],
      ]);

      # complaint replay
      Route::post('complaints-replay/{id}', [
        'uses'  => 'ComplaintController@replay',
        'as'    => 'complaint.replay',
        'title' => 'رد علي شكوي او مقترح',
      ]);
      # socials update
      Route::get('complaints/{id}', [
        'uses'  => 'ComplaintController@show',
        'as'    => 'complaints.show',
        'title' => 'صفحه عرض شكوي',
      ]);
      # complaints delete
      Route::delete('complaints/{id}', [
        'uses'  => 'ComplaintController@destroy',
        'as'    => 'complaints.delete',
        'title' => 'حذف شكوي',
      ]);

      #delete all complaints
      Route::post('delete-all-complaints', [
        'uses'  => 'ComplaintController@destroyAll',
        'as'    => 'complaints.deleteAll',
        'title' => 'حذف مجموعه من الشكاوي',
      ]);
    /*------------ end Of complaints ----------*/


    /*------------ start Of reports----------*/
      Route::get('reports', [
        'uses'      => 'ReportController@index',
        'as'        => 'reports',
        'icon'      => '<i class="feather icon-edit-2"></i>',
        'title'     => 'التقارير',
        'type'      => 'parent',
        'sub_route' => false,
        'child'     => ['reports.delete', 'reports.deleteAll', 'reports.show'],
      ]);

      # reports show
      Route::get('reports/{id}', [
        'uses'  => 'ReportController@show',
        'as'    => 'reports.show',
        'title' => 'عرض تقرير',
      ]);
      # reports delete
      Route::delete('reports/{id}', [
        'uses'  => 'ReportController@destroy',
        'as'    => 'reports.delete',
        'title' => 'حذف تقرير',
      ]);

      #delete all reports
      Route::post('delete-all-reports', [
        'uses'  => 'ReportController@destroyAll',
        'as'    => 'reports.deleteAll',
        'title' => 'حذف مجموعه من التقارير',
      ]);
    /*------------ end Of reports ----------*/

    /*------------ start Of Roles----------*/
      Route::get('roles', [
        'uses'  => 'RoleController@index',
        'as'    => 'roles.index',
        'title' => 'قائمة الصلاحيات',
        'icon'  => '<i class="feather icon-eye"></i>',
        'type'  => 'parent',
        'child' => [
          'roles.index', 'roles.create', 'roles.store', 'roles.edit', 'roles.update', 'roles.delete',
        ],
      ]);

      #add role page
      Route::get('roles/create', [
        'uses'  => 'RoleController@create',
        'as'    => 'roles.create',
        'title' => 'اضافة صلاحيه',

      ]);

      #store role
      Route::post('roles/store', [
        'uses'  => 'RoleController@store',
        'as'    => 'roles.store',
        'title' => 'تمكين اضافة صلاحيه',
      ]);

      #edit role page
      Route::get('roles/{id}/edit', [
        'uses'  => 'RoleController@edit',
        'as'    => 'roles.edit',
        'title' => 'تعديل صلاحيه',
      ]);

      #update role
      Route::put('roles/{id}', [
        'uses'  => 'RoleController@update',
        'as'    => 'roles.update',
        'title' => 'تمكين تعديل صلاحيه',
      ]);

      #delete role
      Route::delete('roles/{id}', [
        'uses'  => 'RoleController@destroy',
        'as'    => 'roles.delete',
        'title' => 'حذف صلاحيه',
      ]);
    /*------------ end Of Roles----------*/

    /*------------ start Of Settings----------*/
      Route::get('settings', [
        'uses'  => 'SettingController@index',
        'as'    => 'settings.index',
        'title' => 'الاعدادات',
        'icon'  => '<i class="feather icon-settings"></i>',
        'type'  => 'parent',
        'child' => [
          'settings.index', 'settings.update', 'settings.message.all', 'settings.message.one', 'settings.send_email',
        ],
      ]);

      #update
      Route::put('settings', [
        'uses'  => 'SettingController@update',
        'as'    => 'settings.update',
        'title' => 'تحديث الاعدادات',
      ]);

      #message all
      Route::post('settings/{type}/message-all', [
        'uses'  => 'SettingController@messageAll',
        'as'    => 'settings.message.all',
        'title' => 'مراسلة الجميع',
      ])->where('type', 'email|sms|notification');

      #message one
      Route::post('settings/{type}/message-one', [
        'uses'  => 'SettingController@messageOne',
        'as'    => 'settings.message.one',
        'title' => 'مراسلة مستخدم',
      ])->where('type', 'email|sms|notification');

      #send email
      Route::post('settings/send-email', [
        'uses'  => 'SettingController@sendEmail',
        'as'    => 'settings.send_email',
        'title' => 'ارسال ايميل',
      ]);
    /*------------ end Of Settings ----------*/                     
    
    
    /*------------ start Of products ----------*/
        Route::get('products', [
            'uses'      => 'ProductController@index',
            'as'        => 'products.index',
            'title'     => 'المنتجات',
            'icon'      => '<i class="feather icon-image"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['products.create', 'products.store','products.edit', 'products.update', 'products.show', 'products.delete'  ,'products.deleteAll' ,]
        ]);

        # products store
        Route::get('products/create', [
            'uses'  => 'ProductController@create',
            'as'    => 'products.create',
            'title' => ' صفحة اضافة منتج'
        ]);
        

        # products store
        Route::post('products/store', [
            'uses'  => 'ProductController@store',
            'as'    => 'products.store',
            'title' => ' اضافة منتج'
        ]);

        # products update
        Route::get('products/{id}/edit', [
            'uses'  => 'ProductController@edit',
            'as'    => 'products.edit',
            'title' => 'صفحه تحديث منتج'
        ]);

        # products update
        Route::put('products/{id}', [
            'uses'  => 'ProductController@update',
            'as'    => 'products.update',
            'title' => 'تحديث منتج'
        ]);

        # products show
        Route::get('products/{id}/Show', [
            'uses'  => 'ProductController@show',
            'as'    => 'products.show',
            'title' => 'صفحه عرض  منتج  '
        ]);

        # products delete
        Route::delete('products/{id}', [
            'uses'  => 'ProductController@destroy',
            'as'    => 'products.delete',
            'title' => 'حذف منتج'
        ]);
        #delete all products
        Route::post('delete-all-products', [
            'uses'  => 'ProductController@destroyAll',
            'as'    => 'products.deleteAll',
            'title' => 'حذف مجموعه من منتجات'
        ]);
    /*------------ end Of products ----------*/
    #new_routes_here
                     
  });

});