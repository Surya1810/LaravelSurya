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

// Route::get('/', function () {
//     return view('welcome');
// });


//frond end
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('posts',[App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('post/{slug}',[App\Http\Controllers\PostController::class,'details'])->name('post.details');
Route::get('/category/{slug}',[App\Http\Controllers\PostController::class,'postByCategory'])->name('category.posts');
Route::get('/tag/{slug}',[App\Http\Controllers\PostController::class,'postByTag'])->name('tag.posts');
Route::get('profile/{username}',[App\Http\Controllers\AuthorController::class,'profile'])->name('author.profile');
Route::post('subscriber',[App\Http\Controllers\SubscriberController::class,'store'])->name('subscriber.store');
Route::get('/search',[App\Http\Controllers\SearchController::class,'search'])->name('search');

Auth::routes();

Route::group(['middleware'=>['auth']], function (){
    Route::post('favorite/{post}/add',[App\Http\Controllers\FavoriteController::class,'add'])->name('post.favorite');
    Route::post('comment/{post}',[App\Http\Controllers\CommentController::class,'store'])->name('comment.store');
});

//Super admin
Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=> ['role:super admin']], function (){

    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    //setting
    Route::get('profile',[App\Http\Controllers\Admin\SettingsController::class,'index'])->name('settings');
    Route::post('profile/update',[App\Http\Controllers\Admin\SettingsController::class,'updateProfile'])->name('profile.update');
    Route::post('password/update',[App\Http\Controllers\Admin\SettingsController::class,'updatePassword'])->name('password.update');

    //category
    Route::get('category',[App\Http\Controllers\Admin\CategoryController::class,'index'])->name('category.index');
    Route::get('category/create',[App\Http\Controllers\Admin\CategoryController::class,'create'])->name('category.create');
    Route::post('category/store',[App\Http\Controllers\Admin\CategoryController::class,'store'])->name('category.store');
    Route::post('category/{id}/update',[App\Http\Controllers\Admin\CategoryController::class,'update'])->name('category.update');
    Route::get('category/{id}',[App\Http\Controllers\Admin\CategoryController::class,'edit'])->name('category.edit');
    Route::delete('category/{id}/delete',[App\Http\Controllers\Admin\CategoryController::class,'destroy'])->name('category.destroy');


    //tag
    Route::get('tag',[App\Http\Controllers\Admin\TagController::class,'index'])->name('tag.index');
    Route::get('tag/create',[App\Http\Controllers\Admin\TagController::class,'create'])->name('tag.create');
    Route::post('tag/store',[App\Http\Controllers\Admin\TagController::class,'store'])->name('tag.store');
    Route::post('tag/{id}/update',[App\Http\Controllers\Admin\TagController::class,'update'])->name('tag.update');
    Route::get('tag/{id}',[App\Http\Controllers\Admin\TagController::class,'edit'])->name('tag.edit');
    Route::delete('tag/{id}/delete',[App\Http\Controllers\Admin\TagController::class,'destroy'])->name('tag.destroy');

    // //user
    // Route::get('/user','App\Http\Controllers\SetController@index');
    // Route::match(['get', 'post'], '/user/{id}/edit', 'App\Http\Controllers\SetController@edit');
    Route::get('/user',[App\Http\Controllers\Admin\UserController::class,'index'])->name('user.index');
    Route::get('/user/create',[App\Http\Controllers\Admin\UserController::class,'create'])->name('user.create');
    // Route::get('/user/roles',[App\Http\Controllers\Admin\UserController::class,'roles']);
    Route::post('/user/store',[App\Http\Controllers\Admin\UserController::class,'store'])->name('user.store');
    Route::get('/user/{id}/edit',[App\Http\Controllers\Admin\UserController::class,'edit'])->name('user.edit');
    Route::post('/user/{id}/update',[App\Http\Controllers\Admin\UserController::class,'update'])->name('user.update');
    Route::get('/user/{id}/delete',[App\Http\Controllers\Admin\UserController::class,'delete'])->name('user.destroy');
    // Route::match(['get', 'post'], '/user/{id}/edit', [App\Http\Controllers\UserController::class,'update']);

    Route::get('authors',[App\Http\Controllers\Admin\AuthorController::class,'index'])->name('author.index');
    Route::delete('authors/{id}',[App\Http\Controllers\Admin\AuthorController::class,'destroy'])->name('author.destroy');
    
    //Post
    Route::get('post',[App\Http\Controllers\Admin\PostController::class,'index'])->name('post.index');
    Route::get('post/delete',[App\Http\Controllers\Admin\PostController::class,'destroy'])->name('post.destroy');
    Route::post('post/update',[App\Http\Controllers\Admin\PostController::class,'update'])->name('post.update');
    Route::get('post/create',[App\Http\Controllers\Admin\PostController::class,'create'])->name('post.create');
    Route::get('post/edit',[App\Http\Controllers\Admin\PostController::class,'edit'])->name('post.edit');
    Route::get('post/{id}/delete',[App\Http\Controllers\Admin\PostController::class,'destroy'])->name('post.destroy');
    Route::post('post/store',[App\Http\Controllers\Admin\PostController::class,'store'])->name('post.store');
    Route::get('post/pending',[App\Http\Controllers\Admin\PostController::class,'pending'])->name('post.pending');
    Route::put('/post/{id}/approve',[App\Http\Controllers\Admin\PostController::class,'approval'])->name('post.approve');

    //Fav
    Route::get('post/show',[App\Http\Controllers\Admin\PostController::class,'show'])->name('post.show');
    Route::get('/favorite',[App\Http\Controllers\Admin\FavoriteController::class,'index'])->name('favorite.index');

    //comment
    Route::get('comments',[App\Http\Controllers\Admin\CommentController::class,'index'])->name('comment.index');
    Route::delete('comments/{id}',[App\Http\Controllers\Admin\CommentController::class,'destroy'])->name('comment.destroy');

    //Subs
    Route::get('/subscriber',[App\Http\Controllers\Admin\SubscriberController::class,'index'])->name('subscriber.index');
    Route::delete('/subscriber/{subscriber}',[App\Http\Controllers\Admin\SubscriberController::class,'destroy'])->name('subscriber.destroy');
    
    //permission
    Route::get('/permission',[App\Http\Controllers\Admin\PermissionController::class,'index'])->name('permission.index');
    Route::get('/permission/create',[App\Http\Controllers\Admin\PermissionController::class,'create'])->name('permission.create');
    Route::post('/permission/store',[App\Http\Controllers\Admin\PermissionController::class,'store'])->name('permission.store');
    Route::post('/permission/{id}/update',[App\Http\Controllers\Admin\PermissionController::class,'update'])->name('permission.update');
    Route::get('/permission/{id}/edit',[App\Http\Controllers\Admin\PermissionController::class,'edit'])->name('permission.edit');
    Route::delete('/permission/{id}/delete',[App\Http\Controllers\Admin\PermissionController::class,'delete'])->name('permission.destroy');

    //Role
    Route::get('role',[App\Http\Controllers\Admin\RoleController::class,'index'])->name('role.index');
    Route::match(['get','post'],'/role/show',[App\Http\Controllers\Admin\RoleController::class,'show']);
    Route::get('/role/create',[App\Http\Controllers\Admin\RoleController::class,'create'])->name('role.create');
    Route::post('/role/store',[App\Http\Controllers\Admin\RoleController::class,'store'])->name('role.store');
    Route::post('/role/{id}/update',[App\Http\Controllers\Admin\RoleController::class,'update'])->name('role.update');
    Route::get('/role/{id}/edit',[App\Http\Controllers\Admin\RoleController::class,'edit'])->name('role.edit');
    Route::delete('/role/{id}/delete',[App\Http\Controllers\Admin\RoleController::class,'delete'])->name('role.destroy');
});
//Super admin end

Route::group(['as'=>'author.','prefix'=>'author','middleware'=>['role:operator']], function (){
    Route::get('dashboard','Author\DashboardController@index')->name('author.dashboard');

    Route::get('comments','Author\CommentController@index')->name('author.comment.index');
    Route::delete('comments/{id}','Author\CommentController@destroy')->name('author.comment.destroy');

    Route::get('settings','Author\SettingsController@index')->name('settings');
    Route::put('profile-update','Author\SettingsController@updateProfile')->name('author.profile.update');
    Route::put('password-update','Author\SettingsController@updatePassword')->name('author.password.update');

    Route::resource('post','Author\PostController');
    Route::get('/favorite','Author\FavoriteController@index')->name('authorfavorite.index');
});



View::composer('layouts.frontend.partial.footer',function ($view) {
    $categories = App\Models\Category::all();
    $view->with('categories',$categories);
});


