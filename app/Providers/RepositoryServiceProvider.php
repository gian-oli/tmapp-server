<?php

namespace App\Providers;

use App\Repositories\Contracts\StatusContract;
use App\Repositories\StatusRepository;
use Illuminate\Support\ServiceProvider;

use App\Repositories\CommentRepository;
use App\Repositories\Contracts\CommentContract;
use App\Repositories\Contracts\ProjectContract;
use App\Repositories\Contracts\TaskContract;
use App\Repositories\Contracts\TeamMemberContract;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Repositories\TeamMemberRepository;
use App\Repositories\Contracts\UserContract;
use App\Repositories\UserRepository;
use App\Repositories\Contracts\RoleContract;
use App\Repositories\RoleRepository;
use App\Repositories\Contracts\PriorityContract;
use App\Repositories\PriorityRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserContract::class,
            UserRepository::class
        );
        $this->app->bind(
            ProjectContract::class,
            ProjectRepository::class
        );
        $this->app->bind(
            TaskContract::class,
            TaskRepository::class
        );
        $this->app->bind(
            TeamMemberContract::class,
            TeamMemberRepository::class
        );
        $this->app->bind(
            CommentContract::class,
            CommentRepository::class
        );
        $this->app->bind(
            RoleContract::class,
            RoleRepository::class
        );
        $this->app->bind(
            PriorityContract::class,
            PriorityRepository::class
        );
        $this->app->bind(
            StatusContract::class,
            StatusRepository::class
        );
    }
}