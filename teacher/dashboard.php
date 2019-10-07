<?php
include '../connection.php';
$teacherId = $_SESSION['teacherId'];
$teacherName = '';
$result = array();
if ($teacherId > 0 && $teacherId != '') {
    $sql = "SELECT * FROM teacher WHERE teacherId = '" . $teacherId . "'";
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
                                        <th>Id</th>
                                        <td><?php echo $result['teacherId']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo $result['teacherName']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $result['teacherEmail']; ?></td>
                                    </tr>
                                </table>
                                <a href="../index.php" class="btn btn-block btn-default btn-xs">Logout</a>
                            </div>
                            <div class="col-md-6">
                                <a href="javascript:void(0)" class="btn btn-block btn-default">Assigned Courses</a><br>
                                <?php
                                // getting course information
                                $courseSql = "SELECT * FROM course WHERE courseTeacher = $teacherId";
                                $courseRunSql = mysqli_query($con, $courseSql);
                                $checkRow = mysqli_num_rows($courseRunSql);
                                if ($checkRow > 0):
                                    while ($obj = mysqli_fetch_object($courseRunSql)):
                                        ?>
                                        <a href="view_student_list.php?id=<?php echo $obj->courseId; ?>&name=<?php echo $obj->courseName; ?>"><?php echo $obj->courseName; ?></a><br>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <p>No courses assigned yet</p>
                                <?php endif; ?>
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
