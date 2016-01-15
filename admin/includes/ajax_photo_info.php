<?php 
require("init.php");
$image_info = array();
$photo = Photo::find_by_id($_POST['image_id']);
$image_info['filename'] = $photo->filename;
$image_info['type'] = $photo->type;
$image_info['size'] = $photo->size;
echo json_encode($image_info);

?>