<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //بستخدمها لوبدي اضيف شغلة داخل  ال service contanier
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //بسسب عرض لارفيل البجنيشن من خلال مكتبة التيل وينت قلتله فهم لارفيل انه تستخدم البوت ستراب في عرض البجنيشن 
        //عملت الابلكيشن على مستوى كل الصفحات من خلال الدخول على المنطقة الي بنعمل فيها انشلايزيشن للابلكيشن 
        //Tailwind Library 
        Paginator::useBootstrapFive();
    }
}
