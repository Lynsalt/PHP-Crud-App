<?php

/*start a session in order to display a message 
after the user has performed a crud action*/
session_start();

//connect to database
$mysqli = new mysqli('server', 'username','password','databasename') or die(mysqli_error($mysqli));

//default values
$id = 0;
$update =false;
$firstname ='';
$lastname  ='';
$pumkinpie ='' ;
$applepie  ='';
$telephone ='';
$pickupminutes ='';
$subtotal = '';
$tax   =  '';
$total =  '';

//check if the placeorder button or save btn has been clicked and insert a record
if(isset($_POST['save'])){
   
   $firstname = htmlspecialchars($_POST['fname']);
   $lastname  = htmlspecialchars($_POST['lname']);
   $pumkinpie = htmlspecialchars($_POST['pumkinpie']);
   $applepie  = htmlspecialchars($_POST['applepie']);
   $telephone = htmlspecialchars($_POST['telephone']);
   $pickupminutes = htmlspecialchars($_POST['pickupminutes']);
   $subtotal = htmlspecialchars($_POST['subtotal']);
   $tax   =  htmlspecialchars($_POST['tax']);
   $total =  htmlspecialchars($_POST['total']);

   //insert in db
   $mysqli->query("INSERT INTO data (firstname, lastname, pumkinpie, applepie, telephone, pickupminutes, subtotal, tax,total)
   	VALUES('$firstname', '$lastname', '$pumkinpie', '$applepie', '$telephone','$pickupminutes', '$subtotal','$tax', '$total')") or 
   die ($mysqli->error);
   
   $_SESSION['message'] = "Record has been saved.";
   $_SESSION['msg_type'] ="Success";
   
   //return user back to index page or home page
   header("Location:index.php");
}

//check if the delete button has been clicked and delete record
if(isset($_GET['delete'])){
	$id= $_GET['delete'];
	$mysqli->query("DELETE FROM data WHERE id = $id") or die($mysqli->error());

    $_SESSION['message'] ="Record has been deleted.";
    $_SESSION['msg_type'] ="danger";

	header("Location:index.php");
}

//check if the edit button has been clicked and edit record
if(isset($_GET['edit'])){
   $id =$_GET['edit'];
   $update =true;
   $result = $mysqli->query("SELECT * FROM data WHERE id = $id")or die($mysqli->error());
   
   //check to see if there is any records in the db
   if(count($result)==1){
      $row = $result->fetch_array();
      $firstname = $row['firstname'];
      $lastname  = $row['lastname'];
      $pumkinpie = $row['pumkinpie'];
      $applepie  = $row['applepie'];
      $telephone = $row['telephone'];
      $pickupminutes =$row['pickupminutes'];
      $subtotal = $row['subtotal'];
      $tax   =  $row['tax'];
      $total =  $row['total'];

   }
}

//check if the undate button has been clicked and update a record.
if(isset($_POST['update'])){
  $id= $_POST['id'];

   $firstname = htmlspecialchars($_POST['fname']);
   $lastname  = htmlspecialchars($_POST['lname']);
   $pumkinpie = htmlspecialchars($_POST['pumkinpie']);
   $applepie  = htmlspecialchars($_POST['applepie']);
   $telephone = htmlspecialchars($_POST['telephone']);
   $pickupminutes = htmlspecialchars($_POST['pickupminutes']);
   $subtotal = htmlspecialchars($_POST['subtotal']);
   $tax   =  htmlspecialchars($_POST['tax']);
   $total =  htmlspecialchars($_POST['total']);

   $mysqli->query("UPDATE data SET firstname='$firstname', lastname='$lastname',pumkinpie='$pumkinpie',applepie='$applepie',
   	telephone='$telephone',pickupminutes='$pickupminutes',subtotal='$subtotal',tax='$tax', 
   	total='$total' WHERE id =$id ")or die($mysqli->error());

   $_SESSION['message'] ="Record has been updated.";
   $_SESSION['msg_type'] ="warning";

	header("Location:index.php");
}
?>