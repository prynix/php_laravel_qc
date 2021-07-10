<?php
//Tạo thêm các hình thức quảng cáo mới giống như bên admicro

class AdFormController extends BaseController{
	public function index(){
		return View::make('admin/adform/index');
	}
}
?>