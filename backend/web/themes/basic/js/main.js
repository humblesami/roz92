var inrwrpH = ($(window).outerHeight() - $('.navbar').outerHeight());
		$('.panel-default').css('min-height',inrwrpH);

/*! WOW - v1.1.2 - 2015-08-19
* Copyright (c) 2015 Matthieu Aussaguel; Licensed MIT */(function(){var a,b,c,d,e,f=function(a,b){return function(){return a.apply(b,arguments)}},g=[].indexOf||function(a){for(var b=0,c=this.length;c>b;b++)if(b in this&&this[b]===a)return b;return-1};b=function(){function a(){}return a.prototype.extend=function(a,b){var c,d;for(c in b)d=b[c],null==a[c]&&(a[c]=d);return a},a.prototype.isMobile=function(a){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(a)},a.prototype.createEvent=function(a,b,c,d){var e;return null==b&&(b=!1),null==c&&(c=!1),null==d&&(d=null),null!=document.createEvent?(e=document.createEvent("CustomEvent"),e.initCustomEvent(a,b,c,d)):null!=document.createEventObject?(e=document.createEventObject(),e.eventType=a):e.eventName=a,e},a.prototype.emitEvent=function(a,b){return null!=a.dispatchEvent?a.dispatchEvent(b):b in(null!=a)?a[b]():"on"+b in(null!=a)?a["on"+b]():void 0},a.prototype.addEvent=function(a,b,c){return null!=a.addEventListener?a.addEventListener(b,c,!1):null!=a.attachEvent?a.attachEvent("on"+b,c):a[b]=c},a.prototype.removeEvent=function(a,b,c){return null!=a.removeEventListener?a.removeEventListener(b,c,!1):null!=a.detachEvent?a.detachEvent("on"+b,c):delete a[b]},a.prototype.innerHeight=function(){return"innerHeight"in window?window.innerHeight:document.documentElement.clientHeight},a}(),c=this.WeakMap||this.MozWeakMap||(c=function(){function a(){this.keys=[],this.values=[]}return a.prototype.get=function(a){var b,c,d,e,f;for(f=this.keys,b=d=0,e=f.length;e>d;b=++d)if(c=f[b],c===a)return this.values[b]},a.prototype.set=function(a,b){var c,d,e,f,g;for(g=this.keys,c=e=0,f=g.length;f>e;c=++e)if(d=g[c],d===a)return void(this.values[c]=b);return this.keys.push(a),this.values.push(b)},a}()),a=this.MutationObserver||this.WebkitMutationObserver||this.MozMutationObserver||(a=function(){function a(){"undefined"!=typeof console&&null!==console&&console.warn("MutationObserver is not supported by your browser."),"undefined"!=typeof console&&null!==console&&console.warn("WOW.js cannot detect dom mutations, please call .sync() after loading new content.")}return a.notSupported=!0,a.prototype.observe=function(){},a}()),d=this.getComputedStyle||function(a){return this.getPropertyValue=function(b){var c;return"float"===b&&(b="styleFloat"),e.test(b)&&b.replace(e,function(a,b){return b.toUpperCase()}),(null!=(c=a.currentStyle)?c[b]:void 0)||null},this},e=/(\-([a-z]){1})/g,this.WOW=function(){function e(a){null==a&&(a={}),this.scrollCallback=f(this.scrollCallback,this),this.scrollHandler=f(this.scrollHandler,this),this.resetAnimation=f(this.resetAnimation,this),this.start=f(this.start,this),this.scrolled=!0,this.config=this.util().extend(a,this.defaults),null!=a.scrollContainer&&(this.config.scrollContainer=document.querySelector(a.scrollContainer)),this.animationNameCache=new c,this.wowEvent=this.util().createEvent(this.config.boxClass)}return e.prototype.defaults={boxClass:"wow",animateClass:"animated",offset:0,mobile:!0,live:!0,callback:null,scrollContainer:null},e.prototype.init=function(){var a;return this.element=window.document.documentElement,"interactive"===(a=document.readyState)||"complete"===a?this.start():this.util().addEvent(document,"DOMContentLoaded",this.start),this.finished=[]},e.prototype.start=function(){var b,c,d,e;if(this.stopped=!1,this.boxes=function(){var a,c,d,e;for(d=this.element.querySelectorAll("."+this.config.boxClass),e=[],a=0,c=d.length;c>a;a++)b=d[a],e.push(b);return e}.call(this),this.all=function(){var a,c,d,e;for(d=this.boxes,e=[],a=0,c=d.length;c>a;a++)b=d[a],e.push(b);return e}.call(this),this.boxes.length)if(this.disabled())this.resetStyle();else for(e=this.boxes,c=0,d=e.length;d>c;c++)b=e[c],this.applyStyle(b,!0);return this.disabled()||(this.util().addEvent(this.config.scrollContainer||window,"scroll",this.scrollHandler),this.util().addEvent(window,"resize",this.scrollHandler),this.interval=setInterval(this.scrollCallback,50)),this.config.live?new a(function(a){return function(b){var c,d,e,f,g;for(g=[],c=0,d=b.length;d>c;c++)f=b[c],g.push(function(){var a,b,c,d;for(c=f.addedNodes||[],d=[],a=0,b=c.length;b>a;a++)e=c[a],d.push(this.doSync(e));return d}.call(a));return g}}(this)).observe(document.body,{childList:!0,subtree:!0}):void 0},e.prototype.stop=function(){return this.stopped=!0,this.util().removeEvent(this.config.scrollContainer||window,"scroll",this.scrollHandler),this.util().removeEvent(window,"resize",this.scrollHandler),null!=this.interval?clearInterval(this.interval):void 0},e.prototype.sync=function(){return a.notSupported?this.doSync(this.element):void 0},e.prototype.doSync=function(a){var b,c,d,e,f;if(null==a&&(a=this.element),1===a.nodeType){for(a=a.parentNode||a,e=a.querySelectorAll("."+this.config.boxClass),f=[],c=0,d=e.length;d>c;c++)b=e[c],g.call(this.all,b)<0?(this.boxes.push(b),this.all.push(b),this.stopped||this.disabled()?this.resetStyle():this.applyStyle(b,!0),f.push(this.scrolled=!0)):f.push(void 0);return f}},e.prototype.show=function(a){return this.applyStyle(a),a.className=a.className+" "+this.config.animateClass,null!=this.config.callback&&this.config.callback(a),this.util().emitEvent(a,this.wowEvent),this.util().addEvent(a,"animationend",this.resetAnimation),this.util().addEvent(a,"oanimationend",this.resetAnimation),this.util().addEvent(a,"webkitAnimationEnd",this.resetAnimation),this.util().addEvent(a,"MSAnimationEnd",this.resetAnimation),a},e.prototype.applyStyle=function(a,b){var c,d,e;return d=a.getAttribute("data-wow-duration"),c=a.getAttribute("data-wow-delay"),e=a.getAttribute("data-wow-iteration"),this.animate(function(f){return function(){return f.customStyle(a,b,d,c,e)}}(this))},e.prototype.animate=function(){return"requestAnimationFrame"in window?function(a){return window.requestAnimationFrame(a)}:function(a){return a()}}(),e.prototype.resetStyle=function(){var a,b,c,d,e;for(d=this.boxes,e=[],b=0,c=d.length;c>b;b++)a=d[b],e.push(a.style.visibility="visible");return e},e.prototype.resetAnimation=function(a){var b;return a.type.toLowerCase().indexOf("animationend")>=0?(b=a.target||a.srcElement,b.className=b.className.replace(this.config.animateClass,"").trim()):void 0},e.prototype.customStyle=function(a,b,c,d,e){return b&&this.cacheAnimationName(a),a.style.visibility=b?"hidden":"visible",c&&this.vendorSet(a.style,{animationDuration:c}),d&&this.vendorSet(a.style,{animationDelay:d}),e&&this.vendorSet(a.style,{animationIterationCount:e}),this.vendorSet(a.style,{animationName:b?"none":this.cachedAnimationName(a)}),a},e.prototype.vendors=["moz","webkit"],e.prototype.vendorSet=function(a,b){var c,d,e,f;d=[];for(c in b)e=b[c],a[""+c]=e,d.push(function(){var b,d,g,h;for(g=this.vendors,h=[],b=0,d=g.length;d>b;b++)f=g[b],h.push(a[""+f+c.charAt(0).toUpperCase()+c.substr(1)]=e);return h}.call(this));return d},e.prototype.vendorCSS=function(a,b){var c,e,f,g,h,i;for(h=d(a),g=h.getPropertyCSSValue(b),f=this.vendors,c=0,e=f.length;e>c;c++)i=f[c],g=g||h.getPropertyCSSValue("-"+i+"-"+b);return g},e.prototype.animationName=function(a){var b;try{b=this.vendorCSS(a,"animation-name").cssText}catch(c){b=d(a).getPropertyValue("animation-name")}return"none"===b?"":b},e.prototype.cacheAnimationName=function(a){return this.animationNameCache.set(a,this.animationName(a))},e.prototype.cachedAnimationName=function(a){return this.animationNameCache.get(a)},e.prototype.scrollHandler=function(){return this.scrolled=!0},e.prototype.scrollCallback=function(){var a;return!this.scrolled||(this.scrolled=!1,this.boxes=function(){var b,c,d,e;for(d=this.boxes,e=[],b=0,c=d.length;c>b;b++)a=d[b],a&&(this.isVisible(a)?this.show(a):e.push(a));return e}.call(this),this.boxes.length||this.config.live)?void 0:this.stop()},e.prototype.offsetTop=function(a){for(var b;void 0===a.offsetTop;)a=a.parentNode;for(b=a.offsetTop;a=a.offsetParent;)b+=a.offsetTop;return b},e.prototype.isVisible=function(a){var b,c,d,e,f;return c=a.getAttribute("data-wow-offset")||this.config.offset,f=this.config.scrollContainer&&this.config.scrollContainer.scrollTop||window.pageYOffset,e=f+Math.min(this.element.clientHeight,this.util().innerHeight())-c,d=this.offsetTop(a),b=d+a.clientHeight,e>=d&&b>=f},e.prototype.util=function(){return null!=this._util?this._util:this._util=new b},e.prototype.disabled=function(){return!this.config.mobile&&this.util().isMobile(navigator.userAgent)},e}()}).call(this);



