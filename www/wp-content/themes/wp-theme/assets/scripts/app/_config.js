define({

	// RequireJS config object
	requirejs: {
		paths: {
			jquery: [
				'//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min',
				'vendor/jquery-1.11.0.min'
			]
		},
		// for non-AMD scripts
		shim: {
			/*
			someJqueryPlugin: ['jquery']
			*/
		}
	},

	/*
	jQuery selectors that include listed files when found on current page
	Prepending a ! in front of the name will make sure the file is not included
	when that selector is found.

	Example:
		'body.anotherTemplate': ['this_one', '!not_this_one']
	*/
	selectors: {
		
	}

});