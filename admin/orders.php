<?php

use TechStory\Classes\Models\Order;

include('inc/header.php') ?>
<?php

$ord = new Order;
$orders = $ord->selectAll("orders.id,orders.name,orders.phone,orders.status,orders.created_at,SUM(qty * price) AS total ")

?>
<div class="container-fluid py-5">
  <div class="row">

    <div class="col-md-10 offset-md-1">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>All Orders</h3>
      </div>
      <?php include(APATH . "inc/success.php"); ?>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Total</th>
            <th scope="col">Time</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($orders as $index => $order) : ?>

            <tr>
              <th scope="row"><?= $index + 1; ?></th>
              <td><?= $order['name']; ?></td>
              <td><?= $order['phone']; ?></td>
              <td>$<?= $order['total']; ?></td>
              <td><?= date("d M,Y h:i a", strtotime($order['created_at'])); ?></td>
              <?php if ($order['status'] == 'canceled') { ?>
                <td class="btn-danger"><?= $order['status'] ?></td>
              <?php } else if ($order['status'] == 'approved') { ?>
                <td class="btn-success"><?= $order['status'] ?></td>
              <?php } else { ?>
                <td class="btn-info"><?= $order['status'] ?></td>
              <?php } ?>
              <td>
                <a class="btn btn-sm btn-primary" href="<?= AURL . "order.php/?id=" . $order['id'] ?>">
                  <i class="fas fa-eye"></i>
                </a>
                <a class="btn btn-sm btn-danger" href="<?= AURL . "handlers/delete-order.php?id=" . $order['id'] ?>">
                  <i class="fas fa-trash"></i>
                </a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>

  </div>
</div>
<?php include('inc/footer.php') ?>