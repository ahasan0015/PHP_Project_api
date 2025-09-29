<?php include(ADMIN_BASE.'view/layout/head.php'); ?>

<div class="wrapper">

  <?php //include('../layout/preloader.php'); ?>
  <?php include(ADMIN_BASE.'view/layout/navbar.php'); ?>  
  <?php include(ADMIN_BASE.'view/layout/sidebar.php'); ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <h2><?php echo $_GET['id']; ?></h2>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  
  <?php include ADMIN_BASE.'view/layout/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include ADMIN_BASE.'view/layout/foot.php'; ?>