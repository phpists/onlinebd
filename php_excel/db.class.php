<?php

class DB_CLASS
{
	private $host = 'localhost';
	private $db_name = 'cod_onlinebd';
	private $db_user = 'root';
	private $db_pass = '';

	private $DB;

	public  function __construct() {
			$this->newConnection($this->host, $this->db_name, $this->db_user, $this->db_pass, array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}

	/**
	 * Підключення до БД
	 */
	public function newConnection($host, $db_name, $db_user, $db_pass, $options){
		try {
			$this->DB = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_pass, $options);
			$this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//$this->DB->exec("set names utf8");
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * Отримуємо один рядок
	 */
	public function getRows($query, $params = array()){
		try {
			$row = $this->DB->prepare($query);
			$row->execute($params);
			return $row->fetchAll( PDO::FETCH_ASSOC );
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	/**
	 * Отримуємо дані по вказаному полі
	 * $select - які поля вибираємо (string)
	 * $table - таблиця з якої вибираємо (string)
	 * $column - по якому стовпцю вибираємо (string)
	 * $data - значення (array)
	 */
	public function getSelRows($select = '*', $table, $column, $data = 'null'){
		try {
			$in = str_repeat('?,', count($data) - 1) . '?';
			$sql = 'SELECT ' . $select . ' FROM ' . $table . ' WHERE ' . $column . ' IN (' . $in . ')';
			$stm = $this->DB->prepare($sql);
			$stm->execute($data);
			return $stm->fetchAll(PDO::FETCH_COLUMN);
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

}