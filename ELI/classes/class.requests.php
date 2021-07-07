<?php  

class REQUEST {

	function csrftoken(){
		echo @$_SESSION['token'];
	}

	function is_loggedin($data=false){
		if(isset($_SESSION['user']) && is_numeric($_SESSION['user']['id'])){
			if(!$data){
			 	return true;
			}
			else
			{
				return $_SESSION['user'];
			}
		}
		else
		{
			if(!$data){
			 	return false;
			}
			else
			{
				return false;
			}
		}
	}


	function get($variable=""){
		if(isset($variable) && $variable!=""){
			return @$_GET[$variable];
		}
		else
		{
			return @$_GET;
		}
	}

	function post($variable=""){
		if(isset($variable) && $variable!=""){
			return @$_POST[$variable];
		}
		else
		{
			return @$_POST;
		}
	}

	function session($variable=""){
		if(isset($variable) && $variable!=""){
			return @$_SESSION[$variable];
		}
		else
		{
			return @$_SESSION;
		}
	}

	

}

?>