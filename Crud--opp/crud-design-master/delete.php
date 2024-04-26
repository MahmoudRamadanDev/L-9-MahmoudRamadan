<?php include('inc/header.php'); ?>
<?php if (isset($_GET['id']) && is_numeric($_GET['id'])) : ?>

    <?php $row = $db->find("employees", $_GET['id']); ?>
    
    <?php if ($row) : ?>
        <h1 class="text-center col-12 bg-danger py-3 text-white my-2">Delete Employee</h1>

            <div class="alert alert-success text-center" role="alert">
                <?php echo $db->delete("employees" , $row['id']) ?>
            </div>

    <?php endif; ?>
<?php endif; ?>
<?php include('inc/footer.php'); ?>