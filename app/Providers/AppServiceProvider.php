<?php

namespace App\Providers;

use App\Models\BasicInfo;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Geography;
use App\Models\Page;
use App\Models\Pixel;
use App\Models\Slider;
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
            $topics = Category::where('status',1)->get();

            $settings = BasicInfo::first();

            $view->with([
                'services' => $services,
                'usefulls' => $usefulls,
                'settings' => $settings,
                'topics' => $topics
            ]);
        });

        View()->composer('admin.include.topbar', function ($view) {

            $settings = BasicInfo::first();

            $view->with([
                'settings' => $settings,
            ]);
        });

        View()->composer('frontend.includes.header', function ($view) {
            $categories = Category::where('status', 1)->get();

            $view->with([
                'categories' => $categories,

            ]);
        });

//      Hero
        View()->composer('frontend.includes.hero', function ($view) {
            $hero = Slider::first();

            $view->with([
                'hero' => $hero,

            ]);
        });

        //Geography
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,

            ]);
        });

        //history
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,

            ]);
        });

        //tradition
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,

            ]);
        });

        //lives
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,

            ]);
        });

        //technology
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,
            ]);
        });

        //migration
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,
            ]);
        });

        //collision
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,
            ]);
        });

        //Geography
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,
            ]);
        });

        //Geography
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,
            ]);
        });

        //Geography
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,

            ]);
        });

        //Geography
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,

            ]);
        });
        //Geography
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,

            ]);
        });
        //Geography
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,

            ]);
        });
        //Geography
        View()->composer('frontend.includes.geography', function ($view) {
            $geography = Geography::first();

            $view->with([
                'geography' => $geography,

            ]);
        });


    }
}
