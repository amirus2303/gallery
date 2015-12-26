<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                ADMIN
                <small>Subheading</small>
            </h1>

            <?php
            $user_found = User::find_all_users();
            echo '<h3>All users</h3>';
            foreach ($user_found as $user) {
                echo $user->username.'<br />';
            }
            ?>
            <?php
            echo '<h3> Find one user</h3>';
            $only_one_use = User::find_user_by_id(1);
            echo $only_one_use->username.'<br />';
            
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