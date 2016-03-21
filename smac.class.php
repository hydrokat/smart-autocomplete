<?php

require_once('config.php');

class SmartAutoComplete {

	public $host 	= "localhost";
	public $dbname 	= "db_smac";
	public $tblname = "root";
	public $dbun	= "root";
	public $dbpw 	= "tbl_smartautocomplete";
	public $db;

	public $field = "";
	public $entry = "";

	function __construct() {
		
	}

	/*
	 * This sets up the database
	 *
	 * Parameters:
	 *     	(host) - hostname/ip
	 *     	(dbname) - database name
	 *     	(tblname) - table name
	 *     	(dbun) - database username
	 *     	(dbpw) - database password
	*/
	function setDatabase($host, $dbname, $tblname, $dbun, $dbpw) {
		$this -> host    	= $host 	== '' ? $this -> host : $host;
		$this -> dbname 	= $dbname 	== '' ? $this -> dbname : $dbname;
		$this -> dbun   	= $dbun 	== '' ? $this -> dbun : $dbun;
		$this -> dbpw   	= $dbpw 	== '' ? $this -> dbpw : $dbpw;
		$this -> tblname 	= $tblname	== '' ? $this -> tblname : $tblname;

		$this -> db = new PDO('mysql:host=' . $this -> host . ';dbname=' . $this -> dbname . ';charset=utf8', $this -> dbun, $this -> dbpw);
	}

	/*
	 * Fetch the field and the number of hits in descending order.
	 *
	 * Parameters:
	 *     	(fieldName) - The name of the field to fetch
	 *     	(order) - DESC or ASC
	 * Return:
	 *	    (rows) - return rows in JSON format
	*/
	function fetchField($fieldName, $order = 'ASC') {
		$order = $order == "ASC" ? "ASC" : "DESC";

		$stmt = $this -> db -> prepare("SELECT * FROM " . $this -> tblname . " WHERE fieldName=:fn ORDER BY hits " . $order);
		$stmt->bindValue(':fn', $fieldName, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return json_encode($rows);
	}

	/*
	 * Fetch the field and the number of hits in descending order.
	 *
	 * Parameters:
	 *     	(field) - The name of the field to group to
	 *     	(entry) - The entry of the field
	*/
	function receiveField($field, $entry) {
		$this -> field = strtolower($field);
		$this -> entry = $entry;

		$action = "";

		$stmt = $this -> db -> prepare('SELECT * FROM ' . $this -> tblname . ' WHERE fieldName = :fn AND entry = :entry');
		$stmt->bindValue(':fn', $this -> field, PDO::PARAM_STR);
		$stmt->bindValue(':entry', $this -> entry, PDO::PARAM_STR);
		$stmt->execute();
		$row_count = $stmt->rowCount();
		
		if($row_count > 0) {			
			$this -> updateField();
			$action = "updated.";
		} else {
			$this -> saveField();
			$action = "saved.";
		}

		return $this -> field . " " . $action;
	}

	/*
	 * Fetch the field and the number of hits in descending order.
	 * 
	 * Return:
	 *	    (affected_rows) - return affected field
	*/
	function saveField() {
		$stmt = $this -> db -> prepare("INSERT INTO " . $this -> tblname . " (fieldName, entry, hits) VALUES(:fn, :entry, 1)");
		$stmt->bindValue(':fn', $this -> field, PDO::PARAM_STR);
		$stmt->bindValue(':entry', $this -> entry, PDO::PARAM_STR);
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
		return $affected_rows;
	}

	/*
	 * Fetch the field and the number of hits in descending order.
	 * 
	 * Return:
	 *	    (affected_rows) - return affected field
	*/
	function updateField() {
		$stmt = $this -> db -> prepare("UPDATE " . $this -> tblname . " SET hits = hits + 1 WHERE fieldName = :fn AND entry = :entry");
		$stmt->bindValue(':fn', $this -> field, PDO::PARAM_STR);
		$stmt->bindValue(':entry', $this -> entry, PDO::PARAM_STR);
		$affected_rows = $stmt -> execute();
		return $affected_rows.' were affected';
	}
}