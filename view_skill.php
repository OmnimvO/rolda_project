<?php
// Include auth_session.php file on all user panel pages
include("auth_session.php");

// Include database connection
include_once 'db.php';

// Check if the skill ID is provided
if (isset($_GET['id'])) {
    // Escape user input for security
    $skill_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch skill details from the database
    $resultSkill = mysqli_query($conn, "SELECT s.*, c.category_type 
                                        FROM skills s 
                                        INNER JOIN category_type c ON s.category_id = c.category_id 
                                        WHERE skill_id = $skill_id");

    // Check if the query was successful
    if (!$resultSkill) {
        // Query failed, display error message
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    // Check if the skill exists
    if (mysqli_num_rows($resultSkill) == 1) {
        $row = mysqli_fetch_assoc($resultSkill);

        // Fetch student details from the database using student ID
        $student_id = $row['student_id'];
        $resultStudent = mysqli_query($conn, "SELECT first_name, last_name FROM student WHERE student_id = $student_id");

        // Check if the query was successful
        if (!$resultStudent) {
            // Query failed, display error message
            echo "Error: " . mysqli_error($conn);
            exit();
        }

        // Check if student exists
        if (mysqli_num_rows($resultStudent) == 1) {
            $student = mysqli_fetch_assoc($resultStudent);
            $first_name = $student['first_name'];
            $last_name = $student['last_name'];
        } else {
            // Student not found, set names to empty
            $first_name = "N/A";
            $last_name = "N/A";
        }
    } else {
        // Skill not found, display message
        echo "<p>Skill not found</p>";
        exit();
    }
} else {
    // Skill ID not provided, display message
    echo "<p>Skill ID not provided</p>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>View Skill Details</title>
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
                <h2>VIEW SKILL DETAILS</h2>
            </div>
            <!-- View Skill Details -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Skill Details</h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>Skill ID</th>
                                        <td><?php echo htmlspecialchars($row["skill_id"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Student Name</th>
                                        <td><?php echo htmlspecialchars($first_name . " " . $last_name); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Category Type</th>
                                        <td><?php echo htmlspecialchars($row["category_type"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Skill</th>
                                        <td><?php echo htmlspecialchars($row["skill_name"]); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Proficiency Level</th>
                                        <td><?php echo htmlspecialchars($row["proficiency_level"]); ?></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <button onclick="window.location.href='skills.php'" class="btn btn-primary">Back to Dashboard</button>
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
