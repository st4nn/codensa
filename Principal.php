<!DOCTYPE html>
<html lang="es">
<head>
  <link rel="shortcut icon" type="image/ico" href="Img/favicon.ico"> 
  <title>
    <? include "Include/VarGlobales.PHP" ;
          echo $NOMPROYECTO;
		?>
  </title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  
  <link href="css/estilos_home.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript" type="text/javascript">
  function solonumeros(e)
  {

   var key;

   if(window.event) // IE
   {
    key = e.keyCode;
   }
    else if(e.which) // Netscape/Firefox/Opera
   {
    key = e.which;
   }

   if (key < 48 || key > 57)
      {
        return false;
      }

   return true;
  }
</script>
<body>

  <?
if($nivel=="")
{
?>
<header>
  <img id='headImg1' src="img/cra.png" />
  <img id='headImg2' src="Img/codensa.JPG">
  <br /><br /><br />
  <h1>
      INSPECCIONES DE SEGURIDAD INDUSTRIAL Y AMBIENTAL (IPAL)
  </h1>
</header>
<form name="form1" method="post" action="">
  <!--

    <img src="img/llave.jpg" width="102" height="92">
  -->
    
    <label for='usr' class="labelForm">CEDULA:</label>
    <input name="usr" type="number" class="inputForm" id="usr" value=""  onkeypress="javascript:return solonumeros(event)" />
      
    <label for='clave' class="labelForm">CLAVE:</label>
    <input name="clave" type="password" class="inputForm" id="clave" />
      <br />
    <input name="entrar" type="submit" class="boton" id="entrar" value="ENTRAR">
  
  <input name="nivel" type="hidden" size="10" value="1">
</form>
<footer>
  <a href="FormatoIpalBB.xls" class="titulosRojoGrande">Formato xls</a>
</footer>

<?
}
if($nivel=="1")
{
 
 include "Include/varglobales.php";
 require("Include/BdSqlClases.php");

 $q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
 $usr = trim($usr); // strtolower cambia a minusculas

 $q->ejecutar("SELECT    USB_CEDULA, USB_NOMBRE, USB_CLAVE, EM_ID, USB_TIPO
        FROM         IPAL_USUARIOS_BB
               WHERE  EM_ID = 31  AND USB_CEDULA=$usr and USB_CLAVE='$clave'", 107, "Principal.php");

 $Nofilas=$q->filas();
 if($Nofilas==1)
 {
   $q->Cargar();
   $nombre=$q->dato(1);
   $USB_TIPO=$q->dato(4);   
   
  
   if($USB_TIPO <>'GENERACION')
   {  
    $SQL="SELECT COUNT(*) FROM IPAL WHERE   (GE_BVERIFTERRENO = 'INICIO')
      AND  (USR_DIGITA ='".$usr."' or USR_DIGITA ='".$nombre."')";
    $q->ejecutar($SQL,156,'MarcoFormatoBB.php');     
    $q->Cargar();
    $ENINICIO=$q->dato(0);
    //ECHO "ENINICIO".$ENINICIO;
    $pag="MarcoFormatoBB.php";
   }
   else
      $pag="MarcoFormatoGe.php";
   
  ?>
    <script language="JavaScript">
   <!-- alert('Ya pueden borrar la foto o los videos sin problema, por si necesitan volver a cargarlos....cualquier duda porfa me avisan.. ' )--!>
  location.href='<?=$pag?>?nombre=<?=$nombre?>&usr=<?=$usr?>&ENINICIO=<?=$ENINICIO?>'
  </script>
    <?
  
  }
 else
 {
   ?>
      <script language="JavaScript">
  alert('Usuario o clave no valida')
  location.href='Principal.php?'
   </script>
    <?
  }
}

?>
</body>
</html>
