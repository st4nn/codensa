<!--
<link href="st/tools/jquerymobile.css" rel="stylesheet" type="text/css" />
<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
-->

  
<script type="text/javascript">
  $.mobile.document
      .on( "listviewcreate", "#EM_ID-menu", function( e ) {
        var input,
            listbox = $( "#EM_ID-listbox" ),
            form = listbox.jqmData( "filter-form" ),
            listview = $( e.target );
        if ( !form ) {
            input = $( "<input data-type='search'></input>" );
            form = $( "<form></form>" ).append( input );
            input.textinput();
            $( "#EM_ID-listbox" )
                .prepend( form )
                .jqmData( "filter-form", form );
        }
        listview.filterable({ input: input });
    })
    .on( "pagebeforeshow pagehide", "#EM_ID-dialog", function( e ) {
        var form = $( "#EM_ID-listbox" ).jqmData( "filter-form" ),
            placeInDialog = ( e.type === "pagebeforeshow" ),
            destination = placeInDialog ? $( e.target ).find( ".ui-content" ) : $( "#EM_ID-listbox" );
        form
            .find( "input" )
            .textinput( "option", "inset", !placeInDialog )
            .end()
            .prependTo( destination );
    });

   $.mobile.document
      .on( "listviewcreate", "#GE_MUNICIPIO-menu", function( e ) {
        var input,
            listbox = $( "#GE_MUNICIPIO-listbox" ),
            form = listbox.jqmData( "filter-form" ),
            listview = $( e.target );
        if ( !form ) {
            input = $( "<input data-type='search'></input>" );
            form = $( "<form></form>" ).append( input );
            input.textinput();
            $( "#GE_MUNICIPIO-listbox" )
                .prepend( form )
                .jqmData( "filter-form", form );
        }
        listview.filterable({ input: input });
    })
    .on( "pagebeforeshow pagehide", "#GE_MUNICIPIO-dialog", function( e ) {
        var form = $( "#GE_MUNICIPIO-listbox" ).jqmData( "filter-form" ),
            placeInDialog = ( e.type === "pagebeforeshow" ),
            destination = placeInDialog ? $( e.target ).find( ".ui-content" ) : $( "#GE_MUNICIPIO-listbox" );
        form
            .find( "input" )
            .textinput( "option", "inset", !placeInDialog )
            .end()
            .prependTo( destination );
    });
  function Contratos_MasInfo_Click(IdContrato)
  {
    
    if ($("#artContrato_"+ IdContrato).attr("estado") == 'Cerrado')
    {
      $("#artContrato_"+ IdContrato).css("height", "auto");  
      $("#artContrato_"+ IdContrato).attr("estado", "Abierto") ;
    } else
    {
      $("#artContrato_"+ IdContrato).attr("estado", "Cerrado") ;
      $("#artContrato_"+ IdContrato).css("height", "7em");  
    }
  }
  function Contratos_Article_Click(IdContrato)
  {
    if (!IdContrato)
    {
     IdContrato = '' ;
    }
    $(".Contratos_Seleccionado").addClass("Contratos_SinSeleccionar");

    $(".Contratos_Seleccionado").removeClass("Contratos_Seleccionado");

    $("#EC_ID").val(IdContrato);
    //$("#EC_ID").selectmenu("refresh");
    $("#artContrato_" + IdContrato).removeClass("Contratos_SinSeleccionar");
    $("#artContrato_" + IdContrato).addClass("Contratos_Seleccionado");
  }

  function CargarContratos_()
    {
      var idEmpresa = $("#EM_ID").val();
      $("#Formato_tdEM_ID article").remove();
        $.post("obtenerContratos2.php", {Empresa: idEmpresa}, function(data)
          {
            var article = "";
            var ClassSelecionado = "Contratos_Seleccionado";
              $.each(data, function(index, value)
              {
                if (index > 0 && ClassSelecionado != "Contratos_SinSeleccionar")
                {
                  ClassSelecionado = "Contratos_SinSeleccionar";
                }
                article += "<article id='artContrato_" + value.IdContrato + "' onclick='Contratos_Article_Click("+ value.IdContrato +")' class='" + ClassSelecionado + "' estado='Cerrado'><span class='Contratos_MasInfo' onclick='Contratos_MasInfo_Click("+ value.IdContrato+ ")'>Mas info</span><h2>" + value.Nombre + "</h2><p>" + value.Descripcion.toLowerCase() + "</p></article>";
              });
              
              $("#Formato_tdEM_ID").append(article);
              
          }, "json");
    }

  function DiligenciandoFecha()
  {
    var tmpFecha = $("#GE_Fecha").val();
    $("#GE_AAA").val(tmpFecha.substring(0,4))
    $("#GE_MES").val(tmpFecha.substring(5,7))
    $("#GE_DIA").val(tmpFecha.substring(8,10))
  }

  function DiligenciandoHora()
  {
    var tmpHora = $("#GE_HoraInicio").val();
   
    $("#GE_InicioHora").val(tmpHora.substring(0,2));
    $("#GE_InicioMinuto").val(tmpHora.substring(3,5));

    $("#GE_InicioHora").selectmenu("refresh");
    $("#GE_InicioMinuto").selectmenu("refresh");
  }
  
