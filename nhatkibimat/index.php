<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="form.php" method="POST">
        <input type="email" name="email" id="email" 
        value="<?php 
        if(isset($_POST['email'])) { 
            echo addslashes($_POST['email']); 
        }?> ">
        <input type="password" name="password" 
        value="<?php 
        if(isset($_POST['password'])) { 
            echo addslashes($_POST['password']); 
        }?> ">
        <input type="submit" name="submit" value="Sign Up" />
    </form>

    <form action="form.php" method="POST">
        <input type="email" name="loginemail" id="email" 
        value="<?php 
        if(isset($_POST['email'])) { 
            echo addslashes($_POST['email']); 
        }?> ">
        <input type="password" name="loginpassword" 
        value="<?php 
        if(isset($_POST['password'])) { 
            echo addslashes($_POST['password']); 
        }?> ">
        <input type="submit" name="submit" value="Log In" />
    </form>
</body>
</html>