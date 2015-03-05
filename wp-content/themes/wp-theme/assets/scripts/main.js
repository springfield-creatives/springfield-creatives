jQuery(function($){

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


	// Nav section stickiness
	var $nav = $('body > header > nav'),
		hasAdminBar = $('body.admin-bar').length > 0,
		navPinOpts = {
			activeClass: 'pinned'
		};

	if(hasAdminBar)
		navPinOpts.padding = {top: 32};

	$nav.pin(navPinOpts);

	// create sticky nav logo
	$('a.springfield-creatives-logo-wrap').clone().prependTo($nav);

	// SLICK
	$slick = $('.slick-carousel');
	
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

	// hack for :nth-child(even) gravity forms sections
	$('li.gsection').after('<li></li>');

});