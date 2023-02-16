<?php
if(session_status() == PHP_SESSION_NONE){session_start();} // Start session if one hasn't been created yet.
require("dbconn.php");


function userRegister($regFullname,$regEmail,$regPass,$regPostcode){
    $regUser=mysqli_query(connect(),"INSERT INTO users(fullname,email,password,postcode) VALUES('$regFullname','$regEmail','$regPass','$regPostcode')");
    if($regUser==true){
        $_SESSION['regSuccess']="1";
        header("location:../register.php");
    }
    else{
        $_SESSION['regError']="1";
        header("location:../register.php");
    }
    // The userRegister function includes the parameters (fullname, email, password, and postcode) and creates an account. If account creation is successful, create a session variable and redirect to register.php to display a message. If not, redirect but with a different session variable which will trigger an error message.
}

function userLogin($loginEmail,$loginPass){
    $loginPass=md5($loginPass);
    $loginQuery="SELECT * FROM users WHERE email='$loginEmail' AND password='$loginPass'";
    $userLogin=mysqli_query(connect(), $loginQuery);
    if(mysqli_num_rows($userLogin)){
        $getUser = mysqli_fetch_array($userLogin);
        $_SESSION['uid']=$getUser['userid'];
        $_SESSION['logSuccess']="1";
        header("location:../register.php");
    }
    else{
        $_SESSION['logError']="1";
        header("location:../register.php");
    }
    // The userLogin function includes the parameters (email, password) and searches for a record in the users database table which matches those two details. If one can be found then give the user a session variable with their ID and a message variable, then redirect to register.php which will display successful login message. If not, redirect but with a different session variable which will trigger an error message.
}


function getProducts(){
    $productList=mysqli_query(connect(), "SELECT * FROM products ORDER BY productid ASC");
    echo "<table>";
    echo "<tr><th>Preview</th><th>Name</th><th>Description</th><th>Price</th><th>Add to Cart</th></tr>";
    while($productInfo=mysqli_fetch_array($productList)){
        echo "<tr>
            <td class='preview'><img src='".$productInfo['imagepath']."'/></td>
            <td class='name'>".$productInfo['name']."</td>
            <td class='description'>".$productInfo['description']."</td>
            <td class='price'>&pound;".$productInfo['price']."</td>
            <td class='cart'><a class='cartappend' href='php/addToBasket.php?productid=".$productInfo['productid']."'><img src='img/cartappend.png'/></a></td>
            </tr>";
    }
    echo "</table>";
    // The getProducts method connects to the database through the server and iterates through all of the records in the products table and displayed them within container elements (DIV tags). The preview image however is contained in the form of a image path, which is where the image is stored in a directory. The PHP code above gets the imagepath and returns it inside a IMG tag with the src being the location of the image file. The name, description, and price is also displayed. There is a cartAppend button which links to the addToBasket.php with the product id and adds it to the basket.
}


function getBasket(){
    connect();
    if(!isset($_SESSION['basket'])){echo "<div id='emptybasket'>Basket is empty</div>";}
    else{
        echo "<table>";
        echo "<tr><th>Item</th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr>";
        $totalsum = 0;
        foreach($_SESSION['basket'] as $itemid=>$quantity){
        $productQuery=mysqli_query(connect(), "SELECT * FROM products WHERE productid='$itemid'");
        $getProduct=mysqli_fetch_array($productQuery, MYSQLI_BOTH);
        echo "<tr>
            <td class='preview'><img src='$getProduct[imagepath]'/></td>
            <td class='name'>$getProduct[name]</td>
            <td class='price'>&pound;$getProduct[price]</td>
            <td class='quantity'><form action='php/updateBasket.php?pid=$itemid' method='post'>
            <input type=text class='field' name='newQuantity' value='".$quantity."' maxlength='2'/>
            <input type='submit' class='update' value='Update'/>
            </form><a href='php/removeFromBasket.php?pid=".$itemid."'>[Remove item]</a></td>
            <td class='total'>&pound;".$getProduct['price']*$quantity."</td>
            </tr>
            ";
            $totalsum = $totalsum + $getProduct['price']*$quantity;
            $totalsum = number_format($totalsum, 2);
        }
        echo "<tr id='lastrow'><td colspan='4' id='total'>Total</td><td id='totalsum'>&pound;".$totalsum."</td></tr>";
        echo "</table>";
        echo "<div id='basketbuttons'>
            <a id='basketclear' href='basket.php?clear'>Clear</a>
            <a id='basketorder' href='basket.php?order'>Order</a>
        </div>";
    }
    // The getBasket method connects to the database and returns all of the information of all of the products in the virtual basket. These are then iterated through with a quantity changing form. There are also confirm and clear buttons to complete the order and clear the basket completely.
}

function itemCounter(){
    connect();
    if(isset($_SESSION['basket'])){
        $totalItems = 0;
        foreach($_SESSION['basket'] as $itemid=>$quantity){$totalItems=$totalItems+$quantity;}
        echo "<div id='shoppingcart'><a href='basket.php'><img src='img/cartw.png' alt='Shopping Cart'/><br>".$totalItems."</a></div>";
    }
    // This function is called on every interface page, to add the feature of having a item counter whilst users add products to the cart. They are able to see how many items are in the cart, which is loaded on every page request/refresh to ensure it is always correct.
}

function getUser(){
    if(isset($_SESSION['uid'])){echo "<div id='account'><img src='img/userimgw.png' alt='Shopping Cart'/></div>";}
}

