
<?php
require_once("models/orders.class.php");
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = null; // Assuming auto-increment
    $customer_id = $_POST['customer_id'];
    $total_amount = $_POST['total_amount'];
    $shipping_address = $_POST['shipping_address'];
    $date = $_POST['date'];
    $order_status_id = $_POST['order_status_id'];
    $obj = new Orders(null, $customer_id, $total_amount, $shipping_address, $date, $order_status_id);
    $msg = $obj->create();
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Create Orders</h1>
        </div>
      </div>
    </div>
  </div>
  <section class='content'>
    <div class='container-fluid'>
      <a href="orders" class="btn btn-primary mb-3">Back to Manage</a>

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
      <label for="customer_id">Customer Id</label>
      <input type="text" class="form-control" name="customer_id" id="customer_id">
    </div>
    <div class="form-group mb-3">
      <label for="total_amount">Total Amount</label>
      <input type="text" class="form-control" name="total_amount" id="total_amount">
    </div>
    <div class="form-group mb-3">
      <label for="shipping_address">Shipping Address</label>
      <input type="text" class="form-control" name="shipping_address" id="shipping_address">
    </div>
    <div class="form-group mb-3">
      <label for="date">Date</label>
      <input type="text" class="form-control" name="date" id="date">
    </div>
    <div class="form-group mb-3">
      <label for="order_status_id">Order Status Id</label>
      <input type="text" class="form-control" name="order_status_id" id="order_status_id">
    </div>
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-success">Submit</button>
  </div>
</form>

    </div>
  </section>
</div>
