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

// Route::get('/clear-cache', function() {



//     Artisan::call('cache:clear');

//     return "Cache is cleared";

// });

//Route::resource('admin/aduser' , 'Admin\AduserController', array('as'=>'admin') );

// Route::get('/dump', function () {

// 	    return view('login');

// });

Route::get('/', function () {

	  if (Auth::check()) {

	    $user = Auth::user();  

	    return redirect()->route('admin.post.index')->with('success',$user->name);

	    return view('admin.post.index');

	} else {

	    return view('login');

	}

});



// Route::get('/admin', function () {

// 	if (Auth::check()) {

// 	    $user = Auth::user();  

// 	    //return redirect()->route('admin.dashboard')->with('success',$user->name);

// 	     return view('admin.post.index');

// 	} else {

// 	    return view('login');

// 	}

// });

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

// Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()

// {

//     Route::get('dashboard', function() {} );

// });

//user

Route::get('login','Auth\LoginController@getLogin');

Route::post('login','Auth\LoginController@postLogin');

Route::get('logout','Auth\LoginController@logout');
Route::group(['middleware' => ['auth']], function() {

	Route::resource('svcustomer','SvCustomerController');

	Route::resource('svposttype','SvPostTypeController');

	//Route::get('svpost/makepost', 'SvPostController@makepost');

	//Route::post('svpost/makepost', 'SvPostController@makepost');

	Route::resource('svpost','SvPostController');

	Route::resource('category','CategoryController');

    Route::resource('admin/aduser' , 'Admin\AduserController', array('as'=>'admin') );

	Route::resource('admin/adsvcustomer' , 'Admin\AdsvcustomerController', array('as'=>'admin') );

	Route::resource('admin/category' , 'Admin\CategoryController', array('as'=>'admin') );

	Route::get('admin/svpost/makepost', 'Admin\SvPostController@makepost');

	Route::post('admin/svpost/makepost', 'Admin\SvPostController@makepost');

	Route::resource('admin/svpost' , 'Admin\SvPostController', array('as'=>'admin') );

	Route::resource('admin/svposttype' , 'Admin\SvPostTypeController', array('as'=>'admin') );
	//customer register
	//Route::resource('admin/adsvcustomer' , 'Admin\AdsvcustomerController', array('as'=>'admin') );
	//post management

	Route::get('admin/post/listcatbyidcat', 'Admin\CategoryController@listcatbyidcat');

	Route::post('admin/post/listcatbyidcat', 'Admin\CategoryController@listcatbyidcat');

	Route::resource('admin/post' , 'Admin\PostsController', array('as'=>'admin') );

	Route::resource('admin/posttype' , 'Admin\PostTypeController', array('as'=>'admin') );

	Route::resource('admin/cattype' , 'Admin\CategoryTypeController', array('as'=>'admin') );

	Route::resource('admin/statustype' , 'Admin\StatusTypeController', array('as'=>'admin') );

	//upload file

	Route::post('admin/upload' , 'Admin\UploadController@upload');

	Route::get('admin/upload' , 'Admin\UploadController@upload');

	Route::post('admin/uploadfile' , 'Admin\UploadController@uploadfile');

	Route::get('admin/uploadfile' , 'Admin\UploadController@uploadfile');

	//deparment

	Route::get('admin/department/listdepartmentbyid', 'Admin\DepartmentController@listdepartmentbyid');

	Route::post('admin/department/listdepartmentbyid', 'Admin\DepartmentController@listdepartmentbyid');

	Route::resource('admin/department','Admin\DepartmentController', array('as'=>'admin'));

	//grant permistion

	Route::resource('admin/roles','Admin\RoleController', array('as'=>'admin'));

	Route::resource('admin/permission','Admin\PermissionController', array('as'=>'admin'));

    Route::resource('admin/impperm','Admin\ImpPermController', array('as'=>'admin'));

    Route::resource('admin/grantperm','Admin\GrantController', array('as'=>'admin'));

    // Route::resource('products','ProductController');

    //Route::post('admin/postDiamond' , 'Admin\UploadDiamondController@postDiamond');

	//Route::get('admin/postDiamond' , 'Admin\UploadDiamondController@postDiamond');

});
