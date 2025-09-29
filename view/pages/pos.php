
<?php
// require_once("models/products.class.php");
// require_once("models/customers.class.php");
// require_once("models/orders.class.php");
$msg = "";
if(isset($_POST['delete_id'])) {
  $id = $_POST['delete_id'];
  $msg = Products::delete($id);
}
if(!empty($_POST['cart']) && $_POST['cart'] !== "[]") {
  $customer_id = $_POST['customer'];
  $shipping_address = $_POST['shipping_address'];
  $total = $_POST['total_amount'];
  $items = json_decode($_POST['cart']);
  $obj = new Orders(null, $customer_id, $total, $shipping_address, 1);
  $msg = $obj->createOrder($items);
  // $msg = "Has Items";
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>POS</h1>
        </div>
      </div>
    </div>
  </div>
  <section class='content'>
    <div class='container-fluid'>      
<?php if($msg) { ?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
  <?php echo $msg; ?>
  <button type="button" class="btn-close close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>

<div class="row">
  <div class="col-7">
    <h5>Products</h5>
    <hr>
    <div class="row">
      <?php 
      $items = Products::readAll();
      foreach($items as $item) {
      ?>      
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <img src="<?php echo $item['photo']; ?>" alt="Product Image" height="150" class="card-img">
            <h5 class="mb-1 mt-2"><?php echo $item['name']; ?></h5>
            <h5 class="text-danger mb-0 font-weight-bold">BDT <?php echo $item['price']; ?></h5>
          </div>
          <div class="card-footer text-center">
            <button type="button" 
            data-id="<?php echo $item['id']; ?>" 
            data-name="<?php echo $item['name']; ?>" 
            data-price="<?php echo $item['price']; ?>" 
            data-discount="<?php echo $item['discount']; ?>" 
            onclick="addToCart(this)" class="btn btn-dark btn-sm"><i class="fas fa-cart-plus"></i> Add to Cart</button>
          </div>
        </div>
      </div>
      <?php
      }
      ?>
    </div>
  </div>
  <div class="col-5">
    <div class="d-flex gap-3 flex-wrap justify-content-between align-items-center">
      <h5 class="mb-3">Cart</h5>
      <button type="button" class="btn btn-outline-danger btn-sm" onclick="clearCart()">Clear Cart</button>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Item</th>
          <th>Price & Qty</th>
          <th>Sub-total</th>
          <th class="px-0"></th>
        </tr>
      </thead>
      <tbody id="cartItems"></tbody>
      <tfoot>
        <tr>
          <th colspan="2">Total</th>
          <th id="cartTotal">0</th>
          <th class="px-0"></th>
        </tr>
      </tfoot>
    </table>
      <form method="post" class="mb-3">
        <label for="">Select Customer</label>
        <select name="customer" class="form-control mb-3">          
          <?php
            $customers = Customers::readAll();
            // print_r($customers);
            foreach($customers as $customer) {
              echo "<option value='{$customer["id"]}'>{$customer["name"]}</option>";
            }
          ?>
        </select>
        <label for="">Shipping Address</label>
        <textarea name="shipping_address" class="form-control mb-3"></textarea>
        <input type="hidden" name="total_amount" value="0" id="cartTotalForm">
        <input type="hidden" name="cart" id="cartForm">
        <input type="submit" class="btn btn-primary" value="Checkout">
      </form>
  </div>
</div>

    </div>
  </section>
</div>

<script src="helper/cart-helper.js"></script>
<script>
  var cartHelper = new CartHelper();
  // console.log(cartHelper.loadCart());

  <?php if($msg == "Data saved successfully"){?>
    clearCart();
  <?php } ?>

  function addToCart(btn) {
    // alert("Item added to cart");
    // console.log(btn);
    // console.log(btn.dataset.itemId);
    // console.log(btn.getAttribute("data-my-id"));

    let id = btn.dataset.id;
    let name = btn.dataset.name;
    let price = btn.dataset.price;
    let discount = btn.dataset.discount;
    // console.log(id+", "+name+", "+price+", "+discount);
    // var result = cartHelper.addItem(id, name, price, 1, discount);
    // console.log(result);
    cartHelper.addItem(id, name, price, 1, discount);
    // console.log(cartHelper.loadCart());
    printCart();
  }

  function clearCart() {
    cartHelper.emptyCart();
    printCart();
  }
  function addQty(id) {
    // console.log(id);
    cartHelper.increaseQuantity(id);
    printCart();
  }
  function subQty(id) {
    // console.log(id);
    cartHelper.decreaseQuantity(id);
    printCart();
  }
  function removeItem(id) {
    // console.log(id);
    cartHelper.removeItem(id);
    printCart();
  }

  function printCart() {
    var items = cartHelper.getCart();
    var cartForm = document.getElementById('cartForm');
    cartForm.value = JSON.stringify(items);
    // console.log(items);
    // for(let item of items) {
    //   console.log(item);
    // }    
    var cartContainer = document.getElementById('cartItems');
    cartContainer.innerHTML = '';
    var total = document.getElementById('cartTotal');
    total.innerText = 0;
    var totalForm = document.getElementById('cartTotalForm');
    totalForm.value = 0;

    items.forEach(item => {
      // console.log(item);
      cartContainer.innerHTML += `
        <tr>
          <td>${item.name}</td>
          <td>
            <div class="mb-1">${item.price - item.discount} &times; ${item.quantity}</div>
            <div class="btn-group">
              <button type="button" class="btn btn-outline-dark btn-sm" onclick="addQty(${item.id})"><i class="fas fa-plus"></i></button>
              <button type="button" class="btn btn-outline-dark btn-sm" onclick="subQty(${item.id})"><i class="fas fa-minus"></i></button>
            </div>
          </td>
          <td>${(item.price - item.discount) * item.quantity}</td>
          <th class="px-0">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(${item.id})"><i class="fas fa-trash"></i></button>
          </th>
        </tr>
      `;
      var newTotal = parseInt(total.innerText) + (item.price - item.discount) * item.quantity;
      total.innerText = newTotal;
      totalForm.value = newTotal;
    })

    
    // items.forEach(item => {
    //   var row = document.createElement('div');
    //   row.className = 'cart-item';
    //   row.innerHTML = `
    //     <strong>${item.name}</strong><br>
    //     Price: $${item.price} ${item.discount ? `(–$${item.discount} off)` : ''}<br>
    //     Quantity: ${item.quantity}
    //     <button class="inc" data-id="${item.id}">+</button>
    //     <button class="dec" data-id="${item.id}">−</button>
    //     <button class="remove" data-id="${item.id}">Remove</button>
    //   `;
    //   cartContainer.appendChild(row);
    // });
  }
  printCart();
  // addItem(id, name, price, quantity = 1, discount = 0)
 
</script>
