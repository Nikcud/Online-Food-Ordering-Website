<?php
    session_start();

    if(!isset($_SESSION['isLogin'])){
        echo "<script> 
                window.location.href = 'index.php';
            </script>";
    }

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'food_delivery';
    $userID = $_SESSION['userID'];

    $conn = mysqli_connect($servername,$username,$password,$database);
    if(!$conn){
        die("Connection Failed");
        echo mysqli_connect_error();
    }
    
    $str = "SELECT * FROM ADDRESS where UserID = '$userID';";

    $query = mysqli_query($conn,$str);
    $count = mysqli_num_rows($query);

    for(; $row = mysqli_fetch_row($query);){
        // echo $row[1]." ".$row[2]." ".$row[3]." ".$row[4]." "."<br>";
    
        $_SESSION['pincode'] = $row[3];
        $_SESSION['address'] = $row[4];
    }


    if(isset($_POST['ordernow'])){
        $country = $_POST['country'];
        $state = $_POST['state_name'];
        $city = $_POST['city'];
        $pincode = $_POST['pincode'];
        $address = $_POST['address'];
      
        if($count == 1){
            $str = "UPDATE ADDRESS SET State = '$state',City = '$city',Pincode = '$pincode',address = '$address' WHERE UserID = '$userID';";
            $query = mysqli_query($conn,$str);
        }
        else{
            $str = "INSERT INTO ADDRESS(Country, State, City, Pincode, address,UserID) VALUES('$country','$state','$city ','$pincode','$address','$userID');";
            $query = mysqli_query($conn,$str);
        }
        $str = "DELETE FROM add_to_cart WHERE UserID = '$userID';";
        $query = mysqli_query($conn, $str);
        unset($_SESSION['cart']);

        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a purchase</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='css/order.css'>
    <link rel='stylesheet' href='css/navbar.css'>
</head>
<body>

    <nav id="navbar">
        <div id="logo">
            <p>Foodyfly</p>
        </div>
        <ul>
        <li class="items"><a href="index.php">Home</a></li>
            <li class="items"><a href="foods.php" class="active">Food Items</a></li>
            <?php $x =  isset($_SESSION['isLogin'])  ? 
                "<li class='items'><a href='account.php'>Account</a></li>
                <li class='items'><a href='cart.php'>Cart</a></li>
                <li class='items'><a href='signout.php'>Sign out</a></li>": 
                " <li class='items'><a href='signin.php'>Sign In</a></li>  
                 <li class='items'><a href='signup.php'>Sign Up</a></li>"; ?>
           <?php echo $x; ?>
        </ul>
    </nav>

<section>
    <h2>  Make a Payment </h2>
    <br>
    <form action='' method='POST'>
        <div class='details-div'>
             <div class='details-content'>
                <label id='username'> User Name </label>
                <input type='text' id='name' name='uname' 
                    onkeypress="return checkInput();" 
                    oninput="checkBorder(this);"
                    value= <?php echo $_SESSION['username']; ?> >
             </div>
           
            <div class='details-content'>
                <label id='gender'> Gender </label>
                <input type='text' id='user_gender' name="gender" 
                oninput="checkBorder(this);"
                value= <?php echo $_SESSION['gender']; ?> >
            </div>
            
        </div>
    
        <div class='details-div'>
            <div class='details-content'>
                <label id='email'> Email </label>
                <input type='text' id='user_email' name="email" 
                oninput="checkBorder(this);"
                value='<?php echo $_SESSION['email']; ?>' >
            </div>
            

            <div class='details-content'>
                <label id='phone'> Phone </label>
                <input type='text' id='user_number' name="phone" 
                oninput="checkBorder(this);"
                value=<?php echo $_SESSION['phone']; ?> >
            </div>

        </div>
        
        <div class='details-div'>
            <div class='details-content'>
                <label id='country'>Country </label>
                <input type='text' id="user_country" 
                name="country" value='India' readonly>
            </div>
            

            <div class='details-content'>
                <label id='state'> State </label>
                <select name="state_name"  id="state_name" 
    
                oninput="checkBorder(this);"
                onchange="search_district(this.value)" required>
                    <option value="" > --Select-- </option>;	   	
			    </select>
            </div>
        </div>

        <div class='details-div'>
            <div class='details-content'>
                <label id='city'> City </label>
                <select name="city"  id="city_name"
                oninput="checkBorder(this);"
                required>
				<option value="">--Select--</option>
			</select>
            </div>
            

            <div class='details-content'>
                <label id='pincode'> Pin code </label>
                <input type='text' name='pincode' id='user_pincode' value= '<?php  
                
                $ans = isset($_SESSION['pincode']) ? $_SESSION['pincode'] : "" ;
                
                echo $ans;   
            
                ?>'
                oninput="checkBorder(this);">
            </div>
           
        </div>

        <div>
            <label id='address'> Address </label><br>
            <input name='address' id='user_address' value='<?php  
                
                $ans = isset($_SESSION['address']) ? $_SESSION['address'] : "" ;
                
                echo $ans;   
            
                ?>'
            oninput="checkBorder(this);">
        </div>
       
        <br>
        <div>
            <label> Total : Rs. <?php echo $_SESSION['price']; ?> </label>
        </div>
        <br>
            <button id='rzp-button1' name='ordernow' onclick='return validateForm(this.form); return '>Order Now</button>
    
    </form>

    <script src='https://checkout.razorpay.com/v1/checkout.js'>       </script>  
        <script> 
             var options = {          
                 "key": "rzp_test_fFhnp4qYyfUsBf",
                 "amount": <?php print json_encode($_SESSION['price']*100); ?>,
                 "currency": "INR",
                 "name": "Foodyfly",
                 "description": "Test Transaction",
                 "image": "https://example.com/your_logo",
 
                 "handler": function (response) {
                     alert("Payment done Successfully");
                     document.location.href="index.php";
                  
                 },
                 "prefill": {
                     "name": <?php print json_encode($_SESSION['username']); ?>,
                     "email": <?php print json_encode($_SESSION['email']); ?>,
                     "contact":<?php print json_encode($_SESSION['phone']); ?>
                 },
                 "notes": {
                     "address": "Razorpay Corporate Office"
                 },
                 "theme": {
                     "color": "#3399cc"
                 }
             };
 
             var rzp1 = new Razorpay(options); rzp1.on("payment.failed", function (response) {
                 alert(response.error.code);
                 alert(response.error.description);
                 alert(response.error.source);
                 alert(response.error.step);
                 alert(response.error.reason);
                 alert(response.error.metadata.order_id);
                 alert(response.error.metadata.payment_id);
             });
             document.getElementById("rzp-button1").onclick = function (e) {
                 rzp1.open();
                 e.preventDefault();
             }
         
       </script>  
        <script>   
            // function call(){
            //   alert("success");  
            // }
        </script>
       

        <br>
        <br>
        
    </section>
    
</body>
    
    <script src='js/order.js'>  </script>
    <script src='js/validate.js'>  </script>

        
</html>