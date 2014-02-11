<?	 
header("Content-Type: text/html;charset=utf-8");
include "include/VarGlobales.PHP"; 
require("include/BdSqlClases.php");

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);

$GE_FECHA=$GE_AAA."-".$GE_MES."-".$GE_DIA;



 if($GE_HINICIO<>"")$GE_HINICIO="convert(datetime, '".$GE_FECHA." ".$GE_HINICIO."',120)";
 else $GE_HINICIO='null';

 if($GE_HFINALIZACION<>"")$GE_HFINALIZACION="convert(datetime, '".$GE_FECHA." ".$GE_HFINALIZACION."',120)";
 else $GE_HFINALIZACION='null';



 if($GE_FECHA<>"")$GE_FECHA="convert(datetime, '".$GE_FECHA."',120)";
 else $GE_FECHA='null';

 if($GE_DIRECCION<>"")$GE_DIRECCION="'".$GE_DIRECCION."'";
 else $GE_DIRECCION='null';


 if($GE_TRAB_AREALIZAR<>"")$GE_TRAB_AREALIZAR="'".$GE_TRAB_AREALIZAR."'";
 else $GE_TRAB_AREALIZAR='null';


 if($GE_MOVIL<>"")$GE_MOVIL="'".$GE_MOVIL."'";
 else $GE_MOVIL='null';

 if($GE_PLACA<>"")$GE_PLACA="'".$GE_PLACA."'";
 else $GE_PLACA='null';

 if($GE_PGRUA<>"")$GE_PGRUA="'".$GE_PGRUA."'";
 else $GE_PGRUA='null';

 if($GE_PCANASTA<>"")$GE_PCANASTA="'".$GE_PCANASTA."'";
 else $GE_PCANASTA='null';

 if($GE_PMOTO<>"")$GE_PMOTO="'".$GE_PMOTO."'";
 else $GE_PMOTO='null';


 if($GE_TIPOVEHICULO<>"")$GE_TIPOVEHICULO="'".utf8_encode($GE_TIPOVEHICULO)."'";
 else $GE_TIPOVEHICULO='null';


 
/*  if($GE_AREACODENSA<>"")$GE_AREACODENSA="'".$GE_AREACODENSA."'";
 else $GE_AREACODENSA='null';
*/

  if(trim($GE_OBSERVACION)<>"")$GE_OBSERVACION="'".$GE_OBSERVACION."'";
 else $GE_OBSERVACION='null';

  if(trim($GE_OBSAMBIENTAL)<>"")$GE_OBSAMBIENTAL="'".$GE_OBSAMBIENTAL."'";
 else $GE_OBSAMBIENTAL='null';

  if($GE_TIPONO<>"")$GE_TIPONO="'".$GE_TIPONO."'";
 else $GE_TIPONO='null';


  if($GE_NO<>"")$GE_NO="'".$GE_NO."'";
 else $GE_NO='null';


  if($GE_MUNICIPIO<>"")$GE_MUNICIPIO="'".utf8_decode($GE_MUNICIPIO)."'";
 else $GE_MUNICIPIO='null';

  if($GE_NODELFOS<>"")$GE_NODELFOS="'".$GE_NODELFOS."'";
 else $GE_NODELFOS='null';


  if($EC_ID=="") $EC_ID='null';
 
 
 

