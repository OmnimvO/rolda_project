<?php
// Include database connection file
require_once "db.php";
include("auth_session.php");

// Check if form is submitted
if (isset($_POST['save'])) {
    // Update category type information
    $category_id = $_POST['category_id'];
    $category_type = mysqli_real_escape_string($conn, $_POST['category_type']);
    $department_name = mysqli_real_escape_string($conn, $_POST['department_name']);
    $student_id = $_POST['student_id'];
    $course = $_POST['course'];

    mysqli_query($conn, "UPDATE category_type SET category_type='$category_type', department_name='$department_name', student_id='$student_id', course='$course' WHERE category_id='$category_id'");
    
    // Alert for successful update
    echo '<script>alert("Category type information updated successfully")</script>';

    // Redirect to dashboard after updating
    echo "<script>window.location.href ='category.php'</script>";
    exit();
}

// Fetch category type data from database
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT category_type.category_id, category_type.category_type, category_type.department_name, category_type.course, student.student_id, student.first_name, student.last_name FROM category_type JOIN student ON category_type.student_id = student.student_id WHERE category_type.category_id='$category_id'");
    $row = mysqli_fetch_array($result);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Update Category Type | Skill Development System</title>
    <!-- Favicon-->
    <link rel="icon" href="includes/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="includes/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Selectpicker Css -->
    <link href="includes/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">

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
                <h2>UPDATE CATEGORY TYPE</h2>
            </div>

            <!-- Update Category Type Form -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="student_name">Student Name:</label>
                                    <select class="form-control show-tick selectpicker" data-style="border" data-live-search="true" id="student_name" name="student_id" required>
                                        <?php
                                            // Fetch all students
                                            $student_result = mysqli_query($conn, "SELECT * FROM student");
                                            while($student_row = mysqli_fetch_array($student_result)) {
                                                $selected = ($student_row["student_id"] == $row["student_id"]) ? "selected" : "";
                                                echo "<option value='".$student_row["student_id"]."' $selected>".$student_row["first_name"]. " " . $student_row["last_name"]. "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category_type">Category Type:</label>
                                    <select class="form-control show-tick selectpicker" data-style="border" data-live-search="true" id="category_type" name="category_type" required>
                                        <option value="High-Level Languages" <?php if ($row["category_type"] == "High-Level Languages") echo "selected"; ?>>High-Level Languages</option>
                                        <option value="Low-Level Languages" <?php if ($row["category_type"] == "Low-Level Languages") echo "selected"; ?>>Low-Level Languages</option>
                                        <option value="Scripting Languages" <?php if ($row["category_type"] == "Scripting Languages") echo "selected"; ?>>Scripting Languages</option>
                                        <option value="Database Query Languages" <?php if ($row["category_type"] == "Database Query Languages") echo "selected"; ?>>Database Query Languages</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="course">Course:</label>
                                    <select class="form-control show-tick selectpicker" data-style="border" id="course" name="course" required>
                                        <option value="Information Technology" <?php if ($row["course"] == "Information Technology") echo "selected"; ?>>Information Technology</option>
                                        <option value="Computer Science" <?php if ($row["course"] == "Computer Science") echo "selected"; ?>>Computer Science</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="department_name">Department:</label>
                                    <input style="border: 1px solid #eee;" type="text" class="form-control" id="department_name" name="department_name" value="<?php echo $row["department_name"]; ?>" required>
                                </div>
                                
                                <input type="hidden" name="category_id" value="<?php echo $row["category_id"]; ?>"/>
                                <input type="submit" class="btn btn-primary" name="save" value="Update">
                                <a href="category.php" class="btn btn-danger">Cancel</a>
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

    <!-- Bootstrap Selectpicker Js -->
    <script src="includes/plugins/bootstrap-select/bootstrap-select.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="includes/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>
</body>

</html>
