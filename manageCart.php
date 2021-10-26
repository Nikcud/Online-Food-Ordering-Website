<?php
    session_start();
    // session_destroy();
    if(!isset($_SESSION['isLogin'])){
        echo "<script> alert('Please SignIn');
                    window.location.href = 'signin.php';
                    </script>";
    }
    else{
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST['ADD_TO_CART'])){
                if(isset($_SESSION['cart'])){
                    $myitems = array_column($_SESSION['cart'],'Item_Name');
                    if(in_array($_POST['Item_Name'],$myitems)){
                        echo "<script> alert('Item Already Added');
                        window.location.href = 'foods.php';
                        </script>";
                    }
                    else{
                        $count = count($_SESSION['cart']);
                        $_SESSION['cart'][$count] = array('Item_Name' => $_POST['Item_Name'],'Item_Price' => $_POST['Item_Price'],
                                                        'Quantity' => $_POST['qty']);
                        // print_r($_SESSION['cart']);
                        echo "<script> alert('Item Added');
                        window.location.href = 'foods.php';
                        </script>";
                    }
                }
                else{
                    $_SESSION['cart'][0]=array('Item_Name' => $_POST['Item_Name'],'Item_Price' => $_POST['Item_Price'],
                                                        'Quantity' => $_POST['qty']);
                    // print_r($_SESSION['cart']);
                    echo "<script> alert('Item Added');
                    window.location.href = 'foods.php';
                    </script>";
                }
            }

            if(isset($_POST['REMOVE_ITEM'])){
                foreach($_SESSION['cart'] as $key => $value){
                    if($value['Item_Name'] == $_POST['Item_Name']){

                        unset($_SESSION['cart'][$key]);
                        $_SESSION['cart'] = array_values($_SESSION['cart']);
                    
                        $servername = 'localhost';
                        $username = 'root';
                        $password = '';
                        $database = 'food_delivery';
                        
                        $conn = mysqli_connect($servername,$username,$password,$database);
                            if(!$conn){
                                die("Connection Failed");
                                echo mysqli_connect_error();
                            }

                        $itemName = $value['Item_Name'];
                        $UserID = $_SESSION['userID'];


                        $str = "SELECT * FROM ADD_TO_CART WHERE ItemName = '$itemName' and UserID = '$UserID';";

                        $query = mysqli_query($conn,$str);
                        $count = mysqli_num_rows($query);
                            if($count == 1){
                                $query = mysqli_query($conn,"DELETE FROM ADD_TO_CART WHERE ItemName = '$itemName' and UserID = '$UserID';");
                    
                            }
                        
                        echo "<script> 
                            alert('Item Removed');
                            window.location.href = 'cart.php';
                            </script>";
                        
                    }
                }
            }
        }
    }
    
?>