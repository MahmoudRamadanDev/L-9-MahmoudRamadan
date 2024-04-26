<?php include('inc/header.php'); ?>
<?php if (isset($_GET['id']) && is_numeric($_GET['id'])) : ?>

    <?php $row = $db->find("employees", $_GET['id']); ?>
    <?php if ($row) : ?>

        <?php

        $error = '';
        $success = '';
        $departments = ['cs', 'it', 'sc'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submit'])) {
                $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

                $deparment = filter_var($_POST['deparment'], FILTER_SANITIZE_STRING);

                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);


                if (empty($name) or empty($deparment) or empty($email)) {

                    $error = 'Please Fill All Fields';
                } else {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                        $deparment = strtolower($deparment);

                        if (in_array($deparment, $departments)) 
                        {
                            if (!empty($password)) 
                            {
                                $password = filter_var($_POST['password'] , FILTER_SANITIZE_STRING);
                                if (strlen($password) >= 6) 
                                {
                                    $password = $db->enc_password($password);
                                }
                                else 
                                {
                                    $error = "password Must be Greater Than 6 Chars !";
                                }

                                }
                                else 
                                {
                                    $password = $row['password'];
                                }


                            $sql = "UPDATE `employees` SET `name` = '$name' , `email` = '$email' , `deparment` = '$deparment' , 
                            `password` = '$password' WHERE `id` = '$row[id]'";
                            $success = $db->update($sql);

                        } else {
                            $error = 'Your Deparmet Not Valid';
                        }
                    } else {
                        $error = 'Please Type Valid Email';
                    }
                }
            }
        }



        ?>








        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="text-center col-12 bg-primary py-3 text-white my-2">Edit Info About Employee</h1>
                </div>
                <div class="col-sm-12">

                    <?php if (!$error == '') : ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?php echo $error ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!$success == '') : ?>
                        <div class="alert alert-success text-center" role="alert">
                            <?php echo $success ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 offset-md-3">
                    <form class="my-2 p-3 border" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <label for="exampleInputName1">Full Name</label>
                            <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" id="exampleInputName1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Deparment</label>
                            <input type="text" name="deparment" value="<?php echo $row['deparment']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputName1">Email address</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    <?php endif; ?>
<?php endif; ?>

<?php include('inc/footer.php'); ?>