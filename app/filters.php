<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	
});


App::after(function($request, $response)
{
	
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/
//XEM LẠI CƠ CHẾ FILTER || PERMISSION	
Route::filter('auth', function()
{	
	/*if(Sentry::check()) {
		
	}else{
			
	}*/
	if(isset(Auth::user()->created_at)){
		if(strtotime(Auth::user()->created_at)<strtotime(date('Y-m-d H:i:s'))-86400*7){ //echo strtotime(date('Y-m-d H:i:s'))-86400*7-strtotime(Auth::user()->created_at); die();
			Session::flash('danger','Your password is too old, please change your password!');
		}
	}
	if(Auth::guest()) 
		return Redirect::guest('login');
});
//admin
Route::filter('admin',function(){  //print_r(Sentry::findAllUsers()); die();
	if(isset(Auth::user()->default_account_id)){
	    $account=Account::where('id','=',Auth::user()->default_account_id)->get(); //echo $account->lists('account_type')[0]; die();
		/*if(isset(explode('-',Request::segment(2))[2])){
			if(explode('-',Request::segment(2))[2]!=Auth::user()->website_id)
				return Redirect::to('/login');
		}*/
	    //echo '<pre/>'; print_r($account->lists('account_type')[0]); die();
	    if($account->lists('account_type')[0]=='MANAGER'||$account->lists('account_type')[0]=='ADMIN'){
		}else{
			return Redirect::to('/login');
		}
	}else{
		return Redirect::to('/login');
	}
});
//clients
Route::filter('clients',function(){
	if(Auth::user()->default_account_id==3)
		return Redirect::guest('login');
});
//advertiser
Route::filter('advertiser',function(){ 
	if(isset(Auth::user()->default_account_id)){
	    $account=Account::where('id','=',Auth::user()->default_account_id)->get(); //echo $account->lists('account_type')[0]; die();
		/*if(isset(explode('-',Request::segment(2))[2])){
			if(explode('-',Request::segment(2))[2]!=Auth::user()->website_id)
				return Redirect::to('/login');
		}*/
	    //echo '<pre/>'; print_r($account->lists('account_type')[0]); die();
	    if($account->lists('account_type')[0]==='ADVERTISER'){
		}else{
			return Redirect::to('/login');
		}
	}else{
		return Redirect::to('/login');
	}
});
Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});