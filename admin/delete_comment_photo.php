<?php include("includes/init.php"); ?>
<!-- Navigation -->
<?php
if (!$session->is_signed_in()){
    redirect('login.php');
}
?>
<?php
if(empty($_GET['id'])){
	redirect("../comments.php");
}
$comment_id =$_GET['id'];
$comment = Comment::find_by_id($comment_id);

if ($comment->delete()){
	redirect("comment_photo.php?id={$comment->photo_id}");
} else {
	redirect("comments.php");
}
?>