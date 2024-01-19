<?php

/**
 * blocks
 */


if (!function_exists('stone_digital_wp_register_block')) {
    function stone_digital_wp_register_block($name, $title)
    {
        if (function_exists('acf_register_block')) {
            acf_register_block(array(
                'name'                => $name,
                'title'                => __($title),
                'description'        => __($title),
                'render_callback'    => 'stone_digital_block_render_callback',
                'category'            => 'stone_digital-theme',
                'supports' => array(
                    'className'  => true,
                    'anchor' => true,
                    'jsx' => true,
                ),
                'mode' => 'edit',
                'align' => false,
                'icon'                => 'format-image',
                'keywords'            => array($name, $title, 'stone_digital')
            ));
        }
    }
}

add_action('acf/init', 'stone_digital_acf_init');
function stone_digital_acf_init()
{
    $path = get_theme_root() . '/ko-homes/blocks/';
    $get_dir = stone_digital_wp_dir_to_array($path);
    $block_name = array();
    
    //Block load from child theme
    if (get_template_directory() !== get_stylesheet_directory()) {
        $path_child = get_stylesheet_directory() . '/blocks/';
        $get_dir_child = stone_digital_wp_dir_to_array($path_child);
        
        if ($get_dir_child) {
            foreach ($get_dir_child as $k => $dir) {
                if (is_array($dir)) {
                    stone_digital_wp_register_init_child($k, $dir, 'child');
                }
            }
        }
    
        //Block load from parent theme
        $path = get_template_directory() . '/blocks/';
        $get_dir = stone_digital_wp_dir_to_array($path);
        if ($get_dir) {
            foreach ($get_dir as $k => $dir) {
                if (is_array($dir)) {
                    if (!array_key_exists($k, $get_dir_child) && !empty($dir)) {
                        stone_digital_wp_register_init_child($k, $dir, 'parent');
                    }
                }
            }
        }
    } else {
        if ($get_dir) {
            foreach ($get_dir as $k => $dir) {
                $title = ucwords(str_replace('-', ' ', $k));
                if (is_array($dir) && in_array('template.php', $dir)) {
                    stone_digital_wp_register_block($k, $title);
                }
            }
        }
    }
}
function stone_digital_wp_register_init_child($key, $dir, $theme){
    if ( ! is_array($dir)) {
        return;
    }
    $title = ucwords(str_replace('-', ' ', $key));
    if (is_array($dir) && in_array('template.php', $dir)) {
        stone_digital_wp_register_block($key, $title, '');
    }
}
function stone_digital_block_render_callback($block)
{
    $slug = str_replace('acf/', '', $block['name']);
    if (get_template_directory() !== get_stylesheet_directory()) {
        if (file_exists(get_stylesheet_directory() . '/blocks/'. $slug  .'/template.php')) {
            require get_stylesheet_directory() . '/blocks/'. $slug  .'/template.php';
        } else {
            require get_template_directory() . '/blocks/'. $slug  .'/template.php';
        }
    } else {
        if (file_exists(get_theme_file_path("/blocks/{$slug}/template.php"))) {
            include(get_theme_file_path("/blocks/{$slug}/template.php"));
        }
    }
}

add_filter('allowed_block_types', 'stone_digital_wp_allowed_block_types');
function stone_digital_wp_allowed_block_types($allowed_blocks)
{
    $path = get_theme_root() . '/ko-homes/blocks/';
    $get_dir = stone_digital_wp_dir_to_array($path);
    $block_name = array();
    if ($get_dir) {
        foreach ($get_dir as $k => $dir) {
            $block_name[] = 'acf/' . $k;
        }
    }
    if (get_template_directory() !== get_stylesheet_directory()) {
        //Load block from child theme
        if (get_template_directory() !== get_stylesheet_directory()) {
            $path_child = get_stylesheet_directory() . '/blocks/';
            $get_dir_child = stone_digital_wp_dir_to_array($path_child);
            if ($get_dir_child) {
                foreach ($get_dir_child as $k => $dir) {
                    if (!array_key_exists($k, $get_dir) && is_array($dir) && !empty($dir)) {
                        $block_name[] = 'acf/' . $k;
                    }
                }
            }
        }
    }

    $default_blocks =  array(
        'core/heading',
        'core/paragraph',
        'core/image',
        'core/gallery',
        'core/list'
    );
    $blocks =  array_merge($block_name, $default_blocks);
    return $blocks;

    // return $block_name;
}

if (!function_exists('stone_digital_wp_dir_to_array')) {
    function stone_digital_wp_dir_to_array($dir)
    {
        $result = array();
        if( file_exists($dir) ){
            $cdir = scandir($dir);
            foreach ($cdir as $key => $value) {
                if (!in_array($value, array(".", ".."))) {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                        $result[$value] = stone_digital_wp_dir_to_array($dir . DIRECTORY_SEPARATOR . $value);
                    } else {
                        $result[] = $value;
                    }
                }
            }
        }

        return $result;
    }
}