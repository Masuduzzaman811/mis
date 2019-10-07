<?php
include '../connection.php';
$courseId = '';
$courseName = '';
$courseTeacher = '';
$courseCredit = '';
$courseGrade = '';
$courseCanceledYear = '';
$error = ''; // error variable initializaiton

if (isset($_POST['btnSubmit'])) {
    extract($_POST);
    $courseId = $_POST['courseId'];
    $courseName = $_POST['courseName'];
    $courseTeacher = $_POST['courseTeacher'];
    $courseCredit = $_POST['courseCredit'];
    $courseGrade = $_POST['courseGrade'];
    $courseCanceledYear = $_POST['courseCanceledYear'];

    if (!is_numeric($courseId)) {
        $error = 'Course id should be numeric value';
    } else {
        $sql = "UPDATE course SET courseName = '$courseName', courseTeacher = '$courseTeacher', courseCredit = '$courseCredit',courseGrade = '$courseGrade',courseCanceledYear = '$courseCanceledYear' WHERE courseId = $courseId";
        $runSql = mysqli_query($con, $sql);
        if ($runSql) {
            header('location:course_list.php');
        } else {
            $error = 'Something went wrong. Please try again';
        }
    }
}

if (isset($_GET['id'])) {
    $courseId = $_GET['id'];
    $sql = "SELECT * FROM course WHERE courseId=$courseId";
    $runSql = mysqli_query($con, $sql);
    $obj = mysqli_fetch_object($runSql);
    $courseId = $obj->courseId;
    $courseName = $obj->courseName;
    $courseTeacher = $obj->courseTeacher;
    $courseCredit = $obj->courseCredit;
    $courseGrade = $obj->courseGrade;
    $courseCanceledYear = $obj->courseCanceledYear;
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
                                <a href="javascript:void(0)" class="btn btn-block btn-default">Edit Course Information</a><br>
                                <p style="color: red"><?php echo $error; ?></p>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label>Course Id</label>
                                        <input type="text" maxlength="7" readonly class="form-control" name="courseId" value="<?php echo $courseId; ?>" placeholder="Enter course id" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Course Name</label>
                                        <input type="text"  class="form-control" name="courseName" value="<?php echo $courseName; ?>" placeholder="Enter course name" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Course Teacher</label>
                                        <select class="form-control" name="courseTeacher" required>
                                            <option value="">Choose Teacher</option>
                                            <?php
                                            $teacherSql = "SELECT * FROM teacher";
                                            $teacherRunSql = mysqli_query($con, $teacherSql);
                                            if ($teacherRunSql):
                                                while ($obj = mysqli_fetch_object($teacherRunSql)):
                                                    ?>
                                                    <option value="<?php echo $obj->teacherId; ?>"<?php
                                                    if ($obj->teacherId = $courseTeacher) {
                                                        echo 'selected';
                                                    }
                                                    ?>><?php echo $obj->teacherName; ?></option>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Course Credit</label>
                                        <input type="text" class="form-control" name="courseCredit" value="<?php echo $courseCredit; ?>" placeholder="Enter course credit" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Course Grade</label>
                                        <select class="form-control" name="courseGrade" required>
                                            <option value="">Choose Grade</option>
                                            <option value="1"<?php
                                            if ($courseGrade == 1) {
                                                echo 'selected';
                                            }
                                            ?>>1st Grade</option>
                                            <option value="2"<?php
                                            if ($courseGrade == 2) {
                                                echo 'selected';
                                            }
                                            ?>>2nd Grade</option>
                                            <option value="3"<?php
                                            if ($courseGrade == 3) {
                                                echo 'selected';
                                            }
                                            ?>>3rd Grade</option>
                                            <option value="4"<?php
                                            if ($courseGrade == 4) {
                                                echo 'selected';
                                            }
                                            ?>>4th Grade</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Course Canceled Year</label>
                                        <input type="text" class="form-control" name="courseCanceledYear" value="<?php echo $courseCanceledYear; ?>" placeholder="Enter course canceled year"/>
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
