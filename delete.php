<?php
include_once 'db.php'; // Assuming db.php contains the database connection logic

if(isset($_GET["id"])) {
    $student_id = $_GET["id"];
    
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
        // If confirmed, proceed with deletion
        $sql = "DELETE FROM student WHERE student_id=$student_id";

        if (mysqli_query($conn, $sql)) {
            // Deletion successful
            mysqli_close($conn);
            header("Location: dashboard.php"); // Redirect to dashboard after deletion
            exit();
        } else {
            // Error occurred during deletion
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Confirmation dialog
        echo '<script>
            if (confirm("Are you sure you want to delete this student?")) {
                window.location.href = "delete.php?id=' . $student_id . '&confirmed=true";
            } else {
                window.location.href = "dashboard.php";
            }
        </script>';
    }
}
?>
