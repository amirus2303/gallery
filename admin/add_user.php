<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()){
    redirect('login.php');
}
?>
<?php 

$user = new User();

if (isset($_POST['create'])){

    $user->username          = $_POST['username'];
    $user->password          = $_POST['password'];
    $user->first_name = $_POST['first_name'];
    $user->last_name    = $_POST['last_name'];
    $user->set_file($_FILES['user_image']);
    //var_dump($user);
    $user->upload_photo();
    $user->save();

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
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-xs-9">
                        <div class="form-group">
                            <label>Upload photo</label>  
                            <input type="file" name="user_image">
                        </div>
                        <div class="form-group">
                            <label>Username</label>  
                            <input type="text" name="username" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>First name</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" name="last_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="create" class="btn btn-primary pull-right" value="submit">
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

<?php include("includes/footer.php"); ?>