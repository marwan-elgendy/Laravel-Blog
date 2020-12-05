<?php


use\App\Http\Controllers\Blog\PostsController;
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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/blog/posts/{post}',[PostsController::class,'show'])->name('blog.show'); 
Route::get('blog/categories/{category}',[PostsController::class,'category'])->name('blog.category');
Route::get('blog/tags/{tag}',[PostsController::class,'tag'])->name('blog.tag');
Auth::routes([
    'register' => false
]);

Route::middleware(['auth'])->group( function () {
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories','categoriesController');
Route::resource('posts', 'postsController');
Route::resource('tags','tagsController');
Route::get('trashed-posts', 'postsController@trashed')->name('trashed-posts.index');
Route::put('restore/{post}','postsController@restore')->name('restore.update');

});

Route::middleware(['auth','admin'])->group(  function() {
    Route::get('users/profile','UsersController@edit')->name('users.edit-profile');
    Route::put('users/profile','UsersController@update')->name('users.update-profile');
    Route::get('users','UsersController@index')->name('users.index');
    Route::post('users/{user}/make-admin','UsersController@makeAdmin')->name('users.make-admin');
    Route::get('users/add','UsersController@create')->name('users.add-user');
    Route::post('users/add','UsersController@store')->name('users.store-user');
});

