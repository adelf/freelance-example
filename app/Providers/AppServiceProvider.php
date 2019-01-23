<?php

namespace App\Providers;

use App\Infrastructure\DoctrineStrictObjectManager;
use App\Infrastructure\StrictObjectManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(StrictObjectManager::class, DoctrineStrictObjectManager::class);
    }

    public function register()
    {
        if(!\Doctrine\DBAL\Types\Type::hasType('uuid'))
        {
            \Doctrine\DBAL\Types\Type::addType('uuid', \Ramsey\Uuid\Doctrine\UuidType::class);
        }
    }
}
