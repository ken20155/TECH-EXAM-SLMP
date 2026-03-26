<?php 
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Album;
use App\Models\Photo;
use App\Models\Todo;

Route::middleware('basic.static')->group(function () { //custom basic auth admin only
//Route::middleware('auth.basic')->group(function () { //per user access

    Route::get('/users', fn() => User::with(['address','company'])->get());
    Route::get('/posts', fn() => Post::all());
    Route::get('/comments', fn() => Comment::all());
    Route::get('/albums', fn() => Album::all());
    Route::get('/photos', fn() => Photo::all());
    Route::get('/todos', fn() => Todo::all());

});