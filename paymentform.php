<?php
include'db.php';
session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
}
$uid = $_SESSION["uid"];
$check = "select * from payments where user_id = $uid limit 1";
$c_query = mysqli_query($con,$check);
if(mysqli_num_rows($c_query) == 1 ){
	header("location:existing_payments.php");
	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Javascript validation -->  
<script src="js/jquery2.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript"> 
function validate(){
	// regex
 var ptrn = /^([^0-9\W]*)$/;
 var numbers = /^[0-9]+$/;
 var validEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
 var data = document.getElementById("display_msg");
 var f_name = document.getElementById("fname").value;
 var email = document.getElementById("email").value;
 var addr = document.getElementById("adr").value;
 var city = document.getElementById("city").value;
 var state = document.getElementById("state").value;
 var zip = document.getElementById("zip").value;
 var cname = document.getElementById("cname").value;
 var ccnum = document.getElementById("ccnum").value;
 var expmonth = document.getElementById("expmonth").value;
 var expyear = document.getElementById("expyear").value;
 var cvv = document.getElementById("cvv").value;
 if(f_name.value == "" || email.value=="" || addr.value == "" || city.value == "" || state.value == "" || zip.value == "" || cname.value == "" || ccnum.value == "" || expmonth.value == "" || expyear.value == "" || expyear.value == "" || cvv.value =="" ){
	 //
	 data.textContent="Please Fill All The Details";
	 return false;
 }
 
 else if(ptrn.test(f_name)==false) {
	  data.textContent="Please Enter valid name";
	  return false
 }
 
else if(validEmail.test(email)==false){
	 data.textContent="Please Enter Valid Email Address";
	 return false;
 }
else if(ptrn.test(city)==false){
data.textContent="Please Enter valid city name";
	  return false
}
else if(ptrn.test(state)==false){
data.textContent="Please Enter valid State name";
	  return false
}	
 
else if (numbers.test(zip)==false){
		data.textContent="Please Enter Valid Zip";
		return false;
	}
else if (ptrn.test(cname)==false){
		data.textContent="Please Enter card name";
		return false;
	}
else if (numbers.test(ccnum)==false){
		data.textContent="Please Enter card number";
		return false;
	}
else if (ptrn.test(expmonth)==false){
		data.textContent="Please Enter valid expiry month";
		return false;
	}
else if (numbers.test(expyear)==false){
		data.textContent="Please Enter valid exp year";
		return false;
	}
else if (numbers.test(cvv)==false){
		data.textContent="Please Enter valid cvv";
		return false;
	}
else{
	return true;
}
}
</script>
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

}
</style>
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
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">			
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
			<!--	<small id="smzip"> </small> left for later!-->
                <input type="text" id="zip" name="zip" placeholder="10001">
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
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <input type="submit" onclick ="validate()" value="Continue to checkout" class="btn" name="success">
		
      </form>
	  <a href="product.php"><input type="submit"value="Go back to shopping" class="btn-2"></a>
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
		
      echo "<p>$pro_name <span class='price'>₹pro_price</span></p>
	  <a href='rm_cart.php?success=$id'><button type='button' class='exis'>Remove</button></a>";
	  echo "<hr>";
			}
			}
      echo "<p>Total <span class='price' style='color:black'><b>₹$total_amt</b></span></p>";
    ?>
	</div>
  </div>
</div>
</body>
</html>