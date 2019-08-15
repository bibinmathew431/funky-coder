<?php
include'db.php';
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
$uid = $_SESSION["uid"];
$pquery = "select * from payments where user_id = $uid limit 1";
$p_query = mysqli_query($con,$pquery);
while($val=mysqli_fetch_array($p_query)){
$f_name = $val["full_name"];
$email = $val["email"];
$addr = $val["address"];
$cty = $val["city"];
$state = $val["state"];
$zip = $val["zip"];
$card_name = $val["name_card"];
$card_number = $val["credit_number"];
$exp_month = $val["exp_month"];
$exp_year = $val["exp_year"];
$cvv = $val["cvv"];
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}
.btn-2 {
  background-color: red;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}
.exis{
	
background-color:red;
  color: white;
  padding: 4px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
	
}
span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
#display_msg{
	font-size:25px;
	text-align: center;
	margin-left:325px;
	color:black;
	font-weight: bold;

}</style>
</head>
<body>		
<div class="row">
  <div class="col-75">
    <div class="container">
	<small id="display_msg"> </small>
	<form onsubmit=" return validate()" action = "payment_success.php">
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
			<label for="fname"><i class="fa fa-user"></i><b>First Name</b></label>
            <label for="fname"><?php echo $f_name ?></label>
			<label for="email"><i class="fa fa-envelope"></i><b>Email Address</b></label>
            <label for="email"><?php echo $email ?></label>
			<label for="adr"><i class="fa fa-address-card-o"></i><b>Home Address</b></label>
            <label for="adr"><?php echo $addr ?></label>
			<label for="city"><i class="fa fa-institution"></i><b>City</b></label>
            <label for="city"><?php echo $cty ?></label>
			<div class="row">
              <div class="col-50">
				<label for="state"><b>State</b></label>
                <label for="state"><?php echo $state ?></label>
              </div>
              <div class="col-50">
                <label for="state"><b>Zip</b></label>
                <label for="state"><?php echo $zip ?></label>
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname"><b>Name on Card</b></label>
			<label for="cname"><?php echo $card_name ?></label>
            <label for="ccnum"><b> Credit card number </b></label>
			<label for="ccnum"><?php echo $card_number ?></label>
            <label for="expmonth"><b> Exp Month </b></label>
			<label for="expmonth"><?php echo $exp_month ?></label>
            <div class="row">
              <div class="col-50">
                <label for="expyear"><b> Exp Year </b></label>
                <label for="expyear"><?php echo $exp_year ?></label>
              </div>
              <div class="col-50">
                <label for="cvv"><b>CVV </b></label>
                <label for="cvv"><?php echo $cvv ?></label>
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" onclick ="validate()" value="Continue to checkout" class="btn" name="exist_success">
		<input type="submit" onclick ="validate()" value="Go back to shopping" class="btn-2" name="go_shopping">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
	<?php $uid = $_SESSION["uid"];
	$sql = "SELECT * FROM cart WHERE user_id = $uid";
		$run_query = mysqli_query($con,$sql);
		$count = mysqli_num_rows($run_query);
      echo "<h4>Cart <span class='price' style='color:black'><i class='fa fa-shopping-cart'></i> <b id='#num'>$count</b></span></h4>";
	  //here 
		
			if($count > 0){
			$total_amt = 0;
			while($row=mysqli_fetch_array($run_query)){
			$id = $row["id"];
			$pro_name = $row["product_title"];
			$pro_price = $row["price"];
			$total = $row["total_amt"];
			$price_array = array($total);
			$total_sum = array_sum($price_array);
			$total_amt = $total_amt + $total_sum;
		
      echo "<p>$pro_name <span class='price'>₹$pro_price</span></p>
	  <a href='rm_cart.php?val=$id'><button type='button' class='exis'>Remove</button></a>";
	  echo "<hr>";
			}
			}
      echo "<hr>";
      echo "<p>Total <span class='price' style='color:black'><b>₹$total_amt</b></span></p>";
    ?>
	</div>
  </div>
</div>
</body>
</html>