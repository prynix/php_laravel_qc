<?php
class DashboardController extends BaseController{
	public function __construct()
    {
        //updated: prevents re-login.
        $this->beforeFilter('guest', ['only' => ['getLogin']]);
        $this->beforeFilter('auth', ['only' => ['getLogout']]);
    }
	public function sendMail(){
		$rules=array(
            'subject'=>'required',
            'email'=>'required|email',
            'message'=>'required'
        );
        $validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Redirect::to('admin/dashboard')->withErrors($validator);
        }else{
        	$user=array(
				'email'=>Input::get('email'),
				'subject'=>Input::get('subject')
			);
            $data=array(
                'subject'=>Input::get('subject'),
                'messages'=>Input::get('message')
            );
            Mail::send('admin/dashboard/email',$data,function($message){
                $message->from('admin@site.com','BBAds');
                $message->to(Input::get('email'),'tintuc.vn')->subject('Welcome to My Laravel app!');
            });       
            return Redirect::to('admin/dashboard');
        }	
	}

}
?>