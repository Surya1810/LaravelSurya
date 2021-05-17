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

    Route::post('/otp', [App\Http\Controllers\OtpController::class, 'send'])->name('otp');
    Route::get('/otp', [App\Http\Controllers\OtpController::class, 'show'])->name('have.otp');
    Route::get('/otp/resend', [App\Http\Controllers\OtpController::class, 'resend'])->name('resend.otp');
    Route::post('/otp/verify', [App\Http\Controllers\OtpController::class, 'verify'])->name('verify.otp');

//frond end
Route::group(['middleware'=>['verified']], function (){
    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'email'])->name('contact');
    Route::post('/contact/submit', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');
});
    Route::get('details/{id}', [App\Http\Controllers\DocumentController::class, 'show'])->name('details');
    Route::get('document', [App\Http\Controllers\DocumentController::class, 'document'])->name('document');
    Route::get('download/{id}', [App\Http\Controllers\DocumentController::class, 'download'])->name('download');
    Route::get('download/login/{id}', [App\Http\Controllers\DocumentController::class, 'downloadlogin'])->name('download.login');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/about', [App\Http\Controllers\ContactController::class, 'about'])->name('about');
    Route::get('posts',[App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::get('post/{slug}',[App\Http\Controllers\PostController::class,'details'])->name('post.details');
    Route::get('/category/{slug}',[App\Http\Controllers\PostController::class,'postByCategory'])->name('category.posts');
    Route::get('/tag/{slug}',[App\Http\Controllers\PostController::class,'postByTag'])->name('tag.posts');
    Route::get('profile/{username}',[App\Http\Controllers\AuthorController::class,'profile'])->name('author.profile');
    Route::post('subscriber',[App\Http\Controllers\SubscriberController::class,'store'])->name('subscriber.store');
    Route::get('/search',[App\Http\Controllers\SearchController::class,'search'])->name('search');    
    Route::get('/cari',[App\Http\Controllers\SearchController::class,'loadData'])->name('cari');
// });

Auth::routes(['verify'=>true]);

Route::group(['middleware'=>['auth','verified']], function (){
    Route::post('favorite/{post}/add',[App\Http\Controllers\FavoriteController::class,'add'])->name('post.favorite');
    Route::post('comment/{post}',[App\Http\Controllers\CommentController::class,'store'])->name('comment.store');
});

//Super admin & admin
Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=> ['role:super admin','verified']], function (){
    //file manager
    Route::get('file',[App\Http\Controllers\DocumentController::class,'create'])->name('file');
    Route::get('config',[App\Http\Controllers\DocumentController::class,'index'])->name('document.index');
    Route::get('edit/{id}',[App\Http\Controllers\DocumentController::class,'edit'])->name('document.edit');
    Route::post('edit/{id}',[App\Http\Controllers\DocumentController::class,'update'])->name('document.update');
    Route::delete('delete/{id}',[App\Http\Controllers\DocumentController::class,'destroy'])->name('document.destroy');
    Route::post('file/upload',[App\Http\Controllers\DocumentController::class,'store'])->name('file.upload');

    //message
    Route::get('message',[App\Http\Controllers\ContactController::class,'message'])->name('message');
    Route::get('reply/{id}',[App\Http\Controllers\ContactController::class,'reply'])->name('message.reply');
    Route::post('send',[App\Http\Controllers\ContactController::class,'send'])->name('reply.send');
    Route::delete('message/{id}',[App\Http\Controllers\ContactController::class,'destroy'])->name('message.destroy');

    //category
    Route::get('category/create',[App\Http\Controllers\Admin\CategoryController::class,'create'])->name('category.create');
    Route::post('category/store',[App\Http\Controllers\Admin\CategoryController::class,'store'])->name('category.store');
    Route::post('category/{id}/update',[App\Http\Controllers\Admin\CategoryController::class,'update'])->name('category.update');
    Route::get('category/{id}',[App\Http\Controllers\Admin\CategoryController::class,'edit'])->name('category.edit');
    Route::delete('category/{id}/delete',[App\Http\Controllers\Admin\CategoryController::class,'destroy'])->name('category.destroy');

    //tag
    Route::get('tag/create',[App\Http\Controllers\Admin\TagController::class,'create'])->name('tag.create');
    Route::post('tag/store',[App\Http\Controllers\Admin\TagController::class,'store'])->name('tag.store');
    Route::post('tag/{id}/update',[App\Http\Controllers\Admin\TagController::class,'update'])->name('tag.update');
    Route::get('tag/{id}',[App\Http\Controllers\Admin\TagController::class,'edit'])->name('tag.edit');
    Route::delete('tag/{id}/delete',[App\Http\Controllers\Admin\TagController::class,'destroy'])->name('tag.destroy');
    
    //trashed
    Route::delete('post/kill/{id}',[App\Http\Controllers\Admin\PostController::class,'kill'])->name('post.kill');

    //subs
    Route::delete('/subscriber/{subscriber}',[App\Http\Controllers\Admin\SubscriberController::class,'destroy'])->name('subscriber.destroy');

    //role
    Route::get('/role/create',[App\Http\Controllers\Admin\RoleController::class,'create'])->name('role.create');
    Route::post('/role/store',[App\Http\Controllers\Admin\RoleController::class,'store'])->name('role.store');
    Route::post('/role/{id}/update',[App\Http\Controllers\Admin\RoleController::class,'update'])->name('role.update');
    Route::get('/role/{id}',[App\Http\Controllers\Admin\RoleController::class,'edit'])->name('role.edit');
    Route::delete('/role/{id}/delete',[App\Http\Controllers\Admin\RoleController::class,'delete'])->name('role.destroy');

    //permission
    Route::get('/permission/create',[App\Http\Controllers\Admin\PermissionController::class,'create'])->name('permission.create');
    Route::post('/permission/store',[App\Http\Controllers\Admin\PermissionController::class,'store'])->name('permission.store');
    Route::post('/permission/{id}/update',[App\Http\Controllers\Admin\PermissionController::class,'update'])->name('permission.update');
    Route::get('/permission/{id}',[App\Http\Controllers\Admin\PermissionController::class,'edit'])->name('permission.edit');
    Route::delete('/permission/{id}/delete',[App\Http\Controllers\Admin\PermissionController::class,'delete'])->name('permission.destroy');

    //user
    Route::get('/user/{id}/edit',[App\Http\Controllers\Admin\UserController::class,'edit'])->name('user.edit');
    Route::post('/user/{id}/update',[App\Http\Controllers\Admin\UserController::class,'update'])->name('user.update');
    Route::delete('/user/{id}/delete',[App\Http\Controllers\Admin\UserController::class,'delete'])->name('user.destroy');
});

