<?php
class Adtype extends Eloquent{
	protected $fillable=array('zonetype_id','title','preview','width','height');
	//protected $guarded = array('*');
	protected $table='adtypes';
}
?>