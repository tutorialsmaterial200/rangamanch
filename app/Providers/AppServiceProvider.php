<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
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

        try {
            $setting = Setting::pluck('value', 'key')->toArray();

            View::composer('*', function($view) use ($setting){
                $view->with('settings', $setting);
            });
        } catch (\Exception $e) {
            // Handle case when database tables haven't been migrated yet
            View::composer('*', function($view){
                $view->with('settings', []);
            });
        }

        // Add Blade directive for Nepali numerals
        Blade::directive('nepaliNum', function ($expression) {
            return "<?php echo convertToNepaliNumerals($expression); ?>";
        });
    }
}
