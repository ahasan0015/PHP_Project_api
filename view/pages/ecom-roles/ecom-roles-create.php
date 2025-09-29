<?php 
require_once("models/ecom-roles.class.php"); 
$result = "";
if(isset($_POST['name'])){
  $name = $_POST['name'];
  // $result = $name;
  // $query = "insert into ecom_roles(name) values('$name')";
  // $res = $db->query($query);
  // print_r($res);
  $role = new EcomRoles(null, $name);
  $result = $role->create();
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Role</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="roles" class="btn btn-primary mb-3">Back</a>
        <?php echo $result; ?>
        <div class="card">
          <form method="post">
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name">
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>