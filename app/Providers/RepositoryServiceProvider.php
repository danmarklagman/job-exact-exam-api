<?php

namespace App\Providers;

use App\Repositories\Entities\Album\AlbumRepositoryEloquent;
use App\Repositories\Entities\Album\AlbumRepositoryInterface;
use App\Repositories\Entities\Photo\PhotoRepositoryEloquent;
use App\Repositories\Entities\Photo\PhotoRepositoryInterface;
use App\Repositories\Entities\Role\RoleRepositoryEloquent;
use App\Repositories\Entities\Role\RoleRepositoryInterface;
use App\Repositories\Entities\User\UserRepositoryEloquent;
use App\Repositories\Entities\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Repositories mapping.
     *
     * @var array|string[] $repositories
     */
    protected array $repositories = [
        UserRepositoryInterface::class => UserRepositoryEloquent::class,
        RoleRepositoryInterface::class => RoleRepositoryEloquent::class,
        AlbumRepositoryInterface::class => AlbumRepositoryEloquent::class,
        PhotoRepositoryInterface::class => PhotoRepositoryEloquent::class,
    ];

    /**
     * Registering the repositories by binding its abstraction and concretion.
     */
    public function register(): void
    {
        foreach ($this->repositories as $abstraction => $concretion) {
            $this->app->bind($abstraction, $concretion);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
