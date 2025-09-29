
<?php
require_once("models/users.class.php");
$msg = "";
$res = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];
    $address = $_POST['address'];
    $photo = $_POST['photo'];
    $obj = new Users($id, $name, $email, $password, $role_id, $address, $photo);
    $msg = $obj->update($id);
}
if (isset($_GET['id'])) {
    $res = Users::readById($_GET['id']);
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Edit Users</h1>
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
  <button type="button" class="btn-close close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
<?php if(!empty($res)) { ?>
<div class="card">
  <form method="post">
    <div class="card-body">
      <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
      <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($res['name']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($res['email']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="text" class="form-control" name="password" id="password" value="<?php echo htmlspecialchars($res['password']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="role_id">Role Id</label>
        <input type="text" class="form-control" name="role_id" id="role_id" value="<?php echo htmlspecialchars($res['role_id']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="address">Address</label>
        <input type="text" class="form-control" name="address" id="address" value="<?php echo htmlspecialchars($res['address']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="photo">Photo</label>
        <input type="text" class="form-control" name="photo" id="photo" value="<?php echo htmlspecialchars($res['photo']); ?>">
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-success">Update</button>
    </div>
  </form>
</div>
<?php } ?>

    </div>
  </section>
</div>
