<?php include("includes/init.php"); ?>
<!-- Navigation -->
<?php
if (!$session->is_signed_in()){
    redirect('login.php');
}
?>
<?php
if(empty($_GET['id'])){
	redirect("../users.php");
}
$user_id =$_GET['id'];
$user = User::find_by_id($user_id);
if ($user->delete_user()){
    $_SESSION['message'] ="The user ". $user->first_name. " " . $user->last_name . " has been deleted";
    redirect("users.php");
} else {
	//redirect("users.php");
}
?>