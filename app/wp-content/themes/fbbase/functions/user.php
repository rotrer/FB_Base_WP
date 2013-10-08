<?php
/*
 * Login Facebook
 */
function loginFbMobile($args){
	global $wpdb;
	if(isset($args) && !empty($args)){
		//Registro de datos extras
		$queryStr = "select id from ".$wpdb->prefix."app_usuarios where fbuid = '".$args->id."'";
		$result = $wpdb->get_row($queryStr);
		if(!$result->id){
			$wpdb->insert(
				$wpdb->prefix."app_usuarios",
				array(
					"fbuid" => $args->id,
					"firstname" => $args->first_name,
					"lastname" => $args->last_name,
					"email" => $args->email,
					"genero" => $args->gender,
					"ip" => getUserIpAddr(),
					"complete" => 0,
					"meta" => json_encode(array("link" => $args->link, "locale" => $args->locale, "name" => $args->name, "timezone" => $args->timezone, "updated_time" => $args->updated_time, "username" => $args->username))
				)
			);
		}
		$_SESSION["fbData"]["idFb"] = $args->id;
		$_SESSION["fbData"]["access_token"] = $args->access_token;
	}
}
/*
 * Guardar datos formulario
 */
add_action('wp_ajax_nopriv_saveUser', 'saveUser');
add_action('wp_ajax_saveUser', 'saveUser');
function saveUser(){
	global $wpdb;
	
	if(isset($_POST) && !empty($_POST)){
		$arrParam = array();
		foreach ( $_POST as $key => $param ) {
			$param = sanitize_text_field( wp_kses($param, "") );
			$arrParam[$key] = sanitize_text_field( wp_kses($param, "") );
		}
		//Extraer data FB
		@extract($arrParam);
		
		//Actualiza info usuario
		$result = $wpdb->update( 
					$wpdb->prefix."app_usuarios",
					array( 
						'firstname' => $firstname,
						'lastname' => $lastname,
						'rut' => str_replace( array(".","-"), "", $rut ),
						'email' => $email,
						'phone' => $phone,
						'address' => $address,
						'region_id' => $region_id,
						'comuna_id' => $comuna_id,
						'complete' => 1
					), 
					array( 'fbuid' => $_SESSION["fbData"]["idFb"] ), 
					array( 
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%d',
						'%d',
						'%d'
					), 
					array( '%s' ) 
				);
		$pageObj = get_page_by_title('Registro OK');
		print json_encode(array("state" => 1, "cb" => get_page_link($pageObj->ID)));
	}else{
		print json_encode(array("state" => 0));
	}
	die();
}
/*
 * Obtener Usuarios
 */
function getUser($uid = null){
	global $wpdb;

	if($uid){
		$where = 'id = '.$uid;
	}else{
		$where = 'fbuid = "'.$_SESSION['fbData']['idFb'].'"';
	}
	$queryStr = 'Select rut, firstname, lastname, phone, address, email, genero, complete, created from '.$wpdb->prefix.'app_usuarios where '.$where.' limit 1';
	$result = $wpdb->get_results($queryStr);
	
	return $result;
}