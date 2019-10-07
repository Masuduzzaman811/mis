<?php

include '../connection.php';


if ($_GET['type'] && $_GET['id']) {

    if ($_GET['type'] == 'Teacher') {
        // teacher delete
        $sql = "DELETE FROM teacher WHERE teacherId = '" . $_GET['id'] . "'";
        $runSql = mysqli_query($con, $sql);
        if ($runSql) {
            // deleted successfully
            header('location: teacher_list.php');
        } else {
            echo "Something went wrong. Please try again.";
        }
    } elseif ($_GET['type'] == 'Class') {
        // class delete
        $sql = "DELETE FROM class WHERE classId = '" . $_GET['id'] . "'";
        $runSql = mysqli_query($con, $sql);
        if ($runSql) {
            // deleted successfully
            header('location: class_list.php');
        } else {
            echo "Something went wrong. Please try again.";
        }
    } elseif ($_GET['type'] == 'Student') {
        // student delete
        $sql = "DELETE FROM student WHERE studentId = '" . $_GET['id'] . "'";
        $runSql = mysqli_query($con, $sql);
        if ($runSql) {
            // deleted successfully
            header('location: student_list.php');
        } else {
            echo "Something went wrong. Please try again.";
        }
    }elseif ($_GET['type'] == 'Course') {
        // course delete
        $sql = "DELETE FROM course WHERE courseId = '" . $_GET['id'] . "'";
        $runSql = mysqli_query($con, $sql);
        if ($runSql) {
            // deleted successfully
            header('location: course_list.php');
        } else {
            echo "Something went wrong. Please try again.";
        }
    }
} else {
    echo "Something went wrong. Please try again.";
}
?>