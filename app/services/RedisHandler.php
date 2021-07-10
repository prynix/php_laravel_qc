<?php
class RedisHandler
{
	public static function setZoneData($zoneId)
	{

		$redis = Redis::connection();
		// get banner by zone id
		$data['zoneid'] = $zoneId;
		$data['banners'] = Banner::where('zoneid', '=', $zoneId)->get();
		$data['zone'] = Zone::find($zoneId);		

		$redis->pipeline(function($pipe) use ($data)
		{
			$cacheData = $pipe->set('zone_'.$data['zoneid'].':info', json_encode($data['zone']));
			$cacheData = $pipe->set('zone_'.$data['zoneid'].':banners', json_encode($data['banners']));
		});
		//echo '<pre/>'; print_r($data['zone']->toArray());
		//echo $data['zone']->toArray()['created_at'];
		//die();
		//return true;
	}
}

?>