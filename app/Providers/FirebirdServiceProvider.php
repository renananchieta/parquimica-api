<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\MySqlConnection;
use PDO;

class FirebirdServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Custom resolver for Firebird connection
        $this->app->resolving('db', function ($db) {
            $db->extend('firebird', function ($config) {
                $dsn = "firebird:dbname={$config['host']}/{$config['port']}:{$config['database']}";
                $pdo = new PDO($dsn, $config['username'], $config['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
                return new MySqlConnection($pdo, $config['database'], $config['prefix'], $config);
            });
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
