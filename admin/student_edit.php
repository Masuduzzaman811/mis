<?php
include '../connection.php';
$studentId = '';
$studentName = '';
$studentAge = '';
$studentSex = '';
$studentYear = '';
$studentGrade = '';
$studentClass = '';
$error = '';
// error variable initializaiton

if (isset($_POST['btnSubmit'])) {
    extract($_POST);
    $studentId = $_POST['studentId'];
    $studentName = $_POST['studentName'];
    $studentSex = $_POST['studentSex'];
    $studentAge = $_POST['studentAge'];
    $studentYear = $_POST['studentYear'];
    $studentGrade = $_POST['studentGrade'];
    $studentClass = $_POST['studentClass'];

    if (!is_numeric($studentId)) {
        $error = 'Student id should be numeric value';
    } else {
        $sql = "UPDATE student SET studentName = '$studentName', studentSex = '$studentSex', studentAge = '$studentAge',studentYear = '$studentYear',studentGrade = '$studentGrade', studentClass = '$studentClass' WHERE studentId = $studentId";
        $runSql = mysqli_query($con, $sql);
        if ($runSql) {
            header('location:student_list.php');
        } else {
            $error = 'Something went wrong. Please try again';
        }
    }
}

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];

    // getting student information based in get url id
    $sql = "SELECT * FROM student WHERE studentId=$studentId";
    $runSql = mysqli_query($con, $sql);
    $obj = mysqli_fetch_object($runSql);
    $studentId = $obj->studentId;
    $studentName = $obj->studentName;
    $studentAge = $obj->studentAge;
    $studentSex = $obj->studentSex;
    $studentYear = $obj->studentYear;
    $studentGrade = $obj->studentGrade;
    $studentClass = $obj->studentClass;
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
                                <a href="student_list.php" class="btn btn-block btn-default btn-xs">Student List</a>
                                <a href="../index.php" class="btn btn-block btn-default btn-xs">Logout</a>
                            </div>
                            <div class="col-md-10">
                                <a href="javascript:void(0)" class="btn btn-block btn-default">Edit Student Information</a><br>
                                <p style="color: red"><?php echo $error; ?></p>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label>Student Id</label>
                                        <input type="text" readonly maxlength="10"  class="form-control" name="studentId" value="<?php echo $studentId; ?>" placeholder="Enter student id" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Student Name</label>
                                        <input type="text"  class="form-control" name="studentName" value="<?php echo $studentName; ?>" placeholder="Enter student name" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Student Sex</label>
                                        <select class="form-control" name="studentSex" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Student Entrance Age</label>
                                        <input type="text" maxlength="2" class="form-control" name="studentAge" value="<?php echo $studentAge; ?>" placeholder="Enter student entrance age" required/>
                                        <small style="color: darkred">Age must be between 10 - 50</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Student Entrance Year</label>
                                        <input type="text" class="form-control" name="studentYear" value="<?php echo $studentYear; ?>" placeholder="Enter student entrance year" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Student Grade</label>
                                        <select class="form-control" name="studentGrade" required>
                                            <option value="">Choose Grade</option>
                                            <option value="1"<?php if($studentGrade == 1){ echo 'selected'; } ?>>1st Grade</option>
                                            <option value="2"<?php if($studentGrade == 2){ echo 'selected'; } ?>>2nd Grade</option>
                                            <option value="3"<?php if($studentGrade == 3){ echo 'selected'; } ?>>3rd Grade</option>
                                            <option value="4"<?php if($studentGrade == 4){ echo 'selected'; } ?>>4th Grade</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Student Class</label>
                                        <select class="form-control" name="studentClass" required>
                                            <option value="">Choose Class</option>
                                            <?php
                                            $classSql = "SELECT * FROM class";
                                            $classRunSql = mysqli_query($con, $classSql);
                                            if ($classRunSql):
                                                while ($obj = mysqli_fetch_object($classRunSql)):
                                                    ?>
                                                    <option value="<?php echo $obj->className; ?>"<?php
                                                    if ($obj->className == $studentClass) {
                                                        echo 'selected';
                                                    }
                                                    ?>><?php echo $obj->className; ?></option>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>
                                        </select>
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
