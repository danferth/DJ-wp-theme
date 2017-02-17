<?php
/*
These are TIC functions
*/

//to remove the base Open sans (way to many fonts loaded!) font loaded from wordpress
if(!function_exists('remove_wp_open_sans')) :
    function remove_wp_open_sans(){
        wp_deregister_style('open-sans');
        wp_register_style('open-sans', false);
    }
    add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
    add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
    endif;
    
//stop wp from messing with content
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

//returns full url with any querys
function true_url(){
    $output = "";
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'){
        $output .= "https";
    }else{
        $output .= "http";
    }
    $output .= "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    echo $output;
};

//form functions to trim and sanitize
function trim_value(&$value){
  if(gettype($value) == 'string'){
    $value = trim($value);
  }
  if(gettype($value) == 'array'){
      array_walk($value, 'trim_value');
  }
}

?>