<?php

include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');

if(isset($_SESSION['isLoggedIn'])){
    header("location:dash.php");
  }

if (isset($_POST['submit'])) {
         // Assigning POST values to variables.
        $username = $_POST['user'];
        $loginResults = $db->query("SELECT password FROM 'user' WHERE username='$username'");

        foreach($loginResults as $row){
            echo 'Entered the foreach';
                if(password_verify($_POST['password'], $row['password'])){
                    $result = $db->query("SELECT * FROM 'user' INNER JOIN 'userImage' ON 'user'.image = 'userImage'.userImageId WHERE username='$username'");
                    foreach($result as $row)
                        {
                            $_SESSION['isLoggedIn'] = true;
                            $_SESSION["userId"] = $row['id'];
                            $_SESSION["user"] = $row['username'];
                            $_SESSION["first"] = $row['first'];
                            $_SESSION["last"] = $row['last'];
                            $_SESSION["status"] = $row['admin'];
                            $_SESSION["image"] = $row['fileName'];
                        }

                        echo 'Password Accepted';

                    header('Location: dash.php?action=loggedin');
                    exit;
                }else{
                    echo 'Password Failed';
                }
        }

}

include_once($_SERVER['DOCUMENT_ROOT'] . 'parts/head.php');

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Content Row -->
            <div class="row align-items-center">

                <div class="col">
                </div>

                <!-- Content Column -->
                <div class="col-lg-4 mb-4">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Project</h6>
                        </div>
                        <div class="card-body">
                            <form action='' method='post'>
                                <div class="form-group">
                                    <label for="user">Username</label>
                                    <input type="text" class="form-control" name="user" id="user" aria-describedby="userHelp" value='<?php if(isset($error)){ echo $_POST['user'];}?>' placeholder="username">
                                    <small id="userHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" value='<?php if(isset($error)){ echo $_POST['password'];}?>' placeholder="password">
                                </div>
                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="col">
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