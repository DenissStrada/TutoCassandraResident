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
<title>Programa Tutorias</title>
<link href="css/estilo.css" rel="stylesheet" type="text/css" />
<?php
	require_once("ClaseSesion.php");
	$sesion = new Sesion();
	
	require ('xajax/xajax.inc.php');
	$xajax = new xajax(); 
	$connectid = mysql_connect("localhost", "axhunico_tutoria", "Tutorias2012");
	mysql_select_db("axhunico_tutorias",$connectid);
	function procesar($campo,$valor,$numc, $fecha){
   		$ssql = 'update tutorias set '.$campo.'="'.$valor.'" where ncontrol="'.$numc.'" AND fecha="'.$fecha.'"';
   		mysql_query($ssql);
   		$respuesta = new xajaxResponse();
	   	return $respuesta;
	}
	$xajax->registerFunction("procesar");
	$xajax->processRequests();

   $xajax->printJavascript("xajax/");
?>
<script language="javascript">
var nc="",nom="",fecha="",hora="", tema="", can="",seg="",res="";
var aux=0;
var sem=0,mes=0,ano=0;
</script>
<script type="text/javascript" src="jquery.js" ></script>
<script type="text/javascript" src="java.js" ></script>
</head>
<body bgcolor="#F4F6DE">
<div id="centrar">
  <div id="contenedor">
    <div id="banner"><br>
    </div>
    <div id="areat">
      <div id="marcoIzquierdo">
        <div id="arbol"> 
            <div id="bienvenida"> 
        		<?php
				require_once("ClaseBDD.php");
				$conexion = new BDD();
	
				$conexion->conexionBDD();
				$numControl=$_SESSION['nombreUsuario'];
				$clave2 = $_SESSION['clave'];
				// Consulta SQL
				$conexion->query = 'SELECT validacion FROM profesores WHERE numNomina=\''.$_SESSION['nombreUsuario'].'\' && clave=\''.$_SESSION['clave'].'\'';
				$conexion->consultaSQL();
				$bandera = "f";
				$row = mysql_fetch_array($conexion->result);
					$bandera = "$row[validacion]";
				if($bandera=="v"){
					require_once("ClaseBDD.php");
					$conexion = new BDD();
					$conexion->conexionBDD();
					// Consulta SQL
					$conexion->query = "SELECT nombre, aPaterno, aMaterno FROM profesores WHERE numNomina=".$user;
					$conexion->consultaSQL();
 					$row = mysql_fetch_array($conexion->result);
					$usuario=$row['nombre']." ".$row['aPaterno']." ".$row['aMaterno'];
					echo "<p class='Estilo7'>¡ Bienvenido !<br><br>$usuario</p>";
					// Libera la consulta y cierra la conexión
					$conexion->liberaConsultaCierraConexion();
				}
				?>
    		</div>
        </div>
        <div id="menuIzquierdo">
          <?php
				include ("menuVertical.php");
				$logo = new menuVertical();
				$logo->imprimeMenu();
			?>
        </div>
      </div>
      <div id="marcoSesion">
      	 <?php
        	$idSesion = SID;
    		echo "<table align=\"right\"><tr><td>
				<a href='seleccionFormatos.php?$idSesion'>Seleccionar formatos</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='cerrarSesion.php?$idSesion'>Cerrar sesi&oacute;n</a>
				</td></tr></table>";
		?>
      </div>
      <div id="area">
        <div id="ajuste"> </div>
        <div id="texto">
          <h4 class="Estilo1">Seguimiento Individual</h4>
          <?php
require_once("Consultas.php");
$obj = new Registros;
$c_query=new Consultar;
$semana=$_GET["fila"];
$mes=$_GET["mes"];
$ano=$_GET["ano"];
echo '<div id="1" style="overflow:auto; width:auto; height:auto;">';
echo '<table cellspacing="10" cellpadding="2" border=1 bordercolor="#344D06" class="ntab">';

