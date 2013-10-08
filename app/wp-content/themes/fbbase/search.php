<?php get_header(); ?>
	<div class="container" id="contenido">
	<?php
		if(is_search()){
			$s = esc_attr( get_query_var('s') );
			$allsearch = new WP_Query($args = array('posts_per_page' => -1, 's' => $s )); 
			$count = $allsearch->post_count;
			wp_reset_query(); 
	?>
		<h1 class="tit_search text-center">ENCONTRAMOS <span><?php print $count; ?> RESULTADOS</span> PARA <span><?php print strtoupper($s); ?></span></h1>
	<?php 
		} 
	?>
	<?php
		$daCategory = 0;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array('posts_per_page' => 5, 'paged' => $paged, 'orderby' => 'menu_order', 'order' => 'DESC', 's' => $s );
		query_posts($args);
		include TEMPLATEPATH . '/loop-items.php';
		wp_reset_query();
	?>
	</div>
<?php get_footer(); ?>
