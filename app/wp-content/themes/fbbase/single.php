<?php get_header(); ?>
<div class="wrap container hide-overlay" style="height:100% !important;">

	<div class="row cont_catalog">
		
		<div class="col-md-12 catalogo">

			<div class="row">
	
				<div class="col-md-4 hidden-xs hidden-sm">
					<ul class="list-inline nav_inner text-center">
						<li class="icon_home"><a class="back" href="./" target="_self"></a></li>
					</ul>
				</div>

				<div class="col-md-4 tit_xs_fix">
				
					<div class="text-center">

						<h2>
							<div class="row cont_menu_header">
								<div class="hidden-md hidden-lg col-xs-2">
									<img onClick="window.history.back();" class="img-responsive" src="<?php print get_template_directory_uri();?>/img/btn_back.png" alt="">
								</div>
								<div class="col-xs-8 col-md-offset-2">
									Catálogo
								</div>
								<div class="hidden-md hidden-lg col-xs-2">
									<img src="<?php print get_template_directory_uri();?>/img/btn_menu.png" alt="">
								</div>
							</div>
						</h2>

					</div>

				</div>

				<div class="col-md-4 hidden-xs hidden-sm">
					<ul class="list-inline nav_inner text-center">
						<li class="icon_redes01"><a href="https://twitter.com/RipleyChile" target="_blank"></a></li>
						<li class="icon_redes02"><a href="http://pinterest.com/ripleychile/" target="_blank"></a></li>
						<li class="icon_redes03"><a href="https://www.facebook.com/ripleychile" target="_blank"></a></li>
					</ul>
				</div>

			</div>
			
			<div class="row cont_ficha">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php
					$liTipos = '';
					$categories = get_the_category();
					foreach($categories as $cat){
						if($cat->parent != 0 && $cat->parent != 2){
							$catName= $cat->name;
						}
						
						#Nombre de Marca
						if($cat->parent == 14)
							$daCatMarca = $cat->name;

						#Lista de tipos de sosten
						if($cat->parent == 8 || $cat->parent == 3){
							$catImgMarcaObject = categoryCustomFields_GetCategoryCustomField($cat->cat_ID, "Img_Tipo");
							$catImgMarca = explode( "@", $catImgMarcaObject[0]->field_value );
							$liTipos .= '<li><img class="pull-left" src="'.$catImgMarca[0].'" alt=""> <p class="pull-left">'.$cat->name.'</p></li>';
						}
					}
					$imgPost = get_field("imagen_bra_interior");
				?>

				<div class="col-xs-12 col-sm-12 text-center hidden-md hidden-lg">
					<h2><?php  echo $catName; ?></h2>
					<h3><?php the_title(); ?></h3>
				</div>

				<div class="col-md-4 col-md-offset-1 col-xs-12 col-sm-12">

					<ul class="list-inline text-center">
						<li class="img-bordered img-circle">
							<img class="img-responsive" src="<?php echo $imgPost; ?>">
						</li>
					</ul>
					
				</div>
				
				<!--<div class="col-md-1 hidden-xs hidden-sm">related</div>-->

				<div class="col-md-6">
					<div class="hidden-xs hidden-sm">
						<h2><?php the_title() ?> <br><?php echo get_field("modelo_bra"); ?></h2>
						<h3><?php echo $daCatMarca; ?></h3>
					</div>
					<p><?php echo (get_the_content()) ? get_the_content() : get_the_excerpt(); ?></p>
					<div class="row category">
						<ul class="col-md-4">
							<?php echo $liTipos; ?>
						</ul>
					</div>
				</div>

				<?php endwhile; // end of the loop. ?>

			</div>
			<div class="row back text-center">
				<a class="back_test" href="<?php echo get_page_link(21); ?>">Volver al catálogo</a>
			</div>

		</div>

	</div>

<?php get_footer(); ?>
