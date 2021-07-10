<?php 
class RssController extends Controller{
	public function generateRandomString($length){
		$characters='0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength=strlen($characters);
		$randomString='';
		for($i=0;$i<$length;$i++){//random character
			$randomString.=$characters[rand(0,$charactersLength-1)];
		}
		return $randomString;
	}
	public function getFeed($id){ 
		$number_adbanners=AdBanner::join('websites_topics',function($join){
			$join->on('websites_banners.topic_id','=','websites_topics.id')->where('websites_banners.status','=',1);})->where('websites_banners.website_id','=',$id)->get();
		$adbanners=AdBanner::where('website_id','=',$id)->where('status','=',1)->groupBy('adbanner_link')->get();//select distinct adbanner_link from websites_banners
		$topic_selected='All banners';
		$topics=Topic::where('website_id','=',$id)->get();
		$categories=Category::all();
		$actived_ads=AdBanner::where('status','=',1)->where('website_id','=',$id)->count();
		$all_actived_ads=AdBanner::where('status','=',1)->where('website_id','=',$id)->count();
		$banned_ads=AdBanner::where('status','=',-1)->where('website_id','=',$id)->count();
		$stopped_ads=AdBanner::where('status','=',0)->where('website_id','=',$id)->count();
		return View::make('admin/rss/index')->with('number_adbanners',$number_adbanners)->with('adbanners',$adbanners)->with('topic_selected',$topic_selected)->with('topics',$topics)->with('categories',$categories)->with('website_id',$id)->with('actived_ads',$actived_ads)->with('all_actived_ads',$all_actived_ads)->with('banned_ads',$banned_ads)->with('stopped_ads',$stopped_ads);
	}
	public function getFeedPartner($id){ 
	}
	public function postFeed($id){
		$rules=array(
			'feed_name'=>'required',
			'feed_address'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/rss-feed-'.$id)->withErrors($validator)->withInput(Input::except('feed_name'));
		}else{
			$date=date('Y-m-d');
			//$c=Folder::where('folder_name','=',$date)->count();
			//if($c==0){
				//$folder=new Folder;
				//$folder->folder_name=$date;
				//$folder->save();
			//}else{}
			
			$topic=new Topic;
			$topic->website_id=$id;
			$topic->feed_name=Input::get('feed_name');
			$check_exist_topic=Topic::where('website_id','=',$id)->where('feed_address','=',Input::get('feed_address'))->count();
			$topic->feed_address=Input::get('feed_address');
			$topic->status=1;
			$topic->category_id=Input::get('category_id');
			$topic->period=Input::get('period'); 
			if($check_exist_topic>0){ 
				Session::flash('message','This feed is already existed in database!');
			}else{
				$topic->save();
				header('Content-Type: text/html; charset=utf-8');
				//chỗ này cần chỉnh sửa lấy tin tự động RSS Feed
				$xml=simplexml_load_file(Input::get('feed_address')); //cai nay de add sau, chua can add ngay ma doi trong vong bao nhieu lau he thong se tu dong add tin banner
                
                //chỉnh sửa lại cách lấy tin RSS chuẩn
				foreach($xml as $channel){ 
					foreach($channel->item as $item){
						$xpath=new DOMXPath(@DOMDocument::loadHTML($item->description));
						$src=$xpath->evaluate("string(//img/@src)");
						$adbanner=new AdBanner; 
						$adbanner->website_id=$id;
						$adbanner->topic_id=$topic->id;
						$adbanner->adbanner_title=$item->title;
						
						$url = $src;
                        if($url==''){
                            $url=public_path().'/assets/img/icon/no_image.jpg';
                        }
                            $url_arr = explode ('/', $url);
                            $ct = count($url_arr);
                            $name = $url_arr[$ct-1];
                            $name_div = explode('.', $name);
                            $ct_dot = count($name_div);
                            $img_type = $name_div[$ct_dot -1];
                            //$destinationPath = public_path().'/uploads/rssbanner_images/'.$name;//chỉnh lại đường dẫn lưu ảnh rssbanner
                            $localPath='uploads/rssbanner_images/'.$date.'/'.$this->generateRandomString(2).'/'.$this->generateRandomString(2).'/';
                            $destinationPath=public_path().'/'.$localPath;
                            File::makeDirectory($destinationPath,$mode=0777,true,true);
                            //echo Response::download($url); die(); 
                            $image_name=$this->generateRandomString(28);
                            $adbanner->imagefile=$localPath.$image_name.'.'.$name;
                            file_put_contents($destinationPath.$image_name.'.'.$name, file_get_contents($url));//chỗ này bị lỗi không get_content được
                        
						$adbanner->adbanner_link=$item->link;
						$adbanner->adbanner_description=$item->description;
						$adbanner->expire_date=date('Y-m-d H:i:d',strtotime(date('Y-m-d H:i:s'))+60*60*24*Input::get('period'));
						$adbanner->status=1;
						$adbanner->save();
					}
				}
			}
			return Redirect::to('admin/rss-feed-'.$id);
		}
	}
	public function getFeedAutoBanner(){ //lấy topic_id từ bảng website_banners (TH đã get đc RSS banners)
		$date=date('Y-m-d');
		//$c=Folder::where('folder_name','=',$date)->count();
		//if($c==0){
			//$folder=new Folder;
			//$folder->folder_name=$date;
			//$folder->save();
		//}else{}
		$topics=DB::select('select distinct id, feed_address from websites_topics where status=1');
		//$adbanners=DB::select('select distinct topic_id from websites_banners');
		//bắt đầu lấy tin tự động
		foreach ($topics as $topic) {
			$topic_id=$topic->id; 
			$topic=Topic::where('id','=',$topic_id)->get();
			$website_id=$topic->lists('website_id')[0]; 
            $period=$topic->lists('period')[0]; 
			$feed_address=$topic->lists('feed_address')[0]; 
			header('Content-Type: text/html; charset=utf-8');
				//chỗ này cần chỉnh sửa lấy tin tự động RSS Feed
                
                //chỗ này lấy ảnh về cần phải xem lại (lý do: ảnh đc lưu trữ lại quá nhiều)
                //hiện tại là đang lấy tất cả các ảnh của banner mà có feed topic đang đc lưu trữ: ERROR
				$xml=simplexml_load_file($feed_address); //cai nay de add sau, chua can add ngay ma doi trong vong bao nhieu lau he thong se tu dong add tin banner
            
                //chỉnh sửa lại cách lấy tin RSS chuẩn
				foreach($xml as $channel){ 
					foreach($channel->item as $item){
						$xpath=new DOMXPath(@DOMDocument::loadHTML($item->description));
						$src=$xpath->evaluate("string(//img/@src)");
						$adbanner=new AdBanner; 
						$adbanner->website_id=$website_id;
						$adbanner->topic_id=$topic_id;
						$adbanner->adbanner_title=$item->title; //kiếm tra xem trong bảng đã có bản ghi nào trùng title hay chưa ?
						
						//chỗ này bị lỗi khi giật ảnh về 6 errors
						
						$url = $src;
                        if($url==''){
                            $url=public_path().'/assets/img/icon/no_image.jpg';
                        }
						  $url_arr = explode ('/', $url);
                            $ct = count($url_arr);
                            $name = $url_arr[$ct-1];
                            $name_div = explode('.', $name);
                            $ct_dot = count($name_div);
                            $img_type = $name_div[$ct_dot -1];
                            //$destinationPath = public_path().'/uploads/rssbanner_images/'.$name;//chỉnh lại đường dẫn lưu ảnh rssbanner
                            $localPath='uploads/rssbanner_images/'.$date.'/'.$this->generateRandomString(2).'/'.$this->generateRandomString(2).'/';
                            $destinationPath=public_path().'/'.$localPath;
                            File::makeDirectory($destinationPath,$mode=0777,true,true);
                            //echo Response::download($url); die(); 
                            $image_name=$this->generateRandomString(28);
                            $adbanner->imagefile=$localPath.$image_name.'.'.$name;
                            file_put_contents($destinationPath.$image_name.'.'.$name, file_get_contents($url));//chỗ này bị lỗi không get_content được
                        
						$adbanner->adbanner_link=$item->link;
						$adbanner->adbanner_description=$item->description;
						$adbanner->expire_date=date('Y-m-d H:i:d',strtotime(date('Y-m-d H:i:s'))+60*60*24*$period);
						$adbanner->status=1;
						$check_exist_adbanner=AdBanner::where('adbanner_link','=',$item->link)->count();
						if($check_exist_adbanner>0){
							//Session::flash('message','This ad banner is already existed in database!');
						}else{
							$adbanner->save();
						}
					}
				}
		}
	}
	public function getBanner($website_id,$topic_id){
		$number_adbanners=AdBanner::join('websites_topics',function($join){
			$join->on('websites_banners.topic_id','=','websites_topics.id')->where('websites_banners.status','=',1);})->where('websites_banners.website_id','=',$website_id)->get();
		$adbanners=AdBanner::where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->where('status','=',1)->groupBy('adbanner_link')->get();
		$topic_selected=Topic::where('id','=',$topic_id)->where('website_id','=',$website_id)->first(); 
		$topics=Topic::where('website_id','=',$website_id)->get();
		$categories=Category::all();
		$all_actived_ads=AdBanner::where('status','=',1)->where('website_id','=',$website_id)->count();
		$actived_ads=AdBanner::where('status','=',1)->where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->count();
		$banned_ads=AdBanner::where('status','=',-1)->where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->count();
		$stopped_ads=AdBanner::where('status','=',0)->where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->count();
		return View::make('admin/rss/index')->with('number_adbanners',$number_adbanners)->with('adbanners',$adbanners)->with('topic_selected',$topic_selected)->with('topics',$topics)->with('categories',$categories)->with('website_id',$website_id)->with('all_actived_ads',$all_actived_ads)->with('actived_ads',$actived_ads)->with('banned_ads',$banned_ads)->with('stopped_ads',$stopped_ads);
	}
        public function getAdBanner($website_id,$number_ads){ //còn thiếu điều kiện lấy website_id|partner_id
            header('Access-Control-Allow-Origin: *'); 
            header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
//             if(isset($_REQUEST['website_id'])&&isset($_REQUEST['number_ads'])){	
//             	$website_id=$_REQUEST['website_id'];
//                 $number_ads=$_REQUEST['number_ads'];
//             }
            //echo $website_id.' '.$number_ads; 
            $date=date('Y-m-d');
            //get RSS banner của website_id nào, partner_id nào
            $partner=DB::table('websites_partners')->where('website_id','=',$website_id)->where('status','=',1)->groupBy('partner_id');
            $count_partner=DB::table('websites_partners')->where('website_id','=',$website_id)->where('status','=',1)->count(DB::raw('DISTINCT partner_id'));
            $count_adbanner=DB::table('websites_banners')->where('status','=',1)->count(DB::raw('DISTINCT website_id'));
            //echo $count_adbanner;
            //chuyển thành count theo website_id và partner_id
            //where orWhere
            if($count_adbanner<$number_ads){
                //$adbanners=AdBanner::where('status','=',1)->groupBy('adbanner_link')->orderBy(DB::raw('RAND()'))->take($number_ads)->get();
            }else{
                //$adbanners=DB::select('select * from websites_banners where status=1 group by website_id order by RAND() limit '.$number_ads);
                //$adbanners=DB::table('websites_banners')->where('status','=',1)/*->groupBy('website_id')*/->orderByRaw('RAND()')->take($number_ads)->get();
            }
            //print_r($partner->lists('partner_id'));
            $adbanners=AdBanner::where('status','=',1)->where('website_id','=',$website_id);
            for($i=0;$i<count($partner->lists('partner_id'));$i++){
            	$adbanners=$adbanners->orWhere('website_id','=',$partner->lists('partner_id')[$i]);
            }
            $adbanners=$adbanners->where('expire_date','>=',$date)->groupBy('adbanner_link')->orderBy(DB::raw('RAND()'))->take($number_ads)->get();
            return Response::json($adbanners);
        }
	public function postUpdateBanner($website_id,$adbanner_id){ 
		$rules=array(
		   'adbanner_title'=>'required',
		   'expire_date'=>'required|date|date_format:Y-m-d' 
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){ 
		   return Redirect::to('admin/rss-feed-'.$website_id)->withErrors($validator)->withInput(Input::except('adbanner_title'));
		}else{
		   $adbanner=AdBanner::find($adbanner_id); 
		   $adbanner->adbanner_title=Input::get('adbanner_title');
		   $date=date('Y-m-d');
		   $imagefile=Input::file('imagefile'); //var_dump($imagefile); die(); 
		   if($imagefile){//cái này check đúng rồi
		   	//remove ảnh cũ đi
		   	$old_adbanner=AdBanner::where('id','=',$adbanner_id)->get();
            if($old_adbanner->lists('imagefile')[0]!=''){
                $path=explode('/',$old_adbanner->lists('imagefile')[0]);
                $image_path=public_path().$path[0].'/'.$path[1].'/'.$path[2].'/'.$path[3].'/';
                File::deleteDirectory($image_path);
            }else{}
            //upload lại ảnh mới
		   	$destinationPath='uploads/rssbanner_images/'.$date.'/'.$this->generateRandomString(2).'/'.$this->generateRandomString(2).'/';
		   	$filename=$this->generateRandomString(28).'.'.$imagefile->getClientOriginalName();
		   	$adbanner->imagefile=$destinationPath.$filename;
		   	Input::file('imagefile')->move($destinationPath,$filename);
		   }
		   
		   $adbanner->expire_date=Input::get('expire_date');
		   $adbanner->updated_at=date('Y-m-d H:i:s');
		   $adbanner->save();
		   return Redirect::to('admin/rss-feed-'.$website_id);
		}
	}
	public function getDenyAdBanner($website_id,$adbanner_id){
		$adbanner=AdBanner::where('id','=',$adbanner_id)->first();
		$adbanner->status=-1;
		$adbanner->save();
		return Redirect::to('admin/rss-feed-'.$website_id);
	}
	public function getFeedBannerBanned($website_id,$topic_id){
		if($topic_id==0){
			$number_adbanners=AdBanner::join('websites_topics',function($join){
				$join->on('websites_banners.topic_id','=','websites_topics.id')->where('websites_banners.status','=',1);
			})->where('websites_banners.website_id','=',$website_id)->get();
			$adbanners=AdBanner::where('website_id','=',$website_id)->where('status','=',-1)->get();
			$topic_selected='All banners';
			$topics=Topic::where('website_id','=',$website_id)->get();
			$categories=Category::all();
			$actived_ads=AdBanner::where('status','=',1)->where('website_id','=',$website_id)->count();
			$all_actived_ads=AdBanner::where('status','=',1)->where('website_id','=',$website_id)->count();
			$banned_ads=AdBanner::where('status','=',-1)->where('website_id','=',$website_id)->count();
			$stopped_ads=AdBanner::where('status','=',0)->where('website_id','=',$website_id)->count();
		}else{
		$number_adbanners=AdBanner::join('websites_topics',function($join){
			$join->on('websites_banners.topic_id','=','websites_topics.id')->where('websites_banners.status','=',1);})->where('websites_banners.website_id','=',$website_id)->get();
		$adbanners=AdBanner::where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->where('status','=',-1)->get();
		$topic_selected=Topic::where('id','=',$topic_id)->where('website_id','=',$website_id)->first(); 
		$topics=Topic::where('website_id','=',$website_id)->get();
		$categories=Category::all();
		$all_actived_ads=AdBanner::where('status','=',1)->where('website_id','=',$website_id)->count();
		$actived_ads=AdBanner::where('status','=',1)->where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->count();
		$banned_ads=AdBanner::where('status','=',-1)->where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->count();
		$stopped_ads=AdBanner::where('status','=',0)->where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->count();
		}
		return View::make('admin/rss/banner_banned')->with('number_adbanners',$number_adbanners)->with('adbanners',$adbanners)->with('topic_selected',$topic_selected)->with('topics',$topics)->with('categories',$categories)->with('website_id',$website_id)->with('actived_ads',$actived_ads)->with('all_actived_ads',$all_actived_ads)->with('banned_ads',$banned_ads)->with('stopped_ads',$stopped_ads);
	}
	public function getFeedBannerStopped($website_id,$topic_id){
		if($topic_id==0){
			$number_adbanners=AdBanner::join('websites_topics',function($join){
				$join->on('websites_banners.topic_id','=','websites_topics.id')->where('websites_banners.status','=',1);
			})->where('websites_banners.website_id','=',$website_id)->get();
			$adbanners=AdBanner::where('website_id','=',$website_id)->where('status','=',0)->get();
			$topic_selected='All banners';
			$topics=Topic::where('website_id','=',$website_id)->get();
			$categories=Category::all();
			$actived_ads=AdBanner::where('status','=',1)->where('website_id','=',$website_id)->count();
			$all_actived_ads=AdBanner::where('status','=',1)->where('website_id','=',$website_id)->count();
			$banned_ads=AdBanner::where('status','=',-1)->where('website_id','=',$website_id)->count();
			$stopped_ads=AdBanner::where('status','=',0)->where('website_id','=',$website_id)->count();
		}else{
			$number_adbanners=AdBanner::join('websites_topics',function($join){
				$join->on('websites_banners.topic_id','=','websites_topics.id')->where('websites_banners.status','=',1);
			})->where('websites_banners.website_id','=',$website_id)->get();
			$adbanners=AdBanner::where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->where('status','=',0)->get();
			$topic_selected=Topic::where('id','=',$topic_id)->where('website_id','=',$website_id)->first();
			$topics=Topic::where('website_id','=',$website_id)->get();
			$categories=Category::all();
			$all_actived_ads=AdBanner::where('status','=',1)->where('website_id','=',$website_id)->count();
			$actived_ads=AdBanner::where('status','=',1)->where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->count();
			$banned_ads=AdBanner::where('status','=',-1)->where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->count();
			$stopped_ads=AdBanner::where('status','=',0)->where('topic_id','=',$topic_id)->where('website_id','=',$website_id)->count();
		}
		return View::make('admin/rss/banner_stopped')->with('number_adbanners',$number_adbanners)->with('adbanners',$adbanners)->with('topic_selected',$topic_selected)->with('topics',$topics)->with('categories',$categories)->with('website_id',$website_id)->with('actived_ads',$actived_ads)->with('all_actived_ads',$all_actived_ads)->with('banned_ads',$banned_ads)->with('stopped_ads',$stopped_ads);
	}
	public function getTopic($id){
		$number_adbanners=AdBanner::join('websites_topics','websites_banners.topic_id','=','websites_topics.id')->get();
		$topics=Topic::where('website_id','=',$id)->get();
		return View::make('admin/website/topic')->with('number_adbanners',$number_adbanners)->with('topics',$topics)->with('website_id',$id);
	}
    public function postUpdateTopic($website_id,$topic_id){
        $topic=Topic::find($topic_id);
        $topic->feed_name=Input::get('feed_name');
        $topic->feed_address=Input::get('feed_address');
        $topic->period=Input::get('period');
        $topic->save();
        return Redirect::to('admin/website-topic-'.$website_id);
    }
	public function enableStatusTopic($id){
		$topic=Topic::find($id);
		$topic->status=1;
		$adbanners=AdBanner::where('topic_id','=',$id)->update(array('status'=>1));
		$topic->save();
		$adbanners->save();
	}
	public function disableStatusTopic($id){
		$topic=Topic::find($id);
		$topic->status=0;
		$adbanners=AdBanner::where('topic_id','=',$id)->update(array('status'=>0));
		$topic->save();
		$adbanners->save();
	}
	public function getNewPartner($id){
	    $websites_partners=Partner::where('website_id','=',$id)->get();
	    //echo '<pre/>'; print_r($websites_partners->lists('partner_id')); die();
 	    if($websites_partners->lists('partner_id')){ 
 	    	$websites=Website::where('id','!=',$id);
 	    	for($i=0;$i<count($websites_partners->lists('partner_id'));$i++){
				//echo $websites_partners->lists('partner_id')[$i]; 
				$websites=$websites->where('id','!=',$websites_partners->lists('partner_id')[$i]);
 	    	}
 	    	$websites=$websites->get();
 	    }else{
	    	$websites=Website::where('id','!=',$id)->get();
	    } 
		$partners=Partner::where('website_id','=',$id)->where('status','=',-1)->get();
		$topics=Topic::all();
		$categories=Category::all();
		return View::make('admin/website/new_partner')->with('websites',$websites)->with('partners',$partners)->with('topics',$topics)->with('categories',$categories)->with('website_id',$id)->with('websites_partners',$websites_partners);
	}
	public function getPartnerActived($id){
		$partners=Partner::where('website_id','=',$id)->where('status','=',1)->get();
		$topics=Topic::all();
		$categories=Category::all();
		return View::make('admin/website/partner_actived')->with('partners',$partners)->with('topics',$topics)->with('categories',$categories)->with('website_id',$id);
	}
	public function getPartnerBanned($id){
		$partners=Partner::where('website_id','=',$id)->where('status','=',0)->get();
		$topics=Topic::all();
		$categories=Category::all();
		return View::make('admin/website/partner_banned')->with('partners',$partners)->with('topics',$topics)->with('categories',$categories)->with('website_id',$id);
	}
	public function deletePartner($website_id,$partner_id){
		$partner=Partner::find($partner_id);
		$partner->delete();
		return Redirect::to('admin/website-partner_banned-'.$website_id);
	}
	public function postPartner($id){ 
		//$rules=array(
			//'website_name'=>'required'	
		//);	
		//$validator=Validator::make(Input::all(),$rules);
		//if($validator->fails()){
			//return Redirect::to('admin/website-partner-'.$id)->withErrors($validator)->withInput(Input::except('website_name'));
		//}else{
			$partner_id=Input::get('partner_id');
			foreach($partner_id as $partner_id){ 
				$partner=new Partner;
				$website=Website::where('id','=',$partner_id)->get(); 
				$partner->website_id=$id;
				$partner->partner_id=$website->lists('id')[0];
				$partner->name=$website->lists('website')[0]; 
				$topics=Topic::where('website_id','=',$partner_id)->get();
				$topic_id='';
				foreach($topics as $topic){ 
					$topic_id.=$topic['id'].'; '; 	
				}
				$partner->topic_id=$topic_id;
				$partner->icp=$website->lists('icp')[0];
				$partner->status=-1;
				$partner->save(); //Doi sang bang websites
			}
			return Redirect::to('admin/website-partner_new-'.$id);
		//}
	}
	public function deleteAdBanner($website_id,$adbanner_id){
		$adbanner=AdBanner::find($adbanner_id);
		$adbanner->status=0;
		$adbanner->save();
		return Redirect::to('admin/rss-feed-'.$website_id);
	}
	public function destroyAdBanner($website_id,$adbanner_id){
		$adbanner=AdBanner::find($adbanner_id);
		$adbanner->delete();
		return Redirect::to('admin/rss-feed-'.$website_id);
	}
	public function getAcceptPartner($website_id,$partnerid){
		$partner=Partner::find($partnerid);
		$partner->status=1;
		$partner->save();
		return Redirect::to('admin/website-partner_banned-'.$website_id);
	}
	public function getDenyPartner($website_id,$partnerid){
		$partner=Partner::find($partnerid);
		$partner->status=0;
		$partner->save();
		return Redirect::to('admin/website-partner-'.$website_id);
	}
	public function getClickStats($id){
		$website=Website::find($id)->first();
		return View::make('admin/website/website_click_stats')->with('website',$website);
	}
    //delete all old folder image
    //cơ chế delete toàn bộ là không thể đc vì như thế sẽ mất toàn bộ ảnh trên server
    public function deleteFolderImage(){
    	$date=date('Y-m-d');
    	$folders=Folder::where('folder_name','!=',$date)->get();
		foreach($folders as $folder){
			//có thể delete bản ghi này trong csdl nếu muốn
        	$dir="../public/uploads/rssbanner_images/".$folder->folder_name.'/';
        	File::deleteDirectory($dir);
		}
    }
	public function changeEnableStatus($id){
		DB::table('websites_banners')->where('id','=',$id)->update(
			array(
				'status'=>1
			)
		);
	}
	public function changeDisableStatus($id){
		DB::table('websites_banners')->where('id','=',$id)->update(
			array(
				'status'=>-1
			)
		);
	}
}
?>