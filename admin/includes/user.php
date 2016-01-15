<?php
class User extends Db_object{
	protected static $db_table ="users";
	protected static $db_table_fields =array('username', 'password', 'first_name', 'last_name', 'user_image', '$upload_directory', '$image_placeholder');
	public $id;
	public $user_image;
	public $username;
	public $first_name;
	public $last_name;
	public $password;
	public $upload_directory = "images";
	public $image_placeholder = "https://unsplash.it/400/400/?random";
	


	

    public function upload_photo(){
        
        if(!empty($this->errors)){
            return false;
        }

        $target_path = SITE_ROOT .'/admin/'. $this->upload_directory . '/' . $this->user_image;
        if(file_exists($target_path)){
            $this->errors[] = "The file {$this->user_image} already exists";
            return false;
        }
        
        if(move_uploaded_file($this->temp_path, $target_path)){
            unset($this->temp_path);
            return true;

        } else{
            $this->errors[] ="The file derectory probabely has not permission";
            return false;
        }
    }


	public function image_path_and_placeholder(){
		return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.'/'.$this->user_image;
	}


	public static function verify_user($username, $password){
		global $database;
		$username = $database->escape_string($username);
		$password = $database->escape_string($password);
		$sql = "SELECT * FROM ".self::$db_table." WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

		$result_set = self::find_by_query($sql);
		return !empty($result_set) ? array_shift($result_set) : false;
	}


    public function delete_user(){
        
        if($this->delete()){
            if (!empty($this->user_image)){
                $target_path = SITE_ROOT .'/admin/'. $this->upload_directory.'/'.$this->user_image;
                return unlink($target_path)? true : false;
            } else{
                return true;
            }
            
        } else{
            return false;
        }
    }
}

?>