<?php

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
//
//Route::get('/', function () {
//    return view('home');
//})->name('home');

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Test\TestController;
use App\Http\Controllers\PostController;

//Указываем какой контроллер подключить
Route::get('/', [HomeController::class,'index'])->name('home');

//Показывает форму
Route::get('/create', [HomeController::class, 'create'])->name('posts.create');

//Сохраняет данные из формы
Route::post('/', [HomeController::class, 'store'])->name('posts.store');

Route::get('/page/about', [PageController::class,'show'])->name('page.about');

Route::match(['get', 'post'], '/send', [ContactController::class, 'send'])->name('send');

//Группировка маршрутов, чтобы отрабатывал один Middleware
Route::group(['middleware' => 'guest'], function () {
    //Регистрация
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    //Авторизация
    //показ формы
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
//принимает данные формы
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

//Авторизация

//выход из сессии
Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

//админские маршруты
Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', [MainController::class, 'index']);
});



//Route::get('/send', [ContactController::class, 'send']);


//Route::get('/about', function () {
//   return '<h1>About Page</h1>';
//});

/*Route::get('/contact', function () {
   return view('contact');
});

Route::post('/send-email', function () {
    if (!empty($_POST)) {
        dump($_POST);
    }
    return 'Send email';
});*/

//Route::match(['post', 'get'], '/contact', function () {
//    if (!empty($_POST)) {
//        dump($_POST);
//    }
//    return view('contact');
//});

//Именованные маршруты
/*Route::match(['post', 'get'], '/contact', function () {
    if (!empty($_POST)) {
        dump($_POST);
    }
    return view('contact');
})->name('contact');

Route::view('/test', 'test', ['test' => 'Test data']);

Route::redirect('/about', '/contact');

//Route::get('/post/{id}', function($id) {
//    return "Post $id";
//});
Route::get('/post/{id}/{slug}', function($id, $slug) {
    return "Post $id | $slug";
});*/


//
//Route::resource('/admin/posts', PostController::class, ['parameters' => [
//    'posts' => 'id'
//]]);
//
//Route::fallback(function () {
//   abort('404', 'Oops! Page not found...');
//});

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/', function () {
//   return '<h1>Hello, world!</h1>';
//});
