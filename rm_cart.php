<?php
include'db.php';
session_start();
$uid = $_SESSION["uid"];

mysqli_query($con,$sql);
if(isset($_GET['success'])){
		$id = $_GET['success'];
$sql = "delete from cart where id=$id";
mysqli_query($con,$sql);
	echo "<script>alert('A product has been deleted!')</script>";
	echo "<script>window.open('paymentform.php','_self')</script>";
	
	
}
else{
	$id = $_GET['val'];
$sql = "delete from cart where id=$id";
mysqli_query($con,$sql);
	echo "<script>alert('A product has been deleted!')</script>";
	echo "<script>window.open('existing_payments.php','_self')</script>";
}




?>