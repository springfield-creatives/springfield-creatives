Springfield Creatives WordPress Site
=============

This repository houses the source for springfieldcreatives.com, minus some stuff that shouldn't be publicly available. That inludes premium WordPress plugins, and the corresponding database. The site is maintained by the Springfield Creatives Website Committee. Come to our next meeting to help contribute.

Dev Environment Setup Instructions
------------------
1. SASS/Compass' `config.rb` is in the theme's directory, so you can `compass watch` from there.
1. Premium plugins are not committed to Github, and should be downloaded via our super secret zip file on [Trello](https://trello.com/c/YVX1q0d7).
1. You'll need to create a DB dump using the Migrate DB plugin on the dev site. Credentials and instructions are on the [Trello board](https://trello.com/c/YVX1q0d7) as well.
1. Configure your local install by renaming `www/wp-config-sample.local` to `wp-config.local`. Treat it like you typically would 1wp-config.php`.


SASS Structure
------------------
1. **/assets/** -- All website assets (images/sass/scripts/fonts) will now be located in their respective folders
2. **/partials/** -- Contains repeatable code blocks or large chunks of php that you want to separate from template files. Keep it organized through folders. For example, you can have the post loop inside the posts folder. To pull the partials use `<?php include(get_template_directory() . '/partials/folder-name/partial-name.partial.php'); ?>`
3. **/functions/** -- Anything functions related goes in here. Anything wordpress, goes into the /functions/wordpress/ folder. If you're adding a plugin or larger function, add it as its own file. Then pull the file inside functions.php. Look at lines 41-42 for an example of how to. Add comments to your inclusion so we know what the function does. Keep any and all unnecessary code out of functions.php.
4. **/functions/wordpress/utility.php** -- Keep any utility function scripts in here with comments. Some examples would be of custom slugs, ACF option pages...etc
5. **/functions/custom_*** -- Keep these 3 files clean and well commented. Do not add any additional files into this directory unless it doesn't fit anywhere else.
6. **/functions/wordpress/admin-menu.php** -- Lets you add separator between the wordpress menu. More promenant and allows for better organization. Also enques the custom post type style icons. Look at number 7.
7. **/assets/sass/style-cpt.scss** -- You can assign custom font icons to your Custom Post Types through an icon font.


General Tips
------------------
Avoid using the page-*slug*.php format. We want to disconnect the theme from the WP DB Settings as much as possible. Instead, opt for the Template Name approach:

	<?php
	/*
	Template Name: Snarfer
	*/
	?>