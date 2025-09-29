
<?php
require_once("models/categories.class.php");
$item = [];
if (isset($_GET["id"])) {
    $item = Categories::readById($_GET["id"]);
}

?>
<div class='content-wrapper'>
  <div class='content-header'>
    <div class='container-fluid'>
      <div class='row mb-2'>
        <div class='col-sm-6'>
          <h1 class='m-0'>Details of Categories</h1>
        </div>
      </div>
    </div>
  </div>
  <section class='content'>
    <div class='container-fluid'>
      <a href="categories" class="btn btn-primary mb-3">Back to Manage</a>

<?php if (!empty($item)) { ?>
<table class="table table-striped">
  <tr>
    <th>Id</th>
    <td><?php echo htmlspecialchars($item['id']); ?></td>
  </tr>
  <tr>
    <th>Name</th>
    <td><?php echo htmlspecialchars($item['name']); ?></td>
  </tr>
  <tr>
    <th>Is Active</th>
    <td><?php echo htmlspecialchars($item['is_active']); ?></td>
  </tr>
</table>
<?php } else { echo "<p>No data found.</p>"; } ?>

    </div>
  </section>
</div>
