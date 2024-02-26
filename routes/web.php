 <?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CustomController;
 use App\Http\Controllers\EditController;
 use App\Http\Controllers\FavController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
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









Route::prefix('/')->name('blog.')->controller(FavController::class)->group(function() {
    Route::post('/', 'toggleFavorite');
    Route::post('/article/{slug}-{post}', 'toggleFavorite')->where([
        'post' => '[0-9]+',
        'slug' => '[a-z0-9\-]+']
    );
    Route::get('/favorite', 'main_favorite')->name('fav');
});


Route::prefix('/')->name('blog.')->controller(SearchController::class)->group(function() {
    Route::get('/search','search')->name('search');
    Route::post('/search','doSearch');
    Route::post('/dosearch','doSearch');
});

Route::prefix('/')->name('auth.')->controller(AuthController::class)->group(function() {
    Route::get('/login', 'login')->name('login');
    Route::delete('/logout', 'logout')->name('logout');
    Route::post('/login', 'doLogin');
    Route::get('/register','register')->name('register');
    Route::post('/register','doRegister');
});


Route::prefix('/')->name('profile.')->controller(ProfileController::class)->group(function() {
    Route::get('/profile', 'mainProfile')->name('profile');
    Route::get('/edit', 'editProfile')->name('edit');
    Route::post('/edit', 'updateProfile');
    Route::get('/password', 'editPassword')->name('password');
    Route::post('/password', 'updatePassword');


});


 Route::prefix('/')->name('edit.')->controller(EditController::class)->group(function() {
     Route::get('/edit', 'editProfile')->name('edit');
     Route::post('/edit', 'updateProfile');
     Route::get('/password', 'editPassword')->name('password');
     Route::post('/password', 'updatePassword');

 });


Route::prefix('/')->name('blog.')->controller(BlogController::class)->group(function() {

    Route::get('/about', 'about')->name('about');
    Route::get('/', 'index')->name('index');
    Route::post('/cookie/create/update', 'createAndUpdate')->name('create-update');
    Route::get('/new', 'create')->name('create');
    Route::post('/new', 'store');
    Route::get('/article/{slug}-{post}', 'show')
        ->where([
            'post' => '[0-9]+',
            'slug' => '[a-z0-9\-]+'
        ])->name('show');
});


