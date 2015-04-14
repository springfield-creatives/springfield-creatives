/*!
 * hoverIntent v1.8.0 // 2014.06.29 // jQuery v1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license. Basically that
 * means you are free to use hoverIntent as long as this header is left intact.
 * Copyright 2007, 2014 Brian Cherne
 */
(function($){$.fn.hoverIntent=function(handlerIn,handlerOut,selector){var cfg={interval:100,sensitivity:6,timeout:0};if(typeof handlerIn==="object"){cfg=$.extend(cfg,handlerIn)}else{if($.isFunction(handlerOut)){cfg=$.extend(cfg,{over:handlerIn,out:handlerOut,selector:selector})}else{cfg=$.extend(cfg,{over:handlerIn,out:handlerIn,selector:handlerOut})}}var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if(Math.sqrt((pX-cX)*(pX-cX)+(pY-cY)*(pY-cY))<cfg.sensitivity){$(ob).off("mousemove.hoverIntent",track);ob.hoverIntent_s=true;return cfg.over.apply(ob,[ev])}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=false;return cfg.out.apply(ob,[ev])};var handleHover=function(e){var ev=$.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t)}if(e.type==="mouseenter"){pX=ev.pageX;pY=ev.pageY;$(ob).on("mousemove.hoverIntent",track);if(!ob.hoverIntent_s){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}}else{$(ob).off("mousemove.hoverIntent",track);if(ob.hoverIntent_s){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob)},cfg.timeout)}}};return this.on({"mouseenter.hoverIntent":handleHover,"mouseleave.hoverIntent":handleHover},cfg.selector)}})(jQuery);

