<?php include("includes/header.php"); ?>

<?php
if (!$session->is_signed_in()){
    redirect('login.php');
}
?>

<?php 
$message = "";
if(isset($_FILES['file'])){// on utilise le isset($_FILES['file']) à la place de isset($_POST['submit']) pour que le multi upload fonctionne
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->description = $_POST['description'];
    $photo->set_file($_FILES['file']);
    if($photo->save()){
        $message = "Photo successfully uploaded";
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
                    UPLOAD
                    <small>Subheading</small>
                </h1>
                <div class="row">
                    <div class="col-xs-6">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                          
                            
                            <div class="form-group">
                                <label for="exampleInputFile">Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Description</label>
                                <input type="text" class="form-control" name="description">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <input type="file" name="file">
                                <p>
                                <?php 
                                if(isset($_POST['submit'])){
                                    foreach($photo->errors as $error) {
                                        echo $error.'<br />';
                                    }
                                    echo $message;
                                }
                                ?> 
                                </p>
                            </div>
                         
                            <button type="submit" class="btn btn-default" name="submit">Submit</button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <form action="upload.php" class="dropzone"></form>
                    </div>
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