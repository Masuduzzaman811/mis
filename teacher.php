<?php
// connect with database
include './connection.php';
// variable initialization
$teacherId = '';
$teacherPassword = '';
$error = '';
if (isset($_POST['btnSubmit'])) {
    extract($_POST);
    // assign posted value into variables
    $teacherId = $_POST['teacherId'];
    $teacherPassword = $_POST['teacherPassword'];

    // login check
    // if authenticated pass otherwise show error messages
    $sql = "SELECT * FROM teacher WHERE teacherId = '" . $teacherId . "' AND teacherPassword = '" . $teacherPassword . "'";
    $runSql = mysqli_query($con, $sql);
    $checkRow = mysqli_num_rows($runSql);
    if ($checkRow > 0) {
        // login success
        $getData = mysqli_fetch_object($runSql);
        $_SESSION['teacherId'] = $getData->teacherId;
        header('location: teacher/dashboard.php');
    } else {
        // login failure
        $error = 'Invalid login credentials. Please check username or password.';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Management Information System</title>
        <link href="css/bootstrap_min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top: 50px">
                <div class="col-md-12">
                    <div class="col-md-6 col-md-offset-3">
                        <center>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <img src="image/logo.png" class="img img-responsive" style="height: 100px;width: auto"/>
                                    <h2>Teacher Access Portal</h2>
                                    <p style="color: red"><?php echo $error; ?></p>
                                    <form method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="teacherId" value="<?php echo $teacherId; ?>" placeholder="Enter Teacher Id" required/>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="teacherPassword" value="" placeholder="Enter Password" required/>
                                        </div>
                                        <button name="btnSubmit" class="btn btn-default btn-block btn-flat">Login</button>
                                    </form>
                                    <a href="">Forgot your password?</a><br>
                                    <a href="index.php">Back Home</a>
                                </div>
                                <div class="panel-footer">
									<?php include './footer.php'; ?>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/bootstrap_min.js" type="text/javascript"></script>
    </body>
</html>
