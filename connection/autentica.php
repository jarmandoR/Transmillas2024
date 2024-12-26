<?php
class UserAuthentication
{
  private $_session_namespace = "sistema_usuario"; 
  private $_user_table = "usuarios"; /* Nombre de la tabla de usuarios */
  private $_db;
  const default_db_user = 'root';
  const default_db_pass = '';
  const default_db_name = 'mercycorps';
  const default_db_host = 'localhost';

  public function __construct($pdoConnection = NULL)
  {
    if(!$pdoConnection)
      $pdoConnection = $this->getConnection();
    $this->_db = $pdoConnection;
  }

  private function getConnection()
  {
    $dsn = 'mysql:dbname='.self::default_db_name.';host='.self::default_db_host;
    try {
      $dbh = new PDO($dsn, self::default_db_user, self::default_db_pass);
    } catch (PDOException $e) {
      die( 'Connection failed: ' . $e->getMessage() );
    }
    return $dbh;
  }
  
  /*
   * Responde si el usuario activo está autenticado en sesión.
   */
  public function isAuthenticated()
  {
    return $this->getSession('user_authenticated') === true;
  }
  /*
   * Realiza un Login y guarda los datos en sesión.
   */
  public function doLogin($username,$password)
  {
    $result = $this->checkLoginInDB($username,$password);
    if(!$result) {
      $this->doLogout();
      return false;
    }

    $this->setSession('user_authenticated',true);
    $this->setSession('username',$result['username']);
    $this->setSession('id',$result['id']);

    return true;
  }

  /*
   * Quita al usuario de sesión.
   */
  public function doLogout()
  {
    $this->destroySession();
  }

  /*
   * Verifica si el usuario está en la base de datos.
   */
  private function checkLoginInDB($username,$password)
  {
    try {
      $query = 'SELECT id, username FROM '. $this->_user_table . ' WHERE ';
      $query .= ' username = ? AND password = ? ';
      $sth = $this->_db->prepare($query);
      $sth->execute(array($username,$this->encryptPassword($password)));
      return $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      die( 'Query failed: ' . $e->getMessage() );
    }
  }

  /*
   * Encripta un password en texto plano.
   */
  private function encryptPassword($password)
  {
    return sha1($password);
  }
  
  private function getSession($key)
  {
    $session = $_SESSION[$this->_session_namespace];
    if(isset($session[$key]))
      return $session[$key];
    return null;
  }
  private function setSession($key,$val)
  {
    return $_SESSION[$this->_session_namespace][$key] = $val;
  }
  private function destroySession()
  {
    $_SESSION[$this->_session_namespace] = null;
    unset($_SESSION[$this->_session_namespace]);
  }

}