<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }


    public function register()
    {
        if(!\Doctrine\DBAL\Types\Type::hasType('uuid'))
        {
            \Doctrine\DBAL\Types\Type::addType('uuid', \Ramsey\Uuid\Doctrine\UuidType::class);
        }
    }
}
