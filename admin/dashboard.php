<?php
include '../connection.php';
$adminId = $_SESSION['adminId'];
$adminUsername = '';
$result = array();
if ($adminId > 0 && $adminId != '') {
    // get admin data from admin table
    $sql = "SELECT * FROM admin WHERE adminId = '" . $adminId . "'";
    $runSql = mysqli_query($con, $sql);
    if ($runSql) {
        $result = mysqli_fetch_array($runSql);
    }
} else {
    header('location:../index.php');
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

                            <div class="col-md-6">
                                <a href="javascript:void(0)" class="btn btn-block btn-default">Basic Information</a><br>
                                <table class="table table-responsive table-striped table-bordered">
                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo $result['adminName']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $result['adminEmail']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td><?php echo $result['adminPhone']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td><?php echo $result['adminUsername']; ?></td>
                                    </tr>
                                </table>
                                <a href="../index.php" class="btn btn-block btn-default btn-xs">Logout</a>
                            </div>
                            <div class="col-md-6">
                                <a href="teacher_list.php" class="btn btn-block btn-default">Teacher List</a>
                                <a href="class_list.php" class="btn btn-block btn-default">Class List</a>
                                <a href="student_list.php" class="btn btn-block btn-default">Student List</a>
                                <a href="course_list.php" class="btn btn-block btn-default">Course List</a>
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
