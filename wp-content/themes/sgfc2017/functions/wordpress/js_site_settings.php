<?php

function weh_site_settings_js() {
    ?>
    <script type="text/javascript">
    window.SITE_SETTINGS = {
        blogurl: '<?php echo bloginfo('wpurl') ?>',
        templateUri: '<?php echo get_template_directory_uri() ?>',
    };
    </script>
    <?php
}

// Add hook for front-end <head></head>
add_action('wp_head', 'weh_site_settings_js');