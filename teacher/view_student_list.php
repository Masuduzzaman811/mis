<?php
include '../connection.php';
$name = '';
$id = '';
$error = '';
if (isset($_GET['name'])) {
    $name = $_GET['name'];
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_POST['btnSubmit'])) {
    extract($_POST);
    $ciStudentId = $_POST['ciStudentId'];
    $ciscore = $_POST['ciscore'];
    $ciTeacherId = $_POST['ciTeacherId'];
    $count = count($ciscore);
    if ($count > 0) {
        for ($i = 0; $i < $count; $i++) {
            $sql = "UPDATE course_information SET ciScore = $ciscore[$i]"
                    . " WHERE ciStudentId = $ciStudentId[$i] AND"
                    . " ciTeacherId = $ciTeacherId[$i] AND"
                    . " ciCourseId = $id";
            $runSql = mysqli_query($con, $sql);
        }
        header('location:dashboard.php');
    } else {
        $error = "Something went wrong";
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
                                <a href="../index.php" class="btn btn-block btn-default btn-xs">Logout</a>
                            </div>
                            <div class="col-md-10">
                                <a href="javascript:void(0)" class="btn btn-block btn-default">Course <span style="color: darkred">[<?php echo $name; ?>]</span> || Student List</a><br>
                                <p style="color: red"><?php echo $error; ?></p>
                                <form method="POST" action="">
                                    <?php
                                    $sql = "SELECT course_information.*, student.* FROM course_information"
                                            . " LEFT JOIN student ON course_information.ciStudentId = student.studentId WHERE ciCourseId = $id";
                                    $runSql = mysqli_query($con, $sql);
                                    $checkRow = mysqli_num_rows($runSql);
                                    if ($checkRow > 0):
                                        while ($obj = mysqli_fetch_object($runSql)):
                                            ?>
                                            <div class="col-md-4"><?php echo $obj->studentName; ?></div>
                                            <div class="col-md-4"><?php echo $obj->studentId; ?></div>
                                            <input type="hidden" name="ciStudentId[]" value="<?php echo $obj->studentId; ?>" >
                                            <input type="hidden" name="ciTeacherId[]" value="<?php echo $obj->ciTeacherId; ?>" >
                                            <div class="col-md-4">
                                                <input type="text" maxlength="6" class="form-control" name="ciscore[]" value="<?php echo $obj->ciScore; ?>" placeholder="Enter score" /><br>
                                            </div>
                                        <?php endwhile; ?>
                                        <div class="col-md-12">
                                            <button name="btnSubmit" class="btn btn-default btn-flat pull-right">Submit Score</button>
                                        </div>
                                    <?php else: ?>
                                        <p>No data found</p>
                                    <?php endif; ?>

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
