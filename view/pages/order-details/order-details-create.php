
<?php
require_once("models/order-details.class.php");
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = null; // Assuming auto-increment
    $order_id = $_POST['order_id'];
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $obj = new OrderDetails(null, $order_id, $product_id, $price, $qty);
    $msg = $obj->create();
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Create Order Details</h1>
        </div>
      </div>
    </div>
  </div>
  <section class='content'>
    <div class='container-fluid'>
      <a href="order-details" class="btn btn-primary mb-3">Back to Manage</a>

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
      <label for="order_id">Order Id</label>
      <input type="text" class="form-control" name="order_id" id="order_id">
    </div>
    <div class="form-group mb-3">
      <label for="product_id">Product Id</label>
      <input type="text" class="form-control" name="product_id" id="product_id">
    </div>
    <div class="form-group mb-3">
      <label for="price">Price</label>
      <input type="text" class="form-control" name="price" id="price">
    </div>
    <div class="form-group mb-3">
      <label for="qty">Qty</label>
      <input type="text" class="form-control" name="qty" id="qty">
    </div>
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-success">Submit</button>
  </div>
</form>

    </div>
  </section>
</div>
