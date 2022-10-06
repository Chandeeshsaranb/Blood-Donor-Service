<?php

$uname = $_POST['uname'];
$Age  = $_POST['Age'];
$DOB = $_POST['DOB'];
$gender = $_POST['gender'];
$num = $_POST['num'];
$city = $_POST['city'];
$bloodgroup = $_POST['bloodgroup'];




if (!empty($uname) || !empty($Age) || !empty($DOB) || !empty($gender) ||!empty($num) ||!empty($city)||!empty($bloodgroup))
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "bds";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT num From donor Where num = ? Limit 1";
  $INSERT = "INSERT Into donor ( uname , Age ,DOB, gender, num, city, bloodgroup )values(?,?,?,?,?,?,?)";


     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("i", $num);
     $stmt->execute();
     $stmt->bind_result($num);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sississ", $uname,$Age,$DOB,$gender,$num,$city,$bloodgroup);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this number";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>