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
<script language="JavaScript">
 var nav4=window.Event?true:false;

 function ValideLetras(evt)
 {
   var key=nav4?evt.which:evt.keyCode;
         return (key==209 || (key>=65 && key <=90))
 }
 function valide()
 {

   if(a.EM_ID.value=="")
   {
     alert("La  empresa es obligatoria");
      return false;
   }
   if(a.EC_CONTRATO.value=="")
   {
     alert("El contrato es  obligatori0");
      return false;
   }

 }
</script>


<body>



<? 
include "LlamadoMenu.php"; 

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);

if($nivel=="")
{
  if($EC_ID<>"")
  {
	   $s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
	   $sentencia="SELECT   EC_DESCRIPCION, EC_CORREO, EC_DESCORTA,EC_CONTRATO,EM_ID,   e2, e3, e4, e5,e6,e7,
	  				 SUBSTRING(EC_CORREO,256,500) as corr2, EC_UBICACION, EC_ACTIVA, EC_FOCO
					FROM         EMPRESA_CONTRATOS
					where EC_ID='$EC_ID'";
	   $s->ejecutar($sentencia, 60, 'Contratos.php');
	   while($s->Cargar())
	  {
	   $EC_DESCRIPCIONbb=$s->dato(0);   
	   $EC_CORREObb=$s->dato(1)." ".$s->dato(11);  
	   $EC_DESCORTAbb =$s->dato(2);  
	   $EC_CONTRATObb=$s->dato(3); 
	   $EM_ID=$s->dato(4); 
	   
	   $e2bb=$s->dato(5);   	   	   
	   $e3bb=$s->dato(6);   	   	   
	   $e4bb=$s->dato(7);   	   	   	   	   
	   $e5bb=$s->dato(8);   	   	   	   	   	   
	   $e6bb=$s->dato(9); 
	   $e7bb=$s->dato(10); 
	   $EC_UBICACIONbb=$s->dato(12); 
	   $EC_ACTIVA=$s->dato(13); 
	   $EC_FOCO=$s->dato(14); 
	  }
  }
  else
  {
     $sentencia="select max(EC_ID)+1
					FROM         EMPRESA_CONTRATOS";
     $s->ejecutar($sentencia, 76, 'Contratos.php');
     $s->Cargar();
     $EM_IDNew=$s->dato(0); 
	 $EC_ID=$EM_IDNew;
  
  }  

?>
<br>
<BR>
<form name=a onsubmit='return valide()'>
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
<table width="65%" border="1" align="center"  >
  <tr bordercolor="#CCCCCC" >
    <td colspan="5" >
      <table width="100%" border="1">
        <tr>
          <td width="11%"><a href="Empresas.php?usr=<?=$usr?>&us_menu=<?=$us_menu?>">Empresas</a></td>
          <td width="82%" class="TitulosTablas"><div align="center">EMPRESAS- contratos </div></td>
          <td width="7%"><a href="Contratos.php?usr=<?=$usr?>&us_menu=<?=$us_menu?>">Nuevo Contrato</a></td>
        </tr>
      </table></td>
    </tr>
  <tr bordercolor="#CCCCCC">
    <td colspan="5" ><table width="100%" border="0">
      <tr>
        <td width="302"   align="center" class="Fondogris"> <div align="left">Empresa: 
      <select name="EM_ID" id="EM_ID"  class="titulos">
        <option value="">Seleccione</option>
         <?
				   $sql="SELECT   EM_ID, EM_NOMBRE
							FROM         EMPRESAS
							order by EM_NOMBRE";
				   $q->ejecutar($sql,129,'Formato.php');	   
				   while($q->Cargar())
				   { 
					   ?>
        <option value="<?=$q->dato(0)?>" <? IF($EM_ID==$q->dato(0)) echo "selected"?> >
          <?=$q->dato(1)?>
          </option>
         <?
					}  
				  ?>
        </select>
    </div></td>
   	   <td width="119"  align="center" class="Fondogris"><div align="left">Contrato No :</div></td> 
       <td width="178"><input type="text" class="titulos" size="25" name="EC_CONTRATO" value="<?=$EC_CONTRATObb?>"></td>

	   <td width="73"  align="center" class="Fondogris"><div align="left">Indice : </div></td>	
       <td width="95"><input type="hidden" class="titulos" size="30" name="EC_ID" value="<?=$EC_ID?>"><?=$EC_ID?></td>
	       <td width="106"  align="left" class="Fondogris">Contrato Foco</td>
    <td width="51"  align="left" class="Fondogris"><label for="select"></label>
      <select name="EC_FOCO" id="EC_FOCO">
        <option value="SI" <? if($EC_FOCO=='SI') echo "selected"?> >SI</option>
        <option value="NO" <? if($EC_FOCO=='NO') echo "selected"?> >NO</option>
      </select></td>
      </tr>
    </table></td>
  </tr>
  <tr bordercolor="#CCCCCC">
    <td width="10%"   align="left" class="Fondogris">UBICACION</td>
    <td width="22%"  align="LEFT" class="Fondogris"><select name="EC_UBICACION" id="EC_UBICACION">
       <option value="">Seleccione</option>
      <option value="RURAL"          <? if($EC_UBICACIONbb=='RURAL') echo "selected"?> >RURAL</option>
      <option value="BOGOTA-SABANA"  <? if($EC_UBICACIONbb=='BOGOTA-SABANA') echo "selected"?> >BOGOTA-SABANA</option>
      &nbsp;</select></td>
    <td width="17%"  align="left" class="Fondogris">Descripcion corta del contrato (60 Caracteres)
      <input name="EC_DESCORTA" type="text" size="60" class="titulos" maxlength="60" value="<?=$EC_DESCORTAbb?>"></td>

   
   
    <td width="17%"  align="left" class="Fondogris">Activa</td>
    <td width="34%"  align="left" class="Fondogris"><label for="select"></label>
      <select name="EC_ACTIVA" id="EC_ACTIVA">
        <option value="SI" <? if($EC_ACTIVA=='SI') echo "selected"?> >SI</option>
        <option value="NO" <? if($EC_ACTIVA=='NO') echo "selected"?> >NO</option>
      </select></td>
  </tr>
    
  <tr bordercolor="#CCCCCC">
    <td colspan="5" class="TitulosTablasOtro">Descripcion del contrato </td>
    </tr>
  <tr bordercolor="#CCCCCC">
    <td colspan="5"><label>
      <textarea name="EC_DESCRIPCION" cols="150" rows="2" class="titulos"><?=$EC_DESCRIPCIONbb?></textarea>
    </label></td>
    </tr>  

  <tr bordercolor="#CCCCCC">
    <td colspan="5" class="TitulosTablasOtro"><table width="100%" border="1">
      <tr>
        <td width="10%">Correo</td>
        <td width="90%"><label>
          <textarea name="EC_CORREO" cols="90" rows="4"><?=$EC_CORREObb?></textarea>
        </label></td>
      </tr>
    </table></td>
    </tr>
  <tr bordercolor="#CCCCCC">
    <td colspan="5"><table width="100%" border="1">
      <tr>
        <td width="4%">&nbsp;</td>
        <td width="96%" class="TitulosTablasOtro">DEPENDENCIA</td>
      </tr>
	  <tr>
        <td class="TitulosTablasOtro">E2</td>
        <td class="titulos"><select name="e2">
	     <option value="">Seleccione</option>
      <?
	  $sentencia="SELECT distinct e2
					FROM         EMPRESA_CONTRATOS
					where e2 is not null
					ORDER BY e2	";
  $s->ejecutar($sentencia, 157, 'contratos.php');
  while($s->Cargar())
   { 
					   ?>
        <option value="<?=$s->dato(0)?>" <? IF($e2bb==$s->dato(0)) echo "selected"?> ><?=$s->dato(0)?></option>	<?
	}  
	?>
	  </select></td>
      </tr>
      <tr>
        <td class="TitulosTablasOtro">E3</td>
        <td class="titulos"><select name="e3">
	     <option value="">Seleccione</option>
      <?
	  $sentencia="SELECT distinct e3
					FROM         EMPRESA_CONTRATOS
					where e3 is not null
					ORDER BY e3	";
  $s->ejecutar($sentencia, 157, 'contratos.php');
  while($s->Cargar())
   { 
					   ?>
        <option value="<?=$s->dato(0)?>" <? IF($e3bb==$s->dato(0)) echo "selected"?> ><?=$s->dato(0)?></option>	<?
	}  
	?>
	  </select></td>
      </tr>
      <tr>
        <td class="TitulosTablasOtro">E4</td>
        <td class="titulos"><select name="e4">
	     <option value="">Seleccione</option>
      <?
	  $sentencia="SELECT distinct e4
					FROM         EMPRESA_CONTRATOS
					where e4 is not null
					ORDER BY e4	";
  $s->ejecutar($sentencia, 157, 'contratos.php');
  while($s->Cargar())
   { 
					   ?>
        <option value="<?=$s->dato(0)?>" <? IF($e4bb==$s->dato(0)) echo "selected"?> ><?=$s->dato(0)?></option>	<?
	}  
	?>
	  </select></td>
      </tr>
      <tr>
        <td class="TitulosTablasOtro">E5</td>
        <td class="titulos"><select name="e5">
	     <option value="">Seleccione</option>
      <?
	  $sentencia="SELECT distinct e5
					FROM         EMPRESA_CONTRATOS
					where e5 is not null
					ORDER BY e5	";
  $s->ejecutar($sentencia, 157, 'contratos.php');
  while($s->Cargar())
   { 
					   ?>
        <option value="<?=$s->dato(0)?>" <? IF($e5bb==$s->dato(0)) echo "selected"?> ><?=$s->dato(0)?></option>	<?
	}  
	?>
	  </select></td>
      </tr>
      <tr>
        <td class="TitulosTablasOtro">E6</td>
        <td class="titulos"><select name="e6">
	     <option value="">Seleccione</option>
      <?
	  $sentencia="SELECT distinct e6
					FROM         EMPRESA_CONTRATOS
					where e6 is not null
					ORDER BY e6	";
  $s->ejecutar($sentencia, 157, 'contratos.php');
  while($s->Cargar())
   { 
					   ?>
        <option value="<?=$s->dato(0)?>" <? IF($e6bb==$s->dato(0)) echo "selected"?> ><?=$s->dato(0)?></option>	<?
	}  
	?>
	  </select></td>
      </tr>
      <tr>
        <td class="TitulosTablasOtro">E7</td>
        <td class="titulos"><select name="e7">
	     <option value="">Seleccione</option>
      <?
	  $sentencia="SELECT distinct e7
					FROM         EMPRESA_CONTRATOS
					where e7 is not null
					ORDER BY e7	";
  $s->ejecutar($sentencia, 157, 'contratos.php');
  while($s->Cargar())
   { 
					   ?>
        <option value="<?=$s->dato(0)?>" <? IF($e7bb==$s->dato(0)) echo "selected"?> ><?=$s->dato(0)?></option>	<?
	}  
	?>
	  </select></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td colspan="5"><div align="center">
      <input type=submit value="Guardar" >
      <input type="hidden" name="nivel"  value="1">
    </div></td>
  </tr>
</table>
</form>
<BR>
<table width="65%" border="1" align="center" >
  <tr>
    <td width="96" class="TitulosTablas">Contrato</td>	
    <td width="339" class="TitulosTablas">Descripcion  </td>		
    <td width="225" class="TitulosTablas">Descorta </td>		
    <td width="132" class="TitulosTablas">correo </td>	
    <td width="132" class="TitulosTablas">Ubicacion </td>	    		
    <td width="19" class="TitulosTablas">E</td>	
  </tr>

<?

  $sentencia="SELECT  EC_ID,  EC_CONTRATO,   EC_DESCRIPCION, EC_DESCORTA,  EC_CORREO, EM_ID, EC_UBICACION
					FROM         EMPRESA_CONTRATOS";
  if($EM_ID<>"")  $sentencia.=" where 	EM_ID=$EM_ID";			
  $sentencia.="	ORDER BY EC_CONTRATO	";
  $s->ejecutar($sentencia, 124, 'EMPRESAS.php');
  while($s->Cargar())
  {
     $sql="SELECT  EC_ID
			FROM      ipal 
			WHERE     EC_ID = ".$s->dato(0);
	  $q->ejecutar($sql, 130, 'contratos.php');
	  $q->Cargar();
	  $EC_ID=$q->dato(0);

  
   echo"<tr class='titulos'>";
   ?><td><a href="Contratos.php?usr=<?=$usr?>&us_menu=<?=$us_menu?>&EC_ID=<?=$s->dato(0)?>"><?=$s->dato(1)?></a></td>
   <td><?=$s->dato(2)?></td>
   <td><?=$s->dato(3)?></td>
   <td><?=$s->dato(4)?></td>
   <td><?=$s->dato(6)?></td>
   <td>
   <?
   if($EC_ID=="")
   {?>
   <a href="Contratos.php?nivel=3&usr=<?=$usr?>&us_menu=<?=$us_menu?>&EC_ID=<?=$s->dato(0)?>"><img src="Img/eliminar.gif" border="0"></a><?
   }   ?>          
    &nbsp;</td>
    </tr><?
  }

?>
</table>
<?
}
if($nivel=="1")
{

  if ($EC_CORREO=="") $EC_CORREO='null';
  $q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
   $sentencia="SELECT  EC_ID,  EC_CONTRATO,   EC_DESCRIPCION, EC_GERENCIA, EC_AREA, EC_GRUPO, EM_ID
					FROM         EMPRESA_CONTRATOS
					where EC_ID=$EC_ID";
  //echo $sentencia."<br>";
   $q->ejecutar($sentencia, 150, 'EMPRESAS.php');
   $Tfilas=$q->filas();
   if($Tfilas==0)
     $sentencia="insert EMPRESA_CONTRATOS (  EC_ID,  EC_CONTRATO,   EC_DESCRIPCION, EC_DESCORTA, EM_ID, EC_CORREO, e2, e3, e4, e5,e6,e7, EC_UBICACION, EC_ACTIVA, EC_FOCO)
                 values($EC_ID,'$EC_CONTRATO','$EC_DESCRIPCION', '$EC_DESCORTA', $EM_ID, '$EC_CORREO', '$e2','$e3','$e4','$e5','$e6','$e7', '$EC_UBICACION', '$EC_ACTIVA', '$EC_FOCO')";
   if($Tfilas==1)
     $sentencia="UPDATE EMPRESA_CONTRATOS SET EC_CONTRATO='$EC_CONTRATO',
                                          EC_DESCRIPCION='$EC_DESCRIPCION',
										  EC_DESCORTA='$EC_DESCORTA',
										  EM_ID=$EM_ID,
										  EC_CORREO='$EC_CORREO',
										  
										  E2='$e2',
										  e3='$e3',
										  e4='$e4',
										  e5='$e5',
										  e6='$e6',
										  e7='$e7',
										  EC_UBICACION='$EC_UBICACION',
										  EC_ACTIVA='$EC_ACTIVA',
										  EC_FOCO='$EC_FOCO'
											
             	where EC_ID=$EC_ID";
  //ECHO $sentencia;
   $q->ejecutar($sentencia,160, 'EMPRESAS.php');

 ?>
 <form id="form1" name="form1" method="POST" action="Contratos.PHP">
	<input type="hidden" size="10" maxlength="10" name="us_menu"        value="<?=$us_menu?>">
	<input type="hidden" size="10" maxlength="10" name="usr"            value="<?=$usr?>">
	<input type="hidden" size="10" maxlength="10" name="EM_ID"          value="<?=$EM_ID?>">	
   <script language="javascript">document.form1.submit(); </script>
</form>
 <?
}

if($nivel=="3")
{

   $sentencia="DELETE FROM EMPRESA_CONTRATOS WHERE EC_ID=$EC_ID";
  // echo $sentencia."<br>";
   $q->ejecutar($sentencia, 399, 'Contratos.php');
 ?>
      <script language="JavaScript">
        location.href='Contratos.php?usr=<?=$usr?>&us_menu=<?=$us_menu?>&US_USUARIO=<?=$US_USUARIO?>&EC_ID=<?=$EC_ID?>';
     </script>
 <?
}

?>
</body>
</html>