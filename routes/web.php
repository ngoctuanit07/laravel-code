<?php

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
    return view('welcome');
});
Route::get('formemail', 'FileController@layout');
Route::post('postFile', 'FileController@postFile')->name('post.file');
use App\Events\MessagePosted;
use App\Notifications\MessageNotification;

Route::post('/messages', function () {
    $user = Auth::user();
    $userIdJoined = Message::where('user_id', '!=', $user->id)->groupBy('user_id')->pluck('user_id');
    $userJoined = User::whereIn('id', $userIdJoined)->get();

    $message = $user->messages()->create([
        'message' => request()->get('message'),
    ]);

    Notification::send($userJoined, new MessageNotification($message, $user));
    broadcast(new MessagePosted($message, $user))->toOthers();

    return ['status' => 'OK'];
})->middleware('auth');
// Push Subscriptions
Route::post('subscriptions', 'PushSubscriptionController@update');
Route::post('subscriptions/delete', 'PushSubscriptionController@destroy');

// Manifest file (optional if VAPID is used)
Route::get('manifest.json', function () {
    return [
        'name' => config('app.name'),
        'gcm_sender_id' => config('webpush.gcm.sender_id')
    ];
});