/* Add to Homescreen v3.1.1 ~ (c) 2014 Matteo Spinelli ~ @license: http://cubiq.org/license */
(function(window,document){var _eventListener="addEventListener"in window;var _DOMReady=false;if(document.readyState==="complete"){_DOMReady=true}else if(_eventListener){window.addEventListener("load",loaded,false)}function loaded(){window.removeEventListener("load",loaded,false);_DOMReady=true}var _reSmartURL=/\/ath(\/)?$/;var _reQueryString=/([\?&]ath=[^&]*$|&ath=[^&]*(&))/;var _instance;function ath(options){_instance=_instance||new ath.Class(options);return _instance}ath.intl={de_de:{ios:"Um diese Web-App zum Home-Bildschirm hinzuzufügen, tippen Sie auf %icon und dann <strong>Zum Home-Bildschirm</strong>.",android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'},en_us:{ios:"To add this web app to the home screen: tap %icon and then <strong>Add to Home Screen</strong>.",android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'},es_es:{ios:"Para añadir esta aplicación web a la pantalla de inicio: pulsa %icon y selecciona <strong>Añadir a pantalla de inicio</strong>.",android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'},fr_fr:{ios:"Pour ajouter cette application web sur l'écran d'accueil : Appuyez %icon et sélectionnez <strong>Ajouter sur l'écran d'accueil</strong>.",android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'},he_il:{ios:'<span dir="rtl">להוספת האפליקציה למסך הבית: ללחוץ על %icon ואז <strong>הוסף למסך הבית</strong>.</span>',android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'},it_it:{ios:"Per aggiungere questa web app alla schermata iniziale: premi %icon e poi <strong>Aggiungi a Home</strong>.",android:'Per aggiungere questa web app alla schermata iniziale, apri il menu opzioni del browser e premi su <strong>Aggiungi alla homescreen</strong>. <small>Puoi accedere al menu premendo il pulsante hardware delle opzioni se la tua device ne ha uno, oppure premendo l\'icona <span class="ath-action-icon">icon</span> in alto a destra.</small>'},nb_no:{ios:"For å installere denne appen på hjem-skjermen: trykk på %icon og deretter <strong>Legg til på Hjem-skjerm</strong>.",android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'},pt_br:{ios:"Para adicionar este app à tela de início: clique %icon e então <strong>Tela de início</strong>.",android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'},pt_pt:{ios:"Para adicionar esta app ao ecrã principal: clique %icon e depois <strong>Ecrã principal</strong>.",android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'},nl_nl:{ios:"Om deze webapp op je telefoon te installeren, klik op %icon en dan <strong>Zet in beginscherm</strong>.",android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'},sv_se:{ios:"För att lägga till denna webbapplikation på hemskärmen: tryck på %icon och därefter <strong>Lägg till på hemskärmen</strong>.",android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'},zh_cn:{ios:"如要把应用程式加至主屏幕,请点击%icon, 然后<strong>加至主屏幕</strong>",android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'},zh_tw:{ios:"如要把應用程式加至主屏幕, 請點擊%icon, 然後<strong>加至主屏幕</strong>.",android:'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>'}};for(var lang in ath.intl){ath.intl[lang.substr(0,2)]=ath.intl[lang]}ath.defaults={appID:"org.cubiq.addtohome",fontSize:15,debug:false,modal:false,mandatory:false,autostart:true,skipFirstVisit:false,startDelay:1,lifespan:15,displayPace:1440,maxDisplayCount:0,icon:true,message:"",validLocation:[],onInit:null,onShow:null,onRemove:null,onAdd:null,onPrivate:null,privateModeOverride:false,detectHomescreen:false};var _ua=window.navigator.userAgent;var _nav=window.navigator;_extend(ath,{hasToken:document.location.hash=="#ath"||_reSmartURL.test(document.location.href)||_reQueryString.test(document.location.search),isRetina:window.devicePixelRatio&&window.devicePixelRatio>1,isIDevice:/iphone|ipod|ipad/i.test(_ua),isMobileChrome:_ua.indexOf("Android")>-1&&/Chrome\/[.0-9]*/.test(_ua),isMobileIE:_ua.indexOf("Windows Phone")>-1,language:_nav.language&&_nav.language.toLowerCase().replace("-","_")||""});ath.language=ath.language&&ath.language in ath.intl?ath.language:"en_us";ath.isMobileSafari=ath.isIDevice&&_ua.indexOf("Safari")>-1&&_ua.indexOf("CriOS")<0;ath.OS=ath.isIDevice?"ios":ath.isMobileChrome?"android":ath.isMobileIE?"windows":"unsupported";ath.OSVersion=_ua.match(/(OS|Android) (\d+[_\.]\d+)/);ath.OSVersion=ath.OSVersion&&ath.OSVersion[2]?+ath.OSVersion[2].replace("_","."):0;ath.isStandalone=window.navigator.standalone||ath.isMobileChrome&&screen.height-document.documentElement.clientHeight<40;ath.isTablet=ath.isMobileSafari&&_ua.indexOf("iPad")>-1||ath.isMobileChrome&&_ua.indexOf("Mobile")<0;ath.isCompatible=ath.isMobileSafari&&ath.OSVersion>=6||ath.isMobileChrome;var _defaultSession={lastDisplayTime:0,returningVisitor:false,displayCount:0,optedout:false,added:false};ath.removeSession=function(appID){try{localStorage.removeItem(appID||ath.defaults.appID)}catch(e){}};ath.Class=function(options){this.options=_extend({},ath.defaults);_extend(this.options,options);if(!_eventListener){return}this.options.mandatory=this.options.mandatory&&("standalone"in window.navigator||this.options.debug);this.options.modal=this.options.modal||this.options.mandatory;if(this.options.mandatory){this.options.startDelay=-.5}this.options.detectHomescreen=this.options.detectHomescreen===true?"hash":this.options.detectHomescreen;if(this.options.debug){ath.isCompatible=true;ath.OS=typeof this.options.debug=="string"?this.options.debug:ath.OS=="unsupported"?"android":ath.OS;ath.OSVersion=ath.OS=="ios"?"8":"4"}this.container=document.documentElement;this.session=localStorage.getItem(this.options.appID);this.session=this.session?JSON.parse(this.session):undefined;if(ath.hasToken&&(!ath.isCompatible||!this.session)){ath.hasToken=false;_removeToken()}if(!ath.isCompatible){return}this.session=this.session||_defaultSession;try{localStorage.setItem(this.options.appID,JSON.stringify(this.session));ath.hasLocalStorage=true}catch(e){ath.hasLocalStorage=false;if(this.options.onPrivate){this.options.onPrivate.call(this)}}var isValidLocation=!this.options.validLocation.length;for(var i=this.options.validLocation.length;i--;){if(this.options.validLocation[i].test(document.location.href)){isValidLocation=true;break}}if(localStorage.getItem("addToHome")){this.optOut()}if(this.session.optedout||this.session.added||!isValidLocation){return}if(ath.isStandalone){if(!this.session.added){this.session.added=true;this.updateSession();if(this.options.onAdd&&ath.hasLocalStorage){this.options.onAdd.call(this)}}return}if(this.options.detectHomescreen){if(ath.hasToken){_removeToken();if(!this.session.added){this.session.added=true;this.updateSession();if(this.options.onAdd&&ath.hasLocalStorage){this.options.onAdd.call(this)}}return}if(this.options.detectHomescreen=="hash"){history.replaceState("",window.document.title,document.location.href+"#ath")}else if(this.options.detectHomescreen=="smartURL"){history.replaceState("",window.document.title,document.location.href.replace(/(\/)?$/,"/ath$1"))}else{history.replaceState("",window.document.title,document.location.href+(document.location.search?"&":"?")+"ath=")}}if(!this.session.returningVisitor){this.session.returningVisitor=true;this.updateSession();if(this.options.skipFirstVisit){return}}if(!this.options.privateModeOverride&&!ath.hasLocalStorage){return}this.ready=true;if(this.options.onInit){this.options.onInit.call(this)}if(this.options.autostart){this.show()}};ath.Class.prototype={events:{load:"_delayedShow",error:"_delayedShow",orientationchange:"resize",resize:"resize",scroll:"resize",click:"remove",touchmove:"_preventDefault",transitionend:"_removeElements",webkitTransitionEnd:"_removeElements",MSTransitionEnd:"_removeElements"},handleEvent:function(e){var type=this.events[e.type];if(type){this[type](e)}},show:function(force){if(this.options.autostart&&!_DOMReady){setTimeout(this.show.bind(this),50);return}if(this.shown){return}var now=Date.now();var lastDisplayTime=this.session.lastDisplayTime;if(force!==true){if(!this.ready){return}if(now-lastDisplayTime<this.options.displayPace*6e4){return}if(this.options.maxDisplayCount&&this.session.displayCount>=this.options.maxDisplayCount){return}}this.shown=true;this.session.lastDisplayTime=now;this.session.displayCount++;this.updateSession();if(!this.applicationIcon){if(ath.OS=="ios"){this.applicationIcon=document.querySelector('head link[rel^=apple-touch-icon][sizes="152x152"],head link[rel^=apple-touch-icon][sizes="144x144"],head link[rel^=apple-touch-icon][sizes="120x120"],head link[rel^=apple-touch-icon][sizes="114x114"],head link[rel^=apple-touch-icon]')}else{this.applicationIcon=document.querySelector('head link[rel^="shortcut icon"][sizes="196x196"],head link[rel^=apple-touch-icon]')}}var message="";if(this.options.message in ath.intl){message=ath.intl[this.options.message][ath.OS]}else if(this.options.message!==""){message=this.options.message}else{message=ath.intl[ath.language][ath.OS]}message="<p>"+message.replace("%icon",'<span class="ath-action-icon">icon</span>')+"</p>";this.viewport=document.createElement("div");this.viewport.className="ath-viewport";if(this.options.modal){this.viewport.className+=" ath-modal"}if(this.options.mandatory){this.viewport.className+=" ath-mandatory"}this.viewport.style.position="absolute";this.element=document.createElement("div");this.element.className="ath-container ath-"+ath.OS+" ath-"+ath.OS+(ath.OSVersion+"").substr(0,1)+" ath-"+(ath.isTablet?"tablet":"phone");this.element.style.cssText="-webkit-transition-property:-webkit-transform,opacity;-webkit-transition-duration:0s;-webkit-transition-timing-function:ease-out;transition-property:transform,opacity;transition-duration:0s;transition-timing-function:ease-out;";this.element.style.webkitTransform="translate3d(0,-"+window.innerHeight+"px,0)";this.element.style.transform="translate3d(0,-"+window.innerHeight+"px,0)";if(this.options.icon&&this.applicationIcon){this.element.className+=" ath-icon";this.img=document.createElement("img");this.img.className="ath-application-icon";this.img.addEventListener("load",this,false);this.img.addEventListener("error",this,false);this.img.src=this.applicationIcon.href;this.element.appendChild(this.img)}this.element.innerHTML+=message;this.viewport.style.left="-99999em";this.viewport.appendChild(this.element);this.container.appendChild(this.viewport);if(!this.img){this._delayedShow()}},_delayedShow:function(e){setTimeout(this._show.bind(this),this.options.startDelay*1e3+500)},_show:function(){var that=this;this.updateViewport();window.addEventListener("resize",this,false);window.addEventListener("scroll",this,false);window.addEventListener("orientationchange",this,false);if(this.options.modal){document.addEventListener("touchmove",this,true)}if(!this.options.mandatory){setTimeout(function(){that.element.addEventListener("click",that,true)},1e3)}setTimeout(function(){that.element.style.webkitTransitionDuration="1.2s";that.element.style.transitionDuration="1.2s";that.element.style.webkitTransform="translate3d(0,0,0)";that.element.style.transform="translate3d(0,0,0)"},0);if(this.options.lifespan){this.removeTimer=setTimeout(this.remove.bind(this),this.options.lifespan*1e3)}if(this.options.onShow){this.options.onShow.call(this)}},remove:function(){clearTimeout(this.removeTimer);if(this.img){this.img.removeEventListener("load",this,false);this.img.removeEventListener("error",this,false)}window.removeEventListener("resize",this,false);window.removeEventListener("scroll",this,false);window.removeEventListener("orientationchange",this,false);document.removeEventListener("touchmove",this,true);this.element.removeEventListener("click",this,true);this.element.addEventListener("transitionend",this,false);this.element.addEventListener("webkitTransitionEnd",this,false);this.element.addEventListener("MSTransitionEnd",this,false);this.element.style.webkitTransitionDuration="0.3s";this.element.style.opacity="0"},_removeElements:function(){this.element.removeEventListener("transitionend",this,false);this.element.removeEventListener("webkitTransitionEnd",this,false);this.element.removeEventListener("MSTransitionEnd",this,false);this.container.removeChild(this.viewport);this.shown=false;if(this.options.onRemove){this.options.onRemove.call(this)}},updateViewport:function(){if(!this.shown){return}this.viewport.style.width=window.innerWidth+"px";this.viewport.style.height=window.innerHeight+"px";this.viewport.style.left=window.scrollX+"px";this.viewport.style.top=window.scrollY+"px";var clientWidth=document.documentElement.clientWidth;this.orientation=clientWidth>document.documentElement.clientHeight?"landscape":"portrait";var screenWidth=ath.OS=="ios"?this.orientation=="portrait"?screen.width:screen.height:screen.width;this.scale=screen.width>clientWidth?1:screenWidth/window.innerWidth;this.element.style.fontSize=this.options.fontSize/this.scale+"px"},resize:function(){clearTimeout(this.resizeTimer);this.resizeTimer=setTimeout(this.updateViewport.bind(this),100)},updateSession:function(){if(ath.hasLocalStorage===false){return}localStorage.setItem(this.options.appID,JSON.stringify(this.session))},clearSession:function(){this.session=_defaultSession;this.updateSession()},optOut:function(){this.session.optedout=true;this.updateSession()},optIn:function(){this.session.optedout=false;this.updateSession()},clearDisplayCount:function(){this.session.displayCount=0;this.updateSession()},_preventDefault:function(e){e.preventDefault();e.stopPropagation()}};function _extend(target,obj){for(var i in obj){target[i]=obj[i]}return target}function _removeToken(){if(document.location.hash=="#ath"){history.replaceState("",window.document.title,document.location.href.split("#")[0])}if(_reSmartURL.test(document.location.href)){history.replaceState("",window.document.title,document.location.href.replace(_reSmartURL,"$1"))}if(_reQueryString.test(document.location.search)){history.replaceState("",window.document.title,document.location.href.replace(_reQueryString,"$2"))}}window.addToHomescreen=ath})(window,document);

