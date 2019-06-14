!function(o){"use strict";Date.now||(Date.now=function(){return(new Date).getTime()}),o.requestAnimationFrame||function(){for(var e=["webkit","moz"],t=0;t<e.length&&!o.requestAnimationFrame;++t){var i=e[t];o.requestAnimationFrame=o[i+"RequestAnimationFrame"],o.cancelAnimationFrame=o[i+"CancelAnimationFrame"]||o[i+"CancelRequestAnimationFrame"]}if(/iP(ad|hone|od).*OS 6/.test(o.navigator.userAgent)||!o.requestAnimationFrame||!o.cancelAnimationFrame){var n=0;o.requestAnimationFrame=function(e){var t=Date.now(),i=Math.max(n+16,t);return setTimeout(function(){e(n=i)},i-t)},o.cancelAnimationFrame=clearTimeout}}();var n=document.createElement("div");function e(e){var t=["O","Moz","ms","Ms","Webkit"],i=t.length;if(void 0!==n.style[e])return!0;for(e=e.charAt(0).toUpperCase()+e.substr(1);-1<--i&&void 0===n.style[t[i]+e];);return 0<=i}var y,v,a=e("transform"),r=e("perspective"),t=navigator.userAgent,l=-1<t.toLowerCase().indexOf("android"),s=/iPad|iPhone|iPod/.test(t)&&!o.MSStream,c=-1<t.toLowerCase().indexOf("firefox"),m=-1<t.indexOf("MSIE ")||-1<t.indexOf("Trident/")||-1<t.indexOf("Edge/"),p=document.all&&!o.atob;function u(){y=o.innerWidth||document.documentElement.clientWidth,v=o.innerHeight||document.documentElement.clientHeight}u();var d,g=[],f=(d=0,function(e,t){var i,n=this;if(n.$item=e,n.defaults={type:"scroll",speed:.5,imgSrc:null,imgWidth:null,imgHeight:null,elementInViewport:null,zIndex:-100,noAndroid:!1,noIos:!0,onScroll:null,onInit:null,onDestroy:null,onCoverImage:null},i=JSON.parse(n.$item.getAttribute("data-jarallax")||"{}"),n.options=n.extend({},n.defaults,i,t),!(!a||l&&n.options.noAndroid||s&&n.options.noIos)){n.options.speed=Math.min(2,Math.max(-1,parseFloat(n.options.speed)));var o=n.options.elementInViewport;o&&"object"==typeof o&&void 0!==o.length&&(o=o[0]),!o instanceof Element&&(o=null),n.options.elementInViewport=o,n.instanceID=d++,n.image={src:n.options.imgSrc||null,$container:null,$item:null,width:n.options.imgWidth||null,height:n.options.imgHeight||null,useImgTag:s||l||m,position:!r||c?"absolute":"fixed"},n.initImg()&&n.init()}});function i(e,t,i){e.addEventListener?e.addEventListener(t,i):e.attachEvent("on"+t,function(){i.call(e)})}function h(i){o.requestAnimationFrame(function(){"scroll"!==i.type&&u();for(var e=0,t=g.length;e<t;e++)"scroll"!==i.type&&(g[e].coverImage(),g[e].clipContainer()),g[e].onScroll()})}f.prototype.css=function(e,t){if("string"==typeof t)return o.getComputedStyle?o.getComputedStyle(e).getPropertyValue(t):e.style[t];for(var i in t.transform&&(r&&(t.transform+=" translateZ(0)"),t.WebkitTransform=t.MozTransform=t.msTransform=t.OTransform=t.transform),t)e.style[i]=t[i];return e},f.prototype.extend=function(e){e=e||{};for(var t=1;t<arguments.length;t++)if(arguments[t])for(var i in arguments[t])arguments[t].hasOwnProperty(i)&&(e[i]=arguments[t][i]);return e},f.prototype.initImg=function(){var e=this;return null===e.image.src&&(e.image.src=e.css(e.$item,"background-image").replace(/^url\(['"]?/g,"").replace(/['"]?\)$/g,"")),!(!e.image.src||"none"===e.image.src)},f.prototype.init=function(){var i=this,e={position:"absolute",top:0,left:0,width:"100%",height:"100%",overflow:"hidden",pointerEvents:"none"},t={};i.$item.setAttribute("data-jarallax-original-styles",i.$item.getAttribute("style")),"static"===i.css(i.$item,"position")&&i.css(i.$item,{position:"relative"}),"auto"===i.css(i.$item,"z-index")&&i.css(i.$item,{zIndex:0}),i.image.$container=document.createElement("div"),i.css(i.image.$container,e),i.css(i.image.$container,{visibility:"hidden","z-index":i.options.zIndex}),i.image.$container.setAttribute("id","jarallax-container-"+i.instanceID),i.$item.appendChild(i.image.$container),t=i.image.useImgTag?(i.image.$item=document.createElement("img"),i.image.$item.setAttribute("src",i.image.src),i.extend({"max-width":"none"},e,t)):(i.image.$item=document.createElement("div"),i.extend({"background-position":"50% 50%","background-size":"100% auto","background-repeat":"no-repeat no-repeat","background-image":'url("'+i.image.src+'")'},e,t));for(var n=0,o=i.$item;null!==o&&o!==document&&0===n;){var a=i.css(o,"-webkit-transform")||i.css(o,"-moz-transform")||i.css(o,"transform");a&&"none"!==a&&(n=1,i.css(i.image.$container,{transform:"translateX(0) translateY(0)"})),o=o.parentNode}function r(){i.coverImage(),i.clipContainer(),i.onScroll(!0),i.options.onInit&&i.options.onInit.call(i),setTimeout(function(){i.$item&&i.css(i.$item,{"background-image":"none","background-attachment":"scroll","background-size":"auto"})},0)}(n||"opacity"===i.options.type||"scale"===i.options.type||"scale-opacity"===i.options.type)&&(i.image.position="absolute"),t.position=i.image.position,i.css(i.image.$item,t),i.image.$container.appendChild(i.image.$item),i.image.width&&i.image.height?r():i.getImageSize(i.image.src,function(e,t){i.image.width=e,i.image.height=t,r()}),g.push(i)},f.prototype.destroy=function(){for(var e=this,t=0,i=g.length;t<i;t++)if(g[t].instanceID===e.instanceID){g.splice(t,1);break}var n=e.$item.getAttribute("data-jarallax-original-styles");for(var o in e.$item.removeAttribute("data-jarallax-original-styles"),"null"===n?e.$item.removeAttribute("style"):e.$item.setAttribute("style",n),e.$clipStyles&&e.$clipStyles.parentNode.removeChild(e.$clipStyles),e.image.$container.parentNode.removeChild(e.image.$container),e.options.onDestroy&&e.options.onDestroy.call(e),delete e.$item.jarallax,e)delete e[o]},f.prototype.getImageSize=function(e,t){if(e&&t){var i=new Image;i.onload=function(){t(i.width,i.height)},i.src=e}},f.prototype.clipContainer=function(){if(!p){var e=this,t=e.image.$container.getBoundingClientRect(),i=t.width,n=t.height;if(!e.$clipStyles)e.$clipStyles=document.createElement("style"),e.$clipStyles.setAttribute("type","text/css"),e.$clipStyles.setAttribute("id","#jarallax-clip-"+e.instanceID),(document.head||document.getElementsByTagName("head")[0]).appendChild(e.$clipStyles);var o=["#jarallax-container-"+e.instanceID+" {","   clip: rect(0 "+i+"px "+n+"px 0);","   clip: rect(0, "+i+"px, "+n+"px, 0);","}"].join("\n");e.$clipStyles.styleSheet?e.$clipStyles.styleSheet.cssText=o:e.$clipStyles.innerHTML=o}},f.prototype.coverImage=function(){var e=this;if(e.image.width&&e.image.height){var t=e.image.$container.getBoundingClientRect(),i=t.width,n=t.height,o=t.left,a=e.image.width,r=e.image.height,l=e.options.speed,s="scroll"===e.options.type||"scroll-opacity"===e.options.type,c=0,m=0,p=n,u=0,d=0;s&&(c=l<0?l*Math.max(n,v):l*(n+v),1<l?p=Math.abs(c-v):l<0?p=c/l+Math.abs(c):p+=Math.abs(v-n)*(1-l),c/=2),(m=p*a/r)<i&&(p=(m=i)*r/a),d=s?(u=o+(i-m)/2,(v-p)/2):(u=(i-m)/2,(n-p)/2),"absolute"===e.image.position&&(u-=o),e.parallaxScrollDistance=c,e.css(e.image.$item,{width:m+"px",height:p+"px",marginLeft:u+"px",marginTop:d+"px"}),e.options.onCoverImage&&e.options.onCoverImage.call(e)}},f.prototype.isVisible=function(){return this.isElementInViewport||!1},f.prototype.onScroll=function(e){var t=this;if(t.image.width&&t.image.height){var i=t.$item.getBoundingClientRect(),n=i.top,o=i.height,a={visibility:"visible",backgroundPosition:"50% 50%"},r=i;if(t.options.elementInViewport&&(r=t.options.elementInViewport.getBoundingClientRect()),t.isElementInViewport=0<=r.bottom&&0<=r.right&&r.top<=v&&r.left<=y,e||t.isElementInViewport){var l=Math.max(0,n),s=Math.max(0,o+n),c=Math.max(0,-n),m=Math.max(0,n+o-v),p=Math.max(0,o-(n+o-v)),u=Math.max(0,-n+v-o),d=1-2*(v-n)/(v+o),g=1;if(o<v?g=1-(c||m)/o:s<=v?g=s/v:p<=v&&(g=p/v),"opacity"!==t.options.type&&"scale-opacity"!==t.options.type&&"scroll-opacity"!==t.options.type||(a.transform="",a.opacity=g),"scale"===t.options.type||"scale-opacity"===t.options.type){var f=1;t.options.speed<0?f-=t.options.speed*g:f+=t.options.speed*(1-g),a.transform="scale("+f+")"}if("scroll"===t.options.type||"scroll-opacity"===t.options.type){var h=t.parallaxScrollDistance*d;"absolute"===t.image.position&&(h-=n),a.transform="translateY("+h+"px)"}t.css(t.image.$item,a),t.options.onScroll&&t.options.onScroll.call(t,{section:i,beforeTop:l,beforeTopEnd:s,afterTop:c,beforeBottom:m,beforeBottomEnd:p,afterBottom:u,visiblePercent:g,fromViewportCenter:d})}}},i(o,"scroll",h),i(o,"resize",h),i(o,"orientationchange",h),i(o,"load",h);var x=function(e){("object"==typeof HTMLElement?e instanceof HTMLElement:e&&"object"==typeof e&&null!==e&&1===e.nodeType&&"string"==typeof e.nodeName)&&(e=[e]);for(var t,i=arguments[1],n=Array.prototype.slice.call(arguments,2),o=e.length,a=0;a<o;a++)if("object"==typeof i||void 0===i?e[a].jarallax||(e[a].jarallax=new f(e[a],i)):e[a].jarallax&&(t=e[a].jarallax[i].apply(e[a].jarallax,n)),void 0!==t)return t;return e};x.constructor=f;var $=o.jarallax;if(o.jarallax=x,o.jarallax.noConflict=function(){return o.jarallax=$,this},"undefined"!=typeof jQuery){var b=function(){var e=arguments||[];Array.prototype.unshift.call(e,this);var t=x.apply(o,e);return"object"!=typeof t?t:this};b.constructor=f;var I=jQuery.fn.jarallax;jQuery.fn.jarallax=b,jQuery.fn.jarallax.noConflict=function(){return jQuery.fn.jarallax=I,this}}i(o,"DOMContentLoaded",function(){x(document.querySelectorAll("[data-jarallax], [data-jarallax-video]"))})}(window);