
<?php
require_once("models/orders.class.php");
$msg = "";
$res = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $customer_id = $_POST['customer_id'];
    $total_amount = $_POST['total_amount'];
    $shipping_address = $_POST['shipping_address'];
    $date = $_POST['date'];
    $order_status_id = $_POST['order_status_id'];
    $obj = new Orders($id, $customer_id, $total_amount, $shipping_address, $date, $order_status_id);
    $msg = $obj->update($id);
}
if (isset($_GET['id'])) {
    $res = Orders::readById($_GET['id']);
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Edit Orders</h1>
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
  <button type="button" class="btn-close close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
<?php if(!empty($res)) { ?>
<div class="card">
  <form method="post">
    <div class="card-body">
      <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
      <div class="form-group mb-3">
        <label for="customer_id">Customer Id</label>
        <input type="text" class="form-control" name="customer_id" id="customer_id" value="<?php echo htmlspecialchars($res['customer_id']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="total_amount">Total Amount</label>
        <input type="text" class="form-control" name="total_amount" id="total_amount" value="<?php echo htmlspecialchars($res['total_amount']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="shipping_address">Shipping Address</label>
        <input type="text" class="form-control" name="shipping_address" id="shipping_address" value="<?php echo htmlspecialchars($res['shipping_address']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="date">Date</label>
        <input type="text" class="form-control" name="date" id="date" value="<?php echo htmlspecialchars($res['date']); ?>">
      </div>
      <div class="form-group mb-3">
        <label for="order_status_id">Order Status Id</label>
        <input type="text" class="form-control" name="order_status_id" id="order_status_id" value="<?php echo htmlspecialchars($res['order_status_id']); ?>">
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