</script>
<?


include "include/VarGlobales.PHP"; 
require("include/BdSqlClases.php");

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);



$SQL="SELECT     USB_NOMBRE,  EM_ID, USB_CARGO
        FROM         IPAL_USUARIOS_BB
               WHERE  USB_CEDULA=$usr"; 
$q->ejecutar($SQL,18,'EnviarCorreo.php');    
$q->Cargar();
$USB_NOMBRE=$q->dato(0);


    $SQL="SELECT COUNT(*) FROM IPAL WHERE   (GE_BVERIFTERRENO = 'INICIO')
      AND  (USR_DIGITA ='".$usr."' or USR_DIGITA ='".$USB_NOMBRE."')";
    $q->ejecutar($SQL,156,'MarcoFormatoBB.php');     
    $q->Cargar();
    $ENINICIO=$q->dato(0);

//IF($ENINICIO

if($GE_NO_INSPECCION<>"")
{


   $sql1="SELECT  convert(varchar(10),GE_FECHA,120), GE_MOVIL, GE_PLACA, GE_TIPOVEHICULO, GE_TRAB_AREALIZAR, PR_ID, 
                      GE_AREACODENSA, DATEPART(hh,GE_HINICIO),    DATEPART(mi,GE_HINICIO),EC_ID, GE_DIRECCION AS DATO16,
           YEAR(GE_FECHA), MONTH(GE_FECHA), DAY(GE_FECHA),
            GE_PGRUA,   GE_PCANASTA, GE_PMOTO, GE_TIPONO, GE_NO, GE_MUNICIPIO, GE_TINSPECCION,GE_CTO, GE_VFALLIDA, GE_TCOPILOTO
      FROM         IPAL
       WHERE  GE_NO_INSPECCION=$GE_NO_INSPECCION";
     $q->ejecutar($sql1,86,'BuscarGuia.php');    
   while($q->Cargar())
  { 
     $GE_FECHA=$q->dato(0);
     $GE_MOVIL=$q->dato(1);
     $GE_PLACA=$q->dato(2);
     $GE_TIPOVEHICULO=$q->dato(3);
     $GE_TRAB_AREALIZAR=utf8_decode($q->dato(4));
     $PR_ID=$q->dato(5);
     //$GE_AREACODENSA=$q->dato(6);

     $GE_InicioHora=$q->dato(7);
     $GE_InicioMinuto=$q->dato(8);    
     $EC_ID=$q->dato(9);   
     $GE_DIRECCION=utf8_decode($q->dato(10));                
   
     $GE_AAA=$q->dato(11);                 
     $GE_MES=$q->dato(12);                 
     $GE_DIA=$q->dato(13); 

     if (strlen($GE_DIA) == 1) 
     {
        $GE_DIA = "0$GE_DIA";
     }
     if (strlen($GE_MES) == 1) 
     {
        $GE_MES = "0$GE_MES";
     }
     
     $GE_PGRUA=$q->dato(14);                 
     $GE_PCANASTA=$q->dato(15);                
     $GE_PMOTO=$q->dato(16);  
     $GE_TIPONO=$q->dato(17); 
     $GE_NO=$q->dato(18);          
     $GE_MUNICIPIO=$q->dato(19);  
     $GE_TINSPECCION= $q->dato(20); 
     $GE_CTO= $q->dato(21); 
       $GE_VFALLIDA = $q->dato(22);   
      $GE_TCOPILOTO = $q->dato(23);
     
  }
  if($EC_ID<>"")
  {
    $sql="SELECT DISTINCT EMPRESAS.EM_ID,  EMPRESA_CONTRATOS.EC_CONTRATO, EMPRESA_CONTRATOS.EC_Descripcion
      FROM         EMPRESA_CONTRATOS INNER JOIN
                      EMPRESAS ON EMPRESA_CONTRATOS.EM_ID = EMPRESAS.EM_ID
    WHERE     (EMPRESA_CONTRATOS.EC_ID = $EC_ID)";
    $q->ejecutar($sql,86,'BuscarGuia.php');    
    $q->Cargar();
    $EM_ID=$q->dato(0);
    $EC_CONTRATO=$q->dato(1);
    $EC_Descripcion=utf8_encode($q->dato(2));
  }   
}
else
{
    $sql1="SELECT  max(GE_NO_INSPECCION) +1
      FROM         IPAL" ;
     $q->ejecutar($sql1,86,'BuscarGuia.php');    
   $q->Cargar();
     $GE_NO_INSPECCIONNueva=$q->dato(0);
   if($GE_NO_INSPECCIONNueva<150000)
      $GE_NO_INSPECCIONNueva=150000;
   else 
        $GE_NO_INSPECCIONNueva=$q->dato(0);
}

