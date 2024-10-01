<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\ColumnContract;
use App\Repositories\Contracts\GanttChartContract;
use App\Repositories\Contracts\StatusContract;
use App\Repositories\Contracts\SwimlaneContract;
use App\Repositories\Contracts\CommentContract;
use App\Repositories\Contracts\ProjectContract;
use App\Repositories\Contracts\TaskContract;
use App\Repositories\Contracts\TeamMemberContract;
use App\Repositories\Contracts\PriorityContract;
use App\Repositories\Contracts\RoleContract;
use App\Repositories\Contracts\UserContract;
use App\Repositories\Contracts\ScheduleContract;
use App\Repositories\Contracts\ActualDateContract;
use App\Repositories\Contracts\PlanDateContract;
use App\Repositories\ActualDateRepository;
use App\Repositories\PlanDateRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\ColumnRepository;
use App\Repositories\GanttChartRepository;
use App\Repositories\StatusRepository;
use App\Repositories\SwimlaneRepository;
use App\Repositories\CommentRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TaskRepository;
use App\Repositories\TeamMemberRepository;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
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
        $this->app->bind(
            ColumnContract::class,
            ColumnRepository::class
        );
        $this->app->bind(
            SwimlaneContract::class,
            SwimlaneRepository::class
        );
        $this->app->bind(
            GanttChartContract::class,
            GanttChartRepository::class
        );
        $this->app->bind(
            ScheduleContract::class,
            ScheduleRepository::class
        );
        $this->app->bind(
            ActualDateContract::class,
            ActualDateRepository::class
        );
        $this->app->bind(
            PlanDateContract::class,
            PlanDateRepository::class
        );
    }
}