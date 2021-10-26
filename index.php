<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    
</head>
<body>
<nav id="navbar">
        <div id="logo">
            <p>Foodyfly</p>
        </div>
        <ul id="n">
        <li class="items"><a href="index.php" class='active'>Home</a></li>
            <li class="items"><a href="foods.php">Food Items</a></li>

      
            <?php $x =  isset($_SESSION['isLogin'])  ? 
                "<li class='items'><a href='account.php'>Account</a></li>
                <li class='items'><a href='cart.php'>Cart</a></li>
                <li class='items'><a href='signout.php'>Sign out</a></li>": 
                " <li class='items'><a href='signin.php'>Sign In</a></li>  
                 <li class='items'><a href='signup.php'>Sign Up</a></li>"; ?>
           <?php echo $x; ?>
        </ul>
    
    </nav>

    

    <section id="home">
        <h1 class="h-primary">Your Favourite Food <br> Delivered Hot & Fresh</h1>
            <br>
        <p class="h-description">Foodyfly chefs do all the prep work, like peeling, chopping & maintaining, so you cook a fresh homemade dinner in just 15 minutes.
        </p> 
      <br>
      <form action='foods.php'>
        <button class="btn">
                Order Now
            </button>
     </form>

     <div>        
    </section>

    <footer>
        <div class="div">
            <p> Timing </p>
            <p> Today 10:00 AM - 7:00 PM </p>
            <p class='shade'> Working hours </p>
        </div>

        <div class="div">
            <p> Contact Us </p>
            <p> +39(063)8332415 </p>
            <p class='shade'> Call Online </p>
        </div>
    </footer>
    
</body>
<script src='js/navbar.js'>  </script>
</html>