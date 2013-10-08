<?php
/**
 * Template Name: Hazte Fan
 */
$a_signed_request = parse_signed_request($_REQUEST['signed_request'], APP_SECRET);
?>
<?php get_header(); ?>
<div class="canvas">
<?php if (!$a_signed_request['page']['liked']) { ?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="noes">
		<?php the_content(); ?>
	</div>
	<?php endwhile; // end of the loop. ?>
<?php }else{ ?>
	<script type="text/javascript">
		//location.href = 'https://www.facebook.com/dialog/oauth?client_id='+clientId+'&redirect_uri='+cbFB+'&scope=email,user_photos,publish_stream&state='+Math.floor(Math.random()*11);
		location.href = '<?php echo get_bloginfo("url"); ?>';
	</script>
<?php }?>
<?php get_footer(); ?>