<?php
class User extends Db_object{
	protected static $db_table ="users";
	protected static $db_table_fields =array('username', 'password', 'first_name', 'last_name');
	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $password;


	public static function verify_user($username, $password){
		global $database;
		$username = $database->escape_string($username);
		$password = $database->escape_string($password);
		$sql = "SELECT * FROM ".self::$db_table." WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

		$result_set = self::find_by_query($sql);
		return !empty($result_set) ? array_shift($result_set) : false;
	}
}

?>