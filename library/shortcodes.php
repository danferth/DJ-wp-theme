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
//this needs to be placed inside ( div.row>div.column.small-12 ) at the minimum
function mainblock_shortcode($atts, $content = null, $tag){
    $a = shortcode_atts( array(
            'title'  => 'needs a title',
            'img'    => '',
            'class'  => '',
            'link'   => get_home_url()
        ), $atts);
    return "<li class='main-block " . $a['class'] . "' data-mainblocklink='" . get_home_url() . "/" . $a['link'] . "'> \n
      <div class='inner-block'> \n
        <div class='main-block-image-wrap'> \n
        <img src='" . get_template_directory_uri(). "/images/" . $a['img'] . "' /> \n
        </div> \n
        <h3>" . $a['title'] . "</h3> \n
        <p>" . $content . "</p></div></li>";
}

add_shortcode('mainblock', 'mainblock_shortcode');


//[appblock class='addedclass' link='link' title='title']<p>short description</p>[/appblock]
//this needs to be placed inside of ( ul.small-block-grid-#.appnote-block) to work properly
function appblock_shortcode($atts, $content = null, $tag){
    $a = shortcode_atts( array(
            'class' => '',
            'link' => '',
            'title' => 'needs a title'
        ), $atts);
    return "<li class='" . $a['class'] . "' data-appblocklink='" . get_home_url() . "/" . $a['link'] . "'> \n
        <div class='appnote-block-inner-wrap'> \n
        <h4>" . $a['title'] . "</h4> \n
        <p>" . $content . "</p> \n
        </div> \n
        </li>";
}

add_shortcode('appblock', 'appblock_shortcode');

//[videosingle class='added class' title='title' video='file name of video']
//no prerequisites this shortcode creates all enclosing divs
function video_single_shortcode($atts, $content, $tag){
    $a = shortcode_atts( array(
            'class' => '',
            'title' => 'needs a title',
            'video' => '2015/09/fv-overview'
        ), $atts);
    return "<div class='row'> \n
  <div class='column small-12'> \n
    <h1>" . $a['title'] . "</h1> \n
  </div> \n
  <div class='column small=12 medium-8 large-6 medium-centered single-video " . $a['class'] . "'> \n
    <video controls=''> \n
      <source src='" . content_url() . "/uploads/" . $a['video'] . ".mp4' type='video/mp4'> \n
      <source src='" . content_url() . "/uploads/" . $a['video'] . ".ogv' type='video/ogg'> \n
    </video> \n
  </div> \n
</div>";
}

add_shortcode('videosingle', 'video_single_shortcode');
?>