if($GE_AAA=="")$GE_AAA=date(Y);                
if($GE_MES=="")$GE_MES=date(m);
if($GE_DIA=="")$GE_DIA=date(d);

if($GE_InicioHora=="")$GE_InicioHora=date(H)-1;
if($GE_InicioMinuto=="")$GE_InicioMinuto=date(m);

if( strlen($GE_InicioHora) == 1)
{
  $GE_InicioHora = "0$GE_InicioHora";
}
if( strlen($GE_InicioMinuto) == 1)
{
  $GE_InicioMinuto = "0$GE_InicioMinuto";
}

?>
<form action="GuardarInicioBB.php" method="get" name="inicio" onsubmit="return valideInicio()">
  
  
 <input type="hidden"   name="us_menu"  size="10"  maxlength="10" value="<?=$us_menu?>">
 <input type="hidden"   name="usr"      size="10"  maxlength="10" value="<?=$usr?>">
 <input type="hidden"   name="Monstrar"      size="10"  maxlength="10" value="FormatoBB2.php"> 
 <input type="hidden"   name="EnviarA"      size="10"  maxlength="10" value="MarcoFormatoBB2.php">  
 <input type="hidden"   name="nuevo"      size="10"  maxlength="10" value="<?=$nuevo?>">
 
<table width="100%" border="0" align="center">
  <tr>
    <td><table width="100%" border="0">
      
      <tr>
        <td width="67%"><table width="100%" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="4" align="left"><?
              if($GE_NO_INSPECCION=="")
              {?>
        No de inspeccion:&nbsp;
       <!--<input name="GE_NO_INSPECCION" type="text"  id="GE_NO_INSPECCION" size="15"  class="titulosRojoGrande" onkeypress="javascript:return solonumeros(event)"  value=""/>-->
  TEMP:<?=$GE_NO_INSPECCIONNueva?>

  <?
               }
               else
               {
                  ?>
  <input type="hidden" name="GE_NO_INSPECCION" id="GE_NO_INSPECCION" size="5"   class="Cajones" value="<?=$GE_NO_INSPECCION?>"/>
  <?
               }?>
