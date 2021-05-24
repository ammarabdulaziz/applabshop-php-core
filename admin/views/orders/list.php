<?php include('../views/sidebar.php') ?>
<div class="m-5" style="margin-top: 6em !important;">
    <div class="page-header d-flex justify-content-between">
        <h3>Orders</h3>
        <span></span>
    </div>

    <table class="table mt-3">

        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Price</th>
                <th scope="col">Payment</th>
                <th scope="col">Delivery</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) { ?>
                <tr class="pt-5 pb-5">
                    <th class="align-middle" scope="row"><?php echo $order['name'] ?? 'Unkown' ?></th>
                    <td class="align-middle"><?php echo $order['username'] ?? 'Unkown' ?></td>
                    <td class="align-middle"><?php echo $order['order_price'] . ' Qr' ?? 'Unkown' ?></td>
                    <td class="align-middle"><?php echo $order['payment_type'] ?? 'Unkown' ?></td>
                    <td class="align-middle text-capitalize 
                    <?php echo $order['status'] == 'Pending' ? 'text-danger' : ($order['status'] == 'Shipped' ? 'text-warning' : 'text-success');
                    echo ' ' . $order['order_id'] ?>"><?php echo $order['status'] ?? 'Unkown' ?>
                    </td>
                    <td class="align-middle"><?php echo $order['createdAt'] ?? 'Unkown' ?></td>
                    <td class="align-middle">
                        <span data-toggle="tooltip" data-placement="top" title="View items">
                            <span data-toggle="modal" data-target=".bd-example-modal-lg-<?php echo $order['order_id'] ?? '' ?>">
                                <button type="button" class="btn btn-sm btn-info pt-2 pb-2"><i class='bx bx-expand-alt'></i></button>
                            </span>
                        </span>
                        <span data-id='<?php echo $order['order_id'] ?? 'Unkown' ?>'>
                            <button type="button" class="btn btn-sm btn-danger pt-2 pb-2 btn-sts-upt" data-toggle="tooltip" data-placement="top" title="Pending"><i class='bx bx-x'></i></button>
                            <button type="button" class="btn btn-sm btn-warning pt-2 pb-2 btn-sts-upt" data-toggle="tooltip" data-placement="top" title="Shipped"><i class='bx bx-check'></i></button>
                            <button type="button" class="btn btn-sm btn-success pt-2 pb-2 btn-sts-upt" data-toggle="tooltip" data-placement="top" title="Delivered"><i class='bx bx-check-double'></i></button>
                        </span>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<!-- Large modal -->
<?php foreach ($orders as $order) { ?>
    <div class="modal fade bd-example-modal-lg-<?php echo $order['order_id'] ?? '' ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                $new_array = array_filter($order_items, function ($obj) use ($order) {
                    if ($obj['order_id'] == $order['order_id']) return $obj;
                });
                ?>
                <div class="modal-body">
                    <table class="table mt-0">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Image</th>
                                <th scope="col">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($new_array as $item) { ?>
                                <tr>
                                    <th scope="row"><?php echo $item['name'] ?? '' ?></th>
                                    <td><?php echo $item['brand'] ?? '' ?></td>
                                    <td><?php echo $item['price'] . ' Qr' ?? '' ?></td>
                                    <td><?php echo $item['qty'] ?? '' ?></td>
                                    <td><img src="<?php echo $item['image'] ?>" style="height: 50px; width: auto"></td>
                                    <td><?php echo $item['total_price'] . ' Qr' ?? '' ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php include('../views/footer.php') ?>