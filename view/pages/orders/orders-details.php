
<?php
require_once("models/orders.class.php");
$item = [];
if (isset($_GET["id"])) {
    $item = Orders::readById($_GET["id"]);
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Details of Orders</h1>
        </div>
      </div>
    </div>
  </div>
  <section class='content'>
    <div class='container-fluid'>
      <a href="orders" class="btn btn-primary mb-3">Back to Manage</a>

<?php if (!empty($item)) { ?>
<table class="table table-striped">
  <tr>
    <th>Id</th>
    <td><?php echo htmlspecialchars($item['id']); ?></td>
  </tr>
  <tr>
    <th>Customer Id</th>
    <td><?php echo htmlspecialchars($item['customer_id']); ?></td>
  </tr>
  <tr>
    <th>Total Amount</th>
    <td><?php echo htmlspecialchars($item['total_amount']); ?></td>
  </tr>
  <tr>
    <th>Shipping Address</th>
    <td><?php echo htmlspecialchars($item['shipping_address']); ?></td>
  </tr>
  <tr>
    <th>Date</th>
    <td><?php echo htmlspecialchars($item['date']); ?></td>
  </tr>
  <tr>
    <th>Order Status Id</th>
    <td><?php echo htmlspecialchars($item['order_status_id']); ?></td>
  </tr>
</table>
<?php } else { echo "<p>No data found.</p>"; } ?>

    </div>
  </section>
</div>