&nbsp;</td>
          </tr>
          <tr>
            <td colspan="1" width='20%' align="center">
                <div align="left">Fecha Inspeccion</div>
            </td>
            <td colspan='2' width='60%' align="center">
              <input type="date" id="GE_Fecha" onchange='DiligenciandoFecha()' value='<? echo "$GE_AAA-$GE_MES-$GE_DIA"; ?>'/>
            </td>
            <td width='20%' colspan='2'>
              <input type="checkbox" name="GE_VFALLIDA" id="GE_VFALLIDA" <? if($GE_VFALLIDA=='SI') ECHO "checked"?>>
              <label for="GE_VFALLIDA">Ins. Fallida</label>
            </td>

          </tr>
          <tr>
            <td id='CamposFecha' colspan='2' class='noVer'>
              <span>Año:</span>
              <input name="GE_AAA" type="text" class="Cajones" id="GE_AAA" size="4" maxlength="4" readonly value="<?=$GE_AAA?>"/>
              <span>Mes:</span>
              <input name="GE_MES" type="text" class="Cajones" id="GE_MES" size="2" maxlength="2" readonly value="<?=$GE_MES?>"/>
              <span>Día:</span>
              <input name="GE_DIA" type="text" class="Cajones" id="GE_DIA" size="2" maxlength="2" readonly value="<?=$GE_DIA?>"/>
            </td>
          </tr>
          <tr>
            <td width="50%" colspan="2" align="left">
              <span class="titulosGrandes">Tipo de inspeccion:</span> 
              <select name="GE_TINSPECCION" class="titulosGrandes" id="GE_TINSPECCION" >
                <option value="">Seleccione</option>        
                <option value="CONTROL REDES"  <? IF($GE_TINSPECCION=='CONTROL REDES') echo "selected"?> >CONTROL REDES</option>
                <option value="PRL"  <? IF($GE_TINSPECCION=='PRL') echo "selected"?>  >PRL</option>
              </select>
            </td>
            <td width="50%" colspan="2">  
              <span>Tipo:</span>
                <select name="GE_TCOPILOTO" class="titulosGrandes" id="GE_TCOPILOTO" >
                  <option value='Inspeccion' <? IF($GE_TCOPILOTO=='Inspeccion') echo "selected"?> >Inspeccion</option>
                  <option value='Copiloto' <? IF($GE_TCOPILOTO=='Copiloto') echo "selected"?>>Copiloto</option>
                </select>
            </td>
            </tr>
          <tr>
            <td  colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="21%"><span class="TituloGrande">Hora inicial (Militar) </span></td>
                <td width="25%">
                  <input type='time' id='GE_HoraInicio' onchange='DiligenciandoHora()' value='<? echo "$GE_InicioHora:$GE_InicioMinuto";?>'/>
                </td>
                <td class="noVer">
                  <select name="GE_InicioHora" id='GE_InicioHora' >
                    <option value=""></option>
                    <?
                      FOR($J=0;$J<=23;$J++)
                      {
                        $k = $J;
                        if (strlen($k) == 1)
                        {
                          $k = "0$k";
                        }
                    ?>

                        <option value='<?=$k?>' <? IF($k==$GE_InicioHora) echo "selected" ?> ><?=$k?></option>
                        <?
                    }?>
                  </select>
          :
          <select name="GE_InicioMinuto" id='GE_InicioMinuto' class="noVer">
       <option value=""></option>
      <?
      FOR($J=1;$J<=60;$J++)
      {
         $k = $J;
                        if (strlen($k) == 1)
                        {
                          $k = "0$k";
                        }
      ?>
       <option value="<?=$k?>" <? IF($k==$GE_InicioMinuto AND $GE_InicioMinuto <>"") echo "selected" ?> ><?=$k?></option>
      <?
      }?>
    </select></td>
                <td width="10%" class="TituloGrande">No de cto:</td>
                <td width="44%"><label for="textfield"></label>
                  <input name="GE_CTO" type="text" class="Cajones" id="GE_CTO"   value="<?=$GE_CTO?>" size="15"/>
                </td>
                  
              </tr>
            </table>              &nbsp;</td>
          </tr>
         
        </table></td>
        </tr>
      <tr>
        <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
          <tr>
             <td width="14%" class="TituloGrande"  align="left">Empresa:</td> 
            <td align="left">
                 <select name="EM_ID" id="EM_ID" onchange="CargarContratos_();CargarContratos(EM_ID.value, this.id,'Cajones');" data-native-menu="false">
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
                    <?=utf8_encode($q->dato(1))?>
                    </option>
                     <?
          }  
          ?>
                   </select>              </div></td>
            <td width="0%">&nbsp;</td>
          </tr>
          <tr>
