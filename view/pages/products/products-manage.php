
<?php
require_once("models/products.class.php");
$msg = "";
if(isset($_POST['delete_id'])) {
  $id = $_POST['delete_id'];
  $msg = Products::delete($id);
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Manage Products</h1>
          <!-- <div class='p-3 border rounded bg-white'>Manage Products</div> -->
          <!-- <textarea name="" id="">Manage Products</textarea> -->
        </div>
      </div>
    </div>
  </div>
  <section class='content'>
    <div class='container-fluid'>
      <a href="products-create" class="btn btn-primary mb-3">Add New</a>

<?php if($msg) { ?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
  <?php echo $msg; ?>
  <button type="button" class="btn-close close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
<div class="text-right">
  <select id="categoryFilter">
    <option value="all">All</option>
    <option value="1">Men</option>
    <option value="2">Women</option>
  </select>
</div>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
    <tr>
      <th>Id</th>
      <th>Photo</th>
      <th>Name</th>
      <th>Category</th>
      <th>Price</th>
      <th>Discount</th>
      <th>Quantity</th>
      <th>Reorder Point</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
    </thead>
    <tbody id="productTable" class="table-dark"></tbody>
    <tbody>
    <?php
      $items = Products::readAll();
      foreach($items as $item){
        if($item['is_active'] == 1) {
          $status = "<span class='badge bg-success'>Active</span>";
        } else {
          $status = "<span class='badge bg-warning'>Inctive</span>";
        }
        echo "<tr>";
        echo "<td>".$item['id']."</td>";
        echo "<td><img src='".$item['photo']."' alt='Product Image' width='60' ></td>";
        echo "<td>".$item['name']."</td>";
        echo "<td>".$item['category']."</td>";
        echo "<td>".$item['price']."</td>";
        echo "<td>".$item['discount']."</td>";
        echo "<td>".$item['quantity']."</td>";
        echo "<td>".$item['reorder_point']."</td>";
        echo "<td>".$status."</td>";
    ?>
      <td class="d-flex">
        <form action="products-details" method="get">
          <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
          <input type="submit" class="btn btn-sm btn-outline-info" value="Details">
        </form>
        <form action="products-edit" method="get">
          <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
          <input type="submit" class="btn btn-sm btn-outline-primary" value="Edit">
        </form>
        <?php if($_SESSION['userId'] !== 1) { ?>
        <form method="post">
          <input type="hidden" name="delete_id" value="<?php echo $item['id']; ?>">
          <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete">
        </form>
        <?php } ?>
      </td>
    <?php
        echo "</tr>";
      }
    ?>
    </tbody>
  </table>
</div>

    </div>
  </section>
</div>

<script src="plugins/jquery/jquery.min.js"></script>

<script>
$("#categoryFilter").on("change", function() {
  // console.log($(this).val());
  var filter = $(this).val();
  if(filter == "all") {
    getAllProducts();
  }else{
    // $("#productTable").html("");
    // console.log("api/product-category?id="+filter);
    $.ajax({
      url: "api/product-category?id="+filter,
      type: "GET",
      success: function(response) {
        // console.log(JSON.parse(result));
        var data = JSON.parse(response);
        var tr = "";
        data.forEach(function(row) {
          // console.log(row);
          tr += `
          <tr>
            <td>${row.id}</td>
            <td><img src='${row.photo}' alt='Product Image' width='60' ></td>
            <td>${row.name}</td>
            <td>${row.category}</td>
            <td>${row.price}</td>
            <td>${row.discount}</td>
            <td>${row.quantity}</td>
            <td>${row.reorder_point}</td>
            <td>Status</td>
            <td>Actions</td>
          </tr>
          `;
        })
        $("#productTable").html(tr);
      },
      error: function(err) {
        console.log(err);
      }
    });
  }

});


  function getAllProducts() {
    $.ajax({
      url: "api/products",
      type: "GET",
      success: function(result) {
        // console.log(JSON.parse(result));
        var data = JSON.parse(result);
        var tr = "";
        data.forEach(function(row) {
          console.log(row);
          tr += `
          <tr>
            <td>${row.id}</td>
            <td><img src='${row.photo}' alt='Product Image' width='60' ></td>
            <td>${row.name}</td>
            <td>${row.category}</td>
            <td>${row.price}</td>
            <td>${row.discount}</td>
            <td>${row.quantity}</td>
            <td>${row.reorder_point}</td>
            <td>Status</td>
            <td>Actions</td>
          </tr>
          `;
        })
        $("#productTable").html(tr);
      },
      error: function(err) {
        console.log(err);
      }
    });
  }
  getAllProducts();

  // $.ajax({
  //   url: "api/product?id=1",
  //   type: "GET",
  //   success: function(res) {
  //     console.log(JSON.parse(res));
  //   },
  //   error: function(err) {
  //     console.log(err);
  //   }
  // });

</script>