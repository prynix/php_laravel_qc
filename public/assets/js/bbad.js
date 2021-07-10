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
    website_page=window.location.hostname;
    hitCounter(website_page);
  function displayAdsRSS(website_id,number_ads,style){ 
      $.ajax(
        {
            url: hostname+"admin/rss-get_adbanner-"+website_id+'-'+number_ads,
            type:'GET',
            dataType:"json",
            success:function(data)
            {
              if(style=='vertical'){
                var heightUl=79*data.length;
                $('div.vertical_display').append('<style type="text/css">div.vertical_display ul li:last-child{border-bottom:none !important;}</style><ul style="width:auto;height:auto;display:inline-block;padding:5px;border:1px solid #ccc;">');
                for(var i=0;i<data.length;i++){
                    $('div.vertical_display ul').append('<li style="float:left;width:100%;height:auto;padding:5px 0;border-bottom:1px dashed #ccc;list-style:none;"><a href="'+data[i]['adbanner_link']+'" target="_blank" style="float:left;"><img src="'+hostname+data[i]['imagefile']+'" alt="'+data[i]['adbanner_title']+'" width="100px" onerror="this.onerror=null;this.src='+data[i]["imagefile"]+'"/></a><p style="margin-left:115px;margin-top:0px;"><a href="'+data[i]['adbanner_link']+'" title="'+data[i]['adbanner_title']+'" target="_blank" style="text-decoration:none;font-size:12px;font-weight:bold;color:#333;">'+data[i]['adbanner_title']+'</a></p></li>');  
                }
                $('div.vertical_display ul').append('</ul></div>');
              }
              if(style=='horizontal'){ 
                //chá»‰nh láº¡i responsive cho pháº§n nĂ y
                var widthLi=($('div.horizontal_display').width()-10)/data.length-10-2;
                $('div.horizontal_display').append('<style type="text/css">div.horizontal_display{width:100%;}div.horizontal_display ul{display:flex;flex-direction:row;}div.horizontal_display ul li{flex-grow:1;}div.horizontal_display ul li:first-child{border-left:1px dashed #ccc;}</style>');
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
  function hitCounter(website_page){
      contentType = "text/plain";
      $.ajax({
            type:'GET',
            url:hostname+"view-"+website_page,
            // timeout: 3000,
            success:function(data){ 
                //alert("Data from Server"+JSON.stringify(data));   
            },
            error:function(jqXHR,textStatus,errorThrown){ 
                //alert("You can not send Cross Domain AJAX requests: "+errorThrown);
            }
        });
  }
  //o day mac dinh toi da co 3 quang cao tren 1 vung hien thi
  var k = Math.floor(Math.random()*3); //Cai nay fix dong theo so luong quang cao lon nhat trong 1 vung hien thi
  var n = 0;
  var src = new Array(),href=new Array(),wdth=new Array(),hght=new Array(),wdthObj=new Array(),hghtObj=new Array(),alt=new Array(),title=new Array(),data = new Array(),dataObj=new Array();
  
  //SLIDESHOW ADVERTISEMENT
  function displayBannerSlideShow(zoneid,website_id,timeout){ 
    $.ajax(
        {
         url: hostname+"qc/website-code_ads-"+zoneid,
         type: 'GET',
         dataType:"json",
         // timeout: 3000,
         
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

          
            $('div.ads-'+zoneid).append('');
            for(var i=0;i<data.length;i++){  
                if(data[i]['htmltemplate']!==''&&data[i]['filename']===''){
                    $(".list_ads").append('<div class="tpl">'+data[i]['htmltemplate']+'</div>');
                }else if(data[i]['htmltemplate']===''&&data[i]['filename']!==''){
					myList1=['jpg','jpeg','gif','png','bmp']; 
                	myList2=['swf','flv']; 

                 	if($.inArray(data[i]['filename'].substr(data[i]['filename'].lastIndexOf('.')+1),myList1)!==-1){
                 		$('div.ads-'+zoneid).append('<a name="hyperlink-data" title="'+data[i]['description']+'" href="'+hostname+'adMan/click-banner-'+zoneid+'-'+data[i]['id']+'" target="_blank" rel="nofollow"><img src="'+hostname+data[i]['filename']+'" border=0 width="'+data[i]['width']+'px" height="'+data[i]['height']+'px" alt="'+data[i]['alt']+'" name="image-data"/></a>');
                 	}else if($.inArray(data[i]['filename'].substr(data[i]['filename'].lastIndexOf('.')+1),myList2)!==-1){
                 		$('div.ads-'+zoneid).append('<div class="slide" style="display:none;"><object data="'+hostname+data[i]['filename']+'" width="'+data[i]['width']+'px" height="'+data[i]['height']+'px"></object></div>');
                 	}
                }
            }
            $('div.ads-'+zoneid).append('</div>');
            $('div.ads-'+zoneid+' div.slide').css('display','none');
			var currentIndex=0,items=$('div.ads-'+zoneid+' div.slide'),itemAmt=items.length;
            cycleItems();
			function cycleItems(){
				var item=$('div.ads-'+zoneid+' div.slide').eq(currentIndex);
				items.hide();
				item.css('display','block');
			}
			var autoSlide=setInterval(function(){
				currentIndex+=1;
				if(currentIndex>itemAmt-1){
					currentIndex=0;
				}
				cycleItems();
			},timeout);

      },
         error:function(jqXHR,textStatus,errorThrown)
         {
            //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
         }
    });
  }
  //Banners has time out
  function displayBannersHasTimeOut(zoneid,website_id,timeout){ 
    $.ajax(
        {
         url: hostname+"qc/website-code_ads-"+zoneid,
         type: 'GET',
         dataType:"json",
         // timeout: 3000,
         
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

          
            $('div.ads-'+zoneid).append('<div class="list_ads"><span class="timeout">'+timeout+'</span><div class="slide_display"><a name="hyperlink-tag" style="display:inline-block;"><img name="image-tag"/></a>'
                    +'<object type="application/x-shockwave-flash" name="flash-object-'+zoneid+'">'
                    +'<param name="movie"/>'
                    +'<param name="wmode" value="transparent"/>'
                    +'<param name="bgcolor"/>'
                    +'<param name="quality" value="high"/>'
                    +'<param name="allowFullScreen" value="true"/>'
                    +'<param name="allowscriptaccess" value="always"/>'
                    +'<param name="flashvars"/>'
                    +'</object></div></div> ');
            for(var i=0;i<data.length;i++){  
                if(data[i]['htmltemplate']!==''&&data[i]['filename']===''){
                    $('div.ads-'+zoneid).append('<div class="tpl">'+data[i]['htmltemplate']+'</div>');
                }else if(data[i]['htmltemplate']===''&&data[i]['filename']!==''){
                     // $(".list_ads").append('<div class="slide" style="display:none;">'
                     // +'<object data="'+hostname+data[i]['filename']+'" width="'+data[i]['width']+'px" height="'+data[i]['height']+'px"></object>'
                     // +'<a name="hyperlink-data" title="'+data[i]['description']+'" href="'+hostname+'adMan/click-banner-'+zoneid+'-'+data[i]['id']+'" target="_blank" rel="nofollow"><img src="'+hostname+data[i]['filename']+'" border=0 width="'+data[i]['width']+'px" height="'+data[i]['height']+'px" alt="'+data[i]['alt']+'" name="image-data"/></a>'
                     // +'</div>');
					myList1=['jpg','jpeg','gif','png','bmp']; 
                	myList2=['swf','flv']; 

                 	if($.inArray(data[i]['filename'].substr(data[i]['filename'].lastIndexOf('.')+1),myList1)!==-1){
                 		$('div.ads-'+zoneid).append('<a name="hyperlink-data" title="'+data[i]['description']+'" href="'+hostname+'adMan/click-banner-'+zoneid+'-'+data[i]['id']+'" target="_blank" rel="nofollow"><img src="'+hostname+data[i]['filename']+'" border=0 width="'+data[i]['width']+'px" height="'+data[i]['height']+'px" alt="'+data[i]['alt']+'" name="image-data"/></a>');
                 	}else if($.inArray(data[i]['filename'].substr(data[i]['filename'].lastIndexOf('.')+1),myList2)!==-1){
                 		$('div.ads-'+zoneid).append('<div class="slide" style="display:none;"><object data="'+hostname+data[i]['filename']+'" width="'+data[i]['width']+'px" height="'+data[i]['height']+'px"></object></div>');
                 	}
                }
            }
            $('div.ads-'+zoneid).append('</div>');

            swapImage();
            //Äáº¢O QUáº¢NG CĂO
			  function swapImage()
			  {  
			  	var timeout=$('div.ads-'+zoneid+' div.list_ads span.timeout').text();
			  	$('div.ads-'+zoneid+' div.list_ads span.timeout').css({'display':'none'});
			  	$('div.ads-'+zoneid+' div.list_ads div.slide_display').css({'display':'none'});
			  	$('div.ads-'+zoneid+' div.list_ads img').css({'display':'none'});
				$('div.ads-'+zoneid+' div.list_ads a').css({'display':'none'});
			    $('div.ads-'+zoneid+' div.list_ads object').css({'display':'none'});

			      if($('div.ads-'+zoneid+' a[name="hyperlink-data"]').length){
				      $('div.ads-'+zoneid+' a[name="hyperlink-data"]').each(function(){
				          href.push($(this).attr('href'));
				          title.push($(this).attr('title'));
				      });
				  }
			     if($('div.ads-'+zoneid+' img[name="image-data"]').length){
			      $('div.ads-'+zoneid+' img[name="image-data"]').each(function(){ 
			          src.push($(this).attr('src'));
			          wdth.push($(this).attr('width'));
			          hght.push($(this).attr('height'));
			          alt.push($(this).attr('alt'));
			      });
			       $('div.ads-'+zoneid+' div.slide_display img[name="image-data"]').css({'display':'block'});
			       $('div.ads-'+zoneid+' div.slide_display img[name="image-data"]').attr('src',src[n]);	
			       $('div.ads-'+zoneid+' div.slide_display img[name="image-data"]').attr('width',wdth[n]);
			       $('div.ads-'+zoneid+' div.slide_display img[name="image-data"]').attr('height',hght[n]);
			       $('div.ads-'+zoneid+' div.list_ads div.slide_display').css({'display':'block'});
			     } 
			     if($('div.ads-'+zoneid+' div.slide object').length){ 

			     	$('div.ads-'+zoneid+' div.slide object').each(function(){
			          dataObj.push($(this).attr('data'));
			          wdthObj.push($(this).attr('width'));
			          hghtObj.push($(this).attr('height'));
			       }); 
			       $('div.ads-'+zoneid+' object[name="flash-object-'+zoneid+'"]').css({'display':'block'});
			       $('div.ads-'+zoneid+' object[name="flash-object-'+zoneid+'"]').attr('data',dataObj[n]);	
			       $('div.ads-'+zoneid+' object[name="flash-object-'+zoneid+'"]').attr('width',wdthObj[n]);
			       $('div.ads-'+zoneid+' object[name="flash-object-'+zoneid+'"]').attr('height',hghtObj[n]);
			       $('div.ads-'+zoneid+' div.list_ads div.slide_display').css({'display':'block','width':wdthObj[n],'height':hghtObj[n],'overflow':'hidden'});
			       $('div.ads-'+zoneid+' div.list_ads div.slide_display').css({'display':'block'});
			     }
			     if(k < src.length - 1) k++; else k = 0;
			     if(n < $('div.ads-'+zoneid+' div.slide object').length - 1) n++; else n = 0;

			     setTimeout("swapImage()",timeout);
			  }
      },
         error:function(jqXHR,textStatus,errorThrown)
         {
            //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
         }
    });
  }
  //MĂƒ HIá»‚N THá» Má»I
  function displayBanners(zoneid,website_id){
    $.ajax(
        {
         url: hostname+"qc/website-code_ads-"+zoneid,
         type: 'GET',
         dataType:"json",
         // timeout: 3000,
         
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

            $('div.ads-'+zoneid).append('<div class="list_ads">');
            for(var i=0;i<data.length;i++){  
                if(data[i]['htmltemplate']!==''&&data[i]['filename']===''){
                    $('div.ads-'+zoneid).append('<div class="tpl">'+data[i]['htmltemplate']+'</div>');
                }else if(data[i]['htmltemplate']===''&&data[i]['filename']!==''){
                	myList1=['jpg','jpeg','gif','png','bmp']; 
                	myList2=['swf','flv']; 

                    $('div.ads-'+zoneid).append('<div class="slide">');
                	if($.inArray(data[i]['filename'].substr(data[i]['filename'].lastIndexOf('.')+1),myList1)!==-1){
                		$('div.ads-'+zoneid).append('<a name="hyperlink-data" title="'+data[i]['description']+'" href="'+hostname+'adMan/click-banner-'+zoneid+'-'+data[i]['id']+'" target="_blank" rel="nofollow"><img src="'+hostname+data[i]['filename']+'" border=0 width="'+data[i]['width']+'px" height="'+data[i]['height']+'px" alt="'+data[i]['alt']+'" name="image-data"/></a>');
                	}else if($.inArray(data[i]['filename'].substr(data[i]['filename'].lastIndexOf('.')+1),myList2)!==-1){
                		$('div.ads-'+zoneid).append('<object data="'+hostname+data[i]['filename']+'" width="'+data[i]['width']+'px" height="'+data[i]['height']+'px"></object>');
                	}
                    $('div.ads-'+zoneid).append('</div>');
                }
            }
            $('div.ads-'+zoneid).append('</div>');
      },
         error:function(jqXHR,textStatus,errorThrown)
         {
            //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
         }
    });
  }
  function displayAds(zoneid,url_page){ 
    if(window.XDomainRequest)
        contentType = "text/plain";

        $.ajax(
        {
         url: hostname+"qc/website-code_ads-"+zoneid,
         type: 'GET',
         dataType:"json",
         // timeout: 3000,
         
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
	        $('div.ads-'+zoneid).append('<div id="zone'+zoneid+'" style="width:'+wdh[rnd]+'px;height:'+hgt[rnd]+'px;">');        
				if(html[rnd]!=''){
                  $("#zone"+zoneid).append(''+html[rnd]);
                }else{ 
                  $("#zone"+zoneid).append('<a href="'+hostname+'adMan/click-banner-'+zoneid+'-'+bannerid[rnd]+'" target="_blank" rel="nofollow"><img src="'+gfx[rnd]+'" border=0 style="width:'+wdh[rnd]+'px;height:'+hgt[rnd]+'px;" alt="'+alt[rnd]+'" title="'+title[rnd]+'"/></a>');
                }
                $('div.ads-'+zoneid).append('</div>');
                                      
         },
         error:function(jqXHR,textStatus,errorThrown)
         {
            //alert("You can not send Cross Domain AJAX requests : "+errorThrown);
         }
              });

}