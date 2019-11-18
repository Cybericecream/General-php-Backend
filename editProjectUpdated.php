<?php

include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');

include($_SERVER['DOCUMENT_ROOT'] . 'includes/userLoggedIn.php');

// Pull the id from the url
$id = $_GET['id'];

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

            <?php 
                $result = $db->query("SELECT * FROM 'projects' JOIN 'projectsImage' ON (projectsImage.projectsId = projects.id) WHERE id = $id");

                foreach($result as $row)
                {
            ?>
                <!-- Content Column -->
                <div class="col-lg-12 mb-4">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Project</h6>
                        </div>
                        <div class="card-body">
                        <!-- <form action='updateProject.php?id=<?php echo $row['id']; ?>' method='post' enctype='multipart/form-data'> -->
                                <div class="row">
                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <label for="projectsTitle">Project Title</label>
                                            <input type="text" class="form-control" id="projectsTitle" name="projectsTitle" aria-describedby="projectsTitleHelp" value='<?php echo $row['title']; ?>' placeholder="Project Title">
                                            <small id="projectsTitleHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                        </div>

                                        <div class="form-group">
                                            <label for="projectsDescription">Project Description</label>
                                            <textarea rows="4" type="text" class="form-control" id="projectsDescription" name="projectsDescription" aria-describedby="projectsDescriptionHelp" placeholder="Project Description"><?php echo $row['description'];?></textarea>
                                            <small id="projectsDescriptionHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                        </div>

                                        <div class="form-group">
                                        <form action='addUsertoProject.php?id=<?php echo $row['id']; ?>' method='post' enctype='multipart/form-data'>
                                            <label for="exampleFormControlSelect1">Project Team Mates</label>
                                            <div class="input-group">
                                            <select class="form-control" name="newUser" id="exampleFormControlSelect1">
                                            <option value="" disabled selected>Add A Team Mate</option>
                                            <?php

                                            $userResult = $db->query("SELECT * FROM 'user'");
                                            foreach($userResult as $rows)
                                            {
                                        ?>
                                            <option value="<?php echo $rows['id']; ?>"><?php echo $rows['first'] . ' ' . $rows['last']; ?></option>
                                            <?php 
                                            }
                                            ?>
                                            </select>
                                            <input name="submit" type="submit" class="btn btn-warning" value="Add Contributor">
                                        </div>
                                        </form>
                                        <div class="form-group">
                                        <?php
                                        $userProfile = $id;

                                        $userResult = $db->query("SELECT * FROM 'user-projects' JOIN 'userImage' ON (userImage.userId='user-projects'.userId) WHERE 'user-projects'.'projectsId' = ". $userProfile);
                                        foreach($userResult as $rows)
                                        {
                                        ?>
                                        <img class="dash-profile col-lg-2 float-left" src="<?php echo '/img/profiles/' . $rows['fileName'] ?>" alt="Placeholder">
                                        <?php 
                                        }
                                        ?>
                                        </div>
                                        </div>
                                                                                
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" name="image" class="custom-file-input" id="inputGroupFile01" value="<?php echo $row['fileName'] ?>" aria-describedby="inputGroupFileAddon01">
                                                    <div id="uploadImage" class="custom-file-label" for="inputGroupFile01"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-danger" href="/deleteProject.php?id=<?php echo $row['id']; ?>">Delete</a>
                                    </div>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>

                </div><!-- End Content Column -->
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
<script>
var input = document.getElementById( 'inputGroupFile01' );
var infoArea = document.getElementById( 'uploadImage' );

input.addEventListener( 'change', showFileName );

  if( filename = ''){
    infoArea.textContent = 'Choose File';
  }else{
    infoArea.textContent = '<?php echo $row["fileName"]?>';
  }

function showFileName( event ) {
  
  // the change event gives us the input it occurred in 
  var input = event.srcElement;
  
  // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
  var fileName = input.files[0].name;
  
//   if( filename == null){
//     infoArea.textContent = 'Choose File';
//   }else{
//     infoArea.textContent = 'File name: ' + fileName;
//   }
  // use fileName however fits your app best, i.e. add it into a div
  infoArea.textContent = fileName;
}
</script>


<?php
include_once($_SERVER['DOCUMENT_ROOT'] . 'parts/close.php');