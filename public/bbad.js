//displayAds(); 
//2 parameters: website_id and zoneid, nen co zoneid ko thi ko biet hien thi o vung nao
//webiste dong, zone cung dong
//client goi file nay
(function($){if(!$.support.cors&&$.ajaxTransport&&window.XDomainRequest){var n=/^https?:\/\//i;var o=/^get|post$/i;var p=new RegExp('^'+location.protocol,'i');var q=/text\/html/i;var r=/\/json/i;var s=/\/xml/i;$.ajaxTransport('* text html xml json',function(i,j,k){if(i.crossDomain&&i.async&&o.test(i.type)&&n.test(i.url)&&p.test(i.url)){var l=null;var m=(j.dataType||'').toLowerCase();return{send:function(f,g){l=new XDomainRequest();if(/^\d+$/.test(j.timeout)){l.timeout=j.timeout}l.ontimeout=function(){g(500,'timeout')};l.onload=function(){var a='Content-Length: '+l.responseText.length+'\r\nContent-Type: '+l.contentType;var b={code:200,message:'success'};var c={text:l.responseText};try{if(m==='html'||q.test(l.contentType)){c.html=l.responseText}else if(m==='json'||(m!=='text'&&r.test(l.contentType))){try{c.json=$.parseJSON(l.responseText)}catch(e){b.code=500;b.message='parseerror'}}else if(m==='xml'||(m!=='text'&&s.test(l.contentType))){var d=new ActiveXObject('Microsoft.XMLDOM');d.async=false;try{d.loadXML(l.responseText)}catch(e){d=undefined}if(!d||!d.documentElement||d.getElementsByTagName('parsererror').length){b.code=500;b.message='parseerror';throw'Invalid XML: '+l.responseText;}c.xml=d}}catch(parseMessage){throw parseMessage;}finally{g(b.code,b.message,c,a)}};l.onprogress=function(){};l.onerror=function(){g(500,'error',{text:l.responseText})};var h='';if(j.data){h=($.type(j.data)==='string')?j.data:$.param(j.data)}l.open(i.type,i.url);l.send(h)},abort:function(){if(l){l.abort()}}}}})}})(jQuery);

    contentType ="application/x-www-form-urlencoded; charset=utf-8";
    if(window.location.hostname=='localhost'){ 
      hostname="http://localhost/qc/public/";
    }else if(window.location.hostname=='lqc.tintuc.vn'){ 
      hostname="http://lqc.tintuc.vn/";
    }else if(window.location.hostname=='sqc.tintuc.vn'){ 
      hostname="http://sqc.tintuc.vn/";
    }else{
      hostname="http://qc.tintuc.vn/";
    }
    imgError=hostname+'assets/img/icon/no_image.jpg';
    //website_page=window.location.origin+'/';
    website_page=window.location.hostname;
    //hitCounter(website_page);
  function displayAdsRSS(website_id,number_ads,style){ //còn thiếu id của website (cả về website lẫn của đối tác)
    //display ad banners from table websites_banners
      $.ajax(
        {
            url: hostname+"admin/rss-get_adbanner-"+website_id+'-'+number_ads,
            //url: hostname+"admin/rss-get_adbanner",
            type:'GET',
            //data:"number_ads="+number_ads+"&website_id="+website_id,
            dataType:"json",
            success:function(data)
            {
              //alert("Successfully !");
              //alert(data.length);
              if(style=='vertical'){
                var heightUl=79*data.length;
                $('div.vertical_display').append('<style type="text/css">div.vertical_display ul li:last-child{border-bottom:none !important;}</style><ul style="width:auto;height:auto;display:inline-block;padding:5px;border:1px solid #ccc;">');
                for(var i=0;i<data.length;i++){
                    $('div.vertical_display ul').append('<li style="float:left;width:100%;height:auto;padding:5px 0;border-bottom:1px dashed #ccc;list-style:none;"><a href="'+data[i]['adbanner_link']+'" target="_blank" style="float:left;"><img src="'+hostname+data[i]['imagefile']+'" alt="'+data[i]['adbanner_title']+'" width="100px" onerror="this.onerror=null;this.src='+data[i]["imagefile"]+'"/></a><p style="margin-left:115px;margin-top:0px;"><a href="'+data[i]['adbanner_link']+'" title="'+data[i]['adbanner_title']+'" target="_blank" style="text-decoration:none;font-size:12px;font-weight:bold;color:#333;">'+data[i]['adbanner_title']+'</a></p></li>');  
                }
                $('div.vertical_display ul').append('</ul></div>');
              }
              if(style=='horizontal'){ 
                //chỉnh lại responsive cho phần n� y
                var widthLi=($('div.horizontal_display').width()-10)/data.length-10-2;
                //if(widthLi<=208){
                  //$('div.horizontal_display').append('<style type="text/css">div.horizontal_display{width:100%;}div.horizontal_display ul{display:flex;flex-direction:row;}div.horizontal_display ul li{flex-grow:1;}div.horizontal_display ul li:first-child{border-left:1px dashed #ccc;}div.horizontal_display ul li a{text-align:center;width:100%;display:inline-block;}div.horizontal_display ul li p{text-align:center;}</style>');
                //}else{
                  $('div.horizontal_display').append('<style type="text/css">div.horizontal_display{width:100%;}div.horizontal_display ul{display:flex;flex-direction:row;}div.horizontal_display ul li{flex-grow:1;}div.horizontal_display ul li:first-child{border-left:1px dashed #ccc;}</style>');
                //}
                $('div.horizontal_display').append('<ul style="width:auto;height:auto;padding:5px;border:1px solid #ccc;">');
                for(var i=0;i<data.length;i++){
                    $('div.horizontal_display ul').append('<li style="float:left;width:'+widthLi+'px;padding:5px;border-bottom:1px dashed #ccc;border-top:1px dashed #ccc;border-right:1px dashed #ccc;list-style:none;"><a href="'+data[i]['adbanner_link']+'" target="_blank" style="float:left;"><img src="'+hostname+data[i]['imagefile']+'" alt="'+data[i]['adbanner_title']+'" height="70px" style="margin-right:15px;" onerror="this.onerror=null;this.src='+data[i]["imagefile"]+'"/></a><p style="margin-top:0px;"><a href="'+data[i]['adbanner_link']+'" title="'+data[i]['adbanner_title']+'" target="_blank" style="text-decoration:none;font-size:12px;font-weight:bold;color:#333;">'+data[i]['adbanner_title']+'</a></p></li>');
                }
                $('div.horizontal_display ul').append('</ul></div>');
              }
              if(style=='ads_link'){ 
                $('div.ads_link_display').append('<ul style="width:100%;height:auto;padding:0;">');
                for(var i=0;i<data.length;i++){
                	$('div.ads_link_display ul').append('<li style="float:left;width:100%;border-bottom:1px dashed #ccc;border-top:1px dashed #ccc;list-style:none;"><p style="margin:0px;padding:10px 0;"><img src="'+hostname+'assets/img/icon/link.png" alt="iLink"/>&nbsp;<a href="'+data[i]['adbanner_link']+'" title="'+data[i]['adbanner_title']+'" target="_blank" style="text-decoration:none;font-size:12px;font-weight:bold;color:#333;">'+data[i]['adbanner_title']+'</a></p></li>');
                }
                $('div.ads_link_display ul').append('</ul></div>');
              }
            },
            error:function(jqXHR,textStatus,errorThrown)
            {
              //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
            }
        });
  }
  /*function hitCounter(website_page){
      contentType = "text/plain";
      $.ajax({
            type:'GET',
            url:hostname+"view-"+website_page,
            //url:hostname+"view.php",
            //data:"website_page="+website_page,
            timeout: 3000,
            //dataType:"json",   
            //contentType:contentType,
            success:function(data){ 
                //alert("Data from Server"+JSON.stringify(data));   
            },
            error:function(jqXHR,textStatus,errorThrown){ //alert(JSON.stringify(errorThrown));
                //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }
        });
  }*/
  function displayBanners(zoneid,website_id){ 
    $.ajax(
        {
         url: hostname+"qc/website-code_ads-"+zoneid,
         //url: hostname+"admin/website-code-ads-"+zoneid,
         type: 'GET',
         dataType:"json",
         timeout: 3000,
         //contentType:contentType,
         //crossDomain:true,
         
         success:function(data)
         { 
        bannerid=new Array();gfx=new Array();wdh=new Array();hgt=new Array();lnk=new Array();wgt=new Array();html=new Array();alt=new Array();title=new Array();
        var filename;
        for(var i=0;i<data.length;i++){ 
        if(data[i]['filename']!=''){
          filename=hostname+data[i]['filename'];
        }else{
          filename='';
        } 
        url=hostname+data[i]['url'];
        id=data[i]['id'];
        width=data[i]['width'];
        height=data[i]['height'];
        weight=data[i]['weight'];
        htmltemplate=data[i]['htmltemplate'];
        al=data[i]['alt'];
        tit=data[i]['description'];
        bannerid.push(id);
        gfx.push(filename);
        lnk.push(url);
        wdh.push(width);
        hgt.push(height);
        wgt.push(weight); 
        html.push(htmltemplate);
        alt.push(al);
        title.push(tit);
            }

          
            $('div.ads-'+zoneid).append('<div id="list_banners" class="list-box">');
            for(var i=0;i<data.length;i++){  
              if(data[i]['htmltemplate']!=''){
                        $("#list_banners").append('<div class="slides">'+data[i]['htmltemplate']+'</div>');
                                            }else{ 
                                              $("#list_banners").append('<div class="slides" style="display:none;"><div><a class="path" title="'+data[i]['description']+'" href="'+hostname+'adMan/click-banner-'+zoneid+'-'+data[i]['id']+'" target="_blank" rel="nofollow"><img src="'+hostname+data[i]['filename']+'" border=0 width="'+data[i]['width']+'px" height="'+data[i]['height']+'px" alt="'+data[i]['alt']+'" class="path"/></a></div></div>');
                                            }
            }
            $('div.ads-'+zoneid).append('</div>');
            dataLength(data.length);
      },
         error:function(jqXHR,textStatus,errorThrown)
         {
            //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
         }
    });
  }
  //o day mac dinh toi da co 3 quang cao tren 1 vung hien thi
  var k = Math.floor(Math.random()*3); //Cai nay fix dong theo so luong quang cao lon nhat trong 1 vung hien thi
  var n = 0;
  var src = new Array(),href=new Array(),wdth=new Array(),hght=new Array(),alt=new Array(),title=new Array(),data = new Array();
  function dataLength(len){
  	//alert(len);
    swapImage();
  }
  function swapImage()
  {  
      $('img.path').each(function(){ 
          src.push($(this).attr('src'));
          wdth.push($(this).attr('width'));
          hght.push($(this).attr('height'));
          alt.push($(this).attr('alt'));
      });
      $('a.path').each(function(){
          href.push($(this).attr('href'));
          title.push($(this).attr('title'));
      });
     if($('a#href_target').length){
	     document.getElementById('href_target').href = href[k];
	     document.getElementById('href_target').title = title[k];
     }
     if($('img.path').length){
	     document.slide.src = src[k];
	     document.slide.width = wdth[k];
	     document.slide.height = hght[k];
	     document.slide.alt = alt[k];
	     document.slide.title = title[k];
     }
     if($('div.slides object').length){ 

     	$('div.slides object').css('display','none');

     	$('div.slides object').each(function(){ 
          data.push($(this).attr('data'));
          wdth.push($(this).attr('width'));
          hght.push($(this).attr('height'));
       }); 
       $('div.slides object').attr('data',data[n]);	
       $('div.slides object').attr('width',wdth[n]);
       $('div.slides object').attr('height',hght[n]);
       $('div#list_banners').css({'width':wdth[n],'height':hght[n],'overflow':'hidden'});
       $('div.slides object').css({'display':'block'});
     }
     if(k < src.length - 1) k++; else k = 0;
     if(n < $('div.slides object').length - 1) n++; else n = 0;

     setTimeout("swapImage()",8000);
  }
  function displayAds(zoneid,url_page){ 
  //var contentType ="application/x-www-form-urlencoded; charset=utf-8";
    if(window.XDomainRequest)
        contentType = "text/plain";

    //sua lai duong dan dong url
    //hien thi nhu theo slideshow, cu bao nhieu giay lai doi sang 1 banner khac

        $.ajax(
        {
         url: hostname+"qc/website-code_ads-"+zoneid,
         //url: hostname+"admin/website-code-ads-"+zoneid,
         type: 'GET',
         dataType:"json",
         timeout: 3000,
         //contentType:contentType,
         //crossDomain:true,
         
         success:function(data)
         { 
	        bannerid=new Array();gfx=new Array();wdh=new Array();hgt=new Array();lnk=new Array();wgt=new Array();html=new Array();alt=new Array();title=new Array();
	        var filename;
	        for(var i=0;i<data.length;i++){ 
		        if(data[i]['filename']!=''){
		          filename=hostname+data[i]['filename'];
		        }else{
		          filename='';
		        }
		        url=hostname+data[i]['url'];
		        id=data[i]['id'];
		        width=data[i]['width'];
		        height=data[i]['height'];
		        weight=data[i]['weight'];
		        htmltemplate=data[i]['htmltemplate'];
		        al=data[i]['alt'];
		        tit=data[i]['description'];
		        bannerid.push(id);
		        gfx.push(filename);
		        lnk.push(url);
		        wdh.push(width);
		        hgt.push(height);
		        wgt.push(weight); 
		        html.push(htmltemplate);
		        alt.push(al);
		        title.push(tit);
	        }
            rnd=Math.floor(Math.random()*(data.length));
        
	        //thay the bang document.getElementById de in ra man hinh
	        //fix lại kích thước 100%
	        $('div.ads-'+zoneid).append('<div id="zone'+zoneid+'" style="width:'+wdh[rnd]+'px;height:'+hgt[rnd]+'px;">');                               
                //if(gfx[rnd]==''||gfx[rnd]==undefined){ //alert(html[rnd]);
				if(html[rnd]!=''){
                  //$("#zone"+zoneid).append('<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><ins class="adsbygoogle" style="display:inline-block;width:'+wdh[rnd]+'px;height:'+hgt[rnd]+'px;" data-ad-client="ca-pub-5128894772635532"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>');
                  $("#zone"+zoneid).append(''+html[rnd]);
                  //
                }else{ 
                  $("#zone"+zoneid).append('<a href="'+hostname+'adMan/click-banner-'+zoneid+'-'+bannerid[rnd]+'" target="_blank" rel="nofollow"><img src="'+gfx[rnd]+'" border=0 style="width:'+wdh[rnd]+'px;height:'+hgt[rnd]+'px;" alt="'+alt[rnd]+'" title="'+title[rnd]+'"/></a>');
                  //$("#zone"+zoneid).append('<a href="'+hostname+'click.php?id='+bannerid[rnd]+'" target="_blank"><img src="'+gfx[rnd]+'" border=0 style="width:'+wdh[rnd]+'px;height:'+hgt[rnd]+'px;"/></a>');
                }
                //$("#zone"+zoneid).append('<a href="'+hostname+'click.php?id='+bannerid[rnd]+'" target="_blank"><img src="'+gfx[rnd]+'" border=0 style="width:'+wdh[rnd]+'px;height:'+hgt[rnd]+'px;"/></a><script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><ins class="adsbygoogle" style="display:inline-block;width:'+wdh[rnd]+'px;height:'+hgt[rnd]+'px;"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>');
                //$("#zone"+zoneid).append('<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><ins class="adsbygoogle" style="display:inline-block;width:'+wdh[rnd]+'px;height:'+hgt[rnd]+'px;"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>');
	        $('div.ads-'+zoneid).append('</div>');
                                      
         },
         error:function(jqXHR,textStatus,errorThrown)
         {
            //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
         }
              });

}