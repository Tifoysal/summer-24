<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\WishList;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        Paginator::useBootstrap();
        $all_categories=[];

        if(Schema::hasTable('categories'))
        {
            $all_categories=Category::where('parent_id',null)->get();
            $app_setting=Setting::find(1);
        }

      
        view()->share('categories',$all_categories);
        view()->share('setting',$app_setting);
    }
}
