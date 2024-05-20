<?php
// Include auth_session.php file on all user panel pages
include("auth_session.php");

// Include database connection
include_once 'db.php';

// Check if the progress ID is provided
if (isset($_GET['id'])) {
    // Escape user input for security
    $progress_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch progress details from the database
    $resultProgress = mysqli_query($conn, "SELECT p.*, st.first_name, st.last_name, s.skill_name
                                        FROM progress p 
                                        LEFT JOIN student st ON p.student_id = st.student_id 
                                        LEFT JOIN skills s ON p.skill_id = s.skill_id 
                                        WHERE p.progress_id = $progress_id");

    // Check if the query was successful
    if (!$resultProgress) {
        // Query failed, display error message
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    // Check if the progress exists
    if (mysqli_num_rows($resultProgress) == 1) {
        $row = mysqli_fetch_assoc($resultProgress);
    } else {
        // Progress not found, display message
        echo "<p>Progress not found</p>";
        exit();
    }
} else {
    // Progress ID not provided, display message
    echo "<p>Progress ID not provided</p>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>View Progress Details</title>
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
                <h2>VIEW PROGRESS DETAILS</h2>
            </div>
            <!-- View Progress Details -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Progress Details</h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Progress ID</th>
                                        <td><?php echo htmlspecialchars($row["progress_id"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Student Name</th>
                                        <td><?php echo htmlspecialchars($row["first_name"] . " " . $row["last_name"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Skill Name</th>
                                        <td><?php echo htmlspecialchars($row["skill_name"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Progress Percentage</th>
                                        <td><?php echo htmlspecialchars($row["progress_percentage"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Completion Date</th>
                                        <td><?php echo htmlspecialchars($row["completion_date"]); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button onclick="window.location.href='progress.php'" class="btn btn-primary">Back to Dashboard</button>
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

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>

    <!-- Demo Js -->
    <script src="includes/js/demo.js"></script>
</body>
</html>
