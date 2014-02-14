<?

include "include/VarGlobales.PHP"; 
require("include/BdSqlClases.php");

	$EM_ID = $_POST['Empresa'];
$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);


			 $sql="SELECT    EC_ID, EM_ID, EC_CONTRATO, EC_Descripcion

					FROM         EMPRESA_CONTRATOS
					where  EC_ACTIVA = 'SI' AND EM_ID='$EM_ID'";
               //echo $sql;
                $q->ejecutar($sql,14,'obtenerContratos.php.php');
				$Nofilas=$q->filas();	   
class Contrato
	{
		public $IdContrato;
		public $Nombre;
		public $Descripcion;
	}
	$Index = 0;

	$Contratos[$Index] = new Contrato();

	$Contratos[$Index]->IdContrato ='';
	$Contratos[$Index]->Nombre ='NINGUNA';
	$Contratos[$Index]->Descripcion =utf8_encode('No marcar ningun Contrato');
				
				if ($Nofilas>0)
				{
					$Index = 1;
					while($q->Cargar())
					{
						$Contratos[$Index] = new Contrato();

						$Contratos[$Index]->IdContrato =$q->dato(0);
						$Contratos[$Index]->Nombre =$q->dato(2);
						$Contratos[$Index]->Descripcion =utf8_encode($q->dato(3));

					  $Index++;
					}
				}	
	echo json_encode($Contratos);
?>