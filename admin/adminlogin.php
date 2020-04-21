<?php
  session_start();
  include_once("../db_connect.php");
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
      $email=htmlspecialchars($_POST['email']);
      $password=htmlspecialchars($_POST['password']);
      $password = md5($password);

      $sql = "select * from admins where user_email='$email' AND user_pass='$password'";
      $resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
      $result_length = mysqli_num_rows($resultset);

      if($result_length == 1){
        if($row = mysqli_fetch_assoc($resultset)){
          $_SESSION['user_email']=$row['user_email'];
          echo "success";
        }
      }else{
        echo "Login Failed. Invalid Username or Password";
      }
      exit();
  }
  if(isset($_SESSION["user_email"])){
     echo "You are already logged in";
  }
  ?>


