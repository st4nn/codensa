
  <table width="200" border="6" align="center">
    <tr>
      <td align="center"> <span class="textoTablasRojo">GUARDANDO <BR><img src="img/carga.gif" width="55" height="40" >&nbsp;</td>
    </tr>
  </table>
<?	 

include "include/VarGlobales.PHP"; 
require("include/BdSqlClases.php");

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);

$GE_FECHA=$GE_AAA."-".$GE_MES."-".$GE_DIA;



 $GE_HINICIO="";
 IF($GE_InicioHora<>"" AND $GE_InicioMinuto<>"")
    $GE_HINICIO= $GE_InicioHora.":".$GE_InicioMinuto;

 if($GE_HINICIO<>"")$GE_HINICIO="convert(datetime, '".$GE_FECHA." ".$GE_HINICIO."',120)";
 else $GE_HINICIO='null';

 $GE_HFINALIZACION="";
 IF($GE_FinalHora<>"" AND $GE_FinalMinuto<>"")
    $GE_HFINALIZACION= $GE_FinalHora.":".$GE_FinalMinuto;


 if($GE_HFINALIZACION<>"")$GE_HFINALIZACION="convert(datetime, '".$GE_FECHA." ".$GE_HFINALIZACION."',120)";
 else $GE_HFINALIZACION='null';



 if($GE_FECHA<>"")$GE_FECHA="convert(datetime, '".$GE_FECHA."',120)";
 else $GE_FECHA='null';

 if($GE_DIRECCION<>"")$GE_DIRECCION="'".utf8_encode($GE_DIRECCION)."'";
 else $GE_DIRECCION='null';

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


 if($GE_TIPOVEHICULO<>"")$GE_TIPOVEHICULO="'".$GE_TIPOVEHICULO."'";
 else $GE_TIPOVEHICULO='null';

 if($GE_TRAB_AREALIZAR<>"")$GE_TRAB_AREALIZAR="'".utf8_encode($GE_TRAB_AREALIZAR)."'";
 else $GE_TRAB_AREALIZAR='null';
 

  if($GE_CTO<>"")$GE_CTO="'".$GE_CTO."'";
 else $GE_CTO='null';


  if($GE_OBSERVACION<>"")$GE_OBSERVACION="'".$GE_OBSERVACION."'";
 else $GE_OBSERVACION='null';

  if($GE_OBSAMBIENTAL<>"")$GE_OBSAMBIENTAL="'".$GE_OBSAMBIENTAL."'";
 else $GE_OBSAMBIENTAL='null';

  if($GE_RESPONSABLE<>"")$GE_RESPONSABLE="'".$GE_RESPONSABLE."'";
 else $GE_RESPONSABLE='null';

  if($GE_RECIBIDAPOR<>"")$GE_RECIBIDAPOR="'".$GE_RECIBIDAPOR."'";
 else $GE_RECIBIDAPOR='null';



  if($GE_TIPONO<>"")$GE_TIPONO="'".$GE_TIPONO."'";
 else $GE_TIPONO='null';


  if($GE_NO<>"")$GE_NO="'".$GE_NO."'";
 else $GE_NO='null';

  if($GE_VFALLIDA==1)$GE_VFALLIDA="'SI'";
 else $GE_VFALLIDA='null';

  if($GE_MUNICIPIO<>"")$GE_MUNICIPIO="'".utf8_decode ($GE_MUNICIPIO)."'";
 else $GE_MUNICIPIO='null';



IF ($GE_NO_INSPECCION=="")
{
		 $sql1="SELECT  max(GE_NO_INSPECCION) +1
			      FROM         IPAL" ;
		 $q->ejecutar($sql1,86,'BuscarGuia.php');	   
		 $q->Cargar();
		 $GE_NO_INSPECCION=$q->dato(0);
		 if($GE_NO_INSPECCION<150000)
			$GE_NO_INSPECCION=150000;
		 else 
			$GE_NO_INSPECCION=$q->dato(0);
}




