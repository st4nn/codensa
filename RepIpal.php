<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" type="image/ico" href="Img/favicon.ico"> 
<? include "include/VarGlobales.PHP"; ?>
<title><?=$NOMPROYECTO?></title>
<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
<script src="js/ajaxCargar.js"></script>
  <script type="text/javascript">
 function Verfoto(Mostrar, en, grados)
 { 

   lugar=en;
   datos="ancho=122&alto=163";
 
/*   if(inicio.angulo.value=="360")
          inicio.angulo.value=""   
   
   if(inicio.angulo.value=="")
   {
    sig=grados+90
	inicio.angulo.value=sig

   }
   else
   {
     algo=inicio.angulo.value
	// alert(algo)   
	 grados=(algo*1)-90
	// alert(grados)   
	 inicio.angulo.value=grados
   }
*/   
	//alert(grados)   
   envia('foto3.php?accion=rotar&IMG='+Mostrar+"&angulo="+grados, datos)
 }
 
 function Grande(Mostrar, en)
 {
     
	 lugar=en;
   creceren=50 
    if(inicio.ancho.value=="")
   {
     sig=122+creceren
	 inicio.ancho.value=sig
	 sig=163+creceren
	 inicio.alto.value=sig
   }
   else
   {
     algo=inicio.ancho.value
	// alert(algo)   
	 an=(algo*1)+creceren
	// alert(grados)   
	 inicio.ancho.value=an
	 
	 
	 algo=inicio.alto.value
	// alert(algo)   
	 an=(algo*1)+creceren
	// alert(grados)   
	 inicio.alto.value=an
	 
   }
	 
	 datos="ancho="+inicio.ancho.value+"&alto="+inicio.alto.value;
     envia('foto3.php?accion=zoom&IMG='+Mostrar, datos)
 
 }
 
 
  </script>
</head>
<body>
<form action="Repipal.php" method="get" name="inicio">
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
 <input type="hidden"   name="GE_NO_INSPECCION"      size="10"  maxlength="10" value="<?=$GE_NO_INSPECCION?>">
  <input type="hidden"   name="angulo"  size="10"  maxlength="10" value="<?=$angulo?>">
  <input type="hidden"   name="ancho"  size="10"  maxlength="10" value="<?=$ancho?>">
  <input type="hidden"   name="alto"  size="10"  maxlength="10" value="<?=$alto?>">    
