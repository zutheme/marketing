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

Route::get('/clear-cache', function() {



    Artisan::call('cache:clear');

    return "Cache is cleared";

});

//Route::resource('admin/aduser' , 'Admin\AduserController', array('as'=>'admin') );

// Route::get('/dump', function () {

// 	    return view('login');

// });

Route::get('/', function () {
	if (Auth::check()) {
	    $user = Auth::user();  
	    return redirect()->route('admin.post.index')->with('success',$user->name);
	    //return view('admin.post.index');
	} else {
		//return route('login');
	    return redirect('login');
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
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
//Route::get('login','Auth\LoginController@getLogin');
Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);
//Route::post('login','Auth\LoginController@postLogin');
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
	Route::get('admin/customerreg/interactive', 'Admin\CustomerRegController@make_interactive');
	Route::post('admin/customerreg/interactive', 'Admin\CustomerRegController@make_interactive');

	Route::get('admin/customerreg/interactivecustomer', ['uses' =>'Admin\CustomerRegController@interactive_customer', 'as'=>'admin']);
	Route::post('admin/customerreg/interactivecustomer', ['uses' =>'Admin\CustomerRegController@interactive_customer', 'as'=>'admin']);

	Route::get('admin/customerreg/listcustomerbydate/{_idcategory}/{_id_post_type}/{_id_status_type}', ['uses' =>'Admin\CustomerRegController@ListCustomerByDate', 'as'=>'admin']);
	Route::post('admin/customerreg/listcustomerbydate/{_idcategory}/{_id_post_type}/{_id_status_type}', ['uses' =>'Admin\CustomerRegController@ListCustomerByDate', 'as'=>'admin']);

	Route::get('admin/customerreg/listcustomerbycat/{_idcategory}/{_id_post_type}/{_id_status_type}', ['uses' =>'Admin\CustomerRegController@ListCustomerByCat', 'as'=>'admin']);
	Route::post('admin/customerreg/listcustomerbycat/{_idcategory}/{_id_post_type}/{_id_status_type}', ['uses' =>'Admin\CustomerRegController@ListCustomerByCat', 'as'=>'admin']);

	//show detail
	Route::get('admin/customerreg/{_idimport}', ['uses' =>'Admin\CustomerRegController@show', 'as'=>'admin']);
	Route::post('admin/customerreg/{_idimport}', ['uses' =>'Admin\CustomerRegController@show', 'as'=>'admin']);
	//end show detail

	Route::resource('admin/customerreg' , 'Admin\CustomerRegController', array('as'=>'admin') );

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
    //profile
    Route::post('profile/uploadavatar/{iduser}/{idprofile}',['uses' =>'ProfileController@uploadavatar']);
	Route::get('profile/uploadavatar/{iduser}/{idprofile}',['uses' =>'ProfileController@uploadavatar']);
    Route::get('profile/{iduser}', ['uses' =>'ProfileController@show']);
	Route::post('profile/{iduser}', ['uses' =>'ProfileController@show']);
	Route::get('profile/changepassword/{iduser}', ['uses' =>'ProfileController@changepassword']);
	Route::post('profile/changepassword/{iduser}', ['uses' =>'ProfileController@changepassword']);
	Route::resource('profile','ProfileController');
});

