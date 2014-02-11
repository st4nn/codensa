<?

 if($GE_HINICIO<>"")$GE_HINICIO="convert(datetime, '".$GE_FECHA." ".$GE_HINICIO."',120)";
 else $GE_HINICIO='null';

 if($GE_HFINALIZACION<>"")$GE_HFINALIZACION="convert(datetime, '".$GE_FECHA." ".$GE_HFINALIZACION."',120)";
 else $GE_HFINALIZACION='null';

 if($GE_FECHA<>"")$GE_FECHA="convert(datetime, '".$GE_FECHA."',120)";
 else $GE_FECHA='null';

 if($GE_DIRECCION<>"")$GE_DIRECCION="'".$GE_DIRECCION."'";
 else $GE_DIRECCION='null';

 if($GE_MOVIL<>"")$GE_MOVIL="'".$GE_MOVIL."'";
 else $GE_MOVIL='null';

 if($GE_PLACA<>"")$GE_PLACA="'".$GE_PLACA."'";
 else $GE_PLACA='null';

 if($GE_TIPOVEHICULO<>"")$GE_TIPOVEHICULO="'".$GE_TIPOVEHICULO."'";
 else $GE_TIPOVEHICULO='null';

 if($GE_TRAB_AREALIZAR<>"")$GE_TRAB_AREALIZAR="'".$GE_TRAB_AREALIZAR."'";
 else $GE_TRAB_AREALIZAR='null';
 

  if($GE_OBS1<>"")$GE_OBS1="'".$GE_OBS1."'";
 else $GE_OBS1='null';

  if($GE_OBSAMBIENTAL<>"")$GE_OBSAMBIENTAL="'".$GE_OBSAMBIENTAL."'";
 else $GE_OBSAMBIENTAL='null';

  if($GE_TIPONO<>"")$GE_TIPONO="'".$GE_TIPONO."'";
 else $GE_TIPONO='null';


  if($GE_NO<>"")$GE_NO="'".$GE_NO."'";
 else $GE_NO='null';


  if($GE_MUNICIPIO<>"")$GE_MUNICIPIO="'".utf8_decode ($GE_MUNICIPIO)."'";
 else $GE_MUNICIPIO='null';


		 $sql1="SELECT   GE_NO_INSPECCION
			      FROM         IPAL
		    WHERE GE_SOCIO='$GE_SOCIO'" ;
		 $q->ejecutar($sql1,49,'IngresoDatosdeSocio.php');	   
		 $q->Cargar();
		 $GE_NO_INSPECCION=$q->dato(0);
		 if($GE_NO_INSPECCION=="")
		{
			 $sql1="SELECT  max(GE_NO_INSPECCION) +1
						FROM         IPAL" ;
				 $q->ejecutar($sql1,56,'IngresoDatosdeSocio.php');	   
				 $q->Cargar();
				 $GE_NO_INSPECCION=$q->dato(0);
		}