</form>
<? 
include "LlamadoMenu.php"; 

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$cSi='FelizdeLado.png';
if($GE_NO_INSPECCION<>"")
{


	 $sql1="SELECT     CONVERT(varchar(10), IPAL.GE_FECHA, 120) AS Expr0, IPAL.GE_MOVIL, IPAL.GE_PLACA, IPAL.GE_TIPOVEHICULO, IPAL.GE_TRAB_AREALIZAR, 
                       IPAL.PR_ID, IPAL.GE_AREACODENSA, DATEPART(hh, IPAL.GE_HINICIO) AS Expr7, DATEPART(mi, IPAL.GE_HINICIO) AS Expr8, 
					   DATEPART(hh, IPAL.GE_HFINALIZACION) AS Expr9, 
                      DATEPART(mi, IPAL.GE_HFINALIZACION) AS Expr10, 
					  
					  SUBSTRING(IPAL.GE_OBSERVACION,0,250) as observacin11, IPAL.GE_OBSAMBIENTAL, IPAL.GE_DIRECCION AS DATO13, IPAL.GE_PGRUA, 
                      IPAL.GE_PCANASTA, IPAL.GE_PMOTO, EMPRESA_CONTRATOS.EC_CONTRATO, EMPRESAS.EM_NOMBRE, IPAL.GE_TIPONO, IPAL.GE_NO, IPAL.GE_RESULTADOIPAL ,
					   SUBSTRING(IPAL.GE_OBSERVACION,251,500) as observacin22, IPAL.GE_TINSPECCION,
					    SUBSTRING(IPAL.GE_OBSERVACION,501,700) as obse24, GE_MUNICIPIO,
					   SUBSTRING(IPAL.GE_OBSERVACION,751,1000) as observacin26  , SUBSTRING(IPAL.GE_OBS1,0,250)    ,
						 SUBSTRING(IPAL.GE_OBS1,251,500) as observacin28, GE_OBS1, DATALENGTH(GE_OBS1) AS tamano, GE_VFALLIDA,
						  GE_SOCIO, GE_NODELFOS
			FROM         IPAL INNER JOIN
								  EMPRESA_CONTRATOS ON IPAL.EC_ID = EMPRESA_CONTRATOS.EC_ID INNER JOIN
								  EMPRESAS ON EMPRESA_CONTRATOS.EM_ID = EMPRESAS.EM_ID
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
     //echo $sql1;
	 $q->ejecutar($sql1,43,'RepIpal.php');	   
	 while($q->Cargar())
	{ 
	   $GE_FECHA=$q->dato(0);
	   $GE_MOVIL=$q->dato(1);
	   $GE_PLACA=$q->dato(2);
	   $GE_TIPOVEHICULO=$q->dato(3);
	   $GE_TRAB_AREALIZAR=utf8_decode($q->dato(4));
        //echo $GE_TRAB_AREALIZAR;
	   $PR_ID=$q->dato(5);
	   $GE_AREACODENSA=$q->dato(6);
	   $GE_HINICIO=$q->dato(7).":".$q->dato(8);
	   $GE_HFINALIZACION=$q->dato(9).":".$q->dato(10);	  
	   $GE_OBSERVACION =$q->dato(11)." ".$q->dato(22)." ".$q->dato(24)." ".$q->dato(26);	  
	   $GE_OBSAMBIENTAL =utf8_decode($q->dato(12));	  
	   $GE_DIRECCION=utf8_decode($q->dato(13));	  	   	   	   
  
	   $GE_PGRUA=$q->dato(14);	  	   	   	   
	   $GE_PCANASTA=$q->dato(15);	  	   	   	   
	   $GE_PMOTO=$q->dato(16);		   	   
	   $EC_CONTRATO=$q->dato(17);
	   $EM_NOMBRE=$q->dato(18);	  
	   $GE_TIPONO=$q->dato(19);
	   $GE_NO=$q->dato(20);	  
	   $ge_resultadoipal=$q->dato(21);	
	   $GE_TINSPECCION  =$q->dato(23);	
	   $GE_MUNICIPIO =$q->dato(25);	
	   //$GE_OBS1 =$q->dato(27).$q->dato(28);
	   $GE_OBS1 =$q->dato(29);
	   $GE_VFALLIDA=$q->dato(31);
//echo "GE_VFALLIDA=".$GE_VFALLIDA."<br>";
       if($GE_VFALLIDA=="")$GE_VFALLIDA="NO";
       $GE_SOCIO=$q->dato(32);
       $GE_NODELFOS=$q->dato(33);


	  // $tamano =$q->dato(30);
//echo "GE_VFALLIDA=".$GE_VFALLIDA;
	   IF($ge_resultadoipal<>'CFELIZ')
	     $cSi='TristeDeLado.png';
		 
		 
		 
		 
	}
	 if ($PR_ID<>"")
	 {
		 $sentencia="SELECT     PR_ID, PR_NOMCORTO, PR_NOMCOMPLETO
						FROM         PROCESOS
						where PR_ID='$PR_ID'";
		   $s->ejecutar($sentencia, 60, 'Procesos.php');
		   $s->Cargar();
		   //$nombre=$s->dato(0);
		   $PR_NOMCOMPLETO=$PR_ID."-".$s->dato(1);
	}
	$sql="SELECT    RES_CEDULA, RES_NOMBRE, RES_CARGO, EM_ID
			FROM         IPAL_RES_INSPECCION
		  WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";  
	$q->ejecutar($sql,158,'RepIpal.php');	   
	while($q->Cargar())
	{ 
	   $RES_CEDULA=$q->dato(0);
	   $RES_NOMBRE=$q->dato(1);
	   $RES_CARGO=$q->dato(2);
	   $EM_IDinspector=$q->dato(3);
	   $responsable=$RES_CEDULA."-".$RES_NOMBRE;
	   if($EM_IDinspector<>"")
	   {
	    $sql="SELECT   EM_NOMBRE
			FROM         EMPRESAS
			where EM_ID= ".$EM_IDinspector;
	   $s->ejecutar($sql, 170, 'RepIpal.php');
       $s->Cargar();		
	   $empresaInspector=$s->dato(0);
	   $responsable=$RES_CEDULA."-".$RES_NOMBRE."-".$empresaInspector;
	   }
	}	
}

?>

