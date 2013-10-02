/*
	Vidtok.co created by Blacc Spot Media, Inc.
	Copyright 2011 All Rights Reserved.
	Author: the Blacc Spot Media team
	www.blaccspot.com
/*---------------------------*/


/*
| -------------------------------------------------------------------
|  jQuery Jsonp
| -------------------------------------------------------------------
| Script: 
| Version: 
| Author: 
| Website: https://github.com/jaubourg/jquery-jsonp
*/



	(function($){function noop(){}function genericCallback(data){lastValue=[data]}function callIfDefined(method,object,parameters){return method&&method.apply(object.context||object,parameters)}function qMarkOrAmp(url){return/\?/.test(url)?"&":"?";}var STR_ASYNC="async",STR_CHARSET="charset",STR_EMPTY="",STR_ERROR="error",STR_INSERT_BEFORE="insertBefore",STR_JQUERY_JSONP="_jqjsp",STR_ON="on",STR_ON_CLICK=STR_ON+"click",STR_ON_ERROR=STR_ON+STR_ERROR,STR_ON_LOAD=STR_ON+"load",STR_ON_READY_STATE_CHANGE=STR_ON+"readystatechange",STR_READY_STATE="readyState",STR_REMOVE_CHILD="removeChild",STR_SCRIPT_TAG="<script>",STR_SUCCESS="success",STR_TIMEOUT="timeout",win=window,Deferred=$.Deferred,head=$("head")[0]||document.documentElement,pageCache={},count=0,lastValue,xOptionsDefaults={callback:STR_JQUERY_JSONP,url:location.href},opera=win.opera,oldIE=!!$("<div>").html("<!--[if IE]><i><![endif]-->").find("i").length;function jsonp(xOptions){xOptions=$.extend({},xOptionsDefaults,xOptions);var successCallback=xOptions.success,errorCallback=xOptions.error,completeCallback=xOptions.complete,dataFilter=xOptions.dataFilter,callbackParameter=xOptions.callbackParameter,successCallbackName=xOptions.callback,cacheFlag=xOptions.cache,pageCacheFlag=xOptions.pageCache,charset=xOptions.charset,url=xOptions.url,data=xOptions.data,timeout=xOptions.timeout,pageCached,done=0,cleanUp=noop,supportOnload,supportOnreadystatechange,firstChild,script,scriptAfter,timeoutTimer;Deferred&&Deferred(function(defer){defer.done(successCallback).fail(errorCallback);successCallback=defer.resolve;errorCallback=defer.reject;}).promise(xOptions);xOptions.abort=function(){!(done++)&&cleanUp();};if(callIfDefined(xOptions.beforeSend,xOptions,[xOptions])===!1||done){return xOptions;}url=url||STR_EMPTY;data=data?((typeof data)=="string"?data:$.param(data,xOptions.traditional)):STR_EMPTY;url+=data?(qMarkOrAmp(url)+data):STR_EMPTY;callbackParameter&&(url+=qMarkOrAmp(url)+encodeURIComponent(callbackParameter)+"=?");!cacheFlag&&!pageCacheFlag&&(url+=qMarkOrAmp(url)+"_"+(new Date()).getTime()+"=");url=url.replace(/=\?(&|$)/,"="+successCallbackName+"$1");function notifySuccess(json){if(!(done++)){cleanUp();pageCacheFlag&&(pageCache[url]={s:[json]});dataFilter&&(json=dataFilter.apply(xOptions,[json]));callIfDefined(successCallback,xOptions,[json,STR_SUCCESS,xOptions]);callIfDefined(completeCallback,xOptions,[xOptions,STR_SUCCESS])}}function notifyError(type){if(!(done++)){cleanUp();pageCacheFlag&&type!=STR_TIMEOUT&&(pageCache[url]=type);callIfDefined(errorCallback,xOptions,[xOptions,type]);callIfDefined(completeCallback,xOptions,[xOptions,type])}}if(pageCacheFlag&&(pageCached=pageCache[url])){pageCached.s?notifySuccess(pageCached.s[0]):notifyError(pageCached)}else{win[successCallbackName]=genericCallback;script=$(STR_SCRIPT_TAG)[0];script.id=STR_JQUERY_JSONP+count++;if(charset){script[STR_CHARSET]=charset}opera&&opera.version()<11.60?((scriptAfter=$(STR_SCRIPT_TAG)[0]).text="document.getElementById('"+script.id+"')."+STR_ON_ERROR+"()"):(script[STR_ASYNC]=STR_ASYNC);if(oldIE){script.htmlFor=script.id;script.event=STR_ON_CLICK}script[STR_ON_LOAD]=script[STR_ON_ERROR]=script[STR_ON_READY_STATE_CHANGE]=function(result){if(!script[STR_READY_STATE]||!/i/.test(script[STR_READY_STATE])){try{script[STR_ON_CLICK]&&script[STR_ON_CLICK]()}catch(_){}result=lastValue;lastValue=0;result?notifySuccess(result[0]):notifyError(STR_ERROR)}};script.src=url;cleanUp=function(i){timeoutTimer&&clearTimeout(timeoutTimer);script[STR_ON_READY_STATE_CHANGE]=script[STR_ON_LOAD]=script[STR_ON_ERROR]=null;head[STR_REMOVE_CHILD](script);scriptAfter&&head[STR_REMOVE_CHILD](scriptAfter)};head[STR_INSERT_BEFORE](script,(firstChild=head.firstChild));scriptAfter&&head[STR_INSERT_BEFORE](scriptAfter,firstChild);timeoutTimer=timeout>0&&setTimeout(function(){notifyError(STR_TIMEOUT)},timeout)}return xOptions}jsonp.setup=function(xOptions){$.extend(xOptionsDefaults,xOptions)};$.jsonp=jsonp})(jQuery);




