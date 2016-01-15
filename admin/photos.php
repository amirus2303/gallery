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
                    PHOTOS
                    <small>Subheading</small>
                </h1>
                <?php 
                if(!empty($session->message)){
                    echo '<div class="alert alert-success">' . $session->message . '</div>';
                }
                ?>
                <div class="col-xs-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Id</th>
                                <th>Filename</th>
                                <th>Title</th>
                                <th>Size</th>
                                <th>Comments</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $photo_found = Photo::find_all(); ?>
                            
                            <?php foreach ($photo_found as $photo) : ?>
                               <tr>
                                    <td>
                                        <img class="img-thumbnail img-responsive thumb-table" src ="<?php echo $photo->picture_path(); ?>"/>
                                        <div class="action_links">
                                            <a class="delete_link" href="delete_photo.php?id=<?php echo $photo->id;?>">Delete</a>
                                            <a href="edit_photo.php?id=<?php echo $photo->id;?>">Edit</a>
                                            <a href="../photo.php?id=<?php echo $photo->id;?>">View</a>
                                        </div>


                                    </td>
                                    <td><?php echo $photo->id; ?></td>
                                    <td><?php echo $photo->filename; ?></td>
                                    <td><?php echo $photo->title; ?></td>
                                    <td><?php echo $photo->size; ?></td>
                                    <?php $comments = Comment::find_the_comments($photo->id); ?>
                                    <td><a href="comment_photo.php?id=<?php echo $photo->id;?>"><?php echo count($comments); ?></a></td>
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