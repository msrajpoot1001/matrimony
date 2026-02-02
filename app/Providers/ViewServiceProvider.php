<?php
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\SeoPage;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $routeName = request()->route() ? request()->route()->getName() : null;

            // find SEO record matching the route name or slug
            $seo = SeoPage::where('page_name', $routeName)->first();

            $view->with('global_seo', $seo);
        });
    }
}
