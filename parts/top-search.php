<?php
/**
 * Template part for top bar menu
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<div class="row top-search">
    <div class="columns small-12">
        <?php do_action( 'foundationpress_before_searchform' ); ?>
<form role="search" method="get" id="cse-search-box" action="<?php echo home_url( '/results/' ); ?>">
	<div class="row collapse">
		<?php do_action( 'foundationpress_searchform_top' ); ?>
		<div class="small-10 columns">
			<input type="hidden" name="cx" value="009032756241832010141:tvv1cneufti" />
    		<input type="hidden" name="cof" value="FORID:10;NB:1" />
    		<input type="hidden" name="ie" value="UTF-8" />
			<input type="text" name="q" maxlength="36" size="17" placeholder="search our site"/>
		</div>
		<?php do_action( 'foundationpress_searchform_before_search_button' ); ?>
		<div class="small-2 columns">
			<input class="prefix button" type="submit" name="sa" value=<?php esc_attr_e( 'Search', 'foundationpress' ); ?> />
		</div>
		<?php do_action( 'foundationpress_searchform_after_search_button' ); ?>
	</div>
</form>
<?php do_action( 'foundationpress_after_searchform' ); ?>
    </div>
</div>