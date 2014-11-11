<?php
   /*
   Plugin Name: SendGrid on Wordpress on Bluemix
   Description: A plugin that enables SendGrid to work easily with Bluemix's VCAP credentials.
   Version: 0.1
   Author: Jason Killian
   Author URI: http://www.jasonkillian.com
   License: GPLv3
   */

   	$vcap = getenv("VCAP_SERVICES");
   	if($vcap) {
   		$data = json_decode($vcap, true);
   		if(!is_null($data) && isset($data['sendgrid'])) {
   			$creds = $data['sendgrid'][0]['credentials'];

   			update_option( 'sendgrid_user', $creds['username'] );
   			update_option( 'sendgrid_pwd', $creds['password'] );
   			update_option( 'sendgrid_api', 'api' );

   			add_action('admin_enqueue_scripts', 'add_bluemix_sendgrid_scripts');
   		}
   	}

   	function add_bluemix_sendgrid_scripts() {
   		wp_enqueue_script( 'disable-sendgrid-opts', plugins_url('sendgrid-opts-disable.js', __FILE__), 'jquery');

   	}




?>
