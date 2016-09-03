// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

/*
 * @author  Mudit Ameta
 * @license https://github.com/zeusdeux/isInViewport/blob/master/license.md MIT
 */
!function(a,b){function c(b){var c,d=a("<div></div>").css({width:"100%"});return b.append(d),c=b.width()-d.width(),d.remove(),c}function d(e,f){var g=e.getBoundingClientRect(),h=g.top,i=g.bottom,j=g.left,k=g.right,l=a.extend({tolerance:0,viewport:b},f),m=!1,n=l.viewport.jquery?l.viewport:a(l.viewport);n.length||(console.warn("isInViewport: The viewport selector you have provided matches no element on page."),console.warn("isInViewport: Defaulting to viewport as window"),n=a(b));var o=n.height(),p=n.width(),q=n[0].toString();if(n[0]!==b&&"[object Window]"!==q&&"[object DOMWindow]"!==q){var r=n[0].getBoundingClientRect();h-=r.top,i-=r.top,j-=r.left,k-=r.left,d.scrollBarWidth=d.scrollBarWidth||c(n),p-=d.scrollBarWidth}return l.tolerance=~~Math.round(parseFloat(l.tolerance)),l.tolerance<0&&(l.tolerance=o+l.tolerance),0>=k||j>=p?m:m=l.tolerance?h<=l.tolerance&&i>=l.tolerance:i>0&&o>=h}String.prototype.hasOwnProperty("trim")||(String.prototype.trim=function(){return this.replace(/^\s*(.*?)\s*$/,"$1")});var e=function(b){if(1===arguments.length&&"function"==typeof b&&(b=[b]),!(b instanceof Array))throw new SyntaxError("isInViewport: Argument(s) passed to .do/.run should be a function or an array of functions");for(var c=0;c<b.length;c++)if("function"==typeof b[c])for(var d=0;d<this.length;d++)b[c].call(a(this[d]));else console.warn("isInViewport: Argument(s) passed to .do/.run should be a function or an array of functions"),console.warn("isInViewport: Ignoring non-function values in array and moving on");return this};a.fn["do"]=function(a){return console.warn("isInViewport: .do is deprecated as it causes issues in IE and some browsers since it's a reserved word. Use $.fn.run instead i.e., $(el).run(fn)."),e(a)},a.fn.run=e;var f=function(b){if(b){var c=b.split(",");return 1===c.length&&isNaN(c[0])&&(c[1]=c[0],c[0]=void 0),{tolerance:c[0]?c[0].trim():void 0,viewport:c[1]?a(c[1].trim()):void 0}}return{}};a.extend(a.expr[":"],{"in-viewport":a.expr.createPseudo?a.expr.createPseudo(function(a){return function(b){return d(b,f(a))}}):function(a,b,c){return d(a,f(c[3]))}}),a.fn.isInViewport=function(a){return this.filter(function(b,c){return d(c,a)})}}(jQuery,window);


