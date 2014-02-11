<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" type="image/ico" href="Img/favicon.ico"> 
<? include "include/VarGlobales.PHP"; ?>
<title><?=$NOMPROYECTO?></title>
<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
</head>
<body>



<? 
//include "LlamadoMenu.php"; 

include "include/VarGlobales.PHP"; 
require("include/BdSqlClases.php");


$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
 $q->ejecutar("SELECT    USB_CEDULA, USB_NOMBRE, USB_CLAVE, EM_ID, USB_HABILITAR
				FROM         IPAL_USUARIOS_BB
               WHERE  USB_CEDULA=$usr ", 107, "Principal.php");
 $q->Cargar();
 $nombre=$q->dato(1);
 $USB_HABILITAR=$q->dato(4);
 
 if($USB_HABILITAR<>'SI')
 {		
		$SQL="SELECT COUNT(*) FROM IPAL WHERE   (GE_BVERIFTERRENO = 'INICIO')
			AND  (USR_DIGITA ='".$usr."' or USR_DIGITA ='".$nombre."')";
		$q->ejecutar($SQL,156,'MarcoFormatoBB.php');	   
		$q->Cargar();
		$ENINICIO=$q->dato(0);
 }
 else
   $ENINICIO=0;




if($GE_NO_INSPECCION<>"")
{


	 $sql1="SELECT     CONVERT(varchar(10), IPAL.GE_FECHA, 120) AS Expr0, IPAL.GE_MOVIL, IPAL.GE_PLACA, IPAL.GE_TIPOVEHICULO, IPAL.GE_TRAB_AREALIZAR, 
                      PROCESOS.PR_NOMCOMPLETO, GE_AREACODENSA, DATEPART(hh, IPAL.GE_HINICIO) AS Expr7, DATEPART(mi, IPAL.GE_HINICIO) AS Expr8,
					   DATEPART(hh, IPAL.GE_HFINALIZACION)  AS Expr9, DATEPART(mi, IPAL.GE_HFINALIZACION) AS Expr10, 
					    IPAL.GE_OBSERVACION, IPAL.GE_OBSAMBIENTAL, 
					     GE_MUNICIPIO, IPAL.GE_DIRECCION AS DATO15,
                       IPAL.GE_PGRUA, IPAL.GE_PCANASTA, 
                      IPAL.GE_PMOTO,EMPRESA_CONTRATOS.EC_CONTRATO,  EMPRESAS.EM_NOMBRE, GE_TIPONO, GE_NO
			FROM         IPAL INNER JOIN
                      PROCESOS ON IPAL.PR_ID = PROCESOS.PR_ID INNER JOIN
                      EMPRESA_CONTRATOS ON IPAL.EC_ID = EMPRESA_CONTRATOS.EC_ID INNER JOIN
                      EMPRESAS ON EMPRESA_CONTRATOS.EM_ID = EMPRESAS.EM_ID
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
    // echo $sql1;
	 $q->ejecutar($sql1,86,'BuscarGuia.php');	   
	 while($q->Cargar())
	{ 
	   $GE_FECHA=$q->dato(0);
	   $GE_MOVIL=$q->dato(1);
	   $GE_PLACA=$q->dato(2);
	   $GE_TIPOVEHICULO=$q->dato(3);
	   $GE_TRAB_AREALIZAR=$q->dato(4);
	   $PR_NOMCOMPLETO=$q->dato(5);
	   $GE_AREACODENSA=$q->dato(6);
	   $GE_HINICIO=$q->dato(7).":".$q->dato(8);
	   $GE_HFINALIZACION=$q->dato(9).":".$q->dato(10);	  
	   $GE_OBSERVACION =$q->dato(11);	  
	   $GE_OBSAMBIENTAL =$q->dato(12);	  
	   $GE_MUNICIPIO =$q->dato(13);	
	   $GE_DIRECCION=$q->dato(14);	  	   	   	   
	   $GE_PGRUA=$q->dato(15);	  	   	   	   
	   $GE_PCANASTA=$q->dato(16);	  	   	   	   
	   $GE_PMOTO=$q->dato(17);		   	   
	   $EC_CONTRATO=$q->dato(18);
	   $EM_NOMBRE=$q->dato(19);	  
	   $GE_TIPONO=$q->dato(20);
	   $GE_NO=$q->dato(21);	  
	}  
		
}

?>
<form action="" method="get" name="inicio">
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
<table width="85%" border="0" align="center">
      <tr>
        <td width="23%"><table width="100%" height="107" border="0">
      <tr>
        <td colspan="3"><table width="100%" border="0" align="center">
          <tr>
            <td width="14%"><div align="right">
			<?
			if($volver=="")
			{?>
			<a href="MarcoFormatoBB.php?ENINICIO=<?=$ENINICIO?>&GE_NO_INSPECCION=<?=$GE_NO_INSPECCION?>&usr=<?=$usr?>&us_menu=<?=$us_menu?>&Monstrar=FormatoBB.php">Regresar Inspeccion</a>
			<?
			}
			else
			{
			?>
			<a href="BuscarGuiaBB.php?ENINICIO=<?=$ENINICIO?>&GE_NO_INSPECCION=<?=$GE_NO_INSPECCION?>&usr=<?=$usr?>&us_menu=<?=$us_menu?>&Monstrar=FormatoBB.php">Regresar Consulta</a>
			<?
			}
			?>
			
			</div></td>
            <td width="86%" class="TitulosTablas"><div align="center" class="TitulosTablas">INSPECCION DE  SEGURIDAD INDUSTRIAL Y AMBIENTAL</div></td>
            </tr>
        </table></td>
      </tr>

  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="58%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="100%" colspan="2" class="TituloG" ><table width="100%" border="1" cellpadding="0" cellspacing="0">
              
              <tr>
                <td width="12%" class="Fondogris"><div align="left" >Empresa: </div></td>
				<td width="51%" class="titulos"><?=$EM_NOMBRE?></td>
				<td width="15%" class="Fondogris"><div align="left">No contrato </div></td>
                <td width="22%" class="titulos"><div align="left"><?=$EC_CONTRATO?></div></td>
              </tr>
            </table></td>
            </tr>
          
          <tr>
            <td colspan="2"><table width="100%" border="1" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="4"  ><table width="100%" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="17%" class="Fondogris">No Inspeccion</td>
                    <td width="28%"><span class="titulos">
                      <?=$GE_NO_INSPECCION?>
                    </span></td>
                    <td width="11%" class="Fondogris">Fecha</td>
                    <td width="22%"><?=$GE_FECHA?></td>
                    <td width="9%">&nbsp;</td>
                    <td width="13%">&nbsp;</td>
                  </tr>
                </table></td>
                </tr>
              <tr>
                <td width="9%" class="Fondogris">Direcci&oacute;n</td>
                <td width="23%"  class="titulos"><?=$GE_DIRECCION?></td>
                <td width="26%" class="Fondogris">Municipio</td>
                <td width="42%"  class="titulos"><?=$GE_MUNICIPIO?></td>
              </tr>
	  
            </table></td>
            </tr>
        </table>
          </td>
        <td width="42%" valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0">
          
          <tr>
            <td width="115" class="Fondogris"><div align="left">Trabajo a realizar </div></td>
            <td width="362"  class="titulos"><div align="left"><?=$GE_TRAB_AREALIZAR?></div></td>
          </tr>
          <tr>
            <td class="Fondogris"><div align="left">Proceso</div></td>
            <td align="left"  class="titulos"><?=$PR_NOMCOMPLETO?></td>
          </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0">
              <tr>
                <td class="Fondogris">Tipo</td>
                <td class="titulos"><?=$GE_TIPONO?>&nbsp;</td>
                <td class="Fondogris">No </td>
                <td class="titulos"><?=$GE_NO?>&nbsp;</td>
              </tr>
            </table></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <td width="24%" class="Fondogris">ce/Avantel</td>
            <td width="15%" class="Fondogris">Tipo Vehiculo </td>
             <?
			if($GE_PLACA<>"")
		    {?>
			<td width="21%" class="Fondogris">Placa Vehiculo </td>
             <?
			} 
			if($GE_PGRUA<>"")
		    {?>
		    <td width="14%" class="Fondogris">Placa Grua </td><?
			}
			if($GE_PCANASTA<>"")
		    {?>
            <td width="13%" class="Fondogris">PlacaCanasta</td><?
			}
			if($GE_PMOTO<>"")
		    {?>
			<td width="13%" class="Fondogris">Placa Moto </td><?
			}?>
            </tr>
          <tr>
            <td  class="titulos"><?=$GE_MOVIL?></td>
            <td class="titulos"><?=$GE_TIPOVEHICULO?></td>
             <?
			if($GE_PLACA<>"")
		    { ?>
			<td class="titulos"><?=$GE_PLACA?></td>
            <?
			}
			if($GE_PGRUA<>"")
		    {?>
		 	 <td class="titulos"><?=$GE_PGRUA?></td><?
			}
			if($GE_PCANASTA<>"")
		    {?>
            <td class="titulos"><?=$GE_PCANASTA?></td><?
			}
			if($GE_PMOTO<>"")
		    {?>
            <td class="titulos"><?=$GE_PMOTO?></td>	<?
			}?>
            </tr>
        </table></td>
        <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <td class="Fondogris">Hora inicial (Militar) </td>
            <td class="Fondogris">Hora final (Militar) </td>
          </tr>
          <tr>
            <td class="titulos"><?=$GE_HINICIO?></td>
            <td class="titulos"><?=$GE_HFINALIZACION?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<tr>
    <td>
<?



    $SQL="SELECT    EE_CEDULA, EE_NOMBRES, EE_APELLIDO1, EE_APELLIDO2, EE_CARGO, EE_LIDER
			FROM         INFO_EMPRESA_EMPLEADOS
			WHERE GE_NO_INSPECCION=$GE_NO_INSPECCION	";
    $q->ejecutar($SQL,86,'BuscarGuia.php');	   
?>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <td width="7%" height="20" class="Fondogris"><div align="left">Cedula</div></td>
    <td width="9%" class="Fondogris"><div align="left">Nombre</div></td>
    <td width="9%" class="Fondogris">Apellido1</td>
    <td width="9%" class="Fondogris">Apellido2</td>
    <td width="9%" class="Fondogris"><div align="center">Cargo</div></td>
    <td width="6%" class="Fondogris">Jefe de cuadrilla </td>
    <td width="51%" class="Fondogris"><div align="center">Incumplimiento</div></td>
  </tr>
  <?
   while($q->Cargar())
   { 
    $Nombre= $q->dato(1);
    ?>
  <tr>
    <td class="titulos"><div align="left"><?=$q->dato(0)?></div></td>
    <td class="titulos"><div align="left"><?=$Nombre    ?></div></td>
    <td class="titulos"><div align="left"><?=$q->dato(2)?></div></td>
    <td class="titulos"><div align="left"><?=$q->dato(3)?></div></td>
    <td class="titulos"><div align="left"><?=$q->dato(4)?></div></td>	
    <td class="titulos"><?=$q->dato(5)?></td>
    <td class="titulos"><div align="LEFT">
	<?
      $sql1="SELECT     IPAL_CUADRILLA.NC_ID, NC_LISTADO.NC_DESCRIPCION
             FROM         IPAL_CUADRILLA INNER JOIN
                      NC_LISTADO ON IPAL_CUADRILLA.NC_ID = NC_LISTADO.NC_ID
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and EE_CEDULA=".$q->dato(0);
			// echo $sql1."<BR>";
	   $s->ejecutar($sql1,426,'SubirPlano.php');	  
	   while($s->Cargar())
	   {
	    echo $s->dato(0).":".$s->dato(1);
	   }
	   
	?>
</div></td>
  </tr>
  <?
    $CanC++;
}
?></table>
	
	</td>
  </tr>  
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td colspan="2"><div align="center" class="TitulosTablas">verificacion del incumplimiento </div></td>
        </tr>
      <tr>
        <td colspan="2">
		<!--inicio incumplimineti-->
<?

$sql="SELECT   DISTINCT   NC_CLASIFICACION.CL_ID, CL_DESCRIPCION
		FROM         NC_CLASIFICACION INNER JOIN
                      NC_SUBCLASIFICACION ON NC_CLASIFICACION.CL_ID = NC_SUBCLASIFICACION.CL_ID INNER JOIN
                      NC_LISTADO ON NC_SUBCLASIFICACION.CL_ID = NC_LISTADO.CL_ID AND NC_SUBCLASIFICACION.SB_ID = NC_LISTADO.SB_ID INNER JOIN
                      IPAL_DETALLE ON NC_LISTADO.NC_ID = IPAL_DETALLE.NC_ID
        WHERE IPAL_DETALLE.DE_RESULTADO='NO' AND 	GE_NO_INSPECCION=$GE_NO_INSPECCION 					  
		order by NC_CLASIFICACION.CL_ID";
$q->ejecutar($sql,14,'ListasrOPCionesNC.php');
$i=0;
$cSi='FelizdeLado.png';
while($q->Cargar())
{ 
  $ArrClas[$i][0]=$q->dato(0);
  $ArrClas[$i][1]=$q->dato(1);  
  $sql="SELECT NC_SUBCLASIFICACION.SB_ID, NC_SUBCLASIFICACION.SUB_DESCRIPCION
			FROM         NC_SUBCLASIFICACION INNER JOIN
								  NC_LISTADO ON NC_SUBCLASIFICACION.CL_ID = NC_LISTADO.CL_ID AND NC_SUBCLASIFICACION.SB_ID = NC_LISTADO.SB_ID INNER JOIN
								  IPAL_DETALLE ON NC_LISTADO.NC_ID = IPAL_DETALLE.NC_ID
			WHERE     (NC_SUBCLASIFICACION.CL_ID = ".$ArrClas[$i][0].") AND (IPAL_DETALLE.DE_RESULTADO = 'NO')  AND IPAL_DETALLE.GE_NO_INSPECCION=$GE_NO_INSPECCION 
			ORDER BY NC_SUBCLASIFICACION.SUB_ORDEN
		
		";
 //echo $sql."<br>";
  $s->ejecutar($sql,14,'ListasrOPCionesNC.php');		
	$m=0;
	while($s->Cargar())
	{ 
	  $ArrSub[$i][$m][0]=$s->dato(0);
	  $ArrSub[$i][$m][1]=$s->dato(1);  
	  //echo $ArrSub[$i][$m][0]."<br>";
	  $m++;
      $cSi='TristeDeLado.png';
	}
	$i++;
}
for($i=0;$i<=1;$i++)
{
?>
<table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <td colspan="6" align="center" class="FondogrisTitulos"><?=$ArrClas[$i][0]."-".$ArrClas[$i][1]?></td>
  </tr>
<?
  for($m=0;$m<count($ArrSub[$i]);$m++)
  {

	 $sql="SELECT    NC_ID, NC_DESCRIPCION
			FROM         NC_LISTADO
		 where CL_ID=".$ArrClas[$i][0]." and  SB_ID='".$ArrSub[$i][$m][0]."'";
	
	//echo "listado".$sql."<br>";	 
	$q->ejecutar($sql,14,'ListasrOPCionesNC.php');
?>  
  <tr>
    <td colspan="6" align="left" class="titulosFondoGris" ><div align="center" class="TituloG"><?=$ArrSub[$i][$m][0]."-".$ArrSub[$i][$m][1]?>
      </div></td>
  </tr>
  <tr>
    <td colspan="2" class="Fondogris"><div align="left">Cod</div>      <div align="left"></div></td>
    <td width="3%" class="Fondogris"><div align="center">Cum</div></td>
    <td width="2%" class="Fondogris">Cat</td>
    <td width="21%" class="Fondogris"><div align="center">Definicion</div></td>
	<td width="25%" class="Fondogris"><div align="center">Observacion</div></td>
  </tr>
  
  <?

   while($q->Cargar())
   { 
 	 	 	  
	 $SQL="SELECT   DE_RESULTADO, DE_DESCRIPCION, DE_CATEGORTIA
            FROM         IPAL_DETALLE
			WHERE GE_NO_INSPECCION=$GE_NO_INSPECCION AND NC_ID= ".$q->dato(0);
     $s->ejecutar($SQL,14,'ListasrOPCionesNC.php');
	 $s->Cargar();
	 $res=$s->dato(0) ;
	 $obs=$s->dato(1) ;
	 $cat=$s->dato(2) ;	 
	 $CA_DESCRIPCION="";
	 if($cat<>"")
	 {
	  $SQL="SELECT     CA_DESCRIPCION
				FROM         NC_CATEGORIAS
				WHERE     DE_CATEGORIA= '$cat'";
	  $s->ejecutar($SQL,14,'ListasrOPCionesNC.php');
	  $s->Cargar();
      $CA_DESCRIPCION=$s->dato(0);
	  }
	  if($res=='NO')
	  {	 
		   ?>
		  <tr>
			<td width="4%" class="titulos"><div align="left"><?= $q->dato(0)?></div></td>
			<td width="45%" class="titulos"><div align="left"><?= $q->dato(1)?></div></td>
			<td class="titulos"><div align="center"><?=$res?></div></td>
			<td class="titulos"><?=$cat?>&nbsp;</td>
			<td class="titulos"><div align="center"><?=$CA_DESCRIPCION?></div></td>
			<td class="titulos"><div align="center"><?=$obs?></div></td>
		  </tr>
		  <?
     }		  
  }
 } 
  
}?>
</table>		
		
		<!--fin incumplimiento1-->		</td>
        </tr>
      <tr>
        <td><span class="Fondogris">Observaciones del inspeccionado:</span></td>
        <td><span class="titulos"><?=$GE_OBSAMBIENTAL?></span></td>
      </tr>
      <tr>
        <td width="23%"><span class="Fondogris">Observaciones del inspector:</span></td>
        <td width="77%"><span class="titulos"><?=$GE_OBSERVACION?></span></td>
      </tr>
      <tr>
        <td colspan="2"><table width="488" border="0" align="center">
          <tr>
<td width="42%"><span class="Fondogris">Resultado de la inspeccion</span></td>
        <td width="58%"><span class="titulos"> <img src="Img/<?=$cSi?>" width="190" height="132"></span></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
		
    </table></td>
  </tr>
</table>

</form>
