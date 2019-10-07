<?php 
include './connection.php';
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Management Information System | MIS</title>
        <link href="css/bootstrap_min.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top: 50px">
                <div class="col-md-12">
                    <div class="col-md-8 col-md-offset-2">
                        <center>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <img src="image/logo.png" class="img img-responsive" style="height: 100px;width: auto"/>
                                    <h2>Management Information System</h2>
                                    <h2>Department of Computer Science and Engineering</h2>
                                    <h2>SCUT</h2>
                                    <div class="col-md-4">
                                        <a href="student.php" class="btn btn-block btn-default">Student Portal</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="teacher.php" class="btn btn-block btn-default">Teacher Portal</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="admin.php" class="btn btn-block btn-default">Admin Portal</a>
                                    </div>
                                </div>
                                <div class="panel-footer">
									<?php include './footer.php'; ?>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/bootstrap_min.js" type="text/javascript"></script>
    </body>
</html>
