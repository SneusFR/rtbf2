<?php

use App\Http\Controllers\BlogController;
use App\Models\Post;
use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

//    $menu = new menu();
//    $menu->title = "à PROPOS";
//    $menu->firstNav = true;
//    $menu->save();
//
    return menu::all();

    return Post::all();
        view('welcome');
});

#RouteRacine
Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(function() {

    Route::get('/', 'index')
        ->name('index');
    Route::get('/new', 'create')->name('create');
    Route::post('/new', 'store');
    Route::get('/{slug}-{post}', 'show')
        ->where([
            'post' => '[0-9]+',
            'slug' => '[a-z0-9\-]+'
        ])->name('show');
    Route::get('/{post}/{edit}', 'edit')->name('edit');
    Route::post('/{post}/{update}', 'edit')->name('edit');
});

