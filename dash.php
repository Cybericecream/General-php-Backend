<?php

include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');

include($_SERVER['DOCUMENT_ROOT'] . 'includes/userLoggedIn.php');

include_once($_SERVER['DOCUMENT_ROOT'] . 'parts/head.php');
include_once($_SERVER['DOCUMENT_ROOT'] . 'parts/sidebar.php');

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

<?php include_once($_SERVER['DOCUMENT_ROOT'] . 'parts/topbar.php');?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                            <!-- Page Heading -->
                            <h1 class="h3 col-lg-8 mb-4 text-gray-800">Projects</h1>
                        <div class="col-lg-4">
                            <a href="addProject.php" class="btn btn-warning light-text float-right">Add New</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">

<?php 
    $result = $db->query("SELECT * FROM 'projects' JOIN 'projectsImage' ON (projectsImage.projectsId = projects.id)");

    foreach($result as $row)
    {
?>
                <!-- Content Column -->
                <div class="col-lg-6 mb-4">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><?php echo $row['title'] ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <img class="col-lg-12 mb-4" src="<?php echo '/img/screenshots/' . $row['fileName'] ?>">
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <h2 class="h3 dark-text"><?php echo $row['title'] ?></h2>
                                </div>
                                <div class="col-lg-6 mb-4">
                                <?php

                                    $userProfile = $row['id'];

                                    $userResult = $db->query("SELECT * FROM 'user-projects' JOIN 'userImage' ON (userImage.userId='user-projects'.userId) JOIN 'user' ON (user.id='user-projects'.userId) WHERE 'user-projects'.'u-p-id' = 4");
                                    foreach($userResult as $rows)
                                    {
                                ?>
                                    <img class="dash-profile col-lg-3 float-right" src="<?php echo '/img/profiles/' . $rows['fileName'] ?>" alt="<?php echo $rows['first'] . $rows['last']; ?>'s Profile Picture">
                                    <?php 
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <p><?php echo $row['description'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="editProject.php?id=<?php echo $row['id']; ?>" class="btn btn-warning light-text float-right">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!--end of column -->                
<?php
    }
?>

            </div>
        
        </div>
        <!-- /.container-fluid -->

    </div>
      <!-- End of Main Content -->

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . 'parts/footer.php');
?>

</div>
<!-- End of Content Wrapper -->


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . 'parts/close.php');