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


Route::get('a', function (\Illuminate\Http\Request $request) {
    $advertisements = \App\Models\Advertisement::query()->get()->toArray();

    $adIds = array_map(function ($row) {
        return $row['id'];
    }, $advertisements);

    //
    $s = \App\Models\AdvertisementUserSubscription::query()
        ->whereIn('advertisement_id', $adIds)
        ->where('user_id', $request->user()->id)
        ->get()
        ->toArray();

    $tmp = [];

    foreach ($s as $row) {
        $tmp[$row['advertisement_id']] = $row['user_id'];
    }

    foreach ($advertisements as &$advertisement) {
        if (array_key_exists($advertisement['id'], $tmp)) {
            $advertisement['subscribed'] = true;
            continue;
        }

        $advertisement['subscribed'] = false;
    }

    dd($advertisements);
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('advertisements', 'AdvertisementController')->only(['index', 'show']);
Route::resource('categories', 'CategoryController')->only(['index', 'show']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('advertisements', 'AdvertisementController')->only(['store', 'update', 'destroy']);
    Route::get('advertisements/{id}/messages/conversations/{groupId}', 'MessageController@conversation');
    Route::resource('advertisements/{id}/messages', 'MessageController')->only(['index', 'store']);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::resource('categories', 'CategoryController');
});

Route::get('adv', function (\Illuminate\Http\Request $request, \App\Services\TelegramService $service) {
    $text = $request->text ?? 'empty';


    $users = \App\Models\TelegramUser::all()->toArray();

    foreach ($users as $user) {
        $service->sendMessage($user['chat_id'], $text);
    }
});

Route::post("subscribe", "TelegramController@subscribe");
Route::get('conversations', 'MessageController@conversations');