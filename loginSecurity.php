<?php
function confirmEmailAddress($value) {
  include 'db_connect.php';

// AND LastLogin < (NOW() - INTERVAL 0 HOUR)
  $q =  "select * from LoginAttempts where email='$value' AND Attempts=5";

  $result = mysqli_query($con, $q) or die("database error:a". mysqli_error($con));
  $data = mysqli_fetch_array($result); 

  //Verify that at least one login attempt is in database
  if (!$data) {
    return '0';
  }
  else{
    return '1';
  }
  
}


function addLoginAttempt($value) {
   //Increase number of attempts. Set last login attempt if required.

   include 'db_connect.php';

   $sql = "select * from LoginAttempts where email = '$value'";
   $result = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
   $data = mysqli_fetch_array($result);

   if($data)
   {
      $attempts = $data["Attempts"]+1;

     if($attempts==5) {
       $q = "UPDATE LoginAttempts SET Attempts=".$attempts.", lastlogin=NOW() WHERE email = '$value'";
       $result = mysqli_query($con, $q);
     }
     else {
       $q = "UPDATE LoginAttempts SET Attempts=".$attempts." WHERE email = '$value'";
       $result = mysqli_query($con, $q);
     }
   }
   else {
     $q = "INSERT INTO LoginAttempts (Attempts,email,lastlogin) values (1, '$value', NOW())";
     $result = mysqli_query($con, $q);
   }
}

function clearLoginAttempts($value) {
  include 'db_connect.php';

  $q = "UPDATE LoginAttempts SET Attempts = 0 WHERE email = '$value'";
  return mysqli_query($con, $q);
}
?>