<?

include "include/VarGlobales.PHP"; 
require("include/BdSqlClases.php");

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);

$LLAMADO='SI';


if($Borrar==1)
{

  $SQLBorrar="delete FROM         FOTOS_VIDEOS
		  where GE_NO_INSPECCION=$GE_NO_INSPECCION	and FV_NOMBRE='$FV_NOMBRE'";
  //echo $SQLBorrar;
  $q->ejecutar($SQLBorrar,19,'FotosVideoBB.php');	
  
  
   $RFIJA=$ruta."/".$FV_NOMBRE;
   //echo $RFIJA;
	 if(is_file ($RFIJA))
	 {
	  if (unlink($RFIJA)) {
		 $men="Archivo Eliminado. ";
	  }
	 }

}
	 $q->ejecutar("SELECT   USB_HABILITAR
					FROM         IPAL_USUARIOS_BB
				   WHERE  USB_CEDULA=$usr ", 107, "Principal.php");
	 $q->Cargar();
	 $USB_HABILITAR=$q->dato(0);
	 $ENINICIO=1;
	 if($USB_HABILITAR=='SI')
	 {		
	   $ENINICIO=0;
	 }
?>
<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript">
 
</script>
<form name=a method=post enctype="multipart/form-data" onsubmit="return valideFotos()" action="GuardarFoto.php">
<input type="hidden" name="GE_NO_INSPECCION" id="GE_NO_INSPECCION"  value="<?=$GE_NO_INSPECCION?>"/>
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
 <input type="hidden"   name="EnviarA"      size="10"  maxlength="10" value="MarcoFormatoBB.php">  
 <input type="hidden"   name="Monstrar"      size="10"  maxlength="10" value="FotosVideoBB.php"> 
<table width="62%" height="286" border="1">
  <tr>
    <td height="85" colspan="3"><table width="100%" border="0">
      <tr>
        <td width="42" class="TitulosTablasLetras">FOTOS</td>
        <td width="384"  align="left"><span class="TituloGrande">Subir archivo: 
            <input name="userfile" type=file class="TitulosDirectrices"  size="30">
            <br>
            Descripcion:
            <textarea name="DOC_DESCRIPCION" cols="40" rows="2" class="TitulosDirectrices" ></textarea>
		    <input name="submit" type=submit class="TitulosDirectrices"  value="Guardar">
        </span> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
      <td  class="TituloGrande" align="left">Foto- Fecha de cargue en el sistema</td>
      <td  class="TituloGrande">Descripcion</td>
      <td class="TituloGrande">E</td>
   </tr>
       	<?
  if($GE_NO_INSPECCION<>"")		
  {
	$sql="SELECT     FV_RUTA, FV_NOMBRE, FV_DESCRIPCION
			FROM         FOTOS_VIDEOS
		  where GE_NO_INSPECCION=$GE_NO_INSPECCION	and FV_TIPO='FOTO'";
    $q->ejecutar($sql,47,'FotosVideoBB.php');	
    while($q->Cargar())
	{

	 $fsubirbd=date("F d Y H:i:s.", filectime($q->dato(0)."/".$q->dato(1)));
	?>
  <tr>
      <td  class="titulos" align="left"><a href="<?=$q->dato(0)."/".$q->dato(1)?>"><?=$q->dato(1)?></a>-<?=$fsubirbd?></div></td>
      <td  class="TituloGrande"><div align="left"><?=$q->dato(2)?></div></td>
      <td class="TituloGrande"><div align="left"><a href="<?=$EnviarA?>?Borrar=1&usr=<?=$usr?>&us_menu=<?=$us_menu?>&GE_NO_INSPECCION=<?=$GE_NO_INSPECCION?>&Monstrar=FotosVideoBB.php&FV_NOMBRE=<?=$q->dato(1)?>&ruta=<?=$q->dato(0)?>&ENINICIO=<?=$ENINICIO?>"><img src="Img/eliminar.gif" width="18" height="18" border="0" /></a></div></td>
   </tr>		
	<?
	}
  }	
	?>
  
  
  <tr>
    <td height="57" colspan="3"><table width="100%" border="0">
      <tr>
        <td width="68" class="TitulosTablasLetras">VIDEOS</td>
        <td width="1099"  align="left"><span class="TituloGrande">Subir video opcional:
            <input name="userfile2" type=file   class="TitulosDirectrices" size="30">
            <br>
            Descripcion:
            </span><span class="TitulosTablasDirectrices">
            <textarea name="DOC_DESCRIPCION2" cols="40" rows="2" class="TitulosDirectrices" ></textarea>
            <input name="submit2" type=submit class="TitulosDirectrices" value="Guardar">
            </span> </td>
      </tr>
    </table></td>
  </tr>
		<?
  if($GE_NO_INSPECCION<>"")		
  {
	$sql="SELECT     FV_RUTA, FV_NOMBRE, FV_DESCRIPCION
			FROM         FOTOS_VIDEOS
		  where GE_NO_INSPECCION=$GE_NO_INSPECCION	and FV_TIPO<>'FOTO'  AND FV_TVIDEO IS NULL";
    $q->ejecutar($sql,87,'FotosVideoBB.php');	
    while($q->Cargar())
	{
	?>

      <tr>
        <td class="TituloGrande" ><div align="left"><a href="<?=$q->dato(0)."/".$q->dato(1)?>">*Video Cargado en el sistema con nombre: <?=$q->dato(1)?></a></div></td>
        <td class="TituloGrande" ><a href="<?=$EnviarA?>?Borrar=1&usr=<?=$usr?>&us_menu=<?=$us_menu?>&GE_NO_INSPECCION=<?=$GE_NO_INSPECCION?>&Monstrar=FotosVideoBB.php&FV_NOMBRE=<?=$q->dato(1)?>&ruta=<?=$q->dato(0)?>"><img src="Img/eliminar.gif" width="18" height="18" border="0" /></a></td>
    </tr>
	<?
	}
  }
	?>
		
</table>
<br />
<table width="50%" border="1">
  <tr>
    <td><table width="100%" border="0">
            <tr>
              <td width="68" class="TitulosTablasLetras">FIRMA DIGITAL </td>
              <td width="1099"  align="left"><span class="titulosFondoGrisGrande">Subir video firma digital:
                  <input name="userfile3" type="file"   class="TitulosDirectrices" size="30" />
              <br />
              Descripcion:
              </span>
                <textarea name="DES3" cols="40" rows="2" class="TitulosDirectrices" ></textarea>
                <input name="submit22" type="submit" class="TitulosDirectrices" value="Guardar" />              </td>
            </tr>
        </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1">
  <tr>
<?
  if($GE_NO_INSPECCION<>"")		
  {
	$sql="SELECT     FV_RUTA, FV_NOMBRE, FV_DESCRIPCION
			FROM         FOTOS_VIDEOS
		  where GE_NO_INSPECCION=$GE_NO_INSPECCION	and FV_TIPO<>'FOTO' AND FV_TVIDEO='FIRMA DIGITAL'";
    $q->ejecutar($sql,87,'FotosVideoBB.php');	
    while($q->Cargar())
	{?>
        <td class="TituloGrande" align="center" ><a href="<?=$q->dato(0)."/".$q->dato(1)?>">Nombre Video: <?=$q->dato(1)?></a> Des: <?=$q->dato(2)?></div></td>
        </div></td>
        <td class="TituloGrande" ><a href="<?=$EnviarA?>?Borrar=1&usr=<?=$usr?>&us_menu=<?=$us_menu?>&GE_NO_INSPECCION=<?=$GE_NO_INSPECCION?>&Monstrar=FotosVideoBB.php&FV_NOMBRE=<?=$q->dato(1)?>&ruta=<?=$q->dato(0)?>"><img src="Img/eliminar.gif" width="18" height="18" border="0" /></a></td>
	<?
	}
  }
	?>
  </tr>
</table></td></tr>
</table>

<p>&nbsp;</p>
</form>
