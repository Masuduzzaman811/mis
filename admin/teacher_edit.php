<?php
include '../connection.php';
// variable initialization
$teacherId = '';
$teacherName = '';
$teacherEmail = '';
$teacherPassword = '';
$error = ''; // error variable initializaiton
if (isset($_POST['btnSubmit'])) {
    extract($_POST); // extract all posted values
    // assign posted value into variables
    $teacherId = $_POST['teacherId'];
    $teacherName = $_POST['teacherName'];
    $teacherEmail = $_POST['teacherEmail'];

    $sql = "UPDATE teacher SET teacherName = '$teacherName', teacherEmail = '$teacherEmail' WHERE teacherId = $teacherId";
    $runSql = mysqli_query($con, $sql);
    if ($runSql) {
        header('location: teacher_list.php');
    } else {
        $error = 'Something went wrong. Please try again';
    }
}

if (isset($_GET['id'])) {
    $teacherId = $_GET['id'];

    // getting teacher information based in get url id
    $sql = "SELECT * FROM teacher WHERE teacherId=$teacherId";
    $runSql = mysqli_query($con, $sql);
    $obj = mysqli_fetch_object($runSql);
    $teacherId = $obj->teacherId;
    $teacherName = $obj->teacherName;
    $teacherEmail = $obj->teacherEmail;
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
                                <a href="teacher_list.php" class="btn btn-block btn-default btn-xs">Teacher List</a>
                                <a href="../index.php" class="btn btn-block btn-default btn-xs">Logout</a>
                            </div>
                            <div class="col-md-10">
                                <a href="javascript:void(0)" class="btn btn-block btn-default">Edit Teacher Information</a><br>
                                <p style="color: red"><?php echo $error; ?></p>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label>Teacher Id</label>
                                        <input type="text" readonly maxlength="5" class="form-control" name="teacherId" value="<?php echo $teacherId; ?>" placeholder="Enter Teacher Id" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Teacher Name</label>
                                        <input type="text" class="form-control" name="teacherName" value="<?php echo $teacherName; ?>" placeholder="Enter Teacher Name" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Teacher Email</label>
                                        <input type="email" class="form-control" name="teacherEmail" value="<?php echo $teacherEmail; ?>" placeholder="Enter Teacher Email" required/>
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
