<?php 
require_once("models/ecom-roles.class.php"); 
if(isset($_GET["id"])) {
  $item = EcomRoles::readById($_GET["id"]);  
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Role Details</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="roles" class="btn btn-primary mb-3">Back</a>
        <?php //print_r($item); ?>
        <table class="table table-striped">
          <tr>
            <th>ID</th>
            <td><?php echo $item['id']; ?></th>
          </tr>
          <tr>
            <th>Name</th>
            <td><?php echo $item['name']; ?></th>
          </tr>        
        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>