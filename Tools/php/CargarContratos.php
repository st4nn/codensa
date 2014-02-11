<?php
	include "../../include/VarGlobales.PHP"; 
	require("../../include/BdSqlClases.php");

	$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);

	$idEmpresa = $_POST['idEmpresa'];

   $sql="
   	SELECT
	  	EC_ID,
	  	EC_Contrato,
	  	EC_Descripcion
	FROM
		Empresa_Contratos
	WHERE
		Em_Id = $idEmpresa";
	
	$q->ejecutar($sql,104,'RepIncumplimientos.php');	   

	class Contrato
	{
		public $IdContrato;
		public $NumContrato;
		public $Descripcion;
	}
	$idx=0;
	while($q->Cargar())
	{ 
	   $Contratos[$idx] = new Contrato();
	   $Contratos[$idx]->IdContrato = $q->dato(0);
	   $Contratos[$idx]->NumContrato = utf8_encode($q->dato(1));
	   $Contratos[$idx]->Descripcion = utf8_encode($q->dato(2));

	   $idx++;
	}  
	
	if ($idx > 0)
	{
		echo json_encode($Contratos);
	} else
	{
		echo 0;
	}
	
	
	
?>
	