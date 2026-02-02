<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Pagination\Paginator;

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
    public function boot()
{
    View::addNamespace('admin', resource_path('views/dashboard/pages/admin'));
    View::addNamespace('user', resource_path('views/dashboard/pages/user'));


    // $table->softDeleteWithMeta(); // ✅ adds all 3 automatically
     Blueprint::macro('softDeleteWithMeta', function () {
        $this->timestamp('deleted_at')->nullable(); // same as softDeletes but explicit
        $this->unsignedBigInteger('deleted_by')->nullable();
        $this->text('delete_reason')->nullable();
    });

     Paginator::useBootstrapFive(); 
}
}