jQuery(function($){

	// User Nav
	var $navMenu = $('.nav--menu');

	$('.menu--user').hoverIntent( {
		over: function(){
			$navMenu.addClass('open');
		},
		out: function(){
			$navMenu.removeClass('open');
		},
		timeout: 50
	});

	$('.menu--user .toggle-menu').on('touchstart click', function(e) {

		// check if they're hovering (there's a cursor)
		if(e.type !== 'touchstart')
			return true;

		// treat top link as a toggle for menu
		$('.menu--user ul:first').toggle();
		e.preventDefault();
		return false;
	});

	$('.nav--top header').on('click', function() {
		$('.nav--top ul.menu').slideToggle();
	});

	// Input label-toggling
	function inputFocus(e){
		var $el = $(e.currentTarget),
			$label = _findLabel($el);
		
		$label.hide();
	}

	function inputBlur(e){
		var $el = $(e.currentTarget);

		if($el.val().length === 0){
			var $label = _findLabel($el);
			$label.show();
		}
	}

	function _findLabel($el){
		$label = $el.parent().prevAll('label');

		if($label.length > 0){
			return $label;
		}
		$label = $el.nextAll('label');

		if($label.length > 0){
			return $label;
		}

		console.log('cant find label for:', $el);

	}

	var watchedInputs = 'input[type=text], input[type=email], input[type=tel], textarea';
	$(document).on('keyup keypress', watchedInputs, inputFocus)
		.on('blur change', watchedInputs, inputBlur);


	// check default values
	function checkValues(i, el){
		var $el = $(el);

		if($el.val().length > 0){
			var $label = _findLabel($el);
			$label.hide();
		}
	}

	function maybeHideFormLabels(){
		$(watchedInputs).each(checkValues);
	}
	maybeHideFormLabels();

	$(document).bind('gform_post_render', maybeHideFormLabels);


	// SLICK
	$slick = $('.slick-carousel');

	if($slick.length > 0){
		
		// profile page fancybox init
		var fancyBoxSlides = [];
		$slick.on('init', function(e, slick){

			// init sometimes fires twice
			if(fancyBoxSlides.length > 0)
				return;

			slick.$slides.each(function(i, el){
				var $med = $(el).find('[data-big]');

				fancyBoxSlides.push({
					href: $med.data('big'),
					title: $med.attr('title')
				});
			});

			$slick.on('click.customFancybox', '[data-big]', function(e){
				var index = $(e.currentTarget).parent().data('slick-index');
				$.fancybox.open(fancyBoxSlides, {
					index: index,
	        openEffect  : 'none',
	        closeEffect : 'none',
	        helpers : {
	            media : {}
	        }
				});
			});
	  });
		

		$slick.slick({
			dots: true,
		  infinite: true,
		  speed: 500,
		  slidesToShow: 6,
		  slidesToScroll: 6,
		  responsive: [
		    {
		      breakpoint: 1400,
		      settings: {
		        slidesToShow: 4,
		        slidesToScroll: 4,
		        infinite: true,
		        dots: true
		      }
		    },
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2,
		        dots: false
		      }
		    },
		    {
		      breakpoint: 320,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1,
		        dots: false
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]
		});
	}
	
	// hack for :nth-child(even) gravity forms sections
	$('li.gsection').after('<li></li>');


	// Responsive iframes
	var $iframes = $( "iframe" );

	// Find & save the aspect ratio for all iframes
	$iframes.each(function () {
	  $( this ).data( "ratio", this.height / this.width )
	    // Remove the hardcoded width & height attributes
	    .removeAttr( "width" )
	    .removeAttr( "height" );
	});

	// Resize the iframes when the window is resized
	$( window ).resize( function () {
	  $iframes.each( function() {
	    // Get the parent container's width
	    var width = $( this ).parent().width();
	    if(width > 600)
	    	width = 600;
	    
	    $( this ).width( width )
	      .height( width * $( this ).data( "ratio" ) );
	  });
	// Resize to fix all iframes on page load.
	}).resize();


	// member card
	var $memberCardBody = $('body.sc-page-member-card');

	if($memberCardBody.length > 0){
		var $memberCard = $('.member-card'),
			$win = $(window);

		// overwrite wp admin bar css
		$memberCardBody.append('<style>html, html body{ margin-top: 0 !important }</style>');

		// add to home popup
		// encode user info in URL for saved to desktopness
		var memberCardInfoHash = window.btoa($.param(window.memberCardInfo));

		// only update URL if not already set
		var mDataPresent = false;

		var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == 'mdata') 
        {
        	mDataPresent = true;
          break;
        }
    }

		if(!mDataPresent)
			history.replaceState('', window.document.title, document.location.href + (document.location.search ? '&' : '?' ) + 'mdata=' + memberCardInfoHash);

		// Trigger popup
		addToHomescreen({
			maxDisplayCount: 2
		});

		function sizeBody(){

			// return if not mobile width
			if($win.width() > 760)
				return;
			
			$memberCardBody.height($win.height());

			$memberCard.css({
				top: ($memberCardBody.height() / 2) - ($memberCard.outerHeight() / 2),
				width: $memberCardBody.width()
			});
		}

		sizeBody();
		$win.on('resize orientationchange', sizeBody);
		setTimeout(sizeBody, 100);

		// animate iphone in if on desktop
		setTimeout(function(){
			$('.iphone-wrap').removeClass('offscreen');
		}, 500)

	}
});