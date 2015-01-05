jQuery(function($){

	// only apply to profile page
	if($('body.profile-php').length){

		var $profile = $('#profile-page');

		// hide certain sections
		$profile.find('h3').each(function(i, el){
			var $el = $(el),
				h3Text = $el.html();

			switch(h3Text){
				case 'Personal Options':

					// hide entire section
					$el.hide()
						.next().hide();

					break;

				case 'About Yourself':

					// change title
					$el.html('Change Password');
					break;
			}
		});

		// hide certain fields
		$profile.find('label').each(function(i, el){
			var $el = $(el),
				labelFor = $el.attr('for');

			switch(labelFor){
				case 'nickname':
				case 'display_name':
				case 'description':

					// hide TR
					$el.parent().parent().hide();

					break;
			}
		});

	}

});
