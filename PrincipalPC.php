<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head profile="http://www.w3.org/2005/10/profile">
<link rel="shortcut icon" type="image/ico" href="Img/favicon.ico"> 
<title><? include "Include/VarGlobales.PHP" ;
           echo $NOMPROYECTO;
		   ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/csstyles.css" rel="stylesheet" type="text/css">
</head>

<body>

  <?
if($nivel=="")
{
?>
<br>
<br>
<br>
<form name="form1" method="GET" action="">
<div id="g_image10" style="position:absolute; overflow:hidden; left:692px; top:99px; width:366px; height:13px; z-index:12"><img src="img/links.gif" alt="" border=0 width=600 height=20></div>

<table width="794" height="286" border="1" align="center" bordercolor="<?=$ColorBordeTabla?>" bgcolor="#FFFFFF">
    <tr>
      <td width="693" bgcolor="#008000" class="TitulosTablas">SIisi</td>
    </tr>
    <tr>
      <td height="257"><table width="100%"  border="1" align="center" cellpadding="5" cellspacing="5" bordercolor="#D4D0C8">
          <tr>
            <td><table width="100%" height="96" align="center">
              
              <tr>
                <td width="23" rowspan="2">&nbsp;</td>
                <td width="213" height="15" bgcolor="#FFFFFF"><div align="center" class="TituloG">
                  <p><img src="Img/codensa.png" width="140" height="46"></p>
                  </div></td>
                <td width="106" bgcolor="#FFFFFF"><span class="titulos"><img src="Img/Endesa.png" width="89" height="70"></span></td>
                <td width="106" bgcolor="#FFFFFF"><img src="Img/emgesa.png" width="191" height="32"></td>
                <td width="292" rowspan="2"><div align="center">
                  <table width="35%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="center"><img src="img/llave.jpg" width="102" height="92"></td>
                        <td><table width="46%"  border="0">
                          <tr>
                            <td align="center" bgcolor="#EEEDEF" class="titulos">USUARIO: </td>
                              <td><input name="usr" type="text" class="titulos" id="usr"></td>
                            </tr>
                          <tr>
                            <td height="3%" colspan="2" align="center" class="titulos">&nbsp;</td>
                            </tr>
                          <tr>
                            <td align="center" bgcolor="#EEEDEF" class="titulos">CLAVE: </td>
                              <td><input name="clave" type="password" class="titulos" id="clave"></td>
                            </tr>
                          </table></td>
                      </tr>
                    <tr>
                      <td height="24" colspan="2" align="center"><input name="entrar" type="submit" class="botonesoei" id="entrar" value="ENTRAR"></td>
                      </tr>
                    </table>
                </div></td>
              </tr>
              
              <tr>
                <td height="21" colspan="3" bgcolor="#FFFFFF">Inspecciones de Seguridad Industrial y Ambiental. </td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="134"><table width="722" height="221" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="<?=$ColorBordeTabla?>">
                <tr >
                  <td width="290" rowspan="2" class="borde" ><div align="center"><img src="Img/craInspectores.jpg" width="262" height="208"><a href="css/amadis-ipod-psp-3gp-mp4-avi-video.exe">CP</a></div></td>
                  <td height="141" colspan="2"  ><div align="center"><img src="Img/Proteccion.JPG" width="153" height="145"><span class="titulos"><img src="Img/ActuaSeguro.bmp" width="161" height="117"></span></div>                    <div align="center"></div></td>
                </tr>
                <tr class="Registros">
                  <td width="112" height="73" class="titulos" ><div align="right"><img src="img/cra.jpg" width="160" height="50"></div></td>
                  <td width="310" class="titulos" ><p class="titulosGrandes">&nbsp;</p>
                  <p class="titulosGrandes">CONTRATISTA CODENSA </p></td>
                </tr>
              </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <input name="nivel" type="hidden" size="10" value="1">
</form>

<?
}
if($nivel=="1")
{
 
 include "Include/varglobales.php";
 require("Include/BdSqlClases.php");

 $q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
 $usr = strtolower($usr); // strtolower cambia a minusculas

 $q->ejecutar("select US_NOMUSUARIO, US_MENU
					FROM         IPAL_USUARIOS_PC
					where US_USUARIO='$usr' and us_clave='$clave'", 107, "Principal.php");

 $Nofilas=$q->filas();
 if($Nofilas==1)
 {
   $q->Cargar();

   $nombre=$q->dato(0);
   $us_menu=$q->dato(1);
   //echo " $nombre;    $uplectura,.".$q->dato['US_RUTA'].$rutaVir;
   
   $q->ejecutar("INSERT INTO[LOG] (US_USUARIO, MODULO, FECHA, ACCION) 
   				VALUES('$usr', 'PRINCIPAL',GETDATE(), 'ACCESO EXITOSO' )", 115, "Principal.php");
   
  ?>
<form name="form2" method="GET" action="">  
    <script language="JavaScript">
  location.href='CargarMenus.php?us_menu=<?=$us_menu?>&nombre=<?=$nombre?>&usr=<?=$usr?>'
  </script>
</form>  
    <?
  
  }
 else
 {
   $q->ejecutar("INSERT INTO[LOG] (US_USUARIO, MODULO, FECHA, ACCION) 
   				VALUES('$usr', 'PRINCIPAL',GETDATE(), 'ACCESO NO EXITOSO' )", 115, "Principal.php");


   ?>
<form name="form3" method="GET" action="">
      <script language="JavaScript">
  alert('Usuario o clave no valida')
  location.href='Principalpc.php?usr=<?=$usr?>'
   </script>
  </form> 
    <?
 }
}

?>
</body>
</html>
