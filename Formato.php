<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
<?


include "include/VarGlobales.PHP"; 
require("include/BdSqlClases.php");

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);


if($GE_NO_INSPECCION<>"")
{


	 $sql1="SELECT  convert(varchar(10),GE_FECHA,120), GE_MOVIL, GE_PLACA, GE_TIPOVEHICULO, GE_TRAB_AREALIZAR, PR_ID, 
                      GE_HINICIO, DATEPART(hh,GE_HINICIO),    DATEPART(mi,GE_HINICIO),EC_ID, GE_DIRECCION AS DATO10,
					 YEAR(GE_FECHA), MONTH(GE_FECHA), DAY(GE_FECHA),
					  GE_PGRUA,   GE_PCANASTA, GE_PMOTO, GE_TIPONO, GE_NO, GE_MUNICIPIO, GE_TINSPECCION, GE_BVERIFTERRENO,
					  SUBSTRING(IPAL.GE_OBSERVACION,0,250) AS OBS1 ,  SUBSTRING(IPAL.GE_OBSERVACION,251,750) AS OBS2,
					  SUBSTRING(GE_OBSAMBIENTAL ,0,250) AS OBSCUADR1,SUBSTRING(GE_OBSAMBIENTAL ,251,500) AS OBSCUADR2,
					  SUBSTRING(GE_OBSAMBIENTAL ,501,750) AS OBSCUADR3,
					   DATEPART(hh,GE_HFINALIZACION),    DATEPART(mi,GE_HFINALIZACION), GE_NODELFOS as dato29
			FROM         IPAL
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
     $q->ejecutar($sql1,86,'BuscarGuia.php');	   
	 while($q->Cargar())
	{ 
	   $GE_FECHA=$q->dato(0);
	   $GE_MOVIL=$q->dato(1);
	   $GE_PLACA=$q->dato(2);
	   $GE_TIPOVEHICULO=$q->dato(3);

	   $GE_TRAB_AREALIZAR=$q->dato(4);
	   $GE_DIRECCION=$q->dato(10);	  	


	   $PR_ID=$q->dato(5);
	   //echo "hora de inicio".$q->dato(6);
	   if($q->dato(6)<>"")
	      $GE_HINICIO=$q->dato(7).":".$q->dato(8);
	   if($q->dato(27)<>"")	  
	     $GE_HFINALIZACION=$q->dato(27).":".$q->dato(28);	  
	   $EC_ID=$q->dato(9);	 
   	   	   
   
	   $GE_AAA=$q->dato(11);	  	   	   	   
	   $GE_MES=$q->dato(12);	  	   	   	   
	   $GE_DIA=$q->dato(13);	
	   
	   $GE_PGRUA=$q->dato(14);	  	   	   	   
	   $GE_PCANASTA=$q->dato(15);	  	   	   	   
	   $GE_PMOTO=$q->dato(16);	
	   $GE_TIPONO=$q->dato(17);	

//echo  $GE_TIPONO;
	   $GE_NO=$q->dato(18);		   	   
	   $GE_MUNICIPIO=$q->dato(19);	
	   $GE_TINSPECCION=	$q->dato(20);	   	   
	   $GE_BVERIFTERRENO=	$q->dato(21);
	   $OBBSERVACIONINSP=trim($q->dato(22))." ".trim($q->dato(23));	   	
	   $OBBSECUADRILLERO=trim($q->dato(24))." ".trim($q->dato(25))." ".trim($q->dato(26));	  
	   
	   $GE_NODELFOS= $q->dato(29);		      
	}
	if($EC_ID<>"")
	{
    
	  $sql="SELECT DISTINCT EMPRESAS.EM_ID,  EMPRESA_CONTRATOS.EC_CONTRATO
			FROM         EMPRESA_CONTRATOS INNER JOIN
                      EMPRESAS ON EMPRESA_CONTRATOS.EM_ID = EMPRESAS.EM_ID
	 	WHERE     (EMPRESA_CONTRATOS.EC_ID = $EC_ID)";
    
	  $q->ejecutar($sql,86,'BuscarGuia.php');	   
	  $q->Cargar();
	  $EM_ID=$q->dato(0);
	  $EC_CONTRATO=$q->dato(1);
	}  	
		
}


if($GE_AAA=="")$GE_AAA=date(Y);	  	   	   	   
if($GE_MES=="")$GE_MES=date(m);
if($GE_DIA=="")$GE_DIA=date(d);
?>

