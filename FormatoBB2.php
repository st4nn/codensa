<!--
<link href="st/tools/jquerymobile.css" rel="stylesheet" type="text/css" />
<link href="css/csstyles.css" rel="stylesheet" type="text/css" />
-->

  
<script type="text/javascript">
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
  
  <select id="filter-menu" data-native-menu="false">
        <option value="">Seleccione</option>
        <option value="110"> NSL </option>
        <option value="131">A.G.W.A.</option>
        <option value="5003">ABB</option>
        <option value="10">AC &amp; JM UNION TEMPORAL</option>
        <option value="5015">AC INGENIERIA</option>
        <option value="11">ACCIONES Y SERVICIOS S.A</option>
        <option value="116">ACER</option>
        <option value="5005">ACUSTEC</option>
        <option value="12">ADMINISTRAMOS Y TRANSPORTAMOS EU- AT SAS</option>
        <option value="8">AENCO S.A.S.(POSTRATAR LTDA)</option>
        <option value="13">AENE SERVICIOS S.A.</option>
        <option value="5007">AGROELECTRONICO</option>
        <option value="160">AGUAS DE CARTAGENA</option>
        <option value="14">AINPRO S.A.</option>
        <option value="113">AIRES TERMICOS</option>
        <option value="161">ALMAVIVA GLOBAL</option>
        <option value="15">ALMAVIVA S.A.</option>
        <option value="16">ALSTOM COLOMBIA S.A.</option>
        <option value="17">ANDICALL S.A</option>
        <option value="18">APPLUS COLOMBIA LTDA</option>
        <option value="125">ARINDEC</option>
        <option value="5022">ARSEG</option>
        <option value="122">ASEO COLBA</option>
        <option value="129">ASOPROGA</option>
        <option value="107">AT SAS</option>
        <option value="20">ATENTO COLOMBIA S.A.</option>
        <option value="120">AUTOMATIZACION AVANZADA</option>
        <option value="133">BIOTAR</option>
        <option value="162">BLASTINGMAR</option>
        <option value="5018">C Y M INGENIEROS</option>
        <option value="5002">C.I.C.</option>
        <option value="96">CALIDAD DE ENERGIA CIDET</option>
        <option value="114">CALORCOL</option>
        <option value="23">CAM</option>
        <option value="21">CAMCO INGENIERÍA S.A.</option>
        <option value="163">CDI</option>
        <option value="3">CENERCOL</option>
        <option value="92">CITY LIGHTS LTDA</option>
        <option value="2">CODENSA</option>
        <option value="101">COLMAQUINAS</option>
        <option value="22">COLTEMPORA</option>
        <option value="5030">COMPAÑIA COLOMBIANA DE LINEA VIVA</option>
        <option value="24">COMPAÑÍA NAVIERA DEL GUAVIO LIMITADA</option>
        <option value="25">COMPASS GROUP SERVICES COLOMBIA</option>
        <option value="5001">COMTECOL</option>
        <option value="104">CONSORCIO CANTERA MINA</option>
        <option value="26">CONSORCIO EDIFICAR</option>
        <option value="4">CONSORCIO FORESTAL NACIONAL</option>
        <option value="5">CONSORCIO GESAR</option>
        <option value="27">CONSORCIO ICBM</option>
        <option value="28">CONSORCIO MECAM</option>
        <option value="102">CONSORCIO OBRAS CIVILES</option>
        <option value="29">CONSORCIO SERINGEL-CAM</option>
        <option value="30">CONSORCIO SL</option>
        <option value="126">CONSTRUCTORA LANDA</option>
        <option value="5029">consultores regionales asociados</option>
        <option value="32">CONSULTORES UNIDOS S.A.</option>
        <option value="33">CONTACT CENTER AMERICAS S.A.</option>
        <option value="34">COOMTRANSCOL LTDA</option>
        <option value="35">COOPSER</option>
        <option value="36">COOPSER &amp; JMSEDINKO UNION TEMPORAL</option>
        <option value="37">COOPTAS</option>
        <option value="38">CORPORACION SUNA HISCA</option>
        <option value="31">CRA S.A.</option>
        <option value="105">CTMI COMPAÑIA TECNICA DE MONTAJES INDUSTRIALES</option>
        <option value="39">D&amp;P INGENIERIA LTDA</option>
        <option value="40">DASIGNO S.A</option>
        <option value="41">DELTEC S.A.</option>
        <option value="97">ECI</option>
        <option value="42">ECONOMETRIA S.A.</option>
        <option value="94">ECTRICOL LTDA</option>
        <option value="135">EMGESA</option>
        <option value="43">ESINCO S.A. ESTUDIOS DE INGENIERIA Y CONSTRUCCIONES</option>
        <option value="123">FIBRA REDES CONSTRUCCIONES S A S - F IRCON SAS</option>
        <option value="128">FUNDACION ESPELETIA</option>
        <option value="44">FUNDACION NATURA</option>
        <option value="45">FYR INGENIEROS Ltda.</option>
        <option value="46">GRUPO CONSULTOR ANDINO S.A.</option>
        <option value="119">GRV GROUP</option>
        <option value="111">H Y H SERVING S.A.S</option>
        <option value="5009">H.A.G CONSTRUCCIONES</option>
        <option value="134">HIDRAULICA Y NEUMATICA</option>
        <option value="47">HOMBRESOLO S.A.</option>
        <option value="48">INDRA COLOMBIA LTDA</option>
        <option value="5024">INERCO</option>
        <option value="49">INGEAL S.A.</option>
        <option value="50">INGENIERIA &amp; MONTAJES ELECTRICOS - IME</option>
        <option value="51">INGENIERIA Y DISEÑOS S.A</option>
        <option value="5033">INGENIERÍA Y MONTAJES ELECTROMECÁNICOS S.A. INMEL</option>
        <option value="118">INGENSER</option>
        <option value="5023">INGENSER SAS</option>
        <option value="5008">INGERSERTEC SA</option>
        <option value="52">INGETEC INGENIERIA &amp; DISEÑO S.A.</option>
        <option value="6">INGEVESA S.A</option>
        <option value="108">IQS</option>
        <option value="53">ITELCA S.A.S.</option>
        <option value="54">JF ARQUITECTURA E INTERIORES LTDA</option>
        <option value="55">JM SEDINKO LTDA</option>
        <option value="56">JM SEDINKO Y AC ENERGY UNION TEMPORAL</option>
        <option value="57">JOSE JAIRO SERRATO EU</option>
        <option value="98">JRE INGENIERIA</option>
        <option value="5011">KONECRANES</option>
        <option value="112">LBG MANTENIMIENTO</option>
        <option value="5013">LEAR</option>
        <option value="90">LIGHT COLORS SERVICE E.U.</option>
        <option value="5031">LIGHT COLORS SERVICE S.A.S</option>
        <option value="130">LITO</option>
        <option value="150">LITO LTDA</option>
        <option value="60">LUBECK SECURITY LTDA.</option>
        <option value="117">LUIS ALEJANDRO RODRIGUEZ</option>
        <option value="115">LUIS CAUCALI</option>
        <option value="5032">mecm</option>
        <option value="61">MECM PROFESIONALES CONTRATISTAS</option>
        <option value="91">MHEV INGENIERIA LTDA</option>
        <option value="7">MICOL S.A.</option>
        <option value="5028">MOVITEC</option>
        <option value="5006">NACIONAL DE SERVICIOS</option>
        <option value="99">NSL CONSTRUCCIONES</option>
        <option value="63">OBRAS Y DISEÑOS S.A.</option>
        <option value="93">ODINEC S.A </option>
        <option value="64">ORGANIZACION SERIN LTDA</option>
        <option value="5004">ORINDEC</option>
        <option value="65">PARRILL CAPELONE CATERING</option>
        <option value="66">PETROCASINOS S.A.</option>
        <option value="5017">PLANDEPRO</option>
        <option value="67">POWER ENGINEERING &amp; COMMISSIONIG SERVICES S.A. PECS</option>
        <option value="68">PRESENCIA PROFESIONAL</option>
        <option value="5012">PROCARBON</option>
        <option value="69">PROMIGAS S.A,ESP</option>
        <option value="124">PROSEGUR TECNOLOGÍA S.A.S </option>
        <option value="70">PROYECONT LTDA.</option>
        <option value="100">PROYTEC</option>
        <option value="95">R&amp;M INGENIERIA S.A.S.</option>
        <option value="71">REFRATECMIC S.A.</option>
        <option value="5014">RICARDO MESTIZO</option>
        <option value="72">ROBOTEC COLOMBIA S.A.</option>
        <option value="5020">SEGURIDAD ELECTRICA</option>
        <option value="73">SEGURIDAD TECNICA SETECSA</option>
        <option value="74">SERGETEQ</option>
        <option value="103">SERINGEL</option>
        <option value="75">SERVIASEO CARTAGENA S.A.</option>
        <option value="76">SERVICIOS ASOCIADOS LTDA</option>
        <option value="77">SERVICIOS PARRA Y HERNANDEZ</option>
        <option value="78">SGS COLOMBIA S.A.</option>
        <option value="5025">SIEMENS</option>
        <option value="5019">SION S.A</option>
        <option value="106">SIPT LTDA</option>
        <option value="79">SNERGY CONTACT</option>
        <option value="88">SYM INGENIEROS</option>
        <option value="136">SYNAPSIS</option>
        <option value="5016">T Y E ACCESORIOS ELECTRICOS</option>
        <option value="80">TELEDATOS</option>
        <option value="81">THOMAS GREG EXPRESS S.A.</option>
        <option value="5010">TRACOL</option>
        <option value="82">TRANSENELEC S.A.</option>
        <option value="83">TRANSPORTES CALDERON</option>
        <option value="5026">TRANSPORTES ESPECIALIZADOS JR S.A.S</option>
        <option value="84">TRANSPORTES ISGO</option>
        <option value="5021">UNION TEMPORAL GALAXTET</option>
        <option value="85">UNION TEMPORAL NUEVA ERA LTDA - COSERVIPP LTDA</option>
        <option value="127">UNION TEMPORAL NUEVA ESPERANZA 115kV</option>
        <option value="121">UNION TEMPORAL TRENDICON</option>
        <option value="109">UT OML-PIL</option>
        <option value="132">VANEGAS INGENIEROS</option>
        <option value="5027">VANSOLIX</option>
        <option value="86">VILLA HERNANDEZ Y CIA</option>
        <option value="87">XEROX DE COLOMBIA S.A.</option>
    </select>
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
            <td colspan="4" class="titulosRojoGrande" align="left"><?
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
              <input type="date" id="GE_Fecha" onchange='DiligenciandoFecha()' value='<? echo "$GE_AAA-$GE_MES-$GE_DIA" ?>'/>              </td>
              <!--<div align="left">Ins. Fallida<input name="GE_VFALLIDA" type="checkbox" value="1" <? if($GE_VFALLIDA=='SI') ECHO "checked"?>></div>-->
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
              <input name="GE_MES" type="text" class="Cajones" id="GE_MES" size="1" maxlength="2" readonly value="<?=$GE_MES?>"/>
              <span>Día:</span>
              <input name="GE_DIA" type="text" class="Cajones" id="GE_DIA" size="1" maxlength="2" readonly value="<?=$GE_DIA?>"/>
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
                  <input name="GE_CTO" type="text" class="Cajones" id="GE_CTO"   value="<?=$GE_CTO?>" size="15"/></td>
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
                 <select name="EM_ID" id="EM_ID"  class="Cajones"  onchange="CargarContratos(EM_ID.value, this.id,'Cajones')">
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
                <td width="86%"><div align="left">
                  <select name="EC_ID" id="EC_ID" class="Cajones" >
          <option value=""></option>
          <? if($EC_ID<>"") 
            { 
              ?><option value="<?=$EC_ID?>"  selected="selected"><?=$EC_CONTRATO?></option><?
            }?> 
          </select>
                </div></td>
          </tr>
          <tr>
            <td width="14%" class="TituloGrande"><div align="left" >Direcci&oacute;n</div></td>
            <td width="86%" align="left"><input name="GE_DIRECCION" id="GE_DIRECCION" type="text" class="Cajones" size="30" value="<?=$GE_DIRECCION?>" /> </td>
          </tr>
       <tr>
            <td width="14%" class="TituloGrande" align="left">Municipio</td>
      <td align="left"> <select name="GE_MUNICIPIO" id="GE_MUNICIPIO" class="Cajones">
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
