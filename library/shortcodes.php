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
    </video> \n
  </div> \n
</div>";
}

add_shortcode('videosingle', 'video_single_shortcode');

/*
[prefooterwrap class='added class']

[prefooter class='' link='link for prefooter']
content for prefooter
[/prefooterleft]

[prefooter class='' link='link for prefooter']
content for prefooter
[/prefooterleft]

[/prefooter]
somewhat complicated but better to adjust it a year later here than on every page
*/
function prefooterwrap_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array('class' => ''), $atts);
    return "<div class='row hide-for-small-only prefooter-wrap ". $a['class'] ."'> \n
    " . do_shortcode($content) . " \n
    </div>";
}

function prefooter_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array(
      'class' => '',
      'link' => ''
    ), $atts);
  return "<div class='column small-12 medium-6 prefooter " . $a['class'] . "' data-prefooterlink='" . get_home_url() . "/" . $a['link'] . "'> \n
  <p>" . $content . "</p> \n
</div>";
}

add_shortcode('prefooterwrap', 'prefooterwrap_shortcode');
add_shortcode('prefooter', 'prefooter_shortcode');

/*
[partnumberblock]

[partnumber 
img  ='partnumber' 
dec1 ='name of product' 
dec2 ='secondary description' 
qty1 ='case qty option 1' 
pn1  ='option 1 part number' 
qty2 ='case qty option 2' 
pn2  ='option 2 part number']

[/partnumberblock]
*/
function partnumberblock_shortcode($atts, $content = null, $tag){
  $a = shortcode_atts( array(
      'class' => ''
    ), $atts);
  return "<div class='row partNumbers'> \n
      <div class='column small-12'> \n
      <h1>Part Numbers</h1> \n
      <ul class='small-block-grid-1 medium-block-grid-2 large-block-grid-3 " . $a['class'] . "'> \n
      " . do_shortcode($content) . " \n
      </ul> \n
      </div> \n
      </div>";
}

function partnumber_shortcode($atts, $content, $tag){
  $a = shortcode_atts(array(
      'img'  => 'no_image',
      'dec1' => 'this product needs a name!',
      'dec2' => 'this product needs a description',
      'qty1'  => '',
      'pn1'  => '',
      'qty2' => '',
      'pn2'  => ''
    ), $atts);
    
    if($a['qty2'] === '' && $a['pn2'] === ''){
      $qty_pn = "<li class='part_num'>Case Qty: " . $a['qty1'] . " | Part # " . $a['pn1'] . "</li> \n";
    }else {
      $qty_pn = "<li class='part_num'>Case Qty: " . $a['qty1'] . " | Part # " . $a['pn1'] . "</li> \n
                 <li class='part_num'>Case Qty: " . $a['qty2'] . " | Part # " . $a['pn2'] . "</li> \n";
    }
    
    return "<li> \n
              <div class='row small-collapse'> \n
                <div class='column small-8 small-centered medium-4 medium-uncentered'> \n
                  <img src='http://htslabs.com/images/products/" . $a['img'] . "_lg.jpg' alt='" . $a['dec1'] . "' /> \n
                </div> \n
                <div class='column small-12 medium-8'> \n
                  <ul class='partNumbers_text_block'> \n
                    <li class='desc_1'>" . $a['dec1'] . "</li> \n
                    <li class='desc_2'>" . $a['dec2'] . "</li> \n
                    $qty_pn
                  </ul> \n
                </div> \n
              </div> \n
            </li>";
}

add_shortcode('partnumberblock', 'partnumberblock_shortcode');
add_shortcode('partnumber', 'partnumber_shortcode');


//[tech-vid-block product='' video='' date='']video title[/tech-vid-block]
function tech_vid_block_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array(
      'product' => '',
      'video' => '',
      'date' => '01/01/2015'
    ), $atts);
    
    return "
    <li data-date='". $a['date'] ."'> \n
      <a class='video_link_". $a['product']  ."' href='".get_home_url()."/tech-video/?video=". $a['video']  ."&title=". $content  ."'> \n
        <img src='". content_url() . "/uploads/video/thumbs/" .  $a['product'] . "/" . $a['video']  . ".png' width='200' height='112' > \n
        <span class='video-title'>".$content."</span> \n
      </a> \n
    </li>";
}

add_shortcode('tech-vid-block', 'tech_vid_block_shortcode');

?>