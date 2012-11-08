<?php
	require_once("ClaseSesion.php");
	$sesion = new Sesion();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Acceso al programa Tutorias</title>
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
          <h4 class="Estilo1">Acceso al programa de Tutorías </h4>
          <form id="form1" name="form1" method="post" action="validacionAcceso.php">
            <table width="300px" border="0" align="center" bgcolor="#FCFFFF">
              <tr>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td >&nbsp;</td>
                <td class="Estilo4">Usuario:</td>
                <td align="left"><label>
                    <input name="nombreUsuario" type="text" id="nombreUsuario" size="20" />
                  </label></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td class="Estilo4">Contrase&ntilde;a:</td>
                <td align="left"><label>
                    <input name="clave" type="password" id="clave" size="20" />
                  </label></td>
              </tr>
              <tr>
                <td colspan="3" align="center"><p>&nbsp;</p>
                    <input type="reset" class='boton' name="reset" id="reset" value="Limpiar" />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
        							$idSesion = SID;
    								echo "<input type=\"submit\"  class='boton2' name=\"enviar\" id=\"enviar\" value=\"Ingresar\"
								 		onclick=\"javascript:location.replace('validacionAcceso.php?$idSesion');\"/>";
								?>
                </td>
              </tr>
            </table>
          </form>
          <br><br>
          <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Alumno: utiliza tu n&uacute;mero de control como usuario y la contraseña por defecto '123456'</p>
          <p align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tutor: utiliza tu n&uacute;mero de n&oacute;mina como usuario y la contraseña por defecto 'clave'</p>
        </div>
      </div>
    </div>
    <div id="antepie"></div>
  </div>
</div>
</body>
</html>
