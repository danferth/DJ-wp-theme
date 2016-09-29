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
        <img ng-src='".$prod_url."{{ p.image }}'/>
      </div>
      
      <div class='partnumber_text small-12 show-for-small-only column'>
        <ul>
          <li class='partnumber_title' ng-bind-html='p.title'><i class='fa fa-spinner' aria-hidden='true'></i></li>
          <li class='partnumber_description' ng-bind-html='p.description1'><i class='fa fa-spinner' aria-hidden='true'></i></li>
          <li class='partnumber_description' ng-bind-html='p.description2'><i class='fa fa-spinner' aria-hidden='true'></i></li>
        </ul>
        <ul>
          <li class='partnumber_number' ng-repeat='pn in p.partNumber'>
          pn# {{ pn.num }} | case/qty: {{ pn.qty }}
          </li>
        <ul>
      </div>
      
      <div class='partnumber_text show-for-medium-up medium-5 column'>
        <ul>
          <li class='partnumber_title' ng-bind-html='p.title'><i class='fa fa-spinner' aria-hidden='true'></i></li>
          <li class='partnumber_description' ng-bind-html='p.description1'><i class='fa fa-spinner' aria-hidden='true'></i></li>
          <li class='partnumber_description' ng-bind-html='p.description2'><i class='fa fa-spinner' aria-hidden='true'></i></li>
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
  
  $output = "
<div class='row'>\n
  <div class='first small-12 column'>\n
    <select name='product' ng-model='product'>\n
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
    </select>\n
  </div>\n
</div>";
  return $output;
}
add_shortcode('tech_select', 'tech_select_shortcode');


//Display tech library link
//[tech_link]
function tech_link_shortcode($atts, $content, $tag){
  $output = "
  <div class='tech-link' ng-click='sendId(n.id);'>\n
    <p class='tech-link-title'>
      <i class=' tech-pdf-icon fa fa-file-pdf-o' ng-if='n.linkType==\"pdf\"'></i>
      <i class=' tech-video-icon fa fa-video-camera' ng-if='n.linkType==\"mp4\"'></i>
      </i><span ng-bind-html='n.title'><i class='fa fa-spinner' aria-hidden='true'></i></span>
    </p>\n
    <p class='tech-link-description' ng-bind-html='n.description'><i class='fa fa-spinner' aria-hidden='true'></i></p>\n
    <p class='tech-link-citation' ng-bind-html='n.citation'><i class='fa fa-spinner' aria-hidden='true'></i></p>\n
  </div>";
  return $output;
}
add_shortcode('tech_link', 'tech_link_shortcode');

//****************************************************************************************************************
//***********************************************PAGE LAYOUT******************************************************
//****************************************************************************************************************

function shortcode($atts, $content, $tag){
  $a = shortcode_atts( array(
    'att1' => 'default',
    'att2' => 'default'
    ), $atts);
    $output = "markup";
    return $output;
}
add_shortcode('element', 'function');

//***hero image with select for industry*****
//[hero_select src="folder/image.jpg" class="" placeholder="placeholder" product="for industry in app.js"]
function hero_select_shortcode($atts, $content, $tag){
  $a = shortcode_atts( array(
    'src' => '',
    'class' => '',
    'placeholder' => '',
    'product' => ''
    ), $atts);
    $output = "<div class='full-background ".$a['class']." show-for-medium-up row'>\n
		<img src='".content_url('/uploads/') . $a['src'] ."'/>\n
	<div class='full-background-select medium-12 column'>\n
		<select name='sub-science' ng-model='industry' ng-options='".$a['product'].".label for ".$a['product']." in ".$a['product']."_options'>\n
			<option value=''>".$a['placeholder']."</option>\n
		</select>\n
	</div>\n
</div>\n
\n
<div class='show-for-small-only row'>\n
	<div class='small-12 column'>\n
		<select name='sub-science' ng-model='industry' ng-options='".$a['product'].".label for ".$a['product']." in ".$a['product']."_options'>\n
			<option value=''>".$a['placeholder']."</option>\n
		</select>\n
	</div>\n
</div>";
    return $output;
}
add_shortcode('hero_select', 'hero_select_shortcode');