$sql1="SELECT   1
			FROM         IPAL
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	  $q->ejecutar($sql1,76,'GuardarInicio.php');	   
	  $Nofilas=$q->filas();	   
	  if($Nofilas==0)
	  {  // ,   ,
	    $sql2="insert into IPAL (GE_NO_INSPECCION,GE_FECHA,  GE_DIRECCION,  GE_FAUTOMATICA, GE_MOVIL, GE_PLACA, GE_TIPOVEHICULO, 
                      GE_TRAB_AREALIZAR, PR_ID,  GE_HINICIO, GE_HFINALIZACION, GE_OBSERVACION,GE_OBSAMBIENTAL, GE_RESINSP_AMB, 
                      GE_RESINSP_SEG, USR_DIGPC, EC_ID, GE_PGRUA, GE_PCANASTA, GE_PMOTO, 
					  GE_TIPONO, GE_NO, GE_MUNICIPIO, GE_TINSPECCION, GE_BPC, GE_BVERIFTERRENO, GE_OBSERVACION, GE_OBSAMBIENTAL, GE_NODELFOS)
					 VALUES($GE_NO_INSPECCION, $GE_FECHA, $GE_DIRECCION,  getdate(), $GE_MOVIL, $GE_PLACA, $GE_TIPOVEHICULO,  
                      $GE_TRAB_AREALIZAR, $PR_ID, $GE_HINICIO, $GE_HFINALIZACION,$GE_OBSERVACION,$GE_OBSAMBIENTAL,null, 
                      null,'$usr', $EC_ID, $GE_PGRUA, $GE_PCANASTA, $GE_PMOTO,
					   $GE_TIPONO, $GE_NO, $GE_MUNICIPIO, '$GE_TINSPECCION', 'DIGITADAPC', 'INICIO', 
					            GE_OBSERVACION, $GE_OBSAMBIENTAL,$GE_NODELFOS) ";
	  
	  }
	  if($Nofilas==1)
	  {   // 
	     $sql2="update IPAL set GE_FECHA=$GE_FECHA,
		 						GE_MOVIL=$GE_MOVIL, GE_PLACA=$GE_PLACA, 
		  						GE_DIRECCION=$GE_DIRECCION,
		                                    GE_TIPOVEHICULO=$GE_TIPOVEHICULO, 
											GE_TRAB_AREALIZAR=$GE_TRAB_AREALIZAR, PR_ID=$PR_ID,
											GE_HINICIO=$GE_HINICIO, GE_HFINALIZACION=$GE_HFINALIZACION, 
											GE_PGRUA=$GE_PGRUA,
											GE_PCANASTA=$GE_PCANASTA,
											GE_PMOTO=$GE_PMOTO,
											EC_ID=$EC_ID,
											GE_TIPONO=$GE_TIPONO, 
											GE_NO=$GE_NO, 
											GE_MUNICIPIO=$GE_MUNICIPIO,
											GE_TINSPECCION='$GE_TINSPECCION',
											GE_OBSERVACION=$GE_OBSERVACION,
											GE_OBSAMBIENTAL=$GE_OBSAMBIENTAL,
											GE_NODELFOS=$GE_NODELFOS";
			  if($Modins<>1)$sql2.="	,USR_DIGPC='$usr'";
			  else $sql2.="	,GE_RESINSP_AMB=GE_RESINSP_AMB + '$usr' + 'Modificacion modulo administrador.' ";
											
											
	  		  $sql2.=" WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	  }
	  
	 // echo $sql2;
      $q->ejecutar($sql2,111,'GuardarInicio.php');	
	 
	 

	 
$SQL="SELECT     USB_NOMBRE,  EM_ID, USB_CARGO
				FROM         IPAL_USUARIOS_BB
               WHERE  USB_CEDULA=".$RES_CEDULA; 
	//echo $SQL."<br>";		   
$q->ejecutar($SQL,183,'GuardarInicio.php');	   
$q->Cargar();
$USB_NOMBRE=$q->dato(0);
//echo $USB_NOMBRE;
$EM_ID=$q->dato(1);
$USB_CARGO=$q->dato(2);

$sql1="SELECT   1
		FROM         IPAL_RES_INSPECCION
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	  $q->ejecutar($sql1,193,'GuardarInicio.php');	   
	  $Nofilas=$q->filas();	   
	  if($Nofilas==0)
	  {   
		 
		 $sql2="insert into  IPAL_RES_INSPECCION (GE_NO_INSPECCION, RES_CEDULA, RES_NOMBRE, RES_CARGO, EM_ID) 
		         values($GE_NO_INSPECCION, $RES_CEDULA,'$USB_NOMBRE', '$USB_CARGO', '$EM_ID' )  ";
	          $q->ejecutar($sql2,200,'GuardarInicio.php');			   
	  }
	  if($Nofilas==1)
	  {   
		 
		 $sql2="update IPAL_RES_INSPECCION set RES_CEDULA=$RES_CEDULA, 
								RES_NOMBRE='$USB_NOMBRE',
								RES_CARGO='$USB_CARGO',
								EM_ID=$EM_ID
	  		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	          $q->ejecutar($sql2,210,'GuardarInicio.php');			   
	  }


?>
      <script language="JavaScript">
  location.href='<?=$EnviarA?>?usr=<?=$usr?>&us_menu=<?=$us_menu?>&GE_NO_INSPECCION=<?=$GE_NO_INSPECCION?>&Monstrar=<?=$Monstrar?>&Modins=<?=$Modins?>'
   </script>
