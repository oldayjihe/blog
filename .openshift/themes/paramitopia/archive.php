<?php get_header(); $options = get_option('paramitopia_options'); ?>
<div id="content">
	<?php the_post(); ?>
	<div class="page-title">
		<?php if ( is_day() ) : ?>
			<h1><?php printf((__('Daily Archives:', 'paramitopia').' <span>%s</span>'),get_the_time(get_option('date_format'))); ?></h1>
		<?php elseif ( is_month() ) : ?>
			<h1><?php printf((__('Monthly Archives:', 'paramitopia').' <span>%s</span>'),get_the_time('F Y')); ?></h1>
		<?php elseif ( is_year() ) : ?>
			<h1><?php printf((__('Yearly Archives:', 'paramitopia').' <span>%s</span>'),get_the_time('Y')); ?></h1>
		<?php elseif ( is_category() ) : ?>
			<h1><?php printf((__('Category Archives:', 'paramitopia').' <span>%s</span>'),single_cat_title('',false)); ?></h1>
		<?php elseif ( is_tag() ) : ?>
			<h1><?php printf((__('Tag Archives:', 'paramitopia').' <span>%s</span>'),single_tag_title('',false)); ?></h1>
		<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
			<h1><?php _e('Blog Archives', 'paramitopia'); ?></h1>
		<?php endif; ?>
	</div><?php rewind_posts(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>"><!-- post div -->
		<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'paramitopia'), the_title_attribute('echo=0') ); ?>"><?php the_title(); ?></a></h2>
		<div class="post-info-top">
			<span class="post-info-date">
				<?php _e('Posted by', 'paramitopia'); ?> <?php the_author(); ?>　
				<?php _e('on', 'paramitopia'); ?> <!--<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark">--><?php the_time(get_option( 'date_format' )); ?><!--</a>-->　<?php edit_post_link(__('Edit','paramitopia'), '[', ']'); ?>
			</span>
			<span id="gotocomments"><!-- <?php comments_popup_link(__('None comments', 'paramitopia'), '1 '.__('comments', 'paramitopia'), '% '.__('comments', 'paramitopia')); ?> --><a href="<?php the_permalink(); ?>#comments"  rel="nofollow" title="Go to comments ?"><?php _e('Go to comments', 'paramitopia'); ?></a><?php if(function_exists('the_views')) { echo "   ";the_views(); } ?></span>
		</div>
		<div class="clear"></div>
		<div class="entry">
			<?php if ( $options['excerpt_check']=='true' ) { the_excerpt(__('Read more &raquo;','paramitopia')); } else { the_content(__('Read more &raquo;','paramitopia')); } ?>
		</div><!-- END entry -->
	</div><!-- END post -->
	<?php endwhile; else: ?>
	<div class="post post-single">
		<h2 class="title title-single"><?php _e('Error 404 - Not Found', 'paramitopia'); ?></h2>
		<div class="post-info-top" style="height:1px;"></div>
		<div class="entry">
			<p><?php _e('Sorry, but you are looking for something that isn&#8217;t here.', 'paramitopia'); ?></p>
			<h3><?php _e('Random Posts', 'paramitopia'); ?></h3>
			<ul>
				<?php
					$rand_posts = get_posts('numberposts=5&orderby=rand');
					foreach( $rand_posts as $post ) :
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<h3><?php _e('Tag Cloud', 'paramitopia'); ?></h3>
			<?php wp_tag_cloud('smallest=9&largest=22&unit=pt&number=200&format=flat&orderby=name&order=ASC');?>
		</div><!--entry-->
	</div><!--post-->
	<?php endif; ?>
<?php
if(function_exists('wp_page_numbers')) {
	wp_page_numbers();
}
elseif(function_exists('wp_pagenavi')) {
	wp_pagenavi();
} else {
	global $wp_query;
	$total_pages = $wp_query->max_num_pages;
	if ( $total_pages > 1 ) {
		echo '<div id="pagination">';
			posts_nav_link(' | ', __('&laquo; Previous page','paramitopia'), __('Next page &raquo;','paramitopia'));
		echo '</div>';
	}
}
?>
</div><!--content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>