$sql1="SELECT   1
			FROM         IPAL
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	  $q->ejecutar($sql1,96,'GuardarInicioBB.php');	   
	  $Nofilas=$q->filas();	 
	  $ejecuto=false;  
	  if($Nofilas==0)
	  {  // ,   ,GE_HFINALIZACION
	   /* 
       IF($usr=='91016484')
        {
          $men="llamar a claudia para habilitar ingreso de informacion. 3166904234. INSPECCION NO INGRESADA";
          $header = "From: Harvey - Desde:  " . $GE_MUNICIPIO . " <IPAL@cra.com.co>\r\n";
          mail('crodriguez@cra.com.co','Ingreso no valido Harvey','entro por formato bb', $header) ;
        }
        ELSE
        {*/
		$sql2="insert into IPAL (GE_NO_INSPECCION,GE_FECHA,  GE_DIRECCION,  GE_FAUTOMATICA, GE_MOVIL, GE_PLACA, GE_TIPOVEHICULO,
                      GE_TRAB_AREALIZAR, PR_ID, GE_HINICIO, USR_DIGITA, EC_ID, GE_PGRUA, GE_PCANASTA, GE_PMOTO,
					  GE_TIPONO, GE_NO, GE_MUNICIPIO, GE_TINSPECCION, GE_TCOPILOTO, GE_BVERIFTERRENO, GE_CTO, GE_VFALLIDA)
					 VALUES($GE_NO_INSPECCION, $GE_FECHA, $GE_DIRECCION,  getdate(), $GE_MOVIL, $GE_PLACA, $GE_TIPOVEHICULO,
                      $GE_TRAB_AREALIZAR, $PR_ID, $GE_HINICIO,'$usr', $EC_ID, $GE_PGRUA, $GE_PCANASTA, $GE_PMOTO,
					   $GE_TIPONO, $GE_NO, $GE_MUNICIPIO, '$GE_TINSPECCION', '$GE_TCOPILOTO', 'INICIO', $GE_CTO, $GE_VFALLIDA) ";
		$q->ejecutar($sql2,129,'GuardarInicioBB.php');
		$ejecuto=true;
		$men="INSPECCION NUEVA ASIGNADA CON EL NUMERO: ".$GE_NO_INSPECCION;
       //}
	  }
	 elseif($Nofilas==1 and  $nuevo=="")
	  {   // GE_HFINALIZACION=$GE_HFINALIZACION, 
	     $sql2="update IPAL set GE_FECHA=$GE_FECHA,
		 						GE_MOVIL=$GE_MOVIL, GE_PLACA=$GE_PLACA, 
		  						GE_DIRECCION=$GE_DIRECCION,
		                                    GE_TIPOVEHICULO=$GE_TIPOVEHICULO, 
											GE_TRAB_AREALIZAR=$GE_TRAB_AREALIZAR, PR_ID=$PR_ID,
											GE_HINICIO=$GE_HINICIO, 
											USR_DIGITA='$usr',
											GE_PGRUA=$GE_PGRUA,
											GE_PCANASTA=$GE_PCANASTA,
											GE_PMOTO=$GE_PMOTO,
											EC_ID=$EC_ID,
											GE_TIPONO=$GE_TIPONO, 
											GE_NO=$GE_NO, 
											GE_MUNICIPIO=$GE_MUNICIPIO,
											GE_TINSPECCION='$GE_TINSPECCION',
											GE_CTO=$GE_CTO,
							                GE_VFALLIDA=$GE_VFALLIDA
	  		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
			  $q->ejecutar($sql2,129,'GuardarInicioBB.php');	 
			  $ejecuto=true;
			  $men="Registro actualizado";
	  }
	  else
	  {
	    $men="Intenta guardar la inspeccion ".$GE_NO_INSPECCION. " como nueva pero ya existente en la BD. Numero de filas ".$Nofilas." variable:".$nuevo;
		
		
		$nombre2 = $usr;
		$email = "claudia_rm@hotmail.com";
		$Name = "IPAL ERROR AL INGRESAR UNA IPAL EN NUEVO ";
        $header = "From: ". $USB_NOMBRE . " - Desde:  " . $GE_MUNICIPIO . " <" . $email . ">\r\n";

		$para="crodriguez@cra.com.co";

		$asunto="IPAL finalizada NO:".$GE_NO_INSPECCION;
		$mensaje="Diligenciada por: ".$USB_NOMBRE." Numero de filas ".$Nofilas." variable:".$nuevo;

		mail($para,$asunto,$mensaje, $header);
		$GE_NO_INSPECCION="";
	  }	
		 // echo $sql2;
      
//	 echo $EnviarA;



if($ejecuto==true)
{
	$SQL="SELECT     USB_NOMBRE,  EM_ID, USB_CARGO
					FROM         IPAL_USUARIOS_BB
				   WHERE  USB_CEDULA=$usr"; 
		//echo $SQL."<br>";		   
	$q->ejecutar($SQL,139,'GuardarInicioBB.php');	   
	$q->Cargar();
	$USB_NOMBRE=$q->dato(0);
	//echo $USB_NOMBRE;
	$EM_ID=$q->dato(1);
	$USB_CARGO=$q->dato(2);
	
	$sql1="SELECT   1
			FROM         IPAL_RES_INSPECCION
			   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
		  $q->ejecutar($sql1,149,'GuardarInicioBB.php');	   
		  $Nofilas=$q->filas();	   
		  if($Nofilas==0)
		  {   
			 
			 $sql2="insert into  IPAL_RES_INSPECCION (GE_NO_INSPECCION, RES_CEDULA, RES_NOMBRE, RES_CARGO, EM_ID) 
					 values($GE_NO_INSPECCION, $usr,'$USB_NOMBRE', '$USB_CARGO', '$EM_ID' )  ";
				  $q->ejecutar($sql2,156,'GuardarInicioBB.php');	
			$nuevo="";
		  }
		  if($Nofilas==1)
		  {   
			 
			 $sql2="update IPAL_RES_INSPECCION set RES_CEDULA=$usr, 
									RES_NOMBRE='$USB_NOMBRE',
									RES_CARGO='$USB_CARGO',
									EM_ID=$EM_ID
				   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
				  $q->ejecutar($sql2,40,'GuardarCierre.php');			   
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
      <script language="JavaScript">
	  alert('<?=$men?>')
  location.href='<?=$EnviarA?>?usr=<?=$usr?>&us_menu=<?=$us_menu?>&GE_NO_INSPECCION=<?=$GE_NO_INSPECCION?>&Monstrar=<?=$Monstrar?>&nuevo=<?=$nuevo?>&ENINICIO=<?=$ENINICIO?>'
   </script>
