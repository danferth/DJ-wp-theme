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

//form functions to trim
function trim_value(&$value){
  if(gettype($value) == 'string'){
    $value = trim($value);
  }
  if(gettype($value) == 'array'){
      array_walk($value, 'trim_value');
  }
};

//login page changes
//logo change
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/TIC-logo-black.png);
		height:65px;
		width:320px;
		background-size: 320px 65px;
		background-repeat: no-repeat;
        	padding-bottom: 1rem;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
//main logo redirect to htslabs.com
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'htslabs.com';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
?>

<?php
// Source: https://wpcolt.com/fix-hentry-errors-wordpress/
add_filter( 'post_class', 'remove_hentry' );
function remove_hentry( $class ) {
	$class = array_diff( $class, array( 'hentry' ) );	
	return $class;
}
?>