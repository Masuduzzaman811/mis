<?php
include '../connection.php';
$className = '';
$error = ''; // error variable initializaiton

if (isset($_POST['btnSubmit'])) {
    extract($_POST);
    $className = $_POST['className'];

    $checkDuplicateSql = "SELECT * FROM class WHERE className = '" . $className . "'";
    $runDuplicateSql = mysqli_query($con, $checkDuplicateSql);
    $checkDuplicateRow = mysqli_num_rows($runDuplicateSql);
    if ($checkDuplicateRow > 0) {
        $error = "Class name already exists.";
    } else {
        $sql = "INSERT INTO class (className) VALUES ('" . $className . "')";
        $runSql = mysqli_query($con, $sql);
        if ($runSql) {
            header('location:class_list.php');
        } else {
            $error = 'Something went wrong. Please try again';
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Management Information System</title>
        <link href="../css/bootstrap_min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top: 10px">
                <div class="col-md-12">
                    <center>
                        <img src="../image/logo.png" class="img img-responsive" style="height: 100px;width: auto;margin-bottom: 10px"/>
                    </center>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-2">
                                <a href="dashboard.php" class="btn btn-block btn-default btn-xs">Home</a>
                                <a href="class_list.php" class="btn btn-block btn-default btn-xs">Class List</a>
                                <a href="../index.php" class="btn btn-block btn-default btn-xs">Logout</a>
                            </div>
                            <div class="col-md-10">
                                <a href="javascript:void(0)" class="btn btn-block btn-default">Add New Class</a><br>
                                <p style="color: red"><?php echo $error; ?></p>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <input type="text"  class="form-control" name="className" value="<?php echo $className; ?>" placeholder="Enter class name" required/>
                                    </div>

                                    <button name="btnSubmit" class="btn btn-default btn-block btn-flat">Submit</button>
                                </form>
                            </div>
                        </div>
                        <div class="panel-footer">
									<?php include '../footer.php'; ?>
                                </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/jquery.js" type="text/javascript"></script>
        <script src="../js/bootstrap_min.js" type="text/javascript"></script>
    </body>
</html>
