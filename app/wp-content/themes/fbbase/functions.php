<?php
session_start();
show_admin_bar(false);
remove_action('wp_head', 'wp_generator');
/*
 * Constantes Sitio
 */
define(APP_JQ, get_bloginfo("wpurl")."/wp-admin/admin-ajax.php");
define(APP_ID, "189408174576018");
define(APP_SECRET, "dbef14e7fdc7c2e1a6c52f74dc83ec35");
define(GRAPH_FB, 'https://graph.facebook.com');
define(SCOPE, 'email,publish_stream');
define(DS, '/');
#define(PAGE_URL, 'https://www.facebook.com/rotrerdeveloper');
#define(PAGE_URL, 'https://www.facebook.com/ripleychile');
#define(FB_APP, PAGE_URL."/app_".APP_ID);
define(FB_APP, get_bloginfo("url"));

/*
 * Funciones debug vars
 */
function pr($var) {
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}
/*
 * Imprimir querys
 */
##Debug queries print_r($wpdb->queries);
#define( 'SAVEQUERIES', true );

/*
 * Includes theme
 */
include TEMPLATEPATH . '/functions/less.php';
include TEMPLATEPATH . '/functions/user.php';
include TEMPLATEPATH . '/functions/generales.php';