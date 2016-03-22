<?php
/**
 * Template Name: Products Category Page
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
			<main>
				<div class="col-sm-12">
					<h2>{{ productCategories[currentCategory].name }}</h2>
					<div ng-bind-html="productCategories[currentCategory].siteDescription"></div>
				</div>
			</main>
		</div>
	</div>

<?php get_footer(); ?>