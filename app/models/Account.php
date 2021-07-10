<?php
class Account extends Eloquent{
	protected $table="accounts";
	public function children(){
		return $this->hasMany('Account','parent_id');
	}
}
?>