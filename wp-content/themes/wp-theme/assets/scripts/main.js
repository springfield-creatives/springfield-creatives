/*!
 * hoverIntent v1.8.0 // 2014.06.29 // jQuery v1.9.1+
 * http://cherne.net/brian/resources/jquery.hoverIntent.html
 *
 * You may use hoverIntent under the terms of the MIT license. Basically that
 * means you are free to use hoverIntent as long as this header is left intact.
 * Copyright 2007, 2014 Brian Cherne
 */
(function($){$.fn.hoverIntent=function(handlerIn,handlerOut,selector){var cfg={interval:100,sensitivity:6,timeout:0};if(typeof handlerIn==="object"){cfg=$.extend(cfg,handlerIn)}else{if($.isFunction(handlerOut)){cfg=$.extend(cfg,{over:handlerIn,out:handlerOut,selector:selector})}else{cfg=$.extend(cfg,{over:handlerIn,out:handlerIn,selector:handlerOut})}}var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if(Math.sqrt((pX-cX)*(pX-cX)+(pY-cY)*(pY-cY))<cfg.sensitivity){$(ob).off("mousemove.hoverIntent",track);ob.hoverIntent_s=true;return cfg.over.apply(ob,[ev])}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=false;return cfg.out.apply(ob,[ev])};var handleHover=function(e){var ev=$.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t)}if(e.type==="mouseenter"){pX=ev.pageX;pY=ev.pageY;$(ob).on("mousemove.hoverIntent",track);if(!ob.hoverIntent_s){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob)},cfg.interval)}}else{$(ob).off("mousemove.hoverIntent",track);if(ob.hoverIntent_s){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob)},cfg.timeout)}}};return this.on({"mouseenter.hoverIntent":handleHover,"mouseleave.hoverIntent":handleHover},cfg.selector)}})(jQuery);


jQuery(function($){

	var hoveringOnUserNav = false;
	$('.menu--user').hoverIntent( function(){
		$('.menu--user ul:first').show();
		hoveringOnUserNav = true;
	}, function(){
		$('.menu--user ul:first').hide();
		hoveringOnUserNav = false;
	});

	$('.menu--user .toggle-menu').on('click', function(e) {
		// check if they're hovering (there's a cursor)
		if(hoveringOnUserNav)
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



	// member card
	var $memberCardBody = $('body.sc-page-member-card');

	if($memberCardBody.length > 0){
		var $memberCard = $('.member-card'),
			$win = $(window);

		// overwrite wp admin bar css
		$memberCardBody.append('<style>html, html body{ margin-top: 0 !important }</style>');

		function sizeBody(){

			// return if not mobile width
			if($win.width() > 760)
				return;
			
			$memberCardBody.height($win.height());

			$memberCard.css({
				top: ($memberCardBody.height() / 2) - ($memberCard.height() / 2),
				width: $memberCardBody.width()
			});
		}

		sizeBody();
		$win.resize(sizeBody);
		setTimeout(sizeBody, 100);

		// animate iphone in if on desktop
		setTimeout(function(){
			$('.iphone-wrap').removeClass('offscreen');
		}, 500)

	}
});