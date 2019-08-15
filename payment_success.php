<?php
include 'db.php';
session_start();
$uid = $_SESSION["uid"];
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
if((isset($_GET["go_shopping"]))){
	
	header("location:profile.php");
	exit();
	
}
if(isset($_GET["success"]) || ($_GET["exist_success"]) )
{
if(isset($_GET["success"])){

$f_name = $_GET["firstname"];
$email = $_GET["email"];
$addr = $_GET["address"];
$cty = $_GET["city"];
$state = $_GET["state"];
$zip = $_GET["zip"];
$card_name = $_GET["cardname"];
$card_number = $_GET["cardnumber"];
$exp_month = $_GET["expmonth"];
$exp_year = $_GET["expyear"];
$cvv = $_GET["cvv"];	
}
else{
$pmts = "select * from payments where user_id = $uid limit 1";
$p_query = mysqli_query($con,$pmts);	
while($p_q=mysqli_fetch_array($p_query)){
$f_name = $p_q["full_name"];
$email = $p_q["email"];
$addr = $p_q["address"];
$cty = $p_q["city"];
$state = $p_q["state"];
$zip = $p_q["zip"];
$card_name = $p_q["name_card"];
$card_number = $p_q["credit_number"];
$exp_month = $p_q["exp_month"];
$exp_year = $p_q["exp_year"];
$cvv = $p_q["cvv"];		
}
}
	
	  //here 
			
$tmt = "SELECT * FROM cart WHERE user_id = $uid";
$t_query = mysqli_query($con,$tmt);
$total_amt = 0;
while($val=mysqli_fetch_array($t_query)){
			$vll = $val["price"];
			$total = $val["total_amt"];
			$price_array = array($total);
			$total_sum = array_sum($price_array);
			$total_amt = $total_amt + $total_sum;

}
if(isset($vll)!=null){
$tmt2 = "INSERT INTO payments(user_id,amount,payment_type,full_name,email,address,city,state,zip,name_card,credit_number,exp_month,exp_year,cvv) 
			VALUES('$uid','$total_amt','credit_card','$f_name','$email','$addr','$cty','$state','$zip','$card_name','$card_number','$exp_month','$exp_year','$cvv')";
	
mysqli_query($con,$tmt2);
}
$sql1 = "SELECT * FROM cart WHERE user_id = $uid";
		$run_query = mysqli_query($con,$sql1);
while($row=mysqli_fetch_array($run_query)){
	$users_id=$row['user_id'];
	$pro_id =$row['p_id'];
	
	
} if(isset($users_id)&&isset($pro_id)){
	$sql2 = "INSERT INTO orders(user_id,product_id,p_status) 
			VALUES('$users_id','$pro_id','completed')";
	mysqli_query($con,$sql2);
}

$p_sql = "select payment_id from payments";
$pid = mysqli_query ($con,$p_sql);
while ( $row = mysqli_fetch_array($pid)){
$payment_id = $row['payment_id'];
}
$o_sql = "select order_id from orders";
$oid = mysqli_query($con , $o_sql);
while ( $row = mysqli_fetch_array($oid)){
$order_id = $row['order_id'];
}
$tran_sql = " INSERT into transactions (user_id,payment_id,order_id )
VALUES ('$uid','$payment_id','$order_id')";
mysqli_query($con,$tran_sql);

$p_details_sql = "select * from payments where user_id= $uid";
$p_details = mysqli_query($con,$p_details_sql);
while ( $row = mysqli_fetch_array($p_details)){
$address = $row ['address'];
$state = $row ['state'];
$zip = $row ['zip'];
$cty =$row['city'];
$p_date = $row ['payment_date'];	
}
$t_details_sql = "select * from transactions";
$t_details = mysqli_query($con, $t_details_sql);
while($row = mysqli_fetch_array($t_details)){
	$tid = $row['transaction_id'];
	
}
$user_sql = "Select mobile from user_info where user_id =$uid";
$user_mobno = mysqli_query($con,$user_sql);
while($row = mysqli_fetch_array($user_mobno)){
	$ph_no = $row['mobile'];
}
}
?>
			
			
			
<html>
<head>
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
</head>
<body>
<div class ="container">
<div class="panel-heading">
<div class="order_details">
   <h1> Paisa Vasool </h1>
   <h3 style="margin-left:450px; margin-bottom:100px;"> Order Receipt </h3>
<div class = "row" >
	<div class="col-md-3"> <b> Address </b> </div>
	<div class="col-md-3" > <b> Ph.no </b> </div>
	<div class ="col-md-3"> <b>Receipt Date and Time: </b></div>
	<div class ="col-md-3"><b> Transaction Id: </b></div>
</div>
<div class = "row">
<div class="col-md-3">  <?php echo $address.','; ?> <br> <?php echo $state.','; ?> <br> <?php echo $cty.','; ?> <br> <?php echo $zip.',';?> </div>
<div class="col-md-3">  <?php echo $ph_no; ?>  </div>
<div class="col-md-3">  <?php echo $p_date; ?>  </div>
<div class="col-md-3">  <?php echo $tid; ?>  </div>
</div>
</div>
</div>
</div>
			<div class="container">
	
	<div class="panel-heading">
	<div class="row">
									<div class="col-md-4"><b>Sr.No</b></div>
									<div class="col-md-4"><b>Product Name</b></div>
									<div class="col-md-4"><b>Price in ₹.</b></div>
	</div>
	<div class = "row">
	<?php
				$sql = "SELECT * FROM cart WHERE user_id = $uid";
				$run_query = mysqli_query($con,$sql);
		
		$count = 0;
					$total_amt = 0;
			while($row=mysqli_fetch_array($run_query)){
			$count++;
			$id = $row["id"];
			$pro_name = $row["product_title"];
			$pro_price = $row["price"];
			$total = $row["total_amt"];
			$price_array = array($total);
			$total_sum = array_sum($price_array);
			$total_amt = $total_amt + $total_sum;
			echo"<div class='col-md-4'> $count </div> 
				<div class='col-md-4'> $pro_name </div>  
				<div class='col-md-4'> ₹$pro_price </div> 
			";}?>
			
	</div>
	</div>
	</div>
<div class="container">
			<?php echo "<hr>"; ?>
			<?php echo "
			<div class='col-lg-8'><b><p style='margin:0px'>Total </p></b></div>
			<div class='col-lg-4'> <b>₹$total_amt <b> </div>"?>
			</div>
<div class="button"> 
<button type="button" class="btn btn-warning btn-lg"><a href="profile.php">Back to Shopping </a></button>
</div>
<style>
h1{
	
	margin-left:420px;
	margin-bottom:50px;
	margin-top:0px;
	
}
.button{
	margin-left:640px;
	margin-top:25px;
	font-color:black;
	
	
	
}

a:link {
  color: red;
}
.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}
.order_details {
	
	width:100%;

	
	
}


</style>
</body>
</html>





<?php 
	$rm_card = "delete from cart where user_id = $uid";
mysqli_query($con,$rm_card);
?>
















