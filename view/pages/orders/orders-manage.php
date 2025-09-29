
<?php
require_once("models/orders.class.php");
$msg = "";
if(isset($_POST['delete_id'])) {
  $id = $_POST['delete_id'];
  $msg = Orders::delete($id);
}
$orders_count = Orders::orderRowsNo();
// print_r($orders_count);
$orders_count = $orders_count['orders_count'];
// echo $orders_count;

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Manage Orders</h1>
        </div>
      </div>
    </div>
  </div>
  <section class='content'>
    <div class='container-fluid'>
      <a href="pos" class="btn btn-primary mb-3">Order Now</a>

      <?php if($msg) { ?>
      <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?php echo $msg; ?>
        <button type="button" class="btn-close close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php } ?>

      <div class="card">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Id</th>
              <th>Total Amount</th>
              <th>Date</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
              if(isset($_SESSION["customerId"])) {
                $items = Orders::readAllForCustomer($_SESSION["customerId"]);
              }else{
                $items = Orders::readAll();
              }              
              // print_r($items);
              foreach($items as $item){
                echo "<tr>";
                echo "<td>".$item['id']."</td>";
                echo "<td>".$item['total_amount']."</td>";
                echo "<td>".$item['date']."</td>";
                echo "<td>".$item['name']."</td>";
            ?>
              <td class="d-flex">
                <form action="orders-invoice" method="get">
                  <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                  <input type="submit" class="btn btn-sm btn-outline-info" value="Invoice">
                </form>
                <form action="orders-edit" method="get">
                  <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                  <input type="submit" class="btn btn-sm btn-outline-primary" value="Edit">
                </form>
                <form method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $item['id']; ?>">
                  <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete">
                </form>
              </td>
            <?php
                echo "</tr>";
              }
            ?>
            </tbody>
            <tbody id="tbody" class="table-warning"></tbody>
          </table>
        </div>
        <div class="card-footer">
          <ul class="pagination justify-content-center mb-0">
            <li class="page-item"><a class="page-link" href="javascript:;" onclick="getOrders(1)">«</a></li>
            <?php
            $last_page = 0;
              if($orders_count > 0){
                $no_of_pages = ceil($orders_count / 5);
                // echo $no_of_pages;
                $last_page = $no_of_pages;
                $i = 1;
                while($no_of_pages > 0){
                  echo "<li class='page-item'><a class='page-link' href='javascript:;' onclick='getOrders($i)'>$i</a></li>";
                  $no_of_pages--;
                  $i++;
                }
              }
            ?>
            <li class="page-item"><a class="page-link" href="javascript:;" onclick="getOrders(<?php echo $last_page; ?>)">»</a></li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script>
  function getOrders(page=1) {
    $.ajax({
      url: `api/orders?pg=${page}`,
      type: "GET",
      // data: {},
      success: function(res){
        console.log(res);
        let data = JSON.parse(res);
        console.log(data);
        let tr = '';
        data.forEach(function(row){
          tr += `
          <tr>
            <td>${row.id}</td>
            <td>${row.total_amount}</td>
            <td>${row.date}</td>
            <td>${row.status}</td>              
            <td class="d-flex">
              <form action="orders-invoice" method="get">
                <input type="hidden" name="id" value="${row.id}">
                <input type="submit" class="btn btn-sm btn-outline-info" value="Invoice">
              </form>
              <form action="orders-edit" method="get">
                <input type="hidden" name="id" value="${row.id}">
                <input type="submit" class="btn btn-sm btn-outline-primary" value="Edit">
              </form>
              <form method="post">
                <input type="hidden" name="delete_id" value="${row.id}">
                <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete">
              </form>
            </td>
          </tr>
          `;
        });
        $("#tbody").html(tr);
      },
      error: function(err){
        console.log(err);
      }
    });
  }
  getOrders();

  // $.get();
  // $.post();
</script>