// Sticky Plugin v1.0.4 for jQuery
// =============
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Created: 02/14/2011
// Date: 07/20/2015
// Website: http://stickyjs.com/
// Description: Makes an element on the page stick on the screen as you scroll
//              It will only set the 'top' and 'position' of your element, you
//              might need to adjust the width in some cases.
!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof module&&module.exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){var e=Array.prototype.slice,i=Array.prototype.splice,n={topSpacing:0,bottomSpacing:0,className:"is-sticky",wrapperClassName:"sticky-wrapper",center:!1,getWidthFrom:"",widthFromWrapper:!0,responsiveWidth:!1,zIndex:"auto"},r=t(window),s=t(document),o=[],c=r.height(),a=function(){for(var e=r.scrollTop(),i=s.height(),n=i-c,a=e>n?n-e:0,p=0,d=o.length;d>p;p++){var l=o[p],u=l.stickyWrapper.offset().top,h=u-l.topSpacing-a;if(l.stickyWrapper.css("height",l.stickyElement.outerHeight()),h>=e)null!==l.currentTop&&(l.stickyElement.css({width:"",position:"",top:"","z-index":""}),l.stickyElement.parent().removeClass(l.className),l.stickyElement.trigger("sticky-end",[l]),l.currentTop=null);else{var g=i-l.stickyElement.outerHeight()-l.topSpacing-l.bottomSpacing-e-a;if(0>g?g+=l.topSpacing:g=l.topSpacing,l.currentTop!==g){var m;l.getWidthFrom?m=t(l.getWidthFrom).width()||null:l.widthFromWrapper&&(m=l.stickyWrapper.width()),null==m&&(m=l.stickyElement.width()),l.stickyElement.css("width",m).css("position","fixed").css("top",g).css("z-index",l.zIndex),l.stickyElement.parent().addClass(l.className),null===l.currentTop?l.stickyElement.trigger("sticky-start",[l]):l.stickyElement.trigger("sticky-update",[l]),l.currentTop===l.topSpacing&&l.currentTop>g||null===l.currentTop&&g<l.topSpacing?l.stickyElement.trigger("sticky-bottom-reached",[l]):null!==l.currentTop&&g===l.topSpacing&&l.currentTop<g&&l.stickyElement.trigger("sticky-bottom-unreached",[l]),l.currentTop=g}var y=l.stickyWrapper.parent(),f=l.stickyElement.offset().top+l.stickyElement.outerHeight()>=y.offset().top+y.outerHeight()&&l.stickyElement.offset().top<=l.topSpacing;f?l.stickyElement.css("position","absolute").css("top","").css("bottom",0).css("z-index",""):l.stickyElement.css("position","fixed").css("top",g).css("bottom","").css("z-index",l.zIndex)}}},p=function(){c=r.height();for(var e=0,i=o.length;i>e;e++){var n=o[e],s=null;n.getWidthFrom?n.responsiveWidth&&(s=t(n.getWidthFrom).width()):n.widthFromWrapper&&(s=n.stickyWrapper.width()),null!=s&&n.stickyElement.css("width",s)}},d={init:function(e){var i=t.extend({},n,e);return this.each(function(){var e=t(this),r=e.attr("id"),s=r?r+"-"+n.wrapperClassName:n.wrapperClassName,c=t("<div></div>").attr("id",s).addClass(i.wrapperClassName);e.wrapAll(c);var a=e.parent();i.center&&a.css({width:e.outerWidth(),marginLeft:"auto",marginRight:"auto"}),"right"===e.css("float")&&e.css({"float":"none"}).parent().css({"float":"right"}),i.stickyElement=e,i.stickyWrapper=a,i.currentTop=null,o.push(i),d.setWrapperHeight(this),d.setupChangeListeners(this)})},setWrapperHeight:function(e){var i=t(e),n=i.parent();n&&n.css("height",i.outerHeight())},setupChangeListeners:function(t){if(window.MutationObserver){var e=new window.MutationObserver(function(e){(e[0].addedNodes.length||e[0].removedNodes.length)&&d.setWrapperHeight(t)});e.observe(t,{subtree:!0,childList:!0})}else t.addEventListener("DOMNodeInserted",function(){d.setWrapperHeight(t)},!1),t.addEventListener("DOMNodeRemoved",function(){d.setWrapperHeight(t)},!1)},update:a,unstick:function(e){return this.each(function(){for(var e=this,n=t(e),r=-1,s=o.length;s-- >0;)o[s].stickyElement.get(0)===e&&(i.call(o,s,1),r=s);-1!==r&&(n.unwrap(),n.css({width:"",position:"",top:"","float":"","z-index":""}))})}};window.addEventListener?(window.addEventListener("scroll",a,!1),window.addEventListener("resize",p,!1)):window.attachEvent&&(window.attachEvent("onscroll",a),window.attachEvent("onresize",p)),t.fn.sticky=function(i){return d[i]?d[i].apply(this,e.call(arguments,1)):"object"!=typeof i&&i?void t.error("Method "+i+" does not exist on jQuery.sticky"):d.init.apply(this,arguments)},t.fn.unstick=function(i){return d[i]?d[i].apply(this,e.call(arguments,1)):"object"!=typeof i&&i?void t.error("Method "+i+" does not exist on jQuery.sticky"):d.unstick.apply(this,arguments)},t(function(){setTimeout(a,0)})});