Route::group(['as'=>'admin.','prefix'=>'admin','middleware'=>['role:super admin|admin','verified']], function (){
    //dashboard
    Route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    //setting
    Route::get('profile',[App\Http\Controllers\Admin\SettingsController::class,'index'])->name('settings');
    Route::put('profile/update',[App\Http\Controllers\Admin\SettingsController::class,'updateProfile'])->name('profile.update');
    Route::put('profile/image',[App\Http\Controllers\Admin\SettingsController::class,'profileimage'])->name('profile.image');
    Route::match(['put','post'],'password/update',[App\Http\Controllers\Admin\SettingsController::class,'updatePassword'])->name('password.update');
    //category
    Route::get('category',[App\Http\Controllers\Admin\CategoryController::class,'index'])->name('category.index');
    //tag
    Route::get('tag',[App\Http\Controllers\Admin\TagController::class,'index'])->name('tag.index');
    // //user
    Route::get('/user',[App\Http\Controllers\Admin\UserController::class,'index'])->name('user.index');
    //Post
    Route::get('post',[App\Http\Controllers\Admin\PostController::class,'index'])->name('post.index');
    Route::get('post/trashed',[App\Http\Controllers\Admin\PostController::class,'trashed'])->name('post.trashed');
    Route::get('post/restore/{id}',[App\Http\Controllers\Admin\PostController::class,'restore'])->name('post.restore');
    Route::put('post/{id}/update',[App\Http\Controllers\Admin\PostController::class,'update'])->name('post.update');
    Route::get('post/create',[App\Http\Controllers\Admin\PostController::class,'create'])->name('post.create');
    Route::get('post/{id}/edit',[App\Http\Controllers\Admin\PostController::class,'edit'])->name('post.edit');
    Route::delete('post/{id}/delete',[App\Http\Controllers\Admin\PostController::class,'destroy'])->name('post.destroy');
    Route::post('post/store',[App\Http\Controllers\Admin\PostController::class,'store'])->name('post.store');
    Route::get('post/pending',[App\Http\Controllers\Admin\PostController::class,'pending'])->name('post.pending');
    Route::put('/post/{id}/approve',[App\Http\Controllers\Admin\PostController::class,'approval'])->name('post.approve');
    Route::get('post/{id}/show',[App\Http\Controllers\Admin\PostController::class,'show'])->name('post.show');
    //Fav
    Route::get('/favorite',[App\Http\Controllers\Admin\FavoriteController::class,'index'])->name('favorite.index');
    //comment
    Route::get('comments',[App\Http\Controllers\Admin\CommentController::class,'index'])->name('comment.index');
    Route::delete('comments/{id}',[App\Http\Controllers\Admin\CommentController::class,'destroy'])->name('comment.destroy');
    //Subs
    Route::get('/subscriber',[App\Http\Controllers\Admin\SubscriberController::class,'index'])->name('subscriber.index');
    //permission
    Route::get('/permission',[App\Http\Controllers\Admin\PermissionController::class,'index'])->name('permission.index');
    //Role
    Route::get('role',[App\Http\Controllers\Admin\RoleController::class,'index'])->name('role.index');
    // Route::match(['get','post'],'/role/show',[App\Http\Controllers\Admin\RoleController::class,'show']);
});

