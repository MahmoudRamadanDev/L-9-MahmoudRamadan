<?php include('./inc/header.php'); ?>

<?php

$error = '';
$success = '';
$departments = ['cs', 'it', 'sc'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

        $deparment = filter_var($_POST['deparment'], FILTER_SANITIZE_STRING);

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        if (empty($name) || empty($deparment) || empty($email) || empty($password)) {

            $error = 'Please Fill All Fields';
        } else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $deparment = strtolower($deparment);

                if (in_array($deparment, $departments)) {

                    if (strlen($password) > 6) {
                        

                        $newpassword =  $db->enc_password($password);

                        $sql = "INSERT INTO `employees` (`name` , `deparment` , `email` , `password`)
                        VALUES ('$name' , '$deparment' , '$email' , '$newpassword')";

                        $success = $db->insert($sql);
                    } else {

                        $error = 'Must Be Greater Than 6 Char';
                    }
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



<h1 class="text-center col-12 bg-info py-3 text-white my-2">Add New Employee</h1>
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
<div class="col-md-6 offset-md-3">
    <form class="my-2 p-3 border" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <div class="form-group">
            <label for="exampleInputName1">Full Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputName1">
        </div>
        <div class="form-group">
            <label for="exampleInputName1">Deparment</label>
            <input type="text" name="deparment" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputName1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include('inc/footer.php'); ?>