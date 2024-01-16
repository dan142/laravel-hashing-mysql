<?php
namespace Dan142\LaravelHashingMySql;

use Illuminate\Support\ServiceProvider;

class LaravelHashingMySQLServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('hash')->extend('mysqlpassword', function () {
            return new MySqlPasswordHasher();
        });

        app('hash')->extend('mysqloldpassword', function () {
            return new MySqlOldPasswordHasher();
        });
    }
}