<?

	/*****verificacion de la informacion *********/
	
	/*general*/
	$sql="SELECT   GE_FECHA, GE_DIRECCION, GE_MOVIL, GE_PLACA, GE_TIPOVEHICULO, 
	               GE_TRAB_AREALIZAR, GE_AREACODENSA, GE_HINICIO, GE_HFINALIZACION, GE_OBSERVACION as dato9,
                   EC_ID, PR_ID, GE_NO as date12, GE_TIPONO as date13, GE_MUNICIPIO, GE_TINSPECCION as dato15, GE_CTO ,GE_VFALLIDA, GE_TCOPILOTO
			FROM         IPAL
		 WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	
	$q->ejecutar($sql,12,'verifDiligenciamientoIpal.php');	   
	$q->Cargar();
	//$GE_FECHA=$q->dato(0);
	if($q->dato(0)=="")$Menerror.="La fecha de ejecucion de la inspeccion esta en blanco.";
	//$GE_DIRECCION=$q->dato(1);
	if($q->dato(1)=="")$Menerror.=" La direccion de la inspeccion esta en blanco.";
	//$GE_MOVIL=$q->dato(2);
//	if($q->dato(2)=="")$Menerror.=" El numero de movil de la inspeccion esta en blanco.";
	//$GE_PLACA=$q->dato(3);
//	if($q->dato(3)=="")$Menerror.=" La placa del movil de la inspeccion esta en blanco.";
	//$GE_TIPOVEHICULO=$q->dato(4); 
	if($q->dato(4)=="")$Menerror.=" El tipo de vehiculo esta en blanco.";	
	if($q->dato(5)=="")$Menerror.=" El trabajo a realizar esta en blanco.";	
	//$GE_AREACODENSA=$q->dato(9);
	//if($q->dato(6)=="")$Menerror.=" El area de codensa esta en blanco.";		
	//$GE_HINICIO=$q->dato(10);
	if($q->dato(7)=="")$Menerror.=" La hora de inicio esta en blanco.";			
	//$GE_HFINALIZACION=$q->dato(11);
	if($q->dato(8)=="")$Menerror.=" La hora de finalizacion esta en blanco.";				
	if($q->dato(9)=="")$Menerror.=" La observacion esta en blanco.";					
	if($q->dato(10)=="")$Menerror.=" La empresa o elcontrato no han sido seleccionados.";					
	if($q->dato(11)=="")$Menerror.=" El proceso no ha sido seleccionados.";						
	if($q->dato(12)=="")$Menerror.=" El numero descargo y/o orden de trabajo  no ha sido diligenciada.";							
	if($q->dato(13)=="")$Menerror.=" El descargo y/o orden de trabajo no ha sido seleccionados.";								
	//$GE_MUNICIPIO=$q->dato(19);
	if($q->dato(14)=="")$Menerror.=" El municipio  no ha sido seleccionados.";								
	if($q->dato(15)=="CONTROL REDES" and $q->dato(16)=="")$Menerror.=" La inspeccion es tipo control redes, debe diligenciar el circuito.";	
    $GE_VFALLIDA=$q->dato(17);							
    $GE_TCOPILOTO=$q->dato(18);	
/*lista de no conformidades*/

