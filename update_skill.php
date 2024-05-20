<?php
// Include database connection file
require_once "db.php";
include("auth_session.php");

// Check if form is submitted
if (isset($_POST['save'])) {
    // Update skill information
    $skill_id = $_POST['skill_id'];
    $skill_name = mysqli_real_escape_string($conn, $_POST['skill_name']);
    $proficiency_level = mysqli_real_escape_string($conn, $_POST['proficiency_level']);
    $category_id = $_POST['category_id'];
    $student_id = $_POST['student_id'];

    mysqli_query($conn, "UPDATE skills SET skill_name='$skill_name', proficiency_level='$proficiency_level', category_id='$category_id', student_id='$student_id' WHERE skill_id='$skill_id'");
    
    // Alert for successful update
    echo '<script>alert("Skill information updated successfully")</script>';

    // Redirect to dashboard after updating
    echo "<script>window.location.href ='skills.php'</script>";
    exit();
}

// Fetch skill data from database
if (isset($_GET['id'])) {
    $skill_id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT skills.skill_id, skills.skill_name, skills.proficiency_level, skills.category_id, skills.student_id, student.first_name, student.last_name, category_type.category_type FROM skills JOIN student ON skills.student_id = student.student_id JOIN category_type ON skills.category_id = category_type.category_id WHERE skills.skill_id='$skill_id'");
    $row = mysqli_fetch_array($result);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Update Skill | Skill Development System</title>
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
                <h2>UPDATE SKILL</h2>
            </div>

            <!-- Update Skill Form -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="student_id">Student Name:</label>
                                    <select class="form-control show-tick selectpicker" data-style="border" data-live-search="true" id="student_id" name="student_id" required>
                                        <option value="<?php echo $row['student_id']; ?>" selected><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></option>
                                        <!-- Fetch students from database and populate options -->
                                        <?php
                                        $student_query = mysqli_query($conn, "SELECT * FROM student");
                                        while ($student = mysqli_fetch_array($student_query)) {
                                            echo '<option value="' . $student['student_id'] . '">' . $student['first_name'] . ' ' . $student['last_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Course:</label>
                                    <select class="form-control show-tick selectpicker" data-style="border" data-live-search="true" id="category_id" name="category_id" required>
                                        <option value="<?php echo $row['category_id']; ?>" selected><?php echo $row['category_type']; ?></option>
                                        <!-- Fetch categories from database and populate options -->
                                        <?php
                                        $categories_query = mysqli_query($conn, "SELECT * FROM category_type");
                                        while ($category = mysqli_fetch_array($categories_query)) {
                                            echo '<option value="' . $category['category_id'] . '">' . $category['category_type'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="skill_name">Skill:</label>
                                    <select class="form-control show-tick selectpicker" data-style="border" data-live-search="true" id="skill_name" name="skill_name" required>
                                        <option value="C++" <?php if ($row["skill_name"] == "C++") echo "selected"; ?>>C++</option>
                                        <option value="Python" <?php if ($row["skill_name"] == "Python") echo "selected"; ?>>Python</option>
                                        <option value="Javascript" <?php if ($row["skill_name"] == "Javascript") echo "selected"; ?>>Javascript</option>
                                        <option value="C#" <?php if ($row["skill_name"] == "C#") echo "selected"; ?>>C#</option>
                                        <option value="PHP" <?php if ($row["skill_name"] == "PHP") echo "selected"; ?>>PHP</option>
                                        <option value="SQL" <?php if ($row["skill_name"] == "SQL") echo "selected"; ?>>SQL</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="proficiency_level">Proficiency Level:</label>
                                    <select class="form-control show-tick selectpicker" data-style="border" data-live-search="true" id="proficiency_level" name="proficiency_level" required>
                                        <option value="Beginner" <?php if ($row["proficiency_level"] == "Beginner") echo "selected"; ?>>Beginner</option>
                                        <option value="Intermediate" <?php if ($row["proficiency_level"] == "Intermediate") echo "selected"; ?>>Intermediate</option>
                                        <option value="Advanced" <?php if ($row["proficiency_level"] == "Advanced") echo "selected"; ?>>Advanced</option>
                                    </select>
                                </div>
                                
                               
                                <input type="hidden" name="skill_id" value="<?php echo $row["skill_id"]; ?>"/>
                                <input type="submit" class="btn btn-primary" name="save" value="Update">
                                <a href="skills.php" class="btn btn-danger">Cancel</a>
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
