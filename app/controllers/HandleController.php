<?php
class HandleController extends Controller
{
    public $maxrows = 50;

    public function __construct()
    {

    }

    public function __destruct()
    {

    }

    public function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) { //random character
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //cache trong function này
    //xem lại cách thức lần lượt cache
    //không thể xử lý một lúc nhiều tác vụ khi cache đc
    //chạy hàm cập nhật cache trước khi xử lý
    //chạy cập nhật cache bằng tay
    //CACHE FUNCTION GETVIEW
    //KHONG CAN GOI CHINH XAC KEY TRONG REDIS 
    public function getView($website_page) //NẾU XỬ LÝ THÊM CẢ CACHE NỮA THÌ SẼ RẤT NẶNG VÌ PHẢI THÔNG QUA QUÁ NHIỀU CÂU LỆNH
    {
        $redis=Redis::connection();
        //Test lai phan add website_id vao cviews
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        if (isset($website_page) && $website_page != '') {
            $website = Website::where('website', '=', 'http://' . $website_page . '/')->orWhere('website', '=', 'https://' . $website_page . '/');
            if ($website && $website->count() > 0) {
                //check if counter exist and update
                //1) DONE
                //DB::table('websites')->where('id', '=', $website->lists('id')[0])->increment('total_views', 1);
                //save in redis cache
                $website_id=$website->lists('id')[0];
                //get first, last website record
                $first_website=Website::orderBy('id','ASC')->take(1)->get();
                $last_website=Website::orderBy('id','DESC')->take(1)->get();
                for($i=$first_website->lists('id')[0];$i<=$last_website->lists('id')[0];$i++){
                    if($redis->get('qc_website_'.$i)!==NULL&&$i==$website_id){
                        $qc_w=$redis->get('qc_website_'.$i);
                        $a=json_decode($qc_w);
                        $id=$a->id;
                        $total_views=$a->total_views+1;
                    }else{
                        $id=$website_id;
                        $total_views=1;
                    }
                    //create a new array
                    $data_stats['id']=$id;
                    $data_stats['total_views']=$total_views;
                    //push to redis cache
                    $redis->pipeline(function($pipe) use ($data_stats){
                        $pipe->set('qc_website_'.$data_stats['id'],json_encode((object) $data_stats));
                    });
                }

                //add IP and user-agent and time
                //gather user data
                $ip_address = $_SERVER['REMOTE_ADDR'];//XEM LẠI CÁCH LẤY ĐỊA CHỈ IP
                $agent = $_SERVER['HTTP_USER_AGENT'];
                $date = date('Y-m-d');
                $datetime = date('Y-m-d H:i:s');
                $time_before = date('Y-m-d H:i:s', time() - (60 * 30));
                $count_views = Views::where('ip_address', '=', $ip_address)->where('view_at', '>', $time_before)->count(); //check if the IP is in database
                //echo $ip_address; die();
                //get region
                //service: http://ipinfo.io/json for your own IP
                //http://ipinfo.io/8.8.8.8/json for details on another IP
                $ipinfo = curl_init();
                curl_setopt($ipinfo, CURLOPT_URL, "http://ipinfo.io/" . $ip_address . "/json");
                curl_setopt($ipinfo, CURLOPT_RETURNTRANSFER, true);
                $q = curl_exec($ipinfo);
                curl_close($ipinfo);
                $obj = json_decode($q);
                if (isset($obj->city)) {
                    $city = $obj->city;
                } else {
                    $city = '';
                }
                if (isset($obj->region)) {
                    $region = $obj->region;
                } else {
                    $region = '';
                }
                if (isset($obj->country)) {
                    $country = $obj->country;
                } else {
                    $country = '';
                }
                if (isset($obj->lat)) {
                    $lat = $obj->lat;
                } else {
                    $lat = '';
                }
                if (isset($obj->long)) {
                    $long = $obj->long;
                } else {
                    $long = '';
                }
                if (isset($obj->org)) {
                    $org = $obj->org;
                } else {
                    $org = '';
                }
                ////////////////////
                if ($count_views == 0) {
                    //2) 
                    /*Views::insert(
                        array(
                            'website_id' => $website->lists('id')[0],
                            'ip_address' => $ip_address,
                            'user_agent' => $agent,
                            'city' => $city,
                            'region' => $region,
                            'country' => $country,
                            'lat' => $lat,
                            'long' => $long,
                            'org' => $org,
                            'view_at' => $datetime
                        )
                    );*/
                    //save in redis cache
                    for($i=$first_website->lists('id')[0];$i<=$last_website->lists('id')[0];$i++){
                        //create a new array
                        $data_stats['website_id']=$website->lists('id')[0]; //2.1
                        $data_stats['ip_address']=$ip_address; //2.2
                        $data_stats['user_agent']=$agent; //2.3
                        $data_stats['city']=$city; //2.4
                        $data_stats['region']=$region; //2.5
                        $data_stats['country']=$country; //2.6
                        $data_stats['lat']=$lat; //2.7
                        $data_stats['long']=$long; //2.8
                        $data_stats['org']=$org; //2.9
                        $data_stats['view_at']=$view_at; //2.10

                        //push to redis cache
                        $redis->pipeline(function($pipe) use ($data_stats){
                            $pipe->set('qc_website_views_'.$data_stats['website_id'],json_encode((object) $data_stats));
                        });
                    }

                    //delete the first entry in views if rows>$maxrows
                    $num_rows = Views::all()->count();
                    $to_delete = $num_rows - $this->maxrows;
                    if ($to_delete > 0) {
                        for ($i = 1; $i <= $to_delete; $i++) {
                            DB::delete(DB::raw("DELETE FROM views ORDER BY id ASC LIMIT 1"));
                        }
                    }
                    DB::table('websites')->where('id', '=', $website->lists('id')[0])->increment('unique_views', 1);
                    $count_cviews = DB::table('cviews')->where('day', '=', $date)->where('website_id', '=', $website->lists('id')[0])->count();
                    if ($count_cviews == 0) {
                        //3) 
                        /*DB::table('cviews')->insert(
                            array(
                                'website_id' => $website->lists('id')[0],
                                'day' => $date,
                                'user' => 1,
                                'view' => 1
                            )
                        );*/
                        //save in redis cache
                        for($i=$first_website->lists('id')[0];$i<=$last_website->lists('id')[0];$i++){
                            //create a new array
                            $data_stats['website_id']=$website->lists('id')[0]; 
                            $data_stats['day']=$date; 
                            $data_stats['user']=1; 
                            $data_stats['view']=1; 

                            //push to redis cache
                            $redis->pipeline(function($pipe) use ($data_stats){
                                $pipe->set('qc_website_cviews_'.$data_stats['website_id'],json_encode((object) $data_stats));
                            });
                        }
                    } else {
                        //4)
                        //DB::table('cviews')->where('day', '=', $date)->where('website_id', '=', $website->lists('id')[0])->increment('view', 1);
                        //$count_ip=Views::where('view_at','LIKE',$date.'%')->where('website_id','=',$website->lists('id')[0])->count(DB::raw('DISTINCT ip_address'));
                        //save in redis cache
                        for($i=$first_website->lists('id')[0];$i<=$last_website->lists('id')[0];$i++){
                            if($redis->get('qc_website_cviews_'.$i)!==NULL&&$i==$website_id){
                                $qc_w=$redis->get('qc_website_cviews_'.$i);
                                $a=json_decode($qc_w);
                                $data_stats['user']=$a->user; 
                                $data_stats['view']=$a->view+1; 
                            }else{ 
                                $data_stats['user']=1; 
                                $data_stats['view']=1; 
                            }
                            //create a new array
                            $data_stats['website_id']=$website->lists('id')[0]; 
                            $data_stats['day']=$date; 

                            //push to redis cache
                            $redis->pipeline(function($pipe) use ($data_stats){
                                $pipe->set('qc_website_cviews_'.$data_stats['website_id'],json_encode((object) $data_stats));
                            });
                        }

                        $count_ip = Views::where('view_at', 'LIKE', $date . '%')->where('website_id', '=', $website->lists('id')[0])->where('ip_address', '=', $ip_address)->count();
                        if ($count_ip == 0) { //cái này test lại đi :)
                            //5)
                            //DB::table('cviews')->where('day', '=', $date)->where('website_id', '=', $website->lists('id')[0])->increment('user', 1);
                            //save in redis cache
                            for($i=$first_website->lists('id')[0];$i<=$last_website->lists('id')[0];$i++){
                                if($redis->get('qc_website_cviews_'.$i)!==NULL&&$i==$website_id){
                                    $qc_w=$redis->get('qc_website_cviews_'.$i);
                                    $a=json_decode($qc_w);
                                    $data_stats['user']=$a->user+1;
                                    $data_stats['view']=$a->view; 
                                }else{ 
                                    $data_stats['user']=1; 
                                    $data_stats['view']=1; 
                                }
                                //create a new array
                                $data_stats['website_id']=$website->lists('id')[0]; 
                                $data_stats['day']=$date; 

                                //push to redis cache
                                $redis->pipeline(function($pipe) use ($data_stats){
                                    $pipe->set('qc_website_cviews_'.$data_stats['website_id'],json_encode((object) $data_stats));
                                });
                            }
                        } else {
                        }
                    }
                } else {

                }
            } else {
            }
        }
        //return 1;
    }
    //update from redis cache to database
    //Đợi đến cuối ngày rồi update lại vào database
    public function update_database(){ 
        $redis=Redis::connection();
        //get first, last website record
        $first_website=Website::orderBy('id','ASC')->take(1)->get();
        $last_website=Website::orderBy('id','DESC')->take(1)->get();
        //update view of banner
        //qc_website_, qc_website_views, qc_website_cviews 
        for($i=$first_website->lists('id')[0];$i<=$last_website->lists('id')[0];$i++){
           if($redis->get('qc_website_'.$i)!==NULL&&$i==$website_id){
                $a=$redis->get('qc_website_'.$i);
                $a=json_decode($a);
                $id=$a->id;
                $total_views=$a->total_views;
                $w=Website::where('id','=',$id)->get();
                if($w>0){
                    Website::where('id','=',$id)->update(
                        array(
                            'total_views'=>$total_views
                        )
                    );
                }else{
                    Website::insert(
                        array(
                            'id'=>$id,
                            'total_views'=>$total_views
                        )
                    );
                }
           }else{}
           //DỮ LIỆU BẢNG VIEWS CHƯA TỒN TẠI
           if($redis->get('qc_website_views_'.$i)!==NULL&&$i==$website_id){
                $b=$redis->get('qc_website_views_'.$i);
                $b=json_decode($b);
                $website_id=$b->website_id;
                $ip_address=$b->ip_address;
                $user_agent=$b->agent;
                $city=$b->city;
                $region=$b->region;
                $country=$b->country;
                $lat=$b->lat;
                $long=$b->long;
                $org=$b->org;
                $view_at=$b->datetime;

                Views::insert(
                    array(
                        'website_id'=>$website_id,
                        'ip_address'=>$ip_address,
                        'user_agent'=>$user_agent,
                        'city'=>$city,
                        'region'=>$region,
                        'country'=>$country,
                        'lat'=>$lat,
                        'long'=>$long,
                        'org'=>$org,
                        'view_at'=>$view_at
                    )
                );
           }else{}
           //DỮ LIỆU BẢNG CVIEWS CHƯA TỒN TẠI
           if($redis->get('qc_website_cviews_'.$i)!==NULL&&$i==$website_id){
                $c=$redis->get('qc_website_cviews_'.$i);
                $c=json_decode($c);
                $website_id=$c->website_id;
                $day=$c->day;
                $user=$c->user;
                $view=$c->view;

                DB::table('cviews')->insert(
                    array(
                        'website_id'=>$website_id,
                        'day'=>$day,
                        'user'=>$user,
                        'view'=>$view
                    )
                );
           }else{} 
        }
    }
    //trả về dữ liệu từ redis về database

    public function getClick($zoneid, $bannerid)
    {
        //Test lai phan add website_id vao cclicks
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $count_total_click = 0;
        if (isset($zoneid) && $zoneid > 0) {
            $zone = Zone::where('id', '=', $zoneid)->get();
            //echo $zone->lists('website_id')[0]; die();
        }
        if (isset($bannerid) && $bannerid > 0) {
            $time_before = date('Y-m-d H:i:s', time() - (60 * 5));
            $time_now = date('Y-m-d H:i:s');
            $clicks = Clicks::where('bannerid', '=', $bannerid)->where('ip_address', '=', $_SERVER['REMOTE_ADDR'])->where("click_at", ">", $time_before);

            if ($clicks && ($clicks->count() == 0)) {

                $date = explode(' ', date('Y-m-d H:i:s'))['0'];

                $check_day = DB::table('cclicks')->where('day', '=', $date)->where('website_id', '=', $zone->lists('website_id')[0]);

                if ($check_day && ($check_day->count() == 0)) {
                    DB::table('cclicks')->insert(
                        array(
                            'website_id' => $zone->lists('website_id')[0],
                            'day' => $date,
                            'user' => 1,
                            'click' => 1
                        )
                    );
                } else {
                    $check_ip = Clicks::where('ip_address', '=', $_SERVER['REMOTE_ADDR'])->where('click_at', 'LIKE', $date . '%');

                    if ($check_ip && $check_ip->count() == 0) {
                        DB::table('cclicks')->where('day', '=', $date)->where('website_id', '=', $zone->lists('website_id')[0])->increment('user', 1);
                        DB::table('cclicks')->where('day', '=', $date)->where('website_id', '=', $zone->lists('website_id')[0])->increment('click', 1);
                    } else {
                        DB::table('cclicks')->where('day', '=', $date)->where('website_id', '=', $zone->lists('website_id')[0])->increment('click', 1);
                    }
                }

                Banner::where('id', '=', $bannerid)->increment('unique_click', 1);
                //Bổ sung bắt đầu từ phần này
                DB::table('clicks')->insert(
                    array(
                        'bannerid' => $bannerid,
                        'ip_address' => $ip_address,
                        'click_at' => date('Y-m-d H:i:s')
                    )
                );
                //delete the first entry in table if rows > max_rows
                $number_rows = DB::table('clicks')->count();
                $to_delete = $number_rows - $this->maxrows;
                if ($to_delete > 0) {
                    for ($i = 1; $i <= $to_delete; $i++) {
                        DB::delete(DB::raw("DELETE FROM clicks ORDER BY id ASC LIMIT 1"));
                    }
                }
            } else {

            }

            $check_bannerid = Banner::select()->where('id', '=', $bannerid);
            if ($check_bannerid && ($check_bannerid->count() > 0)) {
                $result = Banner::where('id', '=', $bannerid)->increment('total_clicks', 1);

                if ($result) {
                    if ($check_bannerid->lists('url')[0] != '')
                        return Redirect::to($check_bannerid->lists('url')[0]);
                    else
                        return Redirect::to('http://' . $_SERVER['HTTP_HOST']);
                } else {
                }
            } else {

            }
        } else {

        }
    }

    public function moveTop($table, $id)
    {
        $current_record = $table::where('id', '=', $id)->get();
        $v1 = $current_record->lists('order_no')[0];
        $first_record = $table::orderBy('order_no', 'ASC')->get();
        $tmp = $first_record->lists('order_no')[0];
        $table::where('id', '=', $first_record->lists('id')[0])->update(
            array(
                'order_no' => $v1
            )
        );
        $table::where('id', '=', $id)->update(
            array(
                'order_no' => $tmp
            )
        );
        return Redirect::to('admin/' . strtolower($table));
    }

    public function moveUp($table, $id)
    {
        $current_record = $table::where('id', '=', $id)->get();
        $v1 = $current_record->lists('order_no')[0];
        $first_record = $table::where('order_no', '=', $v1 - 1)->get();
        $tmp = $first_record->lists('order_no')[0];
        $table::where('id', '=', $first_record->lists('id')[0])->update(
            array(
                'order_no' => $v1
            )
        );
        $table::where('id', '=', $id)->update(
            array(
                'order_no' => $tmp
            )
        );
        return Redirect::to('admin/' . strtolower($table));
    }

    public function moveDown($table, $id)
    {
        $current_record = $table::where('id', '=', $id)->get();
        $v1 = $current_record->lists('order_no')[0];
        $first_record = $table::where('order_no', '=', $v1 + 1)->get();
        $tmp = $first_record->lists('order_no')[0];
        $table::where('id', '=', $first_record->lists('id')[0])->update(
            array(
                'order_no' => $v1
            )
        );
        $table::where('id', '=', $id)->update(
            array(
                'order_no' => $tmp
            )
        );
        return Redirect::to('admin/' . strtolower($table));
    }

    public function moveBottom($table, $id)
    {
        $current_record = $table::where('id', '=', $id)->get();
        $v1 = $current_record->lists('order_no')[0];
        $first_record = $table::orderBy('order_no', 'DESC')->get();
        $tmp = $first_record->lists('order_no')[0];
        $table::where('id', '=', $first_record->lists('id')[0])->update(
            array(
                'order_no' => $v1
            )
        );
        $table::where('id', '=', $id)->update(
            array(
                'order_no' => $tmp
            )
        );
        return Redirect::to('admin/' . strtolower($table));
    }
}

?>