<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package muzka
 */

get_header(); ?>


<div class="featured">
	<div class="wrap-featured zerogrid">
		<div class="slider">
			<div class="rslides_container">
				<ul class="rslides" id="slider">
					
					<?php 
$args = array (
	'post_type' => 'slider'
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		?>
		<li><?php the_post_thumbnail('full'); ?></li>
	<?php
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();


					 ?>
				</ul>

					<script>
		jQuery(function () {
		  jQuery("#slider").responsiveSlides({
			auto: true,
			pager: false,
			nav: true,
			speed: 500,
			maxwidth: 962,
			namespace: "centered-btns"
		  });
		});
	</script>
			</div>
		</div>
	</div>
</div>

<!-- ------------Content------------- -->
<section id="content">
	<div class="wrap-content zerogrid">
		<div class="row block01">
			<?php 

$args = array (
	'category_name'          => 'featured',
	'posts_per_page'		=> '3'
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		?>
		<div class="col-1-3">
				<div class="wrap-col box">
					<h2><?php the_title(); ?></h2>
					<p><?php the_excerpt(); ?></p>
					<div class="more"><a href="<?php the_permalink(); ?>">[...]</a></div>
				</div>
			</div>

		<?php
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();
			 ?>
			
		</div>
		<div class="row block02">
			<div class="col-2-3">
				<div class="wrap-col">
					<div class="heading"><h2><?php _e('Latest Blog', 'muzka'); ?></h2></div>

								<?php 

$args = array (
	'category_name'          => 'blog',
	'posts_per_page'		=> '4'

);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		?>
		<article class="row">
						<div class="col-1-3">
							<div class="wrap-col">
								<?php the_post_thumbnail('front_thumb'); ?>
							</div>
						</div>
						<div class="col-2-3">
							<div class="wrap-col">
								<h2><a href="#"><?php the_title(); ?></a></h2>
								<div class="info">By <?php the_author_meta('display_name' ); ?> on <?php echo get_the_date(); ?> with <a href="#"><?php echo comments_number(); ?></a></div>
								<p>
									<?php the_excerpt(); ?></p>
							</div>
						</div>
			</article>

		<?php
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();
			 ?>


				</div>
			</div>
			<div class="col-1-3">
				<div class="wrap-col">
					<div class="box">
						<div class="heading"><h2>Latest Albums</h2></div>
						<div class="content">
							<img src="images/albums.png"/>
						</div>
					</div>
					<div class="box">
						<div class="heading"><h2>Upcoming Events</h2></div>
						<div class="content">
							<div class="list">
								<ul>

																	<?php 

$args = array (
	'post_type'          => 'events',
	'posts_per_page'		=> '4'

);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

		<br>
		<?php _e('Date', 'muzka'); ?>: <?php 
		$datum =  get_field('date'); 
		$ts = strtotime($datum);
		echo date('d. M Y', $ts);
		?>

		<br>

		<?php 
		$lokacija =  get_field('location');
		echo $lokacija['coordinates'];
		 ?>


    <script>
function initialize() {
  var mapOptions = {
    zoom: 12,
    center: new google.maps.LatLng(<?php echo $lokacija['coordinates']; ?>)
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
      'callback=initialize';
  document.body.appendChild(script);
}

window.onload = loadScript;

    </script>
    <div id="map-canvas"></div>
		</li>

		<?php
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();
			 ?>
									<li><a href="#">Magic Island Ibiza</a></li>
									<li><a href="#">Bamboo Is Just For You</a></li>
									<li><a href="#">Every Hot Summer</a></li>
									<li><a href="#">Magic Island Ibiza</a></li>
									<li><a href="#">Bamboo Is Just For You</a></li>
									<li><a href="#">Every Hot Summer</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, libero, laudantium, officiis unde saepe quidem minima cum rem numquam mollitia enim fuga eos recusandae ducimus ad soluta tenetur consectetur aliquam!