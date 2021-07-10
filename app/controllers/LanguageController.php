<?php 
class LanguageController extends BaseController{
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
	public function getList(){
		$languages=Language::where('status','=',1)->get();
		return View::make('admin/language/index')->with('languages',$languages)->with('help',$this->__construct());
	}
	public function getCreate(){
		return View::make('admin/language/create')->with('help',$this->__construct());
	}
	public function postStore(){
		$rules=array(
			'language_name'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/language')->withErrors($validator)->withInput(Input::except('language_name'));
		}else{
			$language=new Language();
			$language->language_name=Input::get('language_name');
			$language->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Language";
            $userlog->contextid=$language->id;
            $userlog->object=$language->language_name;
            $userlog->details=Auth::user()->username.' inserted Language "'.$language->language_name.'" (#'.$language->id.')';
            $userlog->save();
            Session::flash('success','Successfully created the language!');
			return Redirect::to('admin/language');
		}
	}
	public function postUpdate($id){
		$rules=array(
			'language_name'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/language-edit-'.$id)->withErrors($validator)->withInput(Input::except('language_name'));
		}else{
			$language=Language::find($id);
			$language->language_name=Input::get('language_name');
			$language->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="updated";
            $userlog->context="Language";
            $userlog->contextid=$language->id;
            $userlog->object=$language->language_name;
            $userlog->details=Auth::user()->username.' updated Language "'.$language->language_name.'" (#'.$language->id.')';
            $userlog->save();
            Session::flash('success','Successfully updated the language!');
			return Redirect::to('admin/language');
		}
	}
    public function delete($id)
	{
		Language::where('id','=',$id)->update(
							array(
								'status'=>0
							)
						);
        $language=Language::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="deleted";
        $userlog->context="Language";
        $userlog->contextid=$language->lists('id')[0];
        $userlog->object=$language->lists('language_name')[0];
        $userlog->details=Auth::user()->username.' deleted Language "'.$language->lists('language_name')[0].'" (#'.$language->lists('id')[0].')';
        $userlog->save();
        Session::flash('warning','Successfully deleted the language!');
        return Redirect::to('admin/language');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
        $languages = Language::where('status','=',0)->get();
		return View::make('admin/language/recycle_bin')->with('languages',$languages)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Language::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $language=Language::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="Language";
        $userlog->contextid=$language->lists('id')[0];
        $userlog->object=$language->lists('language_name')[0];
        $userlog->details=Auth::user()->username.' reverted Language "'.$language->lists('language_name')[0].'" (#'.$language->lists('id')[0].')';
        $userlog->save();
        Session::flash('success','Successfully reverted the language!');
        return Redirect::to('admin/language');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
    public function destroy($id)
	{
        $languages=Language::find($id);
        $languages->delete();
        Session::flash('danger','Successfully destroyed the language!');
        return Redirect::to('admin/language-recycle');
    }

	public function getShow($id){
		$language=Language::find($id);
		return View::make('admin/language/show')->with('language',$language)->with('help',$this->__construct());
	}
	
	public function getCopy($id){
		$language=Language::find($id);
		return View::make('admin/language/copy')->with('language',$language)->with('help',$this->__construct());
	}
	
	public function getEdit($id){
		$language=Language::find($id);
		return View::make('admin/language/edit')->with('language',$language)->with('help',$this->__construct());
	}
}
?>