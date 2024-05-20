<?php
include_once 'db.php'; // Assuming db.php contains the database connection logic

if(isset($_GET["id"])) {
    $progress_id = $_GET["id"];
    
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
        // If confirmed, proceed with deletion
        $sql = "DELETE FROM progress WHERE progress_id=$progress_id";

        if (mysqli_query($conn, $sql)) {
            // Deletion successful
            mysqli_close($conn);
            header("Location: progress.php"); // Redirect to dashboard after deletion
            exit();
        } else {
            // Error occurred during deletion
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Confirmation dialog
        echo '<script>
            if (confirm("Are you sure you want to delete this progress record?")) {
                window.location.href = "delete_progress.php?id=' . $progress_id . '&confirmed=true";
            } else {
                window.location.href = "progress.php";
            }
        </script>';
    }
}
?>
