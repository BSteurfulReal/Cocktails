<?php

namespace App\Providers;

use App\Events\Ingredients\IngredientDeleting;
use App\Listeners\Ingredients\CleanupChildModelsListener as CleanupChildModelsForIngredientListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {
	protected $listen = [
		Registered::class => [
			SendEmailVerificationNotification::class
		],
        IngredientDeleting::class => [
            CleanupChildModelsForIngredientListener::class,
        ],
	];
}