<table width="80%" border="0" align="center">
      <tr>
        <td width="23%"><table width="100%" height="107" border="0">
      <tr>
        <td colspan="3"><table width="100%" border="0" align="center">
          <tr>
            <td width="6%"><div align="right"></div></td>
            <td width="94%" class="TitulosTablas"><div align="center" class="TitulosTablas">INSPECCION DE  SEGURIDAD INDUSTRIAL Y AMBIENTAL</div></td>
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
                <td colspan="4"><table width="100%" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                   <td width="5%" class="Fondogris">No</td>
                <td width="31%" class="titulosRojo"><?=$GE_NO_INSPECCION?>&nbsp;</td>
                <td width="15%" class="Fondogris">Inspector</td>
                <td width="49%" class="titulos"><?=$responsable?></td>
                <td width="15%" class="Fondogris">No Socio</td>
                <td width="49%" class="titulos"><?=$GE_SOCIO?>&nbsp;</td>
                <td width="15%" class="Fondogris">No Delfos</td>
                <td width="49%" class="titulos"><?=$GE_NODELFOS?>&nbsp;</td>
                <td width="15%" class="Fondogris">Ins. Fallida</td>
                <td width="49%" class="titulos"><?=$GE_VFALLIDA?></td>

   
                  </tr>
                </table></td>
                </tr>
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
                <td width="7%"  class="Fondogris"><div align="left" >Fecha</div></td>
                <td width="10%" nowrap  class="titulos"><div align="left"><?=$GE_FECHA?></div></td>
                <td width="13%" class="Fondogris">Direcci&oacute;n</td>
                <td width="32%"  class="titulos"><?=$GE_DIRECCION?> Municipio:<?=$GE_MUNICIPIO?> </td>
                <td width="12%" class="Fondogris">Municipio</td>
                <td width="26%"  class="titulos"><?=$GE_MUNICIPIO?> </td>
                
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
            <td colspan="2"><table width="100%" border="1" cellpadding="0" cellspacing="0">
              <tr>
                <td width="19%" class="Fondogris"><div align="left">Proceso</div></td>
                 <td width="38%" align="left"  class="titulos"><?=$PR_NOMCOMPLETO?></td>
                <td width="9%" class="Fondogris"> Tipo</td>
                <td width="34%" class="titulos"><?=$GE_TINSPECCION?>&nbsp;</td>
              </tr>
            </table></td>
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
            <td width="21%" class="Fondogris">Placa Vehiculo </td>
            <td width="14%" class="Fondogris">Placa Grua </td>
            <td width="13%" class="Fondogris">PlacaCanasta</td>
            <td width="13%" class="Fondogris">Placa Moto </td>
            </tr>
          <tr>
            <td  class="titulos"><?=$GE_MOVIL?></td>
            <td class="titulos"><?=$GE_TIPOVEHICULO?></td>
            <td class="titulos"><?=$GE_PLACA?></td>
            <td class="titulos"><?=$GE_PGRUA?></td>
            <td class="titulos"><?=$GE_PCANASTA?></td>
            <td class="titulos"><?=$GE_PMOTO?></td>
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
    $q->ejecutar($SQL,302,'RepIpal.php');	   
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
    <td class="titulos"><div align="left"><?=utf8_encode($Nombre)   ?></div></td>
    <td class="titulos"><div align="left"><?=utf8_encode($q->dato(2))?></div></td>
    <td class="titulos"><div align="left"><?=utf8_encode($q->dato(3))?></div></td>
    <td class="titulos"><div align="left"><?=$q->dato(4)?></div></td>	
    <td class="titulos"><?=$q->dato(5)?></td>
    <td class="titulos"><div align="LEFT">
	<?
      $sql1="SELECT     IPAL_CUADRILLA.NC_ID, NC_LISTADO.NC_DESCRIPCION
             FROM         IPAL_CUADRILLA INNER JOIN
                      NC_LISTADO ON IPAL_CUADRILLA.NC_ID = NC_LISTADO.NC_ID
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and EE_CEDULA=".$q->dato(0);
			// echo $sql1."<BR>";
	   $s->ejecutar($sql1,333,'RepIpal.php');	  
	   while($s->Cargar())
	   {
	    echo $s->dato(0).":".$s->dato(1)."<br>";
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
        <td colspan="2"><div align="center" class="TitulosTablas">
          <table width="100%" border="0" align="center">
            <tr>
              <td width="58%" height="61"><div align="center">verificacion del incumplimiento </div></td>
              <td width="42%"><div align="center"><span class="titulos"> <img src="Img/<?=$cSi?>" width="52" height="44"></span></div></td>
            </tr>
          </table>
        </div></td>
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
$q->ejecutar($sql,370,'RepIpal.php');
$i=0;
while($q->Cargar())
{ 
  $ArrClas[$i][0]=$q->dato(0);
  //echo $ArrClas[$i][0];
  $ArrClas[$i][1]=$q->dato(1);  
  $sql="SELECT DISTINCT NC_SUBCLASIFICACION.SB_ID, NC_SUBCLASIFICACION.SUB_DESCRIPCION, NC_SUBCLASIFICACION.SUB_ORDEN
		FROM         NC_SUBCLASIFICACION INNER JOIN
                      NC_LISTADO ON NC_SUBCLASIFICACION.CL_ID = NC_LISTADO.CL_ID AND NC_SUBCLASIFICACION.SB_ID = NC_LISTADO.SB_ID INNER JOIN
                      IPAL_DETALLE ON NC_LISTADO.NC_ID = IPAL_DETALLE.NC_ID
		where  IPAL_DETALLE.DE_RESULTADO='NO' AND 	GE_NO_INSPECCION=$GE_NO_INSPECCION  AND NC_SUBCLASIFICACION.CL_ID=".$ArrClas[$i][0]." order by SUB_ORDEN";
 //echo $sql."<br>";
  $s->ejecutar($sql,386,'RepIpal.php');		
	$m=0;
	while($s->Cargar())
	{ 
	  $ArrSub[$i][$m][0]=$s->dato(0);
	  $ArrSub[$i][$m][1]=$s->dato(1);  
	 // echo $ArrSub[$i][$m][0]."<br>";
	  $m++;
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

	 $sql="SELECT    NC_LISTADO.NC_ID, NC_DESCRIPCION, NC_VALOR
			FROM         NC_LISTADO INNER JOIN
                      IPAL_DETALLE ON NC_LISTADO.NC_ID = IPAL_DETALLE.NC_ID
		 where GE_NO_INSPECCION=$GE_NO_INSPECCION AND IPAL_DETALLE.DE_RESULTADO='NO' and CL_ID=".$ArrClas[$i][0]." and  SB_ID='".$ArrSub[$i][$m][0]."'";
	
	//echo "listado".$sql."<br>";	 
	$q->ejecutar($sql,414,'RepIpal.php');
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
 	 	 	  
	 $SQL="SELECT   DE_RESULTADO, SUBSTRING( DE_DESCRIPCION,0,250), DE_CATEGORTIA,
                            SUBSTRING( DE_DESCRIPCION,251,500) as observacin3, 
							 SUBSTRING( DE_DESCRIPCION,501,750) as observacin4 , SUBSTRING( DE_DESCRIPCION,751,1000) as observacin5
            FROM         IPAL_DETALLE
			WHERE GE_NO_INSPECCION=$GE_NO_INSPECCION AND IPAL_DETALLE.DE_RESULTADO='NO' AND NC_ID= ".$q->dato(0);
    // echo $SQL."<br>";
	 $s->ejecutar($SQL,439,'RepIpal.php');
	 $s->Cargar();
	 $res=$s->dato(0) ;
	 $obs=$s->dato(1)." ".$s->dato(3)." ".$s->dato(4)." ".$s->dato(5) ;
	 $cat=$s->dato(2) ;	 
	 $CA_DESCRIPCION="";
	 //echo $res;
	 if(trim($res)=='NO') $cSi='smilletriste.JPG';
	 //echo $s->dato(5);
	 if($cat<>"")
	 {
	  $SQL="SELECT     CA_DESCRIPCION
				FROM         NC_CATEGORIAS
				WHERE     DE_CATEGORIA= '$cat'";
	  $s->ejecutar($SQL,453,'RepIpal.php');
	  $s->Cargar();
      $CA_DESCRIPCION=$s->dato(0);
	  }
	 if($q->dato(2)==50)$Color='titulosRojo'; 
	 else $Color='titulos'; 	 
   ?>
  <tr>
    <td width="4%" class="<?=$Color?>"><div align="left"><?=$q->dato(0)?></div></td>
    <td width="45%" class="<?=$Color?>"><div align="left"><?= $q->dato(1)?></div></td>
    <td class="<?=$Color?>"><div align="center"><?=$res?></div></td>
    <td class="<?=$Color?>"><?=$cat?></td>
    <td class="<?=$Color?>"><div align="left"><?=$CA_DESCRIPCION?></div></td>
    <td class="<?=$Color?>"><div align="center"><?=$obs?>&nbsp;</div></td>
  </tr>
  <?
  }
 } 
  
}?>
</table>		
		
		<!--fin incumplimiento1-->		</td>
        </tr>
      <tr>
        <td colspan="2"><table width="100%" border="1">
          <tr>
            <td><span class="Fondogris">Observaciones del inspeccionado:</span></td>
            <td> <?=$GE_OBSAMBIENTAL?>&nbsp;</td>
          </tr>
          <tr>
        <td width="23%" class="Fondogris">Observaciones del inspector:</td>
        <td width="77%" class="titulos"><?=utf8_decode($GE_OBSERVACION)?><br><?=utf8_decode($GE_OBS1)?></td>
          </tr>
        </table></td>
        </tr>

      <tr>
        <td colspan="2"><table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <td align="center"  colspan="5" class="FondogrisTitulos">FOTOS</td>
  </tr>
   <tr>	<?
	/*viviana perez septiembre 5 de 2011
	  */

		
		$sql="SELECT     FV_RUTA, FV_NOMBRE, FV_DESCRIPCION
			FROM         FOTOS_VIDEOS
		  where GE_NO_INSPECCION=$GE_NO_INSPECCION	and FV_TIPO='FOTO'";
    $q->ejecutar($sql,503,'RepIpal.php');	
	$i=1;
    while($q->Cargar())
	{
	    $nom="foto".$i;
		$ruta=$q->dato(0).'/'.$q->dato(1);
		?>
		<td  ><div id="<?=$nom?>" style="position:relative; "><img src="<?=$ruta?>" width="163" height="122"  ondrag="resizeImage(event,'<?=$ruta?>')" ><?=$q->dato(2); ?></div>
		<button onclick="Verfoto('<?=$ruta?>','<?=$nom?>',90)">rotar>> </button>
		<button onclick="Grande('<?=$ruta?>','<?=$nom?>', 90)">Zoom ++ </button>		</td>

		<?
		$i++;	
	}
	?>
		 </tr></table></td>
        </tr>
      <tr>
        <td colspan="2"><table width="100%" border="1" align="center" cellspacing="0">
  <tr>
    <td align="center" class="FondogrisTitulos">VIDEOS</td>
  </tr>
   <tr><td >
	<?	
		$sql="SELECT     FV_RUTA, FV_NOMBRE, FV_DESCRIPCION
			FROM         FOTOS_VIDEOS
		  where GE_NO_INSPECCION=$GE_NO_INSPECCION	and FV_TIPO<>'FOTO' and FV_TVIDEO is null";
    $q->ejecutar($sql,530,'RepIpal.php');	
    while($q->Cargar())
	{
	?>	<EMBED SRC="<?=$q->dato(0)."/".$q->dato(1)?>"  WIDTH="176" HEIGHT="170"  AUTOPLAY="false" type="video/quicktime" ></EMBED><br>
	   <a href="<?=$q->dato(0)."/".$q->dato(1)?>">BajarVideo</a><br>
		<?=$q->dato(2); ?> 
	<?	
	}
	?>			
		 </td></tr></table></td>
        </tr>
		
    </table></td>
  </tr>
  <tr>
    <td align="center" class="FondogrisTitulos">FIRMA DIGITAL</td>
  </tr>
   <tr><td >
	<?	
		$sql="SELECT     FV_RUTA, FV_NOMBRE, FV_DESCRIPCION
			FROM         FOTOS_VIDEOS
		  where GE_NO_INSPECCION=$GE_NO_INSPECCION	and FV_TIPO<>'FOTO' and FV_TVIDEO='FIRMA DIGITAL'";
    $q->ejecutar($sql,550,'RepIpal.php');	
    while($q->Cargar())
	{
	?>	
    
    <EMBED SRC="<?=$q->dato(0)."/".$q->dato(1)?>" WIDTH="267" HEIGHT="227" AUTOPLAY="false" type="video/quicktime" ></EMBED><?=$q->dato(2); ?> 
     <a href="<?=$q->dato(0)."/".$q->dato(1)?>">BajarVideo</a><br>    
		<?	
	}
	?>			
		 </td></tr></table></td>
        </tr>
		
    </table></td>
  </tr>
</table>


</body>
</html>
