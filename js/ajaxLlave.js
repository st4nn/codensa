

var listadoSelects=new Array();
listadoSelects[0]="CL_ID";
listadoSelects[1]="SB_ID";
listadoSelects[2]="NC_ID";


var listadoSelects2=new Array();
listadoSelects2[0]="EM_ID";
listadoSelects2[1]="EC_ID";


function buscarEnArray(array, dato)
{
        // Retorna el indice de la posicion donde se encuentra el elemento en el array o null si no se encuentra
        var x=0;
        while(array[x])
        {
                if(array[x]==dato) return x;
                x++;
        }
        return null;
}

function BusInfoEmp(cedula, LINEA, pag, res ) {
	 

     lugar = "Uno"
	 datos_post="cedula="+cedula+"&CanC="+LINEA+"&resto="+res
	// pag="BuscarInfoEmpleados.php"
	 envia(pag,datos_post)



}

function cargarSub(Idclasificacion,idSelectOrigen, SB_ID)
{  

// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
        var posicionSelectDestino=buscarEnArray(listadoSelects, idSelectOrigen)+1;
        // Obtengo el select que el usuario modifico
        var selectOrigen=document.getElementById(idSelectOrigen);
        // Obtengo la opcion que el usuario selecciono
        var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
        // Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."

if(opcionSeleccionada==0)
        {
                var x=posicionSelectDestino, selectActual=null;
                // Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
                while(listadoSelects[x])
                {
                        selectActual=document.getElementById(listadoSelects[x]);
                        selectActual.length=0;

                        var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecione...";
                        selectActual.appendChild(nuevaOpcion);        selectActual.disabled=true;
                        x++;
                }
        }
        // Compruebo que el select modificado no sea el ultimo de la cadena
        else if(idSelectOrigen!=listadoSelects[listadoSelects.length-1])
        {
                // Obtengo el elemento del select que debo cargar
                var idSelectDestino=listadoSelects[posicionSelectDestino];
                var selectDestino=document.getElementById(idSelectDestino);
                // Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen

                var ajax=GetXmlHttpObject();
                ajax.open("GET", "Obtenercajones.php?CL_ID="+Idclasificacion+"&SB_ID="+SB_ID, true);
                ajax.onreadystatechange=function()
                {
                        if (ajax.readyState==1)
                        {
                                // Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
                                selectDestino.length=0;
                                var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
                                selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;
                        }
                        if (ajax.readyState==4)
                        {
                                selectDestino.parentNode.innerHTML=ajax.responseText;
                        }
                }
                ajax.send(null);
        }



}

function CargarContratos(IdEmpresa,idSelectOrigen, CLASE)
{  


// Obtengo la posicion que ocupa el select que debe ser cargado en el array declarado mas arriba
        var posicionSelectDestino=buscarEnArray(listadoSelects2, idSelectOrigen)+1;
        // Obtengo el select que el usuario modifico
        var selectOrigen=document.getElementById(idSelectOrigen);
        // Obtengo la opcion que el usuario selecciono
        var opcionSeleccionada=selectOrigen.options[selectOrigen.selectedIndex].value;
        // Si el usuario eligio la opcion "Elige", no voy al servidor y pongo los selects siguientes en estado "Selecciona opcion..."

if(opcionSeleccionada==0)
        {
                var x=posicionSelectDestino, selectActual=null;
                // Busco todos los selects siguientes al que inicio el evento onChange y les cambio el estado y deshabilito
                while(listadoSelects2[x])
                {
                        selectActual=document.getElementById(listadoSelects2[x]);
                        selectActual.length=0;

                        var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Selecione...";
                        selectActual.appendChild(nuevaOpcion);        selectActual.disabled=true;
                        x++;
                }
        }
        // Compruebo que el select modificado no sea el ultimo de la cadena
        else if(idSelectOrigen!=listadoSelects2[listadoSelects2.length-1])
        {
                // Obtengo el elemento del select que debo cargar
                var idSelectDestino=listadoSelects2[posicionSelectDestino];
                var selectDestino=document.getElementById(idSelectDestino);
                // Creo el nuevo objeto AJAX y envio al servidor el ID del select a cargar y la opcion seleccionada del select origen
                
                var ajax=GetXmlHttpObject();
                
				ajax.open("GET", "obtenerContratos.php?EM_ID="+IdEmpresa+"&CLASE="+CLASE, true);
                ajax.onreadystatechange=function()
                {   
                        if (ajax.readyState==1)
                        {
                                // Mientras carga elimino la opcion "Selecciona Opcion..." y pongo una que dice "Cargando..."
                                selectDestino.length=0;
                                var nuevaOpcion=document.createElement("option"); nuevaOpcion.value=0; nuevaOpcion.innerHTML="Cargando...";
                                selectDestino.appendChild(nuevaOpcion); selectDestino.disabled=true;
                        }
                        if (ajax.readyState==4)
                        {
                                selectDestino.parentNode.innerHTML=ajax.responseText;
                        }
                }
                ajax.send(null);
        }



}

function stateChanged()
{
        if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
        {
                document.getElementById("txtHint").innerHTML=xmlHttp.responseText
        }
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}

/*nuevas variables para ver solo la fila adicional a scr*/
var READY_STATE_COMPLETE=4;
var peticion_http = null;

function inicializa_xhr() {
  if(window.XMLHttpRequest) {
    return new XMLHttpRequest();
  }
  else if(window.ActiveXObject) {
    return new ActiveXObject("Microsoft.XMLHTTP");
  }
}

function envia(pag, datos_post) {
	//alert(pag)
  peticion_http = inicializa_xhr();
  if(peticion_http) {
	peticion_http.onreadystatechange = procesaRespuesta;
    peticion_http.open("POST", pag, true);
    peticion_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    peticion_http.send(datos_post);
  }
}
function procesaRespuesta() {

  if(peticion_http.readyState == READY_STATE_COMPLETE) {
    if(peticion_http.status == 200) {
                resultado_ajax_obtenido(peticion_http.responseText)
    }
  }
}
function resultado_ajax_obtenido(resultado_ajax)
{
        document.getElementById(lugar).innerHTML = resultado_ajax
}