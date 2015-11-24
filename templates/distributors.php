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
				<h1 class="entry-title">{{ welcome }}</h1>
			</header>
	<div class="small-12 large-12 columns" role="main">

			<div class="entry-content">
				
				<table>
					<thead>
						<tr>
							<th>Company</th>
							<th>Products Sold</th>
							<th>phone</th>
							<th>fax</th>
							<th>website</th>
							<th>email</th>
						</tr>
					</thead>
					<tbody>
					<tr ng-repeat="d in distributors">
						<td>{{ d.company }}</td>
						<td>{{ d.products }}</td>
						<td>{{ d.tel }}</td>
						<td>{{ d.fax }}</td>
						<td><a href="{{ d.webUrl }}">{{ d.web }}</a></td>
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
