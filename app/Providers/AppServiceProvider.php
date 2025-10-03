<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use Illuminate\Support\Facades\View;

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
        //ページネーション
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        //カテゴリデータを全て共有
        View::share('categories', $this->shareCategories());
    }

    //カテゴリデータを全て共有
    private function shareCategories()
    {
        return Category::all();
    }
}
