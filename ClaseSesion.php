<?php
class Sesion{
	
	function Sesion(){
		session_start();	
	}
	
	public function set($nombre,$valor){
		$_SESSION[$nombre] = $valor;
	}
	
	public function get($nombre){
		if (isset($_SESSION[$nombre])) {
			return $_SESSION[$nombre];
		}
		else {
			return false;
		}
	}
	
	public function borrarVariable($nombre)
	{
		unset ($_SESSION[$nombre]);
	}
	
	public function  borrarSesion()
	{
		$_SESSION = array();
		session_destroy();
	}
}
?>