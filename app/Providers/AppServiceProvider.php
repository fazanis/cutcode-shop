<?php

namespace App\Providers;


use App\Faker\ImagesFaker;
use App\Http\Kernel;
use Carbon\CarbonInterval;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Generator::class,function (){
            $faker = Factory::create();
            $faker->addProvider(new ImagesFaker($faker));
            return $faker;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict(!app()->isProduction());


        DB::listen(function ($query){
            if ($query->time>500){
                // $query->sql
                // $query->bindings
            }
        });

        $kernel = app(Kernel::class);
        $kernel->whenRequestLifecycleIsLongerThan(
            CarbonInterval::seconds(4),
            function (){

            }
        );
    }
}
