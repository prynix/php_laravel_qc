<?php
class Category extends Eloquent {

    public function parent()
    {
        return $this->hasOne('Category', 'id', 'parent_id');
    }

    public function child(){
        return $this->hasMany('Category','parent_id');
    }

    public function children()
    {
        return $this->hasMany('Category', 'parent_id', 'id');
    }

    public static function tree()
    {
        return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id','=',0)->get();
    }
}

?>