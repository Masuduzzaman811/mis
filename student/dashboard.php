<?php
include '../connection.php';
$studentId = $_SESSION['studentId'];
$studentName = '';
$result = array();
if ($studentId > 0 && $studentId != '') {
    $sql = "SELECT * FROM student WHERE studentId = '" . $studentId . "'";
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
                                        <td><?php echo $result['studentId']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo $result['studentName']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sex</th>
                                        <td><?php echo $result['studentSex']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Entrance Age</th>
                                        <td><?php echo $result['studentAge']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Entrance Year</th>
                                        <td><?php echo $result['studentYear']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Grade</th>
                                        <?php if ($result['studentGrade'] == 1): ?>
                                            <td>1st Grade</td>
                                        <?php elseif ($result['studentGrade'] == 2): ?>
                                            <td>2nd Grade</td>
                                        <?php elseif ($result['studentGrade'] == 3): ?>
                                            <td>3rd Grade</td>
                                        <?php elseif ($result['studentGrade'] == 4): ?>
                                            <td>4th Grade</td>
                                        <?php else: ?>
                                            <td>N/A</td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <th>Class</th>
                                        <td><?php echo $result['studentClass']; ?></td>
                                    </tr>
                                </table>
                                <a href="../index.php" class="btn btn-block btn-default btn-xs">Logout</a>
                            </div>
                            <div class="col-md-6">
                                <a href="javascript:void(0)" class="btn btn-block btn-default">Course Results</a><br>
                                <table class="table table-responsive table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Course Name</th>
                                            <th>Course Score</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    // getting course information
                                    $courseSql = "SELECT course_information.*, course.* FROM course_information"
                                            . " LEFT JOIN course ON course_information.ciCourseId = course.courseId"
                                            . " WHERE ciStudentId = $studentId";
                                    $courseRunSql = mysqli_query($con, $courseSql);
                                    $checkRow = mysqli_num_rows($courseRunSql);
                                    if ($checkRow > 0):
                                        while ($obj = mysqli_fetch_object($courseRunSql)):
                                            ?>

                                            <tbody>
                                                <tr>
                                                    <td><?php echo $obj->courseName; ?></td>
                                                    <td><?php echo $obj->ciScore; ?></td>
                                                </tr>
                                            </tbody>

                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <p>No courses assigned yet</p>
                                    <?php endif; ?>
                                </table>
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