// global variables
var isIE8 = false;
var isIE9 = false;
var $windowWidth;
var $windowHeight;
var $pageArea;
// Debounce Function
(function ($, sr) {
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
        var timeout;
        return function debounced() {
            var obj = this,
                args = arguments;

            function delayed() {
                if (!execAsap)
                    func.apply(obj, args);
                timeout = null;
            };

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 100);
        };
    };
    // smartresize
    jQuery.fn[sr] = function (fn) {
        return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
    };

})(jQuery, 'clipresize');



//Main Function
var Main = function () {
    //function to detect explorer browser and its version
    var runInit = function () {
        if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)) {
            var ieversion = new Number(RegExp.$1);
            if (ieversion == 8) {
                isIE8 = true;
            } else if (ieversion == 9) {
                isIE9 = true;
            }
        }
    };
	
	$(".menu-employee li").eq(0).addClass("active");
	$("li:last-child").addClass('last');
	$("li:first-child").addClass('first');

    //function to adjust the template elements based on the window size
    var runElementsPosition = function () {
        $windowWidth = $(window).width();
        $windowHeight = $(window).height();
        $pageArea = $windowHeight - $('body > .navbar').outerHeight() - $('body > .footer').outerHeight();
        $('.sidebar-search input').removeAttr('style').removeClass('open');
        runContainerHeight();

    };
    //function to adapt the Main Content height to the Main Navigation height
    var runContainerHeight = function () {
        mainContainer = $('.main-content > .containerr');
        mainNavigation = $('.main-navigation');
        if ($pageArea < 760) {
            $pageArea = 760;
        }
        if (mainContainer.outerHeight() < mainNavigation.outerHeight() && mainNavigation.outerHeight() > $pageArea) {
            mainContainer.css('min-height', mainNavigation.outerHeight());
        } else {
            mainContainer.css('min-height', $pageArea);
        };
        if ($windowWidth < 768) {
            mainNavigation.css('min-height', $windowHeight - $('body > .navbar').outerHeight());
        }
    };
	

    //function to activate the ToDo list, if present
    var runToDoAction = function () {
        if ($(".todo-actions").length) {
            $(".todo-actions").click(function () {
                if ($(this).find("i").hasClass("fa-square-o") || $(this).find("i").hasClass("icon-check-empty")) {
                    if ($(this).find("i").hasClass("fa")) {
                        $(this).find("i").removeClass("fa-square-o").addClass("fa-check-square-o");
                    } else {
                        $(this).find("i").removeClass("icon-check-empty").addClass("fa fa-check-square-o");
                    };
                    $(this).parent().find("span").css({
                        opacity: .25
                    });
                    $(this).parent().find(".desc").css("text-decoration", "line-through");
                } else {
                    $(this).find("i").removeClass("fa-check-square-o").addClass("fa-square-o");
                    $(this).parent().find("span").css({
                        opacity: 1
                    });
                    $(this).parent().find(".desc").css("text-decoration", "none");
                }
                return !1;
            });
        }
    };
    //function to activate the Tooltips, if present
    var runTooltips = function () {
        if ($(".tooltips").length) {
            $('.tooltips').tooltip();
        }
    };
    //function to activate the Popovers, if present
    var runPopovers = function () {
        if ($(".popovers").length) {
            $('.popovers').popover();
        }
    };
    //function to allow a button or a link to open a tab
    var runShowTab = function () {
        if ($(".show-tab").length) {
            $('.show-tab').bind('click', function (e) {
                e.preventDefault();
                var tabToShow = $(this).attr("href");
                if ($(tabToShow).length) {
                    $('a[href="' + tabToShow + '"]').tab('show');
                }
            });
        };
        if (getParameterByName('tabId').length) {
            $('a[href="#' + getParameterByName('tabId') + '"]').tab('show');
        }
    };
    var runPanelScroll = function () {
        if ($(".panel-scroll").length) {
            $('.panel-scroll').perfectScrollbar({
                wheelSpeed: 50,
                minScrollbarLength: 20,
                suppressScrollX: true
            });
        }
    };
    //function to extend the default settings of the Accordion
    var runAccordionFeatures = function () {
        if ($('.accordion').length) {
            $('.accordion .panel-collapse').each(function () {
                if (!$(this).hasClass('in')) {
                    $(this).prev('.panel-heading').find('.accordion-toggle').addClass('collapsed');
                }
            });
        }
        $(".accordion").collapse().height('auto');
        var lastClicked;

        $('.accordion .accordion-toggle').bind('click', function () {
            currentTab = $(this);
            $('html,body').animate({
                scrollTop: currentTab.offset().top - 100
            }, 1000);
        });
    };
    //function to reduce the size of the Main Menu
    var runNavigationToggler = function () {
        $('.navigation-toggler').bind('click', function () {
            if (!$('body').hasClass('navigation-small')) {
                $('body').addClass('navigation-small');
            } else {
                $('body').removeClass('navigation-small');
            };
        });
    };
    //function to activate the panel tools
    var runModuleTools = function () {
        $('.panel-tools .panel-expand').bind('click', function (e) {
            $('.panel-tools a').not(this).hide();
            $('body').append('<div class="full-white-backdrop"></div>');
            $('.main-container').removeAttr('style');
            backdrop = $('.full-white-backdrop');
            wbox = $(this).parents('.panel');
            wbox.removeAttr('style');
            if (wbox.hasClass('panel-full-screen')) {
                backdrop.fadeIn(200, function () {
                    $('.panel-tools a').show();
                    wbox.removeClass('panel-full-screen');
                    backdrop.fadeOut(200, function () {
                        backdrop.remove();
                    });
                });
            } else {
                $('body').append('<div class="full-white-backdrop"></div>');
                backdrop.fadeIn(200, function () {
                    $('.main-container').css({
                        'max-height': $(window).outerHeight() - $('header').outerHeight() - $('.footer').outerHeight() - 100,
                        'overflow': 'hidden'
                    });
                    backdrop.fadeOut(200);
                    backdrop.remove();
                    wbox.addClass('panel-full-screen').css({
                        'max-height': $(window).height(),
                        'overflow': 'auto'
                    });
                });
            }
        });
        $('.panel-tools .panel-close').bind('click', function (e) {
            $(this).parents(".panel").remove();
            e.preventDefault();
        });
        $('.panel-tools .panel-refresh').bind('click', function (e) {
            var el = $(this).parents(".panel");
            el.block({
                overlayCSS: {
                    backgroundColor: '#fff'
                },
                message: '<img src="assets/images/loading.gif" /> Just a moment...',
                css: {
                    border: 'none',
                    color: '#333',
                    background: 'none'
                }
            });
            window.setTimeout(function () {
                el.unblock();
            }, 1000);
            e.preventDefault();
        });
		
        $('.panel-tools .panel-collapse').bind('click', function (e) {
            e.preventDefault();
            var el = jQuery(this).parent().closest(".panel").children(".panel-body");
            if ($(this).hasClass("collapses")) {
                $(this).addClass("expand").removeClass("collapses");
                el.slideUp(200);
            } else {
                $(this).addClass("collapses").removeClass("expand");
				el.slideDown(200);
            }
        });
		
    };
    //function to activate the 3rd and 4th level menus
    var runNavigationMenu = function () {
        $('.main-navigation-menu li.active').addClass('open');
        $('.main-navigation-menu > li a').bind('click', function () {
            if ($(this).parent().children('ul').hasClass('sub-menu') && ((!$('body').hasClass('navigation-small') || $windowWidth < 767) || !$(this).parent().parent().hasClass('main-navigation-menu'))) {
                if (!$(this).parent().hasClass('open')) {
                    $(this).parent().addClass('open');
                    $(this).parent().parent().children('li.open').not($(this).parent()).not($('.main-navigation-menu > li.active')).removeClass('open').children('ul').slideUp(200);
                    $(this).parent().children('ul').slideDown(200, function () {
                        runContainerHeight();
                    });
                } else {
                    if (!$(this).parent().hasClass('active')) {
                        $(this).parent().parent().children('li.open').not($('.main-navigation-menu > li.active')).removeClass('open').children('ul').slideUp(200, function () {
                            runContainerHeight();
                        });
                    } else {
                        $(this).parent().parent().children('li.open').removeClass('open').children('ul').slideUp(200, function () {
                            runContainerHeight();
                        });
                    }
                }
            }
        });
    };
    //function to activate the Go-Top button
    var runGoTop = function () {
        $('.go-top').bind('click', function (e) {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            e.preventDefault();
        });
    };
    //function to avoid closing the dropdown on click
    var runDropdownEnduring = function () {
        if ($('.dropdown-menu.dropdown-enduring').length) {
            $('.dropdown-menu.dropdown-enduring').click(function (event) {
                event.stopPropagation();
            });
        }
    };
    //function to return the querystring parameter with a given name.
    var getParameterByName = function (name) {
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    };
    //function to activate the iCheck Plugin
    var runCustomCheck = function () {
        if ($('input[type="checkbox"]').length || $('input[type="radio"]').length) {
            $('input[type="checkbox"].grey, input[type="radio"].grey').iCheck({
                checkboxClass: 'icheckbox_minimal-grey',
                radioClass: 'iradio_minimal-grey',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].red, input[type="radio"].red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].green, input[type="radio"].green').iCheck({
                checkboxClass: 'icheckbox_minimal-green',
                radioClass: 'iradio_minimal-green',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].teal, input[type="radio"].teal').iCheck({
                checkboxClass: 'icheckbox_minimal-aero',
                radioClass: 'iradio_minimal-aero',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].orange, input[type="radio"].orange').iCheck({
                checkboxClass: 'icheckbox_minimal-orange',
                radioClass: 'iradio_minimal-orange',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].purple, input[type="radio"].purple').iCheck({
                checkboxClass: 'icheckbox_minimal-purple',
                radioClass: 'iradio_minimal-purple',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].yellow, input[type="radio"].yellow').iCheck({
                checkboxClass: 'icheckbox_minimal-yellow',
                radioClass: 'iradio_minimal-yellow',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-black, input[type="radio"].square-black').iCheck({
                checkboxClass: 'icheckbox_square',
                radioClass: 'iradio_square',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-grey, input[type="radio"].square-grey').iCheck({
                checkboxClass: 'icheckbox_square-grey',
                radioClass: 'iradio_square-grey',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-red, input[type="radio"].square-red').iCheck({
                checkboxClass: 'icheckbox_square-red',
                radioClass: 'iradio_square-red',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-green, input[type="radio"].square-green').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-teal, input[type="radio"].square-teal').iCheck({
                checkboxClass: 'icheckbox_square-aero',
                radioClass: 'iradio_square-aero',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-orange, input[type="radio"].square-orange').iCheck({
                checkboxClass: 'icheckbox_square-orange',
                radioClass: 'iradio_square-orange',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-purple, input[type="radio"].square-purple').iCheck({
                checkboxClass: 'icheckbox_square-purple',
                radioClass: 'iradio_square-purple',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].square-yellow, input[type="radio"].square-yellow').iCheck({
                checkboxClass: 'icheckbox_square-yellow',
                radioClass: 'iradio_square-yellow',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-black, input[type="radio"].flat-black').iCheck({
                checkboxClass: 'icheckbox_flat',
                radioClass: 'iradio_flat',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-red',
                radioClass: 'iradio_flat-red',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-green, input[type="radio"].flat-green').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-teal, input[type="radio"].flat-teal').iCheck({
                checkboxClass: 'icheckbox_flat-aero',
                radioClass: 'iradio_flat-aero',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-orange, input[type="radio"].flat-orange').iCheck({
                checkboxClass: 'icheckbox_flat-orange',
                radioClass: 'iradio_flat-orange',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-purple, input[type="radio"].flat-purple').iCheck({
                checkboxClass: 'icheckbox_flat-purple',
                radioClass: 'iradio_flat-purple',
                increaseArea: '10%' // optional
            });
            $('input[type="checkbox"].flat-yellow, input[type="radio"].flat-yellow').iCheck({
                checkboxClass: 'icheckbox_flat-yellow',
                radioClass: 'iradio_flat-yellow',
                increaseArea: '10%' // optional
            });
        };
    };
    //Search Input function
    var runSearchInput = function () {
        var search_input = $('.sidebar-search input');
        var search_button = $('.sidebar-search button');
        var search_form = $('.sidebar-search');
        search_input.attr('data-default', $(search_input).outerWidth()).focus(function () {
            $(this).animate({
                width: 200
            }, 200);
        }).blur(function () {
            if ($(this).val() == "") {
                if ($(this).hasClass('open')) {
                    $(this).animate({
                        width: 0,
                        opacity: 0
                    }, 200, function () {
                        $(this).hide();
                    });
                } else {
                    $(this).animate({
                        width: $(this).attr('data-default')
                    }, 200);
                }
            }
        });
        search_button.bind('click', function () {
            if ($(search_input).is(':hidden')) {
                $(search_input).addClass('open').css({
                    width: 0,
                    opacity: 0
                }).show().animate({
                    width: 200,
                    opacity: 1
                }, 200).focus();
            } else if ($(search_input).hasClass('open') && $(search_input).val() == '') {
                $(search_input).removeClass('open').animate({
                    width: 0,
                    opacity: 0
                }, 200, function () {
                    $(this).hide();
                });
            } else if ($(search_input).val() != '') {
                return;
            } else
                $(search_input).focus();
            return false;
        });
    };
    //Set of functions for Style Selector
    var runStyleSelector = function () {
        $('.style-toggle').bind('click', function () {
            if ($(this).hasClass('open')) {
                $(this).removeClass('open').addClass('close');
                $('#style_selector_container').hide();
            } else {
                $(this).removeClass('close').addClass('open');
                $('#style_selector_container').show();
            }
        });
        setColorScheme();
        setLayoutStyle();
        setHeaderStyle();
        setFooterStyle();
        setBoxedBackgrounds();
    };