//author ini
Route::group(['as'=>'author.','prefix'=>'author','middleware'=>['role:operator','verified']], function (){
    Route::get('dashboard',[App\Http\Controllers\Author\DashboardController::class,'index'])->name('dashboard');

    Route::get('comments',[App\Http\Controllers\Author\CommentController::class,'index'])->name('comment.index');
    Route::delete('comments/{id}',[App\Http\Controllers\Author\CommentController::class,'destroy'])->name('comment.destroy');

    Route::get('settings',[App\Http\Controllers\Author\SettingsController::class,'index'])->name('settings');
    Route::put('profile-update',[App\Http\Controllers\Author\SettingsController::class,'updateProfile'])->name('profile.update');
    Route::put('password-update',[App\Http\Controllers\Author\SettingsController::class,'updatePassword'])->name('password.update');
    Route::put('image-update',[App\Http\Controllers\Admin\SettingsController::class,'profileimage'])->name('profile.image');

    Route::get('post',[App\Http\Controllers\Author\PostController::class,'index'])->name('post.index');
    Route::delete('post/kill/{id}',[App\Http\Controllers\Author\PostController::class,'kill'])->name('post.kill');
    Route::get('post/trashed',[App\Http\Controllers\Author\PostController::class,'trashed'])->name('post.trashed');
    Route::get('post/restore/{id}',[App\Http\Controllers\Author\PostController::class,'restore'])->name('post.restore');
    Route::put('post/{id}/update',[App\Http\Controllers\Author\PostController::class,'update'])->name('post.update');
    Route::get('post/create',[App\Http\Controllers\Author\PostController::class,'create'])->name('post.create');
    Route::get('post/{id}/edit',[App\Http\Controllers\Author\PostController::class,'edit'])->name('post.edit');
    Route::get('post/{id}/show',[App\Http\Controllers\Author\PostController::class,'show'])->name('post.show');
    Route::delete('post/{id}/delete',[App\Http\Controllers\Author\PostController::class,'destroy'])->name('post.destroy');
    Route::post('post/store',[App\Http\Controllers\Author\PostController::class,'store'])->name('post.store');

    Route::get('/favorite',[App\Http\Controllers\Author\FavoriteController::class,'index'])->name('favorite.index');
});

View::composer('layouts.frontend.partial.footer',function ($view) {
    $categories = App\Models\Category::all();
    $view->with('categories',$categories);
});


