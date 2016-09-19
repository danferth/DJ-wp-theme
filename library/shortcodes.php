<?php
//[mainblock title='title' class='addedclass' img='src' link='href']<p>content</p>[/mainblock]
//this needs to be placed inside ( div.row>div.column.small-12 ) at the minimum
function mainblock_shortcode($atts, $content = null, $tag){
    $a = shortcode_atts( array(
            'title'  => 'needs a title',
            'img'    => '',
            'class'  => '',
            'link'   => home_url()
        ), $atts);
    return "<li class='main-block " . $a['class'] . "' data-mainblocklink='" . home_url() . "/" . $a['link'] . "'> \n
              <div class='inner-block' data-equalizer-watch='block'> \n
                <div class='main-block-image-wrap'> \n
                  <img src='" . get_template_directory_uri(). "/images/" . $a['img'] . "' /> \n
                </div> \n
                
                  <h3>" . $a['title'] . "</h3> \n
                  <p>" . $content . "</p> \n
                
              </div> \n
            </li>";
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
    return "<li class='" . $a['class'] . "' data-appblocklink='" . home_url() . "/" . $a['link'] . "'> \n
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
  return "<div class='column small-12 medium-6 prefooter " . $a['class'] . "' data-prefooterlink='" . home_url() . "/" . $a['link'] . "'> \n
  <p>" . $content . "</p> \n
</div>";
}

add_shortcode('prefooterwrap', 'prefooterwrap_shortcode');
add_shortcode('prefooter', 'prefooter_shortcode');


//[tech-vid-block product='' video='' date='']video title[/tech-vid-block]
function tech_vid_block_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array(
      'product' => '',
      'video' => '',
      'date' => '01/01/2015'
    ), $atts);
    
    return "
    <li data-date='". $a['date'] ."'> \n
      <a class='video_link_". $a['product']  ."' href='". home_url() ."/tech-video/?video=". $a['video']  ."&title=". $content  ."'> \n
        <img src='". content_url() . "/uploads/video/thumbs/" .  $a['product'] . "/" . $a['video']  . ".png' width='200' height='112' > \n
        <span class='video-title'>".$content."</span> \n
      </a> \n
    </li>";
}

add_shortcode('tech-vid-block', 'tech_vid_block_shortcode');


//====================
//IMAGES IMAGES IMAGES
//====================

//ANGULAR IMAGES
//[ng_product_image src='' width='' height='']
function ng_product_image_shortcode($atts, $content, $tag){
  $a = shortcode_atts( array(
    'src'     => '',
    'width'   => '',
    'height'  => ''
    ), $atts);
  $prod_url =  content_url('/uploads/products/');
  $output = "<img ng-src='".$prod_url."{{".$a['src']."}}' alt='{{".$a['src']."}}' width='".$a['width']."' height='".$a['height']."' />";

    return $output;
}

add_shortcode('ng_product_image', 'ng_product_image_shortcode');

//JUST AN IMAGES TAG
//[img class='myClass' src='folder/in/uploads/image.jpg' width='100' height='100' alt='alt-text']
function img_shortcode($atts, $content, $tag){
    $a = shortcode_atts(array(
            'class' => '',
            'src' => '',
            'width' => '',
            'height' => '',
            'alt' => ''
        ), $atts);
    $dir =  content_url('/uploads/');
    $output = "<img class='".$a['class']."' src='".$dir ."/".$a['src'] ."' width='".$a['width']."' height='".$a['height']."' alt='".$a['src']."'/>";
    return $output;
}
add_shortcode('img', 'img_shortcode');

//STYLE ATTRIBUTE FOR BACKGROUND IMAGE
//[bgImage src="page/foobar.jpg"]
function bgImg_shortcode($atts, $content, $tag){
  $a = shortcode_atts(array(
      'src' => ''), $atts);
  $dir = content_url('/uploads/');
  $output = "style='background-image: url(\"" . $dir . $a['src'] . "\");'";
  return $output;
}
add_shortcode('bgImg', 'bgImg_shortcode');




