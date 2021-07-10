<?php

class AccountController extends \BaseController {
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
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getList()
	{
		//kiem tra neu chua co 2 quyen la admin va advertiser thi tu dong them vao co so su lieu
		$acc_parent=Account::where('parent_id','=',0)->where('status','=',1)->get(); //echo '<pre/>'; print_r($acc_parent); die();
		$accounts=Account::where('parent_id','!=',0)->where('status','=',1)->get();
		$number_users=User::join('accounts','users.default_account_id','=','accounts.id')->get();
		return View::make('admin/usergroup/index')->with('acc_parent',$acc_parent)->with('accounts',$accounts)->with('number_users',$number_users)->with('help',$this->__construct());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$usergroups=Usergroup::tree();
		return View::make('admin/usergroup/create')->with('usergroups',$usergroups)->with('help',$this->__construct());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		//validate
		$rules=array(
			'account_name'=>'required',
			'parent_id'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/usergroup-create')->withErrors($validator);
		}else{
			$account=new Usergroup;
			$account->account_name=Input::get('account_name');
			$account->parent_id=Input::get('parent_id');
			
			$account->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="User Group";
            $userlog->contextid=$account->id;
            $userlog->object=$account->account_name;
            $userlog->details=Auth::user()->username.' inserted User Group "'.$account->account_name.'" (#'.$account->id.')';
            $userlog->save();
            Session::flash('success','Successfully created the user group!');
			return Redirect::to('admin/usergroup');
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
			'account_name'=>'required',
			'parent_id'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/usergroup-edit-'.$id)->withErrors($validator);
		}else{
			$account=Usergroup::find($id);
			$account->account_name=Input::get('account_name');
			$account->parent_id=Input::get('parent_id');
			$account->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="updated";
            $userlog->context="User Group";
            $userlog->contextid=$account->id;
            $userlog->object=$account->account_name;
            $userlog->details=Auth::user()->username.' updated User Group "'.$account->account_name.'" (#'.$account->id.')';
            $userlog->save();
            Session::flash('success','Successfully updated the user group!');
			return Redirect::to('admin/usergroup');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		//delete user group parent must delete user group child, change status=0
		$admin=Usergroup::where('account_name','=','Administrator')->get();
		$advertiser=Usergroup::where('account_name','=','Advertiser')->get();
		$count_usergroup_admin=Usergroup::where('id','=',$id)->where('account_name','=','Administrator')->count();
		$count_usergroup_advertiser=Usergroup::where('id','=',$id)->where('account_name','=','Advertiser')->count();
		//echo '<pre/>'; print_r($count_special_usergroup); die();
		if($count_usergroup_admin>0||$count_usergroup_advertiser>0){
			Session::flash('warning',"Don't allow to delete user group default !");
		}else{
			$count_childgroup=Usergroup::where('id','=',$id)->where('parent_id','!=',0)->count(); //echo '<pre/>'; print_r($count_childgroup); die();
			$count_childgroup_admin=Usergroup::where('id','=',$id)->where('parent_id','=',$admin->lists('id')[0])->count();
			$count_childgroup_advertiser=Usergroup::where('id','=',$id)->where('parent_id','=',$advertiser->lists('id')[0])->count();  
			if($count_childgroup>0||$count_childgroup_admin>0||$count_childgroup_advertiser>0){
				Usergroup::where('id','=',$id)->where('parent_id','=',$admin->lists('id')[0])->update(
								array(
									'status'=>-1
								)
							);
				Usergroup::where('id','=',$id)->where('parent_id','=',$advertiser->lists('id')[0])->update(
								array(
									'status'=>-1
								)
							);
				Usergroup::where('id','=',$id)->where('parent_id','!=',0)->update(
								array(
									'status'=>-1
								)
							);
			}else{
				$usergroup=Usergroup::where('id','=',$id)->update(
								array(
									'status'=>0
								)
							);
			}
			$child_group=Usergroup::where('parent_id','=',$id)->update(
								array(
									'status'=>0
								)
							);
	        $account=Usergroup::where('id','=',$id)->get(); 
	        $userlog=new Userlog;
	        $userlog->account_id=Auth::user()->default_account_id;
	        $userlog->userid=Auth::user()->id;
	        $userlog->username=Auth::user()->username;
	        $userlog->action="deleted";
	        $userlog->context="User Group";
	        $userlog->contextid=$account->lists('id')[0];
	        $userlog->object=$account->lists('account_name')[0];
	        $userlog->details=Auth::user()->username.' deleted User Group "'.$account->lists('account_name')[0].'" (#'.$account->lists('id')[0].')';
	        $userlog->save();
	        Session::flash('warning','Successfully deleted the user group!');
	    }
	    return Redirect::to('admin/usergroup');
	}

    /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
		$acc_parent=Account::where('parent_id','=',0)->where('status','=',0)->get(); //echo '<pre/>'; print_r($acc_parent); die();
		$accounts=Account::where('parent_id','!=',0)->where('status','=',0)->get(); //echo '<pre/>'; print_r($accounts); die();
		$exceptions=Account::where('parent_id','!=',0)->where('status','=',-1)->get(); 
        //$accounts=Account::where('status','=',0)->get();
		$number_users=User::join('accounts','users.default_account_id','=','accounts.id')->get();
		return View::make('admin/usergroup/recycle_bin')->with('acc_parent',$acc_parent)->with('accounts',$accounts)->with('exceptions',$exceptions)->with('number_users',$number_users)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Usergroup::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $child_group=Usergroup::where('parent_id','=',$id)->update(
								array(
									'status'=>1
								)
							);
        $account=Usergroup::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="User Group";
        $userlog->contextid=$account->lists('id')[0];
        $userlog->object=$account->lists('account_name')[0];
        $userlog->details=Auth::user()->username.' reverted User Group "'.$account->lists('account_name')[0].'" (#'.$account->lists('id')[0].')';
        $userlog->save();
        Session::flash('success','Successfully reverted the user group!');
        return Redirect::to('admin/usergroup');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
    public function destroy($id)
	{
        $usergroups=Usergroup::find($id);
        $usergroups->delete();
        Session::flash('danger','Successfully destroyed the user group!');
        return Redirect::to('admin/usergroup-recycle');
    }
	
	public function getShow($id){
		$usergroups=Usergroup::tree();
		$usergroup=Usergroup::find($id);
		return View::make('admin/usergroup/show')->with('usergroup',$usergroup)->with('usergroups',$usergroups)->with('help',$this->__construct());
	}
	
	public function getCopy($id){
		$usergroups=Usergroup::tree();
		$usergroup=Usergroup::find($id);
		return View::make('admin/usergroup/copy')->with('usergroup',$usergroup)->with('usergroups',$usergroups)->with('help',$this->__construct());
	}
	
	public function getEdit($id){
		$usergroups=Usergroup::tree();
		$usergroup=Usergroup::find($id);
		return View::make('admin/usergroup/edit')->with('usergroup',$usergroup)->with('usergroups',$usergroups)->with('help',$this->__construct());
	}
}
