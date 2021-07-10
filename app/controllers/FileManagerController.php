<?php
class FileManagerController extends BaseController{
	public function index(){
		return View::make('admin/filemanager/index');
	}
	public function finder(){
		return Redirect::to('finder.php');
	}
    public function fileBrowser(){
        return View::make('admin/filemanager/file_browser');
    }
}
?>