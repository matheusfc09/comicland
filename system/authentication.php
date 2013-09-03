<?php
	
	if(!function_exists("admin")) {	
		function admin() {
			return (isset($_SESSION['user']) and $_SESSION['user']['role'] == "admin");
		}
	}

	if(!function_exists("manager")) {	
		function manager() {
			return (isset($_SESSION['user']) and $_SESSION['user']['role'] == "manager");
		}
	}
	
	if(!function_exists("commom_user")) {	
		function commom_user() {
			return (isset($_SESSION['user']) and $_SESSION['user']['role'] == "user");
		}
	}

	if(!function_exists("owner")) {	
		function owner($user_id) {
			return (isset($_SESSION['user']) and !empty($user_id) and $_SESSION['user']['id'] == $user_id);
		}
	}

	if(!function_exists("logged_in")) {	
		function logged_in() {
			return (isset($_SESSION['user']) and !empty($_SESSION['user']['role']));
		}
	}

	if(!function_exists("logout")) {
		function logout() {
			if(isset($_SESSION['user']))
				unset($_SESSION['user']);
		}
	}

	if(!function_exists("current_user_id")) {
		function current_user_id() {
			if(isset($_SESSION['user']) and !empty($_SESSION['user']['id']))
				return $_SESSION['user']['id'];
		}
	}

	if(!function_exists("current_user_fullname")) {
		function current_user_fullname() {
			if(isset($_SESSION['user']) and !empty($_SESSION['user']['full_name']))
				return $_SESSION['user']['full_name'];
		}
	}

?>
