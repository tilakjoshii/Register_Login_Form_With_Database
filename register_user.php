<?php
require_once 'database_connection_create.php';
if (isset($_POST['firstname'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $h_password = password_hash($password, PASSWORD_DEFAULT);
    $h_repassword = password_hash($repassword, PASSWORD_DEFAULT);
    // require_once 'Database_table_create.php';
    $sql = "SELECT * FROM student WHERE email= '{$_POST['email']}' ";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        header('location:form_sample_for_new_user.php?error="email address is already exits"');
        // echo '<div style="color:red;">'."email address is already exits"."</div";
        exit();
    }
    if ($password == $repassword && strlen($password) >= 8) {
        $sql = "INSERT INTO `student` (`firstname`, `lastname`, `email`, `phonenumber`, `website`, `password`, `repassword`, `date_time`) VALUES ('$firstname', '$lastname', '$email', '$phone', '$website', '$h_password', '$h_repassword', current_timestamp());";
    } else {
        // echo '<div style="color:red;">' . "Don't Match Re-wite Password OR You enter less than 8 character password" . " </div>" . "<br>";
        header('location:form_sample_for_new_user.php?error="Not Match Re-write Password OR You enter less than 8 character"');
        exit();
    }
    if ($connect->query($sql) == true) {
        echo "success" . "<br>";
        header('location:form_sample_for_new_user.php?success="Register successfully"');
        exit();
    } else {
        $error = "error:" . $connect->error;
        header('location:form_sample_for_new_user.php?error=error');
    }
    // echo "Success Data Entry"."<br>";
} else {
    echo "No found any data" . "<br>";
}
$connect->close();
?>