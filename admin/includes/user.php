<?php
class User{
	public $id;
	public $username;
	public $first_name;
	public $last_name;
	//public $password;

	public static function find_all_users(){
		return self::find_this_query("SELECT * FROM users");
	}

	public static function find_user_by_id($id){
		$result_set = self::find_this_query("SELECT * FROM users WHERE id= $id");
		return !empty($result_set) ? array_shift($result_set) : false;
	}

	public static function find_this_query($sql){
		global $database;
		$result_set = $database->query($sql);
		$object_tables= array();
		while($row = $result_set->fetch_assoc()){
			$object_tables[] = self::instantiation($row);
		}
		return $object_tables;
	}

	public static function verify_user($username, $password){
		global $database;
		$username = $database->escape_string($username);
		$password = $database->escape_string($password);
		$sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

		$result_set = self::find_this_query($sql);
		return !empty($result_set) ? array_shift($result_set) : false;
	}

	public static function instantiation ($the_record){
		$the_object = new self;
		foreach ($the_record as $key => $value) {
			if(property_exists($the_object, $key)){
				$the_object->$key = $value;
			}
		}

		return $the_object;
	}
}

?>