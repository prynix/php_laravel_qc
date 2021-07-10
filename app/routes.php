<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//app/routes.php
Route::get('/admin/test',function(){
	Cache::put('title','Client',30);
	if(Cache::has('title')){
		return Cache::get('title');
	}
});
Route::get('/locale/{locale}','BaseController@setLocale');
/* Home routes */
Route::controller('/login', 'AuthController');
App::missing(function($exception){
	return Response::view('admin/error/missing');
});
Route::get('/', function()
{
	return Redirect::to('/public/admin/logout');
});
Route::get('/admin/delete_cache','CacheController@deleteCache');
Route::get('/admin/delete-cache_views','CacheController@deleteCacheViews');
Route::get('/admin/delete-cache_sessions','CacheController@deleteCacheSessions');
Route::get('/admin/delete_folder_image','RssController@deleteFolderImage');
//Route::get('/admin',array('uses'=>'AuthController@getLogin'));
Route::get('/admin',array('uses'=>'AuthController@getLogout'))->before('guest');
Route::get('/admin/login',array('uses'=>'AuthController@getLogin'))->before('guest');
Route::post('/admin/login',array('uses'=>'AuthController@postLogin'))->before('guest');
Route::get('/login',array('uses'=>'AuthController@getLogin'))->before('guest');
Route::post('/login',array('uses'=>'AuthController@postLogin'))->before('guest');
Route::get('/logout',array('uses'=>'AuthController@getLogout'))->before('auth');
Route::get('/admin/logout',array('uses'=>'AuthController@getLogout'))->before('auth');
Route::get('/public/admin/logout',array('uses'=>'AuthController@getLogout'))->before('auth');
Route::get('/admin/register',array('uses'=>'UserController@getRegister'))->before('guest');
Route::post('/admin/register',array('uses'=>'UserController@postRegister'))->before('guest');
Route::get('/admin/recovery_password',array('uses'=>'UserController@getRecoveryPassword'))->before('guest');
Route::post('/admin/recovery_password',array('uses'=>'UserController@postRecoveryPassword'))->before('guest');
//active an account when register
Route::get('/account/activate/{code}',array('as'=>'account-activate','uses'=>'UserController@getActive'));
//recovery password when click recover link with code
Route::get('/account/recover/{code}','UserController@getRecover');
Route::get('/admin/dashboard',array('before'=>'auth'
	//,'DashboardController@index');
	,function(){
	$advertisers=Advertiser::where('status','=',1)->count();
	$banners=Banner::where('status','=',1)->count();
	$websites=Website::where('status','=',1)->count();
	$zones=Zone::where('status','=',1)->count();
	return View::make('admin/dashboard/index')->with('advertisers',$advertisers)->with('banners',$banners)->with('websites',$websites)->with('zones',$zones);//->with('users',$users)->with('count_usersonline',$count_usersonline)->with('accounts',$accounts);
}));
Route::get('/advertiser/dashboard',array('before'=>'auth'
	//,'DashboardController@index');
	,function(){
	$advertisers=Advertiser::where('id','=',Auth::user()->clientid)->get(); //print_r($advertisers->lists('id')[0]); die();
	if($advertisers){
		foreach($advertisers as $advertiser)	
			$campaign=Campaign::where('clientid','=',$advertisers->lists('id')[0])->get(); 
			if($campaign&&$campaign->lists('expire')[0]<date('Y-m-d'))
				Session::flash('danger','Your campaign is expired!');
	}
	//$advertisers=Advertiser::where('status','=',1)->count();
	$banners=Banner::where('status','=',1)->count();
	$websites=Website::where('status','=',1)->count();
	$zones=Zone::where('status','=',1)->count();
	return View::make('advertiser/dashboard/index')->with('advertisers',$advertisers)->with('banners',$banners)->with('websites',$websites)->with('zones',$zones);//->with('users',$users)->with('count_usersonline',$count_usersonline)->with('accounts',$accounts);
}));
Route::post('/admin/dashboard',array('before'=>'auth'
	//,'DashboardController@index');
	,function(){
	$rules=array(
    	'password'=>'required|min:5'
    );
	$validator=Validator::make(Input::all(),$rules);
	if($validator->fails()){ 
            return Redirect::to('/admin/lockscreen')->withErrors($validator)->withInput(Input::except('password'));
    }else{
        //create our user data for the authentication
        $userdata=array(
           'username'=>Auth::user()->username//,
            ,'password'=>Input::get('password')
        );    
        //print_r($userdata); die();   
        if(Auth::attempt($userdata)){
			$advertisers=Advertiser::count();
			$banners=Banner::count();
			$websites=Website::count();
			$zones=Zone::count();
			return View::make('admin/dashboard/index')->with('advertisers',$advertisers)->with('banners',$banners)->with('websites',$websites)->with('zones',$zones);
           	return Redirect::to('admin/dashboard');
        }else{
           	return Redirect::to('admin/lockscreen');
        }
    }
}));
Route::post('/admin/dashboard/send-email','DashboardController@sendMail');
//Account admin

