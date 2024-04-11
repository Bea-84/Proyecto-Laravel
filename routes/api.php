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
use App\Http\Controllers\Api\ClaseController;
use App\Http\Controllers\Api\DiaController;
use App\Http\Controllers\Api\HorarioController;
use App\Http\Controllers\Api\TarifaController;
use App\Http\Controllers\Api\EstadoController;

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
Route::put('nivel/{id}',[NivelController::class,'update']);
Route::get('nivel/{id}',[NivelController::class,'show']);//esto es para conseguir los datos por su id 
Route::delete('nivel/{id}', [NivelController::class, 'destroy']);//esto es para eliminar los datos por su id
//--------------------------------------------------------------------------------------------------------------------------------
Route::get('inscripcion',[InscripcionController::class,'index']);
Route::post('inscripcion', [InscripcionController::class, 'store']);
Route::put('inscripcion/{id}', [InscripcionController::class, 'update']);
Route::get('inscripcion/{id}',[InscripcionController::class,'show']);//esto es para conseguir los datos por su id 
Route::delete('inscripcion/{id}', [InscripcionController::class, 'destroy']);//esto es para eliminar los datos por su id
//----------------------------------------------------------------------------------------------------------------------------------
Route::get('asistencia', [AsistenciaController::class, 'index']);
Route::post('asistencia',[AsistenciaController::class,'store']);
Route::put('asistencia/{id}',[AsistenciaController::class,'update']);
Route::get('asistencia/{id}',[AsistenciaController::class,'show']);//esto es para conseguir los datos por su id 
Route::delete('asistencia/{id}', [AsistenciaController::class, 'destroy']);//esto es para eliminar los datos por su id
//-------------------------------------------------------------------------------------------------------------------------------------
Route::get('clase',[ClaseController::class,'index']);
Route::post('clase',[ClaseController::class,'store']);
Route::put('clase/{id}', [ClaseController::class, 'update']);
Route::get('clase/{id}',[ClaseController::class,'show']);//esto es para conseguir los datos por su id
Route::delete('clase/{id}', [ClaseController::class, 'destroy']);//esto es para eliminar los datos por su id 
//--------------------------------------------------------------------------------------------------------------------------------------
//ruta para conseguir datos de tabla dias
Route::get('dia', [DiaController::class, 'index']);
//ruta para conseguir datos tabla horarios
Route::get('horario', [HorarioController::class, 'index']);
Route::get('horario/dia/{id}', [HorarioController::class, 'showday']);//con esto solo los seleccionados los horarios del dia seleccionado




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
