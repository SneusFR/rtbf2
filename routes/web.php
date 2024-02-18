 <?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CustomController;
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
Route::prefix('/blog')->name('blog.')->controller(FavController::class)->group(function() {
    Route::post('/', 'toggleFavorite');
    Route::post('/{slug}-{post}', 'toggleFavorite')->where([
        'post' => '[0-9]+',
        'slug' => '[a-z0-9\-]+']
    );
    Route::get('/favorite', 'main_favorite')->name('fav');
});


Route::prefix('/blog')->name('blog.')->controller(SearchController::class)->group(function() {
    Route::get('/search','search')->name('search');
    Route::post('/search','doSearch');
    Route::post('/dosearch','doSearch');
});

Route::prefix('/auth')->name('auth.')->controller(AuthController::class)->group(function() {

    Route::get('/login', 'login')->name('login');
    Route::delete('/logout', 'logout')->name('logout');
    Route::post('/login', 'doLogin');
    Route::get('/register','register')->name('register');
    Route::post('/register','doRegister');
});


Route::prefix('/blog')->name('profile.')->controller(ProfileController::class)->group(function() {

    Route::get('/profile', 'mainProfile')->name('profile');
});

Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(function() {


    Route::get('/about', 'about')
        ->name('about');
    Route::get('/', 'index')
        ->name('index');

    Route::post('/cookie/create/update', 'createAndUpdate')->name('create-update');
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


