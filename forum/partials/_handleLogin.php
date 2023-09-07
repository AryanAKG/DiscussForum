<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $username = $_POST['loginUsername'];
    //securing username input from XSS attack
    $username = str_replace("<", "&lt;", $username);
    $username = str_replace(">", "&gt;", $username);

    $pass = $_POST['loginPass'];
    //securing pass input from XSS attack
    $pass = str_replace("<", "&lt;", $pass);
    $pass = str_replace(">", "&gt;", $pass);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = 'true';
            $_SESSION['user'] = $username;
            $_SESSION['sno'] = $row['sno'];
            $showAlert = true;
            header("Location: /forum/index.php?loginsuccess=true");
            exit();
        }
        header("Location: /forum/index.php?loginsuccess=false");
        
    }
    header("Location: /forum/index.php?loginsuccess=false");
}
?>