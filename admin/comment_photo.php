<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()){
    redirect('login.php');
}
?>


<?php 
if(empty($_GET['id'])){
    redirect("photos.php");
} else{
    $comments = Comment::find_the_comments($_GET['id']);

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
                    COMMENTS
                    <small>Subheading</small>
                </h1>
                <div class="col-xs-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Photo id</th>
                                <th>Author</th>
                                <th>Body</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($comments as $comment) : ?>
                               <tr>
                                    <td><?php echo $comment->id; ?></td>
                                    <td><?php echo $comment->photo_id; ?></td>
                                    <td>
                                        <?php echo $comment->author; ?>
                                        <div class="action_links">
                                            <a href="delete_comment_photo.php?id=<?php echo $comment->id;?>">Delete</a>
                                        </div>
                                    </td>
                                    <td><?php echo $comment->body; ?></td>
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