Route::get('/admin/account-user-name-language-{id}',array('before'=>'auth'
	,function($id){
	$languages=Language::all();
	$user=User::find($id);
	return View::make('admin/user/account_user_name_language')->with('user',$user)->with('languages',$languages);
}));
Route::get('/advertiser/account-user-name-language-{id}',array('before'=>'auth'
	,function($id){
	$languages=Language::all();
	$user=User::find($id);
	return View::make('advertiser/user/account_user_name_language')->with('user',$user)->with('languages',$languages);
}));
Route::post('/admin/account-user-name-language-{id}','UserController@postNameLanguage')->before('advertiser');
Route::post('/admin/account-user-email-{id}','UserController@postEmail')->before('advertiser');
Route::post('/admin/account-user-password-{id}','UserController@postPassword')->before('advertiser');
//Advertisers
Route::get('/admin/advertiser','AdvertiserController@getList')->before('admin');
Route::get('/admin/advertiser-create','AdvertiserController@getCreate')->before('admin');
Route::post('/admin/advertiser-create','AdvertiserController@postStore')->before('admin');
Route::post('/admin/advertiser-user-{id}','AdvertiserController@postUserAccess')->before('admin');
Route::get('/admin/useraccess-destroy-{clientid}-{userid}','AdvertiserController@destroyUserAccess')->before('admin');
Route::get('/admin/campaign-advertiser-{id}',array('before'=>'admin',function($id){ 
	$longer_term=Campaign::where('expire','>=',date('Y-m-d'))->count();
	$expired=Campaign::where('expire','!=','')->where('expire','<',date('Y-m-d'))->count();
	$dont_expire=Campaign::where('expire','=','')->count();																					
	$first_record=Campaign::orderBy('order_no','ASC')->first();
	$last_record=Campaign::orderBy('order_no','DESC')->first();
	$advertiser=Advertiser::where('id','=',$id)->first();
	$advertisers=Advertiser::all();
	$campaigns=Campaign::where('clientid','=',$id)->get();
	return View::make('admin/campaign/index')->with('longer_term',$longer_term)->with('expired',$expired)->with('dont_expire',$dont_expire)->with('first_record',$first_record)->with('last_record',$last_record)->with('advertiser',$advertiser)->with('advertisers',$advertisers)->with('campaigns',$campaigns);
}));
Route::get('/admin/advertiser-show-{id}','AdvertiserController@getShow')->before('admin');
Route::get('/admin/advertiser-copy-{id}','AdvertiserController@getCopy')->before('admin');
Route::post('/admin/advertiser-copy-{id}','AdvertiserController@postStore')->before('admin');
Route::get('/admin/advertiser-edit-{id}','AdvertiserController@getEdit')->before('admin');
Route::post('/admin/advertiser-edit-{id}','AdvertiserController@postUpdate')->before('admin');
Route::get('/admin/advertiser-delete-{id}','AdvertiserController@delete')->before('admin');
Route::get('/admin/advertiser-recycle','AdvertiserController@recycle_bin')->before('admin');
Route::get('/admin/advertiser-revert-{id}','AdvertiserController@revert')->before('admin');
Route::get('/admin/advertiser-destroy-{id}','AdvertiserController@destroy')->before('admin');
Route::get('/admin/advertiser-move_top-{table}-{id}','HandleController@moveTop')->before('admin');
Route::get('/admin/advertiser-move_up-{table}-{id}','HandleController@moveUp')->before('admin');
Route::get('/admin/advertiser-move_down-{table}-{id}','HandleController@moveDown')->before('admin');
Route::get('/admin/advertiser-move_bottom-{table}-{id}','HandleController@moveBottom')->before('admin');
//Campaigns
Route::get('/admin/campaign','CampaignController@getList')->before('admin');
Route::get('/admin/campaign-longer_term','CampaignController@getCampaignLongerTerm')->before('admin');
Route::get('/admin/campaign-expired','CampaignController@getCampaignExpired')->before('admin');
Route::get('/admin/campaign-dont_expire','CampaignController@getCampaignDontExpire')->before('admin');
Route::get('/advertiser/campaign','CampaignController@getListCampaignOfAdvertiser')->before('advertiser');
Route::get('/admin/client-of_campaign-{id}','CampaignController@getClientOfCampaign')->before('advertiser');
//Route::get('/admin/campaign-advertiser-{id}','CampaignController@getListOfClient')->before('admin');
Route::get('/admin/campaign-create-{id}','CampaignController@getCreate')->before('admin');
Route::post('/admin/campaign-create-{id}','CampaignController@postStore')->before('admin');
Route::get('/admin/campaign-banner-{id}',array('before'=>'admin',function($id){
	//$banners=Banner::all();
	$advertisers=Advertiser::all();
	$campaign=Campaign::where('id','=',$id)->first();
	$campaigns=Campaign::all();
	$first_record=Banner::orderBy('order_no','ASC')->first();
	$last_record=Banner::orderBy('order_no','DESC')->first();
	$banners=Banner::where('campaignid','=',$id)->get();
	return View::make('admin/banner/index')->with('advertisers',$advertisers)->with('campaign',$campaign)->with('campaigns',$campaigns)->with('banners',$banners)->with('first_record',$first_record)->with('last_record',$last_record);
}));
Route::get('/admin/campaign-show-{id}','CampaignController@getShowAdmin')->before('admin');
Route::get('/advertiser/campaign-show-{id}','CampaignController@getShowAdvertiser')->before('advertiser');
Route::get('/admin/campaign-copy-{id}','CampaignController@getCopy')->before('admin');
Route::post('/admin/campaign-copy-{id}','CampaignController@postCopy')->before('admin');
Route::get('/admin/campaign-edit-{id}','CampaignController@getEdit')->before('admin');
Route::post('/admin/campaign-edit-{id}','CampaignController@postUpdate')->before('admin');
Route::get('/admin/campaign-delete-{id}','CampaignController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$campaign=Campaign::find($id);
// 	$campaign->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the campaign!');
// 	return Redirect::to('admin/campaign');
// }));
Route::get('/admin/campaign-recycle','CampaignController@recycle_bin')->before('admin');
Route::get('/admin/campaign-revert-{id}','CampaignController@revert')->before('admin');
Route::get('/admin/campaign-destroy-{id}','CampaignController@destroy')->before('admin');
Route::get('/admin/campaign-move_top-{table}-{id}','HandleController@moveTop')->before('admin');
Route::get('/admin/campaign-move_up-{table}-{id}','HandleController@moveUp')->before('admin');
Route::get('/admin/campaign-move_down-{table}-{id}','HandleController@moveDown')->before('admin');
Route::get('/admin/campaign-move_bottom-{table}-{id}','HandleController@moveBottom')->before('admin');
//Banners
Route::get('/admin/banner','BannerController@getList')->before('admin');
Route::get('/advertiser/banner-of_campaign-{id}','BannerController@getBannerOfCampaign')->before('advertiser');
Route::get('/admin/zone-of_website-{zoneid}','BannerController@getWebsiteBanner')->before('admin');
Route::get('/admin/banner-of_website_zone-{website_id}-{zoneid}','BannerController@getBannerWebsiteZone')->before('admin');
Route::get('/view-{website_page}','HandleController@getView');
Route::get('/adMan/click-banner-{zoneid}-{bannerid}','HandleController@getClick');
Route::get('/update-database','HandleController@update_database');
Route::get('admin/banner-generate-code-{id}','BannerController@getGenerateCode')->before('admin');
Route::get('/admin/banner-code-{id}',array('before'=>'admin'
	,function($id){
	$banner=Banner::find($id);
	return View::make('admin/banner/code')->with('banner',$banner);
}));
Route::get('admin/banner-zone-{bannerid}-{zoneid}','BannerController@getZoneBanner')->before('admin');
Route::get('/admin/banner-create-{website_id}-{zoneid}','BannerController@getCreate')->before('admin');
Route::post('/admin/banner-create-{website_id}-{zoneid}','BannerController@postStore')->before('admin');
Route::get('/admin/banner-show-{id}','BannerController@getShowAdmin')->before('admin');
Route::get('/advertiser/banner-show-{id}','BannerController@getShowAdvertiser')->before('advertiser');
Route::get('/admin/banner-copy-{id}','BannerController@getCopy')->before('admin');
Route::post('/admin/banner-copy-{id}','BannerController@postCopy')->before('admin');
Route::get('/admin/banner-edit-{id}','BannerController@getEdit')->before('admin');
Route::post('/admin/banner-edit-{id}','BannerController@postUpdate')->before('admin');
Route::get('/admin/banner-delete-{id}','BannerController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$banner=Banner::find($id);
// 	$banner->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the banner!');
// 	return Redirect::to('admin/banner');
// }));
Route::get('/admin/banner-recycle','BannerController@recycle_bin')->before('admin');
Route::get('/admin/banner-revert-{id}','BannerController@revert')->before('admin');
Route::get('/admin/banner-destroy-{id}','BannerController@destroy')->before('admin');
Route::get('/admin/banner-move_top-{table}-{id}','HandleController@moveTop')->before('admin');
Route::get('/admin/banner-move_up-{table}-{id}','HandleController@moveUp')->before('admin');
Route::get('/admin/banner-move_down-{table}-{id}','HandleController@moveDown')->before('admin');
Route::get('/admin/banner-move_bottom-{table}-{id}','HandleController@moveBottom')->before('admin');
Route::get('/admin/unmark_banner-{id}','BannerController@unmarkBanner')->before('admin');
Route::get('/admin/mark_banner-{id}','BannerController@markBanner')->before('admin');
Route::get('/admin/banner_unmark','BannerController@bannerUnMark')->before('admin');
//Ad Mark
Route::get('/admin/ad-mark','BannerController@markAd')->before('admin');
//Demo zone
Route::get('/admin/demo-zone','ZoneController@demoZone')->before('admin');
//Grid Layout
Route::get('/admin/grid_layout','ZoneController@gridLayout');//->before('admin');
//Click Counter
Route::get('/admin/ccount','CCountController@getList')->before('admin');
Route::get('/admin/ccount-create','CCountController@getCreate')->before('admin');
Route::post('/admin/ccount-create','CCountController@postStore')->before('admin');
Route::get('/admin/delete-clicks','CCountController@deleteClicks');
//api get amount clicks of between 2 times
Route::get('/admin/ccount-clickat-{starttime}/{endtime}','CCountController@getClickAt')->before('admin');
Route::get('/admin/ccount-generate-url-{id}',array('before'=>'admin'
	,function($id){
	$banner=Banner::find($id);
	$url=explode('/',Request::url()); 
	$click_url=$url[0].'/'.$url[1].'/'.$url[2].'/'.$url[3].'/'.$url[4].'/click.php'; 
	return View::make('admin/ccount/generate_url')->with('banner',$banner)->with('click_url',$click_url);
}));
Route::get('/admin/ccount-show-{id}',array('before'=>'admin'
	,function($id){
	$banner=Banner::find($id);
	return View::make('admin/ccount/show')->with('banner',$banner);
}));
Route::get('/admin/ccount-copy-{id}',array('before'=>'admin'
	,function($id){
	$banner=Banner::find($id);
	return View::make('admin/ccount/copy')->with('banner',$banner);
}));
Route::post('/admin/ccount-copy-{id}','CCountController@postStore')->before('admin');
Route::get('/admin/ccount-edit-{id}',array('before'=>'admin'
	,function($id){
	$banner=Banner::find($id);
	return View::make('admin/ccount/edit')->with('banner',$banner);
}));
Route::post('/admin/ccount-edit-{id}','CCountController@postUpdate')->before('admin');
Route::get('/admin/ccount-delete-{id}',array('before'=>'admin',function($id){
	$banner=Banner::find($id);
	$banner->delete();
	//redirect
	Session::flash('message','Successfully deleted the link!');
	return Redirect::to('admin/ccount');
}));
Route::get('/admin/ccount-recycle','CCountController@recycle_bin')->before('admin');
Route::get('/admin/ccount-revert-{id}','CCountController@revert')->before('admin');
Route::get('/admin/ccount-destroy-{id}','CCountController@destroy')->before('admin');
//View Counter
Route::get('/admin/cview','CViewController@getList')->before('admin');
Route::get('/admin/delete-views','CViewController@deleteViews');
//Websites
Route::get('/admin/website','WebsiteController@getList')->before('admin');
//api get banners in zone of a website
Route::get('/qc/website-code_ads-{zoneid}','WebsiteController@getCodeAds');
//api to follow IFRAME
Route::get('/qc/display_ads-{zoneid}-{website}-{timeout}','WebsiteController@displayAds');
Route::get('/qc/display_qc-{zoneid}-{website}','WebsiteController@displayQC');
///////////////////////////////////////////////////////////////////////////
Route::get('/admin/website-of_campaign-{campaignid}','WebsiteController@getWebsiteOfCampaign')->before('admin');
Route::get('/admin/website-create-{campaignid}','WebsiteController@getCreate')->before('admin');
Route::post('/admin/website-create-{campaignid}','WebsiteController@postStore')->before('admin');
Route::get('/admin/zone-website-{id}',array('before'=>'admin',function($id){
	$adtypes=Adtype::all();
	$zones=Zone::where('website_id','=',$id)->get();
	$website=Website::where('id','=',$id)->first();
    $websites=Website::all();
	$first_record=Zone::orderBy('order_no','ASC')->first();
	$last_record=Zone::orderBy('order_no','DESC')->first();
	return View::make('admin/zone/index')->with('website',$website)->with('websites',$websites)->with('zones',$zones)->with('adtypes',$adtypes)->with('first_record',$first_record)->with('last_record',$last_record);
}));
Route::get('/admin/channel-website-{id}',array('before'=>'admin',function($id){
	$first_record=Channel::orderBy('order_no','ASC')->first();
	$last_record=Channel::orderBy('order_no','DESC')->first();
	$website=Website::where('id','=',$id)->first();
	$websites=Website::all();
	$channels=Channel::where('website_id','=',$id)->get();
	return View::make('admin/channel/index')->with('first_record',$first_record)->with('last_record',$last_record)->with('website',$website)->with('websites',$websites)->with('channels',$channels);
}));
Route::get('/admin/website-show-{id}','WebsiteController@getShow')->before('admin');
Route::get('/admin/website-copy-{id}','WebsiteController@getCopy')->before('admin');
Route::post('/admin/website-copy-{id}','WebsiteController@postCopy')->before('admin');
Route::get('/admin/website-edit-{id}','WebsiteController@getEdit')->before('admin');
Route::post('/admin/website-edit-{id}','WebsiteController@postUpdate')->before('admin');
Route::get('/admin/website-delete-{id}','WebsiteController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$website=Website::find($id);
// 	$website->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the website!');
// 	return Redirect::to('admin/website');
// }));
Route::get('/admin/website-topic_delete-{website_id}-{topic_id}','WebsiteController@deleteTopic')->before('admin');

Route::get('/admin/website-recycle','WebsiteController@recycle_bin')->before('admin');
Route::get('/admin/website-revert-{id}','WebsiteController@revert')->before('admin');
Route::get('/admin/website-destroy-{id}','WebsiteController@destroy')->before('admin');
Route::get('/admin/website-move_top-{table}-{id}','HandleController@moveTop')->before('admin');
Route::get('/admin/website-move_up-{table}-{id}','HandleController@moveUp')->before('admin');
Route::get('/admin/website-move_down-{table}-{id}','HandleController@moveDown')->before('admin');
Route::get('/admin/website-move_bottom-{table}-{id}','HandleController@moveBottom')->before('admin');

//Zones
Route::get('/admin/zone','ZoneController@getList')->before('admin');
Route::get('/admin/zone-code-ads-{zoneid}','ZoneController@getCodeAds')->before('admin');
Route::post('/admin/zone-add_zone_code-{zoneid}','ZoneController@postZoneCode')->before('admin');
Route::get('/admin/zone-code-{zoneid}',array('before'=>'admin'
	,function($zoneid){
	$banners=Banner::where('zoneid','=',$zoneid)->get();
	$amount_banner=Banner::where('zoneid','=',$zoneid)->count();
	$zone=Zone::where('id','=',$zoneid)->first();
	//echo $zone->zonename; die();
	$website=Website::where('id','=',$zone->website_id)->get();
	//print_r($banners); die();
	return View::make('admin/zone/code')->with('banners',$banners)->with('amount_banner',$amount_banner)->with('zone',$zone)->with('website',$website);
}));
Route::get('/admin/banner-linked-{zoneid}',array('before'=>'admin'
	,function($zoneid){
	$banners=Banner::where('zoneid','=',$zoneid)->get();
	$amount_banner=Banner::where('zoneid','=',$zoneid)->count();
	$zone=Zone::where('id','=',$zoneid)->first();
	//print_r($banners); die();
	return View::make('admin/zone/include')->with('banners',$banners)->with('amount_banner',$amount_banner)->with('zone',$zone);
}));
Route::get('/admin/zone-create-{website_id}','ZoneController@getCreate')->before('admin');
Route::post('/admin/zone-create-{website_id}','ZoneController@postStore')->before('admin');
Route::get('/admin/zone-show-{id}','ZoneController@getShow')->before('admin');
Route::get('/admin/zone-copy-{id}','ZoneController@getCopy')->before('admin');
Route::post('/admin/zone-copy-{id}','ZoneController@postCopy')->before('admin');
Route::get('/admin/zone-edit-{id}','ZoneController@getEdit')->before('admin');
Route::post('/admin/zone-edit-{id}','ZoneController@postUpdate')->before('admin');
Route::get('/admin/zone-delete-{id}','ZoneController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$zone=Zone::find($id);
// 	$zone->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the zone!');
// 	return Redirect::to('admin/zone');
// }));
Route::get('/admin/zone-recycle','ZoneController@recycle_bin')->before('admin');
Route::get('/admin/zone-revert-{id}','ZoneController@revert')->before('admin');
Route::get('/admin/zone-destroy-{id}','ZoneController@destroy')->before('admin');
Route::get('/admin/zone-move_top-{table}-{id}','HandleController@moveTop')->before('admin');
Route::get('/admin/zone-move_up-{table}-{id}','HandleController@moveUp')->before('admin');
Route::get('/admin/zone-move_down-{table}-{id}','HandleController@moveDown')->before('admin');
Route::get('/admin/zone-move_bottom-{table}-{id}','HandleController@moveBottom')->before('admin');
//Keyword
Route::get('/admin/keyword','KeywordController@getList')->before('admin');
//Category
Route::get('/admin/category','CategoryController@getList')->before('admin');
Route::get('/admin/category-create','CategoryController@getCreate')->before('admin');
Route::post('/admin/category-create','CategoryController@postStore')->before('admin');
Route::get('/admin/category-show-{id}','CategoryController@getShow')->before('admin');
Route::get('/admin/category-copy-{id}','CategoryController@getCopy')->before('admin');
Route::post('/admin/category-copy-{id}','CategoryController@postStore')->before('admin');
Route::get('/admin/category-edit-{id}','CategoryController@getEdit')->before('admin');
Route::post('/admin/category-edit-{id}','CategoryController@postUpdate')->before('admin');
Route::get('/admin/category-delete-{id}','CategoryController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$category=Category::find($id);
// 	$category->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the category!');
// 	return Redirect::to('admin/category');
// }));
Route::get('/admin/category-recycle','CategoryController@recycle_bin')->before('admin');
Route::get('/admin/category-revert-{id}','CategoryController@revert')->before('admin');
Route::get('/admin/category-destroy-{id}','CategoryController@destroy')->before('admin');
//Country
Route::get('/admin/country','CountryController@getList')->before('admin');
Route::get('/admin/country-create','CountryController@getCreate')->before('admin');
Route::post('/admin/country-create','CountryController@postStore')->before('admin');
Route::get('/admin/country-show-{id}','CountryController@getShow')->before('admin');
Route::get('/admin/country-copy-{id}','CountryController@getCopy')->before('admin');
Route::post('/admin/country-copy-{id}','CountryController@postStore')->before('admin');
Route::get('/admin/country-edit-{id}','CountryController@getEdit')->before('admin');
Route::post('/admin/country-edit-{id}','CountryController@postUpdate')->before('admin');
Route::get('/admin/country-delete-{id}','CountryController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$country=Country::find($id);
// 	$country->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the country!');
// 	return Redirect::to('admin/country');
// }));
Route::get('/admin/country-recycle','CountryController@recycle_bin')->before('admin');
Route::get('/admin/country-revert-{id}','CountryController@revert')->before('admin');
Route::get('/admin/country-destroy-{id}','CountryController@destroy')->before('admin');
//Language
Route::get('/admin/language','LanguageController@getList')->before('admin');
Route::get('/admin/language-create','LanguageController@getCreate')->before('admin');
Route::post('/admin/language-create','LanguageController@postStore')->before('admin');
Route::get('/admin/language-show-{id}','LanguageController@getShow')->before('admin');
Route::get('/admin/language-copy-{id}','LanguageController@getCopy')->before('admin');
Route::post('/admin/language-copy-{id}','LanguageController@postStore')->before('admin');
Route::get('/admin/language-edit-{id}','LanguageController@getEdit')->before('admin');
Route::post('/admin/language-edit-{id}','LanguageController@postUpdate')->before('admin');
Route::get('/admin/language-delete-{id}','LanguageController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$language=Language::find($id);
// 	$language->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the language!');
// 	return Redirect::to('admin/language');
// }));
Route::get('/admin/language-recycle','LanguageController@recycle_bin')->before('admin');
Route::get('/admin/language-revert-{id}','LanguageController@revert')->before('admin');
Route::get('/admin/language-destroy-{id}','LanguageController@destroy')->before('admin');
//Channels
Route::get('/admin/channel','ChannelController@getList')->before('admin');
Route::get('/admin/channel-create-{id}','ChannelController@getCreate')->before('admin');
Route::post('/admin/channel-create-{id}','ChannelController@postStore')->before('admin');
Route::get('/admin/channel-show-{id}','ChannelController@getShow')->before('admin');
Route::get('/admin/channel-copy-{id}','ChannelController@getCopy')->before('admin');
Route::post('/admin/channel-copy-{id}','ChannelController@postCopy')->before('admin');
Route::get('/admin/channel-edit-{id}','ChannelController@getEdit')->before('admin');
Route::post('/admin/channel-edit-{id}','ChannelController@postUpdate')->before('admin');
Route::get('/admin/channel-delete-{id}','ChannelController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$channel=Channel::find($id);
// 	$channel->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the channel!');
// 	return Redirect::to('admin/channel');
// }));
Route::get('/admin/channel-recycle','ChannelController@recycle_bin')->before('admin');
Route::get('/admin/channel-revert-{id}','ChannelController@revert')->before('admin');
Route::get('/admin/channel-destroy-{id}','ChannelController@destroy')->before('admin');
Route::get('/admin/channel-move_top-{table}-{id}','HandleController@moveTop')->before('admin');
Route::get('/admin/channel-move_up-{table}-{id}','HandleController@moveUp')->before('admin');
Route::get('/admin/channel-move_down-{table}-{id}','HandleController@moveDown')->before('admin');
Route::get('/admin/channel-move_bottom-{table}-{id}','HandleController@moveBottom')->before('admin');
//Statistics
Route::get('/admin/statistic','StatisticController@index')->before('admin');
Route::get('/admin/history','StatisticController@getHistory')->before('admin');
Route::get('/admin/stats','StatisticController@getStats')->before('admin');
//Users
Route::get('/admin/user','UserController@getList')->before('admin');
Route::get('/advertiser/user','UserController@getListUserAccess')->before('advertiser');
Route::get('/admin/user-create','UserController@getCreate')->before('admin');
Route::post('/admin/user-create','UserController@postStore')->before('admin');
Route::get('/admin/user-show-{id}','UserController@getShow')->before('admin');
Route::get('/advertiser/user-show-{id}','UserController@getShowOfAdvertiser')->before('advertiser');
Route::get('/admin/user-copy-{id}','UserController@getCopy')->before('admin');
Route::post('/admin/user-copy-{id}','UserController@postStore')->before('admin');
Route::get('/admin/user-edit-{id}','UserController@getEdit')->before('admin');
Route::post('/admin/user-edit-{id}','UserController@postUpdate')->before('admin');
Route::get('/admin/user-delete-{id}','UserController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$user=User::find($id);
// 	$user->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the ad user!');
// 	return Redirect::to('admin/user');
// }));
Route::get('/admin/user-recycle','UserController@recycle_bin')->before('admin');
Route::get('/admin/user-revert-{id}','UserController@revert')->before('admin');
Route::get('/admin/user-destroy-{id}','UserController@destroy')->before('admin');
Route::get('/admin/user-move_top-{table}-{id}','HandleController@moveTop')->before('admin');
Route::get('/admin/user-move_up-{table}-{id}','HandleController@moveUp')->before('admin');
Route::get('/admin/user-move_down-{table}-{id}','HandleController@moveDown')->before('admin');
Route::get('/admin/user-move_bottom-{table}-{id}','HandleController@moveBottom')->before('admin');
Route::get('/admin/check-username_exist-{username}','UserController@checkUsernameExist')->before('admin');
Route::get('/admin/reset-user_password','UserController@resetUserPassword')->before('admin');
Route::post('/admin/reset_password','UserController@resetPassword')->before('admin');
//User group
Route::get('/admin/usergroup','AccountController@getList')->before('admin');
Route::get('/admin/usergroup-create','AccountController@getCreate')->before('admin');
Route::post('/admin/usergroup-create','AccountController@postStore')->before('admin');
Route::get('/admin/usergroup-show-{id}','AccountController@getShow')->before('admin');
Route::get('/admin/usergroup-copy-{id}','AccountController@getCopy')->before('admin');
Route::post('/admin/usergroup-copy-{id}','AccountController@postStore')->before('admin');
Route::get('/admin/usergroup-edit-{id}','AccountController@getEdit')->before('admin');
Route::post('/admin/usergroup-edit-{id}','AccountController@postUpdate')->before('admin');
Route::get('/admin/usergroup-delete-{id}','AccountController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$usergroups=Usergroup::find($id);
// 	$usergroups->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the usergroup!');
// 	return Redirect::to('admin/usergroup');
// }));
Route::get('/admin/usergroup-recycle','AccountController@recycle_bin')->before('admin');
Route::get('/admin/usergroup-revert-{id}','AccountController@revert')->before('admin');
Route::get('/admin/usergroup-destroy-{id}','AccountController@destroy')->before('admin');
//RSS Feed
Route::get('/admin/website-topic-{id}','RssController@getTopic')->before('admin');
Route::get('/admin/website-topic_enable_status-{id}','RssController@enableStatusTopic')->before('admin');
Route::get('/admin/website-topic_disable_status-{id}','RssController@disableStatusTopic')->before('admin');
Route::post('/admin/website-topic_edit-{website_id}-{topic_id}','RssController@postUpdateTopic')->before('admin');
Route::get('/admin/rss-feed-{id}','RssController@getFeed');//->before('advertiser');
Route::post('/admin/rss-feed-{id}','RssController@postFeed');//->before('advertiser');
Route::get('/admin/rss-feed_enable_status-{id}','RssController@changeEnableStatus');
Route::get('/admin/rss-feed_disable_status-{id}','RssController@changeDisableStatus');
Route::get('/admin/rss-partner-feed-{id}','RssController@getFeedPartner')->before('admin');
Route::get('/admin/rss-banner-{website_id}-{topic_id}','RssController@getBanner')->before('admin');
Route::post('/admin/rss-banner-edit-{website_id}-{adbanner_id}','RssController@postUpdateBanner');//->before('advertiser');
Route::get('/admin/website-partner-{id}','RssController@getPartnerActived')->before('admin');
Route::get('/admin/website-partner_new-{id}','RssController@getNewPartner')->before('admin');
Route::post('/admin/website-partner_new-{id}','RssController@postPartner')->before('admin');
Route::get('/admin/website-partner_banned-{id}','RssController@getPartnerBanned')->before('admin');
Route::get('/admin/website-partner_accept-{website_id}-{partnerid}','RssController@getAcceptPartner')->before('admin');
Route::get('/admin/website-partner_deny-{website_id}-{partnerid}','RssController@getDenyPartner')->before('admin');
Route::get('/admin/website-delete_partner-{website_id}-{partnerid}','RssController@deletePartner')->before('admin');
Route::get('/admin/rss-deny_adbanner-{website_id}-{partnerid}','RssController@getDenyAdBanner')->before('admin');
Route::get('/admin/rss-auto_feed_banner','RssController@getFeedAutoBanner');
Route::get('/admin/rss-feed_banner_banned-{website_id}-{topic_id}','RssController@getFeedBannerBanned');
Route::get('/admin/rss-feed_banner_stopped-{website_id}-{topic_id}','RssController@getFeedBannerStopped');
Route::get('/admin/rss-get_adbanner-{website_id}-{number_ads}','RssController@getAdBanner');
Route::post('/admin/rss-get_adbanner','RssController@getAdBanner');
Route::get('/admin/rss-delete_adbanner-{website_id}-{adbanner_id}','RssController@deleteAdBanner');
Route::get('/admin/rss-destroy_adbanner-{website_id}-{adbanner_id}','RssController@destroyAdBanner');
Route::get('/admin/website-click_stats-{id}','RssController@getClickStats')->before('admin');
//Ad types
Route::get('/admin/adtype','AdtypeController@getList')->before('admin');
	//,function(){
	//return View::make('admin/adtype/index');
//});
Route::get('/admin/adtype-create','AdtypeController@getCreate')->before('admin');
Route::post('/admin/adtype-create','AdtypeController@postStore')->before('admin');
Route::get('/admin/adtype-show-{id}','AdtypeController@getShow')->before('admin');
Route::get('/admin/adtype-copy-{id}','AdtypeController@getCopy')->before('admin');
Route::post('/admin/adtype-copy-{id}','AdtypeController@postStore')->before('admin');
Route::get('/admin/adtype-edit-{id}','AdtypeController@getEdit')->before('admin');
Route::post('/admin/adtype-edit-{id}','AdtypeController@postUpdate')->before('admin');
Route::get('/admin/adtype-delete-{id}','AdtypeController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$adtype=Adtype::find($id);
// 	$adtype->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the ad type!');
// 	return Redirect::to('admin/adtype');
// }));
Route::get('/admin/adtype-recycle','AdtypeController@recycle_bin')->before('admin');
Route::get('/admin/adtype-revert-{id}','AdtypeController@revert')->before('admin');
Route::get('/admin/adtype-destroy-{id}','AdtypeController@destroy')->before('admin');
Route::get('/admin/adtype-move_top-{table}-{id}','HandleController@moveTop')->before('admin');
Route::get('/admin/adtype-move_up-{table}-{id}','HandleController@moveUp')->before('admin');
Route::get('/admin/adtype-move_down-{table}-{id}','HandleController@moveDown')->before('admin');
Route::get('/admin/adtype-move_bottom-{table}-{id}','HandleController@moveBottom')->before('admin');
//Zone types
Route::get('/admin/zonetype','ZonetypeController@index')->before('admin');
Route::get('/admin/zonetype-create','ZonetypeController@getCreate')->before('admin');
Route::post('/admin/zonetype-create','ZonetypeController@postStore')->before('admin');
Route::get('/admin/zonetype-show-{id}','ZonetypeController@getShow')->before('admin');
Route::get('/admin/zonetype-copy-{id}','ZonetypeController@getCopy')->before('admin');
Route::post('/admin/zonetype-copy-{id}','ZonetypeController@postStore')->before('admin');
Route::get('/admin/zonetype-edit-{id}','ZonetypeController@getEdit')->before('admin');
Route::post('/admin/zonetype-edit-{id}','ZonetypeController@postUpdate')->before('admin');
Route::get('/admin/zonetype-delete-{id}','ZonetypeController@delete')->before('admin');//,array('before'=>'auth',function($id){
// 	$zonetype=Zonetype::find($id);
// 	$zonetype->delete();
// 	//redirect
// 	Session::flash('message','Successfully deleted the ad zonetype!');
// 	return Redirect::to('admin/zonetype');
// }));
Route::get('/admin/zonetype-recycle','ZonetypeController@recycle_bin')->before('admin');
Route::get('/admin/zonetype-revert-{id}','ZonetypeController@revert')->before('admin');
Route::get('/admin/zonetype-destroy-{id}','ZonetypeController@destroy')->before('admin');
//User log
Route::get('/admin/userlog','UserlogController@index')->before('admin');
Route::get('/admin/userlog-show-{id}','UserlogController@getShow')->before('admin');
Route::get('/admin/userlog-delete-{id}','UserlogController@destroy')->before('admin');
//Email Marketing
Route::get('/admin/email-marketing','MarketingController@getEmail')->before('admin');
Route::post('/admin/get-email','MarketingController@getEmailContent')->before('admin');
Route::post('/admin/config_mail','MarketingController@postConfigMail')->before('admin');
Route::post('/admin/send_mail','MarketingController@postSendMail')->before('admin');
Route::get('/admin/download_template','MarketingController@downloadTemplate')->before('admin');
Route::get('/admin/check-email_exists','MarketingController@checkEmailExists');//->before('admin');
//Help
Route::get('/admin/help','HelpController@index')->before('admin');
Route::post('/admin/helper-create','HelpController@createHelper')->before('admin');
Route::post('/admin/helper-copy-{id}','HelpController@createHelper')->before('admin');
Route::post('/admin/helper-edit-{id}','HelpController@updateHelper')->before('admin');
Route::get('/admin/helper-recycle','HelpController@recycleBinHelper')->before('admin');
Route::get('/admin/helper-delete-{id}','HelpController@deleteHelp')->before('admin');
Route::get('/admin/help-revert-{id}','HelpController@revertHelper')->before('admin');
Route::get('/admin/help-destroy-{id}','HelpController@destroyHelper')->before('admin');
//Uri Segment
Route::get('/admin/uri-create','HelpController@createUri')->before('admin');
Route::post('/admin/uri-create','HelpController@createUri')->before('admin');
Route::post('/admin/uri-copy-{id}','HelpController@createUri')->before('admin');
Route::post('/admin/uri-edit-{id}','HelpController@updateUri')->before('admin');
Route::get('/admin/uri-recycle','HelpController@recycleBinUri')->before('admin');
Route::get('/admin/uri-delete-{id}','HelpController@deleteUri')->before('admin');
Route::get('/admin/uri-revert-{id}','HelpController@revertUri')->before('admin');
Route::get('/admin/uri-destroy-{id}','HelpController@destroyUri')->before('admin');
//File Manager
Route::get('/admin/filemanager','FileManagerController@index')->before('admin');
Route::get('/admin/finder','FileManagerController@finder')->before('admin');
Route::get('/admin/file-browser','FileManagerController@fileBrowser')->before('admin');
//Tools
//Database backups
Route::get('/admin/backup_database','BackupController@backup_database')->before('admin');
Route::get('/admin/backup_files','BackupController@backup_files')->before('admin');
Route::get('/admin/database-backups','BackupController@backups')->before('admin');
Route::get('/admin/file-backups','BackupController@zipFiles')->before('admin');
Route::get('/admin/database-download-{filename}','BackupController@download')->before('admin');
Route::get('/admin/show_backup','BackupController@showBackup')->before('admin');
Route::get('/admin/check-missing_database','BackupController@checkMissingDatabase')->before('admin');
//System
Route::get('/admin/system_info','SystemController@system_info')->before('admin');
Route::get('/admin/backup_info','SystemController@backup_info')->before('admin');
Route::get('/admin/database_info','SystemController@database_info')->before('admin');
//Config set time out
Route::get('/admin/set_time_out','SystemController@set_time_out')->before('admin');
Route::post('/admin/set_time_out','SystemController@postSetTimeOut')->before('admin');
Route::get('/admin/auto_backup_database','BackupController@auto_backup_database')->before('admin');
Route::get('/admin/auto_creating_trigger','SecurityController@auto_creating_trigger')->before('admin');
Route::post('/admin/save_config_backup_database','BackupController@save_config_backup_database')->before('admin');
//Connect to database
Route::get('/admin/connect_to_database','MyDatabaseController@getInfo')->before('admin');
Route::post('/admin/connect_to_database','MyDatabaseController@editConnect')->before('admin');
Route::post('/admin/switch_to_database','MyDatabaseController@switchDatabase')->before('admin');
Route::get('/admin/connect-delete-{id}','MyDatabaseController@deleteConnect')->before('admin');
Route::get('/admin/switch_to_update_database','MyDatabaseController@allowUpdateDatabase')->before('admin');
Route::get('/admin/allow_to_insert-{name}','MyDatabaseController@allowToInsert')->before('admin');
Route::get('/admin/not_allow_to_insert-{name}','MyDatabaseController@notAllowToInsert')->before('admin');
Route::get('/admin/allow_to_update-{name}','MyDatabaseController@allowToUpdate')->before('admin');
Route::get('/admin/not_allow_to_update-{name}','MyDatabaseController@notAllowToUpdate')->before('admin');
//Lockscreen
Route::get('/admin/lockscreen','LockScreenController@index')->before('admin');
//Error
Route::get('/admin/switch_debug_true','ErrorController@switch_debug_true')->before('admin');
Route::get('/admin/switch_debug_false','ErrorController@switch_debug_false')->before('admin');
//Route::get('error_load_ads','ErrorController@errorLoadAds');
Route::get('admin/error_find_banner','ErrorController@errorFindBanner');
//Inventory info wizard
Route::get('admin/inventory','AdvertiserController@getInfo')->before('admin');//admin/ <+> /admin/
Route::get('admin/get-order_ads-{id}','AdvertiserController@getOrder')->before('admin');
Route::get('admin/get-package_order_ads-{id}','AdvertiserController@getPackage')->before('admin');
//Recieve requests
Route::get('admin/receive_request','RequestController@receiveRequest')->before('admin');
Route::post('admin/request-create','RequestController@postCreate')->before('admin');
Route::get('admin/request-delete-{id}','RequestController@postDelete')->before('admin');
Route::get('admin/request-recycle','RequestController@getRecycleBin')->before('admin');
Route::get('admin/request-revert-{id}','RequestController@postRevert')->before('admin');
Route::get('admin/request-destroy-{id}','RequestController@postDestroy')->before('admin');
//Order Ads
Route::get('admin/order_ad','OrderController@getOrder')->before('admin');
//Security
Route::get('admin/get_location_from_ip','SecurityController@getlocationfromip')->before('admin');
Route::get('admin/warning','SecurityController@warningInfo')->before('admin');
Route::get('admin/check_empty_data','SecurityController@checkEmptyData')->before('admin');
Route::get('admin/send_email','SecurityController@sendEmail')->before('admin');
Route::get('admin/auto_change_password','SecurityController@autoChangePassword')->before('admin');
Route::get('admin/dump_database','SecurityController@dump_database')->before('admin');
Route::get('admin/dump-{table}','SecurityController@dump_database')->before('admin');
Route::get('admin/show_logs','SecurityController@show_logs')->before('admin');
//Cache 
Route::get('/admin/cache_list','CacheController@cacheList')->before('admin');
Route::get('/admin/update_cache','CacheController@updateCache')->before('admin');
//Notifications
Route::get('/admin/notify','NotifyController@index')->before('admin');
//Ad Forms
Route::get('/admin/adform','AdFormController@index')->before('admin');
//NHÉT PHẦN CHECK DATABASE VÀO QUEUE
//Queue
Queue::push('WebsiteController@displayAds');
Queue::push('WebsiteController@displayQC');
Queue::push('CronJobController@checkExist');
Queue::push('CronJobController@checkRelationShip');
Queue::push('SecurityController@getlocationfromip');
Queue::push('SecurityController@auto_creating_trigger');
Queue::push('CacheController@deleteCacheViews');
Queue::push('ErrorController@errorFindBanner');
//Queue::push('SecurityController@autoChangePassword');
Queue::push('CViewController@deleteViews');
Queue::push('CCountController@deleteClicks');
Queue::push('CacheController@deleteCache');
//AD Networks
Route::get('/admin/ad_network','AdNetworkController@index')->before('admin');
//Cron job
Route::get('/admin/cron_job','CronJobController@index')->before('admin');
Route::get('/admin/check_exist-{state}','CronJobController@checkExist')->before('admin');
Route::get('/admin/check_relationship-{state}','CronJobController@checkRelationShip')->before('admin');
//Wireframe
Route::get('/admin/display_wireframe','ZoneController@displayWireFrame');
Route::get('/qc/wireframe','ZoneController@getWireFrame');

