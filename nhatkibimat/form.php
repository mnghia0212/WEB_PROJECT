<?php
    session_start();
    $error = "";
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "form-php";
                
    $conn = new mysqli($host, $username, $password, $dbname); 
    if ($_POST['submit']=="Sign Up") 
    {
        if (isset($_POST['submit'])) {
            if(!$_POST['email']) {
                $error.="<br> Please enter your email";
            } else if (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
                $error.="<br> Please enter a valid email address";
            }

            if(!$_POST['password']) $error.="<br> Please enter your password";
            else {
                if (strlen($_POST['password'])<8) $error.="<br> Please enter a password with at least 8 characters";
                if(!preg_match('`[A-Z]`', $_POST['password'])) $error.="<br> Please include at least one capital letter in your password";
            }
            if($error) echo "There were error(s) in your signup details:". $error;
            else {
                if($conn->connect_error) {
                    die("connect error:". $conn->connect_error);
                } echo "successful connection";
                $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($conn, $_POST['email'])."'";
                $result = mysqli_query($conn, $query);
                $results = mysqli_num_rows($result);
            }
            $email = $_POST['email'];    
            $password = md5(md5($_POST['email']).$_POST['password']);
            if(!empty($email) && !empty($password))
            {
                $sql = "INSERT INTO `users` (`email`, `password`) VALUES('$email', '$password')";
                if($conn->query($sql)===TRUE) {
                    echo "add data successfully";
                } else {
                    echo "error {$sql}". $conn->error;
                }
                $_SESSION['id']=mysqli_insert_id($conn);
                print_r($_SESSION);
            }
        }
    }
    
    if ($_POST['submit']=="Log In")
    {
        $query="SELECT * FROM `users` WHERE email= '".mysqli_real_escape_string($conn, $_POST['loginemail'])."' AND password='".md5(md5($_POST['loginemail']).$_POST['loginpassword'])."' LIMIT 1";
        $result = mysqli_query($conn, $query);
        $row= mysqli_fetch_array($result);
        if($row && isset($row['id'])) {
            $_SESSION['id']=$row['id'];
            print_r($SESSION);
        } else {
            echo "We could not find a user with that email and password. Please try again.";
        }
    } 
?>