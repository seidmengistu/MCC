<?php
session_start();
include('../../includes/config.php');    
if(isset($_POST['change']))
  {   
    $username=trim($_POST['username']);
    $password=md5($_POST['password']);
    $confirmpassword=md5($_POST['confirmpassword']);
    $department=$_POST['department'];
    
    if($password!=$confirmpassword)
        {
                $_SESSION['status']="Password And Confirm Password Not Mached";
                $_SESSION['status_code']="warning";
                header('Location:showprofile.php');
                exist();
        }

  else{
        $username=$_SESSION['username']; 
        // var_dump($username);
        // die();
        $sql="UPDATE admin SET UserName=:username,Department=:department,Password=:password WHERE UserName=:username";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username',$username,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR);
        $query->bindParam(':department',$department,PDO::PARAM_STR);
        
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
     
        if(!$lastInsertId)
        {
        $_SESSION['status']="Update Profile Information Successfully";
        $_SESSION['status_code']="success";
        header('Location:showprofile.php');

        }
        else 
        {
        $_SESSION['status']="Some Problem";
        $_SESSION['status_code']="error";
        header('Location:showprofile.php');
        }
    }
   }
  
?>