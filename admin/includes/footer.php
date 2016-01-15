  </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="js/dropzone.js"></script>
    <script src="js/scripts.js"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views',     <?php echo $session->count; ?>],
          ['Comments',      <?php echo Comment::count_all(); ?>],
          ['Users',  <?php echo User::count_all(); ?>],
          ['Photos', <?php echo Photo::count_all(); ?>],
        ]);

        var options = {
 	       	legend: 'none',
 	       	pieSliceText: 'label',
          	title: 'My Daily Activities',
          	backgroundColor: 'trensparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>


</body>

</html>
