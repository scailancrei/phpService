<?php
 /**
 * Clase para operaciones con la base de datos
 * @version 1.0
 * @package paises
 */
class postal
 {
  /**
  * Objeto que almacenará la base de datos PDO
  * @var object $dewes
  */
  private $dwes;
  /**
  * Constructor de la base de datos
  * @access public
  * @global string $serv Servidor donde está alojada el servidor de base de datos
  * @global string $base Nombre de la base de datos
  * @global string $usu Usuario de acceso a la base de datos
  * @global string $pas Contraseña para acceder a la base de datos
  * @throws exception $ex lanza una excepción si se produce algún error
  */
  public function __construct() 
   {
    global $serv,$base,$usu,$pas;
    $serv="localhost";$base="postal";$usu="root";$pas="root";
    try 
     {
      $this->dwes= new PDO('mysql:host='.$serv.';dbname='.$base.'', ''.$usu.'', ''.$pas.'');
      $this->dwes->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->dwes->query("SET NAMES 'utf8'");
     } 
    catch (Exception $ex) 
     {
      throw $ex;
     }
   }
  /**
  * Método que nos permite realizar consultas a la base de datos
  * @access private
  * @param string $sql Sentencia sql a ejecutar
  * @return array $resultado Resultado de la consulta
  * @throws exception $ex Lanzamos una excepción si se produce un error
  */
  private function ejecutaConsulta($sql) 
   {    
    try 
     { 
      $resultado = null;
      if (isset($this->dwes)) $resultado = $this->dwes->query($sql);
      return $resultado;
     }
    catch (Exception $ex) 
     {
      throw $ex;
     }
   } 
  /**
  * Método que nos permite devolver la poblacion a partir del codigo postal
  * @access public
  * @param string $cod_postal Código postal
  * @return string $resultado Resultado de la consulta
  * @throws exception $ex lanza una excepción si se produce un error
  */  
  public function getPoblacion($cod_postal) 
   {
    $sql = "SELECT poblacion FROM poblacion where postal = '$postal';";
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) 
     {
      $row = $resultado->fetch();
      return $row[0];
     } 
    else 
     {
      throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
     }
   }
  /**
  * Método que nos permite devolver el codigo iso a partir de su nombre
  * @access public
  * @param string $nombre Código del pais
  * @return string $resultado Resultado de la consulta
  * @throws exception $ex lanza una excepción si se produce un error
  */  
  public function getIso($cod_postal) 
   {
    $sql = "SELECT iso FROM paises where nombre = '$nombre';";
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) 
     {
      $row = $resultado->fetch();
      return $row[0];
     } 
    else 
     {
      throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
     }
   }
  /**
  * Método que nos permite devolver el codigo iso y nombre de los paises
  * @access public
  * @return array $datos Resultado de la consulta
  * @throws exception $ex lanza una excepción si se produce un error
  */     
  public function getListado() 
   {
    $sql = "SELECT iso,nombre FROM paises;";
    $resultado = $this->ejecutaConsulta($sql);
    if ($resultado) 
     {
      $datos=$resultado->FetchAll();
      return $datos;
     } 
    else 
     {
      throw new Exception($this->dwes->errorInfo()[2], $this->dwes->errorInfo()[1]);
     }
   }
 };
?>