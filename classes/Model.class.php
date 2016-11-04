<?php
class Model {
	private $_db = null;
	public function __construct() {
		try{
    		$this->_db = new \PDO('mysql:host=mysql.hostinger.com.ua;dbname=u825262943_db1;charset=utf8',
                        'u825262943_db1',
                        '12345678',
                        array(
                            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false,
                            \PDO::ATTR_EMULATE_PREPARES => false
                        )
                    );

		}
		catch(\PDOException $e){
    		print($e->getMessage()); die();
		} 
	}
	private function getdb() {
		if(is_null($this->_db))
		{
			$this->_db = new self();
		}
		return $this->_db;
	}
	public function save_log($ip, $sda, $eda, $res, $et) {
		$this->getdb()->beginTransaction();
		try{
			$handle = $this->getdb()->prepare('insert into log(ip,sda,eda,res,et) values(?,?,?,?,?)');
			$handle->bindValue(1, $ip, PDO::PARAM_STR);
			$handle->bindValue(2, $sda, PDO::PARAM_STR);
			$handle->bindValue(3, $eda, PDO::PARAM_STR);
			$handle->bindValue(4, $res, PDO::PARAM_INT);
			$handle->bindValue(5, $et, PDO::PARAM_INT);
			$handle->execute();
			$this->getdb()->commit();
		}
		catch(\PDOException $e){
			$this->getdb()->rollBack();
			throw new Exception($e->getMessage());
		}


	}
}