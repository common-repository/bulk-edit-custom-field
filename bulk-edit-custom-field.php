<?php
/*
Plugin Name: Bulk Edit Custom Field Plugin
Plugin URI: http://hiteshjoshi.com/wordpress/bulk_edit_custom_field_plugin.html
Description: <p>This plugin simply helps adding/updating custom fields in bulk, just like you can edit bulk pages</p><p> <a href='http://hiteshjoshi.com/wordpress/bulk_edit_custom_field_plugin.html'>Click here</a> for more information</p>
Version: 1.2
Author: Hitesh Joshi
Author URI: http://hiteshjoshi.com
License: A "Slug" license name e.g. GPL2
*/

add_filter('manage_pages_columns', 'add_cf_column', 10, 2);
function add_cf_column($posts_columns, $post_type)
{
    $posts_columns['cf'] = 'CF column';
    return $posts_columns;
}
add_filter('manage_edit-page_columns', 'remove_dummyp_column');
function remove_dummyp_column($posts_columns)
{
    unset($posts_columns['cf']);
    return $posts_columns;
}
add_filter('manage_posts_columns', 'add_cfp_column', 10, 2);
function add_cfp_column($posts_columns, $post_type)
{
    $posts_columns['cf'] = 'CF column';
    return $posts_columns;
}
add_filter('manage_edit-post_columns', 'remove_dummy_column');
function remove_dummy_column($posts_columns)
{
    unset($posts_columns['cf']);
    return $posts_columns;
}
add_action('bulk_edit_custom_box', 'on_bulk_edit_custom_box', 10, 2);
function on_bulk_edit_custom_box($column_name, $post_type)
{
    if ('cf' == $column_name) {
        echo "<p>Custom Field Key : <input type='text' name='custom_field_key' style='width:80'/></p>";
        echo "<p>Custom Field Value : <input type='text' name='custom_field_val' style='width:80' /></p>";

    }
}
if(isset($_GET['post'])){
$post_ids = isset($_GET['post']) ? array_map( 'intval', (array) $_GET['post'] ) : explode(',', $_GET['ids']);
foreach( (array) $post_ids as $post_id ) {$meta_key = $_GET['custom_field_key'];$meta_value = $_GET['custom_field_val'];
update_post_meta($post_id, $meta_key, $meta_value);
add_post_meta($post_id, $meta_key, $meta_value, true);}}


add_action('wp_head','head_meta');
function head_meta(){

echo '<meta name="hiteshjoshi.com" content="Uses a plugin from http://hiteshjoshi.com/" />';
}
