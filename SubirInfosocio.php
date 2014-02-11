<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/csstyles.css" rel="stylesheet" type="text/css">
<? include "include/VarGlobales.PHP"; ?>
<title><?=$NOMPROYECTO?></title>
</head>
<script language="JavaScript">

  function valide2()
  {
    if(form1.userfile.value=="")
    {
     alert("Debe seleccionar un archivo");
      return false;
    }
	if(form1.GE_PROCESOSOCIO.value =="")
    {
     alert("Debe seleccionar el proceso");
      return false;
    }

     return valide();
   
}
</script>
<? 

include "LlamadoMenu.php"; 

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);

?>
<body>
<table width="272" border="1" align="center">
     <tr>
       <td width="302" class="TitulosTablas" ><div align="center">INGRESO INFORMACION DE SISTEMA SOCIA A SIISI</div></td>
     </tr>

</table>
<?
if($nivel=="")
{ 
 ?>

<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data"  onsubmit='return valide2() '>
 <input type="hidden"   name="Nruta"    size="150" value="Planos/Socio" >
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
 <input type=hidden name="nivel"    value="1"> 
  
<BR> 
<table border="0" align="center">
<tr>
      <td><span class="TituloG">Archivo:</span> 
      <input name="userfile" type="file" class="fontCampos" size="70"></td>
    </tr>
<!--
	<tr>
	  <td><a href="Planos/INFO AUDITORIAS OS.xls">Plantilla para Subir la informacion (Recuerde convertir este archivo en txt cuando tenga lista la informacion)</a></td>
    </tr>
-->
	<tr>
	  <td><table width="100%"  border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="27%">Procesos Socio </td>
          <td width="73%"><select name="GE_PROCESOSOCIO">
            <option value="">Seleccione</option>
            <option value="CARTERA">CARTERA</option>
            <option value="FACTURACION">FACTURACION</option>
            <option value="PERDIDAS">PERDIDAS</option>
            <option value="NUEVOS SUMINISTROS">NUEVOS SUMINISTROS</option>
            <option value="OPERACIONES INTEGRADAS">OPERACIONES INTEGRADAS</option>
          </select></td>
        </tr>
      </table></td>
    </tr>
	<tr>
      <td><div align="center">
        <input name="submit2" type=submit class="fontCampos" value="Subir archivo">
      </div></td>
    </tr>
</table>
</form>
<p>
<?			
}
if($nivel=="1")
{
?>
<form id="form1" name="form1" method="post" action=""  onsubmit='return valide2() '>
 <input type="hidden"   name="Nruta"    size="150" value="Planos/Socio" >
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
 <input type="hidden"   name="GE_PROCESOSOCIO"      size="10"  maxlength="10" value="<?=$GE_PROCESOSOCIO?>">

 <input type=hidden name="nivel"    value="2"> 

<?
 if($rutadestino=="")
 {


   $asubir=date(Y);
   $msubir=date(m);
   $ruta= $Nruta."/".$asubir."/".$msubir;

  
   $archi =$userfile_name;
   //echo $userfile_name;
   $rutadestino=$ruta."/".$archi;

  if(!is_dir($Nruta."/".$asubir))
      mkdir ($Nruta."/".$asubir,0644);

  if(!is_dir($Nruta."/".$asubir."/".$msubir))
      mkdir ($Nruta."/".$asubir."/".$msubir,0644);

  if( $paso =copy($userfile, $rutadestino))
   $men="";
  else
   $men="Error subiendo el archivo";
//echo "userfile  ".$userfile."<br>";
//echo "userfile_name  ".$userfile_name."<br>";
//echo "tmp:   ".$_FILES['file']['tmp_name']."   nombre    ".$_FILES['userfile']['name']."          ruta dstino".$rutadestino;
}
else 
{

  //echo $rutadestino;
  $nombre = explode("/", $rutadestino);
  $archi=$nombre[4];
}
  $filename = $rutadestino;
  $lineas = file($filename);
  $TotalLineas=count($lineas);

  
  
?>
<table width="30%"  border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td colspan="2"><div align="center" class="TitulosTablas">Leer el documento en intervalos de lineas</div></td>
    </tr>
  <tr>
    <td>Inicio de Fila 
      <input name="inifila" type="text" size="10" value="1" /></td>
    <td>Fin de fila 
      <input name="finfila" type="text" size="10" value="<?=$TotalLineas?>"/></td>
  </tr>
  <tr>
    <td colspan="2">
<?


if (file_exists($rutadestino) )
{
  ?> <div align="center">
    <input type="hidden"   name="rutadestino"      size="10"  maxlength="10" value="<?=$rutadestino?>">
    <? echo "Nombre de archivo a subir: ".$archi;
  ?>    <input name="submit2" type=submit class="fontCampos" value="Subir informacion">
    <?
}else
   echo "No existe el archivo en la ruta preestabledida. <br>".$men;
?>
  
</div></td>
    </tr>
</table>
</form><?
}

