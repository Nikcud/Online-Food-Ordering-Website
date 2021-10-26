<?php
    session_start();
    if(!isset($_SESSION['isLogin'])){
        echo "<script>
                window.location.href = 'index.php';
                </script>";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='css/navbar.css'>
    <link rel='stylesheet' href='css/account.css'>

</head>
<body>
<nav id="navbar">
        <div id="logo">
            <p>Foodyfly</p>
        </div>
        <ul>
        <li class="items"><a href="index.php">Home</a></li>
            <li class="items"><a href="foods.php">Food Items</a></li>

      
            <?php $x =  isset($_SESSION['isLogin'])  ? 
                "<li class='items'><a class='active' href='account.php'>Account</a></li>
                <li class='items'><a href='cart.php'>Cart</a></li>
                <li class='items'><a href='signout.php'>Sign out</a></li>": 
                " <li class='items'><a href='signin.php'>Sign In</a></li>  
                 <li class='items'><a href='signup.php'>Sign Up</a></li>"; ?>
           <?php echo $x; ?>
        </ul>
    </nav>
    
    <section>
        <div id="account-details">
            <br>
            <h2>My Account </h2>
            <div id="img"> 
                        <img src = 'Profile.png' alt='account'>
            </div>
            <br>
            <div id="details">
                    
                <label id='name'><b>User Name </b></label> : <span id="sp-name"> <?php echo $_SESSION['username']; ?> </span><br>
                <label id='email'><b>Email </b></label> :  <span id="sp-email"> <?php echo $_SESSION['email']; ?> </span><br>
                <label id='gender'><b>Gender</b> </label> : <span id="sp-gender"> <?php echo $_SESSION['gender']; ?> </span><br>
                <label id = 'phone'><b>Phone </b></label> : <span id="sp-phone"> <?php echo $_SESSION['phone']; ?> </span><br>
                <!-- <label>Address </label> : <span> Shanwara Road, Burhanpur </span> <br> -->

               
            
            </div>
                
        </div>
    </section>

</body>
</html>