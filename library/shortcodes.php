<?php

//$atts = an associative aray of attributes, or an empty string if no attirbutes are given;
//$content = the enclosed content (if the shorcode is used in its enclosing form)
//$tag = the shortcode tag, usefull for shared callback functions





//[helloworld]
function hello_shortcode($atts, $content, $tag){
    
    //use this to for defaults in $atts
    $a = shortcode_atts( array(
            'att_1' => "value_1",
            'att_2' => 420
        ), $atts);
        
        
    //return NOT echo
    return "<div class='column small-12 panel'><p class='label alert'>Hello World!</p></div>";
    
}

add_shortcode('helloworld', 'hello_shortcode');








?>