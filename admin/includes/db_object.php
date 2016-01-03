<?php

class Db_object{


	public static function find_all(){
		return static::find_by_query("SELECT * FROM ".static::$db_table."");
	}


	public static function find_by_id($id){
		$result_set = static::find_by_query("SELECT * FROM ".static::$db_table." WHERE id= $id");
		return !empty($result_set) ? array_shift($result_set) : false;
	}


	public static function find_by_query($sql){
		global $database;
		$result_set = $database->query($sql);
		$object_tables= array();
		while($row = $result_set->fetch_assoc()){
			$object_tables[] = static::instantiation($row);
		}
		return $object_tables;
	}


	public static function instantiation ($the_record){
		$calling_class = get_called_class();
		$the_object = new $calling_class;
		foreach ($the_record as $key => $value) {
			if(property_exists($the_object, $key)){
				$the_object->$key = $value;
			}
		}

		return $the_object;
	}


	protected function has_the_attribute($the_attribute){
		$object_properties = get_object_vars($this);
		return array_key_exists($the_attribute, $object_properties);
	}


	protected function properties(){
		//return get_object_vars($this);
		$properties = array();
		foreach (static::$db_table_fields as $db_field) {
			if (property_exists($this, $db_field)){
				$properties[$db_field] = $this->$db_field;
			}
		}
		return $properties;
	}


	protected function clean_properties(){
		global $database;
		$clean_properties =array();
		foreach ($this->properties() as $key => $value) {
			$clean_properties[$key] = $database->escape_string($value);
		}
		return $clean_properties;
	}

	public function save(){
		return isset($this->id) ? $this->update() : $this->create();
	}



	public function create(){
		global $database;
		$properties = $this->clean_properties();
		$sql = "INSERT INTO ". static::$db_table." (". implode(", ", array_keys($properties)) . ") ";
		$sql .= "VALUES ('". implode("', '", array_values($properties)) ."')";
		
		if($database->query($sql)){
			$this->id = $database->the_insert_id();
			return true;
		} else{
			return false;
		}

	}



	public function update(){
		global $database;
		$properties = $this->clean_properties();
		$properties_pairs = array();
		foreach ($properties as $key => $value) {
			$properties_pairs[]="{$key} = '{$value}'" ;
		}
		$sql = "UPDATE ". static::$db_table." SET ";
		$sql .= implode(", ", $properties_pairs);
		$sql .= " WHERE id = ".$database->escape_string($this->id);
		/*$sql .= "username = '".$database->escape_string($this->username)."', ";
		$sql .= "password = '".$database->escape_string($this->password)."', ";
		$sql .= "first_name = '".$database->escape_string($this->first_name)."', ";
		$sql .= "last_name = '".$database->escape_string($this->last_name)."' ";
		$sql .= "WHERE id = ".$database->escape_string($this->id);*/

		$database->query($sql);
		return (mysqli_affected_rows($database->connexion) == 1) ? true : false;
	}

	

	public function delete(){
		global $database;
		$sql = "DELETE FROM ". static::$db_table." WHERE id= ".$database->escape_string($this->id);
		$database->query($sql);
		return (mysqli_affected_rows($database->connexion) == 1) ? true : false;
	}

}



?>