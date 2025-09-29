<?php 
session_start();
include("config/base.php");
include("config/db.php");
include("helper/img-upload-helper.php");
foreach (glob("models/*.class.php") as $filename) {
  include $filename;
}
// $result = $db->query("select * from ecom_users");
// print_r($result);
// $_SESSION['user_id'] = 1;
// echo "<h1>home</h1>";
// unset($_SESSION['userId']);
if(!isset($_SESSION['userId'])) {
    include_once('view/pages/login.php');
}else{
    // include("route.php");
?>

<?php include('view/layout/head.php'); ?>

<div class="wrapper">

  <?php //include('view/layout/preloader.php'); ?>
  <?php include('view/layout/navbar.php'); ?>  
  <?php include('view/layout/sidebar.php'); ?> 

  <?php include("route.php"); ?>
  <!-- <h1 class="text-center">Content</h1> -->

  <!-- /.content-wrapper -->
  
  <?php include 'view/layout/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'view/layout/foot.php'; ?>


<?php
}
// echo $_GET["page"];
?>
