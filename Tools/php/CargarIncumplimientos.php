<?php
	include "../../include/VarGlobales.PHP"; 
	require("../../include/BdSqlClases.php");

	$q=new ConecteMysql($ServidorBD,$UsrBD,$ClaveBD,$NomBD);

		$Empresa = $_POST['idEmpresa'];
		$Contrato = $_POST['IdContrato'];
		$Desde = $_POST['Desde'];
		$Hasta = $_POST['Hasta'];

		if ($Empresa > 0)
		{
			$Empresa = " AND p3.Em_Id = '$Empresa' ";
		} else
		{
			$Empresa = "";
		}
		
		if ($Contrato > 0)
		{
			$Contrato = " AND p2.EC_Id = '$Contrato' ";
		} else
		{
			$Contrato = "";
		}

		if ($Desde <> "")
		{
			$Desde = " AND p2.GE_FECHA >= '$Desde' ";
		} else
		{
			$Desde = "";
		}

		if ($Hasta <> "")
		{
			$Hasta = " AND p2.GE_FECHA <= '$Hasta' ";
		} else
		{
			$Hasta = "";
		}
//DateName( month , DateAdd( month , MONTH(p2.GE_FECHA) , 0 ) - 1 ), 
		/*
   $sql="
   SELECT  
   		MONTH(p2.GE_FECHA),
		p3.EM_Nombre, 
		p4.EC_Contrato , 
		p1.NC_ID, 
		p5.NC_VALOR,
		p5.NC_Descripcion,
		YEAR(p2.GE_FECHA),
		COUNT(p1.NC_ID)
	FROM
		IPAL_DETALLE p1 
			INNER JOIN IPAL p2 ON p1.GE_NO_INSPECCION = p2.GE_NO_INSPECCION 
			INNER JOIN EMPRESA_Contratos p4 ON p4.EC_ID = p2.EC_ID
			INNER JOIN EMPRESAS p3 ON p3.Em_ID = p4.Em_Id
			INNER JOIN NC_Listado p5 ON p5.NC_ID = P1.Nc_Id
	WHERE 
		$Desde
		$Hasta
		$Empresa
		$Contrato
	GROUP BY
		YEAR(p2.GE_FECHA),
		MONTH(p2.GE_FECHA),
		p3.EM_Nombre, 
		p4.EC_Contrato 
	ORDER BY 7, 1";
	*/

	$sql = "
	SELECT  
   		MONTH(p2.GE_FECHA),
		p3.EM_Nombre, 
		p4.EC_Contrato , 
		p1.NC_ID, 
		p5.NC_VALOR,
		p5.NC_Descripcion,
		YEAR(p2.GE_FECHA),
		COUNT(p1.NC_Id)
	FROM
		IPAL_DETALLE p1 
			INNER JOIN IPAL p2 ON p1.GE_NO_INSPECCION = p2.GE_NO_INSPECCION 
			INNER JOIN EMPRESA_Contratos p4 ON p4.EC_ID = p2.EC_ID
			INNER JOIN EMPRESAS p3 ON p3.Em_ID = p4.Em_Id
			INNER JOIN NC_Listado p5 ON p5.NC_ID = P1.Nc_Id
	WHERE 
		p5.NC_Valor = 50
		AND p1.DE_RESULTADO = 'NO'
		$Desde
		$Hasta
		$Empresa
		$Contrato
	GROUP BY
		YEAR(p2.GE_FECHA),
		MONTH(p2.GE_FECHA),
		p3.EM_Nombre, 
		p4.EC_Contrato,
		p1.NC_ID,
		p5.NC_VALOR,
		p5.NC_Descripcion
	";
	
	$q->ejecutar($sql,104,'RepIncumplimientos.php');	   

	class Contrato
	{

		public $Mes;
		public $Empresa;
		public $Contrato;
		public $Valor;
		public $Item;
		public $Anio;
		public $Cantidad;
	}
	$idx=0;
	while($q->Cargar())
	{ 
	   $Contratos[$idx] = new Contrato();
	   $Contratos[$idx]->Mes = $q->dato(0);
	   $Contratos[$idx]->Empresa = utf8_encode($q->dato(1));
	   $Contratos[$idx]->Contrato = utf8_encode($q->dato(2));
	   $Contratos[$idx]->Valor = utf8_encode($q->dato(4));
	   $Contratos[$idx]->Item = utf8_encode($q->dato(3) . " - " . $q->dato(5));
	   $Contratos[$idx]->Anio = $q->dato(6);
	   $Contratos[$idx]->Cantidad = $q->dato(7);

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
	