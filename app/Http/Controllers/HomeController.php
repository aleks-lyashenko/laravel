<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Post;
use App\Models\Rubric;
use App\Models\Tag;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

//use phpDocumentor\Reflection\DocBlock\Tag;

class HomeController extends Controller
{
    public function index(Request $request) {

        {
            //Работа с сессией

            //Запись в сессию
//        $request->session()->put('name', 'Aleks');
//
//        session(['cart' => [
//            ['id' => 1, 'title' => 'Product 1'],
//            ['id' => 2, 'title' => 'Product 2'],
//        ]]);

            //добавление данных в сессию, не удаляя предыдущие

//        $request->session()->push('cart', ['id' => 3, 'title' => 'Product 3']);
            //получение из сессии

//        dump($request->session()->get('name'));

            //удалить данные
            //удалить и сохранить в переменную
//        dump($request->session()->pull('name2'));

            //удалить
//        $request->session()->forget('cart');

            //Очистить содержимое сессии
//        $request->session()->flush();


            //вывод содержимого сессии
//        dump($request->session()->all());

            //
        }

        {
            //Работа с куками
            //Добавление
            Cookie::queue('test2', 'Test value', 5);

            //Удаление
//            Cookie::queue(Cookie::forget('test'));

            //Вывод
//            dump($request->cookie('test2'));

        }

        $title = 'Home Page';

        {
            //Работа с кэшем
            //Положить данные в кэш
//            Cache::put('key', 'value', 120);

//            dump(Cache::get('key'));

//            Cache::put('key', 'value', 120);
            //Получить и удалить данные
//            dump(Cache::pull('key'));

            //Полное удаление данных из кэша
//            Cache::flush();

            //Если данные в кэше есть, они берутся оттуда, если нет - загружаются из базы данных
//            if (Cache::has('posts')) {
//                $posts = Cache::get('posts');
//            } else {
//                $posts = Post::orderBy('id', 'desc')->get();
//                Cache::put('posts', $posts);
//            }
            //получить список постов
//            $posts = Post::orderBy('id', 'desc')->get();
            //получить список постов с пагинацией
            $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        }


        return view('home', compact('title', 'posts'));
    }


    public function create() {
        $title = "Create Post";

        //Получение рубрик из БД
        $rubrics = Rubric::query()->pluck('title', 'id')->all();

        return view('create', compact('title', 'rubrics'));
    }

    public function store(Request $request) {

        //Валидация данных
        $this->validate($request, [
            'title' => 'required | min:5 | max:100',
            'content' =>'required',
            'rubric_id' => 'integer'
        ]);

        //Кастомизация сообщений об ошибках
//        $rules = [
//            'title' => 'required | min:5 | max:100',
//            'content' =>'required',
//            'rubric_id' => 'integer'
//        ];
//
//        $messages = [
//            'title.required' => 'Заполните поле названия',
//            'title.min' => 'Минимальное количество символов поля должно быть 5',
//            'rubric_id.integer' => 'Выберите рубрику из списка'
//        ];
//
//        $validator = Validator::make($request->all(), $rules, $messages)->validate();


        //Принять данные из формы и сохранить в БД || Массовое присваивание, нужно разрешить в модели, какие поля
        // заполнять
        Post::create($request->all());

//        dd($request->all());
//        dump($request->input('title'));
//        dump($request->input('content'));
//        dd($request->input('rubric_id'));

        //запись в сессию, эти данные будут доступны 1 раз на следующей странице
        $request->session()->flash('success', 'Данные успешно сохранены');

        return redirect()->route('home');
    }
}




//        $data = DB::table('country')->get();
//        $data = DB::table('country')->limit(5)->get();
//        $data = DB::table('country')->select('code', 'name')->limit(5)->get();
//        $data = DB::table('country')->select('code', 'name')->first();
//        $data = DB::table('country')->select('code', 'name')->orderBy('code', 'desc')->first();
//        $data = DB::table('city')->select('id', 'name')->find(2);
//        $data = DB::table('city')->select('id', 'name')->where('id', 2)->get();
//        $data = DB::table('city')->select('id', 'name')->where([
//            ['id', '>', 1],
//            ['id', '<', 5]
//        ])->get();
//        $data = DB::table('country')->limit(10)->pluck('Name', 'Code');

//агрегатные функции
//        $data = DB::table('country')->count();
//        $data = DB::table('country')->max('population');
//        $data = DB::table('country')->avg('population');

//уникальные
//        $data = DB::table('city')->select('countryCode')->distinct()->get();

//соединить
//        $data = DB::table('city')->select('city.ID', 'city.Name as city_name', 'country.Code', 'country.Name as country_name')->limit(10)->join('country', 'city.CountryCode', '=', 'country.Code')->orderBy('city.ID')->get();
//
//        dd($data);




/*
$query = DB::insert("INSERT INTO posts (title, content) VALUES(?,?)", ['Статья 3', 'Контент статьи 3']);
var_dump($query);

DB::update("UPDATE posts SET title = ?, content = ? WHERE id = 6", ['Статья 6', 'Контент статьи 6']);

DB::delete("DELETE FROM posts WHERE id = ?", [7]);

//Транзакции
DB::beginTransaction();
try {
    DB::update("UPDATE posts SET title = ?, content = ? WHERE id = 5", ['Статья #5', 'Контент статьи #5']);
    DB::update("UPDATE posts SET title = ?, content = ? WHERE id = 8", ['Статья 8', 'Контент статьи 8']);
    DB::commit();
} catch (\Exception $e) {
    DB::rollBack();
    echo $e->getMessage();
}

$posts = DB::select("SELECT * FROM posts WHERE id > :id ", ['id' => 2]);
return dump($posts);

dump($_ENV['DB_DATABASE']);
dump(config('database.connections.mysql.database'));
dump($_ENV);*/

//        $post = new Post();
//        $post->title = 'Статья 2';
//        $post->content = 'Rjynsdfsdf';
//        $post->save();

//        $data = Country::all();
//        $data = Country::query()->limit(5)->get();
//        $data = Country::limit(10)->get();
//        $data = City::find(5);
//        $data = Country::find('AGO');
//        dd($data);

//        $post = new Post();
//        $post->title = 'Статья 3';
//        $post->content = 'Rjyntyn cnfnmb 3';
//        $post->save();

//        Post::query()->create(['title' => 'Post 6', 'content' => 'Content post 6']);

//Обновить запись
//        $post = Post::query()->find(5);
//        $post->content = 'Content post 5';
//        $post->save();

//Множественное обновление
//        Post::query()->where('id', '>', 4)->update(['updated_at' => NOW()]);

//Удаление модели
//        $post = Post::query()->find(6);
//        $post->delete();

//        Post::destroy(5);

//        $post = Post::query()->find(7);
//        dump($post->title, $post->rubric->title);

//        $rubric = Rubric::find(3);
//        dump($rubric->title, $rubric->post->title);

//        $rubric = Rubric::find(2);
//        dump($rubric->posts);

//        $post = Post::query()->find(8);
//        dump($post->title, $post->rubric->title);

//many to many

//        $post = Post::query()->find(4);
//        dump($post->title);
//        foreach ($post->tags as $tag) {
//            dump($tag->title);
//        }

//        $tag = Tag::query()->find(2);
//        dump($tag->title);
//        foreach ($tag->posts as $post) {
//            dump($post->title);
//        }
