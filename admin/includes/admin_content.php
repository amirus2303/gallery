<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                ADMIN
                <small>Subheading</small>
            </h1>

            <?php
            $photo_found = Photo::find_all();
            echo '<h3>All Photos</h3>';
            foreach ($photo_found as $photo) {
                echo $photo->title.'<br />';
            }
            ?>

            <?php 
            echo "<h2>Add user </h2>";
            $photo = new Photo();
            $photo->title = "Photo1";
            $photo->description = "My first Photo";
            $photo->filename = "photo1.jpg";
            $photo->type = "JPG";
            $photo->size = "20000";

            $photo->save();
            ?>

            <?php /*
            echo "<h2>Update user </h2>";
            $user = User::find_by_id(2);
            echo $user->username.'<br />';
            $user->username = "STT";
            $user->save();*/
            ?>

            <?php /*
            $user = User::find_user_by_id(7);
            $user->delete();*/
            ?>
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