if($GE_VFALLIDA=="")
{

	$sql="SELECT     COUNT(*) AS Expr1
	FROM         NC_LISTADO";
  $q->ejecutar($sql,43,'verifDiligenciamientoIpal.php'); 
  $q->Cargar();
  $TotalNC=$q->dato(0);



	$sql="SELECT   count(*)
			FROM         IPAL_DETALLE
		 WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	
	$q->ejecutar($sql,53,'verifDiligenciamientoIpal.php');	   
	$Nofilas=$q->filas();	
	$q->Cargar();
	$digitadas=$q->dato(0);
	//$GE_FECHA=$q->dato(0);
	if($digitadas<$TotalNC)
	{
	   
		$sql="SELECT   NC_ID
		FROM         NC_LISTADO";
	  $q->ejecutar($sql,62,'verifDiligenciamientoIpal.php'); 
	  $i=1;
	  while($q->Cargar())
	  {
	    	$sql="SELECT   count(*)
			FROM         IPAL_DETALLE
		 WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and NC_ID ='".$q->dato(0)."'";
	   // if($q->dato(0)=='7.1')  echo "<br>".$sql;
		$s->ejecutar($sql,71,'verifDiligenciamientoIpal.php');	   
		$s->Cargar();
		$encontro=$s->dato(0);
		//echo $encontro."fils encotradas DE LA NC ".$q->dato(0)."<br>";
		$i++;
	    if ($encontro==0)
		{
		  //echo "entro if ".$Nofilas."<br>".$q->dato(0);
		  $Falta.=" y ".$q->dato(0);
          $i++;
		}  
	  }
	  
	  
	  $Menerror.="No ha guardado la lista competa de verificacion de cumplimientos. El listado es de: ".$TotalNC. " y usted ha digitado: ".$digitadas." Falta: ".$Falta ;
	
	}

	$sql="SELECT  COUNT(*)
			FROM         IPAL_DETALLE
		 WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and DE_RESULTADO ='NO' AND DE_CATEGORTIA IS NULL";
	// if($GE_NO_INSPECCION ==5)echo $sql;
	$q->ejecutar($sql,93,'verifDiligenciamientoIpal.php');	   
	$Nofilas=$q->filas();	
	$q->Cargar();
	 if($q->dato(0)>0)$Menerror.="Hay categorias sin digitar";
	//if($GE_NO_INSPECCION ==5) echo $q->dato(0);

	
  /*cuadrilla*/
	if ($GE_TCOPILOTO <> "Copiloto")		
	{
		$sql="SELECT   count(*)
				FROM      INFO_EMPRESA_EMPLEADOS
			 WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION AND EE_LIDER='SI'";
		
		$q->ejecutar($sql,106,'verifDiligenciamientoIpal.php');	   
		$Nofilas=$q->filas();	
		$q->Cargar();
		//$GE_FECHA=$q->dato(0);
		if($q->dato(0)==0)$Menerror.="No hay lider de cuadrilla";
		if($q->dato(0)>1)$Menerror.="Diligencio mas de un lider en la cuadrilla";
	}


	$sql="SELECT count(*)
			FROM         INFO_EMPRESA_EMPLEADOS
			where	GE_NO_INSPECCION=$GE_NO_INSPECCION and EE_CARGO=''";
	
	$q->ejecutar($sql,130,'verifDiligenciamientoIpal.php');	   
	$Nofilas=$q->filas();	
	$q->Cargar();
	//$GE_FECHA=$q->dato(0);
	if($q->dato(0)>=1)$Menerror.="No se han digitado cargos en los cuadrilleros.";
	//if($q->dato(0)==1)$Menerror.="Solo existe un registro  fotografico ";


	$sql="SELECT count(*)
			FROM         INFO_EMPRESA_EMPLEADOS
			where	GE_NO_INSPECCION=$GE_NO_INSPECCION and EE_CARGO=' '";
	
	$q->ejecutar($sql,142,'verifDiligenciamientoIpal.php');	   
	$Nofilas=$q->filas();	
	$q->Cargar();
	//$GE_FECHA=$q->dato(0);
	if($q->dato(0)>=1)$Menerror.="Los cargos estan en blanco.";
	//if($q->dato(0)==1)$Menerror.="Solo existe un registro  fotografico ";



} // validar visita no fallida
  /*fotos*/

	$sql="SELECT   count(*)
			FROM    fotos_videos
		 WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and FV_TIPO='FOTO'";
	
	$q->ejecutar($sql,119,'verifDiligenciamientoIpal.php');	   
	$Nofilas=$q->filas();	
	$q->Cargar();
	//$GE_FECHA=$q->dato(0);
	if($q->dato(0)==0)$Menerror.="No se han guardado fotos.";
	//if($q->dato(0)==1)$Menerror.="Solo existe un registro  fotografico ";


	if ($GE_TCOPILOTO <> "Copiloto")		
	{
		$sql="SELECT   count(*)
				FROM    fotos_videos
			 WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION AND FV_TVIDEO='FIRMA DIGITAL'";
		
		$q->ejecutar($sql,130,'verifDiligenciamientoIpal.php');	   
		$Nofilas=$q->filas();	
		$q->Cargar();
		//$GE_FECHA=$q->dato(0);
		if($q->dato(0)<1)$Menerror.="NO HAY VIDEO CON FIRMA DIGITAL";
		//if($q->dato(0)<1)$Menerror.="$GE_TCOPILOTO";
	}

/*RESPONSABLE IPAL*/
$sql1="SELECT  COUNT(*)
		FROM         IPAL_RES_INSPECCION
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	  $q->ejecutar($sql1,140,'verifDiligenciamientoIpal.php');	   
	  $Nofilas=$q->filas();	   
    $q->Cargar();
	//$GE_FECHA=$q->dato(0);
	if($q->dato(0)==0)$Menerror.="NO HAY RESPONSABLE DEL IPAL";


?>