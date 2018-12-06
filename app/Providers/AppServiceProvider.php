<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //打印mysql日志 适合本地调试
        if (config('app.env') == "local"){
            DB::listen(
                function ($sql) {
                    foreach ($sql->bindings as $i => $binding) {
                        if ($binding instanceof \DateTime) {
                            $sql->bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                        } else {
                            if (is_string($binding)) {
                                $sql->bindings[$i] = "'$binding'";
                            }
                        }
                    }
                    // Insert bindings into query
                    $query = str_replace(array('%', '?'), array('%%', '%s'), $sql->sql);
                    $query = vsprintf($query, $sql->bindings);
                    if (config('app.env') == 'local') {
                        // Save the query to file
                        @file_put_contents(storage_path('logs' . DIRECTORY_SEPARATOR . date('Y-m-d') . '_query.log'), date('Y-m-d H:i:s') . ': ' . $query . ' 【耗时：' . $sql->time . 'ms】' . PHP_EOL, FILE_APPEND);
                    } else {
                        if ($sql->time > 1000) {
                            // Save the query to file
                            @file_put_contents(storage_path('logs' . DIRECTORY_SEPARATOR . date('Y-m-d') . '_query.log'), date('Y-m-d H:i:s') . ': ' . $query . ' 【耗时：' . $sql->time . 'ms】' . PHP_EOL, FILE_APPEND);
                        }
                    }
                }
            );
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
