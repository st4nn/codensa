<?
	$sql1="SELECT       GE_NO_INSPECCION
			FROM         IPAL 
		   WHERE 	GE_BVERIFTERRENO = 'CERRADA'  and  (GE_VFALLIDA IS  NULL) ";
		   
	if($NoInspeccion<>"")$sql1.=" and GE_NO_INSPECCION =".$NoInspeccion;
	if($FECHA<>"")$sql1.=" and IPAL.GE_FECHA=convert(datetime,'".$FECHA."',120)";
	if($f1<>"")$sql1.=" and IPAL.GE_FECHA>=convert(datetime,'".$f1."',120)";
	if($f2<>"")$sql1.=" and IPAL.GE_FECHA<=convert(datetime,'".$f2."',120)";		
	if($GE_TINSPECCION<>"")$sql1.=" and (IPAL.GE_TINSPECCION='".$GE_TINSPECCION."' OR IPAL.GE_TCOPILOTO = '" . $GE_TINSPECCION . "') ";
	if($EC_ID<>"")$sql1.=" and IPAL.EC_ID='".$EC_ID."'";
    $sql1.=" order by  GE_NO_INSPECCION";
    //echo $sql1;
	$q->ejecutar($sql1,17,'CuerpoReporte.php');	   
	$numregistros=$q->filas();	


	$Nofilas=$numregistros;
	$paginas=$Nofilas-1;
	$FilAnterior=0;
	$decimal=$Nofilas/$top;
	$NoLink=number_format($decimal);					 
	if($NoLink<$decimal)
	   $NoLink=$NoLink+1;

