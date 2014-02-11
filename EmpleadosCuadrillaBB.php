<?



    $SQL="SELECT    EE_CEDULA, EE_NOMBRES, EE_APELLIDO1, EE_APELLIDO2, EE_CARGO, EE_LIDER
			FROM         INFO_EMPRESA_EMPLEADOS
			WHERE GE_NO_INSPECCION=$GE_NO_INSPECCION	
			ORDER BY EE_ORDEN  ";
    $q->ejecutar($SQL,86,'BuscarGuia.php');	   
?>

<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
<table width="28%" border="1" align="center" cellspacing="0">
  <tr>
   <td width="3%" height="10" class="titulosFondoGrisGrande"><div align="left">&nbsp;</div></td>
    <td width="7%" height="20" class="titulosFondoGrisGrande"><div align="left">Cedula</div></td>
    <td width="9%" class="titulosFondoGrisGrande"><div align="left">Nombre</div></td>
    <td width="11%" class="titulosFondoGrisGrande">Apellidos</td>
    <td class="titulosFondoGrisGrande"><div align="center">Cargo</div></td>
    <td width="50%" class="titulosFondoGrisGrande"><div align="center">Incumplimiento</div></td>
  </tr>
  <?
  $CanC=1;
   $resto="";
   while($q->Cargar())
   { 
      $NomA="A".$CanC;
	  $NomB="B".$CanC;
	  $NomC="C".$CanC;
	  $NomD="D".$CanC;
	  $NomE="E".$CanC;
	  $NomF="F".$CanC;
	  
	    	  	  
	  
	  $Nombre= utf8_encode($q->dato(1));
	 
	  IF($q->dato(5)=='SI') $resto='NO';
    ?>
  <tr>
  <td class="Cajones"><?=$CanC?>&nbsp;</td>
    <td class="Cajones"><div align="left"><input name="<?=$NomA?>" type="hidden"  class="Cajones" value="<?=$q->dato(0)?>" size="7" /><?=$q->dato(0)?>
    </div></td>
    <td class="TituloP"><div align="left"><input name="<?=$NomB?>" type="text"  class="Cajones" value="<?=$Nombre    ?>" size="7"/>
    </div></td>
    <td class="TituloP"><div align="left">Apel 1<input name="<?=$NomC?>" type="text"  class="Cajones" value="<?=utf8_encode($q->dato(2))?>" size="7"/>
    </div>      <div align="left"> Apel2 <input name="<?=$NomD?>" type="text"  class="Cajones" value="<?=utf8_encode($q->dato(3))?>" size="7"/>
      </div></td>
    <td class="TituloP" align="left">
    
    <select name="<?=$NomE?>"  class="Cajones">
       <option value="">Selecc.</option>
      <?
       $sentencia="SELECT CARGO
					FROM         IPAL_CARGOS
					ORDER BY CARGO";

	    $s->ejecutar($sentencia, 339, 'BuscarCalculoIpalTodasGer.php');
		while($s->Cargar())
	   { 
		  ?>
		   <option value="<?=$s->dato(0)?>" <? if($s->dato(0)==$q->dato(4)) echo "selected" ?> ><?=$s->dato(0)?></option><?
		} 
	  ?>
     
    </select>
    Responsable Ipal:  
      <select name="<?=$NomF?>" class="Cajones">	  
        <option value="SI" <? IF($q->dato(5)=='SI') echo  "selected" ?>>SI</option>
        <option value="NO" <? IF($q->dato(5)=='NO') echo  "selected" ?>>NO</option>
      </select></td>	
    <td class="TituloP"><div align="center">
	<?
	for($j=1;$j<=15;$j++)
	{
	  $NomG="G".$CanC."A".$j;	
      $sql1="SELECT     IPAL_CUADRILLA.NC_ID, NC_LISTADO.NC_DESCRIPCION
             FROM         IPAL_CUADRILLA INNER JOIN
                      NC_LISTADO ON IPAL_CUADRILLA.NC_ID = NC_LISTADO.NC_ID
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and EE_CEDULA=".$q->dato(0);
			// echo $sql1."<BR>";
	   $s->ejecutar($sql1,426,'SubirPlano.php');	  
	   $m=1;
	   unset($arrNC);
	   while($s->Cargar())
	   {
	    $arrNC[$m][0]=$s->dato(0);
		$arrNC[$m][1]=$s->dato(1);
		$m++;
	   }
	  
	 ?>
	 <input name="<?=$NomG?>" type="text" size="1"  class="Cajones" value="<?=$arrNC[$j][0]?>" title="<?=$arrNC[$j][1]?>" onkeypress="javascript:return solonumerosYpunto(event)"/>
	<?
	}?>
</div></td>
  </tr>
  <?
    $CanC++;
}
      $NomA="A".$CanC;
	  $NomF="F".$CanC;
  
  ?>
  <tr>
    <td class="Cajones"><?=$CanC?>&nbsp;</td>
    <td class="TituloP"><div align="left"><input name="<?=$NomA?>" type="text"  class="Cajones" value="" size="7" onchange="BusInfoEmp(this.value, '<?=$CanC?>', 'BuscarInfoEmpleadosBB.php', '<?=$resto?>')" onkeypress="javascript:return solonumeros(event)"/>
    </div></td>

	<td colspan="3" align="left" class="TituloP"><div id="Uno"></div></td>
    
    <td class="TituloP"><div align="center"><?
	for($j=1;$j<=15;$j++)
	{
	  $NomG="G".$CanC."A".$j;	
 
	 ?>
	 <input name="<?=$NomG?>" type="text" size="2"  class="Cajones" value="" onkeypress="javascript:return solonumerosYpunto(event)"/>
	<?
	}?>
    </div></td>
  </tr>  
</table>
<input name="CanC" type="hidden" size="30"  value="<?=$CanC?>"/>
