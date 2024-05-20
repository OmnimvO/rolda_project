<?php
// Include database connection file
require_once "db.php";
include("auth_session.php");

// Check if form is submitted
if (isset($_POST['save'])) {
    // Update progress information
    $progress_id = $_POST['progress_id'];
    $student_name = $_POST['student_name'];
    $skill_name = $_POST['skill_name'];
    $progress_percentage = $_POST['progress_percentage'];
    $completion_date = $_POST['completion_date'];

    // Fetch student_id based on their names
    $student_query = mysqli_query($conn, "SELECT student_id FROM student WHERE CONCAT(first_name, ' ', last_name) = '$student_name'");
    
    // Fetch skill_id based on skill name
    $skill_query = mysqli_query($conn, "SELECT skill_id FROM skills WHERE skill_name = '$skill_name'");

    if (mysqli_num_rows($student_query) > 0 && mysqli_num_rows($skill_query) > 0) {
        $student_row = mysqli_fetch_assoc($student_query);
        $skill_row = mysqli_fetch_assoc($skill_query);
        $student_id = $student_row['student_id'];
        $skill_id = $skill_row['skill_id'];

        mysqli_query($conn, "UPDATE progress SET student_id='$student_id', skill_id='$skill_id', progress_percentage='$progress_percentage', completion_date='$completion_date' WHERE progress_id='$progress_id'");

        // Alert for successful update
        echo '<script>alert("Progress information updated successfully")</script>';

        // Redirect to dashboard after updating
        echo "<script>window.location.href ='progress.php'</script>";
        exit();
    } else {
        echo '<script>alert("Error: Unable to find student or skill.")</script>';
    }
}

// Fetch progress data from database
if (isset($_GET['id'])) {
    $progress_id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT progress.*, CONCAT(student.first_name, ' ', student.last_name) AS student_name, skills.skill_name FROM progress JOIN student ON progress.student_id = student.student_id JOIN skills ON progress.skill_id = skills.skill_id WHERE progress.progress_id='$progress_id'");
    $row = mysqli_fetch_array($result);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Update Progress | Skill Development System</title>
    <!-- Favicon-->
    <link rel="icon" href="includes/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="includes/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="includes/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="includes/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="includes/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="includes/css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <?php include("nav.php"); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>UPDATE PROGRESS</h2>
            </div>

            <!-- Update Progress Form -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="student_name">Student Name:</label>
                                    <select style="border: 1px solid #eee;" class="form-control" id="student_name" name="student_name" required>
                                        <?php
                                            // Fetch all students
                                            $student_result = mysqli_query($conn, "SELECT CONCAT(first_name, ' ', last_name) AS full_name FROM student");
                                            while($student_row = mysqli_fetch_array($student_result)) {
                                                $selected = ($student_row["full_name"] == $row["student_name"]) ? "selected" : "";
                                                echo "<option value='".$student_row["full_name"]."' $selected>".$student_row["full_name"]."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="skill_name">Skill Name:</label>
                                    <select style="border: 1px solid #eee;" class="form-control" id="skill_name" name="skill_name" required>
                                        <?php
                                            // Fetch all skills
                                            $skill_result = mysqli_query($conn, "SELECT skill_name FROM skills");
                                            while($skill_row = mysqli_fetch_array($skill_result)) {
                                                $selected = ($skill_row["skill_name"] == $row["skill_name"]) ? "selected" : "";
                                                echo "<option value='".$skill_row["skill_name"]."' $selected>".$skill_row["skill_name"]."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="progress_percentage">Progress Percentage:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="progress_percentage" name="progress_percentage" value="<?php echo $row["progress_percentage"]; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="completion_date">Completion Date:</label>
                                    <input style="border: 1px solid #eee;" type="date" class="form-control" id="completion_date" name="completion_date" value="<?php echo $row["completion_date"]; ?>" required>
                                </div>
                                <input type="hidden" name="progress_id" value="<?php echo $row["progress_id"]; ?>"/>
                                <input type="submit" class="btn btn-primary" name="save" value="Update">
                                <a href="progress.php" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="includes/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="includes/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="includes/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="includes/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="includes/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

    <!-- DataTables Export Plugin Js -->
    <script src="includes/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="includes/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>
    <script src="includes/js/pages/tables/jquery-datatable.js"></script>

</body>

</html>
