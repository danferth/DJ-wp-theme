<?php
/*
Template Name: distributors
*/
if(get_post_meta($post->ID, "has-prefooter")){
$prefooter_class = "has-prefooter";
}else{
	$prefooter_class = "";
}


get_header(); ?>

<?php get_template_part( 'parts/featured-image' ); ?>

<div class="row full-page-top <?php echo $prefooter_class; ?>" ng-app="distributors" ng-controller="distController">
	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title">Thomson Distributors</h1>
			</header>
	<div class="small-12 large-12 columns" role="main">

			<div class="entry-content">
				
				<div class="row">
					<div class="column small-12 medium-11 medium-centered radius distributor-single-view clearfix">
						<h3 class="company" ng-bind="distributors[distId].company"><i class="fa fa-spinner fa-spin"></i></h3>
						<ul class="products">
							<li ng-repeat="p in distributors[distId].products" ng-bind="p"></li>
						</ul>
						<pre class="address" ng-bind="distributors[distId].address"><i class="fa fa-spinner fa-spin"></i></pre>
						<div class="column small-12 medium-6 large-3">
							<p class="phone" ng-bind="distributors[distId].tel"><i class="fa fa-spinner fa-spin"></i></p>
							<p class="phone" ng-if="hasTel2" ng-bind="distributors[distId].tel2"><i class="fa fa-spinner fa-spin"></i></p>
							<p class="fax" ng-if="hasFax" ng-bind="distributors[distId].fax"><i class="fa fa-spinner fa-spin"></i></p>
						</div>
						<div class="column small-12 medium-6 large-3 end">
							<p class="website"><i class="fa fa-globe"></i>
								<a href="{{ distributors[distId].webUrl }}" target="_blank" ng-bind="distributors[distId].web"></a>
							</p>
							<p class="email" ng-if="hasEmail"><i class="fa fa-envelope"></i>
								<a href="mailto:{{ distributors[distId].email }}?subject=Inquiry on Thomson Products&bcc=folks@htslabs.com" ng-bind="distributors[distId].email"></a>
							</p>
						</div>
						<div class="column small-12">
							<p class="notes" ng-if="hasNotes" ng-bind="distributors[distId].special"><b>Notes:</b> </p>
						</div>
					</div>
					<div class="column small-6 small-centered joyride-help">Need help using this page? <i class="fa fa-question-circle fa-large animated pulse infinite"></i></div>
				</div>
				
				<div class="row distributor-form">
					<div class="columns small-12 medium-11 medium-centered">
					<h3>Refine your search for a distributor</h3>
					<ul class="button-group even-4 stack-for-small" id="stop2">
					<li><a href="" class="button medium" ng-click="filterType='africa'">Africa</a></li>
					<li><a href="" class="button medium" ng-click="filterType='europe'">Europe</a></li>
					<li><a href="" class="button medium" ng-click="filterType='north-america'">North America</a></li>
					<li><a href="" class="button medium" ng-click="filterType='oceana'">Oceana</a></li>
					<li><a href="" class="button medium" ng-click="filterType='asia'">Asia</a></li>
					<li><a href="" class="button medium" ng-click="filterType='middle-east'">Middle East</a></li>
					<li><a href="" class="button medium" ng-click="filterType='south-america'">South America</a></li>
					<li><a href="" class="button medium" ng-click="filterType='worldwide'">worldwide</a></li>
					</ul>
					<select class="small-12" name="product" id="product" ng-model="search.products">
							<option value="">search by product</option>
							<option value="All Products">All Products</option>
							<option value="Filter Vials">Filter Vials</option>
							<option value="Well Plates">Well Plates</option>
							<option value="Flasks">Flasks & Accessories</option>
							<option value="Plasmid+">Plasmid+</option>
						</select>
				</div>
				</div>

				<table role="grid">
					<thead>
						<tr>
							<th id="stop4">
								View
							</th>
							<th>
								<a href="" ng-click="sortType='company';sortReverse=!sortReverse">Company</a>
								<i class="fa" ng-class="sortReverse ? 'fa-caret-up' : 'fa-caret-down'"></i>
							</th>
							<th class="hide-for-small-only">
								<a href="" ng-click="sortType = 'country';sortReverse=!sortReverse">Country</a>
								<i class="fa" ng-class="sortReverse ? 'fa-caret-up' : 'fa-caret-down'"</i></i></th>
							<th id="stop1">phone</th>
							<th class="hide-for-small-only">Fax</th>
							<th>website</th>
							<th>email</th>
						</tr>
					</thead>
					<tbody>
					<tr ng-repeat="d in distributors | orderBy:sortType:sortReverse | filter:filterType | filter:search">
						<td>
							<button style="margin:0; padding:.5rem;" class="tiny button radius" value="{{ d.id }}" ng-click="singleDist($event); scrollToTop()"><i class="fa fa-info-circle fa-lg" value="{{ d.id }}"></i></button>
						</td>
						<td>{{ d.company }}</td>
						<td class="hide-for-small-only">{{ d.country }}</td>
						<td>{{ d.tel }}</td>
						<td class="hide-for-small-only">{{ d.fax }}</td>
						<td><a href="{{ d.webUrl }}" target="_blank">{{ d.web }}</a></td>
						<td><a href="mailto:{{ d.email }}?subject=Inquiry on Thomson Products&bcc=folks@htslabs.com">{{ d.email }}</a></td>
					</tr>	
					</tbody>
					
				</table>
				
				<?php the_content(); ?>
			</div>

	<?php endwhile; // End the loop ?>

	</div>
		</article>
</div>


<ul class="joyride-list" data-joyride>
	
	<li data-text="next" data-options="prev_button: false">
		<p>Welcome to Thomson's Distributors page. Let's take a moment to show you how it works.</p>
		<p>Promise really quick & simple. :o)</p>
	</li>
	
	<li data-id="stop1" data-text="next" data-prev-text="back" data-options="tip_location:top">
		<p>This is a full list of our distributors worldwide.</p>
		<p>You can <i>click</i> on the <b>company</b> or <b>country</b> headings to sort the list.</p>
	</li>
	
	<li data-id="stop2" data-text="next" data-prev-text="back" data-options="tip_location:top">
		<p>Use these buttons to narrow your search by region (try clicking on "Asia").</p>
		<p>The list will update to show only distributors supplying our products in Asia!</p>
	</li>
	
	<li data-id="product" data-text="next" data-prev-text="back" data-options="tip_location:top">
		<p>You can also use the dropdown to narrow the search further by product lines. Try clicking anywhere in the dropdown bar and select "Filter Vials".</p>
		<p>The list is now further reduced to suppliers of our Filter Vials in Asia!</p>
	</li>
	
	<li data-id="stop4" data-text="next" data-prev-text="back" data-options="tip_location:right">
		<p>Once you find a distributor, <i>click</i> the <i class="fa fa-info-circle"></i> icon to view the full entry for the distributor.</p>
	</li>
	
	<li data-text="Done" data-options="prev_button:false">
		<p>The page will scroll to the top showing the full contact information for the distributor you chose.</p>
		<p>Thanks for taking part in learning how to use our distributors' page!</p>
	</li>

</ul>

<script>
jQuery(document).ready(function($){
	$('.joyride-help').on('click', function(){
		$(document).foundation('joyride', 'start');
	});
});
</script>

<?php get_footer(); ?>
