<?php

namespace App\Providers;

use App\Models\BasicInfo;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Page;
use App\Models\Pixel;
use App\Models\Tag;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View()->composer('frontend.includes.footer', function ($view) {

            $usefulls = Page::where('status', 1)->where('type', 1)->get();
            $services = Page::where('status', 1)->where('type', 0)->get();

//            $settings = Cache ::rememberForever('settings',function ()
//            {
//                return  BasicInfo::first();
//            });

            $settings = BasicInfo::first();

            $view->with([
                'services' => $services,
                'usefulls' => $usefulls,
                'settings' => $settings,
            ]);
        });
    }
}
