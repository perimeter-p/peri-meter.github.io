<?php
$servername = "localhost";
$username = "root";
$password = "";
$DBName = 'selamban_register';

 $conn = new mysqli($servername, $username, $password);
 if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
 $sql = "CREATE DATABASE $DBName";
 $conn->query($sql);
 $conn->close();
 function execQuery($command){
   $conn2 = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'],$GLOBALS['DBName']);
   if ($conn2->connect_error) die("Connection failed: " . $conn2->connect_error);
   $conn2->query($command);
   $conn2->close();
 }
 execQuery("CREATE TABLE shares (
         shareId       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         firstname        VARCHAR(255) NULL,
         lastname        VARCHAR(255) NULL,
         phone        VARCHAR(255)  NULL,
         email VARCHAR(255) NULL,
         nationality VARCHAR(255) NULL,
         country VARCHAR(255) NULL,
         city VARCHAR(255) NULL,
         stat VARCHAR(255) NULL,
         zipcode VARCHAR(255) NULL,
         passportnumber VARCHAR(255) NULL,
         yellowcardNumber VARCHAR(255) NULL,
         currency VARCHAR(255) NULL,
         numofShares VARCHAR(255) NULL,
         subscribedamount VARCHAR(255) NULL,
         paidmount VARCHAR(255) NULL,
         servicecharge VARCHAR(255) NULL,
         agentname VARCHAR(255) NULL,
         agentphone VARCHAR(255) NULL,
         paydate DATE
         remaining VARCHAR(255) NULL,
   )");
   execQuery("CREATE TABLE images (
     imageId       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     imagename        VARCHAR(255) NULL,
     shareId      INT,
     FOREIGN KEY (shareID) REFERENCES shares(PersonID)
      )");
if( $_POST['first_name']==null||$_POST['last_name']==null||$_POST['user_phone_number']==null||$_POST['email_address']==null|| $_POST['nationality']==null||$_POST['country']==null||$_POST['city']==null||$_POST['state']==null||$_POST['postal']==null||$_POST['pass-port']==null||$_POST['yellow-card']==null||$_POST['currency']==null||$_POST['number-of-share']==null||$_POST['paid-amount']==null||$_POST['agent_name']==null||$_POST['agent_phone']==null||$_POST['share-sub']==null||$_POST['service-charge']==null){
    header( "Location: formde.html" );
    exit();
}else{
    if(empty($_FILES['upload_img']['name'])){
        header( "Location: formde.html" );
        exit();
    }
     $isValid = true;
    $integer_pattern = "~^[0-9]+$~";    
    $decimal_pattern =  "~^[0-9]*[.]?[0-9,]+$~";
    $currency_pattern  =  "~^[a-zA-Z\s].*$~";
    $name_pattern = "~^[a-zA-Z\s]+$~";
    $phone_pattern = "~^\+?[0-9\-\(\)\s]+$~"; 
    $email_pattern = "~^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$~";
    $alphanumeric_pattern ="~^[a-zA-Z0-9\s]+$~";
    $passport_pattern =   "~^[a-z-:_0-9A-Z\s]+$~";

    if(!preg_match($name_pattern,trim($_POST['first_name']))) $isValid = false;
    else if(!preg_match($name_pattern,trim($_POST['last_name']))) $isValid = false;
    else if(!preg_match($phone_pattern,trim($_POST['user_phone_number']))) $isValid = false;
    else if(!preg_match($email_pattern,trim($_POST['email_address']))) $isValid = false;
    else if(!preg_match($alphanumeric_pattern,trim($_POST['nationality']))) $isValid = false;
    else if(!preg_match($alphanumeric_pattern,trim($_POST['country']))) $isValid = false;
    else if(!preg_match($alphanumeric_pattern,trim($_POST['city']))) $isValid = false;
    else if(!preg_match($alphanumeric_pattern,trim($_POST['state']))) $isValid = false;
    else if(!preg_match($integer_pattern,trim($_POST['postal']))) $isValid = false;
    else if(!preg_match($passport_pattern,trim($_POST['pass-port']))) $isValid = false;
    else if(!preg_match($integer_pattern,trim($_POST['yellow-card'])))  $isValid = false;
    else if(!preg_match($currency_pattern,trim($_POST['currency'])))  $isValid = false;
    else if(!preg_match($integer_pattern,trim($_POST['number-of-share'])))  $isValid = false;
    else if(!preg_match($integer_pattern,trim($_POST['paid-amount'])))  $isValid = false;
    else if(!preg_match($name_pattern,trim($_POST['agent_name'])))  $isValid = false;
    else if(!preg_match($phone_pattern,trim($_POST['agent_phone'])))  $isValid = false;
    else if(!preg_match($integer_pattern,trim($_POST['share-sub'])))  $isValid = false;
    else if(!preg_match($decimal_pattern,trim($_POST['service-charge'])))  $isValid = false;

    if(!$isValid){
         header( "Location: confirmshare.html" );
         exit();
    }
}

$conn3 = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'],$GLOBALS['DBName']);
if ($conn3->connect_error) die("Connection failed: " . $conn3->connect_error);
$insertCommand = $conn3->prepare("INSERT INTO shares VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?)");
$insertCommand->bind_param("sssssssssssssssssss",$fname,$lname,$phone,$email,$nationality,$country,$city,$state,$zipcode,$passportnumber,$yellowcardnumber,$currency,$numshare,$subscribedamount,$paidamount,$servicecharge,$agentname,$agentphone,$remaining);
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$phone = $_POST['user_phone_number']; 
$email = $_POST['email_address'];
$nationality = $_POST['nationality'];
$country = $_POST['country'];
$city =  $_POST['city'];
$state =  $_POST['state'];
$zipcode =  $_POST['postal'];
$passportnumber =   $_POST['pass-port'];
$yellowcardnumber =  $_POST['yellow-card'];
$currency = $_POST['currency'];
$numshare = $_POST['number-of-share'];
$subscribedamount =  ((double)$_POST['number-of-share'])*1000;//  $_POST['share-sub'];
$paidamount =   $_POST['paid-amount'] == "1" ? ((int)$subscribedamount)/2 : $subscribedamount;
$agentname =  $_POST['agent_name'];
$agentphone =  $_POST['agent_phone'];
$servicecharge = ((int)$subscribedamount)*0.05;
$remaining = ((int)$subscribedamount) - ((int)$paidamount);
$insertCommand->execute();
$shareId = $conn3->insert_id;
if(!empty($_FILES['upload_img']['name'])){
	if(!file_exists("./uploads")) mkdir("uploads");
    $files = array_filter($_FILES['upload_img']['name']);
    $countfiles = count($files);
    for($i=0;$i<$countfiles;$i++){
        $name = $_FILES['upload_img']['name'][$i];
        $temp = $_FILES['upload_img']['tmp_name'][$i];
        $imageFileType = pathinfo($name,PATHINFO_EXTENSION); 
        $fullFileName =  $shareId.'_'.($i+1).'.'.$imageFileType;
        move_uploaded_file($temp, "./uploads/img_".$fullFileName);
        $insertCommand = $conn3->prepare("INSERT INTO images VALUES (NULL,?,?)");
        $insertCommand->bind_param("si",$img,$sid);
        $img = $fullFileName;
        $sid = $shareId;
        $insertCommand->execute();
    }
}
header( "Location: confirmshare.html" );

    ?>
