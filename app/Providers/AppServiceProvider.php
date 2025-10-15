<?php

namespace App\Providers;

use App\Models\BasicInfo;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ChinaMigration;
use App\Models\Collision;
use App\Models\Community;
use App\Models\Contemporary;
use App\Models\Geography;
use App\Models\History;
use App\Models\Live;
use App\Models\Modern;
use App\Models\Page;
use App\Models\Pixel;
use App\Models\Political;
use App\Models\Slider;
use App\Models\Tag;
use App\Models\Technology;
use App\Models\Tradition;
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
        View()->composer('frontend.includes.history', function ($view) {
            $history = History::first();

            $view->with([
                'history' => $history,
            ]);
        });

        //tradition
        View()->composer('frontend.includes.traditional', function ($view) {
            $tradition = Tradition::first();

            $view->with([
                'tradition' => $tradition,
            ]);
        });

        //lives
        View()->composer('frontend.includes.live', function ($view) {
            $live = Live::first();

            $view->with([
                'live' => $live,
            ]);
        });

        //technology
        View()->composer('frontend.includes.technology', function ($view) {
            $technology = Technology::first();

            $view->with([
                'technology' => $technology,
            ]);
        });

        //migration
        View()->composer('frontend.includes.migration', function ($view) {
            $migration = ChinaMigration::first();

            $view->with([
                'migration' => $migration,
            ]);
        });

        //collision
        View()->composer('frontend.includes.collision', function ($view) {
            $collision = Collision::first();

            $view->with([
                'collision' => $collision,
            ]);
        });

        //modern
        View()->composer('frontend.includes.modern', function ($view) {
            $modern = Modern::first();

            $view->with([
                'modern' => $modern,
            ]);
        });

        //Contemporary
        View()->composer('frontend.includes.Contemporary', function ($view) {
            $contemporary = Contemporary::first();

            $view->with([
                'contemporary' => $contemporary,
            ]);
        });

        //Political System
        View()->composer('frontend.includes.political', function ($view) {
            $political = Political::first();

            $view->with([
                'political' => $political,
            ]);
        });

        //Community
        View()->composer('frontend.includes.community', function ($view) {
            $community = Community::first();

            $view->with([
                'community' => $community,

            ]);
        });

    }
}
