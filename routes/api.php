<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MemberBlogController;
use App\Http\Controllers\Api\MemberLoginController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/blog', [MemberBlogController::class, 'index']);

Route::post('/login', [MemberLoginController::class, 'login']);
Route::post('/logout', [MemberLoginController::class, 'logout']);
Route::get('/index', [MemberLoginController::class, 'index']);
