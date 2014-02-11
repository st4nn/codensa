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
</head>
<body>



<? 
include "LlamadoMenu.php"; 

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$m=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);

if($nivel=="")
{
?>

<form action="" method="get">
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
<table width="41%" border="0" align="center">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td width="25%">&nbsp;</td>
        <td width="66%" class="TitulosTablas"><div align="center">BUSCAR INSPECCIONES </div></td>
        <td width="9%" class="Fondogris">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td><table width="100%" border="2" align="center">
      <tr>
        <td colspan="4" align="center" class="Fondogris">RANGO DE FECHAS</td>
        </tr>
      <tr>
        <td class="Fondogris">inicio</td>
        <td><input name="f1" type="TEXT"  id="f1"  size="10" maxlength="10"  value="">
        <input name="calendar" type="button" id="calendar"  value="..." >
        <script type="text/javascript">
          Calendar.setup({
           inputField     :    "f1",      // id of the input field
           ifFormat       :    "%Y-%m-%d",       // format of the input field -- "%m/%d/%Y %I:%M %p"
           button         :    "calendar",   // trigger for the calendar (button ID)
           step           :    1               // show all years in drop-down boxes (instead of every other year as default)
          });
        </script></td>
        <td class="Fondogris">Fin</td>
        <td><input name="f2" type="TEXT"  id="f2"  size="10" maxlength="10"  value="">
        <input name="calendar1" type="button" id="calendar1"  value="..." >
        <script type="text/javascript">
          Calendar.setup({
           inputField     :    "f2",      // id of the input field
           ifFormat       :    "%Y-%m-%d",       // format of the input field -- "%m/%d/%Y %I:%M %p"
           button         :    "calendar1",   // trigger for the calendar (button ID)
           step           :    1               // show all years in drop-down boxes (instead of every other year as default)
          });
        </script></td>
      </tr>
      <tr>
        <td colspan="4" align="center" class="Fondogris">GENERAL</td>
        </tr>
      <tr>
        <td class="Fondogris">Empresa responsable de inspeccin </td>
        <td colspan="3"><select name="QUIENINSPECCIONA" id="QUIENINSPECCIONA"  class="titulos"  >
				    <option value="">Seleccione</option>
				  <?
				   $sql="SELECT DISTINCT EMPRESAS.EM_NOMBRE,  EMPRESAS.EM_ID
							FROM         EMPRESAS INNER JOIN
                      IPAL_USUARIOS_BB ON EMPRESAS.EM_ID = IPAL_USUARIOS_BB.EM_ID
							order by  EMPRESAS.EM_NOMBRE";
				   $q->ejecutar($sql,101,'BuscarGuiaTotal.php');	   
				   while($q->Cargar())
				   { 
					   ?><option value="<?=$q->dato(1)?>" ><?=$q->dato(0)?></option><?
					}  
				  ?>
				  </select></td>
        </tr>
      <tr>
        <td width="20%" class="Fondogris">No de inspeccion</td>
        <td width="35%"><span class="TituloG">
          <input name="NoInspeccion" type="text" class="titulos">
        </span></td>
        <td width="20%" class="Fondogris"><div align="right">Fecha</div></td>
        <td width="25%"><input name="FECHA" type="TEXT"  id="FECHA"  size="10" maxlength="10"  value="">
        <input name="calendar2" type="button" id="calendar2"  value="..." >
        <script type="text/javascript">
          Calendar.setup({
           inputField     :    "FECHA",      // id of the input field
           ifFormat       :    "%Y-%m-%d",       // format of the input field -- "%m/%d/%Y %I:%M %p"
           button         :    "calendar2",   // trigger for the calendar (button ID)
           step           :    1               // show all years in drop-down boxes (instead of every other year as default)
          });
        </script></td>
      </tr>
      <tr>
         <td colspan="4" align="center" class="Fondogris">PARA ESTA CONSULTA DEBE ESPECIFICAR EL CONTRATO</td>
      </tr>
      <tr>
        <td colspan="4"><table width="100%" border="1">
          <tr>
 <td width="15%" class="Fondogris"><div align="left">Empresa: </div></td>
		<TD width="38%"><select name="EM_ID" id="EM_ID"  class="titulos"  onchange="CargarContratos(EM_ID.value, this.id)">
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
		    </select>           </td>
			<td width="21%" class="Fondogris"><div align="left">No contrato </div></td>
            <td width="26%"><div align="left">
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
        <td  class="Fondogris"><div align="left">Tipo de inspeccion:</div>
        <TD> <select name="GE_TINSPECCION"  id="GE_TINSPECCION"  class="titulos">
          <option value="">Seleccione</option>
          <option value="CONTROL REDES"  >CONTROL REDES</option>
          <option value="PRL"  >PRL</option>
          <option value="Copiloto"  >COPILOTO</option>
        </select></td>
        <TD>Numero de registros en pantalla </TD>
        <td><input name="top" type="text" value="10" size="4">
        </tr>
      </table></td>
  </tr>
  
  <tr>
    <td><div id="DetalleEmpleados">
      <div align="center">
        <input type="submit" name="Submit" value="Consultar" onClick="form.nivel.value=1">
        <input type="submit" name="Submit2" value="Generar Archivo" onClick="form.nivel.value=2">
		<input type="hidden" name="nivel" value="">
      </div>
    </div> </td>
  </tr>
  
  
</table>
</form>
 <?
}
if($nivel=="1")
{

      
       ?>
		      <table width="77%" border="1" align="center">
		        <tr>
		          <td width="16%">
                  </td>
		          <td width="80%" align="center" class="TitulosTablas">INSPECCIONES </td>
		          <td width="4%">&nbsp;</td>
	            </tr>
	          </table>

<?


 include "CuerpoReporte.php";

}
if($nivel=="2")
{

      
       ?>
		      <table width="27%" border="1" align="center">
		        <tr>
		          <td width="55%" align="center" class="TitulosTablas">INSPECCIONES : </td>
		           <? $DATOSImprimir="BuscarMatrizExcelFiltro.php?QUIENINSPECCIONA=".$QUIENINSPECCIONA."&NoInspeccion=".$NoInspeccion."&FECHA=".$FECHA."&f1=".$f1."&f2=".$f2."&GE_TINSPECCION=".$GE_TINSPECCION."&EC_ID=".$EC_ID;
	   
	  // echo $DATOSImprimir;
	  ?>
    <td width="45%"  class="Fondogris"><div align="left"><a href="<?=$DATOSImprimir?>">Exportar a Excel</a></td>
	            </tr>
	          </table>

<?




}
?>
</body>
</html>
