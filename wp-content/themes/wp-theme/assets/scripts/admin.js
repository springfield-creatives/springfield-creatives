jQuery(function($){

	// only apply to profile page
	if($('body.profile-php').length){

		var $profile = $('#profile-page');

		// hide certain sections
		$profile.find('h3').each(function(i, el){
			var $el = $(el),
				h3Text = $el.html();

			switch(h3Text){

				// hide title
				case 'Contact Info':

					$el.hide();

					break;

				// hide entire section
				case 'WordPress SEO settings':
				case 'Personal Options':

					$el.hide()
						.next().hide();

					break;

				// misc
				case 'About Yourself':

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
