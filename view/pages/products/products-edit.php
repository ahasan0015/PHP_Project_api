
<?php
require_once("models/products.class.php");
$msg = "";
$res = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $quantity = $_POST['quantity'];
    $reorder_point = $_POST['reorder_point'];
    $photo = $_POST['photo'];
    $is_active = $_POST['is_active'];
    $obj = new Products($id, $name, $category_id, $price, $discount, $quantity, $reorder_point, $photo, $is_active);
    $msg = $obj->update($id);
}
if (isset($_GET['id'])) {
    $res = Products::readById($_GET['id']);
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Edit Products</h1>
        </div>
      </div>
    </div>
  </div>
  <section class='content'>
    <div class='container-fluid'>
      <a href="products" class="btn btn-primary mb-3">Back to Manage</a>

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
        <label for="category_id">Category Id</label>
        <input type="text" class="form-control" name="category_id" id="category_id" value="<?php echo htmlspecialchars($res['category_id']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="price">Price</label>
        <input type="text" class="form-control" name="price" id="price" value="<?php echo htmlspecialchars($res['price']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="discount">Discount</label>
        <input type="text" class="form-control" name="discount" id="discount" value="<?php echo htmlspecialchars($res['discount']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="quantity">Quantity</label>
        <input type="text" class="form-control" name="quantity" id="quantity" value="<?php echo htmlspecialchars($res['quantity']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="reorder_point">Reorder Point</label>
        <input type="text" class="form-control" name="reorder_point" id="reorder_point" value="<?php echo htmlspecialchars($res['reorder_point']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="photo">Photo</label>
        <input type="text" class="form-control" name="photo" id="photo" value="<?php echo htmlspecialchars($res['photo']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="is_active">Is Active</label>
        <input type="text" class="form-control" name="is_active" id="is_active" value="<?php echo htmlspecialchars($res['is_active']); ?>">
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
