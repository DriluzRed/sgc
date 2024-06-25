<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $notifications = DB::table('notifications')->get();
        $nots_counter = 0;
        foreach ($notifications as $notification) {
            if ($notification->is_read == 0 && $notification->show_date == Carbon::now()->format('Y-m-d') && $notification->type != 'licitations'){
                $nots_counter++;
            }
            if($notification->type == 'licitations' && $notification->is_read == 0){
                $fourMonthsAgo = Carbon::now()->subMonths(4)->format('Y-m-d');
                if ($notification->show_date >= $fourMonthsAgo) {
                    $nots_counter++;
                }
            }
        }
        View::share('notifications', $notifications);
        View::share('nots_counter', $nots_counter);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
