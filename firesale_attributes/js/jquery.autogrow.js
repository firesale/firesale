/*
* Auto Expanding Text Area (1.2.2)
* by Chrys Bader (www.chrysbader.com)
* chrysb@gmail.com
*
* Special thanks to:
* Jake Chapa - jake@hybridstudio.com
* John Resig - jeresig@gmail.com
*
* Copyright (c) 2008 Chrys Bader (www.chrysbader.com)
* Licensed under the GPL (GPL-LICENSE.txt) license.
*
*
* NOTE: This script requires jQuery to work. Download jQuery at www.jquery.com
*
*/

(function(e){var t=function(){return this.each(function(){var e=this.cols;var t=this.rows;var n=function(){r(this)};var r=function(n){var r=0;var i=n.value.split("\n");for(var s=i.length-1;s>=0;--s){r+=Math.floor(i[s].length/e/2+1)}if(r>=t)n.rows=r+1;else n.rows=t};var i=function(e){var t=0;var n=0;var r=0;var i=e.cols;e.cols=1;n=e.offsetWidth;e.cols=2;r=e.offsetWidth;t=r-n;e.cols=i;return t};this.style.height="auto";this.style.overflow="hidden";this.onkeyup=n;this.onfocus=n;this.onblur=n;r(this)})};e.fn.autogrow=function(n){n=e.extend({vertical:true,horizontal:false},n);if(n.vertical&&!n.horizontal&&e.browser.msie&&e.browser.version<9)return t.apply(this,arguments);this.filter("textarea").each(function(){var t=e(this),r=t.height(),i=t.attr("maxHeight"),s=t.css("lineHeight"),o=typeof t.attr("minWidth")=="undefined"?0:t.attr("minWidth");if(typeof i=="undefined")i=1e6;var u=e('<div class="autogrow-shadow"></div>').css({position:"absolute",top:-1e4,left:-1e4,fontSize:t.css("fontSize"),fontFamily:t.css("fontFamily"),fontWeight:t.css("fontWeight"),lineHeight:t.css("lineHeight"),resize:"none"}).appendTo(document.body);var a=function(){var s=function(e,t){for(var n=0,r="";n<t;n++)r+=e;return r};var a=this.value;if(n.vertical)a=a.replace(/</g,"<").replace(/>/g,">").replace(/&/g,"&").replace(/\n$/,"<br/> ").replace(/\n/g,"<br/>").replace(/ {2,}/g,function(e){return s(" ",e.length-1)+" "});u.html(a).css("width","auto");if(n.horizontal){var f=n.maxWidth;if(typeof f=="undefined")f=t.parent().width()-12;e(this).css("width",Math.min(Math.max(u.width()+9,o),f))}if(n.vertical){u.css("width",e(this).width()-parseInt(t.css("paddingLeft"),10)-parseInt(t.css("paddingRight"),10));var l=u.height();var c=Math.min(Math.max(l,r),i);e(this).css("height",c);e(this).css("overflow",c==i?"auto":"hidden")}};e(this).change(a).keyup(a).keydown(a).bind("remove.autogrow",function(){u.remove()});a.apply(this)});return this}})(jQuery)