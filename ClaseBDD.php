<?php
class BDD{
	var $nombreServidor;
	var $nombreUsuario;
	var $claveUsuario;
	var $nombreBDD;
	var $query;
	var $link;
	var $result;
	
	function BDD(){
		$this->nombreServidor = 'localhost';
		$this->nombreUsuario = 'root';
		$this->claveUsuario = '';
		$this->nombreBDD = 'axhunico_tutorias';		
	}
	
	public function conexionBDD(){
		// Inicia conexión al servidor de base de datos
		$this->link = mysql_connect($this->nombreServidor, $this->nombreUsuario, $this->claveUsuario)
    	or die('No se pudo conectar: ' . mysql_error());
		//echo "Conexion exitosa <br>";
		// Selección de la base de datos
		mysql_select_db($this->nombreBDD) or die('No se pudo seleccionar la base de datos');
	}
	
	public function consultaSQL(){
		$this->result = mysql_query($this->query) or die('Consulta fallida: ' . mysql_error());
	}
	
	public function liberaConsultaCierraConexion(){
		// Libera resultado
		mysql_free_result($this->result);

		// Cierra conexión al servidor
		mysql_close($this->link);
	}
}
?>
