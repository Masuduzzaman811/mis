<?php
include '../connection.php';
$error = '';
$courseId = '';
$courseName = '';
$ciCourseId = '';
$ciTeacherId = '';
$courseGrade = '';
$checked = '';
$sql = '';

if (isset($_GET['id'])) {
    $courseId = $_GET['id'];
    $sql = "SELECT * FROM course WHERE courseId=$courseId";
    $runSql = mysqli_query($con, $sql);
    $obj = mysqli_fetch_object($runSql);
    $courseId = $obj->courseId;
    $courseName = $obj->courseName;
    $courseTeacher = $obj->courseTeacher;
    $courseGrade = $obj->courseGrade;
}

if (isset($_POST['btnSubmit'])) {
    extract($_POST);
    $ciCourseId = $_POST['courseId'];
    $ciTeacherId = $_POST['teacherId'];
    $checkSql = "SELECT * FROM course_information WHERE ciCourseId = $courseId";
    $runCheckSql = mysqli_query($con, $checkSql);
    $checkDuplicateRow = mysqli_num_rows($runCheckSql);
    if ($checkDuplicateRow > 0) {
        // delete previous course information
        $delSql = "DELETE FROM course_information WHERE ciCourseId = $ciCourseId";
        $runDelSql = mysqli_query($con, $delSql);
    }
    $array = array();
    foreach ($studentId as $student) {
        $sql = "INSERT INTO course_information (ciStudentId, ciCourseId, ciTeacherId) VALUES ('" . $student . "', '" . $ciCourseId . "', '" . $ciTeacherId . "')";
        $runSql = mysqli_query($con, $sql);
    }
    header('location:course_list.php');
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
                                <a href="course_list.php" class="btn btn-block btn-default btn-xs">Course List</a>
                                <a href="../index.php" class="btn btn-block btn-default btn-xs">Logout</a>
                            </div>
                            <div class="col-md-10">
                                <a href="javascript:void(0)" class="btn btn-block btn-default">Assign <span style="color: darkred"><?php echo $courseName; ?></span> Course To Students</a><br>
                                <p style="color: red"><?php echo $error; ?></p>
                                <form method="POST" action="">
                                    <input type="hidden" name="courseId" value="<?php echo $courseId; ?>" />
                                    <input type="hidden" name="teacherId" value="<?php echo $courseTeacher; ?>" />
                                    <?php
                                    $sql = "SELECT * FROM student WHERE studentGrade >= $courseGrade";
                                    $runSql = mysqli_query($con, $sql);
                                    $checkRow = mysqli_num_rows($runSql);
                                    if ($checkRow > 0):
                                        while ($obj = mysqli_fetch_object($runSql)):
                                            $checkAssigned = "SELECT * FROM course_information WHERE ciStudentId = $obj->studentId AND ciCourseId = $courseId";
                                            $runCheckAssigned = mysqli_query($con, $checkAssigned);
                                            $countRow = mysqli_num_rows($runCheckAssigned);
                                            if ($countRow > 0) {
                                                $checked = 'checked';
                                            } else {
                                                $checked = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="studentId[]" <?php echo $checked; ?> value="<?php echo $obj->studentId; ?>"> <?php echo $obj->studentName; ?> (<?php echo $obj->studentId; ?>) | <?php echo $obj->studentClass; ?><br><br>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
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
