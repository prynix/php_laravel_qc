<?php
class Usergroup extends Eloquent{
	protected $table="accounts";
	public function parent()
    {
        return $this->hasOne('Usergroup', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Usergroup', 'parent_id', 'id');
    }

    public static function tree()
    {
        return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id','=',0)->get();
    }
}
?>