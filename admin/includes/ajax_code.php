<?php 
require("init.php");
$user = User::find_by_id($_POST['user_id']);
$user->user_image = $_POST['image_name'];
$user->update();
echo $user->user_image;
 ?>