$sql1="SELECT   1
			FROM         IPAL
		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
	  $q->ejecutar($sql1,63,'IngresoDatosdeSocio.php');	   
	  $Nofilas=$q->filas();	 
	  $ejecuto=false;  
      //$usr='crodriguez';
	  if($Nofilas==0)
	  {  
		$sql2="insert into IPAL (GE_NO_INSPECCION,GE_FECHA,  GE_DIRECCION,  GE_FAUTOMATICA, GE_MOVIL, GE_PLACA, GE_TIPOVEHICULO,
                      GE_TRAB_AREALIZAR, PR_ID, GE_HINICIO, GE_HFINALIZACION, USR_DIGITA, EC_ID, 
					  GE_TIPONO, GE_NO, GE_MUNICIPIO, GE_TINSPECCION, GE_BVERIFTERRENO,GE_SOCIO,  GE_OBS1, GE_RESULTADOIPAL, GE_OBSAMBIENTAL, GE_ARCHIVO, GE_PROCESOSOCIO)
					 VALUES($GE_NO_INSPECCION, $GE_FECHA, $GE_DIRECCION,  getdate(), $GE_MOVIL, $GE_PLACA, $GE_TIPOVEHICULO,
                      $GE_TRAB_AREALIZAR, $PR_ID, $GE_HINICIO,$GE_HFINALIZACION, '$usr', $EC_ID,
					   $GE_TIPONO, $GE_NO, $GE_MUNICIPIO, '$GE_TINSPECCION', 'CERRADA','$GE_SOCIO', $GE_OBS1, '$GE_RESULTADOIPAL' , $GE_OBSAMBIENTAL, '$rutadestino', '$GE_PROCESOSOCIO') ";
		$q->ejecutar($sql2,75,'IngresoDatosdeSocio.php');
		//$men="INSPECCION AGREGADA: ".$GE_NO_INSPECCION;
       //}
	  }
	 elseif($Nofilas==1)
	  {   // GE_HFINALIZACION=$GE_HFINALIZACION, 
	     $sql2="update IPAL set GE_FECHA=$GE_FECHA,
		 						GE_MOVIL=$GE_MOVIL, GE_PLACA=$GE_PLACA, 
		  						GE_DIRECCION=$GE_DIRECCION,
		                                    GE_TIPOVEHICULO=$GE_TIPOVEHICULO, 
											GE_TRAB_AREALIZAR=$GE_TRAB_AREALIZAR, PR_ID=$PR_ID,
											GE_HINICIO=$GE_HINICIO, 
											GE_HFINALIZACION=$GE_HFINALIZACION,
											USR_DIGITA='$usr',
											EC_ID=$EC_ID,
											GE_TIPONO=$GE_TIPONO, 
											GE_NO=$GE_NO, 
											GE_MUNICIPIO=$GE_MUNICIPIO,
											GE_TINSPECCION='$GE_TINSPECCION',
    						                GE_OBS1=$GE_OBS1,
											GE_RESULTADOIPAL='$GE_RESULTADOIPAL',
						                     GE_OBSAMBIENTAL=$GE_OBSAMBIENTAL,
											GE_ARCHIVO='$rutadestino',
											GE_PROCESOSOCIO='$GE_PROCESOSOCIO'
	  		   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
			  $q->ejecutar($sql2,100,'IngresoDatosdeSocio.php');	 
			  //$men="INSPECCION ACTUALIZADA: ".$GE_NO_INSPECCION;
	  }


	$sql1="SELECT   1
			FROM         IPAL_RES_INSPECCION
			   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
		  $q->ejecutar($sql1,108,'IngresoDatosdeSocio.php');	   
		  $Nofilas=$q->filas();	   
		  if($Nofilas==0)
		  {   
			 
			 $sql2="insert into  IPAL_RES_INSPECCION (GE_NO_INSPECCION, RES_CEDULA, RES_NOMBRE, RES_CARGO, EM_ID) 
					 values($GE_NO_INSPECCION, $RES_CEDULA,'$RES_NOMBRE', '$RES_CARGO', 2 )  ";
				  $q->ejecutar($sql2,114,'IngresoDatosdeSocio.php');	
			$nuevo="";
		  }
		  if($Nofilas==1)
		  {   
			 
			 $sql2="update IPAL_RES_INSPECCION set RES_CEDULA=$RES_CEDULA, 
									RES_NOMBRE='$RES_NOMBRE',
									RES_CARGO='$RES_CARGO',
									EM_ID=2
				   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION";
				  $q->ejecutar($sql2,125,'IngresoDatosdeSocio.php');			   
		  }

/*ingreso de cuadrilleros*/
		if($EE_CEDULA<>"")
		{
			  $sql1="SELECT   1
					FROM        INFO_EMPRESA_EMPLEADOS
				   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and EE_CEDULA=".$EE_CEDULA;
			  //echo $sql1;
			  $q->ejecutar($sql1,136,'IngresoDatosdeSocio.php');	   
			  $Nofilas=$q->filas();	   
			  if($Nofilas==0)
			  {
				$sql2="insert into INFO_EMPRESA_EMPLEADOS (GE_NO_INSPECCION, EE_CEDULA, EE_NOMBRES, EE_APELLIDO1, EE_APELLIDO2,EE_LIDER, EE_CARGO)
							 VALUES($GE_NO_INSPECCION, $EE_CEDULA, '$EE_NOMBRES','$EE_APELLIDO1', '$EE_APELLIDO2', '$EE_LIDER', '$EE_CARGO') ";
			     //ECHO $sql2."<BR>";
				 $q->ejecutar($sql2,142,'IngresoDatosdeSocio.php');	
			  }
			  if($Nofilas==1)
			  {
				$sql2="update INFO_EMPRESA_EMPLEADOS  set EE_NOMBRES ='$EE_NOMBRES', EE_APELLIDO1='$EE_APELLIDO1', EE_APELLIDO2='$EE_APELLIDO2',EE_LIDER='$EE_LIDER', EE_CARGO='$EE_CARGO'
				           WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and EE_CEDULA=".$EE_CEDULA;
			     //ECHO $sql2."<BR>";
				 $q->ejecutar($sql2,150,'IngresoDatosdeSocio.php');	
			  }
		}