//display part numbers for a given series
//[parts title='' series='' line='' filter='']
function parts_shortcode($atts, $content, $tag){
  $a = shortcode_atts( array(
    'title' => '',
    'line' => '',
    'series' => '',
    'filter' => ''
    ), $atts);
  $content_url = wp_upload_dir();
  $prod_url = $content_url['baseurl']."/products/";
  $output = "
  <div class='partnumber_set row'>
    
    <div class='small-12 column'>
    <h4>".$a['title']." Part Numbers</h4>
    </div>
    
    <div class='partnumber_item column small-12' ng-repeat='p in products | filter:{line:\"".$a['line']."\"} | filter:{series:\"".$a['series']."\"} | filter:\"".$a['filter']."\"'>
      
      <div class='partnumber_image show-for-medium-up medium-2 large-1 column'>
        <img ng-src='".$prod_url."{{ p.image }}' alt='{{ p.image }}'/>
      </div>
      
      <div class='partnumber_text small-12 show-for-small-only column'>
        <ul>
          <li class='partnumber_title'>{{ p.title }}</li>
          <li class='partnumber_description'>{{ p.description1 }}</li>
          <li class='partnumber_description'>{{ p.description2 }}</li>
        </ul>
        <ul>
          <li class='partnumber_number' ng-repeat='pn in p.partNumber'>
          pn# {{ pn.num }} | case/qty: {{ pn.qty }}
          </li>
        <ul>
      </div>
      
      <div class='partnumber_text show-for-medium-up medium-5 column'>
        <ul>
          <li class='partnumber_title'>{{ p.title }}</li>
          <li class='partnumber_description'>{{ p.description1 }}</li>
          <li class='partnumber_description'>{{ p.description2 }}</li>
        </ul>
      </div>
      <div class='partnumber_text show-for-medium-up medium-5 end column'>
        <ul>
          <li class='partnumber_number' ng-repeat='pn in p.partNumber'>
          pn# {{ pn.num }} | case/qty: {{ pn.qty }}
          </li>
        <ul>
      </div>
      
    </div>
  </div>
  ";
  return $output;
}

add_shortcode('parts', 'parts_shortcode');

//Tech Library select for product
//[tech_select]
function tech_select_shortcode($atts, $content, $tag){
  
  $output = "<select name='product' ng-model='product'>\n
  <option value=''>Select Product</option>\n
  <optgroup label='Filter Vials'>\n
    <option value='all'>All Filter Vials</option>\n
    <option value='standard'>Standard|Filter Vials</option>\n
    <option value='extreme'>eXtreme|FV®</option>\n
    <option value='nano'>nano|Filter Vial®</option>\n
    <option value='extractor'>eXtractor3D|FV®</option>\n
    <option value='mega'>MEGA|FV™</option>\n
    <option value='lowevap'>LowEvap|Filter Vial</option>\n
  </optgroup>\n
  <optgroup label='Optimum Growth™'>\n
    <option value='Oflask'>Optimum Growth™ Flask</option>\n
    <option value='TC'>Transfer Cap</option>\n
  </optgroup>\n
  <optgroup label='Ultra Yield™ Flask'>\n
    <option value='Uflask'>Ultra Yield™ Flask</option>\n
    <option value='plasmid'>Plasmid+®</option>\n
    <option value='airotop'>Enhanced AirOtop™ Seals</option>\n
  </optgroup>\n
  <option value='wellplate'>Well Plate</option>\n
  <option value='column'>SINGLE StEP® Flash Column</option>\n
</select>";
  return $output;
}
add_shortcode('tech_select', 'tech_select_shortcode');


//Tech Library select for product
//[tech_link]
function tech_link_shortcode($atts, $content, $tag){
  $output = "
  <div class='tech-link'>\n
    <p class='tech-link-title' ng-bind-html='n.title'></p>\n
    <p class='tech-link-description' ng-bind-html='n.description'></p>\n
    <p class='tech-link-citation' ng-bind-html='n.citation'></p>\n
  </div>";
  return $output;
}
add_shortcode('tech_link', 'tech_link_shortcode');




?>
