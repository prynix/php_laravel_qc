<?php
class AuthController extends BaseController{
	public function __construct()
    {
        //updated: prevents re-login.
        $this->beforeFilter('guest', ['only' => ['getLogin']]);
        $this->beforeFilter('auth', ['only' => ['getLogout']]);
        
    }
    public function getIndex()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        $posts->getEnvironment()->setViewName('pagination::simple');
        $this->layout->title = 'Home Page | Laravel 4 Blog';
        $this->layout->main = View::make('home')->nest('content', 'index', compact('posts'));
    }

    public function getSearch()
    {
        $searchTerm = Input::get('s');
        $posts = Post::whereRaw('match(title,content) against(? in boolean mode)', [$searchTerm])
            ->paginate(10);
        $posts->getEnvironment()->setViewName('pagination::slider');
        $posts->appends(['s' => $searchTerm]);
        $this->layout->with('title', 'Search: ' . $searchTerm);
        $this->layout->main = View::make('home')
            ->nest('content', 'index', ($posts->isEmpty()) ? ['notFound' => true] : compact('posts'));
    }

    public function getLogin()
    {    
		//Auth::logout();
        return View::make('login');
    }

    public function postLogin()
    {
		//Session::flush();
		//header("Cache-Control: no-cache, must-revalidate");
		//header("Expire: Mon, 26 Jul 1997 05:00:00 GMT");
		//header("Content-Type: application/xml; charset=utf-8");
        // $credentials = [
        //     'username' => Input::get('userid'),
        //     'password' => Input::get('password')
        // ];
        // $rules = [
        //     'username' => 'required',
        //     'password' => 'required'
        // ];
        // $validator = Validator::make($credentials, $rules);
        // if ($validator->passes()) {
        //     if (Auth::attempt($credentials))
        //         return Redirect::to('admin/dashboard');
        //     return Redirect::back()->withInput()->with('failure', 'username or password is invalid!');
        // } else {
        //     return Redirect::back()->withErrors($validator)->withInput();
        // }
        $rules=array(
            'username'=>'required|min:5',
            'password'=>'required|min:5'
        );
        //run the validationn rules on the inputs from the form
        $validator=Validator::make(Input::all(),$rules);
        //if the validator fails, redirect back to the form
        if($validator->fails()){ 
            return Redirect::to('/login')->withErrors($validator)->withInput(Input::except('username'));
                                        //send back all errors to the login form
                                        //send back the input (not the password) so that we can repopulate the form

        }else{ 
            //create our user data for the authentication
            $userdata=array(
                'email'=>Input::get('username')//,
                ,'password'=>Input::get('password')
                //,'password_md5'=>md5(Input::get('password'))
                //,'active'=>1
            ); 
            //echo Hash::make(Input::get('password')); die();
            //attempt to do the login
            //kiểm tra có sự tồn tại của remember me hay không?
            $remember=(Input::has('remember'))?true:false;
            if(Auth::attempt($userdata,$remember)){
            //$user=User::where('username',Input::get('username'))->first();
                //print_r($userdata); die();
            //if(isset($user)){
                //validation successful!
                //redirect them to the secure section or whatever
                //Session::put('admin_username',$userdata['username']);
                //Session::put('admin_password',$userdata['password']);
                //echo Auth::user()->id; die();
                //echo Session::get('admin_username'); die();
                Session::flash('success','Login successful!');
                //ghi lai lan dang nhap sau cung
                $user=User::find(Auth::user()->id); //echo '<pre/>'; print_r($user->default_account_id); die();
                $user->last_login=date('Y-m-d H:i:s');
                $user->ip_address_last_login=$_SERVER['REMOTE_ADDR'];
                $user->online=1;
                $user->save();
                //Session::put('your_password',Input::get('password'));
                //$account=Account::where('id','=',Auth::user()->default_account_id)->get(); echo $account->lists('account_type')[0]; die();
                if($user->default_account_id==3){
                    /*if(Session::has('url_previous'))
                        return Redirect::to(str_replace('admin','advertiser',Session::get('url_previous')));
					else*/
						return Redirect::to('advertiser/dashboard');
                }else{
                    /*if(Session::has('url_previous'))
                        return Redirect::to(str_replace('advertiser','admin',Session::get('url_previous')));
                    else*/
                        return Redirect::to('admin/dashboard');
                }
            }else{ 
                //validation not successful, send back to form
                //print_r($userdata); die();
				Session::flash('danger','Account is not existed');
                return Redirect::to('/login');
            }
        }
    }

    public function getLogout()
    {
        //$user=Sentry::getUser(); //print_r($user); die();
        $user=Auth::user();
        //change the system online to OFF and destroy the session. Have kept this code inside logout page.
        if(isset($user)){
            $user=User::find($user->id);
            $user->online=0;
            $user->save();
            //Sentry::logout();
            Auth::logout();
        }else{
            
        }
        return Redirect::to('/login');
    }

}

?>