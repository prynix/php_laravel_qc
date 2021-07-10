/*Using library*/
document.addEventListener('DOMContentLoaded',function(){
var makeBSS=function(el,options){ 
	var $slideshows=document.querySelectorAll(el),//a collection of all of the slideshow
		$slidesshow={}
		Slideshow={
			init:function(el,options){
				this.counter=0;//to keep track of current slide
				this.el=el;//current slideshow container
				this.$items=el.querySelectorAll('div.slide');//
				this.numItems=this.$items.length;//total number of slides
				options=options||{};//if options object not passed in, then set to empty object
				options.auto=options.auto||false;//if options.auto object not passed in, then set to false
				this.opts={
					auto:(typeof options.auto==='undefined')?false:options.auto,
					speed:(typeof options.auto.speed==='undefined')?1500:options.auto.speed,
					pauseOnHover:(typeof options.auto.pauseOnHover==='undefined')?false:options.auto.pauseOnHover,
					fullScreen:(typeof options.fullScreen==='undefined')?false:options.fullScreen,
					swipe:(typeof options.swipe==='undefined')?false:options.swipe
				};
				this.$items[0].classList.add('bss-show');//add show class to first iframe
				this.injectControls(el);
				this.addEventListeners(el);
				if(this.opts.auto){
					this.autoCycle(this.el,this.opts.speed,this.opts.pauseOnHover);
				}
				if(this.opts.fullScreen){
					this.addFullScreen(this.el);
				}
				if(this.opts.swipe){
					this.addSwipe(this.el);
				}
			},
			showCurrent: function(i){
				//increment or decrement this.counter depending on whether i===1 or i===-1
				if(i>0){
					this.counter=(this.counter+1===this.numItems)?0:this.counter+1;
				}else{
					this.counter=(this.counter-1<0)?this.numItems-1:this.counter-1;
				}
				//remove .show from whichever element currently has it
				[].forEach.call(this.$items,function(el){
					el.classList.remove('bss-show');
				});
				//add .show to the one item that's supposed to have it
				this.$items[this.counter].classList.add('bss-show');
			},
			injectControls:function(el){
				//build and inject prev/next controls
				//first create all the new elements
				var spanPrev=document.createElement('span');
				spanNext=document.createElement('span');
				docFrag=document.createDocumentFragment();
				//add classes
				spanPrev.classList.add('bss-prev');
				spanNext.classList.add('bss-next');
				//append elements to fragment, then append fragment to DOM
				docFrag.appendChild(spanPrev);
				docFrag.appendChild(spanNext);
				el.appendChild(docFrag);
			},
			addEventListeners:function(el){
				var that=this;
				el.onkeydown=function(e){
					e=e||window.event;
					if(e.keyCode===37){
						that.showCurrent(-1);//decrement & show
					}else if(e.keyCode===39){
						that.showCurrent(1);//increment & show
					}
				};
			},
			autoCycle:function(el,speed,pauseOnHover){
				var that=this,
				interval=window.setInterval(function(){
					that.showCurrent(1);//increment & show
				},speed);
				if(pauseOnHover){

				}//end pauseonhover
			},
			addFullScreen:function(el){

			},
			addSwipe:function(el){
				var that=this;
				ht=new Hammer(el);
				ht.on('swiperight',function(e){
					that.showCurrent(-1);//decrement & show
				});
				ht.on('swipeleft',function(e){
					that.showCurrent(1);//increment & show
				});
			},
			toggleFullScreen:function(el){

			}//end toggleFullScreen
		};//end Slideshow object
	//make instances of Slideshow as needed
	[].forEach.call($slideshows,function(el){
		$slideshow=Object.create(Slideshow);
		$slideshow.init(el,options);
	});
};
var opts={
	auto:{
		speed: 10000,
		pauseOnHover: false
	},
	fullScreen:false,
	swipe:true
};
makeBSS('#adman',opts);
},false);
/*Javascript File*/
//A generic AJAX request object
function ajaxRequest(){  
var activexmodes=["Msxml2.XMLHTTP","Microsoft.XMLHTTP"] //activeX versions to check for in IE
if(window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
	for(var i=0;i<activexmodes.length;i++){
		try{
			return new ActiveXObject(activexmodes[i]);
		}catch(e){
			//suppress error
		}
	}
}else if(window.XMLHttpRequest){ //if Mozilla, Safari etc
	return new XMLHttpRequest();
}else{
	return false;
}
}
//START JAVASCRIPT AJAX
contentType ="application/x-www-form-urlencoded; charset=utf-8";
if(window.location.hostname=='localhost'){ 
  hostname="http://localhost/qc/public/";
}else if(window.location.hostname=='lqc.tintuc.vn'){ 
  hostname="http://lqc.tintuc.vn/";
}else if(window.location.hostname=='sqc.tintuc.vn'){ 
  hostname="http://sqc.tintuc.vn/";
}else{
  hostname="http://localhost/qc/public/";
}
imgError=hostname+'assets/img/icon/no_image.jpg';
website_page=window.location.hostname; 
if(website_page!==''){
	hitCounter(website_page);
}
var req;
function hitCounter(website_page){ 
	var xmlhttp;	
	if(window.XMLHttpRequest){
		//code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();//khởi tạo 1 request mới
	}else{
		//code for IE5, IE6
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			//alert(xmlhttp.responseText);
		}
	}	
	xmlhttp.open('GET',hostname+"view-"+website_page,true);
	xmlhttp.send();
}
//khai báo biến khởi tạo thứ tự slide đầu tiên hiển thị
var k,n=0;
var src,href,wdth,hght,wdthObj,hghtObj,alt,title,data,dataObj=new Array();
//SLIDESHOW ADVERTISEMENT
function displayBannerSlideShow(zoneid,website_id,timeout){ 
	var xmlhttp;	
	if(window.XMLHttpRequest){
		//code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();//khởi tạo 1 request mới
	}else{
		//code for IE5, IE6
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	} 
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){ 
			data=JSON.parse(xmlhttp.responseText);
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

	          	var div=document.body;
	            div.innerHTML+='<div id="adman">';
	            for(var i=0;i<data.length;i++){ 
	                if(data[i]['htmltemplate']!==''&&data[i]['filename']===''){
	                    document.getElementsByClassName("list_ads").innerHTML+='<div class="tpl">'+data[i]['htmltemplate']+'</div>';
	                }else if(data[i]['htmltemplate']===''&&data[i]['filename']!==''){ 
						myList1=['jpg','jpeg','gif','png','bmp']; 
	                	myList2=['swf','flv']; 
	                	//document.writeln(data[i]['filename'].substr(data[i]['filename'].lastIndexOf('.')+1));
	                 	if(myList1.indexOf(data[i]['filename'].substr(data[i]['filename'].lastIndexOf('.')+1))>-1){ 
	                 		div.innerHTML+='<a name="hyperlink-data" title="'+data[i]['description']+'" href="'+hostname+'adMan/click-banner-'+zoneid+'-'+data[i]['id']+'" target="_blank" rel="nofollow"><img src="'+hostname+data[i]['filename']+'" border=0 width="'+data[i]['width']+'px" height="'+data[i]['height']+'px" alt="'+data[i]['alt']+'" name="image-data"/></a>';
	                 	}else if(myList2.indexOf(data[i]['filename'].substr(data[i]['filename'].lastIndexOf('.')+1))>-1){ 
	                 		div.innerHTML+='<div class="slide" style="display:none;"><object data="'+hostname+data[i]['filename']+'" width="'+data[i]['width']+'px" height="'+data[i]['height']+'px"></object></div>';
	                 	}
	                }
	            }
	            div.innerHTML+='</div>';
	            //document.getElementsByClassName('slide').style.display='none';
			}
		}
		xmlhttp.open('GET',hostname+"qc/website-code_ads-"+zoneid,true);
		xmlhttp.send();
}
//Banners has time out
function displayBannersHasTimeOut(zoneid,website_id,timeout){ 
	var xmlhttp;	
	if(window.XMLHttpRequest){
		//code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();//khởi tạo 1 request mới
	}else{
		//code for IE5, IE6
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			alert(xmlhttp.responseText);
		}
	}	
	//xmlhttp.open('GET',hostname+"qc/website-code_ads-"+zoneid,true);
	xmlhttp.send();
}
//MÃ HIỂN THỊ MỚI
function displayBanners(zoneid,website_id){
	var xmlhttp;	
	if(window.XMLHttpRequest){
		//code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();//khởi tạo 1 request mới
	}else{
		//code for IE5, IE6
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			data=JSON.parse(xmlhttp.responseText); //parse to object
			bannerid=new Array();gfx=new Array();wdh=new Array();hgt=new Array();lnk=new Array();wgt=new Array();html=new Array();alt=new Array();title=new Array();
	        var filename; //document.writeln(typeof data);
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

	            div.innerHTML('<div class="list_ads">');
	            for(var i=0;i<data.length;i++){  
	                if(data[i]['htmltemplate']!==''&&data[i]['filename']===''){
	                    div.innerHTML('<div class="tpl">'+data[i]['htmltemplate']+'</div>');
	                }else if(data[i]['htmltemplate']===''&&data[i]['filename']!==''){
	                	myList1=['jpg','jpeg','gif','png','bmp']; 
	                	myList2=['swf','flv']; 

	                    div.innerHTML('<div class="slide">');
	                	if($.inArray(data[i]['filename'].substr(data[i]['filename'].lastIndexOf('.')+1),myList1)!==-1){
	                		div.innerHTML('<a name="hyperlink-data" title="'+data[i]['description']+'" href="'+hostname+'adMan/click-banner-'+zoneid+'-'+data[i]['id']+'" target="_blank" rel="nofollow"><img src="'+hostname+data[i]['filename']+'" border=0 width="'+data[i]['width']+'px" height="'+data[i]['height']+'px" alt="'+data[i]['alt']+'" name="image-data"/></a>');
	                	}else if($.inArray(data[i]['filename'].substr(data[i]['filename'].lastIndexOf('.')+1),myList2)!==-1){
	                		div.innerHTML('<object data="'+hostname+data[i]['filename']+'" width="'+data[i]['width']+'px" height="'+data[i]['height']+'px"></object>');
	                	}
	                    div.innerHTML('</div>');
	                }
	            }
	            div.innerHTML('</div>');
			}
		}	
		//xmlhttp.open('GET',hostname+"qc/website-code_ads-"+zoneid,true);
		//xmlhttp.send();
}
function displayAds(zoneid,url_page){ 
	var xmlhttp;	
	if(window.XMLHttpRequest){
		//code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();//khởi tạo 1 request mới
	}else{
		//code for IE5, IE6
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4&&xmlhttp.status==200){
			alert(xmlhttp.responseText);
		}
	}	
	//xmlhttp.open('GET',hostname+"qc/website-code_ads-"+zoneid,true);
	//xmlhttp.send();
}
//performing GET requests using AJAX
var mygetrequest=new ajaxRequest();
mygetrequest.onreadystatechange=function(){ //Kiem tra trang thai san sang
if(mygetrequest.readyState==4){
	if(mygetrequest.status==200||window.location.href.indexOf('http')==-1){
		alert(mygetrequest.responseText);
	}else{
		alert("An error has occured making the request");
	}
}
}
mygetrequest.open("GET","http://tintuc.vn",true);
//mygetrequest.send();//null
//performing POST requests using AJAX
var mypostrequest=new ajaxRequest();
mypostrequest.onreadystatechange=function(){ //Kiem tra trang thai san sang
if(mygetrequest.readyState==4){
	if(mygetrequest.status==200||window.location.href.indexOf('http')==-1){
		alert(mygetrequest.responseText);
	}else{
		alert("An error has occured making the request");
	}
}
}
mypostrequest.open("POST","http://tintuc.vn",true);
mypostrequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//mypostrequest.send();//no parameters
/*Example*/
function xmlHttpPost(strURL){
var xmlHttpReq=false;
var self=this;
//Mozilla/Safari
if(window.XMLHttpRequest){
	self.xmlHttpReq=new XMLHttpRequest();
}
//IE
else if(window.ActiveXObject){
	self.xmlHttpReq=new ActiveXObject("Microsoft.XMLHTTP");
}
self.xmlHttpReq.open('POST',strURL,true);
self.xmlHttpReq.setRequestHeader('Content-type','application/x-www-form-urlencoded');
self.xmlHttpReq.onreadystatechange=function(){
	if(self.xmlHttpReq.readyState==4){
		alert(self.xmlHttpReq.responseText);
	}
}
//self.send();
}
xmlHttpPost('http://www.tintuc.vn');