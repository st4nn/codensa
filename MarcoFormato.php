<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" type="image/ico" href="Img/favicon.ico"> 
<? include "include/VarGlobales.PHP"; ?>
<title><?=$NOMPROYECTO?></title>
<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
<script src="js/ajaxLlave.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/calendar-blue.css">
  <script type="text/javascript" src="js/calendar.js"></script>
  <script type="text/javascript" src="lang/calendar-es.js"></script>
  <script type="text/javascript" src="js/calendar-setup.js"></script>
</head>
<body >



<? 
 
include "include/MenuHeader.php";
include "include/Menu.php";

MenuHeader();
include "include/TablaMenu.php";

?>
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
     alert("El año es obligatorio");
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
	var fecha = new Date (); 
    var dia_semana = fecha.getDay(); 
    var dia_mes = fecha.getDate(); 
    var mes = fecha.getMonth (); 
    var anio = fecha.getRealYear(); 
alert(fecha.getYear());
    mes += 1;
      if(inicio.GE_AAA.value>anio )
      {
        alert("El año diligenciado "+inicio.GE_AAA.value+" es superor al año actual de "+anio);
        return false;
      }


    if(inicio.GE_AAA.value==anio)
    {
      if(inicio.GE_MES.value>mes )
      {
        alert("El mes es superor al mes actual de"+mes);
        return false;
      }
	  if(inicio.GE_MES.value==mes )
	  {
		if(inicio.GE_DIA.value> dia_mes )
		{
		 alert("El dia no puede ser mayor al dia de hoy: "+ dia_mes);
		  return false;
		}
	  }
	}
  // año difernete
 	
	
	//alert(inicio.EM_ID.value)
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
	if(inicio.RES_CEDULA.value=="")
    {
     alert("Debe seleccionar el responsable de la inspeccion");
      return false;
    }	
	if(inicio.GE_TIPONO.value=="")
    {
     alert("Debe seleccionar un tipo descargo y/o orden de servicio");
      return false;
    }		
	
	if(inicio.GE_NO.value=="")
    {
     alert("Debe diligenciar el numero de descargo y/o orden de servicio");
      return false;
    }		
	if(inicio.GE_MOVIL.value=="")
    {
     alert("Diligencie el numero de movil y/o avantel ");
      return false;
    }		
	if(inicio.GE_TIPOVEHICULO.value=="")
    {
     alert("Diligencie el tipo de vehiculo ");
      return false;
    }
	if(inicio.GE_DIRECCION.value=="")
    {
     alert("Diligencie la direccion ");
      return false;
    }	
	if(inicio.GE_MUNICIPIO.value=="")
    {
     alert("El municipio es obligatorio ");
      return false;
    }				
	
 }

 function PrimeraParte(Mostrar)
 { 
   
   lugar='DetalleBasico';
  // document.getElementById('DetalleBasico').style.visibility = "visible"
     
   datos="GE_NO_INSPECCION="+form1.GE_NO_INSPECCION.value+"&usr="+form1.usr.value+"&us_menu="+form1.us_menu.value+"&Modins="+form1.Modins.value
   //alert(datos)
   envia(Mostrar, datos)
 }


 
   function valideNumeroInspeccion()
  { 
    if(insp.GE_NO_INSPECCION.value!="" && insp.GE_NODELFOSNUEVO.value!="")
    {
     alert("debe diligenciar o el numero de la inspeccion del formato fisico y el numero de inspeccion asignada por delfos. ");
      return false;
    }
	if(insp.GE_NO_INSPECCION.value=="" && insp.GE_NODELFOSNUEVO.value=="")
    {
     alert("debe diligenciar o el numero de la inspeccion del formato fisico y el numero de inspeccion asignada por delfos. ");
      return false;
    }
	if( insp.GE_NO_INSPECCION.value > 150000 )
    {
     alert("El numero que ha diligenciado es mayor a 150.000 no es un numero de inspeccion valida. ");
      return false;
    }

  }
</script>
<table width="76%" border="0" align="center">
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td colspan="4"><table width="100%" border="0" align="center">
          <tr>
            <td width="16%"><div align="right"></div></td>
            <td width="61%" class="TitulosTablas"><div align="center">INSPECCIONES DE SEGURIDAD INDUSTRIAL Y AMBIENTAL</div></td>
            <td width="23%" class="Fondogris"><div align="center">RG01-IN585</div></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td width="10%"  class="titulosFondoGris"><span class="titulosRojo">No Inspeccion</span> </td>
        <td width="14%" class="titulosFondoGris"><form  name="form1" action="" method="get">
		  <div align="center">
		    <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
		    <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
		    <input type="hidden"   name="Modins"   size="10"  maxlength="10" value="<?=$Modins?>">            
		     <?
		if($GE_NO_INSPECCION<>"")
		 {
		   echo $GE_NO_INSPECCION;
		   ?>
		    <input type="hidden" name="GE_NO_INSPECCION" id="GE_NO_INSPECCION"  value="<?=$GE_NO_INSPECCION?>"/>
		    <?
		   
		 }  ?> 
		      </div>
        </form></td>
        <td width="53%" bgcolor="#FFE1D2">
        <a href="#" onclick="PrimeraParte('Formato.php')"><img src="Img/flecha1.jpg" width="19" height="19"    border=""/>1.General</a>
        <a href="#" onclick="PrimeraParte('CuadrillaPc.php')"><img src="Img/flecha1.jpg" width="19" height="19"    border=""/>2. Cuadrilla</a>
		<a href="#" onclick="PrimeraParte('EvalListadoNC.php')"><img src="Img/flecha1.jpg" width="19" height="19" border=""/>3. Evaluacion</a>
		<a href="#" onclick="PrimeraParte('FotosVideo.php')" ><img src="Img/flecha1.jpg" width="19" height="19" border=""/>4. Fotos y videos</a>
		<a href="#" onclick="PrimeraParte('GuardarCierrePC.php')" ><img src="Img/flecha1.jpg" width="19" height="19"  border=""/>5. Cierre </a>		</td>
        <td width="23%"><table width="100%" border="0" align="center">
          <tr>
            <td width="136"  class="titulosFondoGris"><a href="MarcoFormato.php?usr=<?=$usr?>&us_menu=<?=$us_menu?>&Monstrar=Solonumero.php"><img src="Img/compx.gif" width="25" height="25" border="0" />Nuevo Formato</a></td>
            <td width="111"  class="titulosFondoGris"><a href="BuscarGuia.php?usr=<?=$usr?>&us_menu=<?=$us_menu?>"><img src="Img/editar.gif" width="25" height="25" border="0" />Consultar</a></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><div id="DetalleBasico" ><?
		if($Monstrar<>"")
		{  include $Monstrar; }
 	?>&nbsp;</div></td>
  </tr>
</table>

</body>
</html>