/*ingreso incumplimiento de cuadrilleros*/
		if($EE_CEDULAincuadrillero<>"")
		{
			  $sql1="SELECT   1
					FROM        INFO_EMPRESA_EMPLEADOS
				   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and EE_CEDULA=".$EE_CEDULAincuadrillero;
			  //echo $sql1;
			  $q->ejecutar($sql1,136,'IngresoDatosdeSocio.php');	   
			  $Nofilas=$q->filas();	   
			  if($Nofilas==0)
			  {
				$sql2="insert into INFO_EMPRESA_EMPLEADOS (GE_NO_INSPECCION, EE_CEDULA, EE_NOMBRES, EE_APELLIDO1, EE_APELLIDO2,EE_LIDER, EE_CARGO)
							 VALUES($GE_NO_INSPECCION, $EE_CEDULAincuadrillero, '$EE_NOMBRES','$EE_APELLIDO1', '$EE_APELLIDO2', '$EE_LIDER', '$EE_CARGO') ";
			     //ECHO $sql2."<BR>";
				 $q->ejecutar($sql2,142,'IngresoDatosdeSocio.php');	
			  }
			  if($Nofilas==1)
			  {
				$sql2="update INFO_EMPRESA_EMPLEADOS  set EE_NOMBRES ='$EE_NOMBRES', EE_APELLIDO1='$EE_APELLIDO1', EE_APELLIDO2='$EE_APELLIDO2',EE_LIDER='$EE_LIDER', EE_CARGO='$EE_CARGO'
				           WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and EE_CEDULA=".$EE_CEDULAincuadrillero;
			     //ECHO $sql2."<BR>";
				 $q->ejecutar($sql2,150,'IngresoDatosdeSocio.php');	
			  }
		}


        if($EE_CEDULAincuadrillero<>"")
		{

					   $sql1="SELECT   1
									FROM        IPAL_CUADRILLA
									WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and EE_CEDULA=".$EE_CEDULAincuadrillero." and NC_ID='".$NC_IDalcuadrillero."'";
					  //echo $sql1."<BR>";
					  $q->ejecutar($sql1,160,'IngresoDatosdeSocio.php');	   
					  $Nofilas=$q->filas();	   
					  if($Nofilas==0)
					  {
						$sql3="insert into IPAL_CUADRILLA (GE_NO_INSPECCION, EE_CEDULA, NC_ID)
									 VALUES($GE_NO_INSPECCION, $EE_CEDULAincuadrillero, '$NC_IDalcuadrillero') ";
						 $q->ejecutar($sql3,167,'IngresoDatosdeSocio.php');	
							//echo $sql3."<br>";
					  }
		}

/*guardar listado de nc*/
			  if($DE_CATEGORTIA<>"")$DE_CATEGORTIA="'".$DE_CATEGORTIA."'";
			 else $DE_CATEGORTIA='null';

			  if($DE_DESCRIPCION<>"")$DE_DESCRIPCION="'".$DE_DESCRIPCION."'";
			 else $DE_DESCRIPCION='null';

		   $sql1="SELECT   1
						FROM        IPAL_DETALLE
					   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and NC_ID='".$NC_ID."'";
			//echo $sql1."<br>";
				  $s->ejecutar($sql1,183,'IngresoDatosdeSocio.php');	   
				  $Nofilas=$s->filas();	   
				  if($Nofilas==0)
				  {
					$sql4="insert into IPAL_DETALLE (GE_NO_INSPECCION, NC_ID, DE_RESULTADO, DE_CATEGORTIA, DE_DESCRIPCION)
											 VALUES($GE_NO_INSPECCION, '".$NC_ID."','".$DE_RESULTADO."',$DE_CATEGORTIA,$DE_DESCRIPCION) ";
				  
				  }
				  if($Nofilas==1)
				  {
					 $sql4="update IPAL_DETALLE set DE_RESULTADO= '$DE_RESULTADO', DE_CATEGORTIA=$DE_CATEGORTIA, DE_DESCRIPCION=$DE_DESCRIPCION
						   WHERE 	GE_NO_INSPECCION=$GE_NO_INSPECCION and NC_ID='".$NC_ID."'";
				  }
				//echo $sql4."<br>";  
				  $s->ejecutar($sql4,197,'IngresoDatosdeSocio.php');	


	//echo "<tr><td colspan=".count($ArrColumnas).">".$men."</td></tr>";	

?>