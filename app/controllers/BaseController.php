<?php

class BaseController extends Controller {
	public function __construct(){
		//$this->configureLocale();	
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
	public function getDate(){
		$date=date('Y-m-d');
		return strtotime($date);
	}
	public function getYear(){
		return date('Y',$this->getDate());
	}
	public function getMonth(){
		return date('m',$this->getDate());
	}
	public function getDay(){
		return date('d',$this->getDate());
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
	* Action used to set the application locale
	*/
	public function setLocale(){
		$mLocale=Request::segment(2,Config::get('app.locale'));//Get parameter from URL
		//echo $mLocale; die();
		if(in_array($mLocale,Config::get('app.locales'))){ 
			App::setLocale($mLocale);
			Session::put('locale',$mLocale);
			Cookie::forever('locale',$mLocale);//save cookie forever
		}
		//echo $mLocale; die();
		return Redirect::back();//back
	}
	/**
	* Detect and set application localization environment (language)
	*/
	private function configureLocale(){
		//set default locale
		$mLocale=Config::get('app.locale');
		//has a session locale already been set?
		if(!Session::has('locale')){
			//no, a session locale hasn't been set
			//was there a cookie set form a previous visit?
			$mFromCookie=Cookie::get('locale',null);
			if($mFromCookie!=null && in_array($mFromCookie, Config::get('app.locales'))){
				//Cookie was previously set and it's a supported locale
				$mLocale=$mFromCookie;
			}else{
				//No cookie was set
				//Attempt to get local from current URI
				$mFromURI=Request::segment(1);
				if($mFromURI!=null && in_array($mFromURI, Config::get('app.locales'))){
					//supported locale
					$mLocale=$mFromURI;
				}else{
					//attempt to detect locale from browser
					$mFromBrowser=substr(Request::server('http_accept_language'),0,2);
					if($mFromBrowser!=null && in_array($mFromBrowser, Config::get('app.locales'))){
						//browser lang is supported, use it.
						$mLocale=$mFromBrowser;
					}//$mFromBrowser
				}//$mFromURI
			}//$mFromCookie
			Session::put('locale',$mLocale);
			Cookie::forever('locale',$mLocale);//save cookie forever
		}//Session?
		else{
			//session locale is available, use it
			$mLocale=Session::get('locale');
		}//Session?
		//set application locale for current session
		App::setLocale($mLocale); 
	}
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	function alphaID($in, $to_num = false, $pad_up = false, $pass_key = null)
  {
    $out   =   '';
    $index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $base  = strlen($index);

    if ($pass_key !== null) {
      // Although this function's purpose is to just make the
      // ID short - and not so much secure,
      // with this patch by Simon Franz (http://blog.snaky.org/)
      // you can optionally supply a password to make it harder
      // to calculate the corresponding numeric ID

      for ($n = 0; $n < strlen($index); $n++) {
        $i[] = substr($index, $n, 1);
      }

      $pass_hash = hash('sha256',$pass_key);
      $pass_hash = (strlen($pass_hash) < strlen($index) ? hash('sha512', $pass_key) : $pass_hash);

      for ($n = 0; $n < strlen($index); $n++) {
        $p[] =  substr($pass_hash, $n, 1);
      }

      array_multisort($p, SORT_DESC, $i);
      $index = implode($i);
    }

    if ($to_num) {
      // Digital number  <<--  alphabet letter code
      $len = strlen($in) - 1;

      for ($t = $len; $t >= 0; $t--) {
        $bcp = bcpow($base, $len - $t);
        $out = $out + strpos($index, substr($in, $t, 1)) * $bcp;
      }

      if (is_numeric($pad_up)) {
        $pad_up--;

        if ($pad_up > 0) {
          $out -= pow($base, $pad_up);
        }
      }
    } else {
      // Digital number  -->>  alphabet letter code
      if (is_numeric($pad_up)) {
        $pad_up--;

        if ($pad_up > 0) {
          $in += pow($base, $pad_up);
        }
      }

      for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
        $bcp = bcpow($base, $t);
        $a   = floor($in / $bcp) % $base;
        $out = $out . substr($index, $a, 1);
        $in  = $in - ($a * $bcp);
      }
    }

    return $out;
  }
}
