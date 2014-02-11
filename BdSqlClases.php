<?php
class ConecteMysql{
 var $f;
 var $t;
 var $e;
 function ConecteMysql($servidor,$usrbd,$clave,$NomBD)
 {
   $this->f=mssql_pconnect($servidor,$usrbd,$clave)
         or die("ERROR 00001: No se puede conectar con el servidor $servidor. Verifique VarGlobales.php<br>");
  if($this->f)
  {
   mssql_select_db($NomBD,$this->f)
        or die("ERROR 00002: Error al Seleccionar la Base de datos $NomBd. Verifique VarGlobales.php <br>");
  }
 }
 function ejecutar($sentencia, $linea,$codigoPHP)
 {
   $this->t=mssql_query($sentencia,$this->f)  or die ('Error 00003: '.$codigoPHP.' <br> Linea: '.$linea .' <br> Error al  ejecutar la consulta: <BR> ' . $sentencia);

 }
 function filas()
 {
    return mssql_num_rows($this->t);
 }
 function Cargar()
 {
   $this->e=mssql_fetch_array($this->t) ;
   return $this->e;
 }
 function dato($index)
 {
   return $this->e[$index];
 }
 function filasAfectadas()
{
 //ECHO "HOLA";
 $result = mssql_query("SELECT @@ROWCOUNT");
 list($affected) = mssql_fetch_row($result);
 return $affected;
}


 function IniProce($correo,$titulo,$mensaje)
 {
 //ECHO "HOLA";
  //buscar el nombre del procedimiento almacenado
  //este procedimiento no tiene variables y envia al correo crodriguez
  //$stmt=mssql_init("envio",$this->f);

  //este procedimiento va con parametros
  $stmt=mssql_init("enviar_mails",$this->f);
  //aqui agregados los parametros de entrada[/b]
  mssql_bind($stmt, "@recipientsP",$correo,SQLVARCHAR,FALSE,FALSE,250);
  mssql_bind($stmt,'@subjectP',$titulo,SQLVARCHAR,FALSE,FALSE,250);
  mssql_bind($stmt,'@messageP',$mensaje,SQLVARCHAR,FALSE,FALSE,250);
  mssql_execute($stmt);

  echo "correo enviado a:".$correo;
 }

  function MenError($Men)
  {
?>
   <script language="JavaScript" type="text/JavaScript">
   <!--
     function MM_popupMsg(msg) { //v1.0
       alert(msg);
     }
   -->
   </script>
   <body onLoad="MM_popupMsg('<? echo $Men ?>')">
<?
  }
}

?>