
  <table width="200" border="6" align="center">
    <tr>
      <td align="center"> <span class="textoTablasRojo">VERIFICANDO PARA CIERRE <BR><img src="img/carga.gif" width="55" height="40" >&nbsp;</td>
    </tr>
  </table>
<?	 

include "include/VarGlobales.PHP"; 
require("include/BdSqlClases.php");

$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);
$s=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);



$SQL="SELECT     USB_NOMBRE,  EM_ID, USB_CARGO
				FROM         IPAL_USUARIOS_BB
               WHERE  USB_CEDULA=$usr"; 
	//echo $SQL."<br>";		   
$q->ejecutar($SQL,14,'GuardarCierre.php');	   
$q->Cargar();
$USB_NOMBRE=$q->dato(0);
//echo $USB_NOMBRE;
$EM_ID=$q->dato(1);
$USB_CARGO=$q->dato(2);

$sql1="SELECT   1
		FROM         IPAL_RES_INSPECCION
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	  $q->ejecutar($sql1,23,'GuardarCierre.php');	   
	  $Nofilas=$q->filas();	   
	  if($Nofilas==0)
	  {   
		 
		 $sql2="insert into  IPAL_RES_INSPECCION (GE_NO_INSPECCION, RES_CEDULA, RES_NOMBRE, RES_CARGO, EM_ID) 
		         values($GE_NO_INSPECCION, $usr,'$USB_NOMBRE', '$USB_CARGO', '$EM_ID' )  ";
	          $q->ejecutar($sql2,30,'GuardarCierre.php');			   
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

 // echo $sql2;


  if($GE_OBSERVACION<>"")
  {
    $GE_OBSERVACION="'".utf8_encode($GE_OBSERVACION)."'";
	$largoObs=strlen($GE_OBSERVACION);
	if($largoObs>799)
	  $Menerror="La observacion tiene ".$largoObs." caracteres los permitidos son 800 caracteres. La cadena se cortara verifique la redaccion de la observacion";
  }	
 else $GE_OBSERVACION='null';

  if($GE_OBSAMBIENTAL<>"")$GE_OBSAMBIENTAL="'".utf8_encode($GE_OBSAMBIENTAL)."'";
 else $GE_OBSAMBIENTAL='null';



$sql1="SELECT   convert(varchar(10),GE_FECHA,120)
			FROM         IPAL
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	  $q->ejecutar($sql1,57,'GuardarCierre.php');	   
	  $Nofilas=$q->filas();	   
	  if($Nofilas==1)
	  {   
	     $q->Cargar();
	     $GE_FECHA=$q->dato(0);
		 

		 $GE_HFINALIZACION="";
		 IF($GE_FinalHora<>"" AND $GE_FinalMinuto<>"")
			$GE_HFINALIZACION= $GE_FinalHora.":".$GE_FinalMinuto;
		
		
		 if($GE_HFINALIZACION<>"")$GE_HFINALIZACION="convert(datetime, '".$GE_FECHA." ".$GE_HFINALIZACION."',120)";
		 else $GE_HFINALIZACION='null';

		 
		 $sql2="update IPAL set GE_HFINALIZACION=$GE_HFINALIZACION, 
								GE_OBSERVACION=$GE_OBSERVACION,
								GE_OBSAMBIENTAL=$GE_OBSAMBIENTAL, 
								USR_DIGITA='$USB_NOMBRE',
								GE_OBS1='".utf8_encode($GE_OBS1)."'
	  		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	          $q->ejecutar($sql2,79,'GuardarCierre.php');			   
	  }





include "verifDiligenciamientoIpal.php";
   /*SE ASUME QUE TODO ESTA OK*/
    $GE_RESULTADOIPAL="CFELIZ";

   /*PREGUNTO CUANTOS REGISTROS  SE HAN DILIGENCIADO DEL LISTADO DE nc
     SI NO HAY REGISTRO PUES CARITA TRISTE PORQUE NO HAN DILIGENCIADO LA INFORMACION*/
	$sql="SELECT  COUNT(*)
			FROM         IPAL_DETALLE
		 WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION ";
	//ECHO $sql;
	$q->ejecutar($sql,156,'GuardarCierre.php');	   
	$Nofilas=$q->filas();	
	$q->Cargar();

	if($q->dato(0)==0)$GE_RESULTADOIPAL="CTRISTE";



  /*SI ALO MENOS HAY UNA RESPUESTA CON NO CARITA TRISTE*/
	$sql="SELECT  COUNT(*)
			FROM         IPAL_DETALLE
		 WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION AND (DE_RESULTADO = 'NO')";
	//ECHO $sql;
	$q->ejecutar($sql,156,'GuardarCierre.php');	   
	$Nofilas=$q->filas();	
	$q->Cargar();
	if($q->dato(0)>0)$GE_RESULTADOIPAL="CTRISTE";


$GE_BVERIFTERRENO='COMPLETO';
IF($Menerror<>"")
  $GE_BVERIFTERRENO='INICIO';


 $sql2="update IPAL set GE_BVERIFTERRENO='$GE_BVERIFTERRENO', 
                        GE_RESULTADOIPAL='$GE_RESULTADOIPAL' 
	  		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
			  // ECHO $sql2;
	          $q->ejecutar($sql2,79,'GuardarCierre.php');			   



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

if($Menerror<>"")
{
?>
      <script language="JavaScript">
           alert('<?=$Menerror?>')
   </script>
<?
}


?>
      <script language="JavaScript">
  location.href='<?=$EnviarA?>?GE_BVERIFTERRENO=<?=$GE_BVERIFTERRENO?>&usr=<?=$usr?>&us_menu=<?=$us_menu?>&GE_NO_INSPECCION=<?=$GE_NO_INSPECCION?>&Monstrar=<?=$Monstrar?>&ENINICIO=<?=$ENINICIO?>'
   </script>
