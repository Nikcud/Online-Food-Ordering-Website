<?php
    session_start();

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'food_delivery';

    $conn = mysqli_connect($servername,$username,$password,$database);
    if(!$conn){
        die("Connection Failed");
        echo mysqli_connect_error();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='css/foods.css'>
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
        <h1> Foods Items </h1>
        <hr>
            <h2> Pizza </h2>
        <div id="details">

            <?php
                $output = mysqli_query($conn,"SELECT * FROM FOOD_PIZZA");
                for(; $row = mysqli_fetch_row($output);){
                    $name = $row[0];
                    $image = $row[1];
                    $description = $row[2];
                    $price = $row[3];

                    echo "
                    <div id='food-items'>
                        <p class='dish-name'> $name </p>
                        <br>
                        <img src= $image>
                        <br>
                        <p id='description'> $description </p>
                        
                            <div id='item-details'>
                                <form action='manageCart.php' method='POST'>
                                    <button class='name' name='ADD_TO_CART'> Add to Cart</button>
                                    <label> Qty</label>
                                    <select name='qty' id='qty'>
                                        <option value='1'>1</option>
                                        <option value='2'>2</option>
                                        <option value='3'>3</option>
                                        <option value='4'>4</option>
                                    </select>
                                    <input type='hidden' name='Item_Name' value='$name'>
                                    <input type='hidden' name='Item_Price' value=$price>

                                </form>
                                <p class='price'> Rs. $price</p>
                            </div>
                    </div>
                    ";
                }            
            ?>
                <br>
                <br>
                <hr>
                <h2> Burger </h2>

            <?php
                $output = mysqli_query($conn,"SELECT * FROM FOOD_BURGER");
                for(; $row = mysqli_fetch_row($output);){
                    $name = $row[0];
                    $image = $row[1];
                    $description = $row[2];
                    $price = $row[3];

                    echo "
                    <div id='food-items'>
                        <p class='dish-name'> $name </p>
                        <br>
                        <img src= $image>
                        <br>
                        <p id='description'> $description </p>
                        
                            <div id='item-details'>
                                <form action='manageCart.php' method='POST'>
                                    <button class='name' name='ADD_TO_CART'> Add to Cart</button>
                                    <label> Qty</label>
                                    <select name='qty' id='qty'>
                                        <option value='1'>1</option>
                                        <option value='2'>2</option>
                                        <option value='3'>3</option>
                                        <option value='4'>4</option>
                                    </select>
                                    <input type='hidden' name='Item_Name' value='$name'>
                                    <input type='hidden' name='Item_Price' value=$price>

                                </form>
                                <p class='price'> Rs. $price</p>
                            </div>
                    </div>
                    ";
                } 
                
                mysqli_close($conn);
            ?>
        </div>
        
    <section>  
</body>
    <script src='./js/foods.js'>  </script>
</html>