/**
 * Copyright (c) 2007-2015 Ariel Flesler - aflesler ○ gmail • com | http://flesler.blogspot.com
 * Licensed under MIT
 * @author Ariel Flesler
 * @version 2.1.3
 */
;(function(f){"use strict";"function"===typeof define&&define.amd?define(["jquery"],f):"undefined"!==typeof module&&module.exports?module.exports=f(require("jquery")):f(jQuery)})(function($){"use strict";function n(a){return!a.nodeName||-1!==$.inArray(a.nodeName.toLowerCase(),["iframe","#document","html","body"])}function h(a){return $.isFunction(a)||$.isPlainObject(a)?a:{top:a,left:a}}var p=$.scrollTo=function(a,d,b){return $(window).scrollTo(a,d,b)};p.defaults={axis:"xy",duration:0,limit:!0};$.fn.scrollTo=function(a,d,b){"object"=== typeof d&&(b=d,d=0);"function"===typeof b&&(b={onAfter:b});"max"===a&&(a=9E9);b=$.extend({},p.defaults,b);d=d||b.duration;var u=b.queue&&1<b.axis.length;u&&(d/=2);b.offset=h(b.offset);b.over=h(b.over);return this.each(function(){function k(a){var k=$.extend({},b,{queue:!0,duration:d,complete:a&&function(){a.call(q,e,b)}});r.animate(f,k)}if(null!==a){var l=n(this),q=l?this.contentWindow||window:this,r=$(q),e=a,f={},t;switch(typeof e){case "number":case "string":if(/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(e)){e= h(e);break}e=l?$(e):$(e,q);case "object":if(e.length===0)return;if(e.is||e.style)t=(e=$(e)).offset()}var v=$.isFunction(b.offset)&&b.offset(q,e)||b.offset;$.each(b.axis.split(""),function(a,c){var d="x"===c?"Left":"Top",m=d.toLowerCase(),g="scroll"+d,h=r[g](),n=p.max(q,c);t?(f[g]=t[m]+(l?0:h-r.offset()[m]),b.margin&&(f[g]-=parseInt(e.css("margin"+d),10)||0,f[g]-=parseInt(e.css("border"+d+"Width"),10)||0),f[g]+=v[m]||0,b.over[m]&&(f[g]+=e["x"===c?"width":"height"]()*b.over[m])):(d=e[m],f[g]=d.slice&& "%"===d.slice(-1)?parseFloat(d)/100*n:d);b.limit&&/^\d+$/.test(f[g])&&(f[g]=0>=f[g]?0:Math.min(f[g],n));!a&&1<b.axis.length&&(h===f[g]?f={}:u&&(k(b.onAfterFirst),f={}))});k(b.onAfter)}})};p.max=function(a,d){var b="x"===d?"Width":"Height",h="scroll"+b;if(!n(a))return a[h]-$(a)[b.toLowerCase()]();var b="client"+b,k=a.ownerDocument||a.document,l=k.documentElement,k=k.body;return Math.max(l[h],k[h])-Math.min(l[b],k[b])};$.Tween.propHooks.scrollLeft=$.Tween.propHooks.scrollTop={get:function(a){return $(a.elem)[a.prop]()}, set:function(a){var d=this.get(a);if(a.options.interrupt&&a._last&&a._last!==d)return $(a.elem).stop();var b=Math.round(a.now);d!==b&&($(a.elem)[a.prop](b),a._last=this.get(a))}};return p});
