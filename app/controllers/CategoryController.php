<?php  
class CategoryController extends BaseController{
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
		$cat_parent=Category::where('parent_id','=',0)->where('status','=',1)->get();
		$categories=Category::where('parent_id','!=',0)->where('status','=',1)->get(); //echo '<pre/>'; print_r($categories); die();
		//$categories = Category::tree();
		return View::make('admin/category/index')->with('cat_parent',$cat_parent)->with('categories',$categories)->with('help',$this->__construct());
	}
	public function getCreate(){
		$categories = Category::tree();
		return View::make('admin/category/create')->with('categories',$categories)->with('help',$this->__construct());
	}
	public function postStore(){
		//validate
		$rules=array(
			'category_name'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/category-create')->withErrors($validator)->withInput(Input::except('category_name'));
		}else{
			$category=new Category;
			$category->category_name=Input::get('category_name');
			$category->parent_id=Input::get('parent_id');
            $lastID=Category::orderBy('order_no','DESC')->take(1)->get()->lists('order_no')[0];            
            $category->order_no=$lastID+1;
			$category->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="inserted";
            $userlog->context="Category";
            $userlog->contextid=$category->id;
            $userlog->object=$category->category_name;
            $userlog->details=Auth::user()->username.' inserted Category "'.$category->category_name.'" (#'.$category->id.')';
            $userlog->save();
            Session::flash('success','Successfully created the category!');
			return Redirect::to('admin/category');
		}
	}
	public function postUpdate($id){
		$rules=array(
			'category_name'=>'required'
		);
		$validator=Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Redirect::to('admin/category-edit-'.$id)->withErrors($validator)->withInput(Input::except('category_name'));
		}else{
			$category=Category::find($id);
			$category->category_name=Input::get('category_name');
			$category->parent_id=Input::get('parent_id');
			$category->save();
            $userlog=new Userlog;
            $userlog->account_id=Auth::user()->default_account_id;
            $userlog->userid=Auth::user()->id;
            $userlog->username=Auth::user()->username;
            $userlog->action="updated";
            $userlog->context="Category";
            $userlog->contextid=$category->id;
            $userlog->object=$category->category_name;
            $userlog->details=Auth::user()->username.' updated Category "'.$category->category_name.'" (#'.$category->id.')';
            $userlog->save();
            Session::flash('success','Successfully updated the category!');
			return Redirect::to('admin/category');
		}
	}
    public function delete($id)
	{
		Category::where('id','=',$id)->update(
							array(
								'status'=>0
							)
						);
        $category=Category::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="deleted";
        $userlog->context="Category";
        $userlog->contextid=$category->lists('id')[0];
        $userlog->object=$category->lists('category_name')[0];
        $userlog->details=Auth::user()->username.' deleted Category "'.$category->lists('category_name')[0].'" (#'.$category->lists('id')[0].')';
        $userlog->save();
        Session::flash('warning','Successfully deleted the category!');
        return Redirect::to('admin/category');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recycle_bin(){
        $categories = Category::where('status','=',0)->get();
		return View::make('admin/category/recycle_bin')->with('categories',$categories)->with('help',$this->__construct());
    }
    public function revert($id)
	{
        Category::where('id','=',$id)->update(
							array(
								'status'=>1
							)
						);
        $category=Category::where('id','=',$id)->get(); 
        $userlog=new Userlog;
        $userlog->account_id=Auth::user()->default_account_id;
        $userlog->userid=Auth::user()->id;
        $userlog->username=Auth::user()->username;
        $userlog->action="reverted";
        $userlog->context="Category";
        $userlog->contextid=$category->lists('id')[0];
        $userlog->object=$category->lists('category_name')[0];
        $userlog->details=Auth::user()->username.' reverted Category "'.$category->lists('category_name')[0].'" (#'.$category->lists('id')[0].')';
        $userlog->save();
        Session::flash('success','Successfully reverted the category!');
        return Redirect::to('admin/category');
	}
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
    public function destroy($id)
	{
        $categories=Category::find($id);
        $categories->delete();
        Session::flash('danger','Successfully destroyed the category!');
        return Redirect::to('admin/category-recycle');
    }
	
	public function getShow($id){
		$categories = Category::tree();
		$category=Category::find($id);
		return View::make('admin/category/show')->with('category',$category)->with('categories',$categories)->with('help',$this->__construct());
	}
	
	public function getCopy($id){
		$categories = Category::tree();
		$category=Category::find($id);
		return View::make('admin/category/copy')->with('category',$category)->with('categories',$categories)->with('help',$this->__construct());
	}
	
	public function getEdit($id){
		$categories = Category::tree();
		$category=Category::find($id);
		return View::make('admin/category/edit')->with('category',$category)->with('categories',$categories)->with('help',$this->__construct());
	}
}
?>