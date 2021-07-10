<?php

class UserController extends \BaseController {
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
		$first_record=User::orderBy('order_no','ASC')->first();
		$last_record=User::orderBy('order_no','DESC')->first();
		$users=User::where('default_account_id','!=',3)->where('status','=',1)->get();
		$total_accounts=User::where('default_account_id','!=',3)->where('status','=',1)->count();
		return View::make('admin/user/index')->with('first_record',$first_record)->with('last_record',$last_record)->with('users',$users)->with('total_accounts',$total_accounts)->with('help',$this->__construct());
	}

	public function getListUserAccess(){ 
		$first_record=User::orderBy('order_no','ASC')->first();
		$last_record=User::orderBy('order_no','DESC')->first();
		$users=User::where('id','=',Auth::user()->id)->where('default_account_id','=',3)->where('status','=',1)->get();
        //$total_accounts=User::where('default_account_id','!=',3)->where('status','=',1)->count();
		return View::make('advertiser/user/index')->with('first_record',$first_record)->with('last_record',$last_record)->with('users',$users)->with('help',$this->__construct());//->with('total_accounts',$total_accounts);
	}
	public function getDetails($username){
		$user=User::find($username);
		return View::make('admin/user/account_user_name_language')->with('user',$user)->with('help',$this->__construct());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getRegister()
	{
		return View::make('register');
	}
	public function postRegister(){
		$rules=array(
			'name'=>'required',
			'username'=>'required|min:5',
			'email'=>'required|email',
			'password'=>'required|min:5',
            //alphaNum|
			'password2'=>'required|same:password'
			);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('/admin/register')->withErrors($validator)->withInput(Input::except('name'));
		}else{
						//create an account
			$user=new User;
			$user->contact_name=Input::get('name');
			$user->username=Input::get('username');

			$user->email=Input::get('email');

			$user->password=Hash::make(Input::get('password'));
			$user->password_md5=md5(Input::get('password_md5'));
			$user->default_account_id=1;
            $user->activated=0;//chưa đc activated
		 				//activation code
            $code=str_random(60);
            $user->code=$code;
		 				$url=URL::to('/account/activate',$code); //echo $url; die();
		 				if($user->save()){

		 					Mail::send('emails.auth.activate',array('link'=>URL::to('/account/activate',$code),'username'=>Input::get('username')),function($message){
		 						$message->to(Input::get('email'),Input::get('username'))->subject('Activate your account');
		 					});

		 					return Redirect::to('/login');
		 				}
		 			}
		 		}
		 		public function getactivated($code){
		 			$user=User::where('code','=',$code)->where('activated','=',0);
		 			/*if user is available*/
		 			if($user->count()){
		 				$user=$user->first();
			//Update the user status to activated
		 				$user->activated=1;
		 				$user->code='';
		 				if($user->save()){
		 					return Redirect::to('/login');
		 				}
		 			}
		 			/*fall back*/
		 			echo 'We could not activate your account. Try again later.';
		 		}
		 		public function getRecoveryPassword(){
		 			return View::make('recovery_password');
		 		}
		 		public function postRecoveryPassword(){
		 			$rules=array(
		 				'email'=>'required|email'
		 				);
		 			$validator=Validator::make(Input::all(),$rules);
		 			if($validator->fails()){
		 				return Redirect::to('recovery_password')->withErrors($validator)->withInput(Input::except('email'));
		 			}else{
			//kiểm tra xem có sự tồn tại của email đó trong csdl hay không?
		 				$user=User::where('email','=',Input::get('email'));
		 				if($user->count()){
				//generate a new code and password
		 					$code=str_random(60);
		 					$password=str_random(10);
		 					$user=$user->first();
		 					$user->code=$code;
		 					$user->password_temp=Hash::make($password);
		 					$username=$user->username;
		 					$email=$user->email;
		 					if($user->save()){
					//send mail to email
		 						Mail::send('emails/auth/forgot',array('link'=>URL::to('/account/recover',$code),'username'=>$user->username,'password'=>$password),function($message) use ($user){
		 							$message->to($user->email,$user->username)->subject('Your new password');
		 						});
		 						return Redirect::to('/admin/recovery_password')->with('flash','We have sent you a new password by email');
		 					}
		 				}
		 			}
		 		}
		 		public function getRecover($code){
		 			$user=User::where('code','=',$code)->where('password_temp','!=','');
		 			if($user->count()){
		 				$user=$user->first();
		 				$user->password=$user->password_temp;
		 				$user->password_temp='';
		 				$user->code='';
		 				if($user->save()){
		 					return Redirect::to('/login');
		 				}else{
		 					echo "Couldn't recover your account.";
		 				}
		 			}
		 		}
		 		public function getCreate()
		 		{
		 			$languages=Language::all();
		$usergroups=Usergroup::tree(); //echo '<pre/>'; print_r($usergroups->lists('id')); die();
		return View::make('admin/user/create')->with('languages',$languages)->with('usergroups',$usergroups)->with('help',$this->__construct());
	}

	public function postNameLanguage($id){
		$user=User::find($id);
		$user->contact_name=Input::get('contact_name');
		$user->language=Input::get('language');
		$user->save();
		Session::flash('success','Successfully changed the name and language!');
		return Redirect::to('/admin/account-user-name-language-'.$id);
	}
	public function postEmail($id){
		$user=User::find($id);
		$password=Input::get('password');
		//echo Hash::make(Input::get('password')); die();
		if($user->password_md5==md5($password)){
			$user->email=Input::get('email');
			$user->save();
		}else{
			echo 'Password is not matching'; die();
		}
		Session::flash('success','Successfully changed the email!');
		return Redirect::to('/admin/account-user-name-language-'.$id.'#tab-2');
	}
	public function postPassword($id){
		$user=User::find($id); //echo $user->password_md5.' '.md5(Input::get('oldpassword')); die();
		if(($user->password_md5==md5(Input::get('oldpassword')))&&(Input::get('password')==Input::get('newpassword'))){
			$user->password=Hash::make(Input::get('password'));
			$user->password_md5=md5(Input::get('password'));
			$user->created_at=date('Y-m-d H:i:s');
			$user->save();
			Session::flash('success','Change password successfully!');
			Session::flash('danger','Password is changed!');
		}else{
			//echo 'Password is not matching'; die();
			Session::flash('warning','Wrong!');
		}
		return Redirect::to('/admin/account-user-name-language-'.$id.'#tab-3');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{ 
		$rules=array(
			'username'=>'required|min:5',
			'email'=>'required|email',
			'password'=>'required|min:5',
            //alphaNum|
			'repeat_password'=>'required|same:password',
			'contact_name'=>'required'
			);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){ 
			return Redirect::to('/admin/user-create')->withErrors($validator)->withInput(Input::except('username'));
		}else{ 
			//create user using Sentry
			$last_record=User::orderBy('order_no','DESC')->get(); 
			if(count($last_record)>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			try{
				//Create the user
				$user=Sentry::createUser(
					array(
						'contact_name'=>Input::get('contact_name'),
						'username'=>Input::get('username'),
						'email'=>Input::get('email'),
						'password'=>Input::get('password'),
						'language'=>Input::get('language'),
						'default_account_id'=>Input::get('default_account_id'),
						'order_no'=>$number,
						'activated'=>true
					)
				);
				//Find the group using the group id
				$adminGroup=Sentry::findGroupById(Input::get('default_account_id'));
				//Assign the group to the user
				if($user->addGroup($adminGroup)){
		 				//if(isset($user)){
		 					$userlog=new Userlog;
		 					$userlog->account_id=$user->default_account_id;
		 					$userlog->userid=$user->id;
		 					$userlog->username=$user->username;
		 					$userlog->action="inserted";
		 					$userlog->context="User";
		 					$userlog->contextid=$user->id;
		 					$userlog->object=$user->username;
		 					$userlog->details=$user->username.' inserted User "'.$user->username.'" (#'.$user->id.')';
		 					$userlog->save();
		 					Session::flash('success','Successfully created the account!');
		 					return Redirect::to('/admin/user');
		 				//}
				}else{

				}
			}catch(Cartalyst\Sentry\Users\LoginRequiredException $e){
				echo 'Email field is required.';
			}catch(Cartalyst\Sentry\Users\PasswordRequiredException $e){
				echo 'Password field is required.';
			}catch(Cartalyst\Sentry\Users\UserExistsException $e){
				echo 'User with this login already exists.';
			}catch(Cartalyst\Sentry\Groups\GroupNotFoundException $e){
				echo 'Group was not found.';
			}
            //create an account
			/*$user=new User;
			$user->contact_name=Input::get('contact_name');
			$user->username=Input::get('username');

			$user->email=Input::get('email');

			$user->password=Hash::make(Input::get('password'));
			$user->password_md5=md5(Input::get('password_md5'));
			$user->language=Input::get('language'); 
			$user->default_account_id=Input::get('default_account_id'); 
			$last_record=User::orderBy('order_no','DESC')->get(); 
			if(count($last_record)>0){
				$number=$last_record->lists('order_no')[0]+1;
			}else{
				$number=1;
			} 
			$user->order_no=$number;
            $user->activated=1;//đã đc activated
		 				//activation code
            $code=str_random(60);
            $user->code=$code;
		 				$url=URL::to('/account/activate',$code); //echo $url; die();*/
		 				//if($user->save()){
             	//không cần activated nữa
				// Mail::send('emails.auth.activate',array('link'=>URL::to('/account/activate',$code),'username'=>Input::get('username')),function($message){
				// 	$message->to(Input::get('email'),Input::get('username'))->subject('Activate your account');
				// });
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
		//Update user using Sentry
		try{
			//Find the user using the user id
			$user=Sentry::findUserById($id);
			//Update the user details
			$user->default_account_id=Input::get('default_account_id');
			//Update the user
			if($user->save()){
				$userlog=new Userlog;
				$userlog->account_id=$user->default_account_id;
				$userlog->userid=$user->id;
				$userlog->username=$user->username;
				$userlog->action="updated";
				$userlog->context="User";
				$userlog->contextid=$user->id;
				$userlog->object=$user->username;
				$userlog->details=$user->username.' updated User "'.$user->username.'" (#'.$user->id.')';
				$userlog->save();
				Session::flash('success','Successfully updated the account!');
				return Redirect::to('/admin/user');
			}else{}
		}catch(Cartalyst\Sentry\Users\UserExistsException $e){
			echo 'User with this login already exists.';
		}catch(Cartalyst\Sentry\Users\UserNotFoundException $e){
			echo 'User was not found.';
		}
		//$user=User::find($id);
		//$user->default_account_id=Input::get('default_account_id');
		//$user->save();
	}


	public function delete($id)
	{
		$special_user=User::where('id','=',$id)->get();
		if($special_user->lists('id')[0]==1){
			Session::flash('danger',"Don't allow to delete account default manager !");
		}else{
			User::where('id','=',$id)->update(
				array(
					'status'=>0
					)
				);
			$user=User::where('id','=',$id)->get(); 
			$userlog=new Userlog;
			$userlog->account_id=Auth::user()->default_account_id;
			$userlog->userid=Auth::user()->id;
			$userlog->username=Auth::user()->username;
			$userlog->action="deleted";
			$userlog->context="User";
			$userlog->contextid=$user->lists('id')[0];
			$userlog->object=$user->lists('username')[0];
			$userlog->details=Auth::user()->username.' deleted User "'.$user->lists('username')[0].'" (#'.$user->lists('id')[0].')';
			$userlog->save();
			Session::flash('warning','Successfully deleted the account!');
		}
		return Redirect::to('admin/user');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
		$users=User::where('status','=',0)->get();
		return View::make('admin/user/recycle_bin')->with('users',$users)->with('help',$this->__construct());
	}
	public function revert($id)
	{
		User::where('id','=',$id)->update(
			array(
				'status'=>1
				)
			);
		$user=User::where('id','=',$id)->get(); 
		$userlog=new Userlog;
		$userlog->account_id=Auth::user()->default_account_id;
		$userlog->userid=Auth::user()->id;
		$userlog->username=Auth::user()->username;
		$userlog->action="reverted";
		$userlog->context="User";
		$userlog->contextid=$user->lists('id')[0];
		$userlog->object=$user->lists('username')[0];
		$userlog->details=Auth::user()->username.' reverted User "'.$user->lists('username')[0].'" (#'.$user->lists('id')[0].')';
		$userlog->save();
		Session::flash('success','Successfully restored the account!');
		return Redirect::to('admin/user');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function destroy($id)
	{
		$users=User::find($id);
		$users->delete();
		Session::flash('danger','Successfully destroyed the account!');
		return Redirect::to('admin/user-recycle');
	}
	public function checkUsernameExist($username){
		$user=User::where('username','=',$username)->first();
		if($user){
			return 1;
		}else{
			return 0;
		}
	}
	
	public function getShow($id){
		$usergroups=Usergroup::tree();
		$languages=Language::all();
		$user=User::find($id);
		//show the view and pass the adtype to it
		return View::make('admin/user/show')->with('user',$user)->with('languages',$languages)->with('usergroups',$usergroups)->with('help',$this->__construct());
	}
	
	public function getShowOfAdvertiser($id){
		$advertiser=Advertiser::where('id','=',Auth::user()->clientid)->first();
		$usergroups=Usergroup::tree();
		$languages=Language::all();
		$user=User::find($id);
		//show the view and pass the adtype to it
		return View::make('advertiser/user/show')->with('advertiser',$advertiser)->with('user',$user)->with('languages',$languages)->with('usergroups',$usergroups)->with('help',$this->__construct());
	}
	
	public function getCopy($id){
		$usergroups=Usergroup::tree();
		$languages=Language::all();
		$user=User::find($id);
		return View::make('admin/user/copy')->with('user',$user)->with('languages',$languages)->with('usergroups',$usergroups)->with('help',$this->__construct());
	}
	
	public function getEdit($id){
		$usergroups=Usergroup::tree();
		$languages=Language::all();
		$user=User::find($id);
		return View::make('admin/user/edit')->with('user',$user)->with('languages',$languages)->with('usergroups',$usergroups)->with('help',$this->__construct());
	}
    public function resetUserPassword(){
        //reset password using Sentry
        return View::make('admin/user/reset_password');
    }
    public function resetPassword(){
        try{
            //Find the user using the user email address
            $user=Sentry::findUserByLogin(Input::get('email'));
            //Update the user details
            $user->password=Input::get('password');
            //Update the user
            if($user->save()){
                return Redirect::to('admin/reset-user_password');
            }else{}
        }catch(Cartalyst\Sentry\Users\UserNotFoundException $e){
            echo 'User was not found.';
        }
    }
}
