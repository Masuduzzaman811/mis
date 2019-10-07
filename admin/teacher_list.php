<?php
include '../connection.php';
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
								<a href="class_list.php" class="btn btn-block btn-default btn-xs">Class List</a>
								<a href="student_list.php" class="btn btn-block btn-default btn-xs">Student List</a>
								<a href="course_list.php" class="btn btn-block btn-default btn-xs">Course List</a>
                                <a href="../index.php" class="btn btn-block btn-default btn-xs">Logout</a>
                            </div>
                            <div class="col-md-10">
                                <a href="javascript:void(0)" class="btn btn-block btn-default">Teacher List</a><br>
                                <table class="table table-responsive table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // getting teacher information from teacher table
                                        $sql = "SELECT * FROM teacher";
                                        $runSql = mysqli_query($con, $sql);
                                        $checkRow = mysqli_num_rows($runSql);
                                        if ($checkRow > 0):
                                            while ($obj = mysqli_fetch_object($runSql)):
                                                ?>
                                                <tr>
                                                    <td><?php echo $obj->teacherId; ?></td>
                                                    <td><?php echo $obj->teacherName; ?></td>
                                                    <td><?php echo $obj->teacherEmail; ?></td>
                                                    <td>
                                                        <a href="teacher_edit.php?id=<?php echo $obj->teacherId; ?>" class="btn btn-default btn-xs">Edit</a>
                                                        <a href="delete.php?type=Teacher&id=<?php echo $obj->teacherId; ?>" class="btn btn-default btn-xs">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td style="text-align: center;"colspan="4">No data found in table</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center" colspan="3"></td>
                                            <td class="text-left" colspan="1">
                                                <a href="teacher_add.php">
                                                    <button class="btn btn-default btn-sm">
                                                        <i class="fa fa-plus"></i>&nbsp;Add New
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    </tfoot>
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
