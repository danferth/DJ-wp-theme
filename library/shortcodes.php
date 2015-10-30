<?php

//$atts = an associative aray of attributes, or an empty string if no attirbutes are given;
//$content = the enclosed content (if the shorcode is used in its enclosing form)
//$tag = the shortcode tag, usefull for shared callback functions

/*
//============[helloworld]==============================
function helloworld_shortcode($atts, $content, $tag){
    
    //use this to for defaults in $atts
    $a = shortcode_atts( array(
            'att_1' => "value_1",
            'att_2' => 420
        ), $atts);
        
    //return NOT echo
    return "<div class='column small-12 panel'><p class='label alert'>Hello World!</p></div>";
    
}
//add shortcode
add_shortcode('helloworld', 'helloworld_shortcode');

//===========[hello]content[/hello]==========================
//$content = null so content is encapsulated with closing tag
function hello_shortcode($atts, $content = null, $tag){
    //put $atts in $a..
    $a = shortcode_atts(array(
            'class' => 'no_class'
        ), $atts);
        
    return "<div class='small=12 panel rounded " . $a['class'] . "'>" . $content . "</div>";
}
//add shortcode
add_shortcode('hello', 'hello_shortcode');

===============================================================================*/

//[mainblock class='addedclass' img='src' link='href']<p>content</p>[/mainblock]
function mainblock_shortcode($atts, $content = null, $tag){
    $a = shortcode_atts( array(
            'title'  => 'needs a title',
            'img'    => '',
            'class'  => '',
            'link'   => get_home_url()
        ), $atts);
    return "<li class='main-block " . $a['class'] . "' data-mainblocklink='" . $a['link'] . "'> \n
      <div class='inner-block'> \n
        <div class='main-block-image-wrap'> \n
        <img src='" . $a['img'] . "' /> \n
        </div> \n
        <h3>" . $a['title'] . "</h3> \n
        <p>" . $content . "</p></div></li>";
}

add_shortcode('mainblock', 'mainblock_shortcode');
?>