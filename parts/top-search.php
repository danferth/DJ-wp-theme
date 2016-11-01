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
<form class="top-search-bar" role="search" method="get" id="cse-search-box" action="<?php echo home_url( '/results/' ); ?>">
	<div class="extend hide-for-small-only">
  	<div class="row collapse">
<?php do_action( 'foundationpress_searchform_top' ); ?>
    	<div class="medium-5 medium-push-6 large-3 large-push-8 column">
      	<input type="hidden" name="cx" value="009032756241832010141:tvv1cneufti" />
		  	<input type="hidden" name="cof" value="FORID:10;NB:1" />
		  	<input type="hidden" name="ie" value="UTF-8" />
				<input type="text" name="q" maxlength="36" size="17" placeholder="search our site"/>
    	</div>
<?php do_action( 'foundationpress_searchform_before_search_button' ); ?>
    	<div class="medium-1 large-1 column">
      	<button type="submit" class="postfix button" name="sa">
					<i class="fa fa-search fa-large"></i>
				</button>
    	</div>
<?php do_action( 'foundationpress_searchform_after_search_button' ); ?>
  	</div>
	</div>
</form>
<?php do_action( 'foundationpress_after_searchform' ); ?>