$(document).on("ready", arranque);
var Meses = ['Ninguno', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
function arranque (argument) 
{
	$("#cboEmpresas").on("change", cboEmpresas_Change);
	$("#cboContrato").on("change", cboContrato_Change);
	$("#btnBuscar").on("click", btnBuscar_Click);
}
function cboEmpresas_Change (argument) 
{
	var pIdEmpresa = $(this).val();
	$.post("Tools/php/CargarContratos.php", {idEmpresa : pIdEmpresa}, 
		function (data) 
		{
			$("#cboContrato").find("option").remove();
			if (data != 0)
			{
				$("#cboContrato").append("<option value='0' Descripcion='Ningún contrato Seleccionado'> </option>");
				$("#Contrato_Descripcion").text("No ha seleccionado un Contrato");
				$.each(data, function (index, value)
					{
						$("#cboContrato").append("<option value='" + value.IdContrato + "' Descripcion='" + value.Descripcion + "'>"+ value.NumContrato + "</option>");
					});
			}
			
		}, "json");
}
function cboContrato_Change (argument) 
{
	$("#Contrato_Descripcion").html($("#cboContrato option:selected").attr("Descripcion"));
}
function btnBuscar_Click (argument) 
{
	var pIdEmpresa = $("#cboEmpresas option:selected").val();
	var pIdContrato = $("#cboContrato option:selected").val();

	argument.preventDefault();
	var tableBody = $("#tablaIncumplimientos").find("tbody");
	$('#tablaIncumplimientos').dataTable().fnDestroy();
	$(tableBody).find("tr").remove();

	$.post("Tools/php/CargarIncumplimientos.php", 
		{
			Desde: $("#f1").val(),
			Hasta: $("#f2").val(),
			idEmpresa : pIdEmpresa,
			IdContrato : pIdContrato
		}, 
		function (data) 
		{
			
			if (data != 0)
			{
				$.each(data, function(index, value)
					{
						var tds = "<tr>";
						tds += "<td>" + value.Anio + "</td>";
						tds += "<td>" + Meses[value.Mes] + "</td>";
						tds += "<td>" + value.Empresa + "</td>";
						tds += "<td>" + value.Contrato + "</td>";
						tds += "<td>" + value.Item + "</td>";
						//tds += "<td>" + value.Valor + "</td>";
						tds += "<td>" + value.Cantidad + "</td>";
						tds += "</tr>";

						tableBody.append(tds);
					});
			}
			$('#tablaIncumplimientos').dataTable({
					"sDom": 'CWT<"clear">lfrtip',
						"oTableTools": 
							{
						"sSwfPath": "Tools/datatable/media/swf/copy_csv_xls_pdf.swf",
						"aButtons": [
			                "print",
			                {
			                    "sExtends":    "collection",
			                    "sButtonText": "Guardar",
			                    "aButtons":    [ "csv", "xls", "pdf" ]
			                }
			            			]
							},
							"oColumnFilterWidgets": 
							{
						"sSeparator": "\\s*/+\\s*"
							}
					});	
		},
		"json");
	// body...
}