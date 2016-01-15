<?php include("includes/init.php"); ?>
<!-- Navigation -->
<?php
if (!$session->is_signed_in()){
    redirect('login.php');
}
?>
<?php
if(empty($_GET['id'])){
	redirect("photos.php");
}
$photo_id =$_GET['id'];
$photo = Photo::find_by_id($photo_id);
if ($photo->delete_photo()){
	$_SESSION['message'] ="The photo ". $photo->title. " has been deleted";
	redirect("photos.php");
} else {
	redirect("photos.php");
}
?>