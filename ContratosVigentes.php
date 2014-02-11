<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" type="image/ico" href="Img/favicon.ico"> 
	
	<? include "include/VarGlobales.PHP"; ?>

	<title><?=$NOMPROYECTO?></title>
	
	<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
	<script src="js/ajaxCargar.js"></script>
	
	<link rel="stylesheet" type="text/css" media="all" href="Tools/css/estilos.css">

	<link rel="stylesheet" type="text/css" media="all" href="css/calendar-blue.css">
  	<script type="text/javascript" src="js/calendar.js"></script>
  	<script type="text/javascript" src="lang/calendar-es.js"></script>
  	<script type="text/javascript" src="js/calendar-setup.js"></script>

  	<script src="Tools/HTML5/HTML5_enabling_script.js"></script>
	<script src="Tools/HTML5/jquery.js"></script>
	<script src="Tools/HTML5/prefixfree.min.js"></script>

	<style type="text/css" title="currentStyle">
			@import "Tools/datatable/media/css/demo_page.css";
			@import "Tools/datatable/media/css/demo_table.css";
			@import "Tools/datatable/media/css/TableTools.css";
			@import "Tools/datatable/media/css/TableTools_JUI.css";
			@import "Tools/datatable/media/css/ColumnFilterWidgets.css";
			@import "Tools/datatable/media/css/ColVis.css";
		</style>

	<script src="Tools/datatable/media/js/jquery.dataTables.js"></script>
	<script src="Tools/datatable/media/js/TableTools.js"></script>
	<script src="Tools/datatable/media/js/ColumnFilterWidgets.js"></script>
	<script src="Tools/datatable/media/js/ZeroClipboard.js"></script>
	<script src="Tools/datatable/media/js/ColVis.js"></script>

	<script src="Tools/js/reporteIncumplimientos.js"></script>

</head>
<body>



<? 
include "LlamadoMenu.php"; 

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);

if($nivel=="")
{

      $q->ejecutar("select EM_ID
					FROM         IPAL_USUARIOS_PC
					where US_USUARIO='$usr'", 107, "Principal.php");
 $q->Cargar();
 $EM_ID=$q->dato(0);
}
?>
	<form id="incumplimientos_Datos">
		<center>
			<table>
				<tr>
					<td>
						<label for='f1'>Fecha Inicial:</label>
						<input name="f1" type="TEXT"  id="f1"  maxlength="10"  class='inputForm' value="" required />
						<input name="calendar" type="button" id="calendar"  value="..." />
				        <script type="text/javascript">
				          Calendar.setup({
				           inputField     :    "f1",      // id of the input field
				           ifFormat       :    "%Y-%m-%d",       // format of the input field -- "%m/%d/%Y %I:%M %p"
				           button         :    "calendar",   // trigger for the calendar (button ID)
				           step           :    1               // show all years in drop-down boxes (instead of every other year as default)
				          });
				        </script>
					</td>
					<td>
						<label for='f2'>Fecha Final:</label>
				        <input name="f2" type="TEXT"  id="f2"  maxlength="10" class='inputForm'  value="" />
				        <input name="calendar1" type="button" id="calendar1"  value="..." />
				        <script type="text/javascript">
				          Calendar.setup({
				           inputField     :    "f2",      // id of the input field
				           ifFormat       :    "%Y-%m-%d",       // format of the input field -- "%m/%d/%Y %I:%M %p"
				           button         :    "calendar1",   // trigger for the calendar (button ID)
				           step           :    1               // show all years in drop-down boxes (instead of every other year as default)
				          });
				        </script>
					</td>
				</tr>
			</table>
			<table width='90%'>
				<tr>
					<td>
						<label class='labelForm' for='cboEmpresas'>Empresa:</label>
	        			<select class='inputForm' id='cboEmpresas'>
	        				<option value='0'>Todas</option>
	        				<?
							   $sql="SELECT DISTINCT Em_Id,  EM_NOMBRE
										FROM         EMPRESAS 
										order by  EM_NOMBRE";
							   $q->ejecutar($sql,104,'RepIncumplimientos.php');	   
							   while($q->Cargar())
							    { 
								   ?><option value="<?=$q->dato(0)?>" ><?=utf8_encode($q->dato(1))?></option><?
								}  
							?>
	        			</select>
					</td>
					<td>
						<label class='labelForm' for='cboContrato'>Contrato:</label>
	        			<select class='inputForm' id='cboContrato'></select>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<article id="Contrato_Descripcion">
						</article>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<center>
							<button id='btnBuscar'>
								Buscar
							</button>
						</center>
					</td>
				</tr>
			</table>
			<table id="tablaContratos">
				<thead>
					<th>Numero</th>
					<th>Descripción</th>
					<th>Empresa</th>
					<th>Contrato</th>
					<th>Incumplimiento</th>
					<!--<th>Ipal</th>-->
					<th>Cantidad</th>
				</thead>
				<tbody>	</tbody>
			</table>
			
			
	        
	        
	    </center>
		
			
	</form>

</body>
</html>
