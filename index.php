<?php include("includes/header.php"); ?>

<?php 
//$photos = Photo::find_all();
?>

<?php
$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$items_per_page = 10;
$items_total_count = Photo::count_all();
$paginate = new Paginate($page, $items_per_page, $items_total_count);
$sql = "SELECT * FROM photos LIMIT {$paginate->items_per_page} OFFSET {$paginate->offset()}";
$photos = Photo::find_by_query($sql);

?>
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-xs-12">
                <nav class="pull-right">
                  <ul class="pagination">
                    <li>
                      <a href="<?php echo $paginate->has_previous() ? 'index.php?page='. $paginate->previous() : '#';?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <?php for($i=1; $i<= $paginate->page_total(); $i++) :?>
                        <?php if($paginate->current_page == $i) : ?>
                            <li class="active"><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>    
                        
                        <?php else : ?>
                            <li><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <li>
                      <a href="<?php echo $paginate->has_next() ? 'index.php?page='. $paginate->next() : '#';?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  </ul>
                </nav>
            </div>
            <div class="col-md-12">
                
                <?php foreach ($photos as $photo) : ?>
                    <div class="col-xs-3">
                        <a href="photo.php?id=<?php echo $photo->id; ?>"><img class="img-responsive thumbnail thumb-table" src="<?php echo 'admin/'.$photo->picture_path(); ?>"></a>
                    </div>
                <?php endforeach; ?>
                

            </div>




            <!-- Blog Sidebar Widgets Column -->
            <!--<div class="col-md-4">

            
                 <?php //include("includes/sidebar.php"); ?>



            </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
