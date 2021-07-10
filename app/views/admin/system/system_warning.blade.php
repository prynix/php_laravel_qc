<link type="text/css" rel="stylesheet" href="../assets/css/style.css" />
<!-- Sweet Alert CSS -->
<link rel="stylesheet" href="../assets/css/sweetalert.css">
<!-- jQuery Notification Plugin cosyAlert CSS -->
<link rel="stylesheet" type="text/css" href="../assets/css/jquery.cosyAlert.css" />
<link rel="stylesheet" type="text/css" href="../assets/css/rips.css" />
<link rel="stylesheet" href="../assets/css/reveal.css">
<?php

?>
<style type="text/css">
	* {
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	-o-user-select: none;
	user-select: none;
}
div {
	position:absolute;
}
</style>
<!-- jQuery 1.11.1 -->
<script src="../assets/js/jquery-1.11.1.min.js"></script>
<!-- Sweet Alert JS -->
<script src="../assets/js/sweetalert.min.js"></script>
<!-- jQuery Notification Plugin cosyAlert JS -->
<script type="text/javascript" src="../assets/js/jquery.cosyAlert.js"></script>
<script type="text/javascript" src="../assets/js/jquery.reveal.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/exploit.js"></script>
<script src="../assets/js/hotpatch.js"></script>
<script src="../assets/js/netron.js"></script>
<script type="text/javascript">
	var hostname;
	if(window.location.hostname=='localhost'){ 
      hostname="http://localhost/qc/public/";
    }else if(window.location.hostname=='lqc.tintuc.vn'){ 
      hostname="http://lqc.tintuc.vn/";
    }else if(window.location.hostname=='sqc.tintuc.vn'){ 
      hostname="http://sqc.tintuc.vn/";
    }else{
      hostname="http://qc.tintuc.vn/";
    }
    setInterval(function(){
        swal({
            title:'Security !',
            text:'Auto scan source code of system !',
            type: 'error',
            html: true,
            imageUrl: '../assets/img/icon/zoom.png',
            timer: 6000,
            showConfirmButton: true
        });
    },10000);
    setInterval(function(){
        swal({
            title:'Security !',
            text:'Auto backup database on server !',
            type: 'info',
            html: true,
            imageUrl: '../assets/img/icon/backup_server.png',
            timer: 6000,
            showConfirmButton: true
        });
    },20000);
    setInterval(function(){
        swal({
            title:'Security !',
            text:'Auto backup files on server !',
            type: 'info',
            html: true,
            imageUrl: '../assets/img/icon/files.png',
            timer: 6000,
            showConfirmButton: true
        });
    },28000);
	setInterval(function(){
		//request tới server 
		$.ajax({
                type:'GET',
                url:hostname+"admin/check_empty_data",
                success:function(data){ 
                	//handle json data with jquery
                    $.each(data,function(index,element){
                    	if(element.number_records==0){ 
					        cosyAlert('Dữ liệu ở bảng <b>'+element.name+'</b> bị trống !</em> (0 record)', 'error',
							{	
								vPos : 'bottom',
								hPos : 'right',
								autoHide : true,
								autoHideTime : 10000,
								showTime : 1000,
								hideTime : 1000
							});
                    	}
                    });
                },
                error:function(jqXHR,textStatus,errorThrown){ 
                    //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                }  
        });
    },120000);
$(document).ready(function(){

    $('a[data-reveal-id]').click(function(e) { 
        e.preventDefault();
        var modalLocation = $(this).attr('data-reveal-id');
        $('#'+modalLocation).reveal($(this).data());
    });
	var i = 0;
	var a3 = $('#a3');
	var a4 = $('#a4');
	var a5 = $('#a5');
	var a8 = $('#a8');
	var f2 = $('#f2');
	var f1 = $('#f1');
	var f5 = $('#f5');
	var number_tables=$('#number_tables').html();
	for (i = 1; i < 11; i++) {      
		a3.append('<span class=a3'+i+'></span>');
		$('.a3'+i+'').css({
			'-webkit-animation' : 'a3 1s '+(Math.random()*2)+'s  infinite',
			'-moz-animation' : 'a3 1s '+(Math.random()*2)+'s  infinite'
		}); 
	}
	setInterval(function() {
		$('#a3 span').each(function() {
    		$(this).text(Math.ceil(Math.random()*999));;
		});
	}, 100); 
	
	for (i = 1; i < 31; i++) {      
		a4.append('<span class=a3'+i+'></span>');
		setInterval(function() {
			$('#a4 span').each(function() {
				$(this).width((Math.random()*15));
			});
		}, 500);		
	}
	
	for (i = 1; i < number_tables; i++) {      
		/*a5.append('<span><b class=a5'+i+'></b></span>');
		$('.a5'+i+'').css({
			'-webkit-animation' : 'a3 1s 0.'+i+'s  infinite',
			'-moz-animation' : 'a3 1s 0.'+i+'s  infinite'
		});*/ 		
	}
	
	setInterval(function() {
		/*var h = Math.ceil(Math.random()*24);
		var m = Math.ceil(Math.random()*60);
		if (h<10) {$('.a731').text('0'+h+':');}
		else {$('.a731').text(h+':');}
		if (m<10) {$('.a732').text('0'+m);}
		else {$('.a732').text(m);}*/
	}, 100);
	
	setInterval(function() {
		/*var d = Math.ceil(Math.random()*30);
		var m = Math.ceil(Math.random()*12);
		var min = 1700, max = 1999;
		var rand = min - 0.5 + Math.random()*(max-min+1)
		rand = Math.round(rand);

		if (d<10) {$('.a741').text('0'+d+'/');}
		else {$('.a741').text(d+'/');}
		if (m<10) {$('.a742').text('0'+m+'/');}
		else {$('.a742').text(m+'/');}	
		$('.a743').text(rand);*/
	}, 50);	
	
	for (i = 1; i < 41; i++) {   
		a8.append('<span></span>');	
	}
	
	setInterval(function() {
		var mino = 10000, maxo = 99999;
		var rand = mino - 0.5 + Math.random()*(maxo-mino+1);
		rand = Math.round(rand);
		
		var mine = 100000000, maxe = 999999999;		
		var ran = mine - 0.5 + Math.random()*(maxe-mine+1);
		ran = Math.round(ran);		
		
		$('#a9 span:odd').text(rand);
		$('#a9 span:even').text(ran);		

	}, 100); 
	
	
	for (i = 1; i < 37; i++) {      
		f2.append('<span class=f2'+i+'></span>');
		$('.f2'+i+'').css({
			'-webkit-transform' : 'rotateZ('+i+'0deg) translateY(95px)'
		}); 		
	}
	
	for (i = 1; i < 19; i++) {      
		f5.append('<span class=f5'+i+'><b>'+Math.random()*30+'</b></span>');
		$('.f5'+i+'').css({
			'-webkit-transform' : 'rotateZ('+i*2+'0deg) translateY(40px)'
		}); 		
	}	
	
	for (i = 1; i < 13; i++) {      
		f1.append('<span class=f1'+i+'></span>');
		$('.f1'+i+'').css({
			'-webkit-transform' : 'rotateZ('+i*30+'deg) translateY(91px)'
		}); 		
	}
});
</script>
<div id="container">
	<div id="number_tables" style="display:none;">{{$number_tables}}</div>
    <div class="back">
        <a href="{{URL::to('/admin/dashboard')}}"><button>BACK</button></a> 
    </div>
	<div id="a1">   <div id="a11"></div>   </div>
    <div id="a2">   <div id="a21"></div>   </div>
    <div id="a3"></div>
    <div id="a4"></div>
    <div id="trigger">
        <p title="Trigger" id="check_exist_trigger">{{$condition}}</p>
    </div>
    <div id="a5">
    	<?php
    		echo '<script type="text/javascript">';
    		for($i=0;$i<count($sh);$i++){
    			if($sh[$i]['number_records']==0){
    				echo "$('#a5').append('<span title=".$sh[$i]['name']."(".$sh[$i]['number_records']."record) style=background-color:#FF0000;><b class=a5'+".$i."+'></b></span>');";
    			}else{
    				echo "$('#a5').append('<span title=".$sh[$i]['name']."><b class=a5'+".$i."+'></b></span>');";
    			}
    			echo "$('.a5'+".$i."+'').css({
					'-webkit-animation' : 'a3 1s 0.'+".$i."+'s  infinite',
					'-moz-animation' : 'a3 1s 0.'+".$i."+'s  infinite'
				});";
    		}
    		echo '</script>';
    	?>
    </div>
    <div id="a6">Defense system against instrusion</div>
    <div id="a7">
    	<span id="a71">paoock prod.</span>   
    	<span id="a73">
        	<b class="a731"><?php echo date('H'); ?>:</b>
            <b class="a732"><?php echo date('i'); ?></b>
        </span>
    	<span id="a74">
        	<b class="a741"><?php echo date('d'); ?>/</b>
            <b class="a742"><?php echo date('m'); ?>/</b>
            <b class="a743"><?php echo date('Y'); ?></b>
        </span>        
        <span id="a76">CSS animation</span>
    </div>
    <div id="a8">
    	<div id="a81"></div>  
    </div>
    <div id="scan"> 
        <a href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].'/qc/shelldetect.php' ?>"><button>SCAN</button></a> 
    </div>
    <div id="myModal" class="reveal-modal">
        <div class="menu">
            <div style="float:left;width:100%;">
                <table width="100%">
                    <tr>
                        <td width="75%" nowrap>
                            <table class="menutable" width="50%" style="float:left;">
                                <tr>
                                    <td nowrap><b>path / file:</b></td>
                                    <td colspan="3" nowrap><input type="text" size="80" id="location" value="<?php //echo BASEDIR; ?>" title="enter path to PHP file(s)"/></td>
                                    <td nowrap><input type="checkbox" id="subdirs" value="1" title="check to scan subdirectories"/>subdirs</td>
                                </tr>
                                <tr>
                                    <td nowrap>verbosity level:</td>
                                    <td nowrap>
                                        <select id="verbosity" style="width:100%" title="select verbosity level">
                                            <?php
                                                $verbosities=array(
                                                    1=>'1. user tainted only',
                                                    2=>'2. file/DB tainted +1',
                                                    3=>'3. show secured +1,2',
                                                    4=>'4. untainted +1,2,3',
                                                    5=>'5. debug mode'
                                                );
                                                foreach ($verbosities as $level => $description) {
                                                    echo "<option value=\"$level\">$description</option>\n";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td align="right" nowrap>
                                        vuln type:
                                    </td>
                                    <td>
                                        <select id="vector" style="width:100%" title="select vulnerability type to scan">
                                            <?php
                                                $vectors=array(
                                                    'all'=>'All',
                                                    'server'=>'All server-side',
                                                    'code'=>'- Code Execution',
                                                    'exec'=>'- Command Execution',
                                                    'connect'=>'- Header Injection',
                                                    'file_read'=>'- File Disclosure',
                                                    'file_include'=>'- File Manipulation',
                                                    'ldap'=>'- LDAP Injection',
                                                    'database'=>'- SQL Injection',
                                                    'xpath'=>'- XPath Injection',
                                                    'other'=>'- Other',
                                                    'client'=>'All client-side',
                                                    'xss'=>'- Cross-Site Scripting',
                                                    'httpheader'=>'- HTTP Response Splitting',
                                                    'unserialize'=>'Unserialize / POP'
                                                );
                                                foreach ($vectors as $vector => $description) {
                                                    echo "<option value=\"$vector\" ";
                                                    if($vector=='all') echo 'selected';
                                                    echo ">$description</option>\n";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <td><input type="button" value="start scan" style="width:100%" class="Button" onclick="scan(false);" title="start scan"/></td>
                                </tr>
                                <tr>
                                    <td nowrap>code style:</td>
                                    <td nowrap>
                                        <select name="stylesheet" id="css" onchange="setActiveStyleSheet(this.value);" style="width:49%;" title="select color schema for scan result">
                                            <?php

                                            ?>
                                        </select>
                                        <select id="treestyle" style="width:49%" title="select direction of code flow in scan result">
                                            <option value="1">bottom-up</option>
                                            <option value="2">top-down</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <div id="options" style="margin-top:-10px;display:none;text-align:center;">
                                <p class="textcolor">windows</p>
                                <input type="button" class="Button" style="width:50px;" value="files" onclick="openWindow(5);eval(document.getElementById('filegraph_code').innerHTML);" title="show list of scanned files"/>
                                <input type="button" class="Button" style="width:80px;" value="user input" onclick="openWindow(4)" title="show list of user input"/><br/>
                                <input type="button" class="Button" style="width:50px;" value="stats" onclick="document.getElementById('stats').style.display='block';" title="show scan statistics"/>
                                <input type="button" class="Button" style="width:80px;" value="functions" onclick="openWindow(3);eval(document.getElementById('functiongraph_code').innerHTML);" title="show list of user-defined functions"/>                                                                                                
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="scanning" id="scanning">scanning ...
                    <div class="scanned" id="scanned"></div>
                </div>
                <div id="result">

                </div>
            </div>
        </div>
        <div id="result">
            
        </div>
        <a class="close-reveal-modal">&#215;</a>
    </div>
    <div id="a9">
    	<span>12456</span>:
        <span>123456789</span>.
        <span>12456</span>:
        <span>123456789</span>&nbsp;
        <span>12456</span>
    </div>
    <div id="a10">
    	CSS 3D transforms
        <span></span>
    </div>
    <div id="b1">
    	<span class="b11"></span>
        <span class="b12"></span>
        <span class="b13"></span>
        <span class="b14"></span>
        <span class="b15"></span>
        <span class="b16"></span>
        <span class="b17"></span>
        <span class="b18"></span>
        <span class="b19"></span>
        <span class="b110"></span>
    </div>
    <div id="figure">
    
        <div id="a7">
            <span id="a71">paoock prod.</span>   
            <span id="a73">
	        	<b class="a731"><?php echo date('H'); ?>:</b>
	            <b class="a732"><?php echo date('i'); ?></b>
	        </span>
	    	<span id="a74">
	        	<b class="a741"><?php echo date('d'); ?>/</b>
	            <b class="a742"><?php echo date('m'); ?>/</b>
	            <b class="a743"><?php echo date('Y'); ?></b>
	        </span>             
            <span id="a76">CSS animation</span>
        </div>
        
    	<div id="f1"></div>        
    	<div id="f2"></div>
                
		<div id="f3">
        	<div id="f31">   <span class="f311"><b></b></span>   <span class="f312"><b></b></span>   </div>
            <div id="f32">   <span class="f321"></span>   <span class="f322"></span>   </div>
            <div id="f33"></div>
            <div id="f34"></div>
        </div>
        
        <div id="f4">
        	<div id="f41"></div>
            <div id="f42"></div>
            <div id="f43" class="f431"></div>
            <div id="f43" class="f432"></div>
            <div id="f43" class="f433"></div>
            <div id="f43" class="f434"></div>
        </div>
        
        <div id="f5"></div>
        
        <div id="f6"></div>  
        <div id="f7">
        	<div id="f71"></div>
            <div id="f72"></div>
        </div>
        <div id="f8">
        	<div id="f81"></div>
            <div id="f82"></div>
        </div>
        <div id="f9">
        	<span></span>
        </div>        
                
    </div>
</div>