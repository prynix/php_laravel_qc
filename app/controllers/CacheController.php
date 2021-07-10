<?php
class CacheController extends BaseController{
	public function deleteCache(){
		$dir=storage_path()."/cache"; 
		File::cleanDirectory($dir);
	}
	public function deleteCacheViews(){
		$dir=storage_path()."/views"; 
		File::cleanDirectory($dir);
	}
	public function deleteCacheSessions(){
		$dir=storage_path()."/sessions"; 
		File::cleanDirectory($dir);
	}
	public function cacheList(){
		$redis=Redis::connection();
		$zones=Zone::all(); 
		$list=array();
		for($i=0;$i<count($zones);$i++){
			if($redis->get('zone_'.$zones[$i]['id'].':banners')!==''){
				array_push($list,$zones[$i]['id']);
			}
		}
		return View::make('admin/cache/list')->with('list',$list);
	}
	public function updateCache(){
		return View::make('admin/cache/update');
	}
}
?>