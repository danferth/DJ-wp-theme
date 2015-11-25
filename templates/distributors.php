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
					<div class="column small-12 medium-6">
					<button class="medium radius" ng-click="filterType='africa'">Africa</button>
					<button class="medium radius" ng-click="filterType='europe'">Europe</button>
					<button class="medium radius" ng-click="filterType='north-america'">North America</button>
					<button class="medium radius" ng-click="filterType='oceana'">Oceana</button>
					<button class="medium radius" ng-click="filterType='asia'">Asia</button>
					<button class="medium radius" ng-click="filterType='middle-east'">Middle East</button>
					<button class="medium radius" ng-click="filterType='south-america'">South America</button>
					<button class="medium radius" ng-click="filterType='worldwide'">worldwide</button>
						<select name="product" id="product" ng-model="search.products">
							<option value="">search by product</option>
							<option value="All Products">All Products</option>
							<option value="Filter Vials">Filter Vials</option>
							<option value="Well Plates">Well Plates</option>
							<option value="Flasks">Flasks</option>
							<option value="Plasmid+">Plasmid+</option>
							<option value="Transfer Caps">Transfer Caps</option>
						</select>
				</div>
					<div class="column small-12 medium-6 panel radius distributor-single-view">
						<h4>{{ distributors[distId].company }}</h4>
						<h5 class="subheader"><i>{{ distributors[distId].products }}</i></h5>
						<p><pre>{{ distributors[distId].address }}</pre></p>
						<p><b>Tel:</b> {{ distributors[distId].tel }}</p>
						<p><b>Tel:</b> {{ distributors[distId].tel2 }}</p>
						<p><b>Fax:</b> {{ distributors[distId].fax }}</p>
						<p><b>website:</b> <a href="{{ distributors[distId].webUrl }}" target="_blank">{{ distributors[distId].web }}</a></p>
						<p><b>Email:</b> <a href="mailto:{{ distributors[distId].email }}?subject=Inquiry on Thomson Products&bcc=folks@htslabs.com">{{ distributors[distId].email }}</a></p>
						<p><b>Notes:</b> {{ distributors[distId].special }}</p>
				</div>
				</div>
				
				<table>
					<thead>
						<tr>
							<th>
								View Full
							</th>
							<th>
								<a href="" ng-click="sortType='company';sortReverse=!sortReverse">Company</a>
								<i class="fa" ng-class="sortReverse ? 'fa-caret-up' : 'fa-caret-down'"></i>
							</th>
							<th>
								<a href="" ng-click="sortType = 'country';sortReverse=!sortReverse">Country</a>
								<i class="fa" ng-class="sortReverse ? 'fa-caret-up' : 'fa-caret-down'"</i></i></th>
							<th>phone</th>
							<th>Fax</th>
							<th>website</th>
							<th>email</th>
						</tr>
					</thead>
					<tbody>
					<tr ng-repeat="d in distributors | orderBy:sortType:sortReverse | filter:filterType | filter:search">
						<td>
							<button style="margin:0;" class="tiny button radius" value="{{ d.id }}" ng-click="singleDist($event)"><i class="fa fa-user"></i></button>
						</td>
						<td>{{ d.company }}</td>
						<td>{{ d.country }}</td>
						<td>{{ d.tel }}</td>
						<td>{{ d.fax }}</td>
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

<?php get_footer(); ?>
