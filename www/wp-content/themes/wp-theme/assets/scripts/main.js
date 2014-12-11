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

	var watchedInputs = 'input[type=text], input[type=email], textarea';
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


	// hack for :nth-child(even) gravity forms sections
	$('li.gsection').after('<li></li>');

});