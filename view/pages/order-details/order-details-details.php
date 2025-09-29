
<?php
require_once("models/order-details.class.php");
$item = [];
if (isset($_GET["id"])) {
    $item = OrderDetails::readById($_GET["id"]);
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Details of Order Details</h1>
        </div>
      </div>
    </div>
  </div>
  <section class='content'>
    <div class='container-fluid'>
      <a href="order-details" class="btn btn-primary mb-3">Back to Manage</a>

<?php if (!empty($item)) { ?>
<table class="table table-striped">
  <tr>
    <th>Id</th>
    <td><?php echo htmlspecialchars($item['id']); ?></td>
  </tr>
  <tr>
    <th>Order Id</th>
    <td><?php echo htmlspecialchars($item['order_id']); ?></td>
  </tr>
  <tr>
    <th>Product Id</th>
    <td><?php echo htmlspecialchars($item['product_id']); ?></td>
  </tr>
  <tr>
    <th>Price</th>
    <td><?php echo htmlspecialchars($item['price']); ?></td>
  </tr>
  <tr>
    <th>Qty</th>
    <td><?php echo htmlspecialchars($item['qty']); ?></td>
  </tr>
</table>
<?php } else { echo "<p>No data found.</p>"; } ?>

    </div>
  </section>
</div>
