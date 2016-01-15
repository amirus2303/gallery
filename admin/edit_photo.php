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
    $photo = Photo::find_by_id($_GET['id']);


    if (isset($_POST['update'])){
        if($photo){
            $photo->title          = $_POST['title'];
            $photo->caption          = $_POST['caption'];
            $photo->alternate_text = $_POST['alternate_text'];
            $photo->description    = $_POST['description'];
            $photo->save();
            $_SESSION['message'] ="The photo ". $photo->title." has been updated";
            redirect("photos.php");
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
                    PHOTOS
                    <small>Subheading</small>
                </h1>
                <form action="" method="post">
                    <div class="col-xs-9">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
                        </div>

                        <div class="form-group">
                            <a href="#"><img class="img-responsive thumb-table thumbnail" src="<?php echo $photo->picture_path(); ?>"></a>
                        </div>

                        <div class="form-group">
                            <label>Caption</label>
                            <input type="text" name="caption" class="form-control" value="<?php echo $photo->caption; ?>">
                        </div>

                        <div class="form-group">
                            <label>Alternate text</label>
                            <input type="text" name="alternate_text" class="form-control" value="<?php echo $photo->alternate_text; ?>">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="10" cols="30"><?php echo $photo->description; ?></textarea>
                        </div>
                        
                    </div>
                    <div class="col-md-3" >
                        <div  class="photo-info-box">
                            <div class="info-box-header slideup">
                                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                            </div>
                            <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                    <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                    </p>
                                    <p class="text ">
                                        Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                    </p>
                                    <p class="text">
                                        Filename: <span class="data"><?php echo $photo->filename; ?></span>
                                    </p>
                                    <p class="text">
                                        File Type: <span class="data"><?php echo $photo->type; ?></span>
                                    </p>
                                    <p class="text">
                                        File Size: <span class="data"><?php echo $photo->size; ?></span>
                                    </p>
                                </div>
                                <div class="info-box-footer clearfix">
                                    <div class="info-box-delete pull-left">
                                        <a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                                    </div>
                                    <div class="info-box-update pull-right ">
                                        <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                    </div>   
                                </div>
                            </div>          
                        </div>
                    </div>
                </form>
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