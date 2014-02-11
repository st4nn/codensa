<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
<?


include "include/VarGlobales.PHP"; 
require("include/BdSqlClases.php");

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);

?>

<form action="GuardarCuadrilla.php" method="get" name="inicio">
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
 <input type="hidden"   name="Monstrar"      size="10"  maxlength="10" value="CuadrillaBB.php"> 
 <input type="hidden"   name="EnviarA"      size="10"  maxlength="10" value="MarcoFormatoBB.php"> 
 <input type="hidden" name="GE_NO_INSPECCION" id="GE_NO_INSPECCION" size="5"  value="<?=$GE_NO_INSPECCION?>"/>  
<table width="35%" border="0" align="center">
  <tr>
    <td><div id="DetalleEmpleados"><? if($GE_NO_INSPECCION<>"")
										include "EmpleadosCuadrillaBB.php" ?></div> </td>
  </tr>  
  
  
  <tr>
    <td><span class="titulos">
      <div align="center">
        <input type="submit" name="Submit" value="Guardar" class="Cajones">
    </div></td>
  </tr> 
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</form>