$f_ini=$c_query->fecha_inicial($semana,$mes,$ano);
$f_fin=$c_query->fecha_final($semana,$mes,$ano);
$result=$c_query->consulta($usuario, $f_ini, $f_fin);
?>
<script language="javascript">
sem=<?php echo $semana;?>;
mes=<?php echo $mes;?>;
ano=<?php echo $ano;?>;
</script>
<?php
$con=0;
while ($regis=mysql_fetch_array($result)){
$arreglo[]=$regis["ncontrol"];
$arreglo[]=$regis["nombre"];
$arreglo[]=$regis["fecha"];
$arreglo[]=$regis["hora"];
$arreglo[]=$regis["tema"];
$arreglo[]=$regis["canalizacion"];
$arreglo[]=$regis["seguimiento"];
$arreglo[]=$regis["resultado"];
$con++;
echo "<tr id='".$con."' onclick='mostrar_detalles(this.id)'>
<td id='f".$con."' align='center' class='td1'><img src='fotos/$regis[ncontrol].jpg' style='width:70px; height:70px;'></td>
<td id='d".$con."' align='center' class='td2' onmouseover='aclarar(this.id)' onmouseout='opacar(this.id)'>$regis[nombre]<br>$regis[fecha]&nbsp;&nbsp;&nbsp;$regis[hora]</td>";
}
echo '</table></div>';

echo '<table cellspacing="3" cellpadding="2" border="0" width="95%"';
echo '<tr><td colspan="7" width="70%" style="text-align:center;">';
echo '<td colspan="7" style="text-align:center;">
<br>
<input type="button" value="Regresar" class="boton2" onclick="regresar()">';
echo '</table><br>';

if(isset($arreglo))
	$obj->variables($semana,$mes,$ano,$arreglo);
else
	$obj->variables($semana,$mes,$ano,array());


class Registros{
	
function sel($pos){
	echo '<select name="cana" class="selec">';
	echo '<option id="ps'.$pos.'">Depto. Psicologia</option>';
	echo '<option id="ad'.$pos.'">Consultorio Médico</option>';
	echo '<option id="ci'.$pos.'">Ciencias Básicas</option>';
	echo '<option id="pg'.$pos.'">Programación ISS</option>';
}
function variables($d,$m,$a,$arre){
echo '<script language="javascript">
var dia='. $d .';
var mes='. $m .';
var ano='. $a .';
var arre=new Array();
var aux=0;
</script>';
foreach($arre as $dato){
	echo '
	<script language="javascript">
	arre[aux]="'.$dato.'";
	aux++;	
	</script>
	';
}
}
}
?>
<div class="pantalla"></div>
<div class="loading"><img src="imagenes/cargando.gif" /></div>
<div class="formulario" align="center"><br />
    <img id="img" style='width:100px; height:105px;' /><br>
    <p id="nomm" align="center" class="syr"></p>
    <p class="syr">Tema:</p>
    <textarea id="text0"  readonly class="fondot1"></textarea><br>
    <p class="syr">Canalizaci&oacute;n</p>
    <select id="select">
    <option>Ciencias Basicas</option>
    <option>Programacion ISS</option>
    <option>Consultorio Medico</option>
    <option>Psicologia Clinica</option>
    <option>Psicologia Educativa</option>
    </select><br><br>
    <p class="syr">Seguimiento:</p>
    <textarea id="text1" class="fondot1"></textarea><br>
    <p class="syr">Resultado:</p>    
    <textarea id="text2" class="fondot1"></textarea><br>
    <a id="cerrar" class="cerrar">&#215;</a><br>
    <input type="button" value="Actualizar" class="button" id="btn_grd">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" value="Cancelar" class="button" id="btn_cancel">
    <br><br>
</div>
</div>
      </div>
    </div>
    <div id="antepie"></div>
  </div>
</div>
</body>
</html>
<script language="javascript">
$("#btn_grd").click(function(){
	if(select.value!=arre[aux+5]){
		xajax_procesar("canalizacion",select.value,arre[aux],arre[aux+2])
		sleep(1500);
		location.href="Registro.php?fila="+sem+"&mes="+mes+"&ano="+ano+"";
	}
	if(text1.value!=arre[aux+6]){
		xajax_procesar("seguimiento",text1.value,arre[aux],arre[aux+2])
		sleep(1500);
		location.href="Registro.php?fila="+sem+"&mes="+mes+"&ano="+ano+"";		
	}
	if(text2.value!=arre[aux+7]){
		xajax_procesar("resultado",text2.value,arre[aux],arre[aux+2])
		sleep(1500);
		location.href="Registro.php?fila="+sem+"&mes="+mes+"&ano="+ano+"";		
	}
});
function sleep(milliSeconds){
	var startTime = new Date().getTime(); // get the current time
	while (new Date().getTime() < startTime + milliSeconds); // hog cpu
}
$("#btn_cancel").click(function(){
	location.href="Registro.php?fila="+sem+"&mes="+mes+"&ano="+ano+"";
});
</script>
