<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="shortcut icon" type="image/ico" href="Img/favicon.ico"> 
<? include "include/VarGlobales.PHP"; ?>
<title><?=$NOMPROYECTO?></title>
<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
<script src="js/ajaxCargar.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/calendar-blue.css">
  <script type="text/javascript" src="js/calendar.js"></script>
  <script type="text/javascript" src="lang/calendar-es.js"></script>
  <script type="text/javascript" src="js/calendar-setup.js"></script>
  
 <script language="JavaScript">
 var nav4=window.Event?true:false;

 function ValideLetras(evt)
 {
   var key=nav4?evt.which:evt.keyCode;
         return (key==209 || (key>=65 && key <=90))
 }
 function valide()
 {

   if(a.formato.value=="")
   {
     alert("El formato es obligatorio");
      return false;
   }
   if(a.FECHA1.value=="")
   {
     alert("La fecha de inicio es obligatoria");
      return false;
   }
   if(a.FECHA2.value=="")
   {
     alert("La fecha de finalizacion es obligatoria");
      return false;
   }   
   
 }
</script> 
  
</head>
<body>



<? 
include "LlamadoMenu.php"; 

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$m=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
if($nivel=="")
{

   
 $q->ejecutar("select EM_ID
					FROM         IPAL_USUARIOS_PC
					where US_USUARIO='$usr'", 107, "Principal.php");
 $q->Cargar();
 $EM_IDbd=$q->dato(0);
?>
<BR>
<BR>
<form  name="a" action="" method="get" onsubmit='return valide()'>
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
<table width="66%" border="0" align="center">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td width="16%" class="Fondogris">&nbsp;</td>
        <td width="75%" class="TitulosTablas"><div align="center">CALCULAR IPAL GENERAL CODENSA </div></td>
        <td width="9%" class="Fondogris">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><table border="2" align="center">
      <tr>
        <td class="Fondogris"><div align="right">Fecha inicial </div></td>
        <td width="137"><input name="FECHA1" type="TEXT" class="titulos"  id="FECHA1"  value=""  size="10" maxlength="10">
            <input name="calendar1" type="button" id="calendar1"  value="..." >
            <script type="text/javascript">
          Calendar.setup({
           inputField     :    "FECHA1",      // id of the input field
           ifFormat       :    "%Y-%m-%d",       // format of the input field -- "%m/%d/%Y %I:%M %p"
           button         :    "calendar1",   // trigger for the calendar (button ID)
           step           :    1               // show all years in drop-down boxes (instead of every other year as default)
          });
          </script></td>
        <td class="Fondogris"><div align="right">Fecha finalizacion </div></td>
        <td><input name="FECHA2" type="TEXT" class="titulos"  id="FECHA2"  value=""  size="10" maxlength="10">
            <input name="calendar2" type="button" id="calendar2"  value="..." >
            <script type="text/javascript">
          Calendar.setup({
           inputField     :    "FECHA2",      // id of the input field
           ifFormat       :    "%Y-%m-%d",       // format of the input field -- "%m/%d/%Y %I:%M %p"
           button         :    "calendar2",   // trigger for the calendar (button ID)
           step           :    1               // show all years in drop-down boxes (instead of every other year as default)
          });
          </script></td>
      </tr>
      <tr>
            <td class="Fondogris">Formato</td>
            <td width="137" >
            <?
			 $nombre='formato';
             if($usr=='cperez')
			 {
			?>
            <select name="<?=$nombre?>" id="<?=$nombre?>" class="titulos">
              <option value="2011">2011</option>
              <option value="2012">2012</option>
            </select>
            <?
            }
            else
			{
				
				?>2012<input name="<?=$nombre?>" type="hidden" class="titulos"  id="<?=$nombre?>"  value="2012" ><?
			}
			?>
            </td>
            <td  class="Fondogris" align="left">Tipo de inspeccion: </td>
	   <td><select name="GE_TINSPECCION"  id="GE_TINSPECCION"  class="titulos">
           <option value="">Seleccione</option>
	          				  <?
				   $sql="SELECT DISTINCT GE_TINSPECCION
							FROM      ipal
                       		where GE_TINSPECCION is not null
							order by  GE_TINSPECCION";
				   $q->ejecutar($sql,101,'BuscarGuiaTotal.php');	   
				   while($q->Cargar())
				   { 
					   ?><option value="<?=$q->dato(0)?>" ><?=$q->dato(0)?></option><?
					}  
				  ?>
              </select></td>
      </tr>
      
      <tr>
        <td width="67" class="Fondogris"><div align="left">Empresa: </div></td>
		<TD><select name="EM_ID" id="EM_ID"  class="titulos"  onchange="CargarContratos(EM_ID.value, this.id)">
				  <?
				  if($EM_IDbd=="")
				  {
				    ?><option value="">Seleccione</option><?
				   }	
				  
				   $sql="SELECT   EM_ID, EM_NOMBRE
							FROM         EMPRESAS";
					if($EM_IDbd<>"") $sql.=" where  EM_ID=$EM_IDbd";		
					$sql.=" order by EM_NOMBRE";
				   $q->ejecutar($sql,129,'Formato.php');
				   $Nofilas=$q->filas();			   
				   while($q->Cargar())
				   { 
					   $EM_ID=$q->dato(0);
					   ?><option value="<?=$q->dato(0)?>" <? IF($Nofilas==1) echo "selected"?> ><?=$q->dato(1)?></option><?
					}  
				  ?>
		    </select> </td>
				<td width="72" class="Fondogris"><div align="left">No contrato </div></td>
            <td width="223"><div align="left">
<select name="EC_ID" id="EC_ID" class="titulos" >
					<option value=""></option>
			<?
			 if($EM_IDbd<>"")
			 {
			     $sql="SELECT    EC_ID, EC_CONTRATO, EC_DESCORTA

				  	FROM         EMPRESA_CONTRATOS
					where EM_ID='$EM_IDbd'";
                //echo $sql;
                $q->ejecutar($sql,14,'obtenerContratos.php.php');
				$Nofila2=$q->filas();		
			    while($q->Cargar())
				{ 
					  
					   ?><option value="<?=$q->dato(0)?>" <? IF($Nofila2==1) echo "selected"?> ><?=$q->dato(1).":".$q->dato(2)?></option><?
				}  
		  }		  
				  ?>
			    </select>
            </div></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><div align="center">
        <input type="submit" name="Submit" value="Consultar">
		<input type="hidden" name="nivel" value="1">
      </div>
    </div> </td>
  </tr>
  
  
</table>
<p>&nbsp;</p>
<table width="838" border="1" align="center">
  <tr>
    <td class="TitulosTablas">En esta consulta se genera el calculo ipal y debe seleccionar: </td>
  </tr>
  <tr>
    <td class="titulos">* Formato a  evaluar. </td>
  </tr>
  <tr>
    <td class="titulos"> * Inspecciones  realizadas de acuerdo al periodo seleccionado en las &quot;Fechas &quot;.</td>
  </tr>
  <tr>
    <td class="TitulosTablas">Y puede realizar el filtro por: </td>
  </tr>
  <tr>
    <td class="titulos"> * Consultar por el tipo de inspeccion</td>
  </tr>
  <tr>
    <td class="titulos"> * Consultar por empresa y/o contrato. </td>
  </tr>
</table>
<p>&nbsp;</p>
</form>
 <?
}
if($nivel=="1")
{ 
  $US_ID=1;
  
  
/*
	  $SQL="SELECT MAX(US_ID)+1 FROM IPAL_CALCULO_US ";
	  $q->ejecutar($SQL,153,'BuscarCalculoIpal.php');	   
	  $q->Cargar();
	  $US_ID=$q->dato(0);
	  if($US_ID=="")$US_ID=1;
*/
  ?>
 <form name="calculo" action="" method="get">
  <input type="hidden" name="nivel" value="<?=$nivel?>"> 
  <input type="hidden" name="US_ID" value="<?=$US_ID?>">
  <input type="hidden" name="EM_ID" value="<?=$EM_ID?>">
  <input type="hidden" name="EC_ID" value="<?=$EC_ID?>">
  <input type="hidden" name="FECHA1" value="<?=$FECHA1?>">
  <input type="hidden" name="FECHA2" value="<?=$FECHA2?>">
  <input type="hidden" name="formato" value="<?=$formato?>">
  <input type="hidden" name="GE_TINSPECCION" value="<?=$GE_TINSPECCION?>">  
  <input type="hidden" name="NIVEL" value="1">    
  <input type="hidden" name="usr" value="<?=$usr?>">    
  <input type="hidden" name="us_menu" value="<?=$us_menu?>">      
  
  <?
 // $SQL="insert into IPAL_CALCULO_US (US_ID, FECHA) values ($US_ID,  getdate())";
 // $q->ejecutar($SQL,159,'BuscarCalculoIpal.php');	   
  

   /*DEBE BORRAR LA ESTRUCTURA PARA COLCOAR LOS DATOS DESDE CERO*/


   if( $EC_ID=="" and $EM_ID =="" )
      $TIPO="GENERAL";
   if( $EC_ID<>"" and $EM_ID <>"" )
      $TIPO="CONTRATO";
   if( $EC_ID<>"" and $EM_ID =="" )
      $TIPO="EMPRESA";
  
   $sql2="DELETE FROM IPAL_CALCULO_TOTAL WHERE US_ID=$US_ID";
   $q->ejecutar($sql2,206,'BuscarCalculoIpal.php');			


   $sql2="DELETE FROM   IPAL_CALCULO_RANGO WHERE US_ID=$US_ID";
   $q->ejecutar($sql2,210,'BuscarCalculoIpal.php');			
	


  $SQL="SELECT   RANGO1, RANGO2, VALOR
		FROM         IPAL_CONF_RANGOS";
		
  $q->ejecutar($SQL,217,'BuscarCalculoIpal.php');
  $i=0;
  while($q->Cargar())
  {		
    $ArrRangos[$i][0]=$q->dato(0);
    $ArrRangos[$i][1]=$q->dato(1);	
    $ArrRangos[$i][2]=$q->dato(2);	
	$i++;
  }

  $EMP=0;
  $CONTRATO=0;
  IF ($EM_ID<>"")
  { 
       $sentencia="SELECT   EM_ID, EM_NOMBRE, EM_NIT
					FROM         EMPRESAS
					where EM_ID='$EM_ID'";
	   $s->ejecutar($sentencia, 234, 'BuscarCalculoIpal.php');
	   $s->Cargar();
	   $EM_NOMBRE=$s->dato(1);
       $EMP=$EM_ID;
   }
   if($EC_ID<>"")
   {
	   $s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
	   $sentencia="SELECT  EC_CONTRATO
					FROM         EMPRESA_CONTRATOS
					where EC_ID='$EC_ID'";
	   $s->ejecutar($sentencia, 245, 'BuscarCalculoIpal.php');
	   $s->Cargar();
	   $EC_CONTRATO=$s->dato(0); 
	   $CONTRATO= $EC_CONTRATO;

	}
	
	//LO QUITO POR AHORA PARA PROBAR CON ACCES
	///AND    (USR_DIGPC = 'IGUAL')
	$sql="SELECT     COUNT(IPAL.GE_NO_INSPECCION) AS Expr5, GE_RESULTADOIPAL

			FROM         IPAL INNER JOIN
								  EMPRESA_CONTRATOS ON IPAL.EC_ID = EMPRESA_CONTRATOS.EC_ID INNER JOIN
								  EMPRESAS ON EMPRESA_CONTRATOS.EM_ID = EMPRESAS.EM_ID
			WHERE (IPAL.GE_BVERIFTERRENO = 'CERRADA')  and  (GE_VFALLIDA IS  NULL) ";

	if($FECHA1<>"")$sql.=" and IPAL.GE_FECHA>= convert(datetime,'".$FECHA1."',120)";
	if($FECHA2<>"")$sql.=" and IPAL.GE_FECHA<= convert(datetime,'".$FECHA2." 23:00' ,120)";	
	if($EM_ID<>"")$sql.=" and EMPRESAS.EM_ID=".$EM_ID;
	if($PR_ID<>"")$sql.=" and IPAL.PR_ID=".$PR_ID;
	if($EC_ID<>"")$sql.=" and IPAL.EC_ID=".$EC_ID;	
  if($GE_TINSPECCION<>"")
      {
        if($GE_TINSPECCION=="COPILOTO")
          {
            $sql.=" and IPAL.GE_TCOPILOTO='".$GE_TINSPECCION."'";    
          } else 
        {
          $sql.=" and IPAL.GE_TINSPECCION='".$GE_TINSPECCION."'";  
        }
      }
	
    
	$sql.=" group by GE_RESULTADOIPAL 
	        order by GE_RESULTADOIPAL";
	
	//ECHO $sql;
  $s->ejecutar($sql,272,'BuscarCalculoIpal.php');		
  $i=0;
  $arrCarita[0][0]=0;
  $arrCarita[1][0]=0;
  
  
  $arrCarita[0][1]='CARITA FELIZ';
  $arrCarita[1][1]='CARITA TRISTE';
  while($s->Cargar())
  {
      if($s->dato(1)=='CFELIZ')
	   $arrCarita[0][0]=$s->dato(0);

      if($s->dato(1)=='CTRISTE')
	   $arrCarita[1][0]=$s->dato(0);

	
	$TotalIpales=$TotalIpales+$s->dato(0);
	$i++;
  }
  
//(IPAL.GE_BVERIFTERRENO = 'CERRADA')
	$sql="SELECT DISTINCT NC_CLASIFICACION.CL_ID, NC_CLASIFICACION.CL_DESCRIPCION
			FROM         NC_CLASIFICACION INNER JOIN
                      NC_SUBCLASIFICACION ON NC_CLASIFICACION.CL_ID = NC_SUBCLASIFICACION.CL_ID INNER JOIN
                      NC_LISTADO ON NC_SUBCLASIFICACION.CL_ID = NC_LISTADO.CL_ID AND NC_SUBCLASIFICACION.SB_ID = NC_LISTADO.SB_ID INNER JOIN
                      IPAL_DETALLE ON NC_LISTADO.NC_ID = IPAL_DETALLE.NC_ID INNER JOIN
                      IPAL ON IPAL_DETALLE.GE_NO_INSPECCION = IPAL.GE_NO_INSPECCION INNER JOIN
                      EMPRESA_CONTRATOS ON IPAL.EC_ID = EMPRESA_CONTRATOS.EC_ID INNER JOIN
                      EMPRESAS ON EMPRESA_CONTRATOS.EM_ID = EMPRESAS.EM_ID
        WHERE  (IPAL.GE_BVERIFTERRENO = 'CERRADA')  and  IPAL_DETALLE.DE_RESULTADO='NO'";

	if($FECHA1<>"")$sql.=" and IPAL.GE_FECHA>= convert(datetime,'".$FECHA1."',120)";
	if($FECHA2<>"")$sql.=" and IPAL.GE_FECHA<= convert(datetime,'".$FECHA2." 23:00' ,120)";	
	if($EM_ID<>"")$sql.=" and EMPRESAS.EM_ID=".$EM_ID;
	if($PR_ID<>"")$sql.=" and IPAL.PR_ID=".$PR_ID;
    if($GE_TINSPECCION<>"")
      {
        if($GE_TINSPECCION=="COPILOTO")
          {
            $sql.=" and IPAL.GE_TCOPILOTO='".$GE_TINSPECCION."'";    
          } else 
        {
          $sql.=" and IPAL.GE_TINSPECCION='".$GE_TINSPECCION."'";  
        }
      }
      
	if($EC_ID<>"")$sql.=" and IPAL.EC_ID=".$EC_ID;					  
	//$sql.="  order by NC_CLASIFICACION.CL_ID";
	//ECHO $sql."<BR>";
	$q->ejecutar($sql,303,'BuscarCalculoIpal.php');
	
	if($formato==2012)$campo=" NC_LISTADO.NC_VALOR";
	if($formato==2011)$campo=" NC_LISTADO.NC_VALOR2011";	
	// (IPAL.GE_BVERIFTERRENO = 'CERRADA')
	while($q->Cargar())
	{ 
	  $sql="SELECT     IPAL.GE_NO_INSPECCION, NC_LISTADO.NC_ID, ".$campo."
FROM         EMPRESA_CONTRATOS INNER JOIN
                      EMPRESAS ON EMPRESA_CONTRATOS.EM_ID = EMPRESAS.EM_ID INNER JOIN
                      IPAL ON EMPRESA_CONTRATOS.EC_ID = IPAL.EC_ID INNER JOIN
                      NC_SUBCLASIFICACION INNER JOIN
                      NC_LISTADO ON NC_SUBCLASIFICACION.CL_ID = NC_LISTADO.CL_ID AND NC_SUBCLASIFICACION.SB_ID = NC_LISTADO.SB_ID INNER JOIN
                      IPAL_DETALLE ON NC_LISTADO.NC_ID = IPAL_DETALLE.NC_ID ON IPAL.GE_NO_INSPECCION = IPAL_DETALLE.GE_NO_INSPECCION
			where    (IPAL.GE_BVERIFTERRENO = 'CERRADA')  and  IPAL_DETALLE.DE_RESULTADO='NO' and NC_LISTADO.NC_VALOR is not null AND NC_SUBCLASIFICACION.CL_ID=".$q->dato(0);

	    if($formato==2011)$sql.=" and NC_LISTADO.NC_VALOR2011 >0";	
        if($formato==2012)$sql.=" and NC_LISTADO.NC_VALOR >0";	
		if($FECHA1<>"")$sql.=" and IPAL.GE_FECHA>= convert(datetime,'".$FECHA1."',120)";
		if($FECHA2<>"")$sql.=" and IPAL.GE_FECHA<= convert(datetime,'".$FECHA2." 23:00' ,120)";	
		if($EM_ID<>"")$sql.=" and EMPRESAS.EM_ID=".$EM_ID;
		if($EC_ID<>"")$sql.=" and IPAL.EC_ID=".$EC_ID;					  
		if($PR_ID<>"")$sql.=" and IPAL.PR_ID=".$PR_ID;
    if($GE_TINSPECCION<>"")
      {
        if($GE_TINSPECCION=="COPILOTO")
          {
            $sql.=" and IPAL.GE_TCOPILOTO='".$GE_TINSPECCION."'";    
          } else 
        {
          $sql.=" and IPAL.GE_TINSPECCION='".$GE_TINSPECCION."'";  
        }
      }
    	
		
		$sql.=" order by SUB_ORDEN";
	    //echo $sql."<br>";
	    $s->ejecutar($sql,330,'BuscarCalculoIpal.php');		
		while($s->Cargar())
		{ 
		  $SQL="SELECT  1
					FROM         IPAL_CALCULO_TOTAL
				WHERE US_ID =$US_ID AND GE_NO_INSPECCION=".$s->dato(0)." AND NC_ID='".$s->dato(1)."'";
		  $m->ejecutar($SQL,336,'BuscarCalculoIpal.php');		
		  //echo $SQL."<br>";
		  $Nofilas=$m->filas();	   
		  if($Nofilas==0)
		  {   
			 
			 $sql2="insert into  IPAL_CALCULO_TOTAL ( US_ID, GE_NO_INSPECCION , NC_ID, VALOR )
			   			       values($US_ID, ".$s->dato(0).",'".$s->dato(1)."',".$s->dato(2).")";
			 $m->ejecutar($sql2,344,'BuscarCalculoIpal.php');			   
			// echo $sql2."<br>";
		  }	// IF THE FILA 
		} //WHILE  DE NC
	} // WHILE THE CLASIFICACION
/* averiguar total de ipales*/


$SQL="SELECT  US_ID, GE_NO_INSPECCION , NC_ID, VALOR
					FROM         IPAL_CALCULO_TOTAL
				WHERE US_ID =".$US_ID ;
		  $m->ejecutar($SQL,355,'BuscarCalculoIpal.php');

?>
<table width="200" border="1">
  <tr>
    <td colspan="4" class="TitulosTablas"><div align="center">LISTADO INCUMPLIMIENTOS&nbsp;</div></td>
  </tr>
  <tr>
    <td class="titulosFondoGris">Identifiacor</td>
    <td class="titulosFondoGris">No de inspeccion </td>
    <td class="titulosFondoGris"><div align="center">Incumplimiento</div></td>
    <td class="titulosFondoGris"><div align="center">Valor consecuencia </div></td>	
  </tr>
<? 
  while($m->Cargar())
 {   ?>
  <tr>
    <td class="titulos"><?=$m->dato(0)?></td>
    <td class="titulos"><?=$m->dato(1)?></td>
    <td class="titulos"><div align="center">
      <?=$m->dato(2)?>
    </div></td>
    <td class="titulos"><div align="center">
      <?=$m->dato(3)?>
    </div></td>
  </tr>
  <?
  }
  ?>
</table>


<? 
   
   /*CALCULAR FACTOR*/
  $SQL="SELECT     NC_LISTADO.SB_ID, COUNT(DISTINCT IPAL_CALCULO_TOTAL.GE_NO_INSPECCION) AS Expr1
			FROM         IPAL_CALCULO_TOTAL INNER JOIN
								  NC_LISTADO ON IPAL_CALCULO_TOTAL.NC_ID = NC_LISTADO.NC_ID
		where US_ID =$US_ID 
			GROUP BY NC_LISTADO.SB_ID";
  
  $s->ejecutar($SQL,395,'BuscarCalculoIpal.php');		
  while($s->Cargar())
  { 
		  $SQL="SELECT  1
					FROM       IPAL_CALCULO_RANGO
				WHERE US_ID =$US_ID  AND SB_ID='".$s->dato(0)."'";
		  $m->ejecutar($SQL,401,'BuscarCalculoIpal.php');		
		 // echo $SQL."<br>";
		  $Nofilas=$m->filas();	   
		 // echo "nofilas".$Nofilas."<br>";
		  if($Nofilas==0)
		  {   
			 //echo "CANTIDAD".$s->dato(1)."<br>";
			 $RESDIVI=($s->dato(1)/$TotalIpales)*100;
			// echo "numerador ".$s->dato(2)." resultado ".$RESDIVI."<BR>";
			 for($r=0;$r<count($ArrRangos);$r++)
			 {   //echo "resmayor que ". $ArrRangos[$r][0]. " res menor que ".$ArrRangos[$r][1]."<br>";
			   if(floor($RESDIVI) >= $ArrRangos[$r][0] and floor($RESDIVI) <= $ArrRangos[$r][1])
			   { 
			     $fac=$ArrRangos[$r][2];
				 //echo "fac".$fac."<br>";
			   }
			   
			   if(floor($RESDIVI) > $ArrRangos[$r][1])
			   {
				   $fac=$ArrRangos[$r][2];
			   }
			   
			 }
			 if( $fac=="") $fac=0;
			// if($RESDIVI>= 10 and $RESDIVI<=20)
			 // $fac=6;
			 $sql2="insert into 
			   IPAL_CALCULO_RANGO (US_ID, SB_ID, CANTIDAD, RESDIVI, FAC_MULTIPLICADOR)
			  	       values($US_ID, '".$s->dato(0)."','".$s->dato(1)."', $RESDIVI, $fac)";
			 $q->ejecutar($sql2,424,'BuscarCalculoIpal.php');			   
			// echo $sql2."<br>";
		  }	// IF THE FILA 
		} //WHILE  DE NC			



$SQL="SELECT  US_ID,SB_ID, CANTIDAD, RESDIVI, FAC_MULTIPLICADOR
					FROM         IPAL_CALCULO_RANGO
				WHERE US_ID =".$US_ID ;
		  $m->ejecutar($SQL,434,'BuscarCalculoIpal.php');

?>
<table width="508" border="1">
  <tr>
    <td colspan="6" class="TitulosTablas"><div align="center">ASPECTOS INCUMPLIDOS </div></td>
  </tr>
  <tr>
    <td width="60" class="titulosFondoGris">Identifiacor</td>
    <td width="90" class="titulosFondoGris"><div align="center">Aspecto</div></td>
    <td width="121" class="titulosFondoGris"><div align="center">Cantidad (A) </div></td>	
    <td width="86" class="titulosFondoGris"><div align="center">% de frecuecia:<br> 
      (A/      
      <?=$TotalIpales?>
    )</div></td>		
    <td width="91" class="titulosFondoGris"><div align="center">Valor de frecuencia </div></td>			
  </tr>
<? 
  while($m->Cargar())
 {   ?>
  <tr>
    <td class="titulos"><?=$m->dato(0)?></td>
    <td class="titulos"><div align="center">
      <?=$m->dato(1)?>
    </div></td>
    <td class="titulos"><div align="center">
      <?=$m->dato(2)?>
    </div></td>
    <td class="titulos"><div align="center">
      <?=$m->dato(3)?>
    </div></td>	
    <td class="titulos"><div align="center">
      <?=$m->dato(4)?>
    </div></td>	
  </tr>
  <?
  }
  ?>
</table>


<?

		
	/*MULTIPLICAR FACTOR POR VALOR*/
		$SQL="SELECT FAC_MULTIPLICADOR , SB_ID
		       FROM IPAL_CALCULO_RANGO
		       WHERE US_ID =$US_ID ";
		 $s->ejecutar($SQL,482,'BuscarCalculoIpal.php');		
		  while($s->Cargar())
		  { 
				
				  $SQL="SELECT    IPAL_CALCULO_TOTAL.NC_ID
						FROM         IPAL_CALCULO_TOTAL INNER JOIN
			                      NC_LISTADO ON IPAL_CALCULO_TOTAL.NC_ID = NC_LISTADO.NC_ID
						WHERE US_ID =$US_ID  AND  NC_LISTADO.SB_ID = '".$s->dato(1)."'";
				  $m->ejecutar($SQL,490,'BuscarCalculoIpal.php');
				  while($m->Cargar())
				  {
				          $FACMULTIPLICADOR=$s->dato(0);
						  $SQL="update IPAL_CALCULO_TOTAL set FACMULTIPLICADOR=$FACMULTIPLICADOR
								WHERE US_ID =$US_ID AND  NC_ID = '".$m->dato(0)."'";
						 // echo $SQL."<br>";		
						  $q->ejecutar($SQL,497,'BuscarCalculoIpal.php');
				  }	 
		  }	


						  $SQL="update IPAL_CALCULO_TOTAL set RES=FACMULTIPLICADOR*VALOR
								WHERE US_ID =$US_ID ";
						  $q->ejecutar($SQL,504,'BuscarCalculoIpal.php');


		
$SQL="SELECT  US_ID, GE_NO_INSPECCION , NC_ID, VALOR, FACMULTIPLICADOR, RES 
					FROM         IPAL_CALCULO_TOTAL
				WHERE US_ID =".$US_ID ;
		  $m->ejecutar($SQL,511,'BuscarCalculoIpal.php');

?>
<table width="200" border="1">
  <tr>
    <td colspan="6" class="titulosFondoGris"><div align="center" class="TitulosTablas">CALCULO DEL RIESGO DETECTADO </div></td>
  </tr>
  <tr>
    <td class="titulosFondoGris">Identifiacor</td>
    <td class="titulosFondoGris">No Inspeccion</td>
    <td class="titulosFondoGris"><div align="center">Incumplimiento</div></td>
    <td class="titulosFondoGris"><div align="center">Consecuencia </div></td>	
    <td class="titulosFondoGris"><div align="center">Factor multiplicador </div></td>			
    <td class="titulosFondoGris"><div align="right">Resultado </div></td>		
  </tr>
<? 
  while($m->Cargar())
 {   ?>
  <tr>
    <td class="titulos"><?=$m->dato(0)?></td>
    <td class="titulos"><?=$m->dato(1)?></td>
    <td class="titulos"><div align="center">
      <?=$m->dato(2)?>
    </div></td>
    <td class="titulos"><div align="center">
      <?=$m->dato(3)?>
    </div></td>
    <td class="titulos"><div align="center">
      <?=$m->dato(4)?>
    </div></td>	
    <td class="titulos"><div align="right">
      <?=$m->dato(5)?>
    </div></td>		
  </tr>
  <?
  }
  
  
		/*sumatoria*/  	  
	$SQL="SELECT     SUM(RES) AS Expr1
			FROM         IPAL_CALCULO_TOTAL	
			WHERE US_ID =$US_ID";
    $m->ejecutar($SQL,553,'BuscarCalculoIpal.php');
    $m->Cargar();
	$SUMATORIA=$m->dato(0);  
  
  ?>
  <tr>
    <td class="TitulosTablas" colspan="5"><div align="right">SUMATORIA RIESGO DETECTADO </div></td>
    <td class="TitulosTablas"><div align="right"><?=$SUMATORIA?> </div></td>		
  </tr>  
</table>


<?
		
		
		  

	
	if ($TotalIpales > 0)
  {
    $CalculoIpal=number_format($SUMATORIA/$TotalIpales,'2','.',',');
  } else
  {
    $CalculoIpal=number_format(0,'2','.',',');
  }

	//echo "calculo ".$CalculoIpal;


if($PR_ID<>"")
{
   $sql="SELECT     PR_NOMCORTO
			FROM         PROCESOS
			where PR_ID=".$PR_ID;
   $q->ejecutar($sql,580,'BuscarCalculoIpal.php');	   
   $q->Cargar();
   $PR_NOMCORTO=$q->dato(0);
}

if($EM_ID<>"")
{
  $sql="SELECT   EM_NOMBRE
		FROM         EMPRESAS
     	WHERE EM_ID=$EM_ID";
  $q->ejecutar($sql,590,'BuscarCalculoIpal.php');	   
  $q->Cargar();
  $EM_NOMBRE==$q->dato(0);
}

if($EC_ID<>"")
{
  $sql="SELECT   EC_CONTRATO
		FROM         EMPRESA_CONTRATOS
     	WHERE EC_ID=$EC_ID";
  $q->ejecutar($sql,600,'BuscarCalculoIpal.php');	   
  $q->Cargar();
  $EC_CONTRATO==$q->dato(0);
}	



	
$sql="SELECT   DEFINICION	, COLOR
      FROM IPAL_TOLERABILIDAD
	 WHERE   ".floor($CalculoIpal)." BETWEEN R1 AND R2";
//	ECHO $sql; 
  $q->ejecutar($sql,612,'BuscarCalculoIpal.php');	   
  $q->Cargar();
  $DEFINICION=$q->dato(0);
  $COLOR=$q->dato(1);
	
	?>
	
	
	<table width="613" border="1" align="center">
      <tr>
        <td colspan="4" class="TitulosTablas"><div align="center">
          <p>RESULTADO IPAL GENERAL CODENSA:  </p>
          <p>(SUMATORIA DEL RIESGO DETECTADO)/(TOTAL DE INSPECCIONES)</p>
        </div></td>
      </tr>
      <tr>
        <td colspan="4" class="titulosRojoGrande" align="center"><?=$CalculoIpal?></td>
      </tr>
      <tr>
        <td colspan="4" align="center" bgcolor="<?=$COLOR?>">ESTE RESULTADO ES <?=$DEFINICION?></td>
      </tr>	  
      <tr>
        <td colspan="4" class="Fondogris"><div align="center">PARAMETROS DE BUSQUEDA </div></td>
      </tr>
      <tr>
        <td width="138" class="titulosFondoGris">Fecha de inicio </td>
        <td width="116" class="titulos"><div align="center">
          <?=$FECHA1?>
        </div></td>
        <td width="64" class="titulosFondoGris"><div align="left">Fecha de finalizacion </div></td>
        <td width="139" class="titulos"><div align="center">
          <?=$FECHA2?>
        </div></td>
      </tr>
      <tr>
        <td class="titulosFondoGris">Proceso</td>
        <td class="titulos"><?=$PR_NOMCORTO?>&nbsp;</td>
        <td class="titulosFondoGris">Formato</td>
        <td class="titulos"><?=$formato?></td>
      </tr>
      <tr>
        <td class="titulosFondoGris">Empresa</td>
        <td class="titulos"><?=$EM_NOMBRE?>&nbsp;</td>
        <td class="titulosFondoGris">Contrato: </td>
        <td class="titulos"><?=$EC_CONTRATO?>&nbsp;</td>
      </tr>	
      <tr>
        <td class="calendar"><?=$arrCarita[0][1]?></td>
        <td  class="titulos"><?=$arrCarita[0][0]?></td>
        <td class="calendar"><?=$arrCarita[1][1]?></td>
        <td  class="titulos"><?=$arrCarita[1][0]?></td>
      </tr>

      <tr>
        <td class="calendar">Total de inspecciones </td>
        <td  class="titulos"><?=$TotalIpales?> </td>
        <td class="calendar">Sumatoria riesgo detectado  </td>
        <td  class="titulos"><?=$SUMATORIA?> </td>	
      </tr>		    
      <tr>
        <td colspan="4" align="center"><!--<input type="submit" name="Submit2" value="Guardar" onClick="calculo.NIVEL.value=2">--></td>
      </tr>	  
</table>

<?
	if($NIVEL==2)
	{
	   //echo "grabar";
	   
	   $sql="SELECT     FECHA1, FECHA2, EM_ID, EC_CONTRATO, TIPO, FORMATO, TCFELIZ, TCTRISTE, SUMATORIA, IPAL
			   FROM         IPAL_RESULTADO
			   WHERE  FECHA1= CONVERT( DATETIME, '$FECHA1' ,120) AND   FECHA2 = CONVERT( DATETIME, '$FECHA2' ,120)
						  AND EM_ID=$EMP and  EC_CONTRATO=$CONTRATO ";
		$s->ejecutar($sql,685,'buscarcalculoipal.php');	   
		$Nofilas=$s->filas();	   
	
	  if($Nofilas==0)
	  {
		$sql4="insert into IPAL_RESULTADO (FECHA1, FECHA2, EM_ID, EC_CONTRATO, TIPO, FORMATO, TCFELIZ, TCTRISTE, SUMATORIA, IPAL)
								 VALUES(CONVERT( DATETIME, '$FECHA1' ,120), CONVERT( DATETIME, '$FECHA2' ,120), 
									  $EMP, $CONTRATO, '$TIPO', '$formato', ".$arrCarita[0][0].", ".$arrCarita[1][0].", $SUMATORIA, $CalculoIpal) ";
								 
		  $s->ejecutar($sql4,694,'GuardarListado.php');	 
	  }
	  if($Nofilas==1)
	  {
		 $sql4="update IPAL_RESULTADO set TIPO= '$TIPO', FORMATO='$FORMATO', TCFELIZ= ".$arrCarita[0][0].",TCTRISTE =".$arrCarita[1][0].", SUMATORIA=$SUMATORIA, IPAL=$CalculoIpal 
			  WHERE  FECHA1= CONVERT( DATETIME, '$FECHA1' ,120) AND   FECHA2 = CONVERT( DATETIME, '$FECHA2' ,120)
						  AND EM_ID=$EMP and EC_CONTRATO=$CONTRATO ";
		  $s->ejecutar($sql4,701,'GuardarListado.php');		   
	  }
	   $sql4="update IPAL_RESULTADO set AAA=YEAR(CONVERT( DATETIME, '$FECHA1' ,120)), MES=MONTH(CONVERT( DATETIME, '$FECHA1' ,120))
					  WHERE  FECHA1= CONVERT( DATETIME, '$FECHA1' ,120) AND   FECHA2 = CONVERT( DATETIME, '$FECHA2' ,120)
						  AND EM_ID=$EMP and  EC_CONTRATO=$CONTRATO ";
				  $s->ejecutar($sql4,706,'CalculoIpal.php');	
	//echo $sql4."<br>";  
	
	} //nivel de guardar

?>

</form> 	
<?
}





?>
</body>
</html>
