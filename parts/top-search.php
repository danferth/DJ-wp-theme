<?php
/**
 * Template part for top bar menu
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<div class="extend">
    	
        <?php do_action( 'foundationpress_before_searchform' ); ?>
        
<form class="top-search-bar" role="search" method="get" id="cse-search-box" action="<?php echo home_url( '/results/' ); ?>">
	<div class="row collapse">
		<?php do_action( 'foundationpress_searchform_top' ); ?>
		<div class="column small-12 medium-8 large-10">
			<input type="hidden" name="cx" value="009032756241832010141:tvv1cneufti" />
    		<input type="hidden" name="cof" value="FORID:10;NB:1" />
    		<input type="hidden" name="ie" value="UTF-8" />
			<input type="text" name="q" maxlength="36" size="17" placeholder="search our site"/>
		</div>
		<?php do_action( 'foundationpress_searchform_before_search_button' ); ?>
		<div class="column small-12 medium-4 large-2">
			<button type="submit" class="prefix button success" name="sa">
				<i class="fa fa-search fa-large"></i>
			</button>
		</div>
		<?php do_action( 'foundationpress_searchform_after_search_button' ); ?>
	</div>
</form>

<?php do_action( 'foundationpress_after_searchform' ); ?>

</div>