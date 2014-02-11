<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  
  <link rel="shortcut icon" type="image/ico" href="Img/favicon.ico"> 
  <script src="tools/jquery.js"></script>
  <script src="tools/jquerymobile.js"></script>

<? include "include/VarGlobales.PHP"; ?>
<title><?=$NOMPROYECTO?></title>
<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
<script src="js/ajaxCargar.js"></script>
</head>
<body>
<script language="JavaScript" type="text/javascript">
  function valideInicio()
  { 
    if(inicio.PR_ID.value=="")
    {
     alert("El proceso es obligatorio");
      return false;
    }
    if(inicio.GE_AAA.value=="")
    {
     alert("El a�o es obligatorio");
      return false;
    }	
    if(inicio.GE_MES.value=="")
    {
     alert("El mes es obligatorio");
      return false;
    }	
    if(inicio.GE_DIA.value=="")
    {
     alert("El dia es obligatorio");
      return false;
    }	
    if(inicio.GE_InicioHora.value=="")
    {
     alert("La hora de inicio de la inspeccion es obligatorio");
      return false;
    }	
    if(inicio.GE_InicioMinuto.value=="")
    {
     alert("Los minutos de inicio de la inspeccion son obligatorios");
      return false;
    }	
    if(inicio.EM_ID.value=="")
    {
     alert("La empresa es obligatoria");
      return false;
    }		
    if(inicio.EC_ID.value=="")
    {
     alert("El contrato es obligatorio");
      return false;
    }	
		
	if(inicio.GE_TINSPECCION.value=="")
    {
     alert("El tipo de inspeccion es obligatoria");
      return false;
    }		
	
	
 }
 function PrimeraParte(Mostrar)
 { 
   
   lugar='DetalleEmpleados';
   datos="GE_NO_INSPECCION="+form1.GE_NO_INSPECCION.value+"&usr="+form1.usr.value+"&us_menu="+form1.us_menu.value
   //alert(Mostrar)
   envia(Mostrar, datos)
 }
 
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

function sinEnter(e)
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
   if (key ==13  )
    {
	     return false;
    }
  else
     return true;
}

function numerosAteristoRaya(e)
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

 if (key < 48 || key > 57  )
    {
      if (key ==42  || key ==45)
		 return true;	  
	  else
	     return false;
    }

 return true;
}
function valideFotos()
{   //alert(a.DOC_DESCRIPCION.value)
    if(a.DOC_DESCRIPCION.value=="" && a.userfile.value != ""  )
    {
     alert("La descripcion de la foto es obligatoria");
     // return false;
    }	

} 
</script>

<table width="85%" border="0" align="center">
  <tr>
    <td><table width="100%" height="107" border="0">
      <tr>
        <td colspan="3"><table width="100%" border="0" align="center">
          <tr>
            <td><img src="Img/cra.jpg" width="74" height="39"><img src="Img/codensa.JPG" width="173" height="23" />Usuario: <?=$usr?></td>
            </tr>
          <tr>
            <td><div align="center" >
              <table width="100%" border="1" class="TitulosTablasDirectrices">
                <tr>
                  <td><a href="principal.php" class="TitulosTablas">Inicio</a></td>
                  <td>INS. DE SEG. INDUSTRIAL Y AMBIENTAL (IPAL) </td>
                </tr>
              </table>
            </div></td>
            </tr>
        </table></td>
        </tr>
      <tr>
        <td colspan="2"  class="titulosFondoGris"><table width="100%" border="0" align="center">
         <tr>
		<?
		 ECHO "EN INICIO: ".$ENINICIO;
	    IF($ENINICIO==0)
		{?>
            <td width="136"  class="titulosFondoGrisGrande"><a href="MarcoFormatoBB.php?usr=<?=$usr?>&us_menu=<?=$us_menu?>&Monstrar=FormatoBB.php&nuevo=1"><img src="Img/compx.gif" width="20" height="20" border="0" />Nuevo</a></td>
        <?
		}
		?>
            <td width="147"  class="titulosFondoGrisGrande"><a href="BuscarGuiaBB.php?usr=<?=$usr?>&us_menu=<?=$us_menu?>"><img src="Img/editar.gif" width="20" height="20" border="0" />Consulta</a></td>
		<?
		
		if($GE_NO_INSPECCION<>"")
		{
		?>	
            <td width="168"  class="titulosFondoGrisGrande"><a href="RepBB.php?usr=<?=$usr?>&us_menu=<?=$us_menu?>&GE_NO_INSPECCION=<?=$GE_NO_INSPECCION?>">Reporte</a></td>
         <?
		
         
					  if($GE_BVERIFTERRENO=='COMPLETO')
					   {
					     $cad3="EnviarCorreo.php?usr=".$usr."&GE_NO_INSPECCION=".$GE_NO_INSPECCION;
						 ?> <td class="TituloGrande"><div align="center"><a href="#" onclick="PrimeraParte('<?=$cad3?>')" >Enviar Correo</a></div></td><?
					   }// if para envio de correo 
					   IF($GE_BVERIFTERRENO=='CENVIADO')
					   {
					     ?> <td class="TituloGrande"><div align="center">Correo enviado</div></td>				<? 		
					   }
          }

		 ?>
		  </tr>

        </table></td>
        <td width="60%" rowspan="2" bgcolor="#FFE1D2">      <div align="center">
          <table width="100%" border="0">
            <tr>
                <?
		if($GE_NO_INSPECCION<>"")
		 {?>

              <td class="TituloGrande"><div align="left"><a href="#" onclick="PrimeraParte('FormatoBB.php')"><img src="Img/flecha1.jpg" width="19" height="19"    border=""/>1.General</a></div></td>
			   
			    <td class="TituloGrande"><div align="left"><a href="#" onclick="PrimeraParte('EvalListadoNCBB.php')"><img src="Img/flecha1.jpg" width="19" height="19" border=""/>3. Evaluacion</a></div></td>
              </tr>
            <tr>
              <td class="TituloGrande"><div align="left"><a href="#" onclick="PrimeraParte('CuadrillaBB.php')"><img src="Img/flecha1.jpg" width="19" height="19"  border=""/>2. Cuadrillas</a></div></td>
                <td class="TituloGrande"><div align="left"><a href="#" onclick="PrimeraParte('FotosVideoBB.php')" ><img src="Img/flecha1.jpg" width="19" height="19" border=""/>4. Fotos y videos</a></div></td>
              </tr>
            <tr>
              <td colspan="2" class="TituloGrande"><div align="center"><a href="#" onclick="PrimeraParte('Cierre.php')" ><img src="Img/flecha1.jpg" width="19" height="19"  border=""/>5. Observaciones y cierre </a>&nbsp;</div></td>
                <?
		}  //if si existe no de inspeccion 
				?>
              </tr>
            </table>
        </tr>
      <tr>
        <td width="14%"  class="titulosFondoGris"><span class="titulosRojoGrande">No Inspeccion</span> </td>
        <td width="26%" class="titulosFondoGris"><form  name="form1" action="" method="get">
		  <div align="center" class="titulosRojoGrande">
		    <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
		    <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
		   <?=$GE_NO_INSPECCION ?>
		    <input type="hidden" name="GE_NO_INSPECCION" id="GE_NO_INSPECCION"  value="<?=$GE_NO_INSPECCION?>"/>
		      </div>
        </form></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><div id="DetalleEmpleados"><?
		if($Monstrar<>"")
		{  include $Monstrar; }?>&nbsp;</div></td>
  </tr>
</table>

</body>
</html>
