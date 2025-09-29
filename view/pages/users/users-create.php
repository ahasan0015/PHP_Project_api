
<?php
require_once("models/users.class.php");
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = null; // Assuming auto-increment
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];
    $address = $_POST['address'];
    $photo = $_POST['photo'];
    $obj = new Users(null, $name, $email, $password, $role_id, $address, $photo);
    $msg = $obj->create();
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Create Users</h1>
        </div>
      </div>
    </div>
  </div>
  <section class='content'>
    <div class='container-fluid'>
      <a href="users" class="btn btn-primary mb-3">Back to Manage</a>

<?php if($msg) { ?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
  <?php echo $msg; ?>
  <button type="button" class="btn-close close close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
<form method="post">
  <input type="hidden" name="id">
  <div class="card-body">
    <div class="form-group mb-3">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name">
    </div>
    <div class="form-group mb-3">
      <label for="email">Email</label>
      <input type="text" class="form-control" name="email" id="email">
    </div>
    <div class="form-group mb-3">
      <label for="password">Password</label>
      <input type="text" class="form-control" name="password" id="password">
    </div>
    <div class="form-group mb-3">
      <label for="role_id">Role Id</label>
      <input type="text" class="form-control" name="role_id" id="role_id">
    </div>
    <div class="form-group mb-3">
      <label for="address">Address</label>
      <input type="text" class="form-control" name="address" id="address">
    </div>
    <div class="form-group mb-3">
      <label for="photo">Photo</label>
      <input type="text" class="form-control" name="photo" id="photo">
    </div>
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-success">Submit</button>
  </div>
</form>

    </div>
  </section>
</div>
