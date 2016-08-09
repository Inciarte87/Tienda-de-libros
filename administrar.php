<?php require_once('Connections/conex.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_rusuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rusuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_conex, $conex);
$query_rusuario = sprintf("SELECT unick FROM usuario WHERE unick = %s", GetSQLValueString($colname_rusuario, "text"));
$rusuario = mysql_query($query_rusuario, $conex) or die(mysql_error());
$row_rusuario = mysql_fetch_assoc($rusuario);
$totalRows_rusuario = mysql_num_rows($rusuario);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/miplantilla.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Documento sin título</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<!-- InstanceEndEditable -->
<link href="estilos.css" rel="stylesheet" type="text/css" /><!--[if lte IE 7]>
<style>
.content { margin-right: -1px; } /* este margen negativo de 1 px puede situarse en cualquiera de las columnas de este diseño con el mismo efecto corrector. */
ul.nav a { zoom: 1; }  /* la propiedad de zoom da a IE el desencadenante hasLayout que necesita para corregir el espacio en blanco extra existente entre los vínculos */
</style>
<![endif]-->
<style type="text/css">
a:link {
	color: #009;
}
a:visited {
	color: #009;
}
</style>
</head>

<body>

<div class="container">
  <div class="header"><!-- InstanceBeginEditable name="logo" -->
    <div align="center">
      <table width="694" height="110" border="0">
        <tr>
          <td><h1 align="center"><img src="imagenes/incanato.jpg" alt="" width="749" height="189" /></h1>
          <h2 align="center"><strong>TIENDA DE SOFTWARE ONLINE</strong> </h2>
          <h2 align="center">USUARIO: <?php echo $row_rusuario['unick']; ?></h2></td>
        </tr>
      </table>
    </div>
  <!-- InstanceEndEditable -->
  <!-- end .header --></div>
  <!-- InstanceBeginEditable name="menu" -->
  <div class="MenuBarVertical">
    <div align="center">
      <table width="527" height="70" border="0">
        <tr>
          <td width="517" height="66"><ul id="MenuBar1" class="MenuBarHorizontal">
            <li><a href="#" class="MenuBarItemSubmenu">Registrar</a>
              <ul>
<li><a href="registrarcategorias.php">Categorias</a></li>
<li><a href="registrarcliente.php">Clientes</a></li>
<li><a href="registrarproducto.php">Programas</a></li>
<li><a href="registraroferta.php">Ofertas</a></li>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">Listados</a>
              <ul>
                <li><a href="listadodecategorias.php">Categorias</a></li>
                <li><a href="listadodeclientes.php">Clientes</a></li>
                <li><a href="listadodelibros.php">Programas</a></li>
<li><a href="listadodeofertas.php">Ofertas</a></li>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">Eliminar</a>
              <ul>
<li><a href="eliminarcliente.php">Cliente</a></li>
<li><a href="eliminarcategoria.php">Categoria</a></li>
<li><a href="eliminarlibro.php">Programas</a></li>
<li><a href="eliminaroferta.php">Oferta</a></li>
              </ul>
            </li>
            <li><a href="<?php echo $logoutAction ?>">Salir</a></li>
          </ul></td>
        </tr>
      </table>
    </div>
  </div>
  <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="centro" -->
  <div align="justify"></div>
  <div class="content">
    <h1 align="justify">&nbsp;</h1>
    <p align="justify">&nbsp;</p>
    <p align="justify">&nbsp;</p>
  </div>
  <!-- InstanceEndEditable -->
  <div class="footer"><!-- InstanceBeginEditable name="pie" -->
    <div align="center">
      <table width="459" height="119" border="0">
        <tr>
          <td height="115"><p align="center"><em><strong>Lic. Braulio Ricardo Alvarez Gonzaga</strong></em></p>
            <p align="center"><strong><em>E-mail: braulio_ricardo@hotmail.com</em></strong></p>
          <p align="center"><strong><em>Web site: <a href="http://www.braulioedunet.webcindario.com">www.braulioedunet.webcindario.com</a></em></strong><a href="www.braulioedunet.tk"></a></p></td>
        </tr>
      </table>
</div>
    <script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
    </script>
  <!-- InstanceEndEditable -->
  <!-- end .footer --></div>
  <!-- end .container --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rusuario);
?>
