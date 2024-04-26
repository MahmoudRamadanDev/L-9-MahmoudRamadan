<?php include('inc/header.php'); ?>

<h1 class="text-center col-12 bg-primary py-3 text-white my-2">All Employess</h1>
<?php if (count($db->read('employees'))) : ?>
<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">deparment</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($db->read('employees') as $row) :  ?>
                        <tr>
                            <td><?php echo strtoupper($row['name']) ?></td>
                            <td><?php echo strtoupper($row['deparment']) ?></td>
                            <td><?php echo ($row['email']) ?></td>
                            <td>
                                <a class="btn btn-info" href="edit.php?id=<?php echo $row['id'] ?>"> <i class="fa fa-edit"></i> </a>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id'] ?>"> <i class="fa fa-close"></i> </a>
                            </td>
                        </tr>
                    <?php endforeach;  ?>

                    
                </tbody>
            </table>
        </div>
        <?php else : ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo "Not Found Data"; ?>
            </div>
        <?php endif; ?>
</div>

<?php include('inc/footer.php'); ?>