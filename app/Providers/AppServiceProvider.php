<?php

namespace App\Providers;

use App\Application\Auth\Contracts\PasswordVerifier;
use App\Application\Auth\Contracts\TokenIssuer;
use App\Application\User\Contracts\PasswordHasher;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Infrastructure\Auth\LaravelPasswordVerifier;
use App\Infrastructure\Auth\SanctumTokenIssuer;
use App\Infrastructure\Persistence\Eloquent\Repositories\EloquentUserRepository;
use App\Infrastructure\User\LaravelPasswordHasher;
use App\Models\PersonalAccessToken;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(abstract: UserRepositoryInterface::class, concrete: EloquentUserRepository::class);
        $this->app->bind(abstract: PasswordHasher::class, concrete: LaravelPasswordHasher::class);
        $this->app->bind(abstract: PasswordVerifier::class, concrete: LaravelPasswordVerifier::class);
        $this->app->bind(abstract: TokenIssuer::class, concrete: SanctumTokenIssuer::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