//*******full page width image******
//[image_full src=“image.jpg]
function image_full_shortcode($atts, $content, $tag){
  $a = shortcode_atts( array(
    'src' => ''
    ), $atts);
    $output="<div class='row'>
		<img src='".content_url('/uploads/') . $a['src'] ."'/>\n
    </div>";
    return $output;
}
add_shortcode('image_full', 'image_full_shortcode');

//**********intro paragraph and inquiry module
//[intro_quiry title="header" product="for emails sent"]
//<p>content</p>
//[/intro_quiry]
function intro_quiry_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array(
    'title' => '',
    'product' => ''
    ), $atts);
    $output = "
    <div class='row'>\n
	    <div class='small-12 medium-6 large-7 column'>\n
		    <h2>".$a['title']."</h2>\n
		    ".$content."
	    </div>\n
	    <div class='small-12 medium-6 large-5 column'>\n
		    <product-inquiry product='".$a['product']."'></product-inquiry>\n
	    </div>\n
    </div>";
  return $output;
}
add_shortcode('intro_quiry', 'intro_quiry_shortcode');

//******text on the left image on the right***********
//[text_image src="image" caption="caption" title="header"]
//<p>text</p>
//[/text_image]
function text_image_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array(
    'src' => '',
    'caption' => '',
    'title' => ''
    ), $atts);
    $output = "
    <div class='row'>\n
	    <div class='small-12 medium-7 large-5 column'>\n
		    <h2>".$a['title']."</h2>\n
		    ".$content."
	    </div>\n
	    <div class='small-12 medium-5 large-7 column'>\n
		    <img src='".content_url('/uploads/') . $a['src'] ."'/>\n
		    <p class='disclaimer'>".$a['caption']."</p>\n
	    </div>\n
    </div>";
    return $output;
}
add_shortcode('text_image', 'text_image_shortcode');

//******text on the left image on the right***********
//[text_image src="image" caption="caption" title="header"]
//<p>text</p>
//[/text_image]
function image_text_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array(
    'src' => '',
    'caption' => '',
    'title' => ''
    ), $atts);
    $output = "
    <div class='row'>\n
	    <div class='small-12 medium-7 large-5 column'>\n
		    <img src='".content_url('/uploads/') . $a['src'] ."'/>\n
		    <p class='disclaimer'>".$a['caption']."</p>\n
	    </div>\n
	    <div class='small-12 medium-5 large-7 column'>\n
		    <h2>".$a['title']."</h2>\n
		    ".$content."
	    </div>\n
    </div>";
    return $output;
}
add_shortcode('image_text', 'image_text_shortcode');

//**********dual images*************
// [dual_image
// l_title=”left title”
// l_src=”left image”
// l_caption=”left caption”
// r_title=”right title”
// r_src=”right image”
// r_caption=”right caption”]

function dual_image_shortcode($atts, $content, $tag){
  $a = shortcode_atts(array(
    'l_title'   => '',
    'l_src'     => '',
    'l_caption' => '',
    'r_title'   => '',
    'r_src'     => '',
    'r_caption' => ''
    ), $atts);
    $output="
    <div class='row'>\n
	<div class='small-12 medium-6 column'>\n
		<h2>".$a['l_title']."</h2>\n
		<img src='".content_url('/uploads/') . $a['l_src'] ."'/>\n
		<p class='disclaimer'>".$a['l_caption']."</p>\n
	</div>\n
\n
	<div class='small-12 medium-6 column'>\n
		<h2>".$a['r_title']."</h2>\n
		<img src='".content_url('/uploads/') . $a['r_src'] ."'/>\n
		<p class='disclaimer'>".$a['r_caption']."</p>\n
	</div>\n
</div>";
    return $output;
}
add_shortcode('dual_image', 'dual_image_shortcode');

