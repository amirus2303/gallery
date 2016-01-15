<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()){
    redirect('login.php');
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
                    USERS
                    <small>Subheading</small>
                </h1>
                <?php 
                if(!empty($session->message)){
                    echo '<div class="alert alert-success">' . $session->message . '</div>';
                }
                ?>

                <a href="add_user.php" class="btn btn-primary">Add user</a>
                <div class="col-xs-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $user_found = User::find_all(); ?>
                            <?php foreach ($user_found as $user) : ?>
                               <tr>
                                    <td><?php echo $user->id; ?></td>
                                    <td>
                                        <img class="img-thumbnail img-responsive thumb-user" src ="<?php echo $user->image_path_and_placeholder(); ?>"/>
                                    </td>
                                    <td>
                                        <?php echo $user->username; ?>
                                        <div class="action_links">
                                            <a href="delete_user.php?id=<?php echo $user->id;?>">Delete</a>
                                            <a href="edit_user.php?id=<?php echo $user->id;?>">Edit</a>
                                        </div>
                                    </td>
                                    <td><?php echo $user->first_name; ?></td>
                                    <td><?php echo $user->last_name; ?></td>
                                </tr> 
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>

                    
                </div>
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
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<?php include("includes/footer.php"); ?>