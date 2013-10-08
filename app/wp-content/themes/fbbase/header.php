<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if lte IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

		?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

		<meta property="og:url" content="<?php bloginfo("url"); ?>/"/>
        <meta property="og:title" content="<?php bloginfo( 'name' ); ?>"/>
        <meta property="og:description" content="<?php print get_bloginfo( 'description', 'display' ); ?>"/>
        <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>"/>
        <meta property="og:image" content=""/>
		
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php print get_template_directory_uri(); ?>/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
		<script src="<?php print get_template_directory_uri(); ?>/js/rut.js"></script>
		<script src="<?php print get_template_directory_uri(); ?>/js/validate.js"></script>
		<script src="<?php print get_template_directory_uri(); ?>/js/main.js"></script>
		
		<link rel="stylesheet" href="<?php print get_template_directory_uri(); ?>/css/bootstrap.css">
		
		<script src="<?php print get_template_directory_uri(); ?>/js/vendor/bootstrap.min.js"></script>
        <script src="<?php print get_template_directory_uri(); ?>/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        
		<script type="text/javascript">
			var APP_JQ = '<?php print APP_JQ; ?>';
			var URL_SITE = '<?php print get_bloginfo("url"); ?>';
			var isMobile = <?php print (isMobile) ? 'true' : 'false'; ?>;
			var cbFB = '<?php $pageObj = get_page_by_title('CallbackFB'); print get_page_link($pageObj->ID); ?>';
			var clientId = '<?php print APP_ID; ?>';
        </script>
		<?php wp_deregister_script('jquery'); ?>
		<?php wp_head(); ?>
		<?php
		if(is_home()){
			if(!$_SESSION["fbData"]["access_token"]){
				#Redirect to login
				$_SESSION['state'] = md5(uniqid(rand(), TRUE));
				$urlAuthFb = 'https://www.facebook.com/dialog/oauth?client_id='.APP_ID.'&redirect_uri='.urlencode(get_page_link($pageObj->ID)).'&scope='.SCOPE.'&state='.$_SESSION['state'];
			?>
				<script>parent.location.href = '<?php echo $urlAuthFb; ?>';</script>
			<?php
			}
		}
		$userData = getUser();
		if($userData->complete === 0 && is_home()){
			$pageObj = get_page_by_title('Registro');
		?>
			<script>location.href = '<?php echo get_page_link($pageObj->ID); ?>';</script>
		<?php	
		}
		?>
    </head>
    <body <?php body_class(); ?>>
