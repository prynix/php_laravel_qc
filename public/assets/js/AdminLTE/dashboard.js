/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function() {
    "use strict"; 
    var hostname,url_path;
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }    
    var how;
    $('.modal').on('shown.bs.modal',function(){ 
        how=$('input[name="how-to-submit"]').val();
        $('input[name="how-to-submit"]').change(function(){
            how=$(this).val();
            if(how==1){
                $('div.email_to,div.email_cc,div.email_bcc').css('display','block');
                $('div.list_mail').css('display','none');
            }else if(how==2){
                $('div.email_to,div.email_cc,div.email_bcc').css('display','none');
                $('div.list_mail').css('display','block');
            }
        });
    });
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
	if(window.location.hostname=='localhost'){
      hostname="http://localhost/qc/public/";
      url_path=window.location.pathname.split("/")[4];
    }else if(window.location.hostname=='lqc.tintuc.vn'){
      hostname="http://lqc.tintuc.vn/";
      url_path=window.location.pathname.split("/")[2];
    }else if(window.location.hostname=='sqc.tintuc.vn'){
      hostname="http://sqc.tintuc.vn/";
      url_path=window.location.pathname.split("/")[2];
    }else{
      hostname="http://qc.tintuc.vn/";
      url_path=window.location.pathname.split("/")[2];
    }
    $(".no-reload").click(function(){
        //window.history.replaceState({},window.location.hostname,'/l4-bbad/public/admin/'+$(this).attr("href"));
        //return false;
    });
    $("#btn-logout").confirmOn('click',function(e,confirmed){
        if(confirmed){//Click yes
            window.location.href=hostname+"admin/logout";
        }else{

        }
    });
    var url_size=url_path.split('-')[0]+'-'+url_path.split('-')[1];
    if(url_size=='zone-create'||url_size=='banner-create'){
        $('input[name="width"]').attr('disabled','disabled');
        $('input[name="height"]').attr('disabled','disabled');
    }
    $('a#account-1').click(function(){
        $('h3.box-title').text('Name & Language');
    });
    $('a#account-2').click(function(){
        $('h3.box-title').text('Change E-mail');
    });
    $('a#account-3').click(function(){
        $('h3.box-title').text('Change Password');
    });
    $('#horizontalTab').responsiveTabs({
                rotate: false,
                startCollapsed: 'accordion',
                collapsible: 'accordion',
                setHash: true,
                /*disabled: [3,4],*/
                activate: function(e, tab) {
                    //$('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
                },
                activateState: function(e, state) {
                    //console.log(state);
                    //$('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
                }
            });
    var permission=window.location.pathname.split("/")[1];
    if(permission=='advertiser'){
        $("#stats_top").css('display','none');
    }
	// chỗ này cần phải xem lại vì chạy trên server bị báo lỗi
	switch (url_path.split('-')[0]) {
    // Receive request
    case 'receive_request':
        $('ul.sidebar-menu li#request').addClass('menuitem_active');
        break;
    // Receive request
    case 'order_ad':
        $('ul.sidebar-menu li#order').addClass('menuitem_active');
        break;
	// Advertiser
	case "advertiser":
		$('ul.sidebar-menu li#advertiser').addClass('menuitem_active');
		break;
	// Campaign
	case "campaign":
		$('ul.sidebar-menu li#campaign').addClass('menuitem_active');
		break;
	// Banner
	case "banner":
		$('ul.sidebar-menu li#banner').addClass('menuitem_active');
		break;
    // Demo zone
    case "demo": 
        $('ul.sidebar-menu li#demo_zone').addClass('menuitem_active');
        break;
	// CCount
	case "ccount":
		$('ul.sidebar-menu li#ccount').addClass('menuitem_active');
		break;
	//
	case "cview":
		$('ul.sidebar-menu li#cview').addClass('menuitem_active');
		break;
	// Website
	case "website":
		$('ul.sidebar-menu li#website').addClass('menuitem_active');
		break;
	// Zone
	case "zone":
		$('ul.sidebar-menu li#zone').addClass('menuitem_active');
		break;
	// Channel
	case "channel":
		$('ul.sidebar-menu li#channel').addClass('menuitem_active');
		break;
	// Statistic
	case "statistic":
		$('ul.sidebar-menu li#statistic').addClass('menuitem_active');
		break;
	case "history":
		$('ul.sidebar-menu li#history').addClass('menuitem_active');
		break;
	case "stats":
		$('ul.sidebar-menu li#stats').addClass('menuitem_active');
		break;
	// User
	case "user":
		$('ul.sidebar-menu li#user').addClass('menuitem_active');
		break;
	case "account":
		$('ul.sidebar-menu li#user').addClass('menuitem_active');
		break;
	// Usergroup
	case "usergroup":
		$('ul.sidebar-menu li#usergroup').addClass('menuitem_active');
		break;
    // Email Marketing
    case "email":
        $('ul.sidebar-menu li#email_marketing').addClass('menuitem_active');
        break;
    //RSS Feed
    case "rss":
        $('ul.sidebar-menu li#rss').addClass('menuitem_active');
        //$('.left-side').addClass('collapse-left');
    	//$('.right-side').addClass('strech');
    	$('.skin-blue .left-side').css('background-color','#f4f4f4');
    	$('div.user-panel').css('background-color','transparent');
    	$('div.user-panel > .info >p').css('color','#555555');
    	$('a').css('color','#0000ee');
    	$('ul.sidebar-menu').html('');
    	$('ul.sidebar-menu').append('<li id="feed"><a href="rss-feed" class="no-reload"><img src="../assets/img/icon/rss-20.png" alt="" width="16px" />&nbsp;<span>RSS Feed</span></a></li><li id="topic"><a href="rss-topic" class="no-reload"><img src="../assets/img/icon/topic.png" alt="" width="16px" />&nbsp;<span>List of topics</span></a></li><li id="partner"><a href="rss-partner" class="no-reload"><img src="../assets/img/icon/partner.png" alt="" width="16px" />&nbsp;<span>Partners</span></a></li><li id="click_stats"><a href="click-stats" class="no-reload"><img src="../assets/img/icon/utilities-statistics.png" alt="" width="16px" />&nbsp;<span>Click stats</span></a></li>');
    	
        $('.logo').css('background-color','#fcc113');
        $('nav.navbar').css('background-color','#f39c12');
        break;
	// configs
	case "adtype":
		$('ul.sidebar-menu li#configs').addClass('menuitem_active');
		break;
	case "zonetype":
		$('ul.sidebar-menu li#configs').addClass('menuitem_active');
		break;
	case "category":
		$('ul.sidebar-menu li#configs').addClass('menuitem_active');
		break;
	case "country":
		$('ul.sidebar-menu li#configs').addClass('menuitem_active');
		break;
	case "language":
		$('ul.sidebar-menu li#configs').addClass('menuitem_active');
		break;
	// userlog
	case "userlog":
		$('ul.sidebar-menu li#extras').addClass('menuitem_active');
		break;
	case "help":
		$('ul.sidebar-menu li#extras').addClass('menuitem_active');
		break;
    case "file":
        $('ul.sidebar-menu li#extras').addClass('menuitem_active');
        break;
	// backups
	case "backup_database":
		$('ul.sidebar-menu li#tools').addClass('menuitem_active');
		break;
    case "backup_files":
        $('ul.sidebar-menu li#tools').addClass('menuitem_active');
        break;
	// system
	case "system_info":
		$('ul.sidebar-menu li#system').addClass('menuitem_active');
		break;
	case "backup_info":
		$('ul.sidebar-menu li#system').addClass('menuitem_active');
		break;
	case "database_info":
		$('ul.sidebar-menu li#system').addClass('menuitem_active');
		break;
	// dashboard
	default:
		$('ul.sidebar-menu li#dashboard').addClass('menuitem_active');
		break;
	}
    var storagetype=$('select[name="storagetype"]').val();
    if(storagetype=='url'){
            $('#imageurl').css('display','block');
            $('#filename').css('display','none');
            $('div#htmltemplate').css('display','none');
        }else if(storagetype=='web'||storagetype=='sql'){
            $('#imageurl').css('display','none');
            $('#filename').css('display','block');
            $('div#htmltemplate').css('display','none');
        }else if(storagetype=='html'){
            $('div#htmltemplate').css('display','block');
            $('div#imageurl').css('display','none');
            $('div#filename').css('display','none');
            $('div#alt').css('display','none');
            $('div#statustext').css('display','none');
            $('div#bannertext').css('display','none');
        }
    $("#storagetype").change(function(){
        var storagetype=$('select[name="storagetype"]').val(); 
        if(storagetype=='url'){
            $('#imageurl').css('display','block');
            $('#filename').css('display','none');
            $('div#htmltemplate').css('display','none');
        }else if(storagetype=='web'||storagetype=='sql'){
            $('#imageurl').css('display','none');
            $('#filename').css('display','block');
            $('div#htmltemplate').css('display','none');
        }else if(storagetype=='html'){
            $('div#htmltemplate').css('display','block');
            $('div#imageurl').css('display','none');
            $('div#filename').css('display','none');
            $('div#alt').css('display','none');
            $('div#statustext').css('display','none');
            $('div#bannertext').css('display','none');
        }
    });
    var clientid=$('select[name="clientid"]').val(); 
    var id=window.location.href.substr(window.location.href.lastIndexOf('/')+1).split('-')[2];
    $('#advertiser_ad').val(id);
    $('#advertiserid').val(id);
    if(window.location.href.substr(window.location.href.lastIndexOf('/')+1)=='campaign'){
        $('a#addNewCampaign').css('display','none');
        $('a#campaignRecycle').css('margin-left','0');
        $('select#clientid').change(function(){ 
            window.location.href=hostname+"admin/campaign-advertiser-"+$(this).val();
        });
    }
    if(window.location.href.substr(window.location.href.lastIndexOf('/')+1)=='website'){
        $('a#addNewWebsite').css('display','none');
        $('a#websiteRecycle').css('margin-left','0');
        $('select#campaignid').change(function(){
        	var campaignid=$(this).val();
        	$('a#addNewWebsite').css('display','inline-block');
        	$('a#websiteRecycle').css('display','inline-block');
        	$('a#addNewWebsite').attr('href','website-create-'+campaignid);
        });
    }
    if(window.location.href.substr(window.location.href.lastIndexOf('/')+1)=='zone'){
        $('a#addNewZone').css('display','none');
        $('a#zoneRecycle').css('margin-left','0');
    }
    if(window.location.href.substr(window.location.href.lastIndexOf('/')+1)=='banner'){
        $('a#addNewBanner').css('display','none');
        $('a#bannerRecycle').css('margin-left','0');
    }
    if(window.location.href.substr(window.location.href.lastIndexOf('/')+1)=='channel'){
        $('a#addNewChannel').css('display','none');
        $('a#channelRecycle').css('margin-left','0');
    }
    if(id!=''||id!='undefined'){
        $('select#clientid').val(id);
        $('select#website_id').val(id);
        $('select#campaignid').val(id);
        $('a#addNewCampaign').attr('href','campaign-create-'+id);
        $('a#addNewZone').attr('href','zone-create-'+id);
        
        $('a#addNewChannel').attr('href','channel-create-'+id);
    }else{
        
    }
    $('select#clientid').change(function(){ 
        window.location.href=hostname+"admin/campaign-advertiser-"+$(this).val();
    });
    $('select#campaignid').change(function(){ 
        $('.simple-loader').css('display','block').fadeOut('slow');
        window.location.href=hostname+"admin/website-of_campaign-"+$(this).val();
        $.ajax({
            type:'GET',
            url:hostname+"admin/client-of_campaign-"+$(this).val(),
            success:function(data){ 
                //alert("Successfully !");
           		$('select#clientid').val(data);
            },
            error:function(jqXHR,textStatus,errorThrown){ //alert(JSON.stringify(errorThrown));
                //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }
        });
    });
    var uri_segment=window.location.href.substr(window.location.href.lastIndexOf('/')+1);
    if(uri_segment.split('-')[0]+'-'+uri_segment.split('-')[1]=='campaign-advertiser'||uri_segment.split('-')[0]+'-'+uri_segment.split('-')[1]=='website-of_campaign'||uri_segment.split('-')[0]+'-'+uri_segment.split('-')[1]=='zone-website'||uri_segment.split('-')[0]+'-'+uri_segment.split('-')[1]=='banner-of_website_zone'||uri_segment.split('-')[0]+'-'+uri_segment.split('-')[1]=='channel-website'){
        $('a#moveTop, a#moveUp, a#moveDown, a#moveBottom').removeAttr('href');
        $('a#moveTop, a#moveUp, a#moveDown, a#moveBottom').css({'opacity':'0.4','cursor':'default'});
    }
    if(uri_segment.split('-')[0]+'-'+uri_segment.split('-')[1]=='banner-of_website_zone'){
        $('a#addNewBanner').attr('href','banner-create-'+uri_segment.split('-')[2]+'-'+uri_segment.split('-')[3]);
    }
    if(uri_segment.split('-')[0]+'-'+uri_segment.split('-')[1]=='website-of_campaign'){
        $('a#addNewWebsite').attr('href','website-create-'+uri_segment.split('-')[2]);
    }
    if(uri_segment.split('-')[0]=='banner'){
        $('select#zoneid').val(uri_segment.split('-')[3]);
        $('select#zoneid').change(function(){
            $('a#addNewBanner').css('display','inline-block');
            $('a#bannerRecycle').css('display','inline-block');
            $('.simple-loader').css('display','block').fadeOut('slow');
            $.ajax({
                    type:'GET',
                    url:hostname+"admin/zone-of_website-"+$(this).val(),
                    success:function(data){ 
                        data=data.split(' ');
                        var temp='';
                        for(var i=0;i<data.length;i++){
                            temp+=data[i];
                        }
                        //alert("Successfully !");
                        window.location.href=hostname+"admin/banner-of_website_zone-"+temp+'-'+$('select#zoneid').val();
                    },
                    error:function(jqXHR,textStatus,errorThrown){ //alert(JSON.stringify(errorThrown));
                        //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                    }
            });
        });
    }
    $('select#website_id').change(function(){ 
        if(window.location.href.substr(window.location.href.lastIndexOf('/')+1).split('-')[0]=='zone'){
            window.location.href=hostname+"admin/zone-website-"+$(this).val();
        }else if(window.location.href.substr(window.location.href.lastIndexOf('/')+1).split('-')[0]=='channel'){
            window.location.href=hostname+"admin/channel-website-"+$(this).val();
        }
        if(window.location.href.substr(window.location.href.lastIndexOf('/')+1).split('-')[1]=='zone'){
            window.location.href=hostname+"admin/zone-website-"+$(this).val();
        }else if(window.location.href.substr(window.location.href.lastIndexOf('/')+1).split('-')[1]=='channel'){
            window.location.href=hostname+"admin/channel-website-"+$(this).val();
        }
    });
    //var foundin=$('*:contains(RSS Feed)'); foundin.css('color','#ff0000');
 
    $('.modal').on('shown.bs.modal',function(){ 
    $('input[name="selection"]').val(1);
    $('input[name="how-to-submit"]').change(function(){
        $('input[name="selection"]').val($(this).val());
    });
    $('#check-email_exists').click(function(){
        $.ajax({
            type:'GET',
            url:hostname+"admin/check-email_exists",
            success:function(data){
                $('select[name="advertiser_mail"]').hide();
                $('div.mails').css({'max-height':'200px','overflow-y':'scroll'}).html(data);
                window.stop();
            },
            error:function(jqXHR,textStatus,errorThrown){ 
                alert("You can not send Cross Domain AJAX requests: "+errorThrown);
                window.stop();
            }  
        });
    });
        $('input[name="imagefile"]').change(function(){
            var image_name=$(this).val();
            $('input[name="image_name"]').val(image_name);
        });
        $(".expire_date").datetimepicker({
            timepicker:false,
            format:'Y-m-d',
            formatDate:'Y-m-d'
        }); 
        $('div.vertical_display').show();
        $('div.horizontal_display').hide();
        $('img#ads_link_style').css('opacity','0.4');
        $('img#horizontal_style').css('opacity','0.4');
        $('img#vertical_style').css('opacity','1');
        $('div.box-display').css('overflow-x','hidden');
        $('img#vertical_style').click(function(){
            $('div.vertical_display').show();
            $('div.horizontal_display').hide();
            $('img#ads_link_style').css('opacity','0.4');
            $('img#horizontal_style').css('opacity','0.4');
            $('img#vertical_style').css('opacity','1');
            $('div.box-display').css('overflow-x','hidden');
        });
        $('img#horizontal_style').click(function(){
            $('div.vertical_display').hide();
            $('div.horizontal_display').show();
            $('img#ads_link_style').css('opacity','0.4');
            $('img#horizontal_style').css('opacity','1');
            $('img#vertical_style').css('opacity','0.4');
            $('div.box-display').css('overflow-x','scroll');
        });
        $('img#ads_link_style').click(function(){
            $('div.vertical_display').hide();
            $('div.horizontal_display').hide();
            $('div.ads_link_display').show();
            $('img#ads_link_style').css('opacity','1');
            $('img#horizontal_style').css('opacity','0.4');
            $('img#vertical_style').css('opacity','0.4');
            $('div.box-display').css('overflow-x','scroll');
        });
        $('select[name="number_ads"]').change(function(){
            var displayVertical="", displayHorizontal="", displayAdsLink="";
            var i;
            for(i=1;i<=$(this).val();i++){
                displayVertical+='<li style="float:left;height:138px;padding:5px;border-bottom:1px dashed #ccc;"><a href="" target="_blank" style="float:left;"><img src="../assets/img/icon/picture.png" alt="iLink"/></a><p style="margin-left:133px;margin-top:20px;"><a href="" title="" target="_blank">iLink: Trao đổi traffic. Đặt quảng cáo ở đây.</a> </p></li>';
                displayHorizontal+='<li style="float:left;width:290px;padding:5px;border-bottom:1px dashed #ccc;border-top:1px dashed #ccc;border-right:1px dashed #ccc;border-left:1px dashed #ccc;"><a href="" target="_blank" style="float:left;"><img src="../assets/img/icon/picture.png" alt="iLink"/></a><p style="margin-left:133px;margin-top:20px;"><a href="" title="" target="_blank">iLink: Trao đổi traffic. Đặt quảng cáo ở đây.</a></p></li>';
                displayAdsLink+='<li style="float:left;width:100%;padding:1% 0;"><p><img src="../assets/img/icon/link.png" alt="iLink"/>&nbsp;<a href="" title="" target="_blank">iLink: Traffic exchange. Put advertisement here.</a></p></li>';
            }
            //$('div.vertical_display ul').css("height",148*i-148+"px");
            $('div.vertical_display ul').html(displayVertical);
            $('div.horizontal_display ul').css("width",290*i-290+"px");
            $('div.horizontal_display ul').html(displayHorizontal);
            $('div.ads_link_display ul').html(displayAdsLink);
        });
    });
    $('#example1').dataTable({
        "aaSorting":[[0,'asc']]
    });
    $('#example2').dataTable({
        "aaSorting":[[0,'desc']],
        'iDisplayLength':50
    });
    $('#example3').dataTable({
        "aaSorting":[[0,'asc']],
        'iDisplayLength':100
    });
    $('#example4').dataTable({
        "aaSorting":[[2,'asc']]
    });
    $('#example5').dataTable({
        "aaSorting":[[3,'asc']]
    }); 
    $('#example6').dataTable({
        "aaSorting":[[0,'desc']]
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"], input[type="radio"]').on('ifChanged',function(){
       if($(this).is(':checked')){ 
                    $('input[name="icp_name"]').removeAttr('disabled');
                }else{ 
                    $('input[name="icp_name"]').attr('disabled','disabled');
                    $('input[name="icp_name"]').val('');
                }        
    });
    $('input[type="checkbox"].width_by_percent, input[type="radio"].width_by_percent').change(function(){
        if($(this).is(':checked')){ 
            $('input[name="width"]').attr('disabled','disabled');
            if(url_size=='zone-copy'||url_size=='banner-copy'||url_size=='zone-edit'||url_size=='banner-edit'){
                $('input[name="width"]').val('');
            }else{
                $('input[name="width"]').val('');
            }
        }else{ 
            $('input[name="width"]').removeAttr('disabled');
            if(url_size=='zone-copy'||url_size=='banner-copy'||url_size=='zone-edit'||url_size=='banner-edit'){
                $('.simple-loader').css('display','block').fadeOut('slow');
                location.reload();
            }else{
                $('input[name="width"]').val('0');
            }
        }      
    });
    $('input[type="checkbox"].height_by_percent, input[type="radio"].height_by_percent').change(function(){
        if($(this).is(':checked')){ 
            $('input[name="height"]').attr('disabled','disabled');
            if(url_size=='zone-copy'||url_size=='banner-copy'||url_size=='zone-edit'||url_size=='banner-edit'){
                $('input[name="height"]').val('');
            }else{
                $('input[name="height"]').val('');
            }
        }else{ 
            $('input[name="height"]').removeAttr('disabled');
            if(url_size=='zone-copy'||url_size=='banner-copy'||url_size=='zone-edit'||url_size=='banner-edit'){
                $('.simple-loader').css('display','block').fadeOut('slow');
                location.reload();
            }else{
                $('input[name="height"]').val('0');
            }
        }      
    });
    /*$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-red',
        radioClass: 'iradio_flat-red'
    });*/
    
    /////////////////////////////////////////////////////
    //Make the dashboard widgets sortable Using jquery UI
    /*$(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();*/
    $(".box-header, .nav-tabs").css("cursor","move");
    //jQuery UI sortable for the todo list
    /*$(".todo-list").sortable({
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();*/

    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();

    $('.daterange').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                startDate: moment().subtract('days', 29),
                endDate: moment()
            },
    function(start, end) {
        alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });

    /* jQueryKnob */
    $(".knob").knob();

    //jvectormap data
    var visitorsData = {
        "US": 398, //USA
        "SA": 400, //Saudi Arabia
        "CA": 1000, //Canada
        "DE": 500, //Germany
        "FR": 760, //France
        "CN": 300, //China
        "AU": 700, //Australia
        "BR": 600, //Brazil
        "IN": 800, //India
        "GB": 320, //Great Britain
        "RU": 3000 //Russia
    };
    //World map by jvectormap
    $('#world-map').vectorMap({
        map: 'world_mill_en',
        backgroundColor: "#fff",
        regionStyle: {
            initial: {
                fill: '#e4e4e4',
                "fill-opacity": 1,
                stroke: 'none',
                "stroke-width": 0,
                "stroke-opacity": 1
            }
        },
        series: {
            regions: [{
                    values: visitorsData,
                    scale: ["#3c8dbc", "#2D79A6"], //['#3E5E6B', '#A6BAC2'],
                    normalizeFunction: 'polynomial'
                }]
        },
        onRegionLabelShow: function(e, el, code) {
            if (typeof visitorsData[code] != "undefined")
                el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
        }
    });

    //Sparkline charts
    var myvalues = [15, 19, 20, -22, -33, 27, 31, 27, 19, 30, 21];
    $('#sparkline-1').sparkline(myvalues, {
        type: 'bar',
        barColor: '#00a65a',
        negBarColor: "#f56954",
        height: '20px'
    });
    myvalues = [15, 19, 20, 22, -2, -10, -7, 27, 19, 30, 21];
    $('#sparkline-2').sparkline(myvalues, {
        type: 'bar',
        barColor: '#00a65a',
        negBarColor: "#f56954",
        height: '20px'
    });
    myvalues = [15, -19, -20, 22, 33, 27, 31, 27, 19, 30, 21];
    $('#sparkline-3').sparkline(myvalues, {
        type: 'bar',
        barColor: '#00a65a',
        negBarColor: "#f56954",
        height: '20px'
    });
    myvalues = [15, 19, 20, 22, 33, -27, -31, 27, 19, 30, 21];
    $('#sparkline-4').sparkline(myvalues, {
        type: 'bar',
        barColor: '#00a65a',
        negBarColor: "#f56954",
        height: '20px'
    });
    myvalues = [15, 19, 20, 22, 33, 27, 31, -27, -19, 30, 21];
    $('#sparkline-5').sparkline(myvalues, {
        type: 'bar',
        barColor: '#00a65a',
        negBarColor: "#f56954",
        height: '20px'
    });
    myvalues = [15, 19, -20, 22, -13, 27, 31, 27, 19, 30, 21];
    $('#sparkline-6').sparkline(myvalues, {
        type: 'bar',
        barColor: '#00a65a',
        negBarColor: "#f56954",
        height: '20px'
    });

    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();

    //Calendar
    $('#calendar').fullCalendar({
        editable: true, //Enable drag and drop
        events: [
            {
                title: 'All Day Event',
                start: new Date(y, m, 1),
                backgroundColor: "#3c8dbc", //light-blue 
                borderColor: "#3c8dbc" //light-blue
            },
            {
                title: 'Long Event',
                start: new Date(y, m, d - 5),
                end: new Date(y, m, d - 2),
                backgroundColor: "#f39c12", //yellow
                borderColor: "#f39c12" //yellow
            },
            {
                title: 'Meeting',
                start: new Date(y, m, d, 10, 30),
                allDay: false,
                backgroundColor: "#0073b7", //Blue
                borderColor: "#0073b7" //Blue
            },
            {
                title: 'Lunch',
                start: new Date(y, m, d, 12, 0),
                end: new Date(y, m, d, 14, 0),
                allDay: false,
                backgroundColor: "#00c0ef", //Info (aqua)
                borderColor: "#00c0ef" //Info (aqua)
            },
            {
                title: 'Birthday Party',
                start: new Date(y, m, d + 1, 19, 0),
                end: new Date(y, m, d + 1, 22, 30),
                allDay: false,
                backgroundColor: "#00a65a", //Success (green)
                borderColor: "#00a65a" //Success (green)
            },
            {
                title: 'Click for Google',
                start: new Date(y, m, 28),
                end: new Date(y, m, 29),
                url: 'http://google.com/',
                backgroundColor: "#f56954", //red
                borderColor: "#f56954" //red
            }
        ],
        buttonText: {//This is to add icons to the visible buttons
            prev: "<span class='fa fa-caret-left'></span>",
            next: "<span class='fa fa-caret-right'></span>",
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
        },
        header: {
            left: 'title',
            center: '',
            right: 'prev,next'
        }
    });

    //SLIMSCROLL FOR CHAT WIDGET
    $('#chat-box').slimScroll({
        height: '250px'
    });

    /* Morris.js Charts */
    // Sales chart
    /*var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        data: [
            {y: '2011 Q1', item1: 2666, item2: 2666},
            {y: '2011 Q2', item1: 2778, item2: 2294},
            {y: '2011 Q3', item1: 4912, item2: 1969},
            {y: '2011 Q4', item1: 3767, item2: 3597},
            {y: '2012 Q1', item1: 6810, item2: 1914},
            {y: '2012 Q2', item1: 5670, item2: 4293},
            {y: '2012 Q3', item1: 4820, item2: 3795},
            {y: '2012 Q4', item1: 15073, item2: 5967},
            {y: '2013 Q1', item1: 10687, item2: 4460},
            {y: '2013 Q2', item1: 8432, item2: 5713}
        ],
        xkey: 'y',
        ykeys: ['item1', 'item2'],
        labels: ['Item 1', 'Item 2'],
        lineColors: ['#a0d0e0', '#3c8dbc'],
        hideHover: 'auto'
    });
    //Donut Chart
    var donut = new Morris.Donut({
        element: 'sales-chart',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a"],
        data: [
            {label: "Download Sales", value: 12},
            {label: "In-Store Sales", value: 30},
            {label: "Mail-Order Sales", value: 20}
        ],
        hideHover: 'auto'
    });
    //Bar chart
    var bar = new Morris.Bar({
        element: 'bar-chart',
        resize: true,
        data: [
            {y: '2006', a: 100, b: 90},
            {y: '2007', a: 75, b: 65},
            {y: '2008', a: 50, b: 40},
            {y: '2009', a: 75, b: 65},
            {y: '2010', a: 50, b: 40},
            {y: '2011', a: 75, b: 65},
            {y: '2012', a: 100, b: 90}
        ],
        barColors: ['#00a65a', '#f56954'],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['CPU', 'DISK'],
        hideHover: 'auto'
    });*/
    //Fix for charts under tabs
    /*$('.box ul.nav a').on('shown.bs.tab', function(e) {
        area.redraw();
        donut.redraw();
    });*/


    /* BOX REFRESH PLUGIN EXAMPLE (usage with morris charts) */
    /*$("#loading-example").boxRefresh({
        source: "ajax/dashboard-boxrefresh-demo.php",
        onLoadDone: function(box) {
            bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: [
                    {y: '2006', a: 100, b: 90},
                    {y: '2007', a: 75, b: 65},
                    {y: '2008', a: 50, b: 40},
                    {y: '2009', a: 75, b: 65},
                    {y: '2010', a: 50, b: 40},
                    {y: '2011', a: 75, b: 65},
                    {y: '2012', a: 100, b: 90}
                ],
                barColors: ['#00a65a', '#f56954'],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['CPU', 'DISK'],
                hideHover: 'auto'
            });
        }
    });*/

    /* The todo list plugin */
    $(".todo-list").todolist({
        onCheck: function(ele) {
            //console.log("The element has been checked")
        },
        onUncheck: function(ele) {
            //console.log("The element has been unchecked")
        }
    });

});