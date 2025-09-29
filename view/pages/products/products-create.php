
<?php
require_once("models/products.class.php");
require_once("models/categories.class.php");
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = null; // Assuming auto-increment
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $quantity = $_POST['quantity'];
    $reorder_point = $_POST['reorder_point'];
    $photo = "";
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    $file = isset($_FILES["photo"]) ? $_FILES["photo"] : [];
    // print_r($file);
    $result = imgUpload($file,"uploads/products");

    if(isset($result['success'])) {
      $photo = $result['success'];
      $obj = new Products(null, $name, $category_id, $price, $discount, $quantity, $reorder_point, $photo, $is_active);
      $msg = $obj->create();
        
    } else {
      $msg = $result['error'];
    }
    // $obj = new Products(null, $name, $category_id, $price, $discount, $quantity, $reorder_point, $photo, $is_active);
    // $msg = $obj->create();
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Create Products</h1>
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
<form method="post" enctype="multipart/form-data">
  <input type="hidden" name="id">
  <div class="card-body">
    <div class="form-group mb-3">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name">
    </div>
    <div class="form-group mb-3">
      <label for="category_id">Category</label>
      <select name="category_id" class="form-control form-select">
      <?php 
      $cat = Categories::allActive();
      // print_r($cat);
      foreach ($cat as $c) {
        echo "<option value='{$c['id']}'>{$c['name']}</option>";
      }
      ?>
      </select>
    </div>
    <div class="form-group mb-3">
      <label for="price">Price</label>
      <input type="text" class="form-control" name="price" id="price">
    </div>
    <div class="form-group mb-3">
      <label for="discount">Discount</label>
      <input type="text" class="form-control" name="discount" id="discount">
    </div>
    <div class="form-group mb-3">
      <label for="quantity">Quantity</label>
      <input type="text" class="form-control" name="quantity" id="quantity">
    </div>
    <div class="form-group mb-3">
      <label for="reorder_point">Reorder Point</label>
      <input type="text" class="form-control" name="reorder_point" id="reorder_point">
    </div>
    <div class="form-group mb-3">
      <label for="photo">Photo</label>
      <input type="file" class="form-control" name="photo">
    </div>
    <div class="form-group mb-3">
      <input type="checkbox" class="" name="is_active" id="is_active" value="1">
      <label for="is_active">Is Active</label>
    </div>
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-success">Submit</button>
  </div>
</form>

    </div>
  </section>
</div>
