<?php
include("auth_session.php");
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>CSIT SKILL DEVELOPMENT SYSTEM</title>
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

    <!-- JQuery DataTable Css -->
    <link href="includes/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Export Css -->
    <link href="includes/plugins/jquery-datatable/extensions/export/buttons.dataTables.min.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="includes/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="includes/css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red" style="background-color: #f1f1f1;">
    <?php include("nav.php"); ?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    SKILL DEVELOPMENT PROGRESS
                    <small>Progress of Skills</small>
                </h2>
            </div>

            <!-- Progress DataTable -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                PROGRESS DATATABLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <a href="create_progress.php" class="btn btn-primary float-right">Add New Progress</a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <?php
                                include_once 'db.php'; // Assuming db.php contains database connection code

                                $recountQuery = "SET @count = 0";
                                mysqli_query($conn, $recountQuery);
                                $updateIDQuery = "UPDATE progress SET progress_id = @count:= @count + 1";
                                mysqli_query($conn, $updateIDQuery);

                                $resultProgress = mysqli_query($conn, "SELECT p.progress_id, s.skill_name, st.first_name, st.last_name, p.progress_percentage, p.completion_date FROM progress p LEFT JOIN skills s ON p.skill_id = s.skill_id LEFT JOIN student st ON p.student_id = st.student_id");
                                ?>
                                <?php
                                if (mysqli_num_rows($resultProgress) > 0) {
                                ?>
                                    <table class="table table-bordered table-striped table-hover js-basic-example">
                                        <thead>
                                            <tr>
                                                <th>Progress ID</th>
                                                <th>Student Name</th>
                                                <th>Skill</th>
                                                <th>Progress Percentage</th>
                                                <th>Completion Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($resultProgress)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row["progress_id"]; ?></td>
                                                    <td><?php echo $row["first_name"] . " " . $row["last_name"]; ?></td>
                                                    <td><?php echo $row["skill_name"]; ?></td>
                                                    <td><?php echo $row["progress_percentage"]; ?></td>
                                                    <td><?php echo $row["completion_date"]; ?></td>
                                                    <td>
                                                        <a href="view_progress.php?id=<?php echo $row["progress_id"]; ?>" class="btn btn-primary" title="View Progress">View</a>
                                                        <a href="update_progress.php?id=<?php echo $row["progress_id"]; ?>" class="btn btn-success" title="Update Progress">Update</a>
                                                        <a href="delete_progress.php?id=<?php echo $row["progress_id"]; ?>" class="btn btn-danger" title="Delete Progress">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php
                                } else {
                                    echo "No progress found";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exportable Progress Table -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EXPORTABLE PROGRESS TABLE
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
                            <div class="table-responsive">
                                <?php
                                include_once 'db.php';
                                $resultProgress = mysqli_query($conn, "SELECT progress.progress_id, student.first_name, student.last_name, skills.skill_name, progress.progress_percentage, progress.completion_date FROM progress JOIN student ON progress.student_id = student.student_id JOIN skills ON progress.skill_id = skills.skill_id");
                                ?>
                                <?php if (mysqli_num_rows($resultProgress) > 0) : ?>
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Progress ID</th>
                                                <th>Student Name</th>
                                                <th>Skill</th>
                                                <th>Progress Percentage</th>
                                                <th>Completion Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($resultProgress)) : ?>
                                                <tr>
                                                    <td><?php echo $row["progress_id"]; ?></td>
                                                    <td><?php echo $row["first_name"] . " " . $row["last_name"]; ?></td>
                                                    <td><?php echo $row["skill_name"]; ?></td>
                                                    <td><?php echo $row["progress_percentage"]; ?></td>
                                                    <td><?php echo $row["completion_date"]; ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                <?php else : ?>
                                    <p>No progress found</p>
                                <?php endif; ?>
                            </div>
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
