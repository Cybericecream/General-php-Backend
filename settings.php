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

            <!-- Content Row -->
            <div class="row">

                <!-- Content Column -->
                <div class="col-lg-12 mb-4">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Settings</h6>
                        </div>
                        <div class="card-body">
                        <?php 
                            $result = $db->query("SELECT * FROM 'users' JOIN 'userDetails' ON (userDetails.userId = users.id) JOIN 'userImage' ON (userImage.userId = users.id) WHERE id =" . $_SESSION['userId']);

                            foreach($result as $row)
                            {
                        ?>
                            <form action='' method='post' enctype='multipart/form-data'>
                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <img class="img-profile rounded-circle" src="<?php 
                                                    if ($_SESSION["image"] != null ){
                                                        echo 'img/profiles/' . $_SESSION["image"];
                                                    } else {
                                                        echo 'img/profiles/defualt.png';
                                                    }

                                                    ?>">
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" value="Example.png" aria-describedby="inputGroupFileAddon01">
                                                            <div id="uploadImage" class="custom-file-label" for="inputGroupFile01"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <p>Your Username: <?php echo $_SESSION['user']; ?></p>
                                        </div>

                                        <div class="form-group">
                                            <label for="firstname">First Name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="firstnameHelp" value='<?php echo $_SESSION['first']; ?>' placeholder="First Name">
                                            <small id="firstnameHelp" class="form-text text-muted">The Details are purely to display next to your projects.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastnameHelp" value='<?php echo $_SESSION['last']; ?>' placeholder="Last Name">
                                            <small id="lastnameHelp" class="form-text text-muted">The Details are purely to display next to your projects.</small>
                                        </div>
                                        
                                        <br />

                                        <div class="form-group">
                                            <h2>Your Detail's</h2>

                                            <label for="portfolio">Portfolio Domain</label>
                                            <input type="url" class="form-control" id="portfolio" name="portfolio" aria-describedby="portfolioHelp" value='<?php //echo ;?>' placeholder="www.example.com">
                                            <small id="portfolioHelp" class="form-text text-muted">Input your link to your portfolio page.</small>

                                            <br />
                                            
                                            <label for="github">Github Link</label>
                                            <input type="url" class="form-control" id="github" name="github" aria-describedby="githubHelp" value='<?php //echo ;?>' placeholder="www.github.com/yourname">
                                            <small id="githubHelp" class="form-text text-muted">If you have a active Github put the link to your profile.</small>

                                            <br />
                                            
                                            <label for="linkedin">Linked In Link</label>
                                            <input type="url" class="form-control" id="linkedin" name="linkedin" aria-describedby="linkedinHelp" value='<?php //echo ;?>' placeholder="www.linkedin.com/in/yourname">
                                            <small id="linkedinHelp" class="form-text text-muted">If you have a active LinkedIn put the link to your profile.</small>

                                        </div>

                                        <br />

                                        <div class="form-group">
                                            <h2>Change Password</h2>

                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp" value='' placeholder="Password">
                                            <small id="passwordHelp" class="form-text text-muted">Use Capital's, Lowercase, Numbers and Special Characters.</small>

                                            <br />
                                            
                                            <label for="passwordConfirm">Confirm Password</label>
                                            <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" aria-describedby="passwordConfirmHelp" value='' placeholder="Confrim Password">
                                            <small id="passwordConfirmHelp" class="form-text text-muted">Ensure this is the same as the other field.</small>

                                        </div>

                                        <input name="submit" type="submit" class="btn btn-warning" value="Update Profile">

                                    </div>
                                </div>
                            </form>
                            <?php 
                            }
                            ?>
                        </div>
                    </div>

                </div>

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