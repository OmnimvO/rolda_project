<?php
require_once "db.php";
include("auth_session.php");

if(isset($_POST['save']))
{    
     $student_id = $_POST['student_id'];
     $skill_id = $_POST['skill_id'];
     $progress_percentage = $_POST['progress_percentage'];
     $completion_date = $_POST['completion_date'];

     $sql = "INSERT INTO progress (student_id, skill_id, progress_percentage, completion_date)
     VALUES ('$student_id', '$skill_id', '$progress_percentage', '$completion_date')";
     
     if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Progress has been added.")</script>';
        echo "<script>window.location.href ='progress.php'</script>";
     } else {
        echo "Error: " . $sql . "
" . mysqli_error($conn);
     }
     mysqli_close($conn);
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
<?php include ("nav.php");   ?>


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
                            <h2>
                                VERTICAL LAYOUT
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="form-group">
                                <?php 
                                require_once "db.php";
                                // Execute the query
                                $students = mysqli_query($conn, "SELECT * FROM student");
                                $skills = mysqli_query($conn, "SELECT * FROM skills");

                                // Check for errors and if rows are returned
                                if (!$students || !$skills) {
                                    die("Query failed: " . mysqli_error($conn));
                                }?>
                                <div class="col-md-12">
                                    <p>
                                        <b>Select Student Name</b>
                                    </p>
                                    <select class="form-control show-tick selectpicker" data-live-search="true" name="student_id" id="student">
                                    <?php while ($student = mysqli_fetch_assoc($students)): ?>
                                        <option value="<?= htmlspecialchars($student['student_id']) ?>"><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></option>
                                    <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <p>
                                        <b>Select Skill</b>
                                    </p>
                                    <select class="form-control show-tick selectpicker" data-live-search="true" name="skill_id">
                                    <?php while ($skill = mysqli_fetch_assoc($skills)): ?>
                                        <option value="<?= htmlspecialchars($skill['skill_id']) ?>"><?= htmlspecialchars($skill['skill_name']) ?></option>
                                    <?php endwhile; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-12">
                                    <p>
                                        <b>Enter Progress Percentage</b>
                                    </p>
                                    <input type="text" class="form-control" placeholder="Enter Progress Percentage" name="progress_percentage">
                                </div>

                                <div class="col-md-12">
                                    <p>
                                        <b>Select Completion Date</b>
                                    </p>
                                    <input type="date" class="form-control" name="completion_date">
                                </div>
                            </div>
                                
                            <input type="submit" class="btn btn-primary m-t-15 waves-effect" name="save" value="Submit">
                            <a href="progress.php" class="btn btn-danger m-t-15 waves-effect">Cancel</a>
                        </form> 
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