/*    $('.drop-down-wrapper').perfectScrollbar({
        wheelSpeed: 50,
        minScrollbarLength: 20,
        suppressScrollX: true
    });*/
    $('.navbar-tools .dropdown').on('shown.bs.dropdown', function () {
        $(this).find('.drop-down-wrapper').scrollTop(0).perfectScrollbar('update');
    });
    var setColorScheme = function () {
        $('.icons-color a').bind('click', function () {
            $('.icons-color img').each(function () {
                $(this).removeClass('active');
            });
            $(this).find('img').addClass('active');
            if ($('#skin_color').attr("rel") == "stylesheet/less") {
                $('#skin_color').next('style').remove();
                $('#skin_color').attr("rel", "stylesheet");

            }
            $('#skin_color').attr("href", "assets/css/theme_" + $(this).attr('id') + ".css");

        });
    };
    var setBoxedBackgrounds = function () {
        $('.boxed-patterns a').bind('click', function () {
            if ($('body').hasClass('layout-boxed')) {
                var classes = $('body').attr("class").split(" ").filter(function (item) {
                    return item.indexOf("bg_style_") === -1 ? item : "";
                });
                $('body').attr("class", classes.join(" "));
                $('.boxed-patterns img').each(function () {
                    $(this).removeClass('active');
                });
                $(this).find('img').addClass('active');
                $('body').addClass($(this).attr('id'));
            } else {
                alert('Select boxed layout');
            }
        });
    };
    var setLayoutStyle = function () {
        $('select[name="layout"]').change(function () {
            if ($('select[name="layout"] option:selected').val() == 'boxed')
                $('body').addClass('layout-boxed');
            else
                $('body').removeClass('layout-boxed');
        });
    };
    var setHeaderStyle = function () {
        $('select[name="header"]').change(function () {
            if ($('select[name="header"] option:selected').val() == 'default')
                $('body').addClass('header-default');
            else
                $('body').removeClass('header-default');
        });
    };
    var setFooterStyle = function () {
        $('select[name="footer"]').change(function () {
            if ($('select[name="footer"] option:selected').val() == 'fixed')
                $('body').addClass('footer-fixed');
            else
                $('body').removeClass('footer-fixed');
        });
    };
    var runColorPalette = function () {
        if ($('.colorpalette').length) {
            $('.colorpalette').colorPalette().on('selectColor', function (e) {
                $(this).closest('ul').prev('a').children('i').css('background-color', e.color).end().closest('div').prev('input').val(e.color);
                runActivateLess();
            });
        };
    };

    //function to activate Less style
    var runActivateLess = function () {
        $('		.icons-color img').removeClass('active');
        if ($('#skin_color').attr("rel") == "stylesheet") {
            $('#skin_color').attr("rel", "stylesheet/less").attr("href", "assets/less/styles.less");
            less.sheets.push($('link#skin_color')[0]);
            less.refresh();
        };
        less.modifyVars({
            '@base': $('.color-base').val(),
            '@text': $('.color-text').val(),
            '@badge': $('.color-badge').val()
        });
    };

    //Window Resize Function
    var runWIndowResize = function (func, threshold, execAsap) {
        //wait until the user is done resizing the window, then execute
        $(window).clipresize(function () {
            runElementsPosition();
        });
    };
    //function to save user settings
    var runSaveSetting = function () {
        $('.save_style').bind('click', function () {
            var clipSetting = new Object;
            if ($('body').hasClass('rtl')) {
                clipSetting.rtl = true;
            } else {
                clipSetting.rtl = false;
            };
            if ($('body').hasClass('layout-boxed')) {
                clipSetting.layoutBoxed = true;
                $("body[class]").filter(function () {
                    var classNames = this.className.split(/\s+/);
                    for (var i = 0; i < classNames.length; ++i) {
                        if (classNames[i].substr(0, 9) === "bg_style_") {
                            clipSetting.bgStyle = classNames[i];
                        }
                    }

                });
            } else {
                clipSetting.layoutBoxed = false;
            };
            if ($('body').hasClass('header-default')) {
                clipSetting.headerDefault = true;
            } else {
                clipSetting.headerDefault = false;
            };
            if ($('body').hasClass('footer-fixed')) {
                clipSetting.footerDefault = false;
            } else {
                clipSetting.footerDefault = true;
            };
            if ($('#skin_color').attr('rel') == 'stylesheet') {
                clipSetting.useLess = false;
            } else if ($('#skin_color').attr('rel') == 'stylesheet/less') {
                clipSetting.useLess = true;
                clipSetting.baseColor = $('.color-base').val();
                clipSetting.textColor = $('.color-text').val();
                clipSetting.badgeColor = $('.color-badge').val();
            };
            clipSetting.skinClass = $('#skin_color').attr('href');

            $.cookie("clip-setting", JSON.stringify(clipSetting));

            var el = $('#style_selector_container');
            el.block({
                overlayCSS: {
                    backgroundColor: '#fff'
                },
                message: '<img src="assets/images/loading.gif" /> Just a moment...',
                css: {
                    border: 'none',
                    color: '#333',
                    background: 'none'
                }
            });
            window.setTimeout(function () {
                el.unblock();
            }, 1000);
        });
    };
    //function to load user settings
    var runCustomSetting = function () {
        if ($.cookie("clip-setting")) {
            var loadSetting = jQuery.parseJSON($.cookie("clip-setting"));
            if (loadSetting.layoutBoxed) {

                $('body').addClass('layout-boxed');
                $('#style_selector select[name="layout"]').find('option[value="boxed"]').attr('selected', 'true');
            };
            if (loadSetting.headerDefault) {
                $('body').addClass('header-default');
                $('#style_selector select[name="header"]').find('option[value="default"]').attr('selected', 'true');
            };
            if (!loadSetting.footerDefault) {
                $('body').addClass('footer-fixed');
                $('#style_selector select[name="footer"]').find('option[value="fixed"]').attr('selected', 'true');
            };
            if ($('#style_selector').length) {
                if (loadSetting.useLess) {

                    $('.color-base').val(loadSetting.baseColor).next('.dropdown').find('i').css('background-color', loadSetting.baseColor);
                    $('.color-text').val(loadSetting.textColor).next('.dropdown').find('i').css('background-color', loadSetting.textColor);
                    $('.color-badge').val(loadSetting.badgeColor).next('.dropdown').find('i').css('background-color', loadSetting.badgeColor);
                    runActivateLess();
                } else {
                    $('.color-base').val('#FFFFFF').next('.dropdown').find('i').css('background-color', '#FFFFFF');
                    $('.color-text').val('#555555').next('.dropdown').find('i').css('background-color', '#555555');
                    $('.color-badge').val('#007AFF').next('.dropdown').find('i').css('background-color', '#007AFF');
                    $('#skin_color').attr('href', loadSetting.skinClass);
                };
            };
            $('body').addClass(loadSetting.bgStyle);
        } else {
            runDefaultSetting();
        };
    };

	
    //function to clear user settings
    var runClearSetting = function () {
        $('.clear_style').bind('click', function () {
            $.removeCookie("clip-setting");
            $('body').removeClass("layout-boxed header-default footer-fixed");
            $('body')[0].className = $('body')[0].className.replace(/\bbg_style_.*?\b/g, '');
            if ($('#skin_color').attr("rel") == "stylesheet/less") {
                $('#skin_color').next('style').remove();
                $('#skin_color').attr("rel", "stylesheet");

            }

            $('.icons-color img').first().trigger('click');
            runDefaultSetting();
        });
    };
    //function to restore user settings
    var runDefaultSetting = function () {
        $('#style_selector select[name="layout"]').val('default');
        $('#style_selector select[name="header"]').val('fixed');
        $('#style_selector select[name="footer"]').val('default');
        $('.boxed-patterns img').removeClass('active');
        $('.color-base').val('#FFFFFF').next('.dropdown').find('i').css('background-color', '#FFFFFF');
        $('.color-text').val('#555555').next('.dropdown').find('i').css('background-color', '#555555');
        $('.color-badge').val('#007AFF').next('.dropdown').find('i').css('background-color', '#007AFF');
    };
    return {
        //main function to initiate template pages
        init: function () {

             runNavigationMenu();
           /* runWIndowResize();
            runInit();
            runStyleSelector();
            runSearchInput();
            runElementsPosition();
            runToDoAction();
            runNavigationToggler();
            runNavigationMenu();
            runGoTop();
            runModuleTools();
            runDropdownEnduring();
            runTooltips();
            runPopovers();
            runPanelScroll();
            runShowTab();
            runAccordionFeatures();
            runCustomCheck();
            runColorPalette();
            runSaveSetting();
          //  runCustomSetting();
            runClearSetting();*/
        }
    };
}();



