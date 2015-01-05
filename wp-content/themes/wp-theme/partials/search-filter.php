<?php

// Figure filters for this post type
$filters = get_object_taxonomies($wp_query->query['post_type'], 'objects');

?>

<div class="search-filter">
    <form method="get" class="search-filter-form">
        <?php if (!empty($filters)) : ?>
            <?php foreach ($filters as $taxonomy => $obj) : ?>
                <?php
                    $name = strtolower($taxonomy);
                    $query = 'filter-' . $name;
                    $terms = get_terms($taxonomy, array(
                        'hide_empty' => false
                    ));

                    if (empty($terms)) {
                        continue;
                    }

                    $default = 'default';
                    if (isset($_GET[$query]) && !empty($_GET[$query])) {
                        $default = $_GET[$query];
                    }

                ?>

                <div class="wrapper filter <?php echo $name; ?>">
                    <select name="filter-<?php echo $name; ?>" class="select filter">
                        <option value="default" <?php echo ($default == 'default') ? 'selected="selected"' : '' ?>>-- <?php echo $obj->labels->name; ?></option>
                        <?php foreach ($terms as $term) : ?>
                            <option value="<?php echo $term->term_id; ?>" <?php echo ($default == $term->term_id) ? 'selected="selected"' : '' ?>><?php echo $term->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>

        <div class="wrapper search">
            <input type="text" name="s" class="search" />
        </div>
        <div class="wrapper submit">
            <input type="submit" value="GO" class="submit" />
        </div>
    </form>
</div>