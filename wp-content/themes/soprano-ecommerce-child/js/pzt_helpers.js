"use strict";var PZTJS={is_safari:/^((?!chrome|android).)*safari/i.test(navigator.userAgent),is_firefox:-1<navigator.userAgent.toLowerCase().indexOf("firefox"),is_chrome:/Chrome/.test(navigator.userAgent)&&/Google Inc/.test(navigator.vendor),is_ie10:-1!==navigator.appVersion.indexOf("MSIE 10"),transitionEnd:"transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd",animIteration:"animationiteration webkitAnimationIteration oAnimationIteration MSAnimationIteration",animationEnd:"animationend webkitAnimationEnd"};!function(){for(var a=0,n=["ms","moz","webkit","o"],i=0;i<n.length&&!window.requestAnimationFrame;++i)window.requestAnimationFrame=window[n[i]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[n[i]+"CancelAnimationFrame"]||window[n[i]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(n,i){var t=(new Date).getTime(),e=Math.max(0,16-(t-a)),o=window.setTimeout(function(){n(t+e)},e);return a=t+e,o}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(n){clearTimeout(n)})}(),function(n){PZTJS.transitionEnd={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd",msTransition:"MSTransitionEnd",transition:"transitionend"}[n.prefixed("transition")],PZTJS.animIteration={WebkitAnimation:"webkitAnimationIteration",MozAnimation:"animationiteration",OAnimation:"oAnimationIteration",msAnimation:"MSAnimationIteration",animation:"animationiteration"}[n.prefixed("animation")],PZTJS.animationEnd={WebkitAnimation:"webkitAnimationEnd",MozTAnimation:"animationend",animation:"animationend"}[n.prefixed("animation")]}(Modernizr),PZTJS.RAFit=function(n){var i=function(){n(),window.requestAnimationFrame(i)};i()},PZTJS.scrollRAF=function(i){var t=-1;PZTJS.RAFit(function(){var n=window.pageYOffset/document.body.clientHeight;t!==n&&(t=n,i())})},PZTJS.phpData=function(n,i){return void 0===i&&(i="translation not found"),"undefined"!=typeof PZT_PHP_DATA&&PZT_PHP_DATA.hasOwnProperty(n)?PZT_PHP_DATA[n]:i},PZTJS.isMobile=function(n){return n=n||navigator.userAgent,/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(n)},Date.now||(Date.now=function(){return(new Date).getTime()}),jQuery(document).ready(function(){jQuery(window).trigger("docready")}),jQuery.fn.pzt_shuffle=function(t){var e=jQuery,o=e(this);return o.each(function(){var n=e(this),i=e.throttle(300,function(){n.shuffle("update")});o.shuffle(t),o.find("img").each(function(){if(!this.complete||void 0===this.naturalWidth){var n=new Image;e(n).one("load",i),n.src=this.src}})}),e(window).one("load",function(){o.shuffle("update")}),this},PZTJS.isElementInViewport=function(n){"function"==typeof jQuery&&n instanceof jQuery&&(n=n[0]);for(var i=n.offsetTop,t=n.offsetLeft,e=n.offsetWidth,o=n.offsetHeight;n.offsetParent;)i+=(n=n.offsetParent).offsetTop,t+=n.offsetLeft;return i<window.pageYOffset+window.innerHeight&&t<window.pageXOffset+window.innerWidth&&i+o>window.pageYOffset&&t+e>window.pageXOffset};