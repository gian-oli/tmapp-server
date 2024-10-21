<?php

use App\Http\Controllers\ActualDateController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColumnController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GanttChartController;
use App\Http\Controllers\PlanDateController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SwimlaneController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::apiResource('/users', UserController::class);
// Route::apiResource('/projects', ProjectController::class);
// Route::apiResource('/tasks', TaskController::class);
// Route::apiResource('/team-members', TeamMemberController::class);
// Route::apiResource('/comments', CommentController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/role', [RoleController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/tasks', TaskController::class);
    Route::apiResource('/team-members', TeamMemberController::class);
    Route::apiResource('/comments', CommentController::class);
    Route::apiResource('/roles', RoleController::class);
    Route::apiResource('/statuses', StatusController::class);
    Route::apiResource('/priorities', PriorityController::class);
    Route::apiResource('/swimlane', SwimlaneController::class);
    Route::apiResource('/column', ColumnController::class);
    Route::apiResource('/projects', ProjectController::class);
    Route::apiResource('/gantt-chart', GanttChartController::class);
    Route::apiResource('/schedule', ScheduleController::class);
    Route::apiResource('/plan-date', PlanDateController::class);
    Route::apiResource('/actual-date', ActualDateController::class);
    
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'showAuthenticatedUser']);
    Route::get('users', [UserController::class, 'index']);
    Route::get('/load-projects-full', [ProjectController::class, 'loadProjectWithRelations']);
    Route::get('/show-project-full/{id}', [ProjectController::class, 'showProjectWithRelations']);
    Route::get('/my-projects/{id}', [ProjectController::class, 'loadMyProjects']);
    Route::put('/assign-member/{id}', [TaskController::class, 'assignMember']);
    Route::put('/change-column/{id}', [TaskController::class, 'changeColumn']);
    Route::post('/batch-tasks', [TaskController::class, 'batchStore']);
    // Route::put('/assign-swimlane/{id}', [TaskController::class, 'assignSwimlane']);
    Route::put('/backlog-to-ready/{swimlane_id}/{column_id}', [ColumnController::class, 'backlogToReady']);
    Route::put('/next-column/{swimlane_id}/{task_id}', [TaskController::class, 'nextColumn']);
    Route::put('previous-column/{swimlane_id}/{task_id}', [TaskController::class, 'previousColumn']);
});

Route::get('/test', function () {
    return User::all();
});
