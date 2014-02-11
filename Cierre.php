<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
<?


include "include/VarGlobales.PHP"; 
require("include/BdSqlClases.php");

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);

if($GE_NO_INSPECCION<>"")
{


	 $sql1="SELECT   DATEPART(hh,GE_HFINALIZACION),   DATEPART(mi,GE_HFINALIZACION), 
	                        SUBSTRING(IPAL.GE_OBSERVACION,0,250) as observacin2,  SUBSTRING(IPAL.GE_OBSERVACION,251,500) as observacin3,
							 SUBSTRING(IPAL.GE_OBSERVACION,501,750) AS observacin4, SUBSTRING(IPAL.GE_OBSERVACION,751, 1000) AS observacin5, 
							GE_OBSAMBIENTAL, GE_OBS1
			FROM         IPAL
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
     $q->ejecutar($sql1,86,'BuscarGuia.php');	   
	 while($q->Cargar())
	{ 
	   $GE_FinalHora=$q->dato(0);	  
	   $GE_FinalMinuto=$q->dato(1);	 
	   $GE_OBSERVACION =trim($q->dato(2)." ".$q->dato(3)." ".$q->dato(4)." ".$q->dato(5));	  
	   $GE_OBSAMBIENTAL =$q->dato(6);	
	   $GE_OBS1  =$q->dato(7);	
   
	}
}

?>
<form action="GuardarCierre.php" method="get" name="inicio">
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
 <input type="hidden"   name="Monstrar"      size="10"  maxlength="10" value="Cierre.php"> 
 <input type="hidden"   name="EnviarA"      size="10"  maxlength="10" value="MarcoFormatoBB.php">  
  <input type="hidden" name="GE_NO_INSPECCION" id="GE_NO_INSPECCION" size="5"  value="<?=$GE_NO_INSPECCION?>"/>
<table width="100%" border="0" align="center">
  <tr>
    <td><table width="101%" border="0">
      <tr>
                <td class="TituloG"><span class="TituloGrande">Hora de finalizacion de la inspeccion:</span>&nbsp;
                  <select name="GE_FinalHora" class="Cajones" id="GE_FinalHora">
          <option value=""></option>
		  <?
		  FOR($J=0;$J<=23;$J++)
		  {?>
          <option value="<?=$J?>" <? IF($J==$GE_FinalHora) echo "selected" ?> ><?=$J?></option>
          <?
		  }?>
        </select>
          :
          <select name="GE_FinalMinuto" class="Cajones" id="GE_FinalMinuto">
		   <option value=""></option>
		  <?
		  FOR($J=0;$J<60;$J++)
		  {?>
		   <option value="<?=$J?>" <? IF($J==$GE_FinalMinuto AND $GE_FinalMinuto <>"") echo "selected" ?> ><?=$J?></option>
		  <?
		  }?>
		</select>		</td>
      </tr>
      <tr>
        <td class="titulosGrandes"><span class="TituloGrande">Obs. inspector:</span></td>
      </tr>
      <tr>
        <td class="titulosGrandes"><p class="titulos">
            <textarea name="GE_OBSERVACION" cols="40" rows="5" class="Cajones" id="GE_OBSERVACION" onkeypress="javascript:return sinEnter(event)" ><?=utf8_decode($GE_OBSERVACION)?></textarea>
        </p>
          <p class="titulos">Observacion Inspector 2. </p>
          <p class="titulos">              
              <textarea name="GE_OBS1" cols="40" rows="5" onkeypress="javascript:return sinEnter(event)" ><?=utf8_decode($GE_OBS1)?></textarea>
              </p></td>
        </tr>
      <tr>
        <td><span class="TituloGrande">Obs.inspeccionado:</span></td>
      </tr>
      <tr>
        <td><span class="titulos">
          <textarea name="GE_OBSAMBIENTAL" cols="40" rows="5" class="Cajones" id="GE_OBSAMBIENTAL" onkeypress="javascript:return sinEnter(event)" ><?=utf8_decode($GE_OBSAMBIENTAL)?></textarea>
        </span></td>
        </tr>
    </table></td>
  </tr>
<?
$sql1="SELECT   IPAL_RES_INSPECCION.RES_CEDULA, IPAL_RES_INSPECCION.RES_NOMBRE, 
                      IPAL_RES_INSPECCION.RES_CARGO, EMPRESAS.EM_NOMBRE
			FROM         IPAL_RES_INSPECCION INNER JOIN
                      EMPRESAS ON IPAL_RES_INSPECCION.EM_ID = EMPRESAS.EM_ID
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
$q->ejecutar($sql1,248,'SubirPlano.php');	   
$q->Cargar();
$RES_CEDULA=$q->dato(0);
$RES_NOMBRE=$q->dato(1);
$RES_CARGO=$q->dato(2);
$EM_NOMBRE=$q->dato(3);

?>  
  <tr>
    <td><div align="center"><span class="titulosFondoGrisGrande">RESPONSABLE DE LA INSPECCION: 
      </span>
      <table border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td class="Cajones"><div align="left">Nombre:&nbsp;
                  <?=$RES_NOMBRE?>
              </div></td>
            </tr> 
        <tr>
          <td class="Cajones"><div align="left">Cedula:&nbsp;
                <?=$RES_CEDULA?>
            </div></td>
            </tr> 
        <td class="Cajones"><div align="left">Cargo:&nbsp;
                <?=$RES_CARGO?>
          </div></td>
            <tr> 
              <td class="Cajones"><div align="left">Empresa:&nbsp;
                  <?=$EM_NOMBRE?>
              </div></td>
            </tr>
                          </table>
    </div></td>
  </tr>
  <tr>
    <td><span class="titulos">
      <div align="center">
        <input type="submit" name="Submit" value="Finalizar" class="Cajones">
    </div></td>
  </tr> 
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</form>