$(document).ready(function () {
	$('.dropdown-menu li').each(function(){
		if($(this).hasClass('active')){
			$(this).parents('li').addClass('active');
		}        
	});
	
	$('.assets-nav').on('click', 'li', function() {
		$('.assets-nav li.active').removeClass('active');
		$(this).addClass('active');
	});

    $('.date-picker').datepicker();
	$('.search-select').select2();
});

function close_subview(){
	subview_action = "close";
	$.hideSubview();
	//e.preventDefault();
}

// xCheckbox
	xCheckbox('.panel-group');
	

function xCheckbox(tgt){
// Checkboxes
	$(tgt+' input[type=checkbox]').each(function(){
		if(!$(this).parent().hasClass('xCheckbox')){
			$(this).fadeTo(0,0).wrap('<div class="xCheckbox" style="position:relative;" />');
			$(this).css({'position':'absolute','width':'100%','height':'100%','left':'0','top':'0','z-index':'10'});
			if($(this).is(':checked')){$(this).parent().addClass('checked');}
			$(this).on('change',function(){
				if($(this).is(':checked')){
					$(this).parent().addClass('checked');
				} else {
					$(this).parent().removeClass('checked');
				}
			});
		}
	});
}
function load_popup(url,heading){

	var $modal = $('.bs-example-modal-lg');
	$('#gridSystemModalLabel').html(heading);
	$('#model_content').load(url,function(){
		$('#page_loading').hide();
		$modal.modal();	
		$('.search-select').select2();
	});
	
		
}	
function load_popup2(url,heading){

    var $modal = $('.bs-example-modal-lg');
    $('#gridSystemModalLabel').html(heading);
    $('#model_content').load(url,function(){
        $('#page_loading').hide();
        $modal.modal(); 
        
    });
    
        
}   