<td width="14%" class="TituloGrande"><div align="left" >No contrato </div></td>
                <td id="Formato_tdEM_ID"width="86%"><div align="left">
                  <div class='noVer'>
                    <select name="EC_ID" id="EC_ID"  >
                      <option value=""></option>
                      <? if($EC_ID<>"") 
                        { 
                      ?><option value="<?=$EC_ID?>"  selected="selected"><?=$EC_CONTRATO?></option>
                      <?
                        }
                      ?> 
                    </select>
                  </div>
                      <? if($EC_ID<>"") 
                        { 
                      ?><article id="artContrato_<?=$EC_ID?>" onclick="Contratos_Article_Click(<?=$EC_ID?>)" class="Contratos_Seleccionado" estado="Cerrado"><span class="Contratos_MasInfo" onclick="Contratos_MasInfo_Click(<?=$EC_ID?>)">Mas info</span><h2><?=$EC_CONTRATO?></h2><p><?=$EC_Descripcion?></p></article>
                      <?
                        }
                      ?> 
                    
                  </div>
                </td>
          </tr>
          <tr>
            <td width="14%" class="TituloGrande"><div align="left" >Direcci&oacute;n</div></td>
            <td width="86%" align="left"><input name="GE_DIRECCION" id="GE_DIRECCION" type="text" class="Cajones" size="30" value="<?=$GE_DIRECCION?>" /> </td>
          </tr>
       <tr>
            <td width="14%" class="TituloGrande" align="left">Municipio</td>
      <td align="left"> <select name="GE_MUNICIPIO" id="GE_MUNICIPIO" data-native-menu="false">
                  <option value=""  ></option>        
                <?
         $SQL="SELECT     MUNICIPIO
            FROM         IPAL_MUNICIPIOS
            ORDER BY MUNICIPIO";
         $q->ejecutar($SQL,129,'Formato.php');     
           while($q->Cargar())
           { 
             ?>
                    <option value="<?=utf8_encode($q->dato(0))?>" <? IF($GE_MUNICIPIO==$q->dato(0)) echo "selected"?> ><?=utf8_encode($q->dato(0))?></option>
                     <?
          }     
        ?>
      
                </select></td>
       </tr>  
        </table></td>
        </tr>
      
      <tr>
        <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
          <tr>
            <td width="112" class="TituloGrande"><div align="left">Trabajo a realizar </div></td>
            <td colspan="2" class="TituloGrande"><div align="left">
                <input name="GE_TRAB_AREALIZAR"  id="GE_TRAB_AREALIZAR" type="text" class="Cajones" size="40" value="<?=$GE_TRAB_AREALIZAR?>" />
            </div></td>
          </tr>
          <tr>
            <td class="TituloGrande">Proceso</td>
            <td width="192" ><select name="PR_ID" id="PR_ID"  class="Cajones"  >
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
                <?=utf8_encode($q->dato(0)."-".$q->dato(1))?>
                </option>
              <?
          }  
          ?>
            </select></td>
            <td width="859" class="TituloPN">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3" class="TituloPN"><div align="left">
              <table width="100%" border="0">
                <tr>
                  <td width="4%" class="TituloGrande">Tipo</td>
                  <td width="15%" ><label>
                    <select name="GE_TIPONO" class="Cajones" id="GE_TIPONO">
            <option value="" >Seleccione</option>
            <option value="INCIDENCIA" <? if($GE_TIPONO=='INCIDENCIA') echo "selected" ?> >INCIDENCIA</option>
                      <option value="DESCARGO" <? if($GE_TIPONO=='DESCARGO') echo "selected" ?> >DESCARGO</option>
                      <option value="ORDEN DE TRABAJO"  <? if($GE_TIPONO=='ORDEN DE TRABAJO') echo "selected" ?>>ORDEN DE TRABAJO</option>
                    </select>
                  </label></td>
                  <td width="4%" class="TituloGrande">No </td>
                  <td width="77%"><label>
                    <input name="GE_NO" type="text" class="Cajones" id="GE_NO" size="15"  value="<?=$GE_NO?>"/>
                  </label></td>
                </tr>
              </table>
            </div>              <div align="left"></div></td>
            </tr>
        </table></td>
        </tr>
      
    </table></td>
  </tr>
  <tr>
    <td><table border="1" cellpadding="0" cellspacing="0">
      <tr>
        <td class="TituloGrande">ce/Avantel</td>
        <td class="TituloGrande">Tipo Vehiculo </td>
        <td class="TituloGrande">Placa Vehiculo </td>
      </tr>
      <tr>
        <td class="TituloG"><input name="GE_MOVIL" type="text" class="Cajones"  id="GE_MOVIL" value="<?=$GE_MOVIL?>" size="15"  onkeypress="javascript:return numerosAteristoRaya(event)"/></td>
        <td class="TituloG">
    <select name="GE_TIPOVEHICULO"  id="GE_TIPOVEHICULO" class="Cajones" >
      <option value="">Selecione</option>   
      <option value="CAMIONETA" <? if($GE_TIPOVEHICULO=='CAMIONETA') echo "selected"?> >CAMIONETA</option>
      <option value="CAMPERO"   <? if($GE_TIPOVEHICULO=='CAMPERO') echo "selected"?>>CAMPERO</option>
      <option value="CARRIE"    <? if($GE_TIPOVEHICULO=='CARRIE') echo "selected"?>>CARRIE</option>
      <option value="FURGON"    <? if($GE_TIPOVEHICULO=='FURGON') echo "selected"?>>FURGON</option>
      
      <option value="GRUA"    <? if($GE_TIPOVEHICULO=='GRUA') echo "selected"?>>GRUA</option>
      <option value="CANASTA"    <? if($GE_TIPOVEHICULO=='CANASTA') echo "selected"?>>CANASTA</option>
      <option value="MOTO"    <? if($GE_TIPOVEHICULO=='MOTO') echo "selected"?>>MOTO</option>                 
    </select></td>
        <td class="TituloG"><input name="GE_PLACA"    id="GE_PLACA" type="text" class="Cajones"  value="<?=$GE_PLACA?>" size="10" /></td>
      </tr>
      <tr>
        <td class="TituloGrande">Placa Grua </td>
        <td class="TituloGrande">PlacaCanasta</td>
        <td class="TituloGrande">Placa Moto </td>
      </tr>
      <tr>
        <td class="TituloG"><input name="GE_PGRUA"    id="GE_PGRUA" type="text" class="Cajones" size="10"  value="<?=$GE_PGRUA?>"/></td>
        <td class="TituloG"><input name="GE_PCANASTA" id="GE_PCANASTA" type="text" class="Cajones" size="10"  value="<?=$GE_PCANASTA?>"/></td>
        <td class="TituloG"><input name="GE_PMOTO"    id="GE_PMOTO" type="text" class="Cajones" size="10"  value="<?=$GE_PMOTO?>"/></td>
      </tr>       
    </table></td>
  </tr>
  
  
  
  <tr>
    <td><span class="titulos">
      <div align="center">
        <input name="Submit" type="submit" class="Cajones" value="Guardar">
    </div></td>
  </tr> 
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</form>
