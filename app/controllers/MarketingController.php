<?php
class MarketingController extends BaseController{
	public function decode_imap_text($str){
		$result='';
		$decode_header=imap_mime_header_decode($str);
		foreach($decode_header as $obj){
			$result.=htmlspecialchars(rtrim($obj->text,"\t"));
		}
		return $result;
	} 
	public function downloadTemplate(){ //add line extension=php_fileinfo.dll into php.ini
		//PDF file is stored under project/public/download/template.doc
		$file=public_path()."/download/template_default.pdf";
		if(file_exists($file)){}
			else{
				$content="";
			$fp=fopen(public_path()."/download/template_default.pdf","x");//chế độ ghi file //mở file
			fwrite($fp,$content); //ghi file 
			fclose($fp); //đóng file
		}
			// $headers=array(
			// 	'Content-Type: application/pdf',//type of file: ứng dụng/dạng pdf: define type of file
			// );	
		return Response::download($file);//,'template_default.pdf',$headers);
}
public function getEmail(){ 
	$configs=Config::get('mail');
	$content=File::get(app_path().'/config/mail.php');
	$username=$configs['username'];
	$password=$configs['password'];

	$advertisers=Advertiser::where('status','=',1)->get();
	$amount=Email::count();
	$emails=Email::all();
	return View::make('admin/marketing/email')->with('content',$content)->with('username',$username)->with('password',$password)->with('emails',$emails)->with('amount',$amount)->with('advertisers',$advertisers);
}
	public function postConfigMail(){ //$account=Account::where('id','=',Auth::user()->default_account_id)->get(); echo $account->lists('account_type')[0]; die();
	$username=Input::get('username');
	$password=Input::get('password');
	$configs=Connect::where('mail_username','=',$username)->where('mail_password','=',$password)->count();

	$rules=array(
		'username'=>'required',
		'password'=>'required'
		);
	$validator=Validator::make(Input::all(),$rules);
        if($validator->fails()){ //nếu thất bại
        	return Redirect::to('admin/email-marketing')->withErrors($validator);
        }else{
        	if($configs>0){
            	//
        	}else{
        		$config=new Connect;
        		$config->mail_username=Input::get('username');
        		$config->mail_password=Input::get('password');
        		$config->save();
        	}
	        //return Redirect::to('admin/email-marketing');
        }
        $content=File::put(app_path().'/config/mail.php',"
        	<?php
        	return array(

        		/*
        		|--------------------------------------------------------------------------
        		| Mail Driver
        		|--------------------------------------------------------------------------
        		|
        		| Laravel supports both SMTP and PHP's mail function as drivers for the
        		| sending of e-mail. You may specify which one you're using throughout
        		| your application here. By default, Laravel is setup for SMTP mail.
        		|
        		| Supported: smtp, mail, sendmail, mailgun, mandrill, log
        		|
	*/

        		'driver' => 'smtp',

        		/*
        		|--------------------------------------------------------------------------
        		| SMTP Host Address
        		|--------------------------------------------------------------------------
        		|
        		| Here you may provide the host address of the SMTP server used by your
        		| applications. A default option is provided that is compatible with
        		| the Mailgun mail service which will provide reliable deliveries.
        		|
	*/

	//'host' => 'smtp.mailgun.org',
        		'host' => 'smtp.gmail.com',

        		/*
        		|--------------------------------------------------------------------------
        		| SMTP Host Port
        		|--------------------------------------------------------------------------
        		|
        		| This is the SMTP port used by your application to deliver e-mails to
        		| users of the application. Like the host we have set this value to
        		| stay compatible with the Mailgun e-mail application by default.
        		|
	*/

        		'port' => 587,

        		/*
        		|--------------------------------------------------------------------------
        		| Global From Address
        		|--------------------------------------------------------------------------
        		|
        		| You may wish for all e-mails sent by your application to be sent from
        		| the same address. Here, you may specify a name and address that is
        		| used globally for all e-mails that are sent by your application.
        		|
	*/

        		'from' => array('address' => '".$username."', 'name' => 'tintuc.vn'),

        		/*
        		|--------------------------------------------------------------------------
        		| E-Mail Encryption Protocol
        		|--------------------------------------------------------------------------
        		|
        		| Here you may specify the encryption protocol that should be used when
        		| the application send e-mail messages. A sensible default using the
        		| transport layer security protocol should provide great security.
        		|
	*/

        		'encryption' => 'tls',

        		/*
        		|--------------------------------------------------------------------------
        		| SMTP Server Username
        		|--------------------------------------------------------------------------
        		|
        		| If your SMTP server requires a username for authentication, you should
        		| set it here. This will get used to authenticate with your server on
        		| connection. You may also set the password value below this one.
        		|
	*/

        		'username' => '".$username."',

        		/*
        		|--------------------------------------------------------------------------
        		| SMTP Server Password
        		|--------------------------------------------------------------------------
        		|
        		| Here you may set the password required by your SMTP server to send out
        		| messages from your application. This will be given to the server on
        		| connection so that the application will be able to send messages.
        		|
	*/

        		'password' => '".$password."',

        		/*
        		|--------------------------------------------------------------------------
        		| Sendmail System Path
        		|--------------------------------------------------------------------------
        		|
        		| When using the sendmail driver to send e-mails, we will need to know
        		| the path to where Sendmail lives on this server. A default path has
        		| been provided here, which will work well on most of your systems.
        		|
	*/

        		'sendmail' => '/usr/sbin/sendmail -bs',

        		/*
        		|--------------------------------------------------------------------------
        		| Mail Pretend
        		|--------------------------------------------------------------------------
        		|
        		| When this option is enabled, e-mail will not actually be sent over the
        		| web and will instead be written to your application's logs files so
        		| you may inspect the message. This is great for local development.
        		|
	*/

        		'pretend' => false,
        		);
?>
");
return Redirect::to('admin/email-marketing');
}
public function autoSendMail(){

}
	public function postSendMail(){  //cc and bcc ?
		//check how-to-submit value is 1 or 2
		//echo Input::get('selection'); die();
		$configs=Config::get('mail');
		$address=$configs['from']['address'];
		$name=$configs['from']['name'];
		//i'm creating an array with user's info but most likely you can use $user->email or pass $user object to closure later 
		$post=[
		'subject'=>Input::get('subject'),
		'email_to'=>Input::get('email_to'),
		'email_message'=>Input::get('email_message')
		];
		$rules=[
		'subject'=>'required',
		'email_to'=>'required',
		'email_message'=>'required'
		];
		$user=array(
			'address'=>$address,
			'email_to'=>Input::get('email_to'),
			'email_cc'=>(Input::get('email_cc')!=='')?Input::get('email_cc'):Input::get('email_to'),
			'email_bcc'=>(Input::get('email_bcc')!=='')?Input::get('email_bcc'):Input::get('email_to'),
				'name'=>$name//chu ky nguoi gui
				);
			//the data that will be passed into the mail view blade template
		$data=array(
			'content'=>Input::get('email_message'),
				'name'=>$name//chu ky nguoi gui
				);
		$advertisers=Advertiser::where('status','=',1)->get();
		if(Input::get('selection')==2){
			$emails=array();
			foreach($advertisers as $advertiser){
				array_push($emails,$advertiser->email);
			}
			Mail::send('emails.mail',$data,function($message) use ($emails){
				$message->to($emails)->subject('This is test e-mail');
				$destinationPath='uploads/marketing/';//upload path
				$file=Input::file('filename');
				if(isset($file)){
					$file->move($destinationPath,$file->getClientOriginalName());
				}
				$message->attach($destinationPath.$file->getClientOriginalName());//dinh kem file 
				$configs=Config::get('mail');
				$address=$configs['from']['address'];
				$email=new Email;
				$email->from=$address;
				$advertisers=Advertiser::where('status','=',1)->get();
				$e_mail='';
				foreach($advertisers as $advertiser){
					$e_mail.=$advertiser->email.', ';
				}
				$email->to=$e_mail;
				$email->subject=Input::get('subject');
				$email->body=Input::get('email_message');
				$email->filename=$destinationPath.$file->getClientOriginalName();
				try{
					$email->size=$file->getSize();		
				}catch(Exception $ex){
					$email->size='';
				}
				$email->date=date('Y-m-d H:i:s');
				$email->seen=1;
				$email->type_message='sent';
				$e=Email::where('subject','=',trim(Input::get('subject')))->count();
				if($e>0){}
					else{
						$email->save();
					}
				});
		}else if(Input::get('selection')==1){
		//echo Input::file('filename')->getClientOriginalName(); die();
			$valid=Validator::make($post,$rules);
			if($valid->fails()){ 
				Session::flash('danger','Invalid data send mail');
		 	return Redirect::to('admin/email-marketing')->withErrors($valid)->withInput();//input focus first element
		 }else{ 
			//echo '<pre/>'; print_r(Input::file('filename')->getSize()); die();
			Mail::send('emails.mail',$data,function($message) use ($user){//su dung them $user
				$message->from($user['address'],$user['name']);
				$message->to($user['email_to'],$user['name'])->cc($user['email_cc'],$user['name'])->bcc($user['email_bcc'],$user['name'])->subject(Input::get('subject'));
				$destinationPath='uploads/marketing/';//upload path
				$file=Input::file('filename');
				if(isset($file)){
					$file->move($destinationPath,$file->getClientOriginalName());
				}
				$message->attach($destinationPath.$file->getClientOriginalName());//dinh kem file 
				$email=new Email;
				$email->from=$user['address'];
				$email->to=$user['email_to'].', '.$user['email_cc'].', '.$user['email_bcc'];
				$email->subject=Input::get('subject');
				$email->body=Input::get('email_message');
				$email->filename=$destinationPath.$file->getClientOriginalName();
				try{
					$email->size=$file->getSize();		
				}catch(Exception $ex){
					$email->size='';
				}
				$email->date=date('Y-m-d H:i:s');
				$email->seen=1;
				$email->type_message='sent';
				$e=Email::where('subject','=',trim(Input::get('subject')))->count();
				if($e>0){}
					else{
						$email->save();
					}
			}); //var_dump(Mail::failures()); exit(); 
}
}
return Redirect::to('admin/email-marketing');
}
	public function getEmailContent(){ //check if email is not exists online
		//In file php.ini
		//Should be extension=php_imap.dll <+> POP3
		//get email unread -> save to database
		$username=Input::get('username');
		$password=Input::get('password');
		//url api to connect to
		//api to get email 
		$url="https://mail.google.com/mail/feed/atom";//atom <=> nuclear
		//sendRequest using CURL
		$curl=curl_init(); //khởi tạo curl
		curl_setopt($curl,CURLOPT_URL,$url);//set option 
		curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1);//theo vị trí, 1:TRUE
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($curl,CURLOPT_USERPWD,$username.":".$password);//user&pass
		curl_setopt($curl,CURLOPT_HTTPAUTH,CURLAUTH_BASIC);
		curl_setopt($curl,CURLOPT_ENCODING,"");//encoding charset
		$curlData=curl_exec($curl);//execute curl
		curl_close($curl);//close curl
		//print_r($curlData); die();
		$xml=simplexml_load_string($curlData);
		//echo '<pre/>'; print_r($xml);
		$x=new SimpleXmlElement($curlData); //echo '<pre/>'; print_r($x); die();
		//$e=Email::all(); 
		foreach($xml as $y){ 
			$link=(array)$y->link;
			//$email=new Email;
			foreach($link as $l){
				// $href=$l['href'];
				// $email->email_id=$y->id;
				// $email->from=$y->author->name.' - '.$y->author->email;
				// $email->to=$username;
				// $email->subject=$y->title;
				// $email->body=$y->summary;
				// $email->html_iframe=$href;
				// $email->date=$y->issued;
				// $e=Email::where('email_id','=',$y->id)->count();
				// if($e>0){}
				// else{
				// 	$email->save();
				// }
			}
		} //die();
		//using imap
		$mailboxes=array(
			array(
				'label'=>'E-mail',
				'enable'=>true,
				'mailbox'=>'{imap.gmail.com:993/imap/ssl}INBOX',
				'username' 	=> Input::get('username'),
				'password' 	=> Input::get('password')
				)
			);
		//check validate username and password log into e-mail

		foreach($mailboxes as $current_mailbox){
			$stream=@imap_open($current_mailbox['mailbox'], $current_mailbox['username'], $current_mailbox['password']);
			if(!$stream){
				Session::flash('danger','Error: '.imap_last_error());
			}else{
				$my_emails=imap_search($stream,'ALL');//tim kiem mail trong e-mail cua ban
				//kiem tra so luong mail trong e-mail <+> kiem tra co ton tai hay khong trong cau lenh truy van co dieu kien
				if(!count($my_emails)){

				}else{
					//if we've got some email IDs, sort them from new to old and show them
					rsort($my_emails);
					foreach($my_emails as $my_email){ 
						//fetch the email's overview and show subject, from and date
						$overview=imap_fetch_overview($stream, $my_email, 0); //print_r($overview);
						if(isset($overview[0]->subject)){
							$subject=$this->decode_imap_text($overview[0]->subject);
						}else{$subject='';}
						if(isset($overview[0]->from)){
							$from=$this->decode_imap_text($overview[0]->from);
						}else{$from='';}
						if(isset($overview[0]->to)){
							$to=$this->decode_imap_text($overview[0]->to);
						}else{$to='';}
						if(isset($overview[0]->date)){
							$date=$this->decode_imap_text($overview[0]->date);
						}else{$date='';}

						if(isset($overview[0]->size)){
							$size=$this->decode_imap_text($overview[0]->size);
						}else{$size='';}
						if(isset($overview[0]->uid)){
							$uid=$this->decode_imap_text($overview[0]->uid);
						}else{$uid='';}
						if(isset($overview[0]->answered)){
							$answered=$this->decode_imap_text($overview[0]->answered);
						}else{$answered='';}
						if(isset($overview[0]->deleted)){
							$deleted=$this->decode_imap_text($overview[0]->deleted);
						}else{$deleted='';}
						if(isset($overview[0]->seen)){
							$seen=$this->decode_imap_text($overview[0]->seen);
						}else{$seen='';}
						$email=new Email;
						$email->email_id=$uid;
						$email->from=$from;
						$email->to=$to;
						$email->subject=$subject;
						//$email->size=$size;
						$email->date=$date;
						$email->seen=$seen;
						$e=Email::where('email_id','=',$uid)->count();
						if($e>0){}
							else{
								$email->save();
							}
						}
					}
					imap_close($stream);
				}
			}
		//die();
			$emails=Email::all();
			return Redirect::to('admin/email-marketing')->with('emails',$emails)->with('my_emails',$my_emails);
		}
		public function verifyEmail($toemail,$fromemail,$getdetails=false){
			$details='';
			$email_arr=explode("@",$toemail);
			$domain=array_slice($email_arr,-1);
			$domain=$domain[0];
        //trim [ and ] from beginning and end of domain string, respectively
			$domain=ltrim($domain,"[");
			$domain=rtrim($domain,"]");

			if("IPv6:"==substr($domain,0,strlen("IPv6:"))){
				$domain=substr($domain,strlen("IPv6")+1);
			}

			$mxhosts=array();
			if(filter_var($domain,FILTER_VALIDATE_IP))
				$mx_ip=$domain;
			else
				getmxrr($domain, $mxhosts, $mxweight);

			if(!empty($mxhosts)){
				$mx_ip=$mxhosts[array_search(min($mxweight), $mxhosts)];
			}else{
				if(filter_var($domain,FILTER_VALIDATE_IP,FILTER_FLAG_IPV4)){
					$record_a=dns_get_record($domain,DNS_A);
				}elseif(filter_var($domain,FILTER_VALIDATE_IP,FILTER_FLAG_IPV6)){
					$record_a=dns_get_record($domain,DNS_AAAA);	
				}
	        if(!empty($record_a)){//not empty
	        	$mx_ip=$record_a[0]['ip'];
	        }else{
	        	$result="invalid";
	        	$details.="No suitable MX records found.";
	        	return ((true==$getdetails)?array($result,$details):$result);
	        }
	    }
	    $connect=@fsockopen($mx_ip,25);
	    if($connect){
	    	if(split("^220",$out=fgets($connect,1024))){
	    		fputs($connect,"HELLO ".$_SERVER['HTTP_HOST']."\r\n");
	    		$out=fgets($connect,1024);
	    		$details.=$out."\n";

	    		fputs($connect,"MAIL FROM: <$fromemail>\r\n");
	    		$from=fgets($connect,1024);
	    		$details.=$from."\n";

	    		fputs($connect,"RCPT TO: <$toemail>\r\n");
	    		$to=fgets($connect,1024);
	    		$details.=$to."\n";

	    		fputs($connect,"QUIT");
	    		fclose($connect);

	    		if(!split("^250",$from) || !split("^250",$to)){
	    			$result="invalid";
	    		}else{
	    			$result="valid";
	    		}
	    	}
	    }else{
	    	$result="invalid";
	    	$details.="Could not connect to server";
	    }
	    if($getdetails){
	    	return array($result,$details);
	    }else{
	    	return $result;
	    }
	}
	public function checkEmailExists(){ 
		/**
                                 * Validate a single Email via SMTP
                                 */

                                // include SMTP Email Validation Class
		require_once(public_path().'/lib/smtp_validateEmail.class.php');
		$configs=Config::get('mail');
		$username=$configs['username'];

		$advertisers=Advertiser::where('status','=',1)->get();
                                // instantiate the class
		$SMTP_Validator = new SMTP_validateEmail();
                                // turn on debugging if you want to view the SMTP transaction
		$SMTP_Validator->debug = false;
                                // do the validation
		$m=array();
		$results=array(); 
		foreach($advertisers as $advertiser){ 
			array_push($m, $advertiser->email);
		}
                                //print_r($m);
		$results=$SMTP_Validator->validate($m, $username);
		$mail=array();
                                //view results
		foreach($results as $email=>$result) {
                                     // send email? 
			if ($result) {
                                     //mail($email, 'Confirm Email', 'Please reply to this email to confirm', 'From:'.$sender."\r\n"); // send email
				array_push($mail,'<span class="label label-success">The email address '. $email.' is valid</span><br/>');
			} else {
				array_push($mail,'<span class="label label-danger">The email address '. $email.' is not valid</span><br/>');
			}
		}
		return Response::json($mail);
	}
}
?>