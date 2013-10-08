<?php
session_start();
include TEMPLATEPATH . '/Mobile_Detect.php'; 
$detect = new Mobile_Detect;
$_SESSION["isMobile"] = ($detect->isMobile()) ? true : false;
define(isMobile, ($detect->isMobile()) ? true : false);
/*
 * Obtener IP de suario
 */
function getUserIpAddr(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])){ //if from shared
		return $_SERVER['HTTP_CLIENT_IP'];
	}else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){   //if from a proxy
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		return $_SERVER['REMOTE_ADDR'];
	}
}
/*
 * Obtener regiones
 */
function getRegiones(){
	global $wpdb;
	
	$queryStr = 'Select id, name from '.$wpdb->prefix.'app_regiones';
	$result = $wpdb->get_results($queryStr);
	
	return $result;
}
/*
 * Obtener comunas
 */
function getComunas(){
	global $wpdb;
	
	$queryStr = 'Select id, name, region_id from '.$wpdb->prefix.'app_comunas';
	$result = $wpdb->get_results($queryStr, ARRAY_A);
	
	return $result;
}
/*
 * Restringir acceso admin para usuarios suscribers
 */
function block_dashboard() {
	$file = basename($_SERVER['PHP_SELF']);
    if (is_user_logged_in() && is_admin() && !current_user_can('edit_posts') && $file != 'admin-ajax.php'){
        wp_redirect( home_url() );
        exit();
    }
}
#add_action('init', 'block_dashboard');

function parse_signed_request($signed_request, $secret) {
		list($encoded_sig, $payload) = explode('.', $signed_request, 2);

		$sig = base64_url_decode($encoded_sig);
		$data = json_decode(base64_url_decode($payload), true);

		if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
				error_log('Unknown algorithm. Expected HMAC-SHA256, '.$data['algorithm']);
				return null;
		}

		$expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
		if ($sig !== $expected_sig) {
				error_log('Bad Signed JSON signature!');
				return null;
		}

		return $data;
}

function base64_url_decode($input) {
		return base64_decode(strtr($input, '-_', '+/'));
}