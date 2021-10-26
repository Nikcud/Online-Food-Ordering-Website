<?php
    session_start();
   
    if(isset($_SESSION['cart'])){
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'food_delivery';
    
    
        $conn = mysqli_connect($servername,$username,$password,$database);
        if(!$conn){
            die("Connection Failed");
            echo mysqli_connect_error();
        }

        $UserID = $_SESSION['userID'];
        foreach($_SESSION['cart'] as $key => $value){
                $Item_Name = $value['Item_Name'];
                $Item_Price = $value['Item_Price'];
                $Quantity = $value['Quantity'];

            if(isset($_SESSION['ItemName'])){
                if(!in_array($value['Item_Name'],$_SESSION['ItemName'])){
                    $str = "INSERT INTO add_to_cart(ItemName,ItemPrice,Quantity,UserID) VALUES ('$Item_Name','$Item_Price','$Quantity','$UserID');";
                    $query = mysqli_query($conn,$str);
                }
            }
            else{
                $str = "INSERT INTO add_to_cart(ItemName,ItemPrice,Quantity,UserID) VALUES ('$Item_Name','$Item_Price','$Quantity','$UserID');";
                $query = mysqli_query($conn,$str);
            }
            
        }
        mysqli_close($conn);
    }

    if($_SESSION['isLogin'] == true){
        session_unset();
        session_destroy();
       
    }

    echo "<script> 
                alert('Signout Successfully');
                    window.location.href = 'index.php';
                </script>";
   
?>