//********column text just text***************************
//[column_text title="header"]
//<p>ONLY P TAGS ALLOWD</p>
//[/column_text]
function column_text_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array(
    'title' => ''
    ), $atts);
    $output = "
    <div class='row'>\n
      <div class='small-12 column'>\n
        <h2>".$a['title']."</h2>
      </div>\n
      <div class='column-text small-12 column'>\n
        ".$content."\n
      </div>\n
    </div>";
    return $output;
}
add_shortcode('column_text', 'column_text_shortcode');

//******video row with descriptive paragraph**************
//[product_video src='video file name.mp4' title='title of video']
//<p>content for paragraph next to video</p>
//[/product_video]

function product_video_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array(
    'title' => '',
    'src' => ''
    ), $atts);
  $output = "
    <div class='video-row row'>\n
	<div class='small-12 column'>\n
		<h2>" . $a['title'] . "</h2>\n
	</div>\n
	<div class='video-row-video small-12 medium-6 large-7 column'>\n
		<div class='flex-video widescreen'>\n
			<video src='" . content_url('/uploads/video/videos/').$a['src'] . "' controls>\n
  			Sorry, your browser doesn't support embedded videos, but don't worry, you can <a href='" . content_url('/uploads/video/videos/').$a['src'] . "'>download it</a> and watch it with your favorite video player!\n
			</video>\n
		</div>\n
	</div>\n

	<div class='video-row-text small-12 medium-6 large-5 column'>\n
		" . $content . "
	</div>\n
</div>";

return $output;
}
add_shortcode('product_video', 'product_video_shortcode');

//**********comparison********************
// [comparison class=" " title=" "]
//     [comparison_left l_title=" "]
//       <ul></ul>
//     [/comparison_left]
//     [comparison_right r_title=" "]
//       <ul></ul>
//     [/comparison_right]
// [/comparison]

//[comparison_left l_title=" "]
function comparison_left_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array(
    'l_title' => ''
    ), $atts);
    $output = "
    <div class='comparison-left small-12 medium-6 column'>
      <h4>".$a['l_title']."</h4>
      ".$content."
    </div>
    ";
    return $output;
}
add_shortcode('comparison_left', 'comparison_left_shortcode');

//[comparison_right r_title=" "]
function comparison_right_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array(
    'r_title' => ''
    ), $atts);
    $output = "
    <div class='comparison-right small-12 medium-6 column'>
      <h4>".$a['r_title']."</h4>
      ".$content."
    </div>
    ";
    return $output;
}
add_shortcode('comparison_right', 'comparison_right_shortcode');

//[comparison class=" " title=" "]
function comparison_shortcode($atts, $content=null, $tag){
  $a = shortcode_atts( array(
    'class' => '',
    'title' => '',
    ), $atts);
    $output = "<div class='comparison row ".$a['class']."'>";
    if($a['title']){$output .= "<div class='small-12 column'>
        <h4>".$a['title']."</h4>
      </div>";}
    $output .= do_shortcode($content) . "</div>";
    return $output;
}
add_shortcode('comparison', 'comparison_shortcode');

//*****tech link module**********
// [tech_link_module
// title=""
// key1=""
// value1=""
// key2=""
// value2=""]
function techlink_module_shortcode($atts, $content, $tag){
  $a = shortcode_atts( array(
    'title'   => '',
    'key1'    => '',
    'value1'  => '',
    'key2'    => '',
    'value2'  => ''
    ), $atts);
  $output = "
  <div class='row tech-link-module'>
	<div class='small-12 column'>
		<h4>".$a['title']."</h4>
	</div>
<div class='tech-link-wrap small-12 column' ng-repeat=";
  $output .='"';
  $output .= "n in techdata | filter:{".$a['key1']." : '".$a['value1']."', ".$a['key2']." : '".$a['value2']."'} | limitTo:5";
  $output .= '">';
  $output .= do_shortcode('[tech_link]');
  $output .= "</div></div>";
  return $output;
}
add_shortcode('tech_link_module', 'techlink_module_shortcode');

?>
