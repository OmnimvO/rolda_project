<?php
// Include database connection file
require_once "db.php";
include("auth_session.php");

// Check if form is submitted
if (isset($_POST['save'])) {
    // Update student information
    $student_id = $_POST['student_id'];
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $date_of_birth = $_POST['date_of_birth'];

    mysqli_query($conn, "UPDATE student SET first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth' WHERE student_id='$student_id'");
    
    // Alert for successful update
    echo '<script>alert("Student information updated successfully")</script>';

    // Redirect to dashboard after updating
    echo "<script>window.location.href ='dashboard.php'</script>";
    exit();
}

// Fetch student data from database
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM student WHERE student_id='$student_id'");
    $row = mysqli_fetch_array($result);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Update Student | Skill Development System</title>
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
                <h2>UPDATE STUDENT</h2>
            </div>

            <!-- Update Student Form -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row["first_name"]; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row["last_name"]; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth:</label>
                                    <input style="border: 1px solid #eee;" type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo $row["date_of_birth"]; ?>" required>
                                </div>
                                <input type="hidden" name="student_id" value="<?php echo $row["student_id"]; ?>"/>
                                <input type="submit" class="btn btn-primary" name="save" value="Update">
                                <a href="dashboard.php" class="btn btn-danger">Cancel</a>
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
