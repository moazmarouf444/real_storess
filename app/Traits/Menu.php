<?php

namespace App\Traits;

trait menu {
  public function home() {

    $menu = [
      [
        'name'  => awtTrans('المشرفين'),
        'count' => \App\Models\Admin::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/admins'),
      ], [
        'name'  => awtTrans('المستخدمين '),
        'count' => \App\Models\User::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients'),
      ], [
        'name'  => awtTrans('المستخدمين النشطين'),
        'count' => \App\Models\User::where('active', 1)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients/active'),
      ], [
        'name'  => awtTrans('المستخدمين الغير نشطين'),
        'count' => \App\Models\User::where('active', 0)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients/not-active'),
      ], [
        'name'  => awtTrans('المستخدمين الغير محظورين'),
        'count' => \App\Models\User::where('is_blocked', 0)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients/not-block'),
      ], [
        'name'  => awtTrans('المستخدمين  المحظورين'),
        'count' => \App\Models\User::where('is_blocked', 1)->count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/clients/block'),
      ], [
        'name'  => awtTrans('وسائل التواصل'),
        'count' => \App\Models\Social::count(),
        'icon'  => 'icon-thumbs-up',
        'url'   => url('admin/socials'),
      ], [
        'name'  => awtTrans('الشكاوي والمقترحات'),
        'count' => \App\Models\Complaint::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/all-complaints'),
      ], [
        'name'  => awtTrans('التقارير'),
        'count' => \App\Models\LogActivity::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/reports'),
      ], [
        'name'  => awtTrans('البلاد'),
        'count' => \App\Models\Country::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/countries'),
      ], [
        'name'  => awtTrans('المدن'),
        'count' => \App\Models\City::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/cities'),
      ], [
        'name'  => awtTrans('الاسئلة الشائعة'),
        'count' => \App\Models\Fqs::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/fqs'),
      ], [
        'name'  => awtTrans('البنرات الاعلانية'),
        'count' => \App\Models\Image::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/images'),
      ], [
        'name'  => awtTrans('باقات الرسائل'),
        'count' => \App\Models\SMS::count(),
        'icon'  => 'icon-list',
        'url'   => url('admin/sms'),
      ], [
        'name'  => awtTrans('الصلاحيات'),
        'count' => \App\Models\Role::count(),
        'icon'  => 'icon-eye',
        'url'   => url('admin/roles'),
      ],
    ];

    return $menu;
  }

  public function introSiteCards() {
    $menu = [
      [
        'name'  => awtTrans('بنرات الاسلايدر'),
        'count' => \App\Models\IntroSlider::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introsliders'),
      ],
      [
        'name'  => awtTrans('سكشن خدماتنا'),
        'count' => \App\Models\IntroService::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introservices'),
      ],
      [
        'name'  => awtTrans('اقسام الاسئلة الشائعه'),
        'count' => \App\Models\IntroFqsCategory::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introfqscategories'),
      ],
      [
        'name'  => awtTrans(' الاسئلة الشائعه'),
        'count' => \App\Models\IntroFqs::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introfqs'),
      ],
      [
        'name'  => awtTrans('شركاء النجاح'),
        'count' => \App\Models\IntroPartener::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introparteners'),
      ],
      [
        'name'  => awtTrans('رسائل العملاء'),
        'count' => \App\Models\IntroMessages::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/intromessages'),
      ],
      [
        'name'  => awtTrans('وسائل التواصل'),
        'count' => \App\Models\IntroSocial::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introsocials'),
      ],
      [
        'name'  => awtTrans('قسم كيف نعمل'),
        'count' => \App\Models\IntroHowWork::count(),
        'icon'  => 'icon-users',
        'url'   => url('admin/introhowworks'),
      ],
    ];
    return $menu;
  }

}