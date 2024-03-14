<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\NivelController;
use App\Http\Controllers\Api\AsistenciaController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Api\InscripcionController;
use App\Http\Controllers\Api\EspecialidadController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ForgotPasswordController;

Route::post('forget-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forget.password.post');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.reset');
Route::get('tasks',[TaskController::class,'index']);
Route::post('tasks', [TaskController::class, 'store']);
Route::put('tasks/{id}',[TaskController::class,'update']);


Route::get('nivel',[NivelController::class,'index']);
Route::post('nivel', [NivelController::class, 'store']);
//--------------------------------------------------------------------------------------------------------------------------------
Route::get('inscripcion',[InscripcionController::class,'index']);
Route::post('inscripcion', [InscripcionController::class, 'store']);
//----------------------------------------------------------------------------------------------------------------------------------
Route::get('asistencia', [AsistenciaController::class, 'index']);
Route::post('asistencia',[AsistenciaController::class,'store']);
Route::put('asistencia/{id}',[AsistenciaController::class,'update']);
//-------------------------------------------------------------------------------------------------------------------------------------
Route::get('especialidad',[EspecialidadController::class,'index']);
Route::post('especialidad',[EspecialidadController::class,'store']);


Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::apiResource('users', UserController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('roles', RoleController::class);
    //Route::apiResource('exercises', ExerciseController::class);
    Route::post('exercises/', [ExerciseController::class,'store']); //Guardar
    Route::get('exercises', [ExerciseController::class,'index']); //Listar
    Route::get('exercises/{exercise}', [ExerciseController::class,'show']); //Mostrar
    Route::post('exercises/update/{id}', [ExerciseController::class,'update']); //Editar

    Route::get('role-list', [RoleController::class, 'getList']);
    Route::get('role-permissions/{id}', [PermissionController::class, 'getRolePermissions']);
    Route::put('/role-permissions', [PermissionController::class, 'updateRolePermissions']);
    Route::apiResource('permissions', PermissionController::class);
    Route::get('category-list', [CategoryController::class, 'getList']);
    Route::get('/user', [ProfileController::class, 'user']);
    Route::put('/user', [ProfileController::class, 'update']);

    Route::get('abilities', function(Request $request) {
        return $request->user()->roles()->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();
    });
});


Route::get('category-list', [CategoryController::class, 'getList']);
Route::get('get-posts', [PostController::class, 'getPosts']);
Route::get('get-category-posts/{id}', [PostController::class, 'getCategoryByPosts']);
Route::get('get-post/{id}', [PostController::class, 'getPost']);
