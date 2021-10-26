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

    $str = "SELECT * FROM ADD_TO_CART WHERE UserID = '$userID';";

    $query = mysqli_query($conn,$str);
    $count = mysqli_num_rows($query);
    if($count >= 1){
        $_SESSION['ItemName'] = array();
        $i = 0;
        for(; $row = mysqli_fetch_row($query);){
            //   echo $row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ".$row[4]."<br>";
              array_push($_SESSION['ItemName'],$row[1]);
              $_SESSION['cart'][$i]=array('Item_Name' => $row[1],'Item_Price' => $row[2],
              'Quantity' => $row[3]);

              $i = $i + 1;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    
    <link rel='stylesheet' href='css/navbar.css'>
    <link rel='stylesheet' href='css/cart.css'>
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
                "<li class='items'><a href='account.php'>Account</a></li>
                <li class='items'><a class='active' href='cart.php'>Cart</a></li>
                <li class='items'><a href='signout.php'>Sign out</a></li>": 
                " <li class='items'><a href='signin.php'>Sign In</a></li>  
                 <li class='items'><a href='signup.php'>Sign Up</a></li>"; ?>
           <?php echo $x; ?>
    
        </ul>
    </nav>
    <br>
    <br>
    <section>
    <h1> My Cart </h1>
    <br>
    <br>
        <?php
        $total = 0;
            if(isset($_SESSION['cart'])){
                
                $count = count($_SESSION['cart']);
                if($count == ''){
                    echo "<h2> Cart is Empty </h2>";
                    echo "<br>";
                }
                foreach($_SESSION['cart'] as $key => $value){
                    $total = $total + $value['Quantity']*$value['Item_Price'];
                    echo "
                    <div id='add-to-cart'>
                        <div>
                            <p class='dish-name'> $value[Item_Name] </p>
                            <div id='item-details'>
                               <label> Price : &nbsp;</label>  $value[Item_Price]  
                               &nbsp;
                               &nbsp;
                               <label> Qty : &nbsp;</label> $value[Quantity]
                            </div>
                          
                        </div>
                        <form action='manageCart.php' method='POST'> 
                            <button id='remove' name='REMOVE_ITEM'> Remove </button>
                            <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                        </form>
                        
                    </div>";

                    $_SESSION['price'] = $total;

                }
            }
            else{
                echo "<h2> Cart is Empty </h2>";
                echo "<br>";
            }
        ?>
    <br>
    <div id="mk-payment">
    <?php

        if(empty($_SESSION['cart']))
        {
            echo "";
        }
        else
        {
            echo " <p id='total'> Total : Rs. $total </p> <br>";
            echo "
                <form action='order.php'>
                    <button id='payment'> Make a Purchase </button>
                </form>
            ";
        } 
    ?>     
    </div>
    

    </section>
    
</body>
</html>