/*
| -------------------------------------------------------------------
|  Jquery Watermark
| -------------------------------------------------------------------
| Script: jqTransfrom
| Version: Watermark v3.1.3 (March 22, 2011) plugin for jQuery
| Author: Copyright (c) 2009-2011 Todd Northrop
| Website: http://jquery-watermark.googlecode.com/
*/

	(function(a,h,y){var w="function",v="password",j="maxLength",n="type",b="",c=true,u="placeholder",i=false,t="watermark",g=t,f="watermarkClass",q="watermarkFocus",l="watermarkSubmit",o="watermarkMaxLength",e="watermarkPassword",d="watermarkText",k=/\r/g,s="input:data("+g+"),textarea:data("+g+")",m="input:text,input:password,input[type=search],input:not([type]),textarea",p=["Page_ClientValidate"],r=i,x=u in document.createElement("input");a.watermark=a.watermark||{version:"3.1.3",runOnce:c,options:{className:t,useNative:c,hideBeforeUnload:c},hide:function(b){a(b).filter(s).each(function(){a.watermark._hide(a(this))})},_hide:function(a,r){var p=a[0],q=(p.value||b).replace(k,b),l=a.data(d)||b,m=a.data(o)||0,i=a.data(f);if(l.length&&q==l){p.value=b;if(a.data(e))if((a.attr(n)||b)==="text"){var g=a.data(e)||[],c=a.parent()||[];if(g.length&&c.length){c[0].removeChild(a[0]);c[0].appendChild(g[0]);a=g}}if(m){a.attr(j,m);a.removeData(o)}if(r){a.attr("autocomplete","off");h.setTimeout(function(){a.select()},1)}}i&&a.removeClass(i)},show:function(b){a(b).filter(s).each(function(){a.watermark._show(a(this))})},_show:function(g){var p=g[0],u=(p.value||b).replace(k,b),h=g.data(d)||b,s=g.attr(n)||b,t=g.data(f);if((u.length==0||u==h)&&!g.data(q)){r=c;if(g.data(e))if(s===v){var m=g.data(e)||[],l=g.parent()||[];if(m.length&&l.length){l[0].removeChild(g[0]);l[0].appendChild(m[0]);g=m;g.attr(j,h.length);p=g[0]}}if(s==="text"||s==="search"){var i=g.attr(j)||0;if(i>0&&h.length>i){g.data(o,i);g.attr(j,h.length)}}t&&g.addClass(t);p.value=h}else a.watermark._hide(g)},hideAll:function(){if(r){a.watermark.hide(m);r=i}},showAll:function(){a.watermark.show(m)}};a.fn.watermark=a.fn.watermark||function(p,o){var t="string";if(!this.length)return this;var s=i,r=typeof p===t;if(r)p=p.replace(k,b);if(typeof o==="object"){s=typeof o.className===t;o=a.extend({},a.watermark.options,o)}else if(typeof o===t){s=c;o=a.extend({},a.watermark.options,{className:o})}else o=a.watermark.options;if(typeof o.useNative!==w)o.useNative=o.useNative?function(){return c}:function(){return i};return this.each(function(){var B="dragleave",A="dragenter",z=this,i=a(z);if(!i.is(m))return;if(i.data(g)){if(r||s){a.watermark._hide(i);r&&i.data(d,p);s&&i.data(f,o.className)}}else{if(x&&o.useNative.call(z,i)&&(i.attr("tagName")||b)!=="TEXTAREA"){r&&i.attr(u,p);return}i.data(d,r?p:b);i.data(f,o.className);i.data(g,1);if((i.attr(n)||b)===v){var C=i.wrap("<span>").parent(),t=a(C.html().replace(/type=["']?password["']?/i,'type="text"'));t.data(d,i.data(d));t.data(f,i.data(f));t.data(g,1);t.attr(j,p.length);t.focus(function(){a.watermark._hide(t,c)}).bind(A,function(){a.watermark._hide(t)}).bind("dragend",function(){h.setTimeout(function(){t.blur()},1)});i.blur(function(){a.watermark._show(i)}).bind(B,function(){a.watermark._show(i)});t.data(e,i);i.data(e,t)}else i.focus(function(){i.data(q,1);a.watermark._hide(i,c)}).blur(function(){i.data(q,0);a.watermark._show(i)}).bind(A,function(){a.watermark._hide(i)}).bind(B,function(){a.watermark._show(i)}).bind("dragend",function(){h.setTimeout(function(){a.watermark._show(i)},1)}).bind("drop",function(e){var c=i[0],a=e.originalEvent.dataTransfer.getData("Text");if((c.value||b).replace(k,b).replace(a,b)===i.data(d))c.value=a;i.focus()});if(z.form){var w=z.form,y=a(w);if(!y.data(l)){y.submit(a.watermark.hideAll);if(w.submit){y.data(l,w.submit);w.submit=function(c,b){return function(){var d=b.data(l);a.watermark.hideAll();if(d.apply)d.apply(c,Array.prototype.slice.call(arguments));else d()}}(w,y)}else{y.data(l,1);w.submit=function(b){return function(){a.watermark.hideAll();delete b.submit;b.submit()}}(w)}}}}a.watermark._show(i)})};if(a.watermark.runOnce){a.watermark.runOnce=i;a.extend(a.expr[":"],{data:function(c,d,b){return!!a.data(c,b[3])}});(function(c){a.fn.val=function(){var e=this;if(!e.length)return arguments.length?e:y;if(!arguments.length)if(e.data(g)){var f=(e[0].value||b).replace(k,b);return f===(e.data(d)||b)?b:f}else return c.apply(e,arguments);else{c.apply(e,arguments);a.watermark.show(e);return e}}})(a.fn.val);p.length&&a(function(){for(var b,c,d=p.length-1;d>=0;d--){b=p[d];c=h[b];if(typeof c===w)h[b]=function(b){return function(){a.watermark.hideAll();return b.apply(null,Array.prototype.slice.call(arguments))}}(c)}});a(h).bind("beforeunload",function(){a.watermark.options.hideBeforeUnload&&a.watermark.hideAll()})}})(jQuery,window);
	




/*
| -------------------------------------------------------------------
|  Jquery Gritter
| -------------------------------------------------------------------
| Script: Gritter
| Version: Gritter 1.7.1
| Author: Copyright (c) 2011 Jordan Boesch
| Website: http://www.boedesign.com/
*/

	(function($){$.gritter={};$.gritter.options={position:'',fade_in_speed:'medium',fade_out_speed:1000,time:8500}
$.gritter.add=function(params){try{return Gritter.add(params||{});}catch(e){var err='Gritter Error: '+e;(typeof(console)!='undefined'&&console.error)?console.error(err,params):alert(err);}}
$.gritter.remove=function(id,params){Gritter.removeSpecific(id,params||{});}
$.gritter.removeAll=function(params){Gritter.stop(params||{});}
var Gritter={position:'',fade_in_speed:'',fade_out_speed:'',time:'',_custom_timer:0,_item_count:0,_is_setup:0,_tpl_close:'<div class="gritter-close"></div>',_tpl_item:'<div id="gritter-item-[[number]]" class="gritter-item-wrapper [[item_class]]" style="display:none"><div class="gritter-top"></div><div class="gritter-item">[[image]]<div class="[[class_name]]"><span class="gritter-title">[[username]]</span><p>[[text]]</p></div><div style="clear:both"></div></div><div class="gritter-bottom"></div></div>',_tpl_wrap:'<div id="gritter-notice-wrapper"></div>',add:function(params){if(!params.title||!params.text){throw'You need to fill out the first 2 params: "title" and "text"';}
if(!this._is_setup){this._runSetup();}
var user=params.title,text=params.text,image=params.image||'',sticky=params.sticky||false,item_class=params.class_name||'',position=$.gritter.options.position,time_alive=params.time||'';this._verifyWrapper();this._item_count++;var number=this._item_count,tmp=this._tpl_item;$(['before_open','after_open','before_close','after_close']).each(function(i,val){Gritter['_'+val+'_'+number]=($.isFunction(params[val]))?params[val]:function(){}});this._custom_timer=0;if(time_alive){this._custom_timer=time_alive;}
var image_str=(image!='')?'<img src="'+image+'" class="gritter-image" />':'',class_name=(image!='')?'gritter-with-image':'gritter-without-image';tmp=this._str_replace(['[[username]]','[[text]]','[[image]]','[[number]]','[[class_name]]','[[item_class]]'],[user,text,image_str,this._item_count,class_name,item_class],tmp);this['_before_open_'+number]();$('#gritter-notice-wrapper').addClass(position).append(tmp);var item=$('#gritter-item-'+this._item_count);item.fadeIn(this.fade_in_speed,function(){Gritter['_after_open_'+number]($(this));});if(!sticky){this._setFadeTimer(item,number);}
$(item).bind('mouseenter mouseleave',function(event){if(event.type=='mouseenter'){if(!sticky){Gritter._restoreItemIfFading($(this),number);}}
else{if(!sticky){Gritter._setFadeTimer($(this),number);}}
Gritter._hoverState($(this),event.type);});return number;},_countRemoveWrapper:function(unique_id,e,manual_close){e.remove();this['_after_close_'+unique_id](e,manual_close);if($('.gritter-item-wrapper').length==0){$('#gritter-notice-wrapper').remove();}},_fade:function(e,unique_id,params,unbind_events){var params=params||{},fade=(typeof(params.fade)!='undefined')?params.fade:true;fade_out_speed=params.speed||this.fade_out_speed,manual_close=unbind_events;this['_before_close_'+unique_id](e,manual_close);if(unbind_events){e.unbind('mouseenter mouseleave');}
if(fade){e.animate({opacity:0},fade_out_speed,function(){e.animate({height:0},300,function(){Gritter._countRemoveWrapper(unique_id,e,manual_close);})})}
else{this._countRemoveWrapper(unique_id,e);}},_hoverState:function(e,type){if(type=='mouseenter'){e.addClass('hover');var find_img=e.find('img');(find_img.length)?find_img.before(this._tpl_close):e.find('span').before(this._tpl_close);e.find('.gritter-close').click(function(){var unique_id=e.attr('id').split('-')[2];Gritter.removeSpecific(unique_id,{},e,true);});}
else{e.removeClass('hover');e.find('.gritter-close').remove();}},removeSpecific:function(unique_id,params,e,unbind_events){if(!e){var e=$('#gritter-item-'+unique_id);}
this._fade(e,unique_id,params||{},unbind_events);},_restoreItemIfFading:function(e,unique_id){clearTimeout(this['_int_id_'+unique_id]);e.stop().css({opacity:''});},_runSetup:function(){for(opt in $.gritter.options){this[opt]=$.gritter.options[opt];}
this._is_setup=1;},_setFadeTimer:function(e,unique_id){var timer_str=(this._custom_timer)?this._custom_timer:this.time;this['_int_id_'+unique_id]=setTimeout(function(){Gritter._fade(e,unique_id);},timer_str);},stop:function(params){var before_close=($.isFunction(params.before_close))?params.before_close:function(){};var after_close=($.isFunction(params.after_close))?params.after_close:function(){};var wrap=$('#gritter-notice-wrapper');before_close(wrap);wrap.fadeOut(function(){$(this).remove();after_close();});},_str_replace:function(search,replace,subject,count){var i=0,j=0,temp='',repl='',sl=0,fl=0,f=[].concat(search),r=[].concat(replace),s=subject,ra=r instanceof Array,sa=s instanceof Array;s=[].concat(s);if(count){this.window[count]=0;}
for(i=0,sl=s.length;i<sl;i++){if(s[i]===''){continue;}
for(j=0,fl=f.length;j<fl;j++){temp=s[i]+'';repl=ra?(r[j]!==undefined?r[j]:''):r[0];s[i]=(temp).split(f[j]).join(repl);if(count&&s[i]!==temp){this.window[count]+=(temp.length-s[i].length)/f[j].length;}}}
return sa?s:s[0];},_verifyWrapper:function(){if($('#gritter-notice-wrapper').length==0){$('body').append(this._tpl_wrap);}}}})(jQuery);

	