/*$('.dropdown-toggle','click',function(){
		$(".subviews").mCustomScrollbar({
			autoDraggerLength:true,
			autoHideScrollbar:false,
			scrollInertia:800,
			live: true,
			advanced:{
				updateOnBrowserResize: true,
				updateOnContentResize: true,
				autoScrollOnFocus: false
			}
});
});
*/





$(".hasPopup").on('click',function(e){
    var tgt = $(this).data("ref"), slctd = $(this);
    $(e.target).toggleClass('active');
    $(tgt).toggle(0);
    $(tgt).find("li").on("click",function(){
        var tgt2 = $(this);
        $(tgt2).addClass("active").siblings().removeClass("active");
        slctd.removeClass('active');
        $(tgt).hide(0);
    });
    $(tgt2).outside('click',function(){
        slctd.removeClass('active');
        $(e.target).removeClass('active');
        $(tgt).hide(0);
    });


});

$(window).scroll(function() {
			var scroll = $(window).scrollTop();

			if (scroll >= 85) {
				$("#feature_detail").addClass("fixed").fadeIn();
			}
			else {
				$("#feature_detail").removeClass("fixed").fadeIn();
			}
});




function initMCustomScroll()
{
}
wow = new WOW({
	animateClass: 'animated',
	offset: 100,
	callback: function(box) {
		console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
	}
});
wow.init();



		

