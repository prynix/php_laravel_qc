<?php
class ErrorController extends BaseController{
	public function errorLoadAds(){
		$banners=Banner::all();
		//get url image

		//check file if is not exists in folder

		//return id banner error
	}
	public function errorFindBanner(){
		$banners=Banner::all();
		$error_banners=array(); 
		foreach($banners as $banner){
			if($banner->htmltemplate!=''&&$banner->filename==''){
			}else{
				if(file_exists($banner->filename)){

				}else{
					//print_r($banner->toArray()['filename']);
					$error_banners[]='<a href="banner-edit-'.$banner->toArray()['id'].'">'.$banner->toArray()['filename'].'</a>';
				}
			}
		}
		//print_r($error_banners); 
		//die();
		return Response::json($error_banners);
	}
	public function switch_debug_true(){
		$path=app_path().'/config/app.php'; 
		if($_SERVER['SERVER_NAME']=='localhost'||$_SERVER['SERVER_NAME']=='lqc.tintuc.vn'){
			$path_to_file=app_path().'/config/local/app.php'; 
		}else if($_SERVER['SERVER_NAME']=='sqc.tintuc.vn'){
            $path_to_file=app_path().'/config/staging/app.php'; 
		}else if($_SERVER['SERVER_NAME']=='qc.tintuc.vn'){
            $path_to_file=app_path().'/config/production/app.php'; 
		}
        $file_contents=file_get_contents($path_to_file);
        $file_contents=str_replace("'debug' => false", "'debug' => true", $file_contents);
        //đẩy lại kết quả vào trong file
        file_put_contents($path_to_file, $file_contents);

        $file_content=file_get_contents($path);
        $file_content=str_replace("'debug' => false", "'debug' => true", $file_content);
        //đẩy lại kết quả vào trong file
        file_put_contents($path, $file_content);
        return Redirect::to('admin/connect_to_database');
	}
	public function switch_debug_false(){
		$path=app_path().'/config/app.php'; 
		if($_SERVER['SERVER_NAME']=='localhost'||$_SERVER['SERVER_NAME']=='lqc.tintuc.vn'){
			$path_to_file=app_path().'/config/local/app.php'; 
		}else if($_SERVER['SERVER_NAME']=='sqc.tintuc.vn'){
            $path_to_file=app_path().'/config/staging/app.php'; 
		}else if($_SERVER['SERVER_NAME']=='qc.tintuc.vn'){
            $path_to_file=app_path().'/config/production/app.php'; 
		}
        $file_contents=file_get_contents($path_to_file);
        $file_contents=str_replace("'debug' => true", "'debug' => false", $file_contents);
        //đẩy lại kết quả vào trong file
        file_put_contents($path_to_file, $file_contents);

        $file_content=file_get_contents($path);
        $file_content=str_replace("'debug' => true", "'debug' => false", $file_content);
        //đẩy lại kết quả vào trong file
        file_put_contents($path, $file_content);
        return Redirect::to('admin/connect_to_database');
	}
}
?>