<form action="GuardarInicio.php" method="get" name="inicio" onsubmit="return valideInicio()">
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
  <input type="hidden"   name="Monstrar"      size="10"  maxlength="10" value="Formato.php"> 
 <input type="hidden"   name="EnviarA"      size="10"  maxlength="10" value="MarcoFormato.php">   
 <input type="hidden"   name="Modins"      size="10"  maxlength="10" value="<?=$Modins?>">    
  
<table width="100%" border="0" align="center">
  <tr>
    <td width="52%"><table width="100%" border="0">
      <tr>
        <td width="58%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
         
              <tr>
                <td colspan="3"><table width="100%" border="0">
                  <tr>
						<td width="51%"  class="titulosRojo"><?
							if($GE_NO_INSPECCION=="")
							{?>
								No de inspeccion: <input type="text" name="GE_NO_INSPECCION" id="GE_NO_INSPECCION" />
								 <?
							 }
							 else
							 {
							    ?><input type="hidden" name="GE_NO_INSPECCION" id="GE_NO_INSPECCION"  value="<?=$GE_NO_INSPECCION?>"/><?
							 }?>&nbsp;<span class="titulos">No inspeccion Delfos</span>
                    <input name="GE_NODELFOS" type="text" class="titulos" id="GE_NODELFOS" value="<?=$GE_NODELFOS?>" size="40" /></td>
                  </tr>
                </table></td>
                </tr>
              <tr>
                <td width="46%"><div align="left">Empresa: &nbsp;<select name="EM_ID" id="EM_ID"  class="titulos"  onchange="CargarContratos(EM_ID.value, this.id)">
				    <option value="">Seleccione</option>
				  <?
				   $sql="SELECT   EM_ID, EM_NOMBRE
							FROM         EMPRESAS
							order by EM_NOMBRE";
				   $q->ejecutar($sql,129,'Formato.php');	   
				   while($q->Cargar())
				    { 
              ?><option value="<?=$q->dato(0)?>" <? IF($EM_ID==$q->dato(0)) echo "selected"?> ><?=$q->dato(1)?></option><?
				  	}
				  ?>
				  </select>
                </div></td>
				<td width="20%"><div align="right">No contrato </div></td>
                <td width="34%"><div align="left">
                  <select name="EC_ID" id="EC_ID" class="titulos" >
					           <option value=""></option>
					           <? if($EC_ID<>"") 
                     {  
                            $sql="
                        SELECT 
                          DISTINCT EMPRESAS.EM_ID,  EMPRESA_CONTRATOS.EC_CONTRATO, EC_ID
                        FROM         
                          EMPRESA_CONTRATOS INNER JOIN
                          EMPRESAS ON EMPRESA_CONTRATOS.EM_ID = EMPRESAS.EM_ID
                        WHERE     
                          (EMPRESA_CONTRATOS.EM_ID = '$EM_ID')
                          AND EC_ID <> '$EC_ID';
                        ";
               
                        $q->ejecutar($sql,135,'Formato.php');     
                        while($q->Cargar())
                        { 
                          ?><option value="<?=$q->dato(2)?>"><?=$q->dato(1)?></option><?
                        }
                          ?>
                            <option value="<?=$EC_ID?>"  selected="selected"><?=$EC_CONTRATO?></option>
                          <?
					           }?>	
				          </select>

                </div></td>
              </tr>
            </table></td>
          </tr>
          
          <tr>
            <td colspan="2"><table width="100%" border="1" cellpadding="0" cellspacing="0">
              <tr>
                <td class="TituloG">Estado</td>
                <td class="TituloG">Hora inicial (Militar 13:10)</td>
                <td class="TituloG">Hora final (Militar 15:20) </td>
              </tr>
              <tr>
                <td class="TituloG">
				<?
                if($us_menu<>7)
				{?>
                <select name="GE_BVERIFTERRENO" class="titulos">
                  <option value="">Seleccione</option>
                  <option value="CERRADA" <? if($GE_BVERIFTERRENO=='CERRADA') echo "selected" ?> >CERRADA</option>
                  <option value="INICIO" <? if($GE_BVERIFTERRENO=='INICIO') echo "selected" ?> >INICIO</option>
                </select>
                <?
				}
				else 
				  echo $GE_BVERIFTERREN?></td>
                <td class="TituloG"><input name="GE_HINICIO" type="text" class="titulos" id="GE_HINICIO" size="10" maxlength="5" value="<?=$GE_HINICIO?>"/></td>
                <td class="TituloG"><input name="GE_HFINALIZACION" type="text" class="titulos" id="GE_HFINALIZACION" size="10" maxlength="5" value="<?=$GE_HFINALIZACION?>"/></td>
              </tr>
            </table></td>
          </tr>
        </table>
      </td>
        <td width="48%" valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <td width="110" class="TituloG"><div align="left">Trabajo a realizar </div></td>
            <td width="261"><div align="left">
              <input name="GE_TRAB_AREALIZAR"  id="GE_TRAB_AREALIZAR" type="text" class="titulos" size="50" value="<?=$GE_TRAB_AREALIZAR?>" />
            </div></td>
          </tr>
          <tr>
            <td class="TituloG" align="left">Proceso</td>
            <td align="left"><select name="PR_ID" id="PR_ID"  class="titulos"  >
              <option value="">Seleccione</option>
              <?
				   $sql="SELECT     PR_ID,  PR_NOMCORTO
							FROM         PROCESOS
							order by  PR_NOMCORTO";
				   $q->ejecutar($sql,129,'Formato.php');	   
				   while($q->Cargar())
				   { 
					   ?>
              <option value="<?=$q->dato(0)?>" <? IF($PR_ID==$q->dato(0)) echo "selected"?> >
                <?=$q->dato(0)."-".$q->dato(1)?>
                </option>
              <?
					}  
				  ?>
            </select></td>
          </tr>
          <tr>
            <td colspan="4" align="left"><span class="TituloG">Tipo de inspeccion:</span>
              <label>
                <select name="GE_TINSPECCION" class="titulos" id="GE_TINSPECCION" >
                  <option value="">Seleccione</option>
                  <option value="CONTROL REDES"  <? IF($GE_TINSPECCION=='CONTROL REDES') echo "selected"?> >CONTROL REDES</option>
                  <option value="PRL"  <? IF($GE_TINSPECCION=='PRL') echo "selected"?>  >PRL</option>
                </select>
              </label></td>
          </tr>
          <tr>
            <td colspan="4" align="left"><table width="100%" border="0">
              <tr>
                <td width="4%" class="TituloG">Tipo</td>
                <td width="15%" ><label>
                  <select name="GE_TIPONO" class="titulos" id="GE_TIPONO">
                    <option value="" >Seleccione</option>
					  <option value="INCIDENCIA" <? if($GE_TIPONO=='INCIDENCIA') echo "selected" ?> >INCIDENCIA</option>
                      <option value="DESCARGO" <? if($GE_TIPONO=='DESCARGO') echo "selected" ?> >DESCARGO</option>
                      <option value="ORDEN DE TRABAJO"  <? if($GE_TIPONO=='ORDEN DE TRABAJO') echo "selected" ?>>ORDEN DE TRABAJO</option>
                  </select>
                </label></td>
                <td width="4%" class="TituloG">No </td>
                <td width="77%"><label>
                  <input name="GE_NO" type="text" class="titulos" id="GE_NO" size="15"  value="<?=$GE_NO?>"/>
                </label></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
    </tr>
      <tr>
        <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <td width="7%"  class="TituloG"><div align="left">Fecha</div></td>
            <td width="14%"  class="TituloG"><div align="left">AAAA:<br />
              <input name="GE_AAA" type="text" class="titulos" id="GE_AAA" size="4" maxlength="4" value="<?=$GE_AAA?>"/>
            </div></td>
            <td width="9%"  class="TituloG">M:<br />
              <input name="GE_MES" type="text" class="titulos" id="GE_MES" size="1" maxlength="2" value="<?=$GE_MES?>"/></td>
            <td width="7%"  class="TituloG">D:<br />
              <input name="GE_DIA" type="text" class="titulos" id="GE_DIA" size="1" maxlength="2" value="<? if($GE_DIA=="") date(d);else echo $GE_DIA?>"/></td>
            <td  class="TituloG">Direcci&oacute;n<br />
              <input name="GE_DIRECCION" id="GE_DIRECCION" type="text" class="titulos" size="50" value="<?=$GE_DIRECCION?>" /></td>
            <td width="27%"><span  class="TituloG">Municipio<br />
              </span>
              <select name="GE_MUNICIPIO" id="GE_MUNICIPIO" class="titulos">
                <option value=""  ></option>
                <?
				 $SQL="SELECT     MUNICIPIO
						FROM         IPAL_MUNICIPIOS
						ORDER BY MUNICIPIO";
				 $q->ejecutar($SQL,129,'Formato.php');	   
				   while($q->Cargar())
				   { 
					   ?>
                <option value="<?=$q->dato(0)?>" <? IF($GE_MUNICIPIO==$q->dato(0)) echo "selected"?> >
                  <?=$q->dato(0)?>
                </option>
                <?
					}  		
				?>
              </select></td>
          </tr>
        </table></td>
        <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <td width="24%" class="TituloG">ce/Avantel</td>
            <td width="15%" class="TituloG">Tipo Vehiculo </td>
            <td width="21%" class="TituloG">Placa Vehiculo </td>
            <td width="14%" class="TituloG">Placa Grua </td>
            <td width="13%" class="TituloG">PlacaCanasta</td>
            <td width="13%" class="TituloG">Placa Moto </td>
          </tr>
          <tr>
            <td class="TituloG"><input name="GE_MOVIL"  id="GE_MOVIL" type="text" class="titulos" value="<?=$GE_MOVIL?>" /></td>
            <td class="TituloG"><select name="GE_TIPOVEHICULO"  id="GE_TIPOVEHICULO" class="titulos" >
              <option value="">Selecione</option>
              <option value="SIN" <? if($GE_TIPOVEHICULO=='SIN') echo "selected"?> >SIN</option>
              <option value="CAMIONETA" <? if($GE_TIPOVEHICULO=='CAMIONETA') echo "selected"?> >CAMIONETA</option>
              <option value="CAMPERO"   <? if($GE_TIPOVEHICULO=='CAMPERO') echo "selected"?>>CAMPERO</option>
              <option value="CARRIE"    <? if($GE_TIPOVEHICULO=='CARRIE') echo "selected"?>>CARRIE</option>
              <option value="FURGON"    <? if($GE_TIPOVEHICULO=='FURGON') echo "selected"?>>FURGON</option>
              <option value="GRUA"    <? if($GE_TIPOVEHICULO=='GRUA') echo "selected"?>>GRUA</option>
              <option value="CANASTA"    <? if($GE_TIPOVEHICULO=='CANASTA') echo "selected"?>>CANASTA</option>
              <option value="MOTO"    <? if($GE_TIPOVEHICULO=='MOTO') echo "selected"?>>MOTO</option>
            </select></td>
            <td class="TituloG"><input name="GE_PLACA"    id="GE_PLACA"type="text" class="titulos"   value="<?=$GE_PLACA?>" size="10" /></td>
            <td class="TituloG"><input name="GE_PGRUA"    id="GE_PGRUA" type="text" class="titulos" size="10"  value="<?=$GE_PGRUA?>"/></td>
            <td class="TituloG"><input name="GE_PCANASTA" id="GE_PCANASTA" type="text" class="titulos" size="10"  value="<?=$GE_PCANASTA?>"/></td>
            <td class="TituloG"><input name="GE_PMOTO"    id="GE_PMOTO" type="text" class="titulos" size="10"  value="<?=$GE_PMOTO?>"/></td>
          </tr>
        </table></td>
      </tr>
       <tr>
        <td colspan="2"><table width="100%" border="0">
      <tr>
        <td><span class="titulos">Observaciones del inspector:</span></td>
        <td><textarea name="GE_OBSERVACION" cols="120" id="GE_OBSERVACION"><?=$OBBSERVACIONINSP?></textarea></td>
      </tr>
      <tr>
        <td><span class="titulos">Observaciones del inspeccionado:</span></td>
        <td><textarea name="GE_OBSAMBIENTAL" cols="120" id="GE_OBSAMBIENTAL"><?=$OBBSECUADRILLERO?></textarea></td>
      </tr>
    </table></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><table width="100%" border="0">
      <tr>
        <td width="19%"><span class="TituloG">Responsable de la inspecci&oacute;n (SO)</span></td>
        <td width="32%"> <select name="RES_CEDULA" id="RES_CEDULA" class="titulos">
                  <option value=""  ></option>				
                <?
				IF($GE_NO_INSPECCION<>"")
				{
				
 				 	$SQL="SELECT RES_CEDULA, RES_NOMBRE, RES_CARGO, EM_ID
							FROM         IPAL_RES_INSPECCION
							WHERE GE_NO_INSPECCION=".$GE_NO_INSPECCION;	
				    $q->ejecutar($SQL,129,'Formato.php');	   
					$q->Cargar();
					$RES_CEDULAbd=$q->dato(0);
				}	
					
				 
				 $SQL="SELECT     USB_CEDULA, USB_NOMBRE, USB_CLAVE, EM_ID, USB_CARGO
						FROM         IPAL_USUARIOS_BB
						ORDER BY USB_NOMBRE";
				 $q->ejecutar($SQL,129,'Formato.php');	   
				   while($q->Cargar())
				   { 
					   ?>
			              <option value="<?=$q->dato(0)?>" <? IF($RES_CEDULAbd==$q->dato(0)) echo "selected"?> ><?=$q->dato(1)?></option>
		                 <?
					}  		
				?>
                </select></td>
        <td width="17%">&nbsp;</td>
        <td width="32%">&nbsp;</td>
      </tr>
    </table></td>
      </tr>
      <tr>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Guardar" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
</tr>
 </table>
</form>
