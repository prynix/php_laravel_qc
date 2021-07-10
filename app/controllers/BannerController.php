<?php

class BannerController extends BaseController {
	public function __construct(){
		$uri=explode('-',Request::segment(2)); 
		if(isset($uri[1])){
			$uri_segment=Uri::where('uri_segment','=',$uri[0].'-'.$uri[1])->get();
		}else{ 
			$uri_segment=Uri::where('uri_segment','=',$uri[0])->get();
		}  
		if(count($uri_segment)>0){ 
			$help=Helper::where('id','=',$uri_segment->lists('helper_id')[0])->where('status','=',1)->get();
		}else{  
			$help=array();
		}
		return $help;
	}
	public function generateRandomString($length){
		$characters='0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength=strlen($characters);
		$randomString='';
		for($i=0;$i<$length;$i++){//random character
			$randomString.=$characters[rand(0,$charactersLength-1)];
		}
		return $randomString;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getList()
	{
        $advertisers=Advertiser::all();
        $campaign=Campaign::where('id','=',0)->first();
        $campaigns=Campaign::all();
		$websites=Website::all();
		$zones=Zone::all();
		$banners=Banner::where('status','=',1)->orderBy('order_no','DESC')->get();
		$first_record=Banner::where('status','=',1)->orderBy('order_no','ASC')->first();
		$last_record=Banner::where('status','=',1)->orderBy('order_no','DESC')->first();
		return View::make('admin/banner/index')->with('advertisers',$advertisers)->with('campaign',$campaign)->with('campaigns',$campaigns)->with('websites',$websites)->with('zones',$zones)->with('banners',$banners)->with('first_record',$first_record)->with('last_record',$last_record)->with('help',$this->__construct());
	}
	public function getWebsiteBanner($zoneid){
		$website=Website::orderBy('id','ASC')->take(1)->get();
		$zone=Zone::where('id','=',$zoneid)->get(); 
		if(isset($zone)){
			return trim($zone->lists('website_id')[0]);
		}else{
			return trim($website->lists('id')[0]);
		}
	}
	public function getBannerOfCampaign($id){
		$advertisers=Advertiser::all();
		$_campaign=Campaign::where('id','=',$id)->first();
        $campaign=Campaign::where('id','=',$id)->get();
		$advertiser=Advertiser::where('id','=',$campaign->lists('clientid')[0])->get();
        $campaigns=Campaign::all(); 
		$websites=Website::all();
		$zones=Zone::all();
		$websites=Website::where('campaignid','=',$id)->get(); 
		$banners=Banner::where('status','=',1);
		for($i=0;$i<count($websites->lists('id'));$i++){   
			$banners=$banners->orWhere('website_id','=',$websites->lists('id')[$i]); 
		}
		$banners=$banners->get();
		$first_record=Banner::orderBy('order_no','ASC')->first();
		$last_record=Banner::orderBy('order_no','DESC')->first();
		return View::make('advertiser/banner/index')->with('advertiser',$advertiser)->with('advertisers',$advertisers)->with('_campaign',$_campaign)->with('campaign',$campaign)->with('campaigns',$campaigns)->with('websites',$websites)->with('zones',$zones)->with('banners',$banners)->with('first_record',$first_record)->with('last_record',$last_record)->with('help',$this->__construct());
	}
	public function getBannerWebsiteZone($website_id,$zoneid){
		$advertisers=Advertiser::all();
        $campaign=Campaign::where('id','=',0)->first();
        $campaigns=Campaign::all();
		$websites=Website::all();
		$zones=Zone::all();
		$banners=Banner::where('website_id','=',$website_id)->where('zoneid','=',$zoneid)->where('status','=',1)->orderBy('order_no','DESC')->get();
		$first_record=Banner::orderBy('order_no','ASC')->first();
		$last_record=Banner::orderBy('order_no','DESC')->first();
		return View::make('admin/banner/index')->with('advertisers',$advertisers)->with('campaign',$campaign)->with('campaigns',$campaigns)->with('websites',$websites)->with('zones',$zones)->with('banners',$banners)->with('first_record',$first_record)->with('last_record',$last_record)->with('help',$this->__construct());
	}
	public function getZoneBanner($bannerid,$zoneid){
		$adtypes=Adtype::all();
		$banner=Banner::where('id','=',$bannerid)->first();
		$zones=Zone::where('id','=',$zoneid)->get();
		return View::make('admin/banner/zone')->with('banner',$banner)->with('zones',$zones)->with('adtypes',$adtypes)->with('help',$this->__construct());
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($website_id,$zoneid)
	{
        $zone=Zone::where('id','=',$zoneid)->get(); //echo '<pre/>'; print_r($zone); die();
		//$campaigns=Campaign::all();
		$zones=Zone::all();
        //$advertiser=Advertiser::where('id','=',$campaign->lists('clientid')[0])->first(); 
        $website=Website::where('id','=',$website_id)->get(); //echo '<pre/>'; print_r($website); die();
		$websites=Website::all();
		$categories=Category::all();
		$adforms=DB::table('adforms')->get(); 
		return View::make('admin/banner/create')->with('adforms',$adforms)->with('zone',$zone)->with('zones',$zones)->with('website',$website)->with('websites',$websites)->with('categories',$categories)->with('help',$this->__construct());
	}

	public function postCopy($id)
	{
		$rules=array(
				'description'=>'required',
				'width'=>'required|numeric',
				'height'=>'required|numeric',
				//'zoneid'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/banner-create')->withErrors($validator);
		}else{
			$date=date('Y-m-d');
			$banner=new Banner;
			$banner->website_id=Input::get('website_id');
			$banner->zoneid=Input::get('zoneid');
			$banner->storagetype=Input::get('storagetype');
			$banner->description=Input::get('description');

			$file=Input::file('filename');
			if($file){
				//$destinationPath='files/';
				//tạo đường dẫn mới cho file
				$destinationPath='uploads/adbanner_images/'.$date.'/'.$this->generateRandomString(2).'/'.$this->generateRandomString(2).'/';
				//              $path=public_path().'/uploads/adbanner_images/'.$date.'/'.$this->generateRandomString(2).'/'.$this->generateRandomString(2).'/';
				              File::makeDirectory($destinationPath,$mode=0777,true,true);
				//$file=str_random(12);
				$filename=$this->generateRandomString(28).'.'.$file->getClientOriginalName();
				//$extension=$file->getClientOriginalExtension();
				//$filename=Input::file('filename.name');
				$banner->filename=$destinationPath.$filename;
				//$upload_success=Input::upload('filename',$destinationPath.$filename);
				Input::file('filename')->move($destinationPath,$filename);
			}
			$banner->htmltemplate=Input::get('htmltemplate');
			$banner->url=Input::get('url');
			$banner->target=Input::get('target');
			$banner->alt=Input::get('alt');
			$banner->statustext=Input::get('statustext');
			$banner->bannertext=Input::get('bannertext_2');
			$banner->imagetext=Input::get('bannertext');
			$banner->width=Input::get('width');
			$banner->height=Input::get('height');
			$banner->keyword=Input::get('keyword');
			$banner->weight=Input::get('weight');
			$banner->comments=Input::get('comments');
			$banner->status=1;
			$last_record=Banner::orderBy('order_no','DESC')->get(); 
			if(count($last_record)>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$banner->order_no=$number;
			$banner->save();
			// copy redis cache
			$redis = RedisHandler::setZoneData($banner->zoneid);

			$userlog=new Userlog;
			$userlog->account_id=Auth::user()->default_account_id;
			$userlog->userid=Auth::user()->id;
			$userlog->username=Auth::user()->username;
			$userlog->action="inserted";
			$userlog->context="Banner";
			$userlog->contextid=$banner->id;
			$userlog->object=$banner->description;
			$userlog->details=Auth::user()->username.' inserted Banner "'.$banner->description.'" (#'.$banner->id.')';
			$userlog->save();
			Session::flash('success','Successfully copied the banner!');
			return Redirect::to('admin/banner');
		}
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore($website_id,$zoneid)
	{	
		$rules=array(
				'description'=>'required',
				'width'=>'required|numeric',
				'height'=>'required|numeric',
				//'zoneid'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){ 
			return Redirect::to('admin/banner-create-'.$website_id.'-'.$zoneid)->withErrors($validator);
		}else{ 
			$date=date('Y-m-d');
			$banner=new Banner;
			$banner->website_id=$website_id;
			$banner->zoneid=$zoneid;
			$banner->storagetype=Input::get('storagetype');
			$banner->description=Input::get('description');
			http://stackoverflow.com/questions/9317842/php-image-upload-checking-dimensions
			$file=Input::file('filename');
			if($file){
				//$destinationPath='files/';
				//tạo đường dẫn mới cho file
				$destinationPath='uploads/adbanner_images/'.$date.'/'.$this->generateRandomString(2).'/'.$this->generateRandomString(2).'/';
				//              $path=public_path().'/uploads/adbanner_images/'.$date.'/'.$this->generateRandomString(2).'/'.$this->generateRandomString(2).'/';
				              File::makeDirectory($destinationPath,$mode=0777,true,true);
				//$file=str_random(12);
				$filename=$this->generateRandomString(28).'.'.$file->getClientOriginalName();
				$filetype=$file->getClientOriginalExtension();
				//$extension=$file->getClientOriginalExtension();
				//$filename=Input::file('filename.name');
				$banner->filename=$destinationPath.$filename;
				$banner->filetype=$filetype;
				//$upload_success=Input::upload('filename',$destinationPath.$filename);
				Input::file('filename')->move($destinationPath,$filename);
			}
			$banner->htmltemplate=Input::get('htmltemplate');
			$banner->url=Input::get('url');
			$banner->target=Input::get('target');
			$banner->alt=Input::get('alt');
			$banner->statustext=Input::get('statustext');
			$banner->bannertext=Input::get('bannertext_2');
			$banner->imagetext=Input::get('bannertext');
			$banner->width=Input::get('width');
			$banner->height=Input::get('height');
			$banner->keyword=Input::get('keyword');
			$banner->weight=Input::get('weight');
			$banner->comments=Input::get('comments');
			$last_record=Banner::orderBy('order_no','DESC')->get();
			if(count($last_record)>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			}
			$banner->order_no=$number;
			$banner->status=1;
			$banner->save();
			// insert redis cache
			$redis = RedisHandler::setZoneData($banner->zoneid);

			$userlog=new Userlog;
			$userlog->account_id=Auth::user()->default_account_id;
			$userlog->userid=Auth::user()->id;
			$userlog->username=Auth::user()->username;
			$userlog->action="inserted";
			$userlog->context="Banner";
			$userlog->contextid=$banner->id;
			$userlog->object=$banner->description;
			$userlog->details=Auth::user()->username.' inserted Banner "'.$banner->description.'" (#'.$banner->id.')';
			$userlog->save();
			Session::flash('success','Successfully created the banner!');
			return Redirect::to('admin/banner');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		$rules=array(
				'description'=>'required',
				'width'=>'required|numeric',
				'height'=>'required|numeric',
				//'zoneid'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/banner-edit-'.$id)->withErrors($validator);
		}else{
			$date=date('Y-m-d');
			$banner=Banner::where('id','=',$id)->get();
			if($banner->lists('filename')[0]!=''){
				$path=explode('/',$banner->lists('filename')[0]);
				$image_path=public_path().'/'.$path[0].'/'.$path[1].'/'.$path[2].'/'.$path[3].'/';
			}
			//print_r($image_path); die();
			$banner=Banner::find($id);
			$banner->website_id=Input::get('website_id');
			$banner->zoneid=Input::get('zoneid');
			$banner->storagetype=Input::get('storagetype');
			$banner->description=Input::get('description');

			$file=Input::file('filename');
			if($file){ 
				if($banner->lists('filename')[0]!=''){
					//xem lại đoạn delete ảnh trong thư mục này
					//File::deleteDirectory($image_path);
				}
				//echo $file;die();
				$destinationPath='uploads/adbanner_images/'.$date.'/'.$this->generateRandomString(2).'/'.$this->generateRandomString(2).'/';
				File::makeDirectory($destinationPath,$mode=0777,true,true);
				$filename=$this->generateRandomString(28).'.'.$file->getClientOriginalName();
				//echo $filename; die();
				//$extension=$file->getClientOriginalExtension();
				//$filename=Input::file('filename.name');
				$banner->filename=$destinationPath.$filename;
				//$upload_success=Input::upload('filename',$destinationPath.$filename);
				Input::file('filename')->move($destinationPath,$filename);
			}
			$banner->htmltemplate=Input::get('htmltemplate');
			$banner->url=Input::get('url');
			$banner->target=Input::get('target');
			$banner->alt=Input::get('alt');
			$banner->statustext=Input::get('statustext');
			$banner->bannertext=Input::get('bannertext_2');
			$banner->imagetext=Input::get('bannertext');
			$banner->width=Input::get('width');
			$banner->height=Input::get('height');
			$banner->keyword=Input::get('keyword');
			$banner->weight=Input::get('weight');
			$banner->status=Input::get('status');
			$banner->comments=Input::get('comments');
			$banner->save();

			// update redis cache
			$redis = RedisHandler::setZoneData($banner->zoneid);

			$userlog=new Userlog;
			$userlog->account_id=Auth::user()->default_account_id;
			$userlog->userid=Auth::user()->id;
			$userlog->username=Auth::user()->username;
			$userlog->action="updated";
			$userlog->context="Banner";
			$userlog->contextid=$banner->id;
			$userlog->object=$banner->description;
			$userlog->details=Auth::user()->username.' updated Banner "'.$banner->description.'" (#'.$banner->id.')';
			$userlog->save();
			Session::flash('success','Successfully updated the banner!');
			return Redirect::to('admin/banner');
		}
	}


	public function delete($id)
	{
		Banner::where('id','=',$id)->update(
		array(
		'status'=>0
		)
		);
		$banner=Banner::where('id','=',$id)->get();
		$userlog=new Userlog;
		$userlog->account_id=Auth::user()->default_account_id;
		$userlog->userid=Auth::user()->id;
		$userlog->username=Auth::user()->username;
		$userlog->action="deleted";
		$userlog->context="Banner";
		$userlog->contextid=$banner->lists('id')[0];
		$userlog->object=$banner->lists('description')[0];
		$userlog->details=Auth::user()->username.' deleted Banner "'.$banner->lists('description')[0].'" (#'.$banner->lists('id')[0].')';
		$userlog->save();
		Session::flash('warning','Successfully deleted the banner!');
		return Redirect::to('admin/banner');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
		$banners=Banner::where('status','=',0)->get();
		return View::make('admin/banner/recycle_bin')->with('banners',$banners)->with('help',$this->__construct());
	}
	public function revert($id)
	{
		Banner::where('id','=',$id)->update(
		array(
		'status'=>1
		)
		);
		$banner=Banner::where('id','=',$id)->get();
		$userlog=new Userlog;
		$userlog->account_id=Auth::user()->default_account_id;
		$userlog->userid=Auth::user()->id;
		$userlog->username=Auth::user()->username;
		$userlog->action="reverted";
		$userlog->context="Banner";
		$userlog->contextid=$banner->lists('id')[0];
		$userlog->object=$banner->lists('description')[0];
		$userlog->details=Auth::user()->username.' reverted Banner "'.$banner->lists('description')[0].'" (#'.$banner->lists('id')[0].')';
		$userlog->save();
		Session::flash('success','Successfully restored the banner!');
		return Redirect::to('admin/banner');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$banner=Banner::where('id','=',$id)->get();
		$path=explode('/',$banner->lists('filename')[0]);
		$image_path=public_path().$path[0].'/'.$path[1].'/'.$path[2].'/'.$path[3].'/';
		//xem lại đoạn delete ảnh trong thư mục này
		//File::deleteDirectory($image_path);
		$banner=Banner::find($id);
		$banner->delete();
		Session::flash('danger','Successfully destroyed the banner!');
		return Redirect::to('admin/banner-recycle');
	}
	public function getShowAdmin($id){
		$campaigns=Campaign::all();
		$zones=Zone::all();
		$categories=Category::all();
		$banner=Banner::find($id);
		$websites=Website::all();
		return View::make('admin/banner/show')->with('banner',$banner)->with('zones',$zones)->with('websites',$websites)->with('categories',$categories)->with('campaigns',$campaigns)->with('help',$this->__construct());	
	}
	public function getShowAdvertiser($id){
		$campaigns=Campaign::all();
		$zones=Zone::all();
		$categories=Category::all();
		$banner=Banner::find($id);
		$website=Website::where('id','=',$banner->lists('website_id')[0])->get();
		$websites=Website::all();
		$campaign=Campaign::where('id','=',$website->lists('campaignid')[0])->get();
		$advertiser=Advertiser::where('id','=',$campaign->lists('clientid')[0])->get();
		return View::make('advertiser/banner/show')->with('campaign',$campaign)->with('advertiser',$advertiser)->with('banner',$banner)->with('zones',$zones)->with('websites',$websites)->with('categories',$categories)->with('campaigns',$campaigns)->with('help',$this->__construct());	
	}
	public function getCopy($id){
		$campaigns=Campaign::all();
		$zones=Zone::all();
		$categories=Category::all();
		$banner=Banner::find($id);
		$websites=Website::all();
		return View::make('admin/banner/copy')->with('banner',$banner)->with('zones',$zones)->with('websites',$websites)->with('categories',$categories)->with('campaigns',$campaigns)->with('help',$this->__construct());	
	}
	public function getEdit($id){
		$campaigns=Campaign::all();
		$zones=Zone::all();
		$categories=Category::all();
		$banner=Banner::find($id);
		$websites=Website::all();
		return View::make('admin/banner/edit')->with('banner',$banner)->with('zones',$zones)->with('websites',$websites)->with('categories',$categories)->with('campaigns',$campaigns)->with('help',$this->__construct());	
	}
	public function markAd(){
		$first_record=Banner::where('status','=',1)->orderBy('order_no','ASC')->first();
		$last_record=Banner::where('status','=',1)->orderBy('order_no','DESC')->first();
		$banners=Banner::all();
		return View::make('admin/banner/mark')->with('banners',$banners)->with('first_record',$first_record)->with('last_record',$last_record)->with('help',$this->__construct());
	}
	public function unmarkBanner($id){
		Banner::where('id','=',$id)->update(
			array(
				'mark'=>0,
				'status'=>0
			)
		); 
	}
	public function markBanner($id){
		Banner::where('id','=',$id)->update(
			array(
				'mark'=>1,
				'status'=>1
			)
		); 
	}
	public function bannerUnMark(){
		$first_record=Banner::where('status','=',1)->orderBy('order_no','ASC')->first();
		$last_record=Banner::where('status','=',1)->orderBy('order_no','DESC')->first();
		$banners=Banner::where('mark','=',0)->get();
		return View::make('admin/banner/mark')->with('banners',$banners)->with('first_record',$first_record)->with('last_record',$last_record)->with('help',$this->__construct());
	}
}
