
<?
 //llamado al encabezado del menu
 //llamado al menu
 
 //llamado a la tabla que contiene el menu
 //llamado alas clases
 
 
include "include/MenuHeader.php";
include "include/Menu.php";

MenuHeader();
include "include/TablaMenu.php";
require("include/BdSqlClases.php");


 $sqlDeInicio="select ZONAS.zo_codigo, zo_nombre
          FROM           USUARIOS_ZONAS INNER JOIN
               ZONAS ON USUARIOS_ZONAS.ZO_CODIGO = ZONAS.ZO_CODIGO
               where USUARIOS_ZONAS.US_USUARIO='$usr'
               order by zo_nombre";

?>
