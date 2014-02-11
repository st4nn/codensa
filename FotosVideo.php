<link href="css/csstyles.css" rel="stylesheet" type="text/css" />

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
  $q->ejecutar($SQLBorrar,19,'Fotosvideo.php');	
  
   $RFIJA=$ruta."/".$FV_NOMBRE;
   //echo $RFIJA;
	 if(is_file ($RFIJA))
	 {
	  if (unlink($RFIJA)) {
		 $men="Archivo Eliminado. ";
	  }
	 }
  
}

?>

<form name=a method=post enctype="multipart/form-data" onsubmit="return valide()" action="GuardarFotoPC.php">
<input type="hidden" name="GE_NO_INSPECCION" id="GE_NO_INSPECCION"  value="<?=$GE_NO_INSPECCION?>"/>
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
 <input type="hidden"   name="EnviarA"      size="10"  maxlength="10" value="MarcoFormato.php">  
 <input type="hidden"   name="Monstrar"      size="10"  maxlength="10" value="FotosVideo.php">  

<table width="100%" border="0">
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="163" class="TitulosTablas">FOTOS</td>
        <td  align="left" class="titulos">Subir archivo: 
        <input name="userfile" type=file  size="70"><br>
		Descripcion:<textarea name="DOC_DESCRIPCION" cols="60" rows="2" ></textarea>
		 <input name="submit" type=submit  value="Guardar">        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="200" border="0">
      <tr>
        	<?
  if($GE_NO_INSPECCION<>"")		
  {
	$sql="SELECT     FV_RUTA, FV_NOMBRE, FV_DESCRIPCION
			FROM         FOTOS_VIDEOS
		  where GE_NO_INSPECCION=$GE_NO_INSPECCION	and FV_TIPO='FOTO'";
    $q->ejecutar($sql,47,'Fotosvideo.php');	
    while($q->Cargar())
	{
	    $ext1=strtolower(substr($q->dato(1),strlen($q->dato(1))-3,strlen($q->dato(1))));
            //echo $ext;
            $ext='iconos/Otro.gif';
            if($ext1=='pdf')$ext='Img/iconos/ico_pdf.gif';
            if($ext1=='xls')$ext='Img/iconos/ico_excel.gif';
            if($ext1=='doc')$ext='Img/iconos/ico_word.gif';
            if($ext1=='gif')$ext='Img/iconos/ico_gif.gif';
            if($ext1=='exe')$ext='Img/iconos/ico_exe.gif';
            if($ext1=='jpg')$ext='Img/iconos/ico_jpg.gif';
            if($ext1=='peg')$ext='Img/iconos/ico_jpg.gif';
	?>
	<td>
	<table width="111" border="0" align="center">
      <tr>
        <td colspan="2">
		<? if($ext1=='jpg'){?> <img src="<?=$q->dato(0)."/".$q->dato(1)?>" width="170" height="165" /><? }
		   else{?><a href="<?=$q->dato(0)."/".$q->dato(1)?>"><img src="<?=$ext?>" width="18" height="18" border="0" /></a><? } ?></td>
      </tr>
      <tr>
        <td width="174"><?=$q->dato(2)?></td>
        <td width="22"><a href="MarcoFormato.php?Borrar=1&usr=<?=$usr?>&us_menu=<?=$us_menu?>&GE_NO_INSPECCION=<?=$GE_NO_INSPECCION?>&Monstrar=FotosVideo.php&FV_NOMBRE=<?=$q->dato(1)?>&ruta=<?=$q->dato(0)?>"><img src="Img/eliminar.gif" width="18" height="18" border="0" /></a></td>
      </tr>
    </table>	</td>
	<?
	}
  }	
	?>
      </tr>
    </table></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>

  </tr>
</table>
<br />
</form>
