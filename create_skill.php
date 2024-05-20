<?php
require_once "db.php";
include("auth_session.php");

if(isset($_POST['save']))
{    
    $skill_name = $_POST['skill_name'];
    $proficiency_level = $_POST['proficiency_level'];
    $category_id = $_POST['category_id'];
    $student_id = $_POST['student_id'];

    $sql = "INSERT INTO skills (skill_name, proficiency_level, category_id, student_id)
            VALUES ('$skill_name', '$proficiency_level', '$category_id', '$student_id')";
     
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Skill has been added.")</script>';
        echo "<script>window.location.href ='skills.php'</script>";
    } else {
        echo "Error: " . $sql . "
" . mysqli_error($conn);
    }
    mysqli_close($conn);
}

// Fetch category data for populating dropdown
$categories_query = mysqli_query($conn, "SELECT * FROM category_type");
if (!$categories_query) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch student data for populating dropdown with first name and last name concatenated
$students_query = mysqli_query($conn, "SELECT student_id, CONCAT(first_name, ' ', last_name) AS student_name FROM student");
if (!$students_query) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Form Examples | Bootstrap Based Admin Template - Material Design</title>
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

    <!-- Sweet Alert Css -->
    <link href="includes/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="includes/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="includes/css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="includes/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    
</head>

<body class="theme-red">
    <?php include ("nav.php"); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>FORM EXAMPLES</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>VERTICAL LAYOUT</h2>
                        </div>
                        <div class="body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                                <div class="col-md-12">
                                    <p><b>Select Student Name</b></p>
                                    <select class="form-control show-tick selectpicker" data-live-search="true" name="student_id">
                                        <?php while ($student = mysqli_fetch_assoc($students_query)): ?>
                                            <option value="<?= htmlspecialchars($student['student_id']) ?>">
                                                <?= htmlspecialchars($student['student_name']) ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-12">
                                    <p><b>Select Category</b></p>
                                    <select class="form-control show-tick selectpicker" data-live-search="true" name="category_id">
                                        <?php 
                                        while ($category = mysqli_fetch_assoc($categories_query)): ?>
                                            <option value="<?= htmlspecialchars($category['category_id']) ?>">
                                                <?= htmlspecialchars($category['category_type']) ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-12">
                                    <p><b>Select Skill</b></p>
                                    <select class="form-control show-tick selectpicker" data-live-search="true" name="skill_name">
                                        <option value="C++">C++</option>
                                        <option value="Python">Python</option>
                                        <option value="Javascript">Javascript</option>
                                        <option value="C#">C#</option>
                                        <option value="PHP">PHP</option>
                                        <option value="SQL">SQL</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-12">
                                    <p><b>Select Proficiency Level</b></p>
                                    <select class="form-control show-tick selectpicker" name="proficiency_level">
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Advanced">Advanced</option>
                                    </select>
                                </div>
                                
                                
                                <input type="submit" class="btn btn-primary m-t-15 waves-effect" name="save" value="Submit">
                                <a href="skills.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="includes/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="includes/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Bootstrap Select Plugin Js -->
    <script src="includes/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="includes/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="includes/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="includes/js/admin.js"></script>

    <!-- Demo Js -->
    <script src="includes/js/demo.js"></script>

    
    
</body>

</html>
