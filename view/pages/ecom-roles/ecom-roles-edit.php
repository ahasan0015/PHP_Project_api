<?php 
require_once("models/ecom-roles.class.php"); 
$result = "";
if(isset($_POST['id']) && isset($_POST['name'])){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $role = new EcomRoles($id, $name);
  $result = $role->update();
}
if(isset($_GET["id"])) {
  $res = EcomRoles::readById($_GET["id"]);  
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php //print_r($res); ?>
            <h1 class="m-0">Edit Role</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <a href="roles" class="btn btn-primary mb-3">Back</a>
        <?php //print_r($res); ?>
        <div>
          <?php echo $result; ?>
        </div>
        <?php if(isset($res)){?>
        <div class="card">
          <form method="post">
            <div class="card-body">
              <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $res['name']; ?>">
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
        <?php } ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>