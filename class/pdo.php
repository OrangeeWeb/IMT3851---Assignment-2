<?php 
class database extends App{
	protected $_db_host;
	protected $_db_username;
	protected $_db_password;
	protected $_db_name;
	public $_db;
	
	public function __construct() {
        parent::__construct();
        
        // getting database information from the config.ini file
        // Setting up all PDO stuff
        $this->_db_host = $this->config['host'];
        $this->_db_username = $this->config['username'];
        $this->_db_password = $this->config['password'];
        $this->_db_name = $this->config['name'];

        try {
            $this->_db = new PDO('mysql:host='.$this->_db_host.';dbname='.$this->_db_name, $this->_db_username, $this->_db_password);
            $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            die("Error: ".$e);
        }
	}
	public function arrayBinder(&$pdo, &$array) {
		foreach ($array as $key => $value) {
			$pdo->bindValue(':'.$key,$value);
		}
	}
	public function arrayBinderInt(&$pdo, &$array) {
		foreach ($array as $key => $value) {
			$pdo->bindValue(':'.$key, (int) $value, PDO::PARAM_INT);
		}
	}	
}
$app->setPDO(new database());