function basketAppend($pid){
    connect();
    if(isset($_SESSION['basket'])){
        if(array_key_exists($pid,$_SESSION['basket'])){$_SESSION['basket'][$pid]++;}
        else{$_SESSION['basket'][$pid]=1;}
    }
    else{$_SESSION['basket']=array($pid=>1);}
    header("location ./products.php");
    // The basketAppend method gets the item id, and if it is already in the cart, increment it's quantity by one. If not, then add it to the basket with the quantity of 1. The method also handles the item if the shopping cart session has not been created yet.
}

function basketRemove($pid){
    connect();
    if(isset($_SESSION['basket'])){
        if(array_key_exists($pid, $_SESSION['basket'])){
            unset($_SESSION['basket'][$pid]);
        }
    }
}

function updateQuantity($pid, $newvalue){
    connect();
    $newvalue = intval($newvalue); // Making sure users do not enter any other number types except integers.
    if(isset($_SESSION['basket'])){
        if(array_key_exists($pid,$_SESSION['basket'])){
            $_SESSION['basket'][$pid]=$newvalue;
        }
        else{
            $_SESSION['basketError']="1";
        }
    }
    else{
        $_SESSION['basketError']="1";
    }
    header("location: ./basket.php");
    // The updateQuantity method changes the quantity of the item requested by the number entered by the user. If, for any reason, it cannot, the system will give users an error message and redirect them to the basket.php page.
}

function getConfirmedBasket(){
    connect();
    if(isset($_SESSION['basket']) && $_SESSION['order']=="1"){
        $totalsum=0;
        $tax=0.2;
        echo "<div id='fullorder'>";
        echo "<div id='title'>Please confirm your order</div>";
        echo "<div id='orderitems'>";
        foreach($_SESSION['basket'] as $itemid=>$quantity){
        $productQuery=mysqli_query(connect(), "SELECT * FROM products WHERE productid='$itemid'");
        $getProduct=mysqli_fetch_array($productQuery);
        echo "<div class='orderitem'><div class='quantity'>$quantity</div><div class='name'>$getProduct[name]</div><div class='price'>&pound;$getProduct[price]</div></div>";            
        $totalsum = $totalsum + $getProduct['price']*$quantity;
        $totalsum = number_format($totalsum, 2);
        }
        $taxappend = $totalsum*$tax;
        $taxappend = number_format($taxappend, 2);
        $finaltotal=$totalsum+$taxappend;
        $finaltotal=number_format($finaltotal, 2);
        echo "<div id='subtotal'>Subtotal: &pound;".$totalsum."</div>";
        echo "<div id='vat'>VAT(20%): &pound;".$taxappend."</div>";
        echo "<div id='total'>Total: &pound;".$finaltotal."</div>";
        echo "</div>";
        echo "<div id='orderbuttons'><a id='return' href='basket.php'>Go Back</a> <a id='confirm' href='orderconf.php?confirm'>Confirm Order</a></div>";
        echo "</div>";
    }
    else{header("location: ./basket.php");}
    // The getConfirmedBasket method iterates through all of the products in the basket, in a similar way to the basket.php page, however without the option to change the quantity. This is for the orderconf.php page which will be for users once they are ready to complete their order of items. This function also calculates the subtotals, tax amount and then a final total including the tax.
}

function clearBasket(){
    if(isset($_SESSION['basket'])){
        unset($_SESSION['basket']);
        header("location: ./basket.php");
    }
    // The clearBasket method simply unsets the basket, dropping all of the items and then redirecting the user to basket.php.
}

function orderBasket(){
    if(isset($_SESSION['basket'])){
        $_SESSION['order']="1"; // Set session variable to allow the orderconf.php page to accept the user
        header("location: ./orderconf.php"); // Redirect to orderconf.php
    }
    else{
        echo "No basket.";
        header("location: ./orderconf.php"); // Redirect to orderconf.php
    }
    // The orderBasket method sets a session variable for the 'order' which will be processed on the orderconf.php page. This will ensure users are ready to complete the order and will also ensure that users have to go through the basket.php page before confirming their purchase of items; if they try to view the orderconf.php page without having confirmed the purchase, the page will redirect them back to basket.php.
}

function completeOrder(){
    if(isset($_SESSION['uid'])){
        $userid=$_SESSION['uid'];
        foreach($_SESSION['basket'] as $itemid=>$quantity){
            $productQuery=mysqli_query(connect(), "SELECT * FROM products WHERE productid='$itemid'");
            $getProduct=mysqli_fetch_array($productQuery);
            $productid = $itemid;
            $productquantity = $quantity;
            $producttotal = $getProduct['price']*$quantity;
            $producttotal = number_format($producttotal, 2);
            mysqli_query(connect(),"INSERT INTO orders(orderuserid,orderproductid,orderproductquantity,ordertotal) VALUES ('$userid','$productid','$productquantity','$producttotal')");
         }
        unset($_SESSION['basket']);
        unset($_SESSION['order']);
        $_SESSION['orderconfirmed']="1";
        header("./index.php");
    }
    else{
        $_SESSION['permitError']="1";
        header("location: ./basket.php");
    }
    // The final method completeOrder, retrieves the user's ID from the session variable and inserts an record in the orders database table for each item and the quantity they would like to order. Once this has been done for all items, the basket session is unset, and the order session variable, and then users are redirected to the homepage. Any errors during this process are handled by redirecting the user to orderconf.php with an error variable which will tell them what to do/what has happened.
}

?>