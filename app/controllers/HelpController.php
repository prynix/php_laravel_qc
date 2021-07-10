<?php

class HelpController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$ur=Uri::where('status','=',1)->get();
		$uri=Uri::where('status','=',1)->get();
		$uri_id=Helper::where('status','=',1)->get();
		if($uri_id->lists('uri_id')){
			$url=Uri::where('id','>',0);
			$tag=Uri::where('id','>',0);
			for($i=0;$i<count($uri_id->lists('uri_id'));$i++){ //echo '<pre/>'; print_r(explode(', ', $uri_id->lists('uri_id')[$i])); 
				for($j=0;$j<count(explode(', ', $uri_id->lists('uri_id')[$i]));$j++){ 
					$url=$url->where('id','!=',trim(explode(', ', $uri_id->lists('uri_id')[$i])[$j])); //echo explode(', ', $uri_id->lists('uri_id')[$i])[$j];
					$tag=$tag->where('id','=',trim(explode(', ', $uri_id->lists('uri_id')[$i])[$j]));
					
					//$tag=$tag->orWhere('id','=',explode(', ', $uri_id->lists('uri_id')[$i])[$j]);
					
				}	
			}	
			$url=$url->get();
			$tag=$tag->get();
		}else{
			$url=Uri::where('status','=',1)->get();
			$tag=Uri::where('status','=',1)->get();
		} //echo '<pre/>'; print_r($tag); die();
		//$url=Uri::join('data_helper','data_uri.id','!=','data_helper.uri_id')->get();  
		return View::make('admin/help/index')->with('ur',$ur)->with('uri',$uri)->with('url',$url)->with('tag',$tag)->with('uri_id',$uri_id);
	}

	public function recycleBinUri(){
		$uri=Uri::where('status','=',0)->get();
		return View::make('admin/help/recycle_uri')->with('uri',$uri);
	}
	public function recycleBinHelper(){
		$ur=Uri::where('status','=',1)->get();
		$help=Helper::where('status','=',0)->get();
		return View::make('admin/help/recycle_helper')->with('ur',$ur)->with('help',$help);
	}
	public function revertUri($id){
		Uri::where('id','=',$id)->update(
			array(
				'status'=>1
			)
		);
		Session::flash('success','Successfully reverted the uri!');
		return Redirect::to('admin/help#tab-1');
	}
	public function revertHelper($id){
		Helper::where('id','=',$id)->update(
			array(
				'status'=>1
			)
		);
		Session::flash('success','Successfully reverted the content helper!');
		return Redirect::to('admin/help#tab-2');
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createUri()
	{	
		$rules=array(
			'uri_segment'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/help#tab-1')->withErrors($validator);	
		}else{
			$uri=new Uri;
			$uri->uri_segment=trim(Input::get('uri_segment'));
			$uri->save();
			Session::flash('success','Create uri successfully!');
			return Redirect::to('admin/help#tab-1');
		}
	}
	
	public function createHelper()
	{
		$rules=array(
			//'uri_id[]'=>'required',
			'content_helper_en'=>'required',
			'content_helper_vi'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/help#tab-2')->withErrors($validator);	
		}else{
			$helper=new Helper;
			$uid='';
			$uri_id=Input::get('uri_id');
			foreach($uri_id as $uri_id){
				$uid.=$uri_id.', ';
			}
			$helper->uri_id=$uid;
			$helper->content_helper_en=Input::get('content_helper_en');
			$helper->content_helper_vi=Input::get('content_helper_vi');
			$helper->save(); 
			//print_r($uri_id); die();
			foreach(explode(', ',$helper->uri_id) as $ur){
				Uri::where('id','=',$ur)->update(
					array(
						'helper_id'=>$helper->id
					)
				);
			}
			Session::flash('success','Create content helper successfully!');
			return Redirect::to('admin/help#tab-2');
		}
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	public function updateUri($id)
	{
		$rules=array(
			'uri_segment'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/help')->withErrors($validator);	
		}else{
			$uri=Uri::find($id);
			$uri->uri_segment=trim(Input::get('uri_segment'));
			$uri->save();
			Session::flash('success','Edit uri successfully!');
			return Redirect::to('admin/help#tab-1');
		}
	}
	public function updateHelper($id){
		$rules=array(
			//'uri_id[]'=>'required',
			'content_helper_en'=>'required',
			'content_helper_vi'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/help#tab-2')->withErrors($validator);	
		}else{
			$helper=Helper::find($id);
			$uid='';
			$ul=Input::get('uri_id');
			$uri_id=Input::get('uri_id');
			if($uri_id){
				foreach($uri_id as $uri_id){
					$uid.=$uri_id.', ';
				}
				$helper->uri_id=$uid;
			}
			$helper->content_helper_en=Input::get('content_helper_en');
			$helper->content_helper_vi=Input::get('content_helper_vi');
			$helper->save(); 
			if($ul){
				Uri::where('helper_id','=',$id)->update(
					array(
						'helper_id'=>0
					)
				);
				foreach($ul as $ur){ 
					Uri::where('id','=',$ur)->update(
						array(
							'helper_id'=>$id
						)
					);
				}
			}
			Session::flash('success','Edit content helper successfully!');
			return Redirect::to('admin/help#tab-2');
		}
	}

	public function deleteUri($id){
		Uri::where('id','=',$id)->update(
			array(
				'status'=>0
			)
		);
		Session::flash('warning','Delete uri successfully!');
		return Redirect::to('admin/help#tab-1');
	}
	public function deleteHelp($id){
		Helper::where('id','=',$id)->update(
			array(
				'status'=>0
			)
		);
		Session::flash('warning','Delete content helper successfully!');
		return Redirect::to('admin/help#tab-2');
	}
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyUri($id)
	{
		$uri=Uri::find($id);
		$uri->delete();
		Session::flash('danger','Destroy uri successfully!');
		return Redirect::to('admin/uri-recycle');
	}
	public function destroyHelper($id)
	{
		$help=Helper::find($id);
		$help->delete();
		Session::flash('danger','Destroy content helper successfully!');
		return Redirect::to('admin/helper-recycle');
	}


}
