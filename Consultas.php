<?php
class Consultar{
	
	function consulta($usuario, $f_ini, $f_fin){
		require_once("ClaseBDD.php");
		$bd = new BDD;
		$bd->nombreBDD="axhunico_tutorias";
		$bd->claveUsuario=$clave;
		$bd->conexionBDD();
		$bd->query="select * from tutorias where tutor='$usuario' and fecha>='$f_ini' and fecha<='$f_fin' order by fecha";
		$bd->consultaSQL();	
		return $bd->result;
	}
	function consulta2($usuario){
		require_once("ClaseBDD.php");
		$bd = new BDD;
		$bd->nombreBDD="axhunico_tutorias";
		$bd->claveUsuario=$clave;
		$bd->conexionBDD();
		$bd->query="select fecha, tema, canalizacion, seguimiento, resultado from tutorias where ncontrol='$usuario' order by fecha";
		$bd->consultaSQL();	
		return $bd->result;
	}
	function inser($campo,$valor,$viejo){
		require_once("ClaseBDD.php");
		$bd = new BDD;
		$bd->nombreBDD="axhunico_tutorias";
		$bd->claveUsuario="";
		$bd->conexionBDD();
		$bd->query='update tutorias set '.$campo.'="'.$valor.'" where '.$campo.'="'.$viejo.'"';
		$bd->consultaSQL();
	}
	
	function fecha_inicial($semana,$mes,$anio){
		$dia_1=date("w",mktime(0,0,0,$mes,1,$anio));
		if($dia_1==6)$dia_1=0;
		for($x=1;$x<$semana;$x++){
			$dia_1=$dia_1+7;
		}
		$primer_dia = mktime(0,0,0,$mes,$dia_1,$anio);
		while(date("w",$primer_dia)!=1){
			$primer_dia -= 3600;
		}
		return date("Y-m-d",$primer_dia);
		}

	function fecha_final($semana,$mes,$anio){
		$dia_1=date("w",mktime(0,0,0,$mes,1,$anio));
		if($dia_1==6)$dia_1=0;	
		for($x=1;$x<$semana;$x++){
			$dia_1=$dia_1+7;
		}
		$ultimo_dia = mktime(0,0,0,$mes,$dia_1,$anio);
		while(date("w",$ultimo_dia)!=0){
			$ultimo_dia += 3600;
		}
		return date("Y-m-d",$ultimo_dia);
		}
	}
?>