<?php

include($_SERVER['DOCUMENT_ROOT'] . 'includes/database.php');

?>
<ul>
    <li><a href="/">Home</a></li>
    <li><a href="/addUser.php">Add User</a></li>
</ul>

<h2>Add Fo User</h2>

<?php

// //if form has been submitted process it
// if(isset($_POST['submit'])){

//     //collect form data
//     extract($_POST);

//     //very basic validation
//     if($username ==''){
//         $error[] = 'Please enter the username.';
//     }
//     if($firstName ==''){
//         $error[] = 'Please enter the First Name.';
//     }
//     if($lastName ==''){
//         $error[] = 'Please enter the Last Name.';
//     }

//     $username = htmlspecialchars($username);

//     $firstName = htmlspecialchars($firstName);

//     $lastName = htmlspecialchars($lastName);

//     if(!isset($error)){

//         try {

//             //insert into database
//             $stmt = $db->prepare('INSERT INTO user (username,first,last) VALUES (:username,:first,:last)') ;
//             $stmt->execute(array(
//                 ':username' => $username,
//                 ':first' => $firstName,
//                 ':last' => $lastName
//             ));

//             header('Location: /?action=added');
//             exit;

//         } catch(PDOException $e) {
//             echo $e->getMessage();
//         }

//     }

// }

//check for any errors
if(isset($error)){
    foreach($error as $error){
        echo '<p class="error">'.$error.'</p>';
    }
}

$user = 0;
$admin = 1;

?>

<form action='createUser.php' method='post' enctype='multipart/form-data'>

    <p><label>Username</label><br />
    <input type='text' name='username' value='<?php if(isset($error)){ echo $_POST['username'];}?>'></p>
    <p><label>First Name</label><br />
    <input type='text' name='firstName' value='<?php if(isset($error)){ echo $_POST['firstName'];}?>'></p>
    <p><label>Last Name</label><br />
    <input type='text' name='lastName' value='<?php if(isset($error)){ echo $_POST['lastname'];}?>'></p>
    <p><label>Password</label><br />
    <input type='text' name='password' value='<?php if(isset($error)){ echo $_POST['password'];}?>'></p>

    <p><input type='submit' name='submit' value='Submit'></p>

</form>