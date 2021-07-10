/*!
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This file should be included in all pages
 !**/

/*
 * Global variables. If you change any of these vars, don't forget 
 * to change the values in the less files!
 */
var left_side_width = 220; //Sidebar width in pixels
var hostname;
$(function() {	
    "use strict";
	if(window.location.hostname=='localhost'){ 
      hostname="http://localhost/qc/public/";
    }else if(window.location.hostname=='lqc.tintuc.vn'){ 
      hostname="http://lqc.tintuc.vn/";
    }else if(window.location.hostname=='sqc.tintuc.vn'){ 
      hostname="http://sqc.tintuc.vn/";
    }else{
      hostname="http://qc.tintuc.vn/";
    }
    setTimeout(function(){
        if(typeof(window.google_jobrunner)==='undefined'){
            //console.log('ad blocker installed');
        }else{
            //console.log('no ad blocking found.');
        }
        var ad=document.querySelector("ins.adsbygoogle"); 
        if(ad&&ad.innerHTML.replace(/\s/g,"").length==0){//Not found
            ad.style.cssText='display:block !important';
            ad.innerHTML="You seem to blocking Google AdSense ads in your browser.";
        }
        if($('div#myad').height()==0){ 
            $('#filename').append('TEXT TO DISPLAY IF ADBLOCK IS ACTIVE');
        }
    },500);
    //$(".container").shapeshift();
    $('button[name="allow_to_insert"]').each(function(){
        $(this).click(function(){ 
            var name=$(this).val();
            if($(this).attr('checked')==='checked'){
                $.ajax({
                    type:'GET',
                    url:hostname+"admin/not_allow_to_insert-"+name,
                    success:function(data){ 
                        window.location.reload(true);     
                    },
                    error:function(jqXHR,textStatus,errorThrown){ 
                        alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                    }  
                });
                $(this).removeAttr('checked');
            }else{
                $.ajax({
                    type:'GET',
                    url:hostname+"admin/allow_to_insert-"+name,
                    success:function(data){ 
                        window.location.reload(true);   
                    },
                    error:function(jqXHR,textStatus,errorThrown){ 
                        alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                    }  
                });
                $(this).attr('checked','checked');
            } 
        });
    });
    $('button[name="not_allow_to_insert"]').click(function(){
        var name=$(this).val();
        $.ajax({
            type:'GET',
            url:hostname+"admin/not_allow_to_insert-"+name,
            success:function(data){ 
                window.location.reload(true);             
            },
            error:function(jqXHR,textStatus,errorThrown){ 
                alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }  
        });
    });
    $('button[name="allow_to_update"]').each(function(){
        $(this).click(function(){ 
            var name=$(this).val();
            if($(this).attr('checked')==='checked'){
                $.ajax({
                    type:'GET',
                    url:hostname+"admin/not_allow_to_update-"+name,
                    success:function(data){ 
                        window.location.reload(true);     
                    },
                    error:function(jqXHR,textStatus,errorThrown){ 
                        alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                    }  
                });
                $(this).removeAttr('checked');
            }else{
                $.ajax({
                    type:'GET',
                    url:hostname+"admin/allow_to_update-"+name,
                    success:function(data){ 
                        window.location.reload(true);     
                    },
                    error:function(jqXHR,textStatus,errorThrown){ 
                        alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                    }  
                });
                $(this).attr('checked','checked');
            } 
        });
    });
    $('button[name="not_allow_to_update"]').click(function(){
        var name=$(this).val();
        $.ajax({
            type:'GET',
            url:hostname+"admin/not_allow_to_update-"+name,
            success:function(data){ 
                window.location.reload(true); 
            },
            error:function(jqXHR,textStatus,errorThrown){ 
                alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }  
        });
    });
    $('#btnRefresh').click(function(){
        location.reload(true);
    });
    /*$('ul.sidebar-menu').metisMenu({
        toggle: false
    });*/
    $('input[name="chk_timeout"]').click(function(){
        if($(this).is(':checked')){ $('input[name="txt_timeout"]').removeAttr('disabled');

        }else{
            $('input[name="txt_timeout"]').attr('disabled','disabled');
        }
    });
    $('#btnDisplay').click(function(){
        $('#zone_code').text('');
        $('#zone_banners').html('');
        if($('input[name="chk_timeout"]').is(':checked')){ $('input[name="txt_timeout"]').removeAttr('disabled');
                $('#zone_code').text('<iframe src="'+hostname+'qc/display_ads-'+$('#demo_zoneid').val()+'-'+$("#demo_zoneid option:selected").attr("website")+'-'+$('input[name="txt_timeout"]').val()+'" width="100%" height="100%" style="border:none;" class="ads-'+$('#demo_zoneid').val()+'"></iframe>');//<div class="ads-'+$('#demo_zoneid').val()+'"></div>');
                $('#zone_banners').html('<iframe src="'+hostname+'qc/display_ads-'+$('#demo_zoneid').val()+'-'+$("#demo_zoneid option:selected").attr("website")+'-'+$('input[name="txt_timeout"]').val()+'" width="100%" height="100%" style="border:none;" class="ads-'+$('#demo_zoneid').val()+'"></iframe>');//<div class="ads-'+$('#demo_zoneid').val()+'"></div>');
            }else{ $('input[name="txt_timeout"]').attr('disabled','disabled');
                $('#zone_code').text('<iframe src="'+hostname+'qc/display_qc-'+$('#demo_zoneid').val()+'-'+$("#demo_zoneid option:selected").attr("website")+'-0" width="100%" height="100%" style="border:none;" class="ads-'+$('#demo_zoneid').val()+'"></iframe>');
                $('#zone_banners').html('<iframe src="'+hostname+'qc/display_qc-'+$('#demo_zoneid').val()+'-'+$("#demo_zoneid option:selected").attr("website")+'-0" width="100%" height="100%" style="border:none;" class="ads-'+$('#demo_zoneid').val()+'"></iframe>');
            }
    });
    $('#btnCode').click(function(){

    });
    var doUpdate=function(){
        $('.time_countdown').each(function(){
            var count=parseInt($(this).html());
            if(count!==0){
                $(this).html(count-1);
            }
            if(count===0)
                $(this).html(3600);
           
        });
    };
    setInterval(doUpdate,1000); 
    var active;
    $("input[name='check_id'").click(function(){
        if($(this).is(':checked')){
            active=1;
            setInterval(function(){
                $.ajax({
                    type:'GET',
                    url:hostname+"admin/check_exist-"+active,
                    success:function(data){ 
                        //alert(data.replace(/ /g,''));    
                    },
                    error:function(jqXHR,textStatus,errorThrown){ 
                        //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                    }  
                });
            },20000);
        }else{
            active=0;
            setInterval(function(){
                $.ajax({
                    type:'GET',
                    url:hostname+"admin/check_exist-"+active,
                    success:function(data){ 
                        //alert(data.replace(/ /g,''));
                    },
                    error:function(jqXHR,textStatus,errorThrown){ 
                        //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                    }  
                });
            },20000);
        }
    });
    $("input[name='check_relationship'").click(function(){
        if($(this).is(':checked')){
            active=1;
            setInterval(function(){
                $.ajax({
                        type:'GET',
                        url:hostname+"admin/check_relationship-"+active,
                        success:function(data){ 
                            //alert('Successfully!');    
                        },
                        error:function(jqXHR,textStatus,errorThrown){ 
                            //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                        }  
                });
            },24000);
        }else{
            active=0;
            setInterval(function(){
                $.ajax({
                        type:'GET',
                        url:hostname+"admin/check_relationship-"+active,
                        success:function(data){ 
                            //alert('Successfully!');    
                        },
                        error:function(jqXHR,textStatus,errorThrown){ 
                            //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                        }  
                });
            },24000);
        }
    });
    setInterval(function(){
        $.ajax({
                type:'GET',
                url:hostname+"admin/get_location_from_ip",
                success:function(data){ 
                    $.each(data,function(a,b){ 
                            var ip_address=data['geoplugin_request'];
                            var city=data['geoplugin_city'];
                            swal({
                                title:'Security!',
                                text:'Finding location from your ip address! <br/>'+city+'<br/> Your IP address is <strong>'+ip_address+'</strong>'+
                                '<iframe src="http://www.infosniper.net/locate-ip-on-map.php?lang=1" with="260" height="450" scrolling="no" marginheight="0" marginwidth="0" frameborder="0" name="infosniper_gadget"></iframe>',
                                type: 'success',
                                html: true,
                                imageUrl: '../assets/img/icon/location-pointer.png',
                                timer: 12000,
                                showConfirmButton: true
                            });
                        
                    });
                },
                error:function(jqXHR,textStatus,errorThrown){ 
                    //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                }  
        });
    },$('span.request_ip').text());
    /*setInterval(function(){
        $.ajax({
                type:'GET',
                url:hostname+"admin/auto_change_password",
                success:function(data){ 
                    if(data==1){
                        swal({
                            title:'Security!',
                            text:'Auto change your password after 1 day!',
                            type: 'warning',
                            imageUrl: '../assets/img/icon/password.png',
                            timer: 6000,
                            showConfirmButton: true
                        });  
                    }else{}
                },
                error:function(jqXHR,textStatus,errorThrown){ 
                    //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                }  
        });
    },86400000);//,86400000);*/
    setInterval(function(){
        $.ajax({
                type:'GET',
                url:hostname+"admin/auto_creating_trigger",
                success:function(data){ 
                    swal({
                        title:'Security!',
                        text:'Locked database !',
                        type: 'warning',
                        imageUrl: '../assets/img/icon/lock.png',
                        timer: 6000,
                        showConfirmButton: true
                    });
                },
                error:function(jqXHR,textStatus,errorThrown){ 
                    //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                }  
        });
    },86400000);
    setInterval(function(){
        swal({
            title:'Security!',
            text:'Prohibit destroy data permanently!',
            type: 'error',
            imageUrl: '../assets/img/icon/data-center-px-png.png',
            timer: 6000,
            showConfirmButton: true
        });
    },1000000);
    $('#hover_blink').addClass('blinking');
    $("#debug-on").click(function(){
        var parent = $(this).parents('.switch_bug');
        $('#debug-off',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox_bug',parent).attr('checked', true);
        $.ajax({
                type:'GET',
                url:hostname+"admin/switch_debug_true",
                success:function(data){ 
                    //event.preventDefault;
                },
                error:function(jqXHR,textStatus,errorThrown){ 
                    //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                }  
        }); 
    });
    $("#debug-off").click(function(){
        var parent = $(this).parents('.switch_bug');
        $('#debug-on',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox_bug',parent).attr('checked', false);
        $.ajax({
                type:'GET',
                url:hostname+"admin/switch_debug_false",
                success:function(data){ 
                    //event.preventDefault;
                },
                error:function(jqXHR,textStatus,errorThrown){ 
                    //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                }  
        }); 
    });

    //Cho hiển thị
    $(':checkbox[name="check_mark"]').labelauty({label:false});
    $(':checkbox[name="check_mark"]').each(function(){ 
        var id=$(':checkbox[name="check_mark"]').attr('id');
        if($(this).val()==1){ 
            $('label[for="'+id+'"] span.labelauty-unchecked-image').css('display','none !important');
            $('label[for="'+id+'"] span.labelauty-checked-image').css('display','block !important');
            $(this).attr('checked','checked');
        }else{
            $('label[for="'+id+'"] span.labelauty-unchecked-image').css('display','block !important');
            $('label[for="'+id+'"] span.labelauty-checked-image').css('display','none !important');
            $(this).removeAttr('checked');
        }
    });
    $(':checkbox[name="check_mark"]').click(function(){
        var id=$(this).attr('bannerid');
        if($(this).val()==1){ 
            $.ajax({
                type:'GET',
                url:hostname+"admin/unmark_banner-"+id,
                success:function(data){ 
                    //event.preventDefault;
                },
                error:function(jqXHR,textStatus,errorThrown){ 
                    //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                }  
            }); 
        }else{
            $.ajax({
                type:'GET',
                url:hostname+"admin/mark_banner-"+id,
                success:function(data){
                    //event.preventDefault;
                },
                error:function(jqXHR,textStatus,errorThrown){ 
                    //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                }  
            });
        }
    });
    $('#download_template').click(function(event){
        $.ajax({
            type:'GET',
            url:hostname+"admin/download_template",
            success:function(data){
                //event.preventDefault;
            },
            error:function(jqXHR,textStatus,errorThrown){ 
                //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }  
        });
    });
	$(".print_link").on('click',function(){
		alert($('#print-div').val());
	});
    //Store variables
    var accordion_head=$('.accordion > li > a'),
        accordion_body=$('.accordion li > .sub-menu');
    //Open the first tab on load
    accordion_head.first().addClass('active').next().slideDown('normal');//speed: normal
    //Click function
    accordion_head.click(function(event){
        //Disable header links
        event.preventDefault();
        //Show and hide the tabs on click
        if($(this).attr('class')!='active'){
            accordion_body.slideUp('normal');
            $(this).next().stop(true,true).slideToggle('normal');
            accordion_head.removeClass('active');
            $(this).addClass('active');
        }
    });
    //Smart Wizard
    $('#steps').smartWizard();

    $('#wizard').steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",//hiệu ứng khi chuyển đổi
        stepsOrientation: "vertical"//hướng đi: theo chiều dọc
    });
    /*$('.grid-form input,.grid-form textarea').focus(function(){
        $(this).parent().css('background-color','#fffad4');
    });
    $('.grid-form input,.grid-form textarea').blur(function(){
        $(this).parent().css('background-color','#fff');
    });
    $('.grid-form input,.grid-form textarea,.grid-form select').parent().click(function(){
        $('.grid-form input,.grid-form textarea,.grid-form select:nth-child(even)').parent().css('background-color','#fff');
        $(this).css('background-color','#fffad4');
    });*/
    $('input#ch_effects').tzCheckbox({labels:['Enable','Disable']});
    $('#advertiser_ad').change(function(){ //alert($(this).val());
        //jquery ajax
        $.ajax({
            type:'GET',
            url:hostname+"admin/get-order_ads-"+$(this).val(),
            success:function(data){
                window.location.href=hostname+"admin/get-order_ads-"+$('#advertiser_ad').val();
            },
            error:function(jqXHR,textStatus,errorThrown){ 
                window.location.reload(true);
                //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }
        });
    });
    $('#advertiserid').change(function(){
        //jquery ajax
        $.ajax({
            type:'GET',
            url:hostname+"admin/get-package_order_ads-"+$(this).val(),
            success:function(data){
                window.location.href=hostname+"admin/get-package_order_ads-"+$('#advertiserid').val();
            },
            error:function(jqXHR,textStatus,errorThrown){ 
                //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }
        });
    });
    //$('#zone_banners').html('<script type="text/javascript" src="'+hostname+'assets/js/bbad.js"></script><script type="text/javascript">displayBanners(8,4);</script><div class="ads-8"></div>');
    $('.example-a').barrating('show',{
        readonly:true
    });
    $('.btnAddNew').click(function(){
        $('input[name="default"]').val('');
        $('input[name="host"]').val('');
        $('input[name="database"]').val('');
        $('input[name="username"]').val('');
        $('input[name="password"]').val('');
        $('input[name="charset"]').val('');
        $('input[name="collation"]').val('');
        $('input[name="prefix"]').val('');
        $('.btnSaveChanges').hide();
        $('.btnSave,.btnCancel').show();
    });
    $('.btnEdit').click(function(){
        $('input[name="default"]').removeAttr('disabled');
        $('input[name="host"]').removeAttr('disabled');
        $('input[name="database"]').removeAttr('disabled');
        $('input[name="username"]').removeAttr('disabled');
        $('input[name="password"]').removeAttr('disabled');
        $('input[name="charset"]').removeAttr('disabled');
        $('input[name="collation"]').removeAttr('disabled');
        $('input[name="prefix"]').removeAttr('disabled');
        $(this).hide();
        $('.btnSaveChanges,.btnCancel').show();
    });
    $('input[name="username"]').blur(function(){
        //alert(hostname+"admin/check-username_exist-"+$(this).val());
        $.ajax({
            type:'GET',
            url:hostname+"admin/check-username_exist-"+$(this).val(),
            success:function(data){ 
                if(data==1){
                    alert('Username existed');
                    $('input[name="username"]').val("");
                }else{}
            },
            error:function(jqXHR,textStatus,errorThrown){ 
                //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }
        });
    });
    $('#btnAddUserAccess').click(function(){
        $('#frmGroupAddUser').css('display','none');
        $('#frmUserAccess').css('display','block');
        $('#tblUserAccess').css('display','none');
    });
    $('#btnBackToUserAccess').click(function(){
        $('#frmGroupAddUser').css('display','block');
        $('#frmUserAccess').css('display','none');
        $('#tblUserAccess').css('display','block');
    });
    $(".radioButtonEnableTopic").click(function(){ 
        var topic_id=$(this).attr('id'); 
        $('.simple-loader').css('display','block').fadeOut('slow');
        $.ajax({
            type:'GET',
            url:hostname+"admin/website-topic_enable_status-"+topic_id,
            //url:hostname+"admin/website-topic_enable_status-"+topic_id,
            success:function(data){ 
                //alert("Successfully !");
                window.location.reload(true);
            },
            error:function(jqXHR,textStatus,errorThrown){ //alert(JSON.stringify(errorThrown));
                //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }
        });
        var parent = $(this).parents('.switch');
        $('.cb-disable',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', true);
    });
    $(".radioButtonDisableTopic").click(function(){ 
        var topic_id=$(this).attr('id'); 
        $('.simple-loader').css('display','block').fadeOut('slow');
        $.ajax({
            type:'GET',
            url:hostname+"admin/website-topic_disable_status-"+topic_id,
            //url:hostname+"public/admin/website-topic_disable_status-"+topic_id,
            success:function(data){ 
                //alert("Successfully !");
                window.location.reload(true);
            },
            error:function(jqXHR,textStatus,errorThrown){ //alert(JSON.stringify(errorThrown));
                //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }
        });
        var parent = $(this).parents('.switch');
        $('.cb-enable',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', false);
    });
    $(".radioButtonEnableBanner").click(function(){ 
    	var banner_id=$(this).attr('id'); 
        $('.simple-loader').css('display','block').fadeOut('slow');
        $.ajax({
            type:'GET',
            url:hostname+"admin/rss-feed_enable_status-"+banner_id,
            //url:hostname+"admin/website-topic_enable_status-"+topic_id,
            success:function(data){ 
                //alert("Successfully !");
                window.location.reload(true);
            },
            error:function(jqXHR,textStatus,errorThrown){ //alert(JSON.stringify(errorThrown));
                //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }
        });
        var parent = $(this).parents('.switch');
        $('.cb-disable',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', true);
    });
    $(".radioButtonDisableBanner").click(function(){ 
    	var banner_id=$(this).attr('id'); 
        $('.simple-loader').css('display','block').fadeOut('slow');
        $.ajax({
            type:'GET',
            url:hostname+"admin/rss-feed_disable_status-"+banner_id,
            //url:hostname+"public/admin/website-topic_disable_status-"+topic_id,
            success:function(data){ 
                //alert("Successfully !");
                window.location.reload(true);
            },
            error:function(jqXHR,textStatus,errorThrown){ //alert(JSON.stringify(errorThrown));
                //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }
        });
        var parent = $(this).parents('.switch');
        $('.cb-enable',parent).removeClass('selected');
        $(this).addClass('selected');
        $('.checkbox',parent).attr('checked', false);
    });
    $('textarea[name="code_block"]').text("<script type='text/javascript' src='"+hostname+"assets/js/bbad.js'></script><script type='text/javascript'>\n\tdisplayAdsRSS(6,'vertical');\n</script>\n<div class='vertical_display'></div>");
    $('#vertical_style').click(function(){
    	var style='vertical';
    	var number_ads=$('select[name="number_ads"]').val(); 
    	$('input[name="style"]').val(2);
    	//displayAdsRSS(number_ads,style);
    	//generate code output ở đây
    	$('textarea[name="code_block"]').text("<script type='text/javascript' src='"+hostname+"assets/js/bbad.js'></script><script type='text/javascript'>\n\tdisplayAdsRSS("+number_ads+",'vertical');\n</script>\n<div class='vertical_display'></div>");
    });
    $('#horizontal_style').click(function(){
    	var style='vertical';
    	var number_ads=$('select[name="number_ads"]').val(); 
    	$('input[name="style"]').val(1);
    	$('textarea[name="code_block"]').text("<script type='text/javascript' src='"+hostname+"assets/js/bbad.js'></script><script type='text/javascript'>\n\tdisplayAdsRSS("+number_ads+",'horizontal');\n</script>\n<div class='horizontal_display'></div>");
    });
    $('#ads_link_style').click(function(){
    	var style='ads_link';
    	var number_ads=$('select[name="number_ads"]').val(); 
    	$('input[name="style"]').val(3);
    	$('textarea[name="code_block"]').text("<script type='text/javascript' src='"+hostname+"assets/js/bbad.js'></script><script type='text/javascript'>\n\tdisplayAdsRSS("+number_ads+",'ads_link');\n</script>\n<div class='ads_link_display'></div>");
    });
    //select number_ads 
    $('select[name="number_ads"]').change(function(){
    	var style=$('input[name="style"]').val();
    	var number_ads=$(this).val();
    	if(style==1){
    		$('textarea[name="code_block"]').text("<script type='text/javascript' src='"+hostname+"assets/js/bbad.js'></script><script type='text/javascript'>\n\tdisplayAdsRSS("+number_ads+",'horizontal');\n</script>\n<div class='horizontal_display'></div>");
    	}else if(style==2){
    		$('textarea[name="code_block"]').text("<script type='text/javascript' src='"+hostname+"assets/js/bbad.js'></script><script type='text/javascript'>\n\tdisplayAdsRSS("+number_ads+",'vertical');\n</script>\n<div class='vertical_display'></div>");
    	}
    });
    $('a#file_backups').click(function(){
        $('.simple-loader').css('display','block').fadeOut('slow');
        $.ajax(
            {
             url: hostname+"admin/file-backups",
             //url: hostname+"admin/delete-views",
             type: 'GET',
             
             success:function()
             {
                //alert("Delete cache successfully !");
                setTimeout(function(){
                    $.bootstrapGrowl("Files backup successfully !",{
                        type:'success',
                        align: 'center',
                        vertical: 'top'
                    });
                },500);
                //window.load(true);
             },
            error:function(jqXHR,textStatus,errorThrown)
             {
                //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
                setTimeout(function(){
                    $.bootstrapGrowl("You can not backup these files "+errorThrown,{
                        type:'danger',
                        align: 'center',
                        vertical: 'top'
                    });
                },500);
             }
        });    
    });
    $('#delete_cache').click(function(){
        $('.simple-loader').css('display','block').fadeOut('slow');
        $.ajax(
            {
             url: hostname+"admin/delete_cache",
             //url: hostname+"admin/delete-views",
             type: 'GET',
             
             success:function()
             {
                //alert("Delete cache successfully !");
                setTimeout(function(){
                    $.bootstrapGrowl("Delete cache successfully !",{
                        type:'success',
                        align: 'center',
                        vertical: 'top'
                    });
                },500);
                window.load(true);
             },
            error:function(jqXHR,textStatus,errorThrown)
             {
                //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
                setTimeout(function(){
                    $.bootstrapGrowl("You can not send Cross Domain AJAX requests "+errorThrown,{
                        type:'danger',
                        align: 'center',
                        vertical: 'top'
                    });
                },500);
             }
        });    
    });

    var monthNames=["January","February","March","April","May","June","July","August","September","October","November","December"];
    var dayNames=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

    //create a newDate() object
    var newDate=new Date(); 
    //Extract the current date form Date object
    newDate.setDate(newDate.getDate());//default current date 
    //Output the day, date, month and year
    $("#date").html(dayNames[newDate.getDay()]+" "+newDate.getDate()+" "+ monthNames[newDate.getMonth()]+" "+newDate.getFullYear());

    var dt=new Date();
    var time=dt.getDate()+' '+dt.getMonth()+' '+dt.getFullYear()+', '+dt.getHours()+':'+dt.getMinutes()+':'+dt.getSeconds();
    //$('#time_to_refresh').text(time);
    //màn hình nhận mail hoặc lấy tin rss thì mới cần refresh lại
    /*
    TẠO BẢNG CHỨA THỜI GIAN SET TIME OUT ĐỘNG
    */
    setInterval(function(){
        $.ajax(
            {
             url: hostname+"auto_backup_database.php",
             type: 'GET',
             
             success:function()
             {
                setTimeout(function(){
                    $.bootstrapGrowl("Auto backup database successfully !",{
                        type:'success',
                        align: 'center',
                        vertical: 'top'
                    });
                },500);
             },
            error:function(jqXHR,textStatus,errorThrown)
             {
                //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
             }
        });
    },$('span.backup_database').text());
    setInterval(function(){
        $.ajax(
            {
             url: hostname+"admin/delete-cache_views",
             type: 'GET',
             
             success:function()
             {
                //alert("Successfully !");
                //location.reload(true);
             },
            error:function(jqXHR,textStatus,errorThrown)
             {
                //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
             }
        });
    },$('span.cache_view').text());
    /*setInterval(function(){
        $.ajax(
            {
             url: hostname+"admin/delete-cache_sessions",
             type: 'GET',
             
             success:function()
             {
                //alert("Successfully !");
                //location.reload(true);
             },
            error:function(jqXHR,textStatus,errorThrown)
             {
                //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
             }
        });
    },$('span.cache_session').text());*/
    setInterval(function(){
        $.ajax(
            {
             type: 'GET',
             url: hostname+"admin/error_find_banner",
             
             success:function(data)
             {
                //alert("Successfully !");
                for(var i=0;i<data.length;i++){
                    if(data[i]==''){
                        data[i]='empty';
                    }
                    $.notify("Path of file: '"+data[i]+"' is incorrect",'danger');
                }
             },
            error:function(jqXHR,textStatus,errorThrown)
             {
                //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
             }
        });    
    },$('span.find_ad_error').text());
    setInterval(function(){
        $.ajax(
        {
            type: 'GET',
            url: hostname+"admin/check-missing_database",
            success:function()
             {
                //alert("Successfully !");
             },
            error:function(jqXHR,textStatus,errorThrown)
             {
                //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
             }
        });
    },100000);
    setInterval(function(){
        var hours=new Date().getHours();
        $("#hours").html((hours<10?"0":"")+hours);
        var minutes=new Date().getMinutes();
        $("#min").html((minutes<10?"0":"")+minutes);
        var seconds=new Date().getSeconds();
        $("#sec").html((seconds<10?"0":"")+seconds);

        if(hours=="00"&&minutes=="00"&&seconds=="00"){ //tính toán thời điểm nào update từ redis vào database, mặc định là cuối ngày
            $.ajax(
             {
              url: hostname+"admin/update-database",
              type: 'GET',
             
              success:function()
              {
                 //alert("Successfully !");
                 //location.reload(true);
              },
             error:function(jqXHR,textStatus,errorThrown)
              {
                 //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
              }
            });
            $.ajax(
            {
             url: hostname+"admin/delete-views",
             //url: hostname+"admin/delete-views",
             type: 'GET',
             
             success:function()
             {
                //alert("Successfully !");
                location.reload(true);
             },
            error:function(jqXHR,textStatus,errorThrown)
             {
                //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
             }
            });
            $.ajax(
            {
             url: hostname+"admin/delete-clicks",
             //url: hostname+"admin/delete-views",
             type: 'GET',
             
             success:function()
             {
                //alert("Successfully !");
                location.reload(true);
             },
            error:function(jqXHR,textStatus,errorThrown)
             {
                //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
             }
            });
            $.ajax(
            {
             url: hostname+"admin/delete_cache",
             //url: hostname+"admin/delete-views",
             type: 'GET',
             
             success:function()
             {
                //alert("Delete cache successfully !");
                setTimeout(function(){
                    $.bootstrapGrowl("Delete cache successfully !",{
                        type:'success',
                        align: 'center',
                        vertical: 'top'
                    });
                },500);
             },
            error:function(jqXHR,textStatus,errorThrown)
             {
                //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
                setTimeout(function(){
                    $.bootstrapGrowl("You can not send Cross Domain AJAX requests : "+errorThrown,{
                        type:'danger',
                        align: 'center',
                        vertical: 'top'
                    });
                },500);
             }
            });    
        }
    },1000);

    $(window).scroll(function(){
        if($(this).scrollTop()!=0){
            $('#buttonToTop').fadeIn();
        }else{
            $('#buttonToTop').fadeOut();   
        }
    }); 
    $("#buttonToTop").click(function(){
        $("body,html").animate({
            scrollTop:0
        },800);
    });

	$('#active').datetimepicker({
		timepicker:false,
		format:'Y-m-d',
		formatDate:'Y-m-d'
	});
	$('#expire').datetimepicker({
		timepicker:false,
		format:'Y-m-d',
		formatDate:'Y-m-d'
	});
    $('#date_sent').datetimepicker({
        timepicker:false,
        format:'Y-m-d',
        formatDate:'Y-m-d'
    });
	$("[data-mask]").inputmask();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD hh:mm:ss'});

    //$('input:radio:first').attr('checked',true);
    $("[data-mask]").inputmask();
    $('#slide').popup({
        onopen:function(){
            $('.iCheck-helper').click(function(){
                if($('div.icheckbox_flat-red').attr('aria-checked')=='true'){
                    $('input[name="icp_name"]').removeAttr('disabled');
                }else{
                    $('input[name="icp_name"]').attr('disabled','disabled');
                    $('input[name="icp_name"]').val('');
                }
            });
        },
        focusdelay: 400,
        outline: true,
        vertical: 'top'
    });

    $('textarea#zone_code').click(function(){
        $(this).select();
        window.setTimeout(function(){
            $(this).select();
        },1);
        $(this).mouseup(function(){
            $(this).unbind("mouseup");//hủy lệnh
            return false;
        });
    });
    $('textarea#code_block').click(function(){
        $(this).select();
        window.setTimeout(function(){
            $this.select();
        },1);
        $(this).mouseup(function(){
            $(this).unbind("mouseup");//hủy lệnh
            return false;
        });
    });
    
    //Enable sidebar toggle
    $("[data-toggle='offcanvas']").click(function(e) {
        e.preventDefault();

        //If window is small enough, enable sidebar push menu
        if ($(window).width() <= 992) {
            $('.row-offcanvas').toggleClass('active');
            $('.left-side').removeClass("collapse-left");
            $(".right-side").removeClass("strech");
            $('.row-offcanvas').toggleClass("relative");
        } else {
            //Else, enable content streching
            $('.left-side').toggleClass("collapse-left");
            $(".right-side").toggleClass("strech");
        }
    });

    //Add hover support for touch devices
    $('.btn').bind('touchstart', function() {
        $(this).addClass('hover');
    }).bind('touchend', function() {
        $(this).removeClass('hover');
    });

    //Activate tooltips
    $("[data-toggle='tooltip']").tooltip();

    /*     
     * Add collapse and remove events to boxes
     */
    $("[data-widget='collapse']").click(function() {
        //Find the box parent        
        var box = $(this).parents(".box").first();
        //Find the body and the footer
        var bf = box.find(".box-body, .box-footer");
        if (!box.hasClass("collapsed-box")) {
            box.addClass("collapsed-box");
            bf.slideUp();
        } else {
            box.removeClass("collapsed-box");
            bf.slideDown();
        }
    });

    /*
     * ADD SLIMSCROLL TO THE TOP NAV DROPDOWNS
     * ---------------------------------------
     */
    $(".navbar .menu").slimscroll({
        height: "200px",
        alwaysVisible: false,
        size: "3px"
    }).css("width", "100%");

    /*
     * INITIALIZE BUTTON TOGGLE
     * ------------------------
     */
    $('.btn-group[data-toggle="btn-toggle"]').each(function() {
        var group = $(this);
        $(this).find(".btn").click(function(e) {
            group.find(".btn.active").removeClass("active");
            $(this).addClass("active");
            e.preventDefault();
        });

    });

    $("[data-widget='remove']").click(function() {
        //Find the box parent        
        var box = $(this).parents(".box").first();
        box.slideUp();
    });

    /* Sidebar tree view */
    $(".sidebar .treeview").tree();

    /* 
     * Make sure that the sidebar is streched full height
     * ---------------------------------------------
     * We are gonna assign a min-height value every time the
     * wrapper gets resized and upon page load. We will use
     * Ben Alman's method for detecting the resize event.
     * 
     **/
    function _fix() {
        //Get window height and the wrapper height
        var height = $(window).height() - $("body > .header").height();
        $(".wrapper").css("min-height", height + "px");
        var content = $(".wrapper").height();
        //If the wrapper height is greater than the window
        if (content > height)
            //then set sidebar height to the wrapper
            $(".left-side, html, body").css("min-height", content + "px");
        else {
            //Otherwise, set the sidebar to the height of the window
            $(".left-side, html, body").css("min-height", height + "px");
        }
    }
    //Fire upon load
    _fix();
    //Fire when wrapper is resized
    $(".wrapper").resize(function() {
        _fix();
        fix_sidebar();
    });

    //Fix the fixed layout sidebar scroll bug
    fix_sidebar();

    /*
     * We are gonna initialize all checkbox and radio inputs to 
     * iCheck plugin in.
     * You can find the documentation at http://fronteed.com/iCheck/
     */
    // $("input[type='checkbox'], input[type='radio']").iCheck({
    //     checkboxClass: 'icheckbox_minimal',
    //     radioClass: 'iradio_minimal'
    // });

});
function fix_sidebar() {
    //Make sure the body tag has the .fixed class
    if (!$("body").hasClass("fixed")) {
        return;
    }

    //Add slimscroll
    $(".sidebar").slimscroll({
        height: ($(window).height() - $(".header").height()) + "px",
        color: "rgba(0,0,0,0.2)"
    });
}
function change_layout() {
    $("body").toggleClass("fixed");
    fix_sidebar();
}
function change_skin(cls) {
    $("body").removeClass("skin-blue skin-black");
    $("body").addClass(cls);
}
/*END DEMO*/
$(window).load(function() {
    /*! pace 0.4.17 */
    (function() {
        var a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V = [].slice, W = {}.hasOwnProperty, X = function(a, b) {
            function c() {
                this.constructor = a
            }
            for (var d in b)
                W.call(b, d) && (a[d] = b[d]);
            return c.prototype = b.prototype, a.prototype = new c, a.__super__ = b.prototype, a
        }, Y = [].indexOf || function(a) {
            for (var b = 0, c = this.length; c > b; b++)
                if (b in this && this[b] === a)
                    return b;
            return-1
        };
        for (t = {catchupTime:500, initialRate:.03, minTime:500, ghostTime:500, maxProgressPerFrame:10, easeFactor:1.25, startOnPageLoad:!0, restartOnPushState:!0, restartOnRequestAfter:500, target:"body", elements:{checkInterval:100, selectors:["body"]}, eventLag:{minSamples:10, sampleCount:3, lagThreshold:3}, ajax:{trackMethods:["GET"], trackWebSockets:!1}}, B = function() {
            var a;
            return null != (a = "undefined" != typeof performance && null !== performance ? "function" == typeof performance.now ? performance.now() : void 0 : void 0) ? a : +new Date
        }, D = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame, s = window.cancelAnimationFrame || window.mozCancelAnimationFrame, null == D && (D = function(a) {
            return setTimeout(a, 50)
        }, s = function(a) {
            return clearTimeout(a)
        }), F = function(a) {
            var b, c;
            return b = B(), (c = function() {
                var d;
                return d = B() - b, d >= 33 ? (b = B(), a(d, function() {
                    return D(c)
                })) : setTimeout(c, 33 - d)
            })()
        }, E = function() {
            var a, b, c;
            return c = arguments[0], b = arguments[1], a = 3 <= arguments.length ? V.call(arguments, 2) : [], "function" == typeof c[b] ? c[b].apply(c, a) : c[b]
        }, u = function() {
            var a, b, c, d, e, f, g;
            for (b = arguments[0], d = 2 <= arguments.length?V.call(arguments, 1):[], f = 0, g = d.length; g > f; f++)
                if (c = d[f])
                    for (a in c)
                        W.call(c, a) && (e = c[a], null != b[a] && "object" == typeof b[a] && null != e && "object" == typeof e ? u(b[a], e) : b[a] = e);
            return b
        }, p = function(a) {
            var b, c, d, e, f;
            for (c = b = 0, e = 0, f = a.length; f > e; e++)
                d = a[e], c += Math.abs(d), b++;
            return c / b
        }, w = function(a, b) {
            var c, d, e;
            if (null == a && (a = "options"), null == b && (b = !0), e = document.querySelector("[data-pace-" + a + "]")) {
                if (c = e.getAttribute("data-pace-" + a), !b)
                    return c;
                try {
                    return JSON.parse(c)
                } catch (f) {
                    return d = f, "undefined" != typeof console && null !== console ? console.error("Error parsing inline pace options", d) : void 0
                }
            }
        }, g = function() {
            function a() {
            }
            return a.prototype.on = function(a, b, c, d) {
                var e;
                return null == d && (d = !1), null == this.bindings && (this.bindings = {}), null == (e = this.bindings)[a] && (e[a] = []), this.bindings[a].push({handler: b, ctx: c, once: d})
            }, a.prototype.once = function(a, b, c) {
                return this.on(a, b, c, !0)
            }, a.prototype.off = function(a, b) {
                var c, d, e;
                if (null != (null != (d = this.bindings) ? d[a] : void 0)) {
                    if (null == b)
                        return delete this.bindings[a];
                    for (c = 0, e = []; c < this.bindings[a].length; )
                        this.bindings[a][c].handler === b ? e.push(this.bindings[a].splice(c, 1)) : e.push(c++);
                    return e
                }
            }, a.prototype.trigger = function() {
                var a, b, c, d, e, f, g, h, i;
                if (c = arguments[0], a = 2 <= arguments.length ? V.call(arguments, 1) : [], null != (g = this.bindings) ? g[c] : void 0) {
                    for (e = 0, i = []; e < this.bindings[c].length; )
                        h = this.bindings[c][e], d = h.handler, b = h.ctx, f = h.once, d.apply(null != b ? b : this, a), f ? i.push(this.bindings[c].splice(e, 1)) : i.push(e++);
                    return i
                }
            }, a
        }(), null == window.Pace && (window.Pace = {}), u(Pace, g.prototype), C = Pace.options = u({}, t, window.paceOptions, w()), S = ["ajax", "document", "eventLag", "elements"], O = 0, Q = S.length; Q > O; O++)
            I = S[O], C[I] === !0 && (C[I] = t[I]);
        i = function(a) {
            function b() {
                return T = b.__super__.constructor.apply(this, arguments)
            }
            return X(b, a), b
        }(Error), b = function() {
            function a() {
                this.progress = 0
            }
            return a.prototype.getElement = function() {
                var a;
                if (null == this.el) {
                    if (a = document.querySelector(C.target), !a)
                        throw new i;
                    this.el = document.createElement("div"), this.el.className = "pace pace-active", document.body.className = document.body.className.replace("pace-done", ""), document.body.className += " pace-running", this.el.innerHTML = '<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>', null != a.firstChild ? a.insertBefore(this.el, a.firstChild) : a.appendChild(this.el)
                }
                return this.el
            }, a.prototype.finish = function() {
                var a;
                return a = this.getElement(), a.className = a.className.replace("pace-active", ""), a.className += " pace-inactive", document.body.className = document.body.className.replace("pace-running", ""), document.body.className += " pace-done"
            }, a.prototype.update = function(a) {
                return this.progress = a, this.render()
            }, a.prototype.destroy = function() {
                try {
                    this.getElement().parentNode.removeChild(this.getElement())
                } catch (a) {
                    i = a
                }
                return this.el = void 0
            }, a.prototype.render = function() {
                var a, b;
                return null == document.querySelector(C.target) ? !1 : (a = this.getElement(), a.children[0].style.width = "" + this.progress + "%", (!this.lastRenderedProgress || this.lastRenderedProgress | 0 !== this.progress | 0) && (a.children[0].setAttribute("data-progress-text", "" + (0 | this.progress) + "%"), this.progress >= 100 ? b = "99" : (b = this.progress < 10 ? "0" : "", b += 0 | this.progress), a.children[0].setAttribute("data-progress", "" + b)), this.lastRenderedProgress = this.progress)
            }, a.prototype.done = function() {
                return this.progress >= 100
            }, a
        }(), h = function() {
            function a() {
                this.bindings = {}
            }
            return a.prototype.trigger = function(a, b) {
                var c, d, e, f, g;
                if (null != this.bindings[a]) {
                    for (f = this.bindings[a], g = [], d = 0, e = f.length; e > d; d++)
                        c = f[d], g.push(c.call(this, b));
                    return g
                }
            }, a.prototype.on = function(a, b) {
                var c;
                return null == (c = this.bindings)[a] && (c[a] = []), this.bindings[a].push(b)
            }, a
        }(), N = window.XMLHttpRequest, M = window.XDomainRequest, L = window.WebSocket, v = function(a, b) {
            var c, d, e, f;
            f = [];
            for (d in b.prototype)
                try {
                    e = b.prototype[d], null == a[d] && "function" != typeof e ? f.push(a[d] = e) : f.push(void 0)
                } catch (g) {
                    c = g
                }
            return f
        }, z = [], Pace.ignore = function() {
            var a, b, c;
            return b = arguments[0], a = 2 <= arguments.length ? V.call(arguments, 1) : [], z.unshift("ignore"), c = b.apply(null, a), z.shift(), c
        }, Pace.track = function() {
            var a, b, c;
            return b = arguments[0], a = 2 <= arguments.length ? V.call(arguments, 1) : [], z.unshift("track"), c = b.apply(null, a), z.shift(), c
        }, H = function(a) {
            var b;
            if (null == a && (a = "GET"), "track" === z[0])
                return"force";
            if (!z.length && C.ajax) {
                if ("socket" === a && C.ajax.trackWebSockets)
                    return!0;
                if (b = a.toUpperCase(), Y.call(C.ajax.trackMethods, b) >= 0)
                    return!0
            }
            return!1
        }, j = function(a) {
            function b() {
                var a, c = this;
                b.__super__.constructor.apply(this, arguments), a = function(a) {
                    var b;
                    return b = a.open, a.open = function(d, e) {
                        return H(d) && c.trigger("request", {type: d, url: e, request: a}), b.apply(a, arguments)
                    }
                }, window.XMLHttpRequest = function(b) {
                    var c;
                    return c = new N(b), a(c), c
                }, v(window.XMLHttpRequest, N), null != M && (window.XDomainRequest = function() {
                    var b;
                    return b = new M, a(b), b
                }, v(window.XDomainRequest, M)), null != L && C.ajax.trackWebSockets && (window.WebSocket = function(a, b) {
                    var d;
                    return d = new L(a, b), H("socket") && c.trigger("request", {type: "socket", url: a, protocols: b, request: d}), d
                }, v(window.WebSocket, L))
            }
            return X(b, a), b
        }(h), P = null, x = function() {
            return null == P && (P = new j), P
        }, x().on("request", function(b) {
            var c, d, e, f;
            return f = b.type, e = b.request, Pace.running || C.restartOnRequestAfter === !1 && "force" !== H(f) ? void 0 : (d = arguments, c = C.restartOnRequestAfter || 0, "boolean" == typeof c && (c = 0), setTimeout(function() {
                var b, c, g, h, i, j;
                if (b = "socket" === f ? e.readyState < 2 : 0 < (h = e.readyState) && 4 > h) {
                    for (Pace.restart(), i = Pace.sources, j = [], c = 0, g = i.length; g > c; c++) {
                        if (I = i[c], I instanceof a) {
                            I.watch.apply(I, d);
                            break
                        }
                        j.push(void 0)
                    }
                    return j
                }
            }, c))
        }), a = function() {
            function a() {
                var a = this;
                this.elements = [], x().on("request", function() {
                    return a.watch.apply(a, arguments)
                })
            }
            return a.prototype.watch = function(a) {
                var b, c, d;
                return d = a.type, b = a.request, c = "socket" === d ? new m(b) : new n(b), this.elements.push(c)
            }, a
        }(), n = function() {
            function a(a) {
                var b, c, d, e, f, g, h = this;
                if (this.progress = 0, null != window.ProgressEvent)
                    for (c = null, a.addEventListener("progress", function(a) {
                        return h.progress = a.lengthComputable ? 100 * a.loaded / a.total : h.progress + (100 - h.progress) / 2
                    }), g = ["load", "abort", "timeout", "error"], d = 0, e = g.length; e > d; d++)
                        b = g[d], a.addEventListener(b, function() {
                            return h.progress = 100
                        });
                else
                    f = a.onreadystatechange, a.onreadystatechange = function() {
                        var b;
                        return 0 === (b = a.readyState) || 4 === b ? h.progress = 100 : 3 === a.readyState && (h.progress = 50), "function" == typeof f ? f.apply(null, arguments) : void 0
                    }
            }
            return a
        }(), m = function() {
            function a(a) {
                var b, c, d, e, f = this;
                for (this.progress = 0, e = ["error", "open"], c = 0, d = e.length; d > c; c++)
                    b = e[c], a.addEventListener(b, function() {
                        return f.progress = 100
                    })
            }
            return a
        }(), d = function() {
            function a(a) {
                var b, c, d, f;
                for (null == a && (a = {}), this.elements = [], null == a.selectors && (a.selectors = []), f = a.selectors, c = 0, d = f.length; d > c; c++)
                    b = f[c], this.elements.push(new e(b))
            }
            return a
        }(), e = function() {
            function a(a) {
                this.selector = a, this.progress = 0, this.check()
            }
            return a.prototype.check = function() {
                var a = this;
                return document.querySelector(this.selector) ? this.done() : setTimeout(function() {
                    return a.check()
                }, C.elements.checkInterval)
            }, a.prototype.done = function() {
                return this.progress = 100
            }, a
        }(), c = function() {
            function a() {
                var a, b, c = this;
                this.progress = null != (b = this.states[document.readyState]) ? b : 100, a = document.onreadystatechange, document.onreadystatechange = function() {
                    return null != c.states[document.readyState] && (c.progress = c.states[document.readyState]), "function" == typeof a ? a.apply(null, arguments) : void 0
                }
            }
            return a.prototype.states = {loading: 0, interactive: 50, complete: 100}, a
        }(), f = function() {
            function a() {
                var a, b, c, d, e, f = this;
                this.progress = 0, a = 0, e = [], d = 0, c = B(), b = setInterval(function() {
                    var g;
                    return g = B() - c - 50, c = B(), e.push(g), e.length > C.eventLag.sampleCount && e.shift(), a = p(e), ++d >= C.eventLag.minSamples && a < C.eventLag.lagThreshold ? (f.progress = 100, clearInterval(b)) : f.progress = 100 * (3 / (a + 3))
                }, 50)
            }
            return a
        }(), l = function() {
            function a(a) {
                this.source = a, this.last = this.sinceLastUpdate = 0, this.rate = C.initialRate, this.catchup = 0, this.progress = this.lastProgress = 0, null != this.source && (this.progress = E(this.source, "progress"))
            }
            return a.prototype.tick = function(a, b) {
                var c;
                return null == b && (b = E(this.source, "progress")), b >= 100 && (this.done = !0), b === this.last ? this.sinceLastUpdate += a : (this.sinceLastUpdate && (this.rate = (b - this.last) / this.sinceLastUpdate), this.catchup = (b - this.progress) / C.catchupTime, this.sinceLastUpdate = 0, this.last = b), b > this.progress && (this.progress += this.catchup * a), c = 1 - Math.pow(this.progress / 100, C.easeFactor), this.progress += c * this.rate * a, this.progress = Math.min(this.lastProgress + C.maxProgressPerFrame, this.progress), this.progress = Math.max(0, this.progress), this.progress = Math.min(100, this.progress), this.lastProgress = this.progress, this.progress
            }, a
        }(), J = null, G = null, q = null, K = null, o = null, r = null, Pace.running = !1, y = function() {
            return C.restartOnPushState ? Pace.restart() : void 0
        }, null != window.history.pushState && (R = window.history.pushState, window.history.pushState = function() {
            return y(), R.apply(window.history, arguments)
        }), null != window.history.replaceState && (U = window.history.replaceState, window.history.replaceState = function() {
            return y(), U.apply(window.history, arguments)
        }), k = {ajax: a, elements: d, document: c, eventLag: f}, (A = function() {
            var a, c, d, e, f, g, h, i;
            for (Pace.sources = J = [], g = ["ajax", "elements", "document", "eventLag"], c = 0, e = g.length; e > c; c++)
                a = g[c], C[a] !== !1 && J.push(new k[a](C[a]));
            for (i = null != (h = C.extraSources)?h:[], d = 0, f = i.length; f > d; d++)
                I = i[d], J.push(new I(C));
            return Pace.bar = q = new b, G = [], K = new l
        })(), Pace.stop = function() {
            return Pace.trigger("stop"), Pace.running = !1, q.destroy(), r = !0, null != o && ("function" == typeof s && s(o), o = null), A()
        }, Pace.restart = function() {
            return Pace.trigger("restart"), Pace.stop(), Pace.start()
        }, Pace.go = function() {
            return Pace.running = !0, q.render(), r = !1, o = F(function(a, b) {
                var c, d, e, f, g, h, i, j, k, m, n, o, p, s, t, u, v;
                for (j = 100 - q.progress, d = o = 0, e = !0, h = p = 0, t = J.length; t > p; h = ++p)
                    for (I = J[h], m = null != G[h]?G[h]:G[h] = [], g = null != (v = I.elements)?v:[I], i = s = 0, u = g.length; u > s; i = ++s)
                        f = g[i], k = null != m[i] ? m[i] : m[i] = new l(f), e &= k.done, k.done || (d++, o += k.tick(a));
                return c = o / d, q.update(K.tick(a, c)), n = B(), q.done() || e || r ? (q.update(100), Pace.trigger("done"), setTimeout(function() {
                    return q.finish(), Pace.running = !1, Pace.trigger("hide")
                }, Math.max(C.ghostTime, Math.min(C.minTime, B() - n)))) : b()
            })
        }, Pace.start = function(a) {
            u(C, a), Pace.running = !0;
            try {
                q.render()
            } catch (b) {
                i = b
            }
            return document.querySelector(".pace") ? (Pace.trigger("start"), Pace.go()) : setTimeout(Pace.start, 50)
        }, "function" == typeof define && define.amd ? define('theme-app', [], function() {
            return Pace
        }) : "object" == typeof exports ? module.exports = Pace : C.startOnPageLoad && Pace.start()
    }).call(this);
});

/* 
 * BOX REFRESH BUTTON 
 * ------------------
 * This is a custom plugin to use with the compenet BOX. It allows you to add
 * a refresh button to the box. It converts the box's state to a loading state.
 * 
 * USAGE:
 *  $("#box-widget").boxRefresh( options );
 * */
(function($) {
    "use strict";

    $.fn.boxRefresh = function(options) {

        // Render options
        var settings = $.extend({
            //Refressh button selector
            trigger: ".refresh-btn",
            //File source to be loaded (e.g: ajax/src.php)
            source: "",
            //Callbacks
            onLoadStart: function(box) {
            }, //Right after the button has been clicked
            onLoadDone: function(box) {
            } //When the source has been loaded

        }, options);

        //The overlay
        var overlay = $('<div class="overlay"></div><div class="loading-img"></div>');

        return this.each(function() {
            //if a source is specified
            if (settings.source === "") {
                if (console) {
                    console.log("Please specify a source first - boxRefresh()");
                }
                return;
            }
            //the box
            var box = $(this);
            //the button
            var rBtn = box.find(settings.trigger).first();

            //On trigger click
            rBtn.click(function(e) {
                e.preventDefault();
                //Add loading overlay
                start(box);

                //Perform ajax call
                box.find(".box-body").load(settings.source, function() {
                    done(box);
                });


            });

        });

        function start(box) {
            //Add overlay and loading img
            box.append(overlay);

            settings.onLoadStart.call(box);
        }

        function done(box) {
            //Remove overlay and loading img
            box.find(overlay).remove();

            settings.onLoadDone.call(box);
        }

    };

})(jQuery);

/*
 * SIDEBAR MENU
 * ------------
 * This is a custom plugin for the sidebar menu. It provides a tree view.
 * 
 * Usage:
 * $(".sidebar).tree();
 * 
 * Note: This plugin does not accept any options. Instead, it only requires a class
 *       added to the element that contains a sub-menu.
 *       
 * When used with the sidebar, for example, it would look something like this:
 * <ul class='sidebar-menu'>
 *      <li class="treeview active">
 *          <a href="#>Menu</a>
 *          <ul class='treeview-menu'>
 *              <li class='active'><a href=#>Level 1</a></li>
 *          </ul>
 *      </li>
 * </ul>
 * 
 * Add .active class to <li> elements if you want the menu to be open automatically
 * on page load. See above for an example.
 */
(function($) {
    "use strict";

    $.fn.tree = function() {

        return this.each(function() {
            var btn = $(this).children("a").first();
            var menu = $(this).children(".treeview-menu").first();
            var isActive = $(this).hasClass('active');

            //initialize already active menus
            if (isActive) {
                menu.show();
                btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
            }
            //Slide open or close the menu on link click
            btn.click(function(e) {
                e.preventDefault();
                if (isActive) {
                    //Slide up to close menu
                    menu.slideUp();
                    isActive = false;
                    btn.children(".fa-angle-down").first().removeClass("fa-angle-down").addClass("fa-angle-left");
                    btn.parent("li").removeClass("active");
                } else {
                    //Slide down to open menu
                    menu.slideDown();
                    isActive = true;
                    btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
                    btn.parent("li").addClass("active");
                }
            });

            /* Add margins to submenu elements to give it a tree look */
            menu.find("li > a").each(function() {
                var pad = parseInt($(this).css("margin-left")) + 10;

                $(this).css({"margin-left": pad + "px"});
            });

        });

    };


}(jQuery));

/*
 * TODO LIST CUSTOM PLUGIN
 * -----------------------
 * This plugin depends on iCheck plugin for checkbox and radio inputs
 */
(function($) {
    "use strict";

    $.fn.todolist = function(options) {
        // Render options
        var settings = $.extend({
            //When the user checks the input
            onCheck: function(ele) {
            },
            //When the user unchecks the input
            onUncheck: function(ele) {
            }
        }, options);

        return this.each(function() {
            $('input', this).on('ifChecked', function(event) {
                var ele = $(this).parents("li").first();
                ele.toggleClass("done");
                settings.onCheck.call(ele);
            });

            $('input', this).on('ifUnchecked', function(event) {
                var ele = $(this).parents("li").first();
                ele.toggleClass("done");
                settings.onUncheck.call(ele);
            });
        });
    };

}(jQuery));

/* CENTER ELEMENTS */
(function($) {
    "use strict";
    jQuery.fn.center = function(parent) {
        if (parent) {
            parent = this.parent();
        } else {
            parent = window;
        }
        this.css({
            "position": "absolute",
            "top": ((($(parent).height() - this.outerHeight()) / 2) + $(parent).scrollTop() + "px"),
            "left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
        });
        return this;
    }
}(jQuery));

/*
 * jQuery resize event - v1.1 - 3/14/2010
 * http://benalman.com/projects/jquery-resize-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($, h, c) {
    var a = $([]), e = $.resize = $.extend($.resize, {}), i, k = "setTimeout", j = "resize", d = j + "-special-event", b = "delay", f = "throttleWindow";
    e[b] = 250;
    e[f] = true;
    $.event.special[j] = {setup: function() {
            if (!e[f] && this[k]) {
                return false;
            }
            var l = $(this);
            a = a.add(l);
            $.data(this, d, {w: l.width(), h: l.height()});
            if (a.length === 1) {
                g();
            }
        }, teardown: function() {
            if (!e[f] && this[k]) {
                return false
            }
            var l = $(this);
            a = a.not(l);
            l.removeData(d);
            if (!a.length) {
                clearTimeout(i);
            }
        }, add: function(l) {
            if (!e[f] && this[k]) {
                return false
            }
            var n;
            function m(s, o, p) {
                var q = $(this), r = $.data(this, d);
                r.w = o !== c ? o : q.width();
                r.h = p !== c ? p : q.height();
                n.apply(this, arguments)
            }
            if ($.isFunction(l)) {
                n = l;
                return m
            } else {
                n = l.handler;
                l.handler = m
            }
        }};
    function g() {
        i = h[k](function() {
            a.each(function() {
                var n = $(this), m = n.width(), l = n.height(), o = $.data(this, d);
                if (m !== o.w || l !== o.h) {
                    n.trigger(j, [o.w = m, o.h = l])
                }
            });
            g()
        }, e[b])
    }}
)(jQuery, this);

/*!
 * SlimScroll https://github.com/rochal/jQuery-slimScroll
 * =======================================================
 * 
 * Copyright (c) 2011 Piotr Rochala (http://rocha.la) Dual licensed under the MIT 
 */
(function(f) {
    jQuery.fn.extend({slimScroll: function(h) {
            var a = f.extend({width: "auto", height: "250px", size: "7px", color: "#000", position: "right", distance: "1px", start: "top", opacity: 0.4, alwaysVisible: !1, disableFadeOut: !1, railVisible: !1, railColor: "#333", railOpacity: 0.2, railDraggable: !0, railClass: "slimScrollRail", barClass: "slimScrollBar", wrapperClass: "slimScrollDiv", allowPageScroll: !1, wheelStep: 20, touchScrollStep: 200, borderRadius: "0px", railBorderRadius: "0px"}, h);
            this.each(function() {
                function r(d) {
                    if (s) {
                        d = d ||
                                window.event;
                        var c = 0;
                        d.wheelDelta && (c = -d.wheelDelta / 120);
                        d.detail && (c = d.detail / 3);
                        f(d.target || d.srcTarget || d.srcElement).closest("." + a.wrapperClass).is(b.parent()) && m(c, !0);
                        d.preventDefault && !k && d.preventDefault();
                        k || (d.returnValue = !1)
                    }
                }
                function m(d, f, h) {
                    k = !1;
                    var e = d, g = b.outerHeight() - c.outerHeight();
                    f && (e = parseInt(c.css("top")) + d * parseInt(a.wheelStep) / 100 * c.outerHeight(), e = Math.min(Math.max(e, 0), g), e = 0 < d ? Math.ceil(e) : Math.floor(e), c.css({top: e + "px"}));
                    l = parseInt(c.css("top")) / (b.outerHeight() - c.outerHeight());
                    e = l * (b[0].scrollHeight - b.outerHeight());
                    h && (e = d, d = e / b[0].scrollHeight * b.outerHeight(), d = Math.min(Math.max(d, 0), g), c.css({top: d + "px"}));
                    b.scrollTop(e);
                    b.trigger("slimscrolling", ~~e);
                    v();
                    p()
                }
                function C() {
                    window.addEventListener ? (this.addEventListener("DOMMouseScroll", r, !1), this.addEventListener("mousewheel", r, !1), this.addEventListener("MozMousePixelScroll", r, !1)) : document.attachEvent("onmousewheel", r)
                }
                function w() {
                    u = Math.max(b.outerHeight() / b[0].scrollHeight * b.outerHeight(), D);
                    c.css({height: u + "px"});
                    var a = u == b.outerHeight() ? "none" : "block";
                    c.css({display: a})
                }
                function v() {
                    w();
                    clearTimeout(A);
                    l == ~~l ? (k = a.allowPageScroll, B != l && b.trigger("slimscroll", 0 == ~~l ? "top" : "bottom")) : k = !1;
                    B = l;
                    u >= b.outerHeight() ? k = !0 : (c.stop(!0, !0).fadeIn("fast"), a.railVisible && g.stop(!0, !0).fadeIn("fast"))
                }
                function p() {
                    a.alwaysVisible || (A = setTimeout(function() {
                        a.disableFadeOut && s || (x || y) || (c.fadeOut("slow"), g.fadeOut("slow"))
                    }, 1E3))
                }
                var s, x, y, A, z, u, l, B, D = 30, k = !1, b = f(this);
                if (b.parent().hasClass(a.wrapperClass)) {
                    var n = b.scrollTop(),
                            c = b.parent().find("." + a.barClass), g = b.parent().find("." + a.railClass);
                    w();
                    if (f.isPlainObject(h)) {
                        if ("height"in h && "auto" == h.height) {
                            b.parent().css("height", "auto");
                            b.css("height", "auto");
                            var q = b.parent().parent().height();
                            b.parent().css("height", q);
                            b.css("height", q)
                        }
                        if ("scrollTo"in h)
                            n = parseInt(a.scrollTo);
                        else if ("scrollBy"in h)
                            n += parseInt(a.scrollBy);
                        else if ("destroy"in h) {
                            c.remove();
                            g.remove();
                            b.unwrap();
                            return
                        }
                        m(n, !1, !0)
                    }
                } else {
                    a.height = "auto" == a.height ? b.parent().height() : a.height;
                    n = f("<div></div>").addClass(a.wrapperClass).css({position: "relative",
                        overflow: "hidden", width: a.width, height: a.height});
                    b.css({overflow: "hidden", width: a.width, height: a.height});
                    var g = f("<div></div>").addClass(a.railClass).css({width: a.size, height: "100%", position: "absolute", top: 0, display: a.alwaysVisible && a.railVisible ? "block" : "none", "border-radius": a.railBorderRadius, background: a.railColor, opacity: a.railOpacity, zIndex: 90}), c = f("<div></div>").addClass(a.barClass).css({background: a.color, width: a.size, position: "absolute", top: 0, opacity: a.opacity, display: a.alwaysVisible ?
                                "block" : "none", "border-radius": a.borderRadius, BorderRadius: a.borderRadius, MozBorderRadius: a.borderRadius, WebkitBorderRadius: a.borderRadius, zIndex: 99}), q = "right" == a.position ? {right: a.distance} : {left: a.distance};
                    g.css(q);
                    c.css(q);
                    b.wrap(n);
                    b.parent().append(c);
                    b.parent().append(g);
                    a.railDraggable && c.bind("mousedown", function(a) {
                        var b = f(document);
                        y = !0;
                        t = parseFloat(c.css("top"));
                        pageY = a.pageY;
                        b.bind("mousemove.slimscroll", function(a) {
                            currTop = t + a.pageY - pageY;
                            c.css("top", currTop);
                            m(0, c.position().top, !1)
                        });
                        b.bind("mouseup.slimscroll", function(a) {
                            y = !1;
                            p();
                            b.unbind(".slimscroll")
                        });
                        return!1
                    }).bind("selectstart.slimscroll", function(a) {
                        a.stopPropagation();
                        a.preventDefault();
                        return!1
                    });
                    g.hover(function() {
                        v()
                    }, function() {
                        p()
                    });
                    c.hover(function() {
                        x = !0
                    }, function() {
                        x = !1
                    });
                    b.hover(function() {
                        s = !0;
                        v();
                        p()
                    }, function() {
                        s = !1;
                        p()
                    });
                    b.bind("touchstart", function(a, b) {
                        a.originalEvent.touches.length && (z = a.originalEvent.touches[0].pageY)
                    });
                    b.bind("touchmove", function(b) {
                        k || b.originalEvent.preventDefault();
                        b.originalEvent.touches.length &&
                                (m((z - b.originalEvent.touches[0].pageY) / a.touchScrollStep, !0), z = b.originalEvent.touches[0].pageY)
                    });
                    w();
                    "bottom" === a.start ? (c.css({top: b.outerHeight() - c.outerHeight()}), m(0, !0)) : "top" !== a.start && (m(f(a.start).position().top, null, !0), a.alwaysVisible || c.hide());
                    C()
                }
            });
            return this
        }});
    jQuery.fn.extend({slimscroll: jQuery.fn.slimScroll})
})(jQuery);

/*! iCheck v1.0.1 by Damir Sultanov, http://git.io/arlzeA, MIT Licensed */
(function(h) {
    function F(a, b, d) {
        var c = a[0], e = /er/.test(d) ? m : /bl/.test(d) ? s : l, f = d == H ? {checked: c[l], disabled: c[s], indeterminate: "true" == a.attr(m) || "false" == a.attr(w)} : c[e];
        if (/^(ch|di|in)/.test(d) && !f)
            D(a, e);
        else if (/^(un|en|de)/.test(d) && f)
            t(a, e);
        else if (d == H)
            for (e in f)
                f[e] ? D(a, e, !0) : t(a, e, !0);
        else if (!b || "toggle" == d) {
            if (!b)
                a[p]("ifClicked");
            f ? c[n] !== u && t(a, e) : D(a, e)
        }
    }
    function D(a, b, d) {
        var c = a[0], e = a.parent(), f = b == l, A = b == m, B = b == s, K = A ? w : f ? E : "enabled", p = k(a, K + x(c[n])), N = k(a, b + x(c[n]));
        if (!0 !== c[b]) {
            if (!d &&
                    b == l && c[n] == u && c.name) {
                var C = a.closest("form"), r = 'input[name="' + c.name + '"]', r = C.length ? C.find(r) : h(r);
                r.each(function() {
                    this !== c && h(this).data(q) && t(h(this), b)
                })
            }
            A ? (c[b] = !0, c[l] && t(a, l, "force")) : (d || (c[b] = !0), f && c[m] && t(a, m, !1));
            L(a, f, b, d)
        }
        c[s] && k(a, y, !0) && e.find("." + I).css(y, "default");
        e[v](N || k(a, b) || "");
        B ? e.attr("aria-disabled", "true") : e.attr("aria-checked", A ? "mixed" : "true");
        e[z](p || k(a, K) || "")
    }
    function t(a, b, d) {
        var c = a[0], e = a.parent(), f = b == l, h = b == m, q = b == s, p = h ? w : f ? E : "enabled", t = k(a, p + x(c[n])),
                u = k(a, b + x(c[n]));
        if (!1 !== c[b]) {
            if (h || !d || "force" == d)
                c[b] = !1;
            L(a, f, p, d)
        }
        !c[s] && k(a, y, !0) && e.find("." + I).css(y, "pointer");
        e[z](u || k(a, b) || "");
        q ? e.attr("aria-disabled", "false") : e.attr("aria-checked", "false");
        e[v](t || k(a, p) || "")
    }
    function M(a, b) {
        if (a.data(q)) {
            a.parent().html(a.attr("style", a.data(q).s || ""));
            if (b)
                a[p](b);
            a.off(".i").unwrap();
            h(G + '[for="' + a[0].id + '"]').add(a.closest(G)).off(".i")
        }
    }
    function k(a, b, d) {
        if (a.data(q))
            return a.data(q).o[b + (d ? "" : "Class")]
    }
    function x(a) {
        return a.charAt(0).toUpperCase() +
                a.slice(1)
    }
    function L(a, b, d, c) {
        if (!c) {
            if (b)
                a[p]("ifToggled");
            a[p]("ifChanged")[p]("if" + x(d))
        }
    }
    var q = "iCheck", I = q + "-helper", u = "radio", l = "checked", E = "un" + l, s = "disabled", w = "determinate", m = "in" + w, H = "update", n = "type", v = "addClass", z = "removeClass", p = "trigger", G = "label", y = "cursor", J = /ipad|iphone|ipod|android|blackberry|windows phone|opera mini|silk/i.test(navigator.userAgent);
    h.fn[q] = function(a, b) {
        var d = 'input[type="checkbox"], input[type="' + u + '"]', c = h(), e = function(a) {
            a.each(function() {
                var a = h(this);
                c = a.is(d) ?
                        c.add(a) : c.add(a.find(d))
            })
        };
        if (/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(a))
            return a = a.toLowerCase(), e(this), c.each(function() {
                var c = h(this);
                "destroy" == a ? M(c, "ifDestroyed") : F(c, !0, a);
                h.isFunction(b) && b()
            });
        if ("object" != typeof a && a)
            return this;
        var f = h.extend({checkedClass: l, disabledClass: s, indeterminateClass: m, labelHover: !0, aria: !1}, a), k = f.handle, B = f.hoverClass || "hover", x = f.focusClass || "focus", w = f.activeClass || "active", y = !!f.labelHover, C = f.labelHoverClass ||
                "hover", r = ("" + f.increaseArea).replace("%", "") | 0;
        if ("checkbox" == k || k == u)
            d = 'input[type="' + k + '"]';
        -50 > r && (r = -50);
        e(this);
        return c.each(function() {
            var a = h(this);
            M(a);
            var c = this, b = c.id, e = -r + "%", d = 100 + 2 * r + "%", d = {position: "absolute", top: e, left: e, display: "block", width: d, height: d, margin: 0, padding: 0, background: "#fff", border: 0, opacity: 0}, e = J ? {position: "absolute", visibility: "hidden"} : r ? d : {position: "absolute", opacity: 0}, k = "checkbox" == c[n] ? f.checkboxClass || "icheckbox" : f.radioClass || "i" + u, m = h(G + '[for="' + b + '"]').add(a.closest(G)),
                    A = !!f.aria, E = q + "-" + Math.random().toString(36).replace("0.", ""), g = '<div class="' + k + '" ' + (A ? 'role="' + c[n] + '" ' : "");
            m.length && A && m.each(function() {
                g += 'aria-labelledby="';
                this.id ? g += this.id : (this.id = E, g += E);
                g += '"'
            });
            g = a.wrap(g + "/>")[p]("ifCreated").parent().append(f.insert);
            d = h('<ins class="' + I + '"/>').css(d).appendTo(g);
            a.data(q, {o: f, s: a.attr("style")}).css(e);
            f.inheritClass && g[v](c.className || "");
            f.inheritID && b && g.attr("id", q + "-" + b);
            "static" == g.css("position") && g.css("position", "relative");
            F(a, !0, H);
            if (m.length)
                m.on("click.i mouseover.i mouseout.i touchbegin.i touchend.i", function(b) {
                    var d = b[n], e = h(this);
                    if (!c[s]) {
                        if ("click" == d) {
                            if (h(b.target).is("a"))
                                return;
                            F(a, !1, !0)
                        } else
                            y && (/ut|nd/.test(d) ? (g[z](B), e[z](C)) : (g[v](B), e[v](C)));
                        if (J)
                            b.stopPropagation();
                        else
                            return!1
                    }
                });
            a.on("click.i focus.i blur.i keyup.i keydown.i keypress.i", function(b) {
                var d = b[n];
                b = b.keyCode;
                if ("click" == d)
                    return!1;
                if ("keydown" == d && 32 == b)
                    return c[n] == u && c[l] || (c[l] ? t(a, l) : D(a, l)), !1;
                if ("keyup" == d && c[n] == u)
                    !c[l] && D(a, l);
                else if (/us|ur/.test(d))
                    g["blur" ==
                            d ? z : v](x)
            });
            d.on("click mousedown mouseup mouseover mouseout touchbegin.i touchend.i", function(b) {
                var d = b[n], e = /wn|up/.test(d) ? w : B;
                if (!c[s]) {
                    if ("click" == d)
                        F(a, !1, !0);
                    else {
                        if (/wn|er|in/.test(d))
                            g[v](e);
                        else
                            g[z](e + " " + w);
                        if (m.length && y && e == B)
                            m[/ut|nd/.test(d) ? z : v](C)
                    }
                    if (J)
                        b.stopPropagation();
                    else
                        return!1
                }
            })
        })
    }
})(window.jQuery || window.Zepto);