/*
$(document).ready(function(e) {

	$('body').on('click','[data-xpop]',function(e){
		console.log('test');
		xpopup($(this));
		ieplacholder('.xPop input');	
		e.preventDefault();
	});    
});
var eas='easeOutExpo',
	loader='<img src="assets/images/loader.gif" id="temploader" alt="*" width="25">',
	anmdur=500;
function xpopup(e){
if(e=='close'){
	$('.xPop.on').fadeOut(anmdur,eas,function(){$(this).removeClass('on').removeAttr('style');});
	$('#overlay').fadeOut(anmdur);
}
else
{
	
	if($('#overlay').length=='0'){$('body').append('<div id="overlay" />');}
	var tgt='.xPop'+e.data('xpop'),wd,ht;
	$(tgt).removeAttr('style').show().fadeTo(0,0).addClass('calc');
	wd=$(tgt).outerWidth();
	ht=$(tgt).outerHeight();
	wht = $(window).height() - 100;
	if($(tgt).outerHeight() > wht){
		$(tgt).removeAttr('style').removeClass('calc').width(wd).height(wht).fadeIn(anmdur,eas,function(){$(this).addClass('on');});
		$(tgt + ".xPop .innerScroll").css('max-height',wht - 50 - $(".xPop > h3").outerHeight());
	}
	else { 
		$(tgt).removeAttr('style').removeClass('calc').width(wd).height(ht).fadeIn(anmdur,eas,function(){$(this).addClass('on');
	});			 		
	   $(tgt + ".xPop .innerScroll").css('max-height',ht - 50 - $(".xPop > h3").outerHeight());
	}
	
	$('#overlay').fadeIn();		
	$(tgt + ".xPop .innerScroll").mCustomScrollbar("destroy");
	customscrollerY(tgt + ".xPop .innerScroll");
}
}*/