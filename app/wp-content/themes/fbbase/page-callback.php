<?php
/**
 * Template Name: Page Callback FB
 */
session_start();
if($_GET["code"]){
	$pageObj = get_page_by_title('CallbackFB');
	$urlToken = 'https://graph.facebook.com/oauth/access_token?client_id='.APP_ID.'&redirect_uri='.urlencode(get_page_link($pageObj->ID)).'&client_secret='.APP_SECRET.'&code='.$_GET["code"];
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $urlToken);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$output = curl_exec($ch);
	$meta = explode("&", $output);
	$access = explode("=", $meta[0]);
	
	curl_close($ch);
	
	
	$urlData = 'https://graph.facebook.com/me?access_token='.$access[1];

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $urlData);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$outputData = curl_exec($ch);
	$metaData = json_decode($outputData);
	$metaData->access_token = $access[1];
	curl_close($ch);
	$cbReload = loginFbMobile($metaData);
	wp_redirect(FB_APP);
	exit();
}else{
	wp_redirect(get_bloginfo("url"));
	exit();
}
?>