if($imprimir=="")
{
?>           
 <table border="1">
  <tr>
    <td  class="Fondogris"><? echo  "N&uacute;mero de registros encontrados: $numregistros"; ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" align="center">
              <tr>
            <td width="51%"  class="TitulosTablas">PAGINAS:</td>
           <?
					

						
					for($i=1;$i<=$NoLink;$i++)
					{
					  if($i==1)
						$PAGINALink=0;
					  else	
					  {
						$PAGINALink=1+$FilAnterior+$top-1;
						$FilAnterior=$FilAnterior+$top;
					  }	
					 
					  $DATOS="usr=".$usr."&us_menu=".$us_menu."&NoInspeccion=".$NoInspeccion."&FECHA=".$FECHA."&f1=".$f1."&f2=".$f2."&GE_TINSPECCION=".$GE_TINSPECCION."&EC_ID=".$EC_ID."&top=".$top."&PAGINA=".$PAGINALink."&HOJA=".$i;	
					 // echo $DATOS."<br>";
					  $arrSig[$i]=$PAGINALink;
			          
					  ?><TD width="34%" ><a href="BuscarMatriz.php?nivel=1&<?=$DATOS?>" ><?=$i?></a></TD><?
					 
					}					   
					  
					//echo $Nofilas;
					
					 //$NofilasPostes=$numregistros;


					//echo count($arrSig);
						if($PAGINA=="")
						{ 
						   $PAGINA=0;	
						   $PAGINASig=$arrSig[2];
						   $iSig=2;
						   
						   $PAGINAAnt=$arrSig[count($arrSig)];
						   $iAnt=count($arrSig);
						   
						}
						else
						{  //echo $HOJA."-".$arrSig[$HOJA];
						  if($HOJA==count($arrSig))
						  {
						    $PAGINASig=0;
							 $iSig=1;
							 
							 $PAGINAAnt=$arrSig[$HOJA-1];
  						     $iAnt=$HOJA-1;
							 
						  }
						  else
						  {
						   $PAGINASig=$arrSig[$HOJA+1];
						   $iSig=$HOJA+1;
						   
						   $PAGINAAnt=$arrSig[$HOJA-1];
						   $iAnt=$HOJA-1;
						   
						   if($iAnt==0){$PAGINAAnt=$arrSig[count($arrSig)];$iAnt=count($arrSig);}
						  }	
						}
						if( $HOJA=="") $HOJA=1;	
						
			//$cadSig="FichaEquipo.php?nivel=1&EL_ID=".$EL_ID."&numero=".$numero."&usr=".$usr."&us_menu=".$us_menu."&PAGINA=".$PAGINASig."&HOJA=".$iSig;	
            //$cadAnt="FichaEquipo.php?nivel=1&EL_ID=".$EL_ID."&numero=".$numero."&usr=".$usr."&us_menu=".$us_menu."&PAGINA=".$PAGINAAnt."&HOJA=".$iAnt;	
			
			 $cadSig="usr=".$usr."&us_menu=".$us_menu."&nivel=1&NoInspeccion=".$NoInspeccion."&FECHA=".$FECHA."&f1=".$f1."&f2=".$f2."&GE_TINSPECCION=".$GE_TINSPECCION."&EC_ID=".$EC_ID."&top=".$top."&PAGINA=".$PAGINASig."&HOJA=".$iSig;	
			  $cadAnt="usr=".$usr."&us_menu=".$us_menu."&nivel=1&NoInspeccion=".$NoInspeccion."&FECHA=".$FECHA."&f1=".$f1."&f2=".$f2."&GE_TINSPECCION=".$GE_TINSPECCION."&EC_ID=".$EC_ID."&top=".$top."&PAGINA=".$PAGINAAnt."&HOJA=".$iAnt;	
					  
						
			?>
          <td width="15%" class="titulos"><a href="BuscarMatriz.php?<?=$cadAnt?>" ><img src="Img/GArrow.gif" width="20" height="20"  border="0"/></a>
                                        <a href="BuscarMatriz.php?nivel=1&<?=$cadSig?>" ><img src="Img/b011.gif" width="16" height="16" border="0"/></a></td>					
          </tr>
	  
</table> </td>
  </tr>
  <tr>
    <? $DATOSImprimir="BuscarMatrizExcel.php?NoInspeccion=".$NoInspeccion."&FECHA=".$FECHA."&f1=".$f1."&f2=".$f2."&GE_TINSPECCION=".$GE_TINSPECCION."&EC_ID=".$EC_ID."&top=".$top."&PAGINA=".$PAGINA."&imprimir=1";	
	   
	  // echo $DATOSImprimir;
	  ?>
    <td  class="Fondogris"><div align="left"><a href="<?=$DATOSImprimir?>">Exportar a Excel</a><br />
PAGINA ACTUAL :      <?=$HOJA?></div></td>
  </tr>
</table>
      
            

<?
}
	if ($GE_TINSPECCION == 'Copiloto')
	{
		$sqlTInspeccion = "IPAL.GE_TCOPILOTO = '" . $GE_TINSPECCION . "'";
		$pTInspeccion = "GE_TCOPILOTO, ";
	} else
	{
		$sqlTInspeccion = "IPAL.GE_TINSPECCION='".$GE_TINSPECCION."'";
		$pTInspeccion = "GE_TINSPECCION, ";
	}
   $SQL="SELECT DISTINCT TOP $top  GE_NO_INSPECCION, convert(varchar(10),GE_FECHA,120), 
	                   GE_DIRECCION, GE_MOVIL, GE_PLACA, GE_TIPOVEHICULO, GE_PGRUA, GE_PCANASTA, GE_PMOTO, GE_TRAB_AREALIZAR, 
                      GE_OBSERVACION, GE_RESULTADOIPAL, EC_ID, PR_ID, GE_NO, GE_TIPONO, GE_MUNICIPIO, $pTInspeccion 
                      GE_NODELFOS,DATEPART(hh,GE_HINICIO), DATEPART(mi,GE_HINICIO), DATEPART(hh,GE_HFINALIZACION) , DATEPART(mi,GE_HFINALIZACION), GE_TCOPILOTO
			FROM         IPAL 
			WHERE  GE_BVERIFTERRENO = 'CERRADA'  ";
			
	if($NoInspeccion<>"")$SQL.=" and GE_NO_INSPECCION =".$NoInspeccion;
	if($FECHA<>"")$SQL.=" and IPAL.GE_FECHA=convert(datetime,'".$FECHA."',120)";
	if($f1<>"")$SQL.=" and IPAL.GE_FECHA>=convert(datetime,'".$f1."',120)";
	if($f2<>"")$SQL.=" and IPAL.GE_FECHA<=convert(datetime,'".$f2."',120)";		
	if($GE_TINSPECCION<>"")$SQL.=" and $sqlTInspeccion ";
	if($EC_ID<>"")$SQL.=" and IPAL.EC_ID='".$EC_ID."'";
			
	$SQL.="		and   (GE_NO_INSPECCION NOT IN
                          (SELECT  distinct    TOP $PAGINA GE_NO_INSPECCION
                            FROM          IPAL
							WHERE     GE_BVERIFTERRENO = 'CERRADA'";
								if($NoInspeccion<>"")$SQL.=" and GE_NO_INSPECCION =".$NoInspeccion;
								if($FECHA<>"")$SQL.=" and IPAL.GE_FECHA=convert(datetime,'".$FECHA."',120)";
								if($f1<>"")$SQL.=" and IPAL.GE_FECHA>=convert(datetime,'".$f1."',120)";
								if($f2<>"")$SQL.=" and IPAL.GE_FECHA<=convert(datetime,'".$f2."',120)";		
								if($GE_TINSPECCION<>"")$SQL.=" and IPAL.GE_TINSPECCION='".$GE_TINSPECCION."'";
								if($EC_ID<>"")$SQL.=" and IPAL.EC_ID='".$EC_ID."'";
		$SQL.="            ORDER BY GE_NO_INSPECCION ))
			ORDER BY GE_NO_INSPECCION ";	

			  
	          $q->ejecutar($SQL,158,'ReporteNCOB.PHP');
	          $Nofilas=$q->filas();

//echo $SQL;

/*
	$sql1="SELECT       GE_NO_INSPECCION, convert(varchar(10),GE_FECHA,120), 
	                   GE_DIRECCION, GE_MOVIL, GE_PLACA, GE_TIPOVEHICULO, GE_PGRUA, GE_PCANASTA, GE_PMOTO, GE_TRAB_AREALIZAR, 
                      GE_OBSERVACION, GE_RESULTADOIPAL, EC_ID, PR_ID, GE_NO, GE_TIPONO, GE_MUNICIPIO, GE_TINSPECCION, 
                      GE_NODELFOS
			FROM         IPAL 
		   WHERE 	GE_BVERIFTERRENO = 'CERRADA'";
		   
	if($NoInspeccion<>"")$sql1.=" and GE_NO_INSPECCION =".$NoInspeccion;
	if($FECHA<>"")$sql1.=" and IPAL.GE_FECHA=convert(datetime,'".$FECHA."',120)";
	if($f1<>"")$sql1.=" and IPAL.GE_FECHA>=convert(datetime,'".$f1."',120)";
	if($f2<>"")$sql1.=" and IPAL.GE_FECHA<=convert(datetime,'".$f2."',120)";		
	if($GE_TINSPECCION<>"")$sql1.=" and IPAL.GE_TINSPECCION='".$GE_TINSPECCION."'";
	if($EC_ID<>"")$sql1.=" and IPAL.EC_ID='".$EC_ID."'";
    $sql1.=" order by  GE_NO_INSPECCION";
    //echo $sql1;
	$q->ejecutar($sql1,17,'CuerpoReporte.php');	   
	$Nofilas=$q->filas();	
*/

?>
<table border="1" align="center">
		  <tr>
		    <td class="titulosFondoGris">Cont. Insps</td>
			<td class="titulosFondoGris">No Inspeccion </td>
			<td class="titulosFondoGris">No delfos</td>	            		            
			<td class="titulosFondoGris">Fecha  </td>
			<td class="titulosFondoGris">Direccion  </td>			
			<td class="titulosFondoGris">Movil</td>
			<td class="titulosFondoGris">Placa</td>
			<td class="titulosFondoGris">Tipo Vehiculo </td>
			<td class="titulosFondoGris">Trabajo a Realizar</td>
			<td class="titulosFondoGris">Actividad</td>			
			<td class="titulosFondoGris">Observacion</td>			            
			<td class="titulosFondoGris">Resultado</td>			            
			<td class="titulosFondoGris">Empresa</td>			            
			<td class="titulosFondoGris">Contrato</td>			            
			<td class="titulosFondoGris">E2</td>			            
			<td class="titulosFondoGris">E3</td>			                                    
			<td class="titulosFondoGris">No</td>			            
			<td class="titulosFondoGris">Clase</td>			            
			<td class="titulosFondoGris">Municipio</td>	
			<td class="titulosFondoGris">Tipo</td>	            		
			<td class="titulosFondoGris">Copiloto</td>	            		
			<td class="titulosFondoGris">Inspector</td>	            		            
			<td class="titulosFondoGris">Lider cuadrilla</td>	            		                                    
			<td class="titulosFondoGris">Incumplimiento</td>
			<td class="titulosFondoGris">Consecuencia</td>	            		                                    
			<td class="titulosFondoGris">Observacion</td>	            		                                                            
			<td class="titulosFondoGris">Categoria</td>	            		                                                                        
  </tr>
		 <?
		  $I=1;
		  while($q->Cargar())
		 {  

		    $GE_NO_INSPECCION=$q->dato(0);
			$GE_FECHA=$q->dato(1); 
			$GE_DIRECCION=$q->dato(2); 
			$GE_MOVIL=$q->dato(3);
			$GE_PLACA=$q->dato(4); 
			$GE_TIPOVEHICULO=$q->dato(5); 
			
			$GE_PLACA.=$q->dato(6);
			$GE_PLACA.=$q->dato(7); 
			$GE_PLACA.=$q->dato(8); 
			
			$GE_TRAB_AREALIZAR=$q->dato(9); 
            $GE_OBSERVACION=$q->dato(10);  
			$GE_RESULTADOIPAL=$q->dato(11); 
			$EC_ID=$q->dato(12); 
			
			
			$sql="SELECT     EMPRESA_CONTRATOS.E3, EMPRESA_CONTRATOS.E2, EMPRESAS.EM_NOMBRE, EMPRESA_CONTRATOS.EC_CONTRATO
					FROM         EMPRESA_CONTRATOS INNER JOIN
                      EMPRESAS ON EMPRESA_CONTRATOS.EM_ID = EMPRESAS.EM_ID
					 where  EMPRESA_CONTRATOS.EC_ID=".$EC_ID;
			$s->ejecutar($sql,75,'CuerpoReporte.php');	   
			$s->Cargar();
			$E3=$s->dato(0);
			$E2=$s->dato(1);
			$EM_NOMBRE=$s->dato(2);
			$EC_CONTRATO=$s->dato(3);						
					   
			
			$PR_ID=$q->dato(13); 
			
			if($PR_ID<>"")
			{
				$sql1="SELECT     PR_NOMCORTO, PR_NOMCOMPLETO
						FROM         PROCESOS
						WHERE     PR_ID=".$PR_ID;
				  $s->ejecutar($sql1,88,'CuerpoReporte.php');	   
				  $s->Cargar();
				  $PR_NOMCORTO=$s->dato(0);
			}
			
			
			$GE_NO=$q->dato(14);  
			$GE_TIPONO=$q->dato(15); 
			$GE_MUNICIPIO=$q->dato(16); 
			$GE_TINSPECCION=$q->dato(17);  
            $GE_NODELFOS=$q->dato(18);
            $hinicio=$q->dato(19).":".$q->dato(20);
            $hfin=$q->dato(21).":".$q->dato(22);						
			
			$TipoCopiloto = $q->dato(23);	
			
            
			  
			$nominsp="";
		      $sql1="SELECT   RES_CEDULA, RES_NOMBRE, EM_ID
					FROM         IPAL_RES_INSPECCION
					   WHERE 	GE_NO_INSPECCION=".$GE_NO_INSPECCION;
			  $s->ejecutar($sql1,104,'CuerpoReporte.php');	   
			  $s->Cargar();
			  $RES_CEDULA=$s->dato(0);
			  $nominsp=$s->dato(1);
			  $EM_IDresponasble=$s->dato(2);
			



			  $NOM="";	
		      $sql1="SELECT    EE_CEDULA, EE_NOMBRES, EE_APELLIDO1, EE_APELLIDO2, EE_CARGO, EE_LIDER, EE_FSYS, EE_ORDEN
					FROM         INFO_EMPRESA_EMPLEADOS
					WHERE     (EE_LIDER = 'SI') AND 	GE_NO_INSPECCION=".$GE_NO_INSPECCION;
			  $s->ejecutar($sql1,113,'CuerpoReporte.php');	   
			  $s->Cargar();
			  $EE_CEDULA=$s->dato(0);
			  $EE_NOMBRES=$s->dato(1);
			  $EE_APELLIDO1=$s->dato(2);
			  $EE_APELLIDO2=$s->dato(3);			  			  
			  $NOM=$EE_NOMBRES." ".$EE_APELLIDO1." ".$EE_APELLIDO2;
		   
		   
		      $SQL="SELECT  IPAL_DETALLE.NC_ID, NC_LISTADO.NC_DESCRIPCION, IPAL_DETALLE.DE_DESCRIPCION, 
		                      IPAL_DETALLE.DE_CATEGORTIA , NC_LISTADO.NC_VALOR
						FROM         IPAL_DETALLE INNER JOIN
		                      NC_LISTADO ON IPAL_DETALLE.NC_ID = NC_LISTADO.NC_ID
					 WHERE IPAL_DETALLE.DE_RESULTADO ='NO' and GE_NO_INSPECCION=".$GE_NO_INSPECCION;
			  $s->ejecutar($SQL,239,'BuscarMatriz.php');	   
			  unset($arrIncumplimientos);
			  $k=0;
			  
			  unset($arrIncumplimientos);
			  while($s->Cargar())
			  {
			    $NC_ID=$s->dato(0);
			    $NC_DESCRIPCION=$s->dato(1);		   
			    $OBSERVACION=$s->dato(2);		   
			    $DE_CATEGORTIA=$s->dato(3);	
				$NC_VALOR=$s->dato(4);					
				
				if($DE_CATEGORTIA<>"")	   								
				{
					$sql="SELECT   CA_DESCRIPCION
					FROM         NC_CATEGORIAS
					 where   DE_CATEGORIA='".$DE_CATEGORTIA."'";
					$m->ejecutar($sql,254,'BuscarMatriz.php');	   
					$m->Cargar();
					$CA_DESCRIPCION=$m->dato(0);
				}
				$arrIncumplimientos[$k][0]=$NC_ID."-".$NC_DESCRIPCION;
				$arrIncumplimientos[$k][1]=$OBSERVACION;
				$arrIncumplimientos[$k][2]=$DE_CATEGORTIA."-".$CA_DESCRIPCION;
				$arrIncumplimientos[$k][3]=$NC_VALOR;				
				$k++;												
			  }
			  if($k>0)$k=$k-1;
//echo $QUIENINSPECCIONA."-".$EM_IDresponasble."<br>";
            /*si solicitan ls dos empresas que inspeccionaron la variabel la genero igual a la responsable que viend ela ipal
              del o cotnrario solo muestra la empresa seleccinada enpantalla
              cprm agosto 15 de 2012*/
            if($QUIENINSPECCIONA=="")$QUIENINSPECCIONAbuscar= $EM_IDresponasble;
             else $QUIENINSPECCIONAbuscar= $QUIENINSPECCIONA;
			if($QUIENINSPECCIONAbuscar==$EM_IDresponasble)
			{  //if
			

		      for($w=0;$w<=$k;$w++)
			  {
				 ?>
				  <tr class="TituloP">
					<td><?=$I?></td>
					<td><?=$GE_NO_INSPECCION?></td>
                    <td><?=$GE_NODELFOS?></td>                                              
					<td><?=$GE_FECHA?></td>
					<td><?=$GE_DIRECCION?></td>
					<td><?=$GE_MOVIL?></td>
					<td><?=$GE_PLACA?></td>	
					<td><?=$GE_TIPOVEHICULO?>&nbsp;</td>
					<td><?=$GE_TRAB_AREALIZAR?></td>
					<td><?=$PR_ID."-".$PR_NOMCORTO?></td>								
					<td><?=$GE_OBSERVACION?></td>								                    
					<td><?=$GE_RESULTADOIPAL?></td>	
					<td><?=$EM_NOMBRE?></td>	
					<td><?=$EC_CONTRATO?></td>	                                        							
					<td><?=$E2?></td>	                                        							
					<td><?=$E3?></td>	                     
					<td><?=$GE_NO?></td>	                     
					<td><?=$GE_TIPONO?></td>	                     
					<td><?=$GE_MUNICIPIO?></td>	                                                                                 
					<td><?=$GE_TINSPECCION?></td>	                                                                                
					<td><?=$TipoCopiloto?></td>
                    <td><?=$nominsp?></td>                                                                  
                    <td><?=$NOM?></td>                                                                                      
                    <td><?=$arrIncumplimientos[$w][0]?></td>
                    <td><?=$arrIncumplimientos[$w][3]?></td>
                    <td><?=$arrIncumplimientos[$w][1]?></td>
                    <td><?=$arrIncumplimientos[$w][2]?></td>      
                    <td><?=$hinicio?></td>                          
                    <td><?=$hfin?></td>                                              
                                                                                                 
  </tr>
			<?
			 }
		$I++;			
          } ////if si $QUIENINSPECCIONA

	    }

		 ?>		
</table>
