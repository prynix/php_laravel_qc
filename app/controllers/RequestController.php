<?php
class RequestController extends BaseController{
	public function receiveRequest(){
		$requests=RequestOrder::where('status','=',1)->get();
		$users=User::where('status','=',1)->get();
		return View::make('admin/request/receive')->with('users',$users)->with('requests',$requests)->with('help',BaseController::__construct());
	}	
	public function postCreate(){ //print_r(BaseController::getDay()); die();
		$re=new RequestOrder;
		$re->sender=Input::get('sender');
		$re->title_request=Input::get('title_request');
		$re->content_request=Input::get('content_request');
		$attach_file=Input::file('attach_file'); 
		$attach_file_count=count($attach_file);
		$re->attach_file='';
		foreach($attach_file as $file){ print_r($file);
			//validate input type="file"
			$rules=array('file'=>'required');//'required|mimes:png,gif,jpeg,txt,pdf,doc'
			$validator=Validator::make(array('file'=>$file),$rules);
			//không giới hạn loại file upload
			//câu lệnh thử kiểm tra xem file có tồn tại hay không? : if(!isset($file)){ echo 1; }
			if($validator->passes()&&isset($file)){//upload với đường dẫn theo ngày (vì yêu cầu là theo ngày, lưu trữ ảnh (tài liệu quảng cáo theo ngày để dễ quản lý))
				$destinationPath='uploads/storage/'.BaseController::getYear().'/'.BaseController::getMonth().'/'.BaseController::getDay().'/';
				$filename=$file->getClientOriginalName();
				$re->attach_file.=$destinationPath.$filename.', '; 
				$file->move($destinationPath,$filename);
			}
		}
		$re->date_sent=Input::get('date_sent');
		$re->receiver=Input::get('receiver');
		$re->solverid=Input::get('userid');
		$re->created_at=date('Y-m-d H:i:s');
		$re->status=1;
		$saved=$re->save();
		if(!$saved){ //check before saved query
			Session::flash('danger','Missing created the request!');
		}else{
			Session::flash('success','Successfully created the request!');
		}
		return Redirect::to('admin/receive_request');
	}
	//Copy request
	public function postCopy($id){
		
	}
	//Edit request
	public function postUpdate($id){
		$re=RequestOrder::find($id);//print_r($re);
		$re->sender=Input::get('sender');
		$re->title_request=Input::get('title_request');
		$re->content_request=Input::get('content_request');
		$attach_file=Input::file('attach_file'); 
		$attach_file_count=count($attach_file);
		$re->attach_file='';
		foreach($attach_file as $file){ print_r($file);
			//validate input type="file"
			$rules=array('file'=>'required');//'required|mimes:png,gif,jpeg,txt,pdf,doc'
			$validator=Validator::make(array('file'=>$file),$rules);
			//không giới hạn loại file upload
			//câu lệnh thử kiểm tra xem file có tồn tại hay không? : if(!isset($file)){ echo 1; }
			if($validator->passes()&&isset($file)){//upload với đường dẫn theo ngày (vì yêu cầu là theo ngày, lưu trữ ảnh (tài liệu quảng cáo theo ngày để dễ quản lý))
				$destinationPath='uploads/storage/'.BaseController::getYear().'/'.BaseController::getMonth().'/'.BaseController::getDay().'/';
				$filename=$file->getClientOriginalName();
				$re->attach_file.=$destinationPath.$filename.', '; 
				$file->move($destinationPath,$filename);
			}
		}
		$re->date_sent=Input::get('date_sent');
		$re->receiver=Input::get('receiver');
		$re->solverid=Input::get('userid');
		$re->created_at=date('Y-m-d H:i:s');
		$re->status=1;
		$saved=$re->save();
		if(!$saved){ //check before saved query
			Session::flash('danger','Missing updated the request!');
		}else{
			Session::flash('success','Successfully updated the request!');
		}
		return Redirect::to('admin/receive_request');
	}
	//Delete request
	public function postDelete($id){
		RequestOrder::where('id','=',$id)->update(
			array(
				'status'=>0
			)
		);
		Session::flash('warning','Successfully deleted the request!');
		return Redirect::to('admin/receive_request');
	}
	//Recycle Bin
	public function getRecycleBin(){
		$requests=RequestOrder::where('status','=',0)->get();
		$users=User::where('status','=',1)->get();
		return View::make('admin/request/recycle')->with('users',$users)->with('requests',$requests)->with('help',BaseController::__construct());
	}
	//Revert request
	public function postRevert($id){
		RequestOrder::where('id','=',$id)->update(
			array(
				'status'=>1
			)
		);
		Session::flash('success','Successfully reverted the request!');
		return Redirect::to('admin/receive_request');
	}
	//Destroy request
	public function postDestroy($id){
		$request=RequestOrder::find($id); print_r($request->attach_file); 
		//delete files in folder
		if(isset($request->attach_file)){
			foreach (explode(', ',$request->attach_file) as $file) {	
				//check file_exists in laravel 4
				if(File::exists($file)){
					//delete files in laravel
					File::delete($file);
				}
			}
		}else{}
		$deleted=$request->delete();
		if(!$deleted){ //check before saved query
			Session::flash('danger','Missing destroyed the request!');
		}else{
			Session::flash('danger','Successfully destroyed the request!');
		}
		return Redirect::to('admin/request-recycle');
	}
}
?>