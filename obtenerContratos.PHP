<?

include "include/VarGlobales.PHP"; 
require("include/BdSqlClases.php");


$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);


			 $sql="SELECT    EC_ID, EM_ID, EC_CONTRATO, EC_DESCORTA

					FROM         EMPRESA_CONTRATOS
					where  EC_ACTIVA = 'SI' AND EM_ID='$EM_ID'";
               //echo $sql;
                $q->ejecutar($sql,14,'obtenerContratos.php.php');
				$Nofilas=$q->filas();	   
				echo "<select name='EC_ID' id='EC_ID' class='".$CLASE."'  >";
				

				if ($Nofilas==1)
				{
				  $q->Cargar();
				  $Nombre= $q->dato(2).":".$q->dato(3);
                  $valor= $q->dato(0);
                  echo "<option value='".$valor."' selected>".$Nombre."</option>";
				
				}
				if ($Nofilas>1)
				{
					echo "<option value=''>Seleccione</option>";
					while($q->Cargar())
					{
					  $Nombre= $q->dato(2).":".$q->dato(3);
					  $valor= $q->dato(0);
					  echo "<option value='".$valor."'>".$Nombre."</option>";
					}
				}
				if ($Nofilas==0)
				{
				  echo "<option value=''>No hay contratos para esta empresa</option>";
				}	
                echo "</select>";
	
  
?>