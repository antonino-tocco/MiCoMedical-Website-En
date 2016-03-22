<?php
/**
 * Template Name: Home
 *
 * @package WordPress
 * @subpackage Clinico
 * @since Clinico 1.0
 */
if (isset($_GET['asearch'])) {
		get_template_part('search-staff');
		return;
	}
	$cws_stored_meta = get_post_meta( $post->ID, 'cws-mb' );
	if (isset( $cws_stored_meta[0]['cws-mb-sb_override'] )) {
		get_template_part('blog');
		return;
	}

	get_header();

	$pid = get_query_var("page_id");
	$pid = !empty($pid) ? $pid : get_queried_object_id();
	$sb = cws_GetSbClasses($pid);
	$sb_block = $sb['sidebar_pos'];
	$class_container = 'page-content' . (cws_has_sidebar_pos($sb_block) ? ( 'both' == $sb_block ? ' double-sidebar' : ' single-sidebar' ) : '');
	?>
	<div class="<?php echo $class_container; ?>">
		<div class="container">
		<?php
			if (cws_has_sidebar_pos($sb_block)) {
				if ('both' == $sb_block) {
					echo '<aside class="sbleft">';
					dynamic_sidebar($sb['sidebar1']);
					echo '</aside>';
					echo '<aside class="sbright">';
					dynamic_sidebar($sb['sidebar2']);
					echo '</aside>';
				} else {
					echo '<aside class="sb'.$sb_block.'">';
					dynamic_sidebar($sb['sidebar1']);
					echo '</aside>';
				}
			}
		?>
		<main>
			<div class="col-sm-8 col-xs-12">
				<div class="col-sm-12 col-xs-12" ng-controller="NewsController">
					<header>
						<h3>News</h3>
						<hr />
					</header>
					<div class="page">
						<div class="row news-row" ng-repeat="news in newsPages[0].newsList track by $index">
							<p><strong>{{ news.date }} </strong> - <a href="{{ news.url }}">{{ news.title }}</a></p>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-xs-12" ng-controller="EventsController">
					<header>
						<h3>Events</h3>
						<hr />
					</header>
					<div class="page">
						<div class="row news-row" ng-repeat="event in eventPages[0].eventsList track by $index">
							<p><strong>EVENT - {{ event.date }} </strong> - <a href="{{ event.url }}">{{ event.title }}</a></p>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<?php
						if (have_posts()):
							while ( have_posts() ): the_post();
								the_content();
							endwhile;
						endif;
					?>
				</div>
				<div class="col-ms-12" ng-controller="NewsController">

				</div>
			</div>
			<div class="col-sm-4 col-xs-12" ng-controller="MapController">
				<header>
					<h3>Where We Are</h3>
					<hr />
				</header>
				<div id="map-italy" style="height:400px">

				</div>
			</div>
		</main>
		</div>
	</div>

<?php get_footer(); ?>