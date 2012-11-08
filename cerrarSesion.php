<?php
	require_once("ClaseSesion.php");
	$sesion = new Sesion();

	$user=$_SESSION["nombreUsuario"];
	$password=$_SESSION["clave"];
	if($user==null && $pasword==null){
		echo
		"<SCRIPT LANGUAGE=\"Javascript\">
		<!--
		window.location='index.php';
		//--> 
		</SCRIPT>";	
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Cerrar sesi&oacute;n</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#F4F6DE">
<div id="centrar">
  <div id="contenedor">
    <div id="banner"><br>
    </div>
    <div id="areat">
      <div id="marcoIzquierdo">
        <div id="arbol"> </div>
        <div id="menuIzquierdo">
          	<?php
				include ("menuVertical.php");
				$logo = new menuVertical();
				$logo->imprimeMenu();
			?>
        </div>
      </div>
      <div id="marcoSesion"></div>
      <div id="area">
        <div id="ajuste"> </div>
        <div id="texto">
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          	<?php
				$sesion->borrarSesion();
				echo "<h4 class='Estilo1'>Sesión cerrada !</h4>";
				echo "<SCRIPT LANGUAGE=\"Javascript\">
  					<!--
					function redireccionar() { location.href='index.php' } 
					setTimeout ('redireccionar()', 2000);
					//-->
				</SCRIPT>"; 
			?>
        </div>
      </div>
    </div>
    <div id="antepie"></div>
  </div>
</div>
</body>
</html>
