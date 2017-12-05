<?php
/**
 * Template part for top bar menu
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<?php do_action( 'foundationpress_before_searchform' ); ?>
	<div class="extend">
  	<div class="row collapse">
<?php do_action( 'foundationpress_searchform_top' ); ?>
    	<div class="small-11 medium-5 medium-push-6 large-3 large-push-8 column">
      	<input type="text" class="addsearch" disabled="disabled" placeholder="search our site"/>
<script type="text/javascript" src="https://addsearch.com/js/?key=aac30ee18dff91a379e2dba65df683ef"></script>
    	</div>
<?php do_action( 'foundationpress_searchform_before_search_button' ); ?>
    	<div class="small-1 medium-1 large-1 column">
      	<button type="submit" class="postfix button" name="sa">
					<i class="fa fa-search fa-large"></i>
				</button>
    	</div>
<?php do_action( 'foundationpress_searchform_after_search_button' ); ?>
  	</div>
	</div>
<?php do_action( 'foundationpress_after_searchform' ); ?>


<?php // do_action( 'foundationpress_before_searchform' ); ?>
<!--<form class="top-search-bar" role="search" method="get" id="cse-search-box" action="<?php // echo home_url( '/results/' ); ?>">-->
	<!--<div class="extend">-->
 <!-- 	<div class="row collapse">-->
<?php // do_action( 'foundationpress_searchform_top' ); ?>
    <!--	<div class="small-11 medium-5 medium-push-6 large-3 large-push-8 column">-->
    <!--  	<input type="hidden" name="cx" value="009032756241832010141:tvv1cneufti" />-->
		  <!--	<input type="hidden" name="ie" value="UTF-8" />-->
		  <!--	<input type="hidden" name="cof" value="FORID:10;NB:1" />-->
				<!--<input type="text" name="q" maxlength="36" size="17" placeholder="search our site"/>-->
    <!--	</div>-->
<?php // do_action( 'foundationpress_searchform_before_search_button' ); ?>
    <!--	<div class="small-1 medium-1 large-1 column">-->
    <!--  	<button type="submit" class="postfix button" name="sa">-->
				<!--	<i class="fa fa-search fa-large"></i>-->
				<!--</button>-->
    <!--	</div>-->
<?php // do_action( 'foundationpress_searchform_after_search_button' ); ?>
<!--  	</div>-->
<!--	</div>-->
<!--</form>-->
<?php // do_action( 'foundationpress_after_searchform' ); ?>