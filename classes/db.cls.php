<?php

class DB {

	private static $_instance = null;

	public $_pdo;

	private $_query,
			$_error = false,
			$_results,
			//$_lastid,
			$_count = 0;

	private function __construct() {
		try {
			$this->_pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance()
	{
		if(!isset(self::$_instance)) {
			self::$_instance = new DB();
		}

		return self::$_instance;
	}

	public function query($sql, $params = array())
	{
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if(count($params)){
				foreach ($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}

			if($this->_query->execute()){
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
				//$this->_lastid = $this->_query->lastInsertId();
			} else {
				$this->_error = true;
			}
		}

		return $this;
	}


	public function error()
	{
		return $this->_error;
	}

	public function count()
	{
		return $this->_count;
	}

	public function results()
	{
		return $this->_results;
	}

	public function first()
	{
		$data = $this->results();
		return $data[0];
	}
}