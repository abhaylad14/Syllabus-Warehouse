
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Developed By: Abhay Lad and Priya Kanabar
    </div>
    <!-- Default to the left -->
    <?php $year = date("Y"); ?>
    <strong>Copyright &copy; <?php echo $year; ?> <a href="#">BMIIT</a></strong>
  </footer>
</div>
<!-- ./wrapper -->
<script>
          if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }   
</script>
<!--<script src="../plugins/datatables/jquery.dataTables.min.js"></script>-->

</body>
</html>
<?php ob_end_flush(); ?>
