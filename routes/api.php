<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'showAuthenticatedUser']);
    Route::get('users', [UserController::class, 'index']);
    Route::get('/load-projects-full', [ProjectController::class, 'loadProjectWithRelations']);
    Route::get('/show-project-full/{id}', [ProjectController::class, 'showProjectWithRelations']);
    Route::apiResource('/projects', ProjectController::class);
    Route::apiResource('/tasks', TaskController::class);
    Route::apiResource('/team-members', TeamMemberController::class);
    Route::apiResource('/comments', CommentController::class);
    Route::apiResource('/roles', RoleController::class);
    Route::apiResource('/statuses', StatusController::class);
    Route::apiResource('/priorities', PriorityController::class);
});
