<?php 
require_once("models/ecom-roles.class.php"); 
$msg = "";
// $id = null;
if(isset($_POST['delete_id'])){
  $id = $_POST['delete_id'];
  $msg = EcomRoles::delete($id);
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Roles</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php 
        // $items = EcomRoles::readAll(); 
        // echo "<pre>";
        // print_r($items);
        // echo "</pre>";
        ?>
        <a href="role-create" class="btn btn-primary mb-3">Add New</a>
        <div><?php echo $msg; ?></div>
        <div><?php //echo $id; ?></div>
        <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $items = EcomRoles::readAll();
          foreach($items as $item){
            echo "<tr>";
            echo "<td>" . $item['id'] . "</td>";
            echo "<td>" . $item['name'] . "</td>";  
          ?>
            <td>
              <div class="d-flex">
                <form action="role-details" method="get" class="mr-1">
                  <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                  <input type="submit" value="Details" class="btn btn-outline-info">
                </form>
                <form action="role-edit" method="get" class="mr-1">
                  <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                  <input type="submit" value="Edit" class="btn btn-outline-primary">
                </form>
                <form method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $item['id']; ?>">
                  <input type="submit" value="Delete" class="btn btn-outline-danger">
                </form>
              </div>
            </td>
          <?php           
            echo "</tr>";
          }
          ?>
          <tr>

          </tr>
        </tbody>
        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>