if ($nivel==2)
{?>
<form id="form1" name="form1" method="post" action=""  onsubmit='return valide2() '>
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
 <input type="hidden"   name="GE_PROCESOSOCIO"      size="10"  maxlength="10" value="<?=$GE_PROCESOSOCIO?>">

 <input type=hidden name="nivel"    value="1"> 
</p>   
<table border="1" align="center">
 <?
  $filename = $rutadestino;
  $lineas = file($filename);

  if($inifila=="")$inifila=1;
  if($finfila=="")$finfila=count($lineas);

  //echo $YPresente;
  FOR ($t=$inifila; $t<=$finfila-1; $t++)
  {
	 unset($ArrMensaje);
	 unset($ArrColumnas);
    //echo $lineas[$t]."<br>";
	$ArrColumnas = explode("\t",$lineas[$t]);
	///echo count($ArrColumnas)."<br>".$t;
	 $GE_SOCIO=$ArrColumnas[0];
	 $GE_FECHA=$ArrColumnas[1];
     $Arrfecha= explode("/", $ArrColumnas[1]);

        if(!is_numeric($Arrfecha[1]) or $Arrfecha[1]<1 or $Arrfecha[1]>12)
		  $ArrMensaje[1]= "Error en el rango de fecha fuera del mes doce o anterior al mes 1"; 
        if(!is_numeric($Arrfecha[0]) or $Arrfecha[0]<1 or $Arrfecha[0]>31)
		  $ArrMensaje[1]= "Error en el dia de la fecha"; 
       // if(!is_numeric($Arrfecha[2]) or $Arrfecha[2]<2013 or $Arrfecha[0]>2013)
		///s  $ArrMensaje[1]= "Error en el año de la inspeccion realizada"; 
     $GE_FECHA=$Arrfecha[2]."/".$Arrfecha[1]."/".$Arrfecha[0];
	 $GE_DIRECCION=$ArrColumnas[2];
	 $GE_MOVIL=$ArrColumnas[3];
	 $GE_PLACA=$ArrColumnas[4];
	 $GE_TIPOVEHICULO=$ArrColumnas[5];
		/* direccionar los tres campos que tengo*/
	 $GE_TRAB_AREALIZAR=$ArrColumnas[6];
	 $GE_NO=$ArrColumnas[7];
	 $GE_AREACODENSA=$ArrColumnas[8];
	 $GE_HINICIO=$ArrColumnas[9];
	 $GE_HFINALIZACION=$ArrColumnas[10];
	 $GE_OBS1=$ArrColumnas[11];
	 $GE_OBSAMBIENTAL=$ArrColumnas[37];  /*?ellos colocan tanto observacin del inspector omo del inspecinado*/
	 $GE_RESULTADOIPAL=$ArrColumnas[13];
      /*ubicar el proceso con el id*/
	 $PR_ID=$ArrColumnas[14];

		$sql="SELECT  PR_ID
			 FROM PROCESOS
			WHERE PR_ID=$PR_ID";   	 
//echo $sql;
		$q->ejecutar($sql,135,'SubirInfosocio.php.php');
		$q->Cargar();
        $Nofilas=$q->filas();
		if($Nofilas<>1)
		   $ArrMensaje[14]="<br /> El proceso esta  ".$Nofilas." veces en la base de datos";

//echo "numpro".$PR_ID."<br>";
	 $GE_TIPONO=$ArrColumnas[15];
	 $GE_MUNICIPIO=$ArrColumnas[16];

		$sql="SELECT     MUNICIPIO
				FROM         IPAL_MUNICIPIOS
			WHERE MUNICIPIO='".trim($GE_MUNICIPIO)."'";   	 
		$q->ejecutar($sql,148,'SubirInfosocio.php');
		$Nofilas=$q->filas();
		if($Nofilas<>1)
		   $ArrMensaje[16]="<br /> EL municipio no se ubico en el listado oficial de la base de datos";

	 $GE_TINSPECCION=$ArrColumnas[17];

	 /*RES´PNSABLE INSPECCION*/
	 $RES_CEDULA=$ArrColumnas[21];
	 $RES_NOMBRE=$ArrColumnas[22];
	 $RES_CARGO=$ArrColumnas[18];
	 //$EM_ID=2;


     /*EMPRESA A LA CUAL SE LE REALIZA LA INSPECCION. TRAE EL CONTRATO HAY QUE AVERUIGUAR EL EC_ID*/
	 $CONTRATO=$ArrColumnas[23];
		
		$sql="SELECT   EC_ID 
				FROM         EMPRESA_CONTRATOS
			WHERE UPPER(EC_CONTRATO)=UPPER('".$CONTRATO."')";   	 
		$q->ejecutar($sql,168,'SubirInfosocio.php');
		$q->Cargar();
		$EC_ID =$q->dato(0);
        $Nofilas=$q->filas();
		if($Nofilas<>1)
		   $ArrMensaje[23]="<br /> El contrato esta ".$Nofilas." veces en la base de datos";


	 /*TABLA INCUMPLIMIENTOS*/
		$NC_ID=$ArrColumnas[25];
		$sql="SELECT    1
				FROM         NC_LISTADO
			WHERE NC_ID='".trim($NC_ID)."'";   	 
		$q->ejecutar($sql,181,'SubirInfosocio.php');
		$q->Cargar();
        $Nofilas=$q->filas();
		if($Nofilas<>1)
		   $ArrMensaje[25]="<br /> El item de incumplimiento no esta registrado en la base de datos";

		$DE_RESULTADO=$ArrColumnas[26];
		$DE_CATEGORTIA=$ArrColumnas[28];
		$DE_DESCRIPCION=$ArrColumnas[27]; /*desciocion del incumplimeinto*/

		/*CUADRILLEROS*/
		$EE_CEDULA=$ArrColumnas[29];
		$EE_NOMBRES=$ArrColumnas[30];
		$EE_APELLIDO1=$ArrColumnas[31];
		$EE_APELLIDO2=$ArrColumnas[32];
		$EE_CARGO=$ArrColumnas[33];
		$EE_LIDER=$ArrColumnas[34];

		/*CUADRILLEROS CON INCUMPLIMIENTOS */
     $EE_CEDULAincuadrillero="";
     $NC_IDalcuadrillero="";
     if($ArrColumnas[35]<>"")
     {
		if($EE_NOMBRES=="")$EE_NOMBRES="SIN NOMBRE EN ARCHIVO PLANO";
		$EE_CEDULAincuadrillero=$ArrColumnas[35];
       // echo "cuadrilelro incumplimiento".$EE_CEDULAincuadrillero;
		$NC_IDalcuadrillero=$ArrColumnas[36];
		//$CU_OBSERVACION=$ArrColumnas[28];
     }
	
		$bandera="";
	for($m=0;$m<count($ArrColumnas);$m++)
	{
    if($ArrMensaje[$m]<>'')$bandera="NO SE PUEDE SUBIR LA INFORMACION AJUSTE LOS DATOS";
  }	

    if($bandera=="")
    {
      include "IngresoDatosdeSocio.php";
    }
		else
   {
	//echo "<tr><td colspan=".count($ArrColumnas).">".$men."</td></tr>";	
	echo "<tr><td class='".$titulo."'>".$t."</span>&nbsp;</td>";

	for($m=0;$m<count($ArrColumnas);$m++)
	   {
 	      echo "<td class='TituloP'>".$ArrColumnas[$m]."<span class='titulosRojo'>".$ArrMensaje[$m]."</span>&nbsp;</td>";
     }	
   }

	echo "</tr>";


  }	 // for que recorre las lineas del archivo
  ?>
</table>


<?
$SQL= "SELECT     GE_NO_INSPECCION, GE_SOCIO, GE_ARCHIVO, GE_RESULTADOIPAL
FROM         IPAL
WHERE     (GE_ARCHIVO ='$rutadestino')
ORDER BY GE_SOCIO";
$q->ejecutar($SQL,75,'SubirInfosocio.php');

?>
<table border="1" align="center">
<TR>
  <TD colspan="6"><table width="100%"  border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td><a href="SubirInfosocio.php?us_menu=<?=$us_menu?>&usr=<?=$usr?>">cargar Otro Documento Documento</a></td>
      <td class="TitulosTablas">REGISTROS INGRESADOS </td>
      <td><!--<a href="SubirInfosocio.php?nivel=1&us_menu=<?=$us_menu?>&usr=<?=$usr?>&GE_PROCESOSOCIO=<?=$GE_PROCESOSOCIO?>&rutadestino=<?=$rutadestino?>">cargar Filas </a>--></td>
    </tr>
  </table></TD>
  </TR>
<TR>
<TD>-</TD>
<TD>NO inspeccion</TD>
<TD>No socio</TD></TD>
<TD>Archivo</TD>
<TD>Resultado Ipal</TD>
<TD></TD>
</TR>
<?
$i=1;
 WHILE ($q->Cargar())
{
?>
<TR>
<TD><?=$i?></TD>
<TD><?=$q->dato(0)?></TD>
<TD><?=$q->dato(1)?></TD>
<TD><?=$q->dato(2)?></TD>
<TD><?=$q->dato(3)?></TD>
<TD>Cargado de Forma Exitosa</TD>
</TR><?
$i++;
}?>

</TABLE>
</form>
<?
}

?>

</body>
</html>
