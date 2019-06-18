<?php



Route::get('/', 'HomeController@index');
Route::get('/post/{slug}', 'HomeController@show')->name('post.show');
Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
Route::get('/category/{slug}', 'HomeController@category')->name('category.show');
Route::post('/subscribe', 'SubsController@subscribe')->name('subscribe');
Route::get('/verify/{token}', 'SubsController@verify');

Route::group(['middleware' => 'auth'],function (){
    Route::get('/logout','AuthController@logout')->name('users.logout');
    Route::post('/profile', 'ProfileController@store')->name('user.store');
    Route::get('/profile', 'ProfileController@index')->name('user.profile');
    Route::post('/comment', 'CommentsController@store')->name('comment.user');
});

Route::group(['middleware' => 'guest'],function (){
    Route::get('/register', 'AuthController@registerForm')->name('register.form');
    Route::post('/register' ,'AuthController@register')->name('users.register');
    Route::get('/login', 'AuthController@loginForm')->name('login.form');
    Route::post('/login', 'AuthController@login')->name('login');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function (){
    Route::get('/', 'DashboardController@index')->name('dashboard.admin');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/tags',  'TagsController');
    Route::get('/users/toggle{id}','UsersController@toggle')->name('users.toggle');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts', 'PostsController');
    Route::get('/comments', 'CommentsController@index')->name('comment');
    Route::get('/comments/toggle{id}', 'CommentsController@toggle')->name('comment.toggle');
    Route::delete('/comments/{id}/destroy', 'CommentsController@destroy')->name('comment.destroy');
    Route::resource('/subscribers', 'SubscribersController');

});
