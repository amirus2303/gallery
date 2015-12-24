<?php
class Database{
	public $connexion;

	public function __construct(){
		$this->open_db_connexion();
	}


	public function open_db_connexion(){
		//$this->connexion = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$this->connexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$this->connexion->set_charset('UTF8');
		if($this->connexion->connect_errno){
			die('Database connexion failed'.$this->connexion->connect_error);
		} else{
			//die('database success');
		}
	}

	public function query($sql){
		$result = $this->connexion->query($sql);
		$this->confirm_query($result);
		return $result;
	}

	private function confirm_query($result){
		if(!$result){
			die('Query error'. $this->connexion->error);
		}
	}

	public function escape_string($query){
		$escape_string = $this->connexion->real_escape_string($query);
		return $escape_string;
	}
}

$database = new Database();
?>