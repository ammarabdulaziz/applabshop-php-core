<?php include('../views/sidebar.php') ?>
<div class="m-5" style="margin-top: 6em !important;">
    <div class="page-header d-flex justify-content-between">
        <h3>Users</h3>
        <span></span>
    </div>

    <!-- <?php print("<pre>" . print_r($users, true) . "</pre>"); ?> -->
    <table class="table mt-3">

        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Type</th>
                <th scope="col">Created At</th>
                <!-- <th scope="col"></th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <th class="align-middle" scope="row"><?php echo $user['name'] ?? 'Unkown' ?></th>
                    <td class="align-middle"><?php echo $user['username'] ?? 'Unkown' ?></td>
                    <td class="align-middle"><?php echo $user['type'] ?? 'Unkown' ?></td>
                    <td class="align-middle"><?php echo $user['createdAt'] ?? 'Unkown' ?></td>
                    <!-- <td class="align-middle">
                        <a href='products-edit.php?id=<?php echo $user['user_id'] ?? 'Unkown' ?>' type="button" class="btn btn-sm btn-info"><i class='bx bxs-edit-alt'></i></a>
                        <a onclick="return delete_confirm(<?php echo $user['user_id'] ?? null ?>)" type="button" class="btn btn-sm btn-danger"><i class='bx bx-x'></i></a>
                    </td> -->
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include('../views/footer.php') ?>