<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()){
    redirect('login.php');
}
?>
<?php 
if(empty($_GET['id'])){
    redirect('users.php');
} else{
    $user = User::find_by_id($_GET['id']);

    if(isset($_POST['update'])){
        if($user){
            $user->username          = $_POST['username'];
            $user->password          = $_POST['password'];
            $user->first_name = $_POST['first_name'];
            $user->last_name    = $_POST['last_name'];

            if(empty($_FILES['user_image'])){
                $user->save();
            } else{
                $user->set_file($_FILES['user_image']);
                $user->upload_photo();
                $user->save();
            }
            
            $_SESSION['message'] ="The user ". $user->first_name. " " . $user->last_name . " has been updated";
            redirect("users.php");
        }
    }
}

?>



<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!--Top menu -->
    <?php include("includes/top_nav.php");?>
    <!--SideBar -->
    <?php include("includes/side_nav.php"); ?>
</nav>

<!--Main content -->
<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    ADD USER
                    <small>Subheading</small>
                </h1>
                <div class="col-xs-3">
                    <div class="form-group">
                        
                        <a href="#" data-toggle="modal" data-target="#photo-library"><img data-id="<?php echo $user->id; ?>" src="<?php echo $user->image_path_and_placeholder();?>" class="img-thumbnail img-responsive"></a><br />
                        <div class="ajax-content"></div>
                    </div>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    
                    <div class="col-xs-9">
                        
                        <div class="form-group">
                            <label>Upload photo</label>  
                            <input type="file" name="user_image">
                        </div>
                        <div class="form-group">
                            <label>Username</label>  
                            <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                        </div>

                        <div class="form-group">
                            <label>First name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                        </div>

                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" value="<?php echo $user->password; ?>">
                        </div>

                        <div class="form-group">
                            <a id="user-id" href="delete_user.php?id=<?php echo $user->id;?>" class="btn btn-danger pull-left">Delete</a>
                            <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
                        </div>
                    </div>

                </form>
                <div class="col-xs-12">
                    <?php 
                        if(!empty($user->errors)){
                            foreach ($user->errors as $error) {
                                echo $error.'<br />';
                            }
                        }
                    ?>
                </div>
                <div class="col-xs-12">
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                </div>
            </div>
            
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<?php include("includes/photo_library_modal.php"); ?>


<?php include("includes/footer.php"); ?>