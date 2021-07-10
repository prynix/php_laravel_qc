<?php
//Dùng Queue để kích hoạt cronjob
class CronJobController extends BaseController{
    //Tạo danh mục các cronjob cần quét: quét tồn tại các id bị bằng 0, quét relationships giữa các bảng có hợp lệ không?, test performance
	public function index(){
		//Cron Job phải đi kèm với Set Time Out
		return View::make('admin/cronjob/index');
	}
	//kích hoạt bằng cách thêm tham số active=0|1 tới function xử lý, nếu=0 thì deactive, nếu=1 thì active
	public function checkExist($state){
		/*if($state==1){

		}elseif($state==0){

		}
		$timeout=TimeOut::first();
		$id=$timeout->toArray()['id'];
		$check_id=$timeout->toArray()['check_id'];
		if($check_id===''){

		}else{

		}*/
		//Kiem tra workflow chinh cac bang co chua id=0 hay khong?
		
	}
	public function checkRelationShip($state){
		/*if($state==1){

		}elseif($state